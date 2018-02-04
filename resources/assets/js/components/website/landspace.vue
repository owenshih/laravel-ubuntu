<template>
	<div>
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>網站管理</el-breadcrumb-item>
			<el-breadcrumb-item>台灣之美</el-breadcrumb-item>
		</el-breadcrumb>
	    <el-row type="flex" align="middle">
	    	<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
				<div class="title--orange">台灣之美</div>
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
				prop="image"
				label="圖片">
				<template slot-scope="scope" >
					<div class="table__image__wrapper">
						<img :src="scope.row.image" :alt="scope.row.title">
					</div>
				</template>
			</el-table-column>
			<el-table-column
				prop="title"
				label="標題">
			</el-table-column>
			<el-table-column
				fixed="right"
				label="操作">
				<template slot-scope="scope">
					<el-button type="text" size="small" @click="edit(scope.row.id, scope.row.title, scope.row.image, scope.row.link)">編輯</el-button>
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
				<el-form-item label="圖片網址">
					<el-input v-model="createDate.iamge"></el-input>
				</el-form-item>
				<el-form-item label="連結網址">
					<el-input v-model="createDate.link"></el-input>
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
				<el-form-item label="圖片網址">
					<el-input v-model="editDate.image"></el-input>
				</el-form-item>
				<el-form-item label="連結網址">
					<el-input v-model="editDate.link"></el-input>
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
        		image:'',
        		link:''
        	},
        	editFormVisible: false,
        	editDate:{
        		id:'',
        		title:'',
        		image:'',
        		link:''
        	},
			tableData: [{
				id:'1',
				title: '測試A',
				image: 'https://firebasestorage.googleapis.com/v0/b/tripmatchwebsite.appspot.com/o/img%2Ftrip05%20(1).png?alt=media&token=731a240e-df1d-4bf7-8b69-23f43c21fe03',
				link: 'https://www.tripmatch.com.tw'
			}, {
				id:'2',
				title: '測試B',
				image: 'https://firebasestorage.googleapis.com/v0/b/tripmatchwebsite.appspot.com/o/img%2Ftrip05%20(1).png?alt=media&token=731a240e-df1d-4bf7-8b69-23f43c21fe03',
				link: 'https://www.tripmatch.com.tw'
			}, {
				id:'3',
				title: '測試C',
				image: 'https://firebasestorage.googleapis.com/v0/b/tripmatchwebsite.appspot.com/o/img%2Ftrip05%20(1).png?alt=media&token=731a240e-df1d-4bf7-8b69-23f43c21fe03',
				link: 'https://www.tripmatch.com.tw'
			}, {
				id:'4',
				title: '測試D',
				image: 'https://firebasestorage.googleapis.com/v0/b/tripmatchwebsite.appspot.com/o/img%2Ftrip05%20(1).png?alt=media&token=731a240e-df1d-4bf7-8b69-23f43c21fe03',
				link: 'https://www.tripmatch.com.tw'
			}]
		}
	},
	methods: {
		edit(id, title, image, link){
			this.editDate.id = '';
			this.editDate.title = '';
			this.editDate.image = '';
			this.editDate.link = '#!';
			this.editDate.id = id;
			this.editDate.title = title;
			this.editDate.image = image;
			this.editDate.link = link;
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