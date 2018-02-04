<template>
	<div>
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>旅宿業者</el-breadcrumb-item>
			<el-breadcrumb-item>合作旅宿列表</el-breadcrumb-item>
		</el-breadcrumb>
		<el-row type="flex" align="middle">
			<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
				<div class="title--orange">合作旅宿列表</div>
			</el-col>
		</el-row>
		<!-- 搜尋 -->
		<el-col :xs="24" :sm="24">
			<div class="title--blue">搜尋旅宿</div>
		</el-col>
		<el-form ref="inquireData" :model="inquireData" label-width="80px">
			<el-col :xs="12" :sm="8" :lg="5">
				<el-form-item label="旅宿名稱">
					<el-input v-model="inquireData.chinese_name"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="5">
				<el-form-item label="業者帳號">
					<el-input v-model="inquireData.account_number"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="5">
				<el-form-item label="縣市">
					<el-select v-model="inquireData.city" placeholder="請選擇" clearable style="width:100%;">
						<el-option label="縣市1" value="0"></el-option>
						<el-option label="縣市2" value="1"></el-option>
						<el-option label="縣市3" value="2"></el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="5">
				<el-form-item label="區域">
					<el-select v-model="inquireData.town" placeholder="請選擇" clearable style="width:100%;">
						<el-option label="區域1" value="0"></el-option>
						<el-option label="區域2" value="1"></el-option>
						<el-option label="區域3" value="2"></el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="12" :sm="8" :lg="4">
				<el-form-item>
					<el-button type="primary" style="width:100%;">搜 尋</el-button>
				</el-form-item>
			</el-col>
		</el-form>
		<!-- 列表 -->
		<el-col :xs="24" :sm="24">
			<div class="title--blue">旅宿列表</div>
		</el-col>
		<el-table
			:data="fundingData"
			style="width: 100%"
			class="u-text-center">
			<el-table-column
				prop="city"
				label="縣市">
			</el-table-column>
			<el-table-column
				prop="town"
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
				fixed="right"
				label="操作">
				<template slot-scope="scope">
					<router-link :to="{ name: 'hotel.edit', params: { id: scope.row.id } }  "><el-button type="text" size="small">編輯</el-button></router-link>
				</template>
			</el-table-column>
		</el-table>
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
			},
			fundingData:[
				{
					id: 1,
					city: '台中市',
					town: '南區',
					chinese_name: '賀凱大旅宿',
					tel: '0911305645',
				}
			]
		}
	},
	methods: {
	}
}
</script>