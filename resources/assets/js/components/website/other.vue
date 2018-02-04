<template>
	<div>    
		<el-breadcrumb separator-class="el-icon-arrow-right">
			<el-breadcrumb-item :to="{ path: '/' }">首頁</el-breadcrumb-item>
			<el-breadcrumb-item>網站管理</el-breadcrumb-item>
			<el-breadcrumb-item>其他設定</el-breadcrumb-item>
		</el-breadcrumb>
	    <el-row type="flex" align="middle">
	    	<el-col :xs="{span: 20, offset: 0}" :sm="{span: 20, offset: 0}">
				<div class="title--orange">其他設定</div>
	    	</el-col>
	    </el-row>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        activeIndex: '10'
      }
    }
  }
</script>