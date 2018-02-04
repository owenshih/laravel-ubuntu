<template>
  <el-row class="tac">
    <el-col :span="24">
      <el-menu default-active="0" class="el-menu-vertical-demo" >

        <el-submenu index="1">
          <template slot="title">
            <i class="fa fa-tachometer fa-lg"></i>
            <span>官網管理</span>
          </template>
          <el-menu-item-group>
             <router-link :to="{ name: 'website.index_carousel' }"><el-menu-item index="1-1">首頁輪播</el-menu-item></router-link>
             <router-link :to="{ name: 'website.landspace' }"><el-menu-item index="1-2">台灣之美</el-menu-item></router-link>
             <router-link :to="{ name: 'website.partner' }"><el-menu-item index="1-3">合作夥伴</el-menu-item></router-link>
             <router-link :to="{ name: 'website.active_carousel' }"><el-menu-item index="1-4">活動輪播</el-menu-item></router-link>
             <router-link :to="{ name: 'website.active_card' }"><el-menu-item index="1-5">活動卡片</el-menu-item></router-link>
             <router-link :to="{ name: 'website.active_album' }"><el-menu-item index="1-6">活動回顧</el-menu-item></router-link>
             <router-link :to="{ name: 'website.diary' }"><el-menu-item index="1-7">旅遊日誌</el-menu-item></router-link>
             <router-link :to="{ name: 'website.industry' }"><el-menu-item index="1-8">業者專區</el-menu-item></router-link>
             <router-link :to="{ name: 'website.faq' }"><el-menu-item index="1-9">常見問題</el-menu-item></router-link>
          </el-menu-item-group>
        </el-submenu>

        <el-submenu index="2">
          <template slot="title">
            <i class="fa fa-envelope fa-lg"></i>
            <span>簡訊郵件</span>
          </template>
          <el-menu-item-group>
             <router-link :to="{ name: 'message.text_message' }"><el-menu-item index="2-1">簡訊管理</el-menu-item></router-link>
          </el-menu-item-group>
        </el-submenu>

        <el-submenu index="3">
          <template slot="title">
            <i class="fa fa-home fa-lg"></i>
            <span>旅宿業者</span>
          </template>
          <el-menu-item-group>
             <router-link :to="{ name: 'hotel' }"><el-menu-item index="3-1">全台旅宿列表</el-menu-item></router-link>
             <router-link :to="{ name: 'hotel.create' }"><el-menu-item index="3-2">建立新旅宿</el-menu-item></router-link>
             <router-link :to="{ name: 'hotel.console' }"><el-menu-item index="3-3">行政管理作業</el-menu-item></router-link>
          </el-menu-item-group>
        </el-submenu>

        <el-submenu index="4">
          <template slot="title">
            <i class="fa fa-user-circle fa-lg"></i>
            <span>業務專區</span>
          </template>
          <el-menu-item-group>
             <router-link :to="{ name: 'sales.track' }"><el-menu-item index="4-1">追蹤列表</el-menu-item></router-link>
             <router-link :to="{ name: 'sales.record' }"><el-menu-item index="4-2">簽約紀錄</el-menu-item></router-link>
          </el-menu-item-group>
        </el-submenu>

        <el-submenu index="5">
          <template slot="title">
            <i class="fa fa-money fa-lg"></i>
            <span>經費作業</span>
          </template>
          <el-menu-item-group>
             <router-link :to="{ name: 'funding' }"><el-menu-item index="5-1">個人經費申請</el-menu-item></router-link>
             <router-link :to="{ name: 'funding.console' }"><el-menu-item index="5-2">會計管理作業</el-menu-item></router-link>
          </el-menu-item-group>
        </el-submenu>

      </el-menu>
    </el-col>
  </el-row>
</template>

<script>
  export default {
  }
</script>