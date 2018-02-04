<template>
	<div>
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>經費作業</el-breadcrumb-item>
			<el-breadcrumb-item :to="{ path: '/funding' }">個人經費申請</el-breadcrumb-item>
			<el-breadcrumb-item>編輯經費({{ $route.params.id }})</el-breadcrumb-item>
		</el-breadcrumb>
		<el-row type="flex" align="middle">
			<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
				<div class="title--orange">編輯經費</div>
			</el-col>
		</el-row>

		<el-row type="flex" align="middle">
			<el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}">
				<el-steps :active="fungingData.status" align-center finish-status="success">
					<el-step title="編輯經費"></el-step>
					<el-step title="經費審核"></el-step>
					<el-step title="審核完成"></el-step>
				</el-steps>
			</el-col>
		</el-row>
		<el-row type="flex" align="middle">
			<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
				<div class="title--blue">申請摘要</div>
			</el-col>
		</el-row>
		<el-row type="flex" align="middle">
			<el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}">
				<el-form ref="fungingData" :model="fungingData" label-width="80px">
					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 12, offset: 0}" style="height: 62px;">
						<el-form-item label="申請名稱">
							<el-input v-model="fungingData.title"></el-input>
						</el-form-item>
					</el-col>
					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 12, offset: 0}">
						<el-form-item label="申請編號">
							<el-input v-model="fungingData.serial_number"></el-input>
						</el-form-item>
					</el-col>
					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 12, offset: 0}">
						<el-form-item label="開始日期">
							<el-date-picker type="date" placeholder="選擇日期" v-model="fungingData.date_start" value-format="yyyy-MM-dd" style="width: 100%;"></el-date-picker>
						</el-form-item>
					</el-col>
					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 12, offset: 0}">
						<el-form-item label="結束日期">
							<el-date-picker type="date" placeholder="選擇日期" v-model="fungingData.date_end" value-format="yyyy-MM-dd"  style="width: 100%;"></el-date-picker>
						</el-form-item>
					</el-col>
					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}">
						<el-form-item label="備註說明">
							<el-input type="textarea" v-model="fungingData.content"></el-input>
						</el-form-item>
					</el-col>
					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}">
						<el-row type="flex" align="middle">
							<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
								<div class="title--blue">申請項目</div>
							</el-col>	    	
							<el-col class="u-text-right">
								<el-button type="primary" @click="addItem">新增項目</el-button>
							</el-col>
						</el-row>
					</el-col>
					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}" v-if="fungingData.items">
						<div  v-for="(item, index) in fungingData.items" class="funding__dynamic__row">
							<el-row :gutter="10">
								<el-col :xs="{span: 12, offset: 0}" :sm="{span: 4, offset: 0}">
									<el-input v-model="item.title" placeholder="項目名稱"></el-input>
								</el-col>
								<el-col :xs="{span: 12, offset: 0}" :sm="{span: 4, offset: 0}">
									<el-date-picker type="date" v-model="item.date" value-format="yyyy-MM-dd" style="width: 100%;" placeholder="消費日期"></el-date-picker>
								</el-col>
								<el-col :xs="{span: 12, offset: 0}" :sm="{span: 4, offset: 0}">
									<el-input v-model="item.invoice" placeholder="發票號碼"></el-input>
								</el-col>
								<el-col :xs="{span: 12, offset: 0}" :sm="{span: 4, offset: 0}">
									<el-input v-model="item.amount" placeholder="發票金額"></el-input>
								</el-col>
								<el-col :xs="{span: 12, offset: 0}" :sm="{span: 4, offset: 0}">
									<el-select v-model="item.compiled" placeholder="是否打統編" style="width: 100%;">
										<el-option label="是，有打統編" value="true"></el-option>
										<el-option label="否，沒打統編" value="false"></el-option>
									</el-select>
								</el-col>
								<el-col :xs="{span: 12, offset: 0}" :sm="{span: 4, offset: 0}">
									<div class="u-text-right">
										<el-button @click.prevent="removeItem(item)" type="warning" plain style="width: 100%;">删除</el-button>
									</div>
								</el-col>
							</el-row>
						</div>
					</el-col>

					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 8, offset: 16}" :md="{span: 6, offset: 18}" :lg="{span: 4, offset: 20}">
						<el-row type="flex" align="middle">
							<el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}">
								<span class="title--blue">金額總計</span>
								<span class="funding__total">NT. {{ funding_total }} </span>
							</el-col>
						</el-row>
					</el-col>

					<el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}" v-if="fungingData.status == 0">
						<el-form-item>
							<div class="u-text-right u-mt-24">
								<el-button type="success" @click="saveFundingData()">儲存資料</el-button>
								<el-button type="primary" @click="sendFundingData()">送出申請</el-button>
							</div>
						</el-form-item>
					</el-col>
				</el-form>
			</el-col>
		</el-row>
	</div>
</template>

<script>
export default {
	data() {
		return {
			fungingData: {
				id: null,
				serial_number: null,
				title: null,
				content: null,
				date_start: null,
				date_end: null,
				total: null,
				items_count: null,
				status: null,
				business: null,
				apply_date: null,
				created_at: null,
				updated_at: null,
				status: 0,
				items:[]
			},
		}
	},  
	computed: {
		funding_total: function () {
			var funding_total = Number(0);
			if (this.fungingData.items[0] !== null) {
				this.fungingData.items.forEach(function(element) {
					funding_total += Number(element.amount)
				});
				this.fungingData.total = funding_total;
				return funding_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}else{
				return 0;
			}
		}
	},
	created: function () {
		this.getFundingData();
	}, 
	mounted: function(){
	},
	methods: {
		getFundingData(){
			Vue.axios.get('/api/funding/'+this.$route.params.id )			
			.then(response=>{
				this.fungingData = response.data
			})
			.catch(function (error) {
				console.log('error_getFundingData');
			});
		},
		saveFundingData(){
			Vue.axios.patch('/api/funding/'+this.$route.params.id, {
				serial_number: this.fungingData.serial_number,
				title: this.fungingData.title,
				content: this.fungingData.content,
				date_start: this.fungingData.date_start,
				date_end: this.fungingData.date_end,
				total: this.fungingData.total,
				status: this.fungingData.status,
				apply_date: this.fungingData.apply_date,
				items: this.fungingData.items,
			})
			.then(response=>{
				this.$message({
					message: '已成功儲存資料',
					type: 'success'
				});
			})
			.catch(function (error) {
				console.log('error_saveFundingData');
			});
		},
		sendFundingData(){
			Vue.axios.patch('/api/funding/'+this.$route.params.id, {
				serial_number: this.fungingData.serial_number,
				title: this.fungingData.title,
				content: this.fungingData.content,
				date_start: this.fungingData.date_start,
				date_end: this.fungingData.date_end,
				total: this.fungingData.total,
				status: 1,
				apply_date: new Date().toJSON().slice(0,10).replace(/-/g,'/'),
				items: this.fungingData.items,
			})
			.then(response=>{
				this.getFundingData();
				this.$message({
					message: '已成功提交審核',
					type: 'success'
				});
			})
			.catch(function (error) {
				console.log('error_sendFundingData');
			});
		},
		removeItem(item) {
			var index = this.fungingData.items.indexOf(item)
			if (index !== -1) {
				this.fungingData.items.splice(index, 1)
			}
		},
		addItem() {
			this.fungingData.items.push({
				id: null,
				serial_number: this.fungingData.serial_number,
				title: null,
				date: null,
				invoice: null,
				amount: null, 
				compiled: null
			});
		}
	}
}
</script>

