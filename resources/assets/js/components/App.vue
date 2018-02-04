<template>
    <el-container>
      <el-header>
          <div class="mobile__nav__wrapper" @click="nav_toggle">
              <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
          </div>
        <top-menu></top-menu>
      </el-header>
      <el-container>
        <el-aside width="0px;">
          <side-menu class="window__nav__wrapper"></side-menu>
        </el-aside>
        <el-main>
          <router-view></router-view>
        </el-main>
      </el-container>
    </el-container>

</template>

<script>
import TopMenu from './common/TopMenu'
import SideMenu from './common/SideMenu'
export default {
    components:{
        TopMenu, SideMenu
    },
    methods:{
      nav_toggle(){
        $('.window__nav__wrapper').toggleClass('active');
      }
    }
}
</script>