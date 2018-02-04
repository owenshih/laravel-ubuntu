<template>
	<div>
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>網站管理</el-breadcrumb-item>
			<el-breadcrumb-item>業者專區</el-breadcrumb-item>
		</el-breadcrumb>
	    <el-row type="flex" align="middle">
	    	<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
				<div class="title--orange">業者專區</div>
	    	</el-col>
	    	<el-col class="u-text-right">
				<el-button type="primary" @click="createFormVisible = true">新增資料</el-button>
	    	</el-col>
	    </el-row>
		<el-table
			:data="tableData"
			style="width: 100%"
			class="u-text-center">
			<el-table-column
				prop="title"
				label="標題">
			</el-table-column>
			<el-table-column
				prop="date_start"
				label="開始時間">
			</el-table-column>
			<el-table-column
				prop="date_end"
				label="結束時間">
			</el-table-column>
			<el-table-column
				fixed="right"
				label="操作">
				<template slot-scope="scope">
					<el-button type="text" size="small" @click="edit(scope.row.id, scope.row.title, scope.row.content, scope.row.date_start, scope.row.date_end)">編輯</el-button>
					<el-button type="text" size="small" @click="del(scope.row.id)">刪除</el-button>
				</template>
			</el-table-column>
		</el-table>

		<!-- 新增資料視窗 -->
		<el-dialog title="新增資料" :visible.sync="createFormVisible" center >
			<el-form ref="createDate" label-width="80px">
				<el-form-item label="標題">
					<el-input v-model="createDate.title"></el-input>
				</el-form-item>
				<el-form-item label="內容">
					<el-input type="textarea" v-model="createDate.content"></el-input>
				</el-form-item>
				<el-form-item label="開始時間">
					<el-date-picker type="date" placeholder="選擇日期" v-model="createDate.date_start" style="width: 100%;"></el-date-picker>
				</el-form-item>
				<el-form-item label="結束時間">
					<el-date-picker type="date" placeholder="選擇日期" v-model="createDate.date_end" style="width: 100%;" ></el-date-picker>
				</el-form-item>
				<div class="u-text-right">
					<el-button @click="createFormVisible = false">取 消</el-button>
					<el-button type="primary" @click="createFormVisible = false">確 定</el-button>
				</div>
			</el-form>
		</el-dialog>

		<!-- 編輯資料視窗 -->
		<el-dialog title="編輯資料" :visible.sync="editFormVisible" center>
			<el-form ref="editDate" label-width="80px">
				<el-form-item label="標題">
					<el-input v-model="editDate.title"></el-input>
				</el-form-item>
				<el-form-item label="內容">
					<el-input type="textarea" v-model="editDate.content"></el-input>
				</el-form-item>
				<el-form-item label="開始時間">
					<el-date-picker type="date" placeholder="選擇日期" v-model="editDate.date_start" style="width: 100%;"></el-date-picker>
				</el-form-item>
				<el-form-item label="結束時間">
					<el-date-picker type="date" placeholder="選擇日期" v-model="editDate.date_end" style="width: 100%;"></el-date-picker>
				</el-form-item>
				<div class="u-text-right">
					<el-button @click="editFormVisible = false">取 消</el-button>
					<el-button type="primary" @click="editFormVisible = false">儲 存</el-button>
				</div>
			</el-form>
		</el-dialog>
    </div>
</template>

<script>
export default {
    data() {
		return {
        	createFormVisible: false,
        	createDate:{
        		title:'',
        		content:'',
        		date_start:'',
        		date_end:''
        	},
        	editFormVisible: false,
        	editDate:{
        		id:'',
        		title:'',
        		content:'',
        		date_start:'',
        		date_end:''
        	},
			tableData: [{
				id:'1',
				title: '測試A',
				content: '內容',
				date_start: '2017-01-01',
				date_end: '2017-01-02'
			}, {
				id:'2',
				title: '測試B',
				content: '內容',
				date_start: '2017-01-01',
				date_end: '2017-01-02'
			}, {
				id:'3',
				title: '測試C',
				content: '內容',
				date_start: '2017-01-01',
				date_end: '2017-01-02'
			}, {
				id:'4',
				title: '測試D',
				content: '內容',
				date_start: '2017-01-01',
				date_end: '2017-01-02'
			}]
		}
	},
	methods: {
		edit(id, title, content, date_start, date_end){
			this.editDate.id = '';
			this.editDate.title = '';
			this.editDate.content = '';
			this.editDate.date_start = '';
			this.editDate.date_end = '';
			this.editDate.id = id;
			this.editDate.title = title;
			this.editDate.date_start = date_start;
			this.editDate.content = content;
			this.editDate.date_end = date_end;
			this.editFormVisible = true
		},
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