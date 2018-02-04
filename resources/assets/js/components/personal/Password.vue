<template>
  <div>
    <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal">
      <router-link :to="{ name: 'information' }"><el-menu-item index="1">個人資料</el-menu-item></router-link>
      <router-link :to="{ name: 'information.password' }"><el-menu-item index="2">密碼修改</el-menu-item></router-link>
    </el-menu>
    <!-- Form -->
    <el-row>
      <el-col :xs="{span: 24, offset: 0}" :sm="{span: 12, offset: 6}">
        <div class="title--orange">修改密碼</div>
        <el-form :label-position="labelPosition" label-width="80px" ref="changepassword" :model="changepassword" @submit.native.prevent>
          <el-form-item label="原始密碼">
            <el-input 
            type="password" 
            v-model="changepassword.oldpassword"
            ></el-input>
          </el-form-item>
          <el-form-item label="修改密碼">
            <el-input 
            type="password" 
            v-model="changepassword.newpassword"
            ></el-input>
          </el-form-item>
          <el-form-item label="確認密碼">
            <el-input 
            type="password" 
            v-model="changepassword.checkpassword"
            ></el-input>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="submitForm">修改密碼</el-button>
            <el-button @click="resetForm()">清除重填</el-button>
          </el-form-item>
        </el-form>
      </el-col>
    </el-row>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        activeIndex: '2',
        labelPosition: 'right',
        changepassword: {
          oldpassword: '',
          newpassword: '',
          checkpassword: ''
        }
      }
    },
    methods: {
      submitForm() {
        alert('submit!');
      },
      resetForm(){
        this.changepassword.oldpassword =  '';
        this.changepassword.newpassword =  '';
        this.changepassword.checkpassword =  '';
      }
    }
  }
</script>