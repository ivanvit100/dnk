<template>
	<div id="cabinet">
		<h1 id="fullname">{{name}} {{surname}}</h1>
		<p class="email"><b>Email:</b> {{email}}</p>
		<p class="phone"><b>Телефон:</b> {{phone}}</p>
		<div id="subscribe">
			<h2>Курсы</h2>
			Ваши дети не записаны на курсы
		</div>
		<div id="misses">
			<h2>Пропуски</h2>
			<p id="passes" v-for="item in passes">{{item}}</p>
		</div>
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
			surname: localStorage.getItem('surname'),
			email: 'Подождите...',
			phone: 'Подождите...',
			passes: ['Подождите...']
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
		}else{
			let user = {
				ID: localStorage.getItem('id')
			}
			fetch('http://dnk.ivanvit.ru/testphp/cab_test.php', {
				method: 'POST',
				body: JSON.stringify(user)
			}).then((response) => {
				return response.json()
			}).then((data) => {
				this.email = data['Email'];
				this.phone = data['Phone'];
				if(data['PassOne'] == "0000-00-00"){
					this.passes = ["У Ваших детей нет пропусков"]
				}else{
					this.passes = [data['PassOne'], data['PassTwo'] == "0000-00-00" ? "" : data['PassTwo'], data['PassThree'] == "0000-00-00" ? "" : data['PassThree']]
				}
			}).catch((error) => {
				console.warn(error);
			});
		}
	}
}
</script>