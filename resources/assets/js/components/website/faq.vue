<template>
	<div>
		<el-tabs v-model="tabsActive" type="card">
			<el-tab-pane label="問題列表" name="first">

						<el-breadcrumb separator-class="el-icon-arrow-right">
							<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
							<el-breadcrumb-item>網站管理</el-breadcrumb-item>
							<el-breadcrumb-item>常見問題</el-breadcrumb-item>
							<el-breadcrumb-item>問題列表</el-breadcrumb-item>
						</el-breadcrumb>
					    <el-row type="flex" align="middle">
					    	<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
								<div class="title--orange">問題列表</div>
					    	</el-col>
					    	<el-col class="u-text-right">
								<el-button type="primary" @click="createQuestionFormVisible = true">新增資料</el-button>
					    	</el-col>
					    </el-row>
						<el-table
							:data="questionData"
							style="width: 100%"
							class="u-text-center">
							<el-table-column
								prop="type"
								label="類別">
							</el-table-column>
							<el-table-column
								prop="title"
								label="標題">
							</el-table-column>
							<el-table-column
								prop="content"
								label="內容">
							</el-table-column>
							<el-table-column
								fixed="right"
								label="操作">
								<template slot-scope="scope">
									<el-button type="text" size="small" @click="editQuestion(scope.row.id, scope.row.type, scope.row.title, scope.row.content)">編輯</el-button>
									<el-button type="text" size="small" @click="delQuestion(scope.row.id)">刪除</el-button>
								</template>
							</el-table-column>
						</el-table>

						<!-- 新增資料視窗 -->
						<el-dialog title="新增資料" :visible.sync="createQuestionFormVisible" center >
							<el-form ref="createQuestionData" label-width="80px">
								<el-form-item label="標題">
									<el-input v-model="createQuestionData.title"></el-input>
								</el-form-item>
								<el-form-item label="類別">
									<el-select v-model="createQuestionData.type" placeholder="請選擇類別">
										<el-option
											v-for="item in questionTypeData"
											:key="item.id"
											:label="item.title"
											:value="item.id">
										</el-option>
									</el-select>
								</el-form-item>
								<el-form-item label="內容">
									<el-input type="textarea" v-model="createQuestionData.content"></el-input>
								</el-form-item>
								<div class="u-text-right">
									<el-button @click="createQuestionFormVisible = false">取 消</el-button>
									<el-button type="primary" @click="createQuestionFormVisible = false">確 定</el-button>
								</div>
							</el-form>
						</el-dialog>

						<!-- 編輯資料視窗 -->
						<el-dialog title="編輯資料" :visible.sync="editQuestionFormVisible" center>
							<el-form ref="editQuestionData" label-width="80px">
								<el-form-item label="標題">
									<el-input v-model="editQuestionData.title"></el-input>
								</el-form-item>
								<el-form-item label="類別">
									<el-select v-model="editQuestionData.type" placeholder="請選擇類別">
										<el-option
											v-for="item in questionTypeData"
											:key="item.id"
											:label="item.title"
											:value="item.id">
										</el-option>
									</el-select>
								</el-form-item>
								<el-form-item label="內容">
									<el-input type="textarea" v-model="editQuestionData.content"></el-input>
								</el-form-item>
								<div class="u-text-right">
									<el-button @click="editQuestionFormVisible = false">取 消</el-button>
									<el-button type="primary" @click="editQuestionFormVisible = false">儲 存</el-button>
								</div>
							</el-form>
						</el-dialog>


			</el-tab-pane>
			<el-tab-pane label="類別管理" name="second">
				<el-breadcrumb separator-class="el-icon-arrow-right">
					<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
					<el-breadcrumb-item>網站管理</el-breadcrumb-item>
					<el-breadcrumb-item>常見問題</el-breadcrumb-item>
					<el-breadcrumb-item>類別管理</el-breadcrumb-item>
				</el-breadcrumb>

				    <el-row type="flex" align="middle">
				    	<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
							<div class="title--orange">類別管理</div>
				    	</el-col>
				    	<el-col class="u-text-right">
							<el-button type="primary" @click="createQuestionTypeFormVisible = true">新增資料</el-button>
				    	</el-col>
				    </el-row>
					<el-table
						:data="questionTypeData"
						style="width: 100%"
						class="u-text-center">
						<el-table-column
							prop="title"
							label="標題">
						</el-table-column>
						<el-table-column
							prop="content"
							label="內容">
						</el-table-column>
						<el-table-column
							fixed="right"
							label="操作">
							<template slot-scope="scope">
								<el-button type="text" size="small" @click="editQuestionType(scope.row.id,  scope.row.title, scope.row.content)">編輯</el-button>
								<el-button type="text" size="small" @click="delQuestionType(scope.row.id)">刪除</el-button>
							</template>
						</el-table-column>
					</el-table>

					<!-- 新增資料視窗 -->
					<el-dialog title="新增資料" :visible.sync="createQuestionTypeFormVisible" center >
						<el-form ref="createQuestionTypeData" label-width="80px">
							<el-form-item label="標題">
								<el-input v-model="createQuestionTypeData.title"></el-input>
							</el-form-item>
							<el-form-item label="內容">
								<el-input type="textarea" v-model="createQuestionTypeData.content"></el-input>
							</el-form-item>
							<div class="u-text-right">
								<el-button @click="createQuestionTypeFormVisible = false">取 消</el-button>
								<el-button type="primary" @click="createQuestionTypeFormVisible = false">確 定</el-button>
							</div>
						</el-form>
					</el-dialog>

					<!-- 編輯資料視窗 -->
					<el-dialog title="編輯資料" :visible.sync="editQuestionTypeFormVisible" center>
						<el-form ref="editQuestionTypeData" label-width="80px">
							<el-form-item label="標題">
								<el-input v-model="editQuestionTypeData.title"></el-input>
							</el-form-item>
							<el-form-item label="內容">
								<el-input type="textarea" v-model="editQuestionTypeData.content"></el-input>
							</el-form-item>
							<div class="u-text-right">
								<el-button @click="editQuestionTypeFormVisible = false">取 消</el-button>
								<el-button type="primary" @click="editQuestionTypeFormVisible = false">儲 存</el-button>
							</div>
						</el-form>
					</el-dialog>


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
			// 常見問題新增
			createQuestionFormVisible: false,
			createQuestionData:{
				type:'',
				title:'',
				content:''
			},
			// 常見問題編輯
			editQuestionFormVisible: false,
			editQuestionData:{
				id:'',
				type:'',
				title:'',
				content:''
			},
			// 常見問題類別新增
			createQuestionTypeFormVisible: false,
			createQuestionTypeData:{
				title:'',
				content:''
			},
			// 常見問題類別編輯
			editQuestionTypeFormVisible: false,
			editQuestionTypeData:{
				id:'',
				title:'',
				content:''
			},
			// 問題列表
			questionData: [{
				id:'1',
				type: '1',
				title: '為什麼送出配對後會有10分鐘與20分鐘的等待時間？',
				content: '旅客設定完條件送出配對後，所有符合條件的業者將會收到通知並於10分鐘內回覆，10分鐘結束後旅客將有2...',
			}, {
				id:'2',
				type: '2',
				title: '手機開啟閃退無法使用？',
				content: '依照手機型號，可至APP Store 商店直接下載最新APP ；若遇到手機無法操作之問題，可透過線上...',
			}, {
				id:'3',
				type: '3',
				title: '按送出後沒有反應？無法回復房源？',
				content: '您好，感謝您的反應，再次跟您確認您是否有點選其他訂單回覆成功，若您已經有回覆其他房源，在此情況下，有...',
			}, {
				id:'4',
				type: '2',
				title: '邀請碼能在登入後再輸入嗎？',
				content: '非常抱歉！邀請碼必須在您邀請好友時，在註冊頁面輸入邀請碼。',
			}],
			// 類別列表
			questionTypeData: [{
				id:'1',
				title: '常見操作問題',
				content: '手機常見操作問題，讓你一次找解答！',
			}, {
				id:'2',
				title: '常見註冊問題',
				content: '註冊相關問題',
			}, {
				id:'3',
				title: '回饋紅利問題',
				content: '常見紅利問題',
			}],
		}
	},
	methods: {
		editQuestion(id, type, title, content){
			this.editQuestionData.id = '';
			this.editQuestionData.type = '';
			this.editQuestionData.title = '';
			this.editQuestionData.content = '';
			this.editQuestionData.id = id;
			this.editQuestionData.type = type;
			this.editQuestionData.title = title;
			this.editQuestionData.content = content;
			this.editQuestionFormVisible = true
		},
		delQuestion(id){
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
		},		
		editQuestionType(id, title, content){
			this.editQuestionTypeData.id = '';
			this.editQuestionTypeData.title = '';
			this.editQuestionTypeData.content = '';
			this.editQuestionTypeData.id = id;
			this.editQuestionTypeData.title = title;
			this.editQuestionTypeData.content = content;
			this.editQuestionTypeFormVisible = true
		},
		delQuestionType(id){
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