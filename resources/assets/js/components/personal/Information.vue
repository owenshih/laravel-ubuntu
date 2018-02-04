<template>
  <div>
    <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal">
    <router-link :to="{ name: 'information' }"><el-menu-item index="1">個人資料</el-menu-item></router-link>
    <router-link :to="{ name: 'information.password' }"><el-menu-item index="2">密碼修改</el-menu-item></router-link>
    </el-menu>
    <!-- Form -->
    <el-row>
      <el-col :xs="{span: 24, offset: 0}" :sm="{span: 12, offset: 6}">
        <div class="title--orange">個人資料</div>
        <p class="u-text-center">目前尚不提供個人資料檢視 / 修改</p>
      </el-col>
    </el-row>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        activeIndex: '1'
      }
    }
  }
</script>