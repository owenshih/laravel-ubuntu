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
				prop="apply_serial"
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
			</el-table-column>
			<el-table-column
				prop="total"
				label="申請總額">
			</el-table-column>
			<el-table-column
				fixed="right"
				label="操作">
				<template slot-scope="scope">
					<el-button type="text" size="small" :to="{ path: '/' }">編輯</el-button>
					<el-button type="text" size="small" @click="del(scope.row.apply_serial)">刪除</el-button>
				</template>
			</el-table-column>
		</el-table>
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
					<el-button type="primary" @click="createFormVisible = false">確 定</el-button>
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
			fundingData:[
				{
					apply_serial: '1499678131559',
					apply_date: '2017-07-11',
					title: '傻瓜第一季',
					status: '申請審核中',
					total: '53170'
				},{
					apply_serial: '1499678131540',
					apply_date: '2017-07-15',
					title: '賀凱八七季',
					status: '申請審核中',
					total: '53170'
				},
			]
		}
	},
	methods: {
		del(id){
			this.$confirm('此操作將刪除該筆資料，確定嗎?', '提示', {
				confirmButtonText: '確定',
				cancelButtonText: '取消',
				type: 'warning'
			}).then(() => {
				this.$message({
					type: 'success',
					message: '刪除成功'
				});
				console.log('刪除成功的操作');
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