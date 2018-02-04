<template>
	<div>
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>經費作業</el-breadcrumb-item>
			<el-breadcrumb-item>行政管理作業</el-breadcrumb-item>
		</el-breadcrumb>
		<div class="title--orange">會計管理作業</div>
		<el-tabs v-model="tabsActive" type="card">
			<!-- ___________________________尚未審核___________________________ -->
			<el-tab-pane label="尚未審核" name="first">
				<el-table
					:data="notReviewedFundingsDatas"
					style="width: 100%"
					class="u-text-center">
					<el-table-column
						prop="apply_date"
						label="申請日期">
					</el-table-column>
					<el-table-column
						prop="business"
						label="申請業務">
					</el-table-column>
					<el-table-column
						prop="title"
						label="申請名稱">
					</el-table-column>
					<el-table-column
						prop="total"
						label="申請金額">
					</el-table-column>
					<el-table-column
						prop="status"
						label="狀態">
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
						fixed="right"
						label="操作">
						<template slot-scope="scope">
							<router-link :to="{ name: 'funding.edit', params: { id: scope.row.id } }  "><el-button type="text" size="small">查看資料</el-button></router-link>
						</template>
					</el-table-column>
				</el-table>
				<div class="block u-text-right">
					<el-pagination
						@current-change="getNotReviewedFundingDatas"
						layout="prev, pager, next"
						:total="notReviewedFundingTotel">
					</el-pagination>
				</div>
			</el-tab-pane>
			<!-- ___________________________申請列表___________________________ -->
			<el-tab-pane label="申請列表" name="second">
				<!-- 搜尋 -->
				<el-col :xs="24" :sm="24">
					<div class="title--blue">搜尋申請項目</div>
				</el-col>
				<el-form ref="inquireFundingData" :model="inquireFundingData" label-width="80px">
					<el-col :xs="12" :sm="8" :lg="4">
						<el-form-item label="申請姓名">
							<el-select v-model="inquireFundingData.business" placeholder="請選擇" clearable style="width:100%;">
								<el-option
									v-for="item in business"
									:key="item.business_id"
									:label="item.name"
									:value="item.business_id">
								</el-option>
							</el-select>
						</el-form-item>
					</el-col>
					<el-col :xs="12" :sm="8" :lg="4">
						<el-form-item label="申請名稱">
							<el-input v-model="inquireFundingData.title"></el-input>
						</el-form-item>
					</el-col>
					<el-col :xs="12" :sm="8" :lg="4">
						<el-form-item label="申請編號">
							<el-input v-model="inquireFundingData.apply_serial"></el-input>
						</el-form-item>
					</el-col>
					<el-col :xs="12" :sm="8" :lg="4">
						<el-form-item label="申請日期">
							<el-date-picker type="date" placeholder="申請日期" v-model="inquireFundingData.apply_date" style="width: 100%;"></el-date-picker>
						</el-form-item>
					</el-col>
					<el-col :xs="12" :sm="8" :lg="4">
						<el-form-item label="狀態">
							<el-select v-model="inquireFundingData.status" placeholder="請選擇" clearable style="width:100%;">
								<el-option label="編輯經費" value="0"></el-option>
								<el-option label="經費審核中" value="1"></el-option>
								<el-option label="審核完成" value="3"></el-option>
								<el-option label="撥款完成" value="4"></el-option>
							</el-select>
						</el-form-item>
					</el-col>
					<el-col :xs="12" :sm="8" :lg="4">
						<el-form-item>
							<el-button type="primary" style="width:100%;" @click="getFundingDatas(1)">搜 尋</el-button>
						</el-form-item>
					</el-col>
				</el-form>
				<!-- 列表 -->
				<el-col :xs="24" :sm="24">
					<div class="title--blue">申請列表</div>
				</el-col>
				<el-table
					:data="FundingsDatas"
					style="width: 100%"
					class="u-text-center">
					<el-table-column
						prop="apply_date"
						label="申請日期">
					</el-table-column>
					<el-table-column
						prop="business"
						label="申請業務">
					</el-table-column>
					<el-table-column
						prop="title"
						label="申請名稱">
					</el-table-column>
					<el-table-column
						prop="total"
						label="申請金額">
					</el-table-column>
					<el-table-column
						prop="status"
						label="狀態">
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
						fixed="right"
						label="操作">
						<template slot-scope="scope">
							<router-link :to="{ name: 'funding.edit', params: { id: scope.row.id } }  "><el-button type="text" size="small">查看資料</el-button></router-link>
						</template>
					</el-table-column>
				</el-table>
				<div class="block u-text-right">
					<el-pagination
						@current-change="getFundingDatas"
						layout="prev, pager, next"
						:total="FundingTotel">
					</el-pagination>
				</div>
			</el-tab-pane>
		</el-tabs>
	</div>
</template>

<script>
export default {
	data() {
		return {
			// 頁籤初始設定
			tabsActive: 'first',
			// 搜尋條件
			inquireFundingData:{
				title: '',
				apply_serial: '',
				apply_date: '',
				business: '',
				status: ''
			},
			// 員工列表
			business: [
				{id: 1, business_id: '000', name: '施賀凱 Owen'},
				{id: 2, business_id: '001', name: '施賀凱1 Owen1'},
				{id: 3, business_id: '002', name: '施賀凱2 Owen2'}
			],
			// 尚未審核申請列表
			notReviewedFundingsDatas:[],
			// 未審核列表總數
			notReviewedFundingTotel: 0,
			// 申請列表
			FundingsDatas:[],
			// 申請列表總數
			FundingTotel: 0,
		}
	},
	created: function () {
		this.getNotReviewedFundingDatas(1);
		this.getFundingDatas(1);
	}, 
	methods: {
		getNotReviewedFundingDatas(index){
			Vue.axios.get('/api/funding', {
				params: {
					page: index, 
					status: 1
				}
			})
			.then(response=>{
            	this.currentPage = response.data.current_page
            	this.notReviewedFundingTotel = response.data.total
            	this.notReviewedFundingsDatas = response.data.data
			})
			.catch(function (error) {
				console.log('error');
			});
		},
		getFundingDatas(index){
			Vue.axios.get('/api/funding', {
				params: {
					page: index, 
					title: this.inquireFundingData.title, 
					apply_serial: this.inquireFundingData.apply_serial, 
					apply_date: this.inquireFundingData.apply_date, 
					business: this.inquireFundingData.business, 
					status: this.inquireFundingData.status, 
				}
			})
			.then(response=>{
            	this.currentPage = response.data.current_page
            	this.FundingTotel = response.data.total
            	this.FundingsDatas = response.data.data
			})
			.catch(function (error) {
				console.log('error');
			});
		},
	}
}
</script>