<template>
	<div id="headerVue">
		<button @click="swap('home')">Главная</button>
		<button @click="swap('courses')">Курсы</button>
		<button @click="swap('contacts')">Контакты</button>
	</div>
</template>

<style>
</style>

<script>
export default{
	name: 'headerVue',
	props: ['mode'],
	data(){
		return{
		}
	},
	methods:{
		swap: function(m){
			//Переключение отображения страниц
			this.$emit('swap', {
				mode: m,
			});
		}
	},
}
</script>