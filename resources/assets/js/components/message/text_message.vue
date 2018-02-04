<template>
    <div>
        <!-- 麵包屑開始 -->
        <el-breadcrumb separator-class="el-icon-arrow-right">
            <el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
            <el-breadcrumb-item>簡訊郵件</el-breadcrumb-item>
            <el-breadcrumb-item>簡訊管理</el-breadcrumb-item>
        </el-breadcrumb>
        <!-- 麵包屑結束 -->
        <!-- 標題開始 -->
        <el-row type="flex" align="middle">
            <el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
                <div class="title--orange">簡訊管理</div>
            </el-col>
        </el-row>
        <!-- 標題欄結束 -->
        <el-tabs v-model="tabsActive" type="card">
            <el-tab-pane label="簡訊發送" name="first">
                <!-- 標題開始 -->
                <el-row type="flex" align="middle">
                    <el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
                        <div class="title--blue">簡訊發送</div>
                    </el-col>
                </el-row>
                <!-- 標題欄結束 -->
                <!-- 內容開始 -->
                <el-row type="flex" align="middle">
                    <!-- 發送區 -->
                    <el-col :xs="{span: 24, offset: 0}" :md="{span: 24, offset: 0}">
                        <el-form ref="new_text_message" :model="new_text_message" label-width="80px">
                            <el-form-item label="簡訊餘額">
                                <p>{{messageQuota}}</p>
                            </el-form-item>
                            <el-form-item label="使用範本">
                                <el-select v-model="choose_template_value" placeholder="請選擇" @change="choose_template">
                                    <el-option
                                            v-for="item in templateDatas"
                                            :key="item.id"
                                            :label="item.title"
                                            :value="item.content">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="電話號碼">
                                <el-input v-model="new_text_message.phone"></el-input>
                            </el-form-item>
                            <el-form-item label="簡訊標題">
                                <el-input v-model="new_text_message.title"></el-input>
                            </el-form-item>
                            <el-form-item label="內容">
                                <el-input type="textarea" :autosize="{ minRows: 5 }"
                                          v-model="new_text_message.content"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <div class="u-text-right">
                                    <el-button type="primary" @click="sentMessage">發 送</el-button>
                                </div>
                            </el-form-item>
                        </el-form>
                    </el-col>
                </el-row>
                <!-- 內容結束 -->
            </el-tab-pane>
            <el-tab-pane label="傳送紀錄" name="second">
                <!-- 標題開始 -->
                <el-row type="flex" align="middle">
                    <el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
                        <div class="title--blue">傳送紀錄</div>
                    </el-col>
                </el-row>
                <!-- 標題欄結束 -->
                <!-- 內容開始 -->
                <template>
                    <el-table
                            :data="historyDatas"
                            style="width: 100%">
                        <el-table-column type="expand">
                            <template slot-scope="scope">
                                <el-form label-position="left" inline class="demo-table-expand">
                                    <el-form-item label="標題">
                                        <span>{{ scope.row.title }}</span>
                                    </el-form-item>
                                    <el-form-item label="收件者">
                                        <span>{{ scope.row.phone }}</span>
                                    </el-form-item>
                                    <el-form-item label="發送者">
                                        <span>{{ scope.row.business }}</span>
                                    </el-form-item>
                                    <el-form-item label="發送時間">
                                        <span>{{ scope.row.updated_at }}</span>
                                    </el-form-item>
                                    <el-form-item label="回傳代碼">
                                        <span>{{ scope.row.response }}</span>
                                    </el-form-item>
                                    <el-form-item label="發送狀態">
                                        <span>{{ scope.row.response_c }}</span>
                                    </el-form-item>
                                    <el-form-item label="簡訊內容">
                                        <span>{{ scope.row.content }}</span>
                                    </el-form-item>
                                </el-form>
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="收件人"
                                prop="phone">
                        </el-table-column>
                        <el-table-column
                                label="標題"
                                prop="title">
                        </el-table-column>
                        <el-table-column
                                label="狀態"
                                prop="response_c">
                        </el-table-column>
                    </el-table>
                </template>
                <div class="block u-text-right">
                    <el-pagination
                            @current-change="getHistoryDatas"
                            layout="prev, pager, next"
                            :total="historyTotal">
                    </el-pagination>
                </div>
                <!-- 內容結束 -->
            </el-tab-pane>
            <el-tab-pane label="編輯範本" name="third">
                <!-- 標題開始 -->
                <el-row type="flex" align="middle">
                    <el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
                        <div class="title--blue">編輯範本</div>
                    </el-col>
                    <el-col class="u-text-right">
                        <el-button type="primary" @click="createFormVisible = true">新增範本</el-button>
                    </el-col>
                </el-row>
                <!-- 標題欄結束 -->
                <!-- 內容開始 -->
                <el-table
                        :data="templateDatas"
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
                            <el-button type="text" size="small"
                                       @click="editTemplate(scope.row.id, scope.row.title, scope.row.content)">編輯
                            </el-button>
                            <el-button type="text" size="small" @click="delTemplate(scope.row.id)">刪除</el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <!-- 新增資料視窗 -->
                <el-dialog title="新增資料" :visible.sync="createFormVisible" center>
                    <el-form ref="createTemplateData" label-width="80px">
                        <el-form-item label="標題">
                            <el-input v-model="createTemplateData.title"></el-input>
                        </el-form-item>
                        <el-form-item label="內容">
                            <el-input type="textarea" v-model="createTemplateData.content"></el-input>
                        </el-form-item>
                        <div class="u-text-right">
                            <el-button @click="createFormVisible = false">取 消</el-button>
                            <el-button type="primary" @click="createTemplate">新 增</el-button>
                        </div>
                    </el-form>
                </el-dialog>

                <!-- 編輯資料視窗 -->
                <el-dialog title="編輯資料" :visible.sync="editFormVisible" center>
                    <el-form ref="editTemplateData" label-width="80px">
                        <el-form-item label="標題">
                            <el-input v-model="editTemplateData.title"></el-input>
                        </el-form-item>
                        <el-form-item label="內容">
                            <el-input type="textarea" v-model="editTemplateData.content"></el-input>
                        </el-form-item>
                        <div class="u-text-right">
                            <el-button @click="editFormVisible = false">取 消</el-button>
                            <el-button type="primary"
                                       @click="updateTemplate(editTemplateData.id, editTemplateData.title, editTemplateData.content)">
                                儲 存
                            </el-button>
                        </div>
                    </el-form>
                </el-dialog>

                <!-- 內容結束 -->
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tabsActive: 'first',
                new_text_message: {
                    phone: '',
                    title: '',
                    content: ''
                },
                templateDatas: [],
                historyDatas: [],
                historyCurrentPage: '',
                historyTotal: 0,
                choose_template_value: '',
                createFormVisible: false,
                createTemplateData: {
                    title: '',
                    content: ''
                },
                editFormVisible: false,
                editTemplateData: {
                    id: '',
                    title: '',
                    content: ''
                },
                // 簡訊額度
                messageQuota: '請求中資料...',
            }
        },
        mounted() {
            this.getMessageQuota();
            this.getTemplateDatas();
            this.getHistoryDatas(1);
        },
        methods: {
            getMessageQuota() {
                Vue.axios.get('/api/get_message_quota'
                ).then(resopnse => {
                    this.messageQuota = resopnse.data
                }).catch(function (error) {
                    console.error('取得簡訊餘額失敗');
                });
            },
            getHistoryDatas(index) {
                Vue.axios.get('/api/short_message_service_history', {
                    params: {
                        page: index,
                    }
                }).then(response => {
                    this.historyCurrentPage = response.data.current_page
                    this.historyTotal = response.data.total
                    this.historyDatas = response.data.data
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getTemplateDatas() {
                Vue.axios.get('/api/short_message_service_example'
                ).then(response => {
                    this.templateDatas = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            choose_template(selected) {
                this.new_text_message.content = selected;
            },
            sentMessage(){
                console.log(this.new_text_message)
                console.log('暫時不接上ＡＰＩ等驗證機制完成')
            },
            createTemplate() {
                this.createFormVisible = false;
                Vue.axios.post('/api/short_message_service_example', {
                    title: this.createTemplateData.title,
                    content: this.createTemplateData.content
                }).then(response => {
                    this.getTemplateDatas();
                    this.createTemplateData.title = '';
                    this.createTemplateData.content = '';
                    this.$message({
                        type: 'success',
                        message: '新增成功'
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            editTemplate(id, title, content) {
                this.editTemplateData.id = '';
                this.editTemplateData.title = '';
                this.editTemplateData.content = '';
                this.editTemplateData.id = id;
                this.editTemplateData.title = title;
                this.editTemplateData.content = content;
                this.editFormVisible = true
            },
            updateTemplate(id, title, content) {
                this.editFormVisible = false
                Vue.axios.patch('/api/short_message_service_example/' + id, {
                    title: title,
                    content: content
                }).then(response => {
                    this.getTemplateDatas();
                    this.$message({
                        type: 'success',
                        message: '更新成功'
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            delTemplate(id) {
                this.$confirm('此操作將刪除該筆資料，確定嗎?', '提示', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    Vue.axios.patch('/api/short_message_service_example/' + id, {
                        status: -1,
                    })
                        .then(response => {
                            this.getTemplateDatas();
                            this.$message({
                                type: 'success',
                                message: '刪除成功'
                            });
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消操作'
                    });
                });
            },

        }
    }
</script>