<template>
    <div>
        <el-breadcrumb separator-class="el-icon-arrow-right">
            <el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
            <el-breadcrumb-item>旅宿業者</el-breadcrumb-item>
            <el-breadcrumb-item>旅宿列表</el-breadcrumb-item>
            <el-breadcrumb-item>編輯旅宿</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="title--orange">編輯旅宿</div>
        <el-form ref="form" :model="form" label-width="80px">
            <el-tabs v-model="tabsActive" type="card">
                <el-tab-pane label="基本資料" name="first">
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
                        <el-form-item label="旅宿型別" style="height:41px;">
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
                        <el-form-item label="縣市" style="height:40px;">
                            <el-select v-model="form.city"
                                       placeholder="請選擇"
                                       clearable
                                       style="width: 100%;"
                                       @change="getTownDatas">
                                <el-option
                                        v-for="item in cities"
                                        :label="item.chinese_name"
                                        :value="item.id"
                                        :key="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="6">
                        <el-form-item label="區域" style="height:40px;">
                            <el-select v-model="form.town" placeholder="請選擇" clearable style="width: 100%;">
                                <el-option
                                        v-for="item in towns"
                                        :label="item.chinese_name"
                                        :key="item.id"
                                        :value="item.id">
                                </el-option>
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
                        <el-form-item label="手機">
                            <el-input v-model="form.main_phone"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="E-MAIL">
                            <el-input v-model="form.main_email"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24">
                        <div class="title--blue">管理人資料</div>
                        <el-checkbox v-model="main_equal_admin" @change="mainEqualAdmin" class="u-ml-16">與負責人資料相同
                        </el-checkbox>
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
                        <el-form-item label="手機">
                            <el-input v-model="form.admin_phone"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="E-MAIL">
                            <el-input v-model="form.admin_email"></el-input>
                        </el-form-item>
                    </el-col>
                </el-tab-pane>
                <el-tab-pane label="款項資料" name="second">
                    <el-col :xs="24" :sm="24">
                        <div class="title--blue">收費模式</div>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="收費模式">
                            <el-select v-model="form.pay_type" placeholder="請選擇" style="width: 100%;">
                                <el-option label="平台訂金收費30%" value="30"></el-option>
                                <el-option label="平台全額收費100%" value="100"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24">
                        <div class="title--blue">銀行資料</div>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="銀行名稱">
                            <el-input v-model="form.bank_name"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="銀行分行">
                            <el-input v-model="form.bank_branch"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="銀行帳號">
                            <el-input v-model="form.bank_account"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="帳號名稱">
                            <el-input v-model="form.bank_title"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24">
                        <div class="title--blue">發票資料</div>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="發票統編">
                            <el-input v-model="form.invoice_number"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="發票抬頭">
                            <el-input v-model="form.invoice_title"></el-input>
                        </el-form-item>
                    </el-col>
                </el-tab-pane>
                <el-tab-pane label="合約資料" name="third">
                    <el-col :xs="24" :sm="24">
                        <div class="title--blue">簽約紀錄</div>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="簽約業務">
                            <span>{{ form.signing_business }}</span>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12">
                        <el-form-item label="簽約日期">
                            <span>{{ form.signing_date }}</span>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24">
                        <div class="title--blue">合約照片</div>
                    </el-col>
                    <el-col :xs="24" :sm="24">
                        <el-upload
                                action="https://jsonplaceholder.typicode.com/posts/"
                                list-type="picture-card"
                                :on-preview="handlePictureCardPreview"
                                :on-remove="handleRemove">
                            <i class="el-icon-plus"></i>
                        </el-upload>
                        <el-dialog :visible.sync="dialogVisible" size="tiny">
                            <img width="100%" :src="dialogImageUrl" alt="">
                        </el-dialog>
                    </el-col>
                </el-tab-pane>
                <el-tab-pane label="回報紀錄" name="fourth">
                    <el-row type="flex" align="middle">
                        <el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
                            <div class="title--blue">回報紀錄</div>
                        </el-col>
                        <el-col class="u-text-right">
                            <el-button type="primary" @click="createFormVisible = true">新增資料</el-button>
                        </el-col>
                    </el-row>
                    <el-table
                            :data="returnDatas"
                            style="width: 100%">
                        <el-table-column
                                prop="created_at"
                                label="日期"
                        >
                        </el-table-column>
                        <el-table-column
                                prop="business"
                                label="姓名"
                        >
                        </el-table-column>
                        <el-table-column
                                prop="content"
                                label="內容">
                        </el-table-column>
                    </el-table>
                    <!-- 新增資料視窗 -->
                    <el-dialog title="新增資料" :visible.sync="createFormVisible" center>
                        <el-form ref="createData" label-width="80px">
                            <el-form-item label="!!!">
                                <span>此欄位提供業務及行政做為回報紀錄使用，每日回報項目請勿分次提交。</span>
                            </el-form-item>
                            <el-form-item label="內容">
                                <el-input type="textarea" v-model="createData.content"></el-input>
                            </el-form-item>
                            <div class="u-text-right">
                                <el-button @click="createFormVisible = false">取 消</el-button>
                                <el-button type="primary" @click="addReturnData">確 定</el-button>
                            </div>
                        </el-form>
                    </el-dialog>
                </el-tab-pane>
            </el-tabs>
            <!-- 儲存按鈕 -->
            <el-col :xs="{span: 24, offset: 0}" :sm="{span: 24, offset: 0}">
                <el-form-item>
                    <div class="u-text-right u-mt-24" v-if="form.status != '2' && form.status != '3'">
                        <el-button type="success" @click="updateHotelData">儲存旅宿資料</el-button>
                        <el-button type="primary" @click="checkContract">確認已簽約</el-button>
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
                // 頁籤初始設定
                tabsActive: 'first',
                // 負責人與管理人相同
                main_equal_admin: false,
                //縣市下拉選單處理
                cities: [],
                towns: [],
                // 表格資料綁定
                form: {},
                // 上傳照片
                dialogImageUrl: '',
                dialogVisible: false,
                // 回報紀錄列表
                returnDatas: [],
                // 新增回報紀錄
                createFormVisible: false,
                createData: {
                    content: ''
                },
            }
        },
        created() {
            this.getHotelData();
            this.getCityDatas();
            this.getReturnDatas();
        },
        methods: {
            getHotelData() {
                Vue.axios.get('/api/hotel/' + this.$route.params.id)
                    .then(response => {
                        this.form = response.data;
                        this.getTownDatas(this.form.city);
                    })
                    .catch(function (error) {
                        console.log('error_getHotelData');
                    });
            },
            getCityDatas() {
                Vue.axios.get('/api/city')
                    .then(response => {
                        this.cities = response.data;
                        this.getTownDatas(this.form.city);
                    })
                    .catch(function (error) {
                        console.error('請求縣市失敗');
                    });
            },
            getTownDatas(city) {
                if (city !== undefined){
//                    this.form.town = ''
                    Vue.axios.get('/api/town/' + city)
                    .then(response => {
                        if (response.data.length > 0) {
                            this.towns = response.data
                        } else {
                            console.error('請求鄉鎮失敗');
                        }
                    })
                    .catch(function (error) {
                        console.log('error_getTownDatas');
                    });
                }
            },
            getReturnDatas() {
                Vue.axios.get('/api/hotel_return/' + this.$route.params.id)
                    .then(response => {
                        this.returnDatas = response.data
                    })
                    .catch(function (error) {
                        console.log('error');
                    });
            },
            addReturnData() {
                this.createFormVisible = false;
                Vue.axios.post('/api/hotel_return/', {
                    business: this.$store.state.AuthUser.business_id,
                    hotel_id: this.$route.params.id,
                    content: this.createData.content
                })
                    .then(response => {
                        this.createData.content = '';
                        this.$message({
                            message: '操作成功',
                            type: 'success'
                        });
                        this.getReturnDatas()
                    })
                    .catch(function (error) {
                        console.log('error');
                    });
            },
            mainEqualAdmin() {
                if (this.main_equal_admin == true) {
                    this.form.admin_name = this.form.main_name;
                    this.form.admin_title = this.form.main_title;
                    this.form.admin_phone = this.form.main_phone;
                    this.form.admin_email = this.form.main_email;
                }
            },
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },
            updateHotelData() {
                Vue.axios.patch('/api/hotel/' + this.$route.params.id, {
                    id: this.$route.params.id,
                    account_number: this.form.account_number,
                    account_type: this.form.account_type,
                    chinese_name: this.form.chinese_name,
                    type: this.form.type,
                    city: this.form.city,
                    town: this.form.town,
                    address: this.form.address,
                    phone: this.form.phone,
                    fax: this.form.fax,
                    website: this.form.website,
                    facebook: this.form.facebook,
                    main_name: this.form.main_name,
                    main_title: this.form.main_title,
                    main_phone: this.form.main_phone,
                    main_email: this.form.main_email,
                    admin_name: this.form.admin_name,
                    admin_title: this.form.admin_title,
                    admin_phone: this.form.admin_phone,
                    admin_email: this.form.admin_email,
                    pay_type: this.form.pay_type,
                    bank_name: this.form.bank_name,
                    bank_branch: this.form.bank_branch,
                    bank_account: this.form.bank_account,
                    bank_title: this.form.bank_title,
                    invoice_number: this.form.invoice_number,
                    invoice_title: this.form.invoice_title,
                })
                    .then(response => {
                        this.$message({
                            message: '儲存旅宿資料成功',
                            type: 'success'
                        });
                        this.getHotelData();
                    })
                    .catch(function (error) {
                        console.log('error');
                    });
            },
            checkContract() {
                this.$confirm('您需再次確認該民宿已簽約，並且拿到合約?', '提示', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    Vue.axios.patch('/api/hotel/' + this.$route.params.id, {
                        id: this.$route.params.id,
                        account_number: this.form.account_number,
                        account_type: this.form.account_type,
                        chinese_name: this.form.chinese_name,
                        type: this.form.type,
                        city: this.form.city,
                        town: this.form.town,
                        address: this.form.address,
                        phone: this.form.phone,
                        fax: this.form.fax,
                        website: this.form.website,
                        facebook: this.form.facebook,
                        main_name: this.form.main_name,
                        main_title: this.form.main_title,
                        main_phone: this.form.main_phone,
                        main_email: this.form.main_email,
                        admin_name: this.form.admin_name,
                        admin_title: this.form.admin_title,
                        admin_phone: this.form.admin_phone,
                        admin_email: this.form.admin_email,
                        pay_type: this.form.pay_type,
                        bank_name: this.form.bank_name,
                        bank_branch: this.form.bank_branch,
                        bank_account: this.form.bank_account,
                        bank_title: this.form.bank_title,
                        invoice_number: this.form.invoice_number,
                        invoice_title: this.form.invoice_title,
                        status: 2,
                    })
                        .then(response => {
                            this.$message({
                                type: 'success',
                                message: '該旅宿已提交審核'
                            });
                            this.getHotelData();
                        })
                        .catch(function (error) {
                            this.$message({
                                type: 'info',
                                message: '放棄操作'
                            });
                            console.log('error');
                        });
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