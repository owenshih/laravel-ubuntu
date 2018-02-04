<template>
	<div class="top_menu_wrapper">
		<router-link to="/register">Register22</router-link>
		<router-link :to="{ name: 'information' }">
			<div class="top_menu_right">
				<img src="https://fakeimg.pl/45x45/">
				<p>施賀凱 Owen</p>
			</div>
		</router-link>
	</div>
</template>

<script>
  export default {
  	methods:{
  	}
  }
</script>