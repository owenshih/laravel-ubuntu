<template>
	<div>
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>旅宿業者</el-breadcrumb-item>
			<el-breadcrumb-item>全台旅宿列表</el-breadcrumb-item>
		</el-breadcrumb>
		<!-- 標題 -->
		<el-row type="flex" align="middle">
			<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
				<div class="title--orange">全台旅宿列表</div>
			</el-col>
		</el-row>
		<!-- 搜尋 -->
		<el-col :xs="24" :sm="24">
			<div class="title--blue">搜尋旅宿</div>
		</el-col>
		<el-form ref="inquireData" :model="inquireData" label-width="80px">
			<el-col :xs="12" :sm="8" :lg="4">
				<el-form-item label="旅宿名稱">
					<el-input v-model="inquireData.chinese_name"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="4">
				<el-form-item label="業者帳號">
					<el-input v-model="inquireData.account_number"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="4">
				<el-form-item label="縣市">
					<el-select v-model="inquireData.city" placeholder="請選擇" style="width:100%;" clearable @change="getTownDatas">
					<el-option
						v-for="(item, index) in cities"
						:label="item.chinese_name"
						:key="index"
						:value="item.id">
					</el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="4">
				<el-form-item label="區域">
					<el-select v-model="inquireData.town" placeholder="請選擇" clearable style="width:100%;">
						<el-option
							v-for="(item, index) in towns"
							:label="item.chinese_name"
							:key="index"
							:value="item.id">
						</el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="4">
				<el-form-item label="狀態">
					<el-select v-model="inquireData.status" placeholder="請選擇" clearable style="width:100%;" >
						<el-option label="已下架" value="-3"></el-option>
						<el-option label="拒絕簽約" value="-2"></el-option>
						<el-option label="尚待考慮" value="-1"></el-option>
						<el-option label="未簽約" value="0"></el-option>
						<el-option label="拜訪進行中" value="1"></el-option>
						<el-option label="簽約審核中" value="2"></el-option>
						<el-option label="已簽約完成" value="3"></el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="4">
				<el-form-item>
					<el-button type="primary" style="width:100%;" @click="getHotelDatas(1)">搜 尋</el-button>
				</el-form-item>
			</el-col>
		</el-form>
		<!-- 列表 -->
		<el-col :xs="24" :sm="24">
			<div class="title--blue">旅宿列表</div>
		</el-col>
		<el-table
			:data="hotelDatas"
			style="width: 100%"
			class="u-text-center">
			<el-table-column
				prop="city_chinese_name"
				label="縣市">
			</el-table-column>
			<el-table-column
				prop="town_chinese_name"
				label="區域">
			</el-table-column>
			<el-table-column
				prop="chinese_name"
				label="旅宿名稱">
			</el-table-column>
			<el-table-column
				prop="tel"
				label="連絡電話">
			</el-table-column>
			<el-table-column
				prop="status"
				label="狀態">
				<template slot-scope="scope">
					<template v-if="scope.row.status==-3">已下架</template>
					<template v-if="scope.row.status==-2">拒絕簽約</template>
					<template v-if="scope.row.status==-1">尚待考慮</template>
					<template v-if="scope.row.status==0">未簽約</template>
					<template v-if="scope.row.status==1">拜訪進行中</template>
					<template v-if="scope.row.status==2">簽約審核中</template>
					<template v-if="scope.row.status==3">已簽約完成</template>
				</template>
			</el-table-column>
			<el-table-column
				fixed="right"
				label="操作">
				<template slot-scope="scope">
					<router-link :to="{ name: 'hotel.edit', params: { id: scope.row.id } }  "><el-button type="text" size="small">編輯</el-button></router-link>
					<el-button type="text" size="small" @click="add(scope.row.id)">新增</el-button>
				</template>
			</el-table-column>
		</el-table>
		<div class="block u-text-right">
			<el-pagination
				@current-change="getHotelDatas"
				layout="prev, pager, next"
				:total="total">
			</el-pagination>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			inquireData:{
				chinese_name: '',
				account_number: '',
				city: '',
				town: '',
				status: ''
			},
			cities:[],
			towns:[{postal:'000', chinese_name:'請選擇縣市'}],
			hotelDatas:[],
			currentPage: '',
			total: 0,
		}
	},        
	created: function () {
		this.getHotelDatas(1);
		this.getCityDatas();
	}, 
	methods: {
		getHotelDatas(index){
			Vue.axios.get('/api/hotel', {
				params: {
					page: index, 
					chinese_name: this.inquireData.chinese_name, 
					account_number: this.inquireData.account_number, 
					city: this.inquireData.city,
					town: this.inquireData.town,
					status: this.inquireData.status
				}
			})
			.then(response=>{
            	this.currentPage = response.data.current_page
            	this.total = response.data.total
            	this.hotelDatas = response.data.data
			})
			.catch(function (error) {
				console.log('error');
			});
		},		
		getCityDatas(){
			Vue.axios.get('/api/city')
			.then(response=>{
            	this.cities = response.data
			})
			.catch(function (error) {
				console.log('error');
			});
		},
		getTownDatas(city){
			this.inquireData.town=''
			Vue.axios.get('/api/town/'+city)
			.then(response=>{
				console.log(response.data.length)
				if(response.data.length>0){
            		this.towns = response.data
				}else{
					console.log('error');
				}
			})
			.catch(function (error) {
				console.log('error');
			});
		},
		add(id){
			this.$confirm('確定將此旅宿加入個人清單嗎?', '提示', {
				confirmButtonText: '確定',
				cancelButtonText: '取消',
				type: 'warning'
			}).then(() => {
				Vue.axios.patch('/api/hotel_cooperation/' + this.$store.state.AuthUser.business_id,{
                    status: 1,
                    cooperation_item: id
                })
                .then(response=>{
                    this.$message({
                        message: '操作成功',
                        type: 'success'
                    });
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.log('error_add');
                });
			}).catch(() => {
				this.$message({
					type: 'info',
					message: '取消動作'
				});
				console.log('取消動作');
			});
		}
	}
}
</script>