<template>
	<div>
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>經費作業</el-breadcrumb-item>
			<el-breadcrumb-item>個人經費申請</el-breadcrumb-item>
		</el-breadcrumb>
	    <el-row type="flex" align="middle">
	    	<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
				<div class="title--orange">個人經費申請</div>
	    	</el-col>
	    	<el-col class="u-text-right">
				<el-button type="primary" @click="createFormVisible = true">新增經費</el-button>
	    	</el-col>
	    </el-row>
		<el-table
			:data="fundingData"
			style="width: 100%"
			class="u-text-center">
			<el-table-column
				prop="serial_number"
				label="申請編號">
			</el-table-column>
			<el-table-column
				prop="apply_date"
				label="申請日期">
			</el-table-column>
			<el-table-column
				prop="title"
				label="申請標題">
			</el-table-column>
			<el-table-column
				prop="status"
				label="申請狀態">
				<template slot-scope="scope">
					<template v-if="scope.row.status==0">
						編輯經費
					</template>
					<template v-if="scope.row.status==1">
						經費審核中
					</template>
					<template v-if="scope.row.status==3">
						經費審核完成
					</template>
				</template>
			</el-table-column>
			<el-table-column
				prop="total"
				label="申請總額">
			</el-table-column>
			<el-table-column
				fixed="right"
				label="操作">
				<template slot-scope="scope">
					<router-link :to="{ name: 'funding.edit', params: { id: scope.row.id } }  "><el-button type="text" size="small">編輯</el-button></router-link>
					<el-button type="text" size="small" @click="del(scope.row.id)">刪除</el-button>
				</template>
			</el-table-column>
		</el-table>
		<div class="block u-text-right">
			<el-pagination
				@current-change="getfundingData"
				layout="prev, pager, next"
				:total="total">
			</el-pagination>
		</div>
		<!-- 新增資料視窗 -->
		<el-dialog title="新增資料" :visible.sync="createFormVisible" center >
			<el-form ref="create_data" label-width="80px">
				<el-form-item label="標題">
					<el-input v-model="create_data.title"></el-input>
				</el-form-item>
				<el-form-item label="說明">
					<el-input type="textarea" v-model="create_data.content"></el-input>
				</el-form-item>
				<div class="u-text-right">
					<el-button @click="createFormVisible = false">取 消</el-button>
					<el-button type="primary" @click="createFunding">確 定</el-button>
				</div>
			</el-form>
		</el-dialog>



    </div>
</template>

<script>
export default {
    data() {
		return {
			createFormVisible:false,
			create_data:{
				title:'',
				content:''
			},
			fundingData:[],
			currentPage: '',
			total: 0,
		}
	},
	created: function () {
		this.getfundingData(1);
	}, 
	mounted: function(){
	},
	methods: {
		getfundingData(index){
			Vue.axios.get('/api/funding/', {
				params: {
					page: index, 
					business: this.$store.state.AuthUser.business_id
				}
			})
			.then(response=>{
            	this.currentPage = response.data.current_page
            	this.total = response.data.total
            	this.fundingData = response.data.data
			})
			.catch(function (error) {
				this.$message({
					type: 'success',
					message: error
				});
			});
		},
		createFunding(){
			this.createFormVisible = false
			Vue.axios.post('/api/funding/', {
				title: this.create_data.title,
				content: this.create_data.content,
				business: this.$store.state.AuthUser.business_id
			})
			.then(response=>{
				this.getfundingData(1);
				this.create_data.title = '';
				this.create_data.content = '';
				this.$message({
					message: '新增成功',
					type: 'success'
				});
			})
			.catch(function (error) {
				console.log(error)
				this.$message({
					message: '新增失敗，請查閱console.log',
					type: 'warning'
				});
			});
		},
		del(id){
			this.$confirm('此操作將刪除該筆資料，確定嗎?', '提示', {
				confirmButtonText: '確定',
				cancelButtonText: '取消',
				type: 'warning'
			}).then(() => {
				Vue.axios.patch('/api/funding/'+id, {
					status: -1
				})
				.then(response=>{
					this.getfundingData(1);
					this.$message({
						type: 'success',
						message: '刪除成功'
					});
				})
				.catch(function (error) {
					this.$message({
						type: 'success',
						message: error
					});
				});
			}).catch(() => {
				this.$message({
					type: 'info',
					message: '已取消操作'
				});
				console.log('刪除取消的操作');
			});

		}
	}
}
</script>