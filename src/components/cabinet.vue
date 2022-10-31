<template>
	<div id="cabinet">
		<h1 id="fullname">{{name}} {{surname}}</h1>
		<div id="subscribe">Ваши дети не записаны на курсы</div>
		<div id="misses">У Ваших детей нет пропусков</div>
		<button id="exit" @click="exit">Выйти</button>
	</div>
</template>

<style>
</style>

<script>
export default{
	name: 'cabinet',
	data(){
		return{
			name: localStorage.getItem('name'),
			surname: localStorage.getItem('surname')
		}
	},
	methods:{
		exit: function(){
			localStorage.clear();
			location.reload()
		}
	},
	mounted(){
		document.querySelector("#headerVue").classList.add("courseHide");
		if(localStorage.getItem('login') == null){
			this.$router.push({name: 'home'})
		}
	}
}
</script>