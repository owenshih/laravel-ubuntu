<template>
    <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
        <el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
        <el-breadcrumb-item>業務專區</el-breadcrumb-item>
        <el-breadcrumb-item>個人追蹤列表</el-breadcrumb-item>
    </el-breadcrumb>
    <!-- 標題 -->
    <el-row type="flex" align="middle">
        <el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
            <div class="title--orange">個人追蹤列表</div>
        </el-col>
    </el-row>
    <el-table
    :data="trackDatas"
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
        fixed="right"
        label="操作">
            <template slot-scope="scope">
                <router-link :to="{ name: 'hotel.edit', params: { id: scope.row.id } }  "><el-button type="text" size="small">編輯</el-button></router-link>
                <el-button type="text" size="small" @click="delTrackData(scope.row.id)">移除</el-button>
            </template>
        </el-table-column>
    </el-table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            trackDatas:[],
        }
    },
    mounted: function(){
        this.getTrackDatas()
    },
    methods:{
        getTrackDatas(){
            Vue.axios.get('/api/hotel_cooperation/' + this.$store.state.AuthUser.business_id)
            .then(response=>{
                this.trackDatas = response.data
            })
            .catch(function (error) {
                this.$message({
                    type: 'warning',
                    message: error
                });
            });
        },
        delTrackData(id){
            this.$confirm('此操作將刪除該筆資料，確定嗎?', '提示', {
                confirmButtonText: '確定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                Vue.axios.patch('/api/hotel_cooperation/' + this.$store.state.AuthUser.business_id,{
                    status: -1,
                    cooperation_item: id
                })
                .then(response=>{
                    this.getTrackDatas();
                    this.$message({
                        message: '操作成功',
                        type: 'success'
                    });
                })
                .catch(function (error) {
                    console.log('error_delTrackData');
                });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消操作'
                });
            });
        }
    }    
}
</script>