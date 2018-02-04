<template>
	<div>
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>業務專區</el-breadcrumb-item>
			<el-breadcrumb-item>建立新回報</el-breadcrumb-item>
		</el-breadcrumb>
		<div class="title--orange">建立新回報</div>
		<el-form ref="form" :model="form" label-width="80px">
			<el-col :xs="24" :sm="24">
				<div class="title--blue">旅宿資料</div>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="旅宿帳號">
					<el-input v-model="form.account_number"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="登入方式">
					<el-select v-model="form.account_type" placeholder="請選擇" style="width: 100%;">
						<el-option label="一般" value="normal"></el-option>
						<el-option label="Facebook" value="facebook"></el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="中文名稱">
					<el-input v-model="form.chinese_name"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="旅宿型別">
					<el-select v-model="form.type" placeholder="請選擇" style="width: 100%;">
						<el-option label="B&B" value="bnb"></el-option>
						<el-option label="背包客棧" value="back"></el-option>
						<el-option label="一星級" value="1"></el-option>
						<el-option label="二星級" value="2"></el-option>
						<el-option label="三星級" value="3"></el-option>
						<el-option label="四星級" value="4"></el-option>
						<el-option label="五星級" value="5"></el-option>
						<el-option label="無星級判別" value="0"></el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="6">
				<el-form-item label="縣市">
					<el-select v-model="form.city" placeholder="請選擇" style="width: 100%;">
						<el-option label="台北縣" value="1"></el-option>
						<el-option label="台北市" value="2"></el-option>
						<el-option label="桃園縣" value="3"></el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="6">
				<el-form-item label="區域">
					<el-select v-model="form.town" placeholder="請選擇" style="width: 100%;">
						<el-option label="區域1" value="1"></el-option>
						<el-option label="區域2" value="2"></el-option>
						<el-option label="區域3" value="3"></el-option>
					</el-select>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="地址">
					<el-input v-model="form.address"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="電話">
					<el-input v-model="form.phone"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="傳真">
					<el-input v-model="form.fax"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="官方網站">
					<el-input v-model="form.website"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="Facebook">
					<el-input v-model="form.facebook"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="24">
				<div class="title--blue">負責人資料</div>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="姓名">
					<el-input v-model="form.main_name"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="職稱">
					<el-input v-model="form.main_title"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="電話">
					<el-input v-model="form.main_tel"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="手機">
					<el-input v-model="form.main_phone"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="傳真">
					<el-input v-model="form.main_fax"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="E-MAIL">
					<el-input v-model="form.main_email"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="24">
				<div class="title--blue">管理人資料</div>
				<el-checkbox v-model="main_equal_admin" @change="mainEqualAdmin" class="u-ml-16">與負責人資料相同</el-checkbox>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="姓名">
					<el-input v-model="form.admin_name"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="職稱">
					<el-input v-model="form.admin_title"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="電話">
					<el-input v-model="form.admin_tel"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="手機">
					<el-input v-model="form.admin_phone"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="傳真">
					<el-input v-model="form.admin_fax"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="24" :sm="12">
				<el-form-item label="E-MAIL">
					<el-input v-model="form.admin_email"></el-input>
				</el-form-item>
			</el-col>
			<el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}">
				<el-form-item>
					<div class="u-text-right u-mt-24">
						<el-button type="success" @click="add">新增旅宿資料</el-button>
					</div>
				</el-form-item>
			</el-col>
		</el-form>
	</div>
</template>


<script>
export default {
	data() {
		return {
			// 負責人與管理人相同
			main_equal_admin: false,
			// 表格資料綁定
			form:{
				account_number: '',
				account_type: '',
				chinese_name: '',
				engilsh_name: '',
				type: '',
				postal: '',
				city: '',
				town: '',
				address: '',
				map_api_lat: '',
				map_api_lng: '',
				phone: '',
				fax: '',
				website: '',
				facebook: '',
				main_name: '',
				main_title: '',
				main_tel: '',
				main_phone: '',
				main_fax: '',
				main_email: '',
				admin_name: '',
				admin_title: '',
				admin_tel: '',
				admin_phone: '',
				admin_fax: '',
				admin_email: '',
				bank_name: '',
				bank_branch: '',
				bank_account: '',
				bank_title: '',
				pay_type: '',
				invoice_number: '',
				invoice_title: '',
				status: '',
				signing_date: '',
				signing_business: '',
				e_contract: '',
				p_contract: '',
				dev_level: '',
			}
		}
	},
	methods: {
		mainEqualAdmin(){
			if(this.main_equal_admin == true){
				this.form.admin_name = this.form.main_name;
				this.form.admin_title = this.form.main_title;
				this.form.admin_tel = this.form.main_tel;
				this.form.admin_phone = this.form.main_phone;
				this.form.admin_fax = this.form.main_fax;
				this.form.admin_email = this.form.main_email;
			}
		},
		add(){
			this.$confirm('旅宿資料新增完成後會自動加入個人追蹤清單', '提示', {
				confirmButtonText: '確定',
				type: 'warning'
			}).then(() => {
				this.$message({
					type: 'success',
					message: '確認操作'
				});
				console.log('確認操作');
			}).catch(() => {
				this.$message({
					type: 'info',
					message: '放棄操作'
				});
				console.log('放棄操作');
			});
		}
	}
}
</script>