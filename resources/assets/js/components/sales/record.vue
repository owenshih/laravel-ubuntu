<template>
    <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
        <el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
        <el-breadcrumb-item>業務專區</el-breadcrumb-item>
        <el-breadcrumb-item>簽約紀錄</el-breadcrumb-item>
    </el-breadcrumb>
    <!-- 標題 -->
    <el-row type="flex" align="middle">
        <el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
            <div class="title--orange">簽約紀錄</div>
        </el-col>
    </el-row>
    <el-table
    :data="recordDatas"
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
        prop="signing_date"
        label="簽約日期">
        </el-table-column>
        <el-table-column
        prop="status"
        label="狀態">
        </el-table-column>
    </el-table>
    <div class="block u-text-right">
      <el-pagination
        @current-change="getRecordDatas"
        layout="prev, pager, next"
        :total="total">
      </el-pagination>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
      	recordDatas:[],
        currentPage: '',
        total: 0,
      }
    },
    mounted: function(){
      this.getRecordDatas(1)
    },
    methods:{
      getRecordDatas(index){
        Vue.axios.get('/api/hotel', {
          params: {
            page: index, 
            signing_business: this.$store.state.AuthUser.business_id,
            status: 3
          }
        })
        .then(response=>{
                this.currentPage = response.data.current_page
                this.total = response.data.total
                this.recordDatas = response.data.data
        })
        .catch(function (error) {
          console.log('error');
        });
      }
    }
  }
</script>