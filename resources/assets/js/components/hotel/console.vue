<template>
    <div>
        <el-breadcrumb separator-class="el-icon-arrow-right">
            <el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
            <el-breadcrumb-item>旅宿業者</el-breadcrumb-item>
            <el-breadcrumb-item>行政管理作業</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="title--orange">行政管理作業</div>
        <el-tabs v-model="tabsActive" type="card">
            <!-- ___________________________編輯指派___________________________ -->
            <el-tab-pane label="編輯指派" name="first">
                <!-- 搜尋 -->
                <el-col :xs="24" :sm="24">
                    <div class="title--blue">搜尋旅宿</div>
                </el-col>
                <el-form ref="inquireHotelData" :model="inquireHotelData" label-width="80px">
                    <el-col :xs="12" :sm="8" :lg="4">
                        <el-form-item label="旅宿名稱">
                            <el-input v-model="inquireHotelData.chinese_name"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="12" :sm="8" :lg="4">
                        <el-form-item label="業者帳號">
                            <el-input v-model="inquireHotelData.account_number"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="12" :sm="8" :lg="4">
                        <el-form-item label="縣市">
                            <el-select v-model="inquireHotelData.city" placeholder="請選擇" style="width:100%;" clearable
                                       @change="getTownDatas">
                                <el-option
                                        v-for="(item, index) in cities"
                                        :label="item.chinese_name"
                                        :key="index"
                                        :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="12" :sm="8" :lg="4">
                        <el-form-item label="區域">
                            <el-select v-model="inquireHotelData.town" placeholder="請選擇" clearable style="width:100%;">
                                <el-option
                                        v-for="(item, index) in towns"
                                        :label="item.chinese_name"
                                        :key="index"
                                        :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="12" :sm="8" :lg="4">
                        <el-form-item label="狀態">
                            <el-select v-model="inquireHotelData.status" placeholder="請選擇" clearable
                                       style="width:100%;">
                                <el-option label="已下架" value="-3"></el-option>
                                <el-option label="拒絕簽約" value="-2"></el-option>
                                <el-option label="尚待考慮" value="-1"></el-option>
                                <el-option label="未簽約" value="0"></el-option>
                                <el-option label="拜訪進行中" value="1"></el-option>
                                <el-option label="簽約審核中" value="2"></el-option>
                                <el-option label="已簽約完成" value="3"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="12" :sm="8" :lg="4">
                        <el-form-item>
                            <el-button type="primary" style="width:100%;" @click="getHotelDatas(1)">搜 尋</el-button>
                        </el-form-item>
                    </el-col>
                </el-form>
                <!-- 列表 -->
                <el-col :xs="24" :sm="24">
                    <div class="title--blue">旅宿列表</div>
                </el-col>
                <el-table
                        :data="hotelDatas"
                        style="width: 100%"
                        class="u-text-center">
                    <el-table-column
                            prop="city_chinese_name"
                            label="縣市">
                    </el-table-column>
                    <el-table-column
                            prop="town_chinese_name"
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
                            prop="status"
                            label="狀態">
                        <template slot-scope="scope">
                            <template v-if="scope.row.status==-3">已下架</template>
                            <template v-if="scope.row.status==-2">拒絕簽約</template>
                            <template v-if="scope.row.status==-1">尚待考慮</template>
                            <template v-if="scope.row.status==0">未簽約</template>
                            <template v-if="scope.row.status==1">拜訪進行中</template>
                            <template v-if="scope.row.status==2">簽約審核中</template>
                            <template v-if="scope.row.status==3">已簽約完成</template>
                        </template>
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            label="操作">
                        <template slot-scope="scope">
                            <router-link :to="{ name: 'hotel.edit', params: { id: scope.row.id } }  ">
                                <el-button type="text" size="small">編輯</el-button>
                            </router-link>
                            <el-button type="text" size="small" @click="clickAddTrachButtom(scope.row.id)">指派
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="block u-text-right">
                    <el-pagination
                            @current-change="getHotelDatas"
                            layout="prev, pager, next"
                            :total="hotelDatasTotal">
                    </el-pagination>
                </div>
                <!-- 指派旅宿視窗 -->
                <el-dialog title="指派旅宿" :visible.sync="createFormVisible" center>
                    <el-form ref="create_data" label-width="80px">
                        <el-form-item label="業務">
                            <el-select v-model="trach_business" placeholder="請選擇" style="width:100%;">
                                <el-option
                                        v-for="item in business"
                                        :key="item.business_id"
                                        :label="item.name"
                                        :value="item.business_id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <div class="u-text-right">
                            <el-button @click="createFormVisible = false">取 消</el-button>
                            <el-button type="primary" @click="addTrack">確 定</el-button>
                        </div>
                    </el-form>
                </el-dialog>
            </el-tab-pane>
            <!-- ___________________________簽約審核___________________________ -->
            <el-tab-pane label="簽約審核" name="second">
                <el-col :xs="24" :sm="24">
                    <div class="title--blue">審核列表</div>
                </el-col>
                <el-table
                        :data="verifyHotelDatas"
                        style="width: 100%"
                        class="u-text-center">
                    <el-table-column
                            prop="signing_business"
                            label="業務">
                    </el-table-column>
                    <el-table-column
                            prop="city_chinese_name"
                            label="地區">
                    </el-table-column>
                    <el-table-column
                            prop="chinese_name"
                            label="旅宿名稱">
                    </el-table-column>
                    <el-table-column
                            prop="signing_date"
                            label="簽約日期">
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            label="操作"
                            width="250"
                    >
                        <template slot-scope="scope">
                            <el-button type="text" size="small" @click="check_verify_hotel(scope.row.id)">確認審核
                            </el-button>
                            <el-button v-if="scope.row.e_contract != 2" type="text" size="small"
                                       @click="check_e_contract(scope.row.id)">電子合約
                            </el-button>
                            <el-button v-if="scope.row.p_contract != 2" type="text" size="small"
                                       @click="check_p_contract(scope.row.id)">紙本合約
                            </el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-tab-pane>
            <!-- ___________________________回報紀錄___________________________ -->
            <el-tab-pane label="回報紀錄" name="third">
                <!-- 搜尋 -->
                <el-col :xs="24" :sm="24">
                    <div class="title--blue">篩選紀錄</div>
                </el-col>
                <el-form ref="inquireReturnData" :model="inquireReturnData" label-width="80px">
                    <el-col :xs="24" :sm="12" :lg="6">
                        <el-form-item label="業務">
                            <el-select v-model="inquireReturnData.business" placeholder="請選擇" clearable
                                       style="width:100%;">
                                <el-option
                                        v-for="item in business"
                                        :key="item.business_id"
                                        :label="item.name"
                                        :value="item.business_id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12" :lg="6">
                        <el-form-item label="開始日期">
                            <el-date-picker type="date" placeholder="選擇日期" v-model="inquireReturnData.date_start"
                                            style="width: 100%;" value-format="yyyy-MM-dd"></el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12" :lg="6">
                        <el-form-item label="結束日期">
                            <el-date-picker type="date" placeholder="選擇日期" v-model="inquireReturnData.date_end"
                                            style="width: 100%;" value-format="yyyy-MM-dd"></el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="12" :lg="6">
                        <el-form-item>
                            <el-button type="primary" style="width:100%;" @click="getReturnDevDatas(1)">搜 尋</el-button>
                        </el-form-item>
                    </el-col>
                </el-form>
                <!-- 列表 -->
                <el-col :xs="24" :sm="24">
                    <div class="title--blue">回報列表</div>
                    <el-table
                            :data="returnDevDatas"
                            style="width: 100%">
                        <el-table-column type="expand">
                            <template slot-scope="scope">
                                <el-form label-position="left" inline class="demo-table-expand">
                                    <el-form-item label="回報內容">
                                        <span>{{ scope.row.content }}</span>
                                    </el-form-item>
                                </el-form>
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="日期"
                                prop="created_at">
                        </el-table-column>
                        <el-table-column
                                label="業務"
                                prop="business">
                        </el-table-column>
                        <el-table-column
                                label="旅宿"
                                prop="chinese_name">
                        </el-table-column>
                    </el-table>
                    <div class="block u-text-right">
                        <el-pagination
                                @current-change="getReturnDevDatas"
                                layout="prev, pager, next"
                                :total="returnTotal">
                        </el-pagination>
                    </div>
                </el-col>
            </el-tab-pane>
            <!-- ___________________________當月業績___________________________ -->
            <el-tab-pane label="當月業績" name="fourth">
                <!-- 搜尋 -->
                <el-col :xs="24" :sm="24">
                    <div class="title--blue">篩選紀錄</div>
                </el-col>
                <el-form ref="inquirePerformanceData" :model="inquirePerformanceData" label-width="80px">
                    <el-col :xs="24" :sm="8" :lg="8">
                        <el-form-item label="開始日期">
                            <el-date-picker type="date" placeholder="選擇日期" v-model="inquirePerformanceData.date_start"
                                            style="width: 100%;"></el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="8" :lg="8">
                        <el-form-item label="結束日期">
                            <el-date-picker type="date" placeholder="選擇日期" v-model="inquirePerformanceData.date_end"
                                            style="width: 100%;"></el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="8" :lg="8">
                        <el-form-item>
                            <el-button type="primary" style="width:100%;">搜 尋</el-button>
                        </el-form-item>
                    </el-col>
                </el-form>
                <!-- 列表 -->
                <el-col :xs="24" :sm="24">
                    <div class="title--blue">區間業績</div>
                </el-col>
                <el-table
                        :data="performanceHotelDatas"
                        style="width: 100%"
                        class="u-text-center">
                    <el-table-column
                            prop="signing_business"
                            label="業務">
                    </el-table-column>
                    <el-table-column
                            prop="dev_level_A"
                            label="重點開發">
                    </el-table-column>
                    <el-table-column
                            prop="dev_level_B"
                            label="一般發開">
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            label="操作"
                    >
                        <template slot-scope="scope">
                            <el-button type="text" size="small">查看</el-button>
                        </template>
                    </el-table-column>
                </el-table>
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
                // 指派旅宿視窗
                createFormVisible: false,
                // 指派旅宿初始紀錄
                trach_business: '',
                trach_hotel: '',
                // 員工列表
                business: [
                    {id: 1, business_id: '000', name: '施賀凱 Owen'},
                    {id: 2, business_id: '001', name: '施賀凱1 Owen1'},
                    {id: 3, business_id: '002', name: '施賀凱2 Owen2'}
                ],
                // 縣市下拉選單
                cities: [],
                towns: [],
                // 搜尋條件
                inquireHotelData: {
                    chinese_name: '',
                    account_number: '',
                    city: '',
                    town: '',
                    status: ''
                },
                // 旅宿列表
                hotelDatas: [],
                hotelDatasCurrentPage: '',
                hotelDatasTotal: 0,
                // 待審核旅宿列表
                verifyHotelDatas: [],
                // 回報紀錄篩選
                inquireReturnData: {
                    business: '',
                    date_start: '',
                    date_end: ''
                },
                // 回報紀錄
                returnDevDatas: [],
                returnCurrentPage: 0,
                returnTotal: 0,
                // 業績查詢
                inquirePerformanceData: {
                    date_start: '',
                    date_end: ''
                },
                // 業績列表
                performanceHotelDatas: [
                    {
                        id: 0,
                        signing_business: '000',
                        dev_level_A: '10',
                        dev_level_B: '20'
                    },
                    {
                        id: 1,
                        signing_business: '001',
                        dev_level_A: '101',
                        dev_level_B: '201'
                    },
                    {
                        id: 2,
                        signing_business: '002',
                        dev_level_A: '102',
                        dev_level_B: '202'
                    },
                    {
                        id: 3,
                        signing_business: '003',
                        dev_level_A: '103',
                        dev_level_B: '203'
                    }
                ]
            }
        },
        mounted: function () {
            this.getCityDatas()
            this.getHotelDatas(1)
            this.getReturnDevDatas(1)
            this.getVerifyHotelDatas()
        },
        methods: {
            getCityDatas() {
                Vue.axios.get('/api/city')
                    .then(response => {
                        this.cities = response.data
                    })
                    .catch(function (error) {
                        console.log('error');
                    });
            },
            getTownDatas(city) {
                this.inquireHotelData.town = ''
                Vue.axios.get('/api/town/' + city)
                    .then(response => {
                        console.log(response.data.length)
                        if (response.data.length > 0) {
                            this.towns = response.data
                        } else {
                            console.log('error');
                        }
                    })
                    .catch(function (error) {
                        console.log('error');
                    });
            },
            getHotelDatas(index) {
                Vue.axios.get('/api/hotel', {
                    params: {
                        page: index,
                        chinese_name: this.inquireHotelData.chinese_name,
                        account_number: this.inquireHotelData.account_number,
                        city: this.inquireHotelData.city,
                        town: this.inquireHotelData.town,
                        status: this.inquireHotelData.status
                    }
                })
                    .then(response => {
                        this.hotelDatasCurrentPage = response.data.current_page
                        this.hotelDatasTotal = response.data.total
                        this.hotelDatas = response.data.data
                    })
                    .catch(function (error) {
                        console.log('error');
                    });
            },
            clickAddTrachButtom(id) {
                this.trach_hotel = '';
                this.trach_hotel = id;
                this.createFormVisible = true;
            },
            addTrack() {
                this.createFormVisible = false;
                Vue.axios.patch('/api/hotel_cooperation/' + this.trach_business, {
                    status: 1,
                    cooperation_item: this.trach_hotel
                })
                    .then(response => {
                        this.$message({
                            message: '操作成功',
                            type: 'success'
                        });
                    })
                    .catch(function (error) {
                        console.log('error_add');
                    });
            },
            getReturnDevDatas(index) {
                Vue.axios.get('/api/hotel_return', {
                    params: {
                        page: index,
                        business: this.inquireReturnData.business,
                        date_start: this.inquireReturnData.date_start,
                        date_end: this.inquireReturnData.date_end
                    }
                })
                    .then(response => {
                        this.returnCurrentPage = response.data.current_page,
                            this.returnTotal = response.data.total,
                            this.returnDevDatas = response.data.data
                    })
                    .catch(function (error) {
                        console.log('error');
                    });
            },
            specified(id) {
                console.log()
            },
            getVerifyHotelDatas() {
                Vue.axios.get('/api/hotel', {
                    params: {
                        status: 2
                    }
                })
                    .then(response => {
                        this.verifyHotelDatas = response.data.data
                    })
                    .catch(function (error) {
                        console.log('error');
                    });
            },
            check_verify_hotel(id) {
                this.$confirm('您需再次確認將該旅宿通過審核?', '提示', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    Vue.axios.patch('/api/hotel/' + id, {
                        status: 3
                    })
                        .then(response => {
                            this.getVerifyHotelDatas();
                            this.$message({
                                message: '操作成功',
                                type: 'success'
                            });
                        })
                        .catch(function (error) {
                            console.log('error_add');
                        });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '放棄操作'
                    });
                });
            },
            check_e_contract(id) {
                this.$confirm('您需再次確認"電子合約"審核通過?', '提示', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    Vue.axios.patch('/api/hotel/' + id, {
                        e_contract: 2
                    })
                        .then(response => {
                            this.getVerifyHotelDatas();
                            this.$message({
                                message: '操作成功',
                                type: 'success'
                            });
                        })
                        .catch(function (error) {
                            console.log('error_add');
                        });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '放棄操作'
                    });
                });
            },
            check_p_contract(id) {
                this.$confirm('您需再次確認"紙本合約"審核通過?', '提示', {
                    confirmButtonText: '確定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    Vue.axios.patch('/api/hotel/' + id, {
                        p_contract: 2
                    })
                        .then(response => {
                            this.getVerifyHotelDatas();
                            this.$message({
                                message: '操作成功',
                                type: 'success'
                            });
                        })
                        .catch(function (error) {
                            console.log('error_add');
                        });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '放棄操作'
                    });
                });
            }
        }
    }
</script>