<template>
	<div id="headerVue">
		<div id="main_header">
			<img src="@/assets/logo.png" alt="logo" id="logo">
			<div id="login" v-if="!login">
				<button class="button">Войти</button>
			</div>
			<div id="cabinet" v-else>
				<div id="avatar">Вы вошли</div>
			</div>
		</div>
		<div id="navbar">
			<div class="header_button" @click="swap('home')">Главная</div>
			<div class="header_button" @click="swap('courses')">Курсы</div>
			<div class="header_button" @click="swap('contacts')">Контакты</div>
		</div>
		<div id="images">
			<template>
  				<carousel :data="data"></carousel>
			</template>
		</div>
	</div>
</template>

<style>
#headerVue{
	display: grid;
	grid-template-rows: 50px 300px;
	grid-template-columns: 100%;
}
#navbar{
	position: absolute;
	opacity: 0.8;
	z-index: 9;
	width: 100vw;
	height: 30px;
	top: 50px;
	display: grid;
	grid-template-columns: 33% 33% 33%;
	background-color: #999;
}
.header_button{
	text-align: center;
	height: 100%;
	display: inline-block;
	line-height: 30px
}
#main_header{
	background-color: #012a77;
	color: white;
	display: grid;
	grid-template-columns: 10% 90%;
}
img{
	max-width: 100%;
	max-height: 100%;
}
.example-slide{
	align-items: center;
 	background-color: #666;
  	color: #999;
  	display: flex;
  	font-size: 1.5rem;
  	justify-content: center;
  	height: 300px;
}
#logo{
	filter: grayscale(100%) invert(100%) brightness(100);
}
.button{
	display: inline-block;
	font-family: "Montserrat", sans-serif;
	-webkit-font-smoothing: antialiased;
	position: relative;
	padding: 0.8em 1.4em;
	padding-right: 4.7em;
	background: #6a737b;
 	border: none;
	color: white;
	transition: 0.2s;
	width: 12em;
	float: right;
	margin-right: 20px;
	height: 30px;
	margin-top: 10px;
}
.button:before, .button:after{
	position: absolute;
	top: 0;
	bottom: 0;
	right: 0;
	padding-top: inherit;
	padding-bottom: inherit;
	width: 2.8em;
	font-family: 'FontAwesome', sans-serif;
	font-size: 1.2em;
	text-align: center;
	transition: 0.2s;
	transform-origin: 50% 60%;
	background: rgba(0, 0, 0, 0.1);
}
.button:hover{
	background: #0079a5;
}
.button:active, .button:focus{
	background: #008196;
	outline: none;
}
.button:after{
	content: '\232A';
}
.button:hover:after{
	-webkit-animation: none;
	-webkit-transform: scale(1.4);
	animation: none;
	transform: scale(1.4);
}
</style>

<script>
import Vue from 'vue';
import VueCarousel from '@chenfengyuan/vue-carousel';

Vue.use(VueCarousel);

export default{
	name: 'headerVue',
	props: ['mode', 'login'],
	data(){
		return{
			data: [],
		}
	},
	methods:{
		swap: function(m){
			console.log(this.ban1);
			//Переключение отображения страниц
			this.$emit('swap', {
				mode: m,
			});
		}
	},
	mounted(){
		this.$nextTick(function(){
			console.log(this.login);
			this.data = [
        		'<img src=".' + require(`../assets/ban1.jpg`) + '" alt="baner" class="example-slide">',
        		'<img src=".' + require(`../assets/ban2.png`) + '" alt="baner" class="example-slide">',
        		'<img src=".' + require(`../assets/ban3.jpg`) + '" alt="baner" class="example-slide">',
			];
		})
	}
}
</script>