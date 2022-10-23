<template>
	<div id="headerVue">
		<div id="main_header">
			<img src="@/assets/logo.png" alt="logo" id="logo">
			<div id="login" v-if="!login">
				<button class="button" @click="loginClick">Войти</button>
			</div>
			<div id="cabinet" v-else>
				<img src="@/assets/account.png" alt="avatar" id="avatar">
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
		<template>
			<Transition name="modal">
				<div v-if="show" class="modal-mask">
					<div class="modal-wrapper">
						<div class="modal-container" v-if="!sign">
							<button @click="show=!show" id="close">x</button>
							<h2 id="popupTitle">Авторизация</h2>
							<form>
								<input type="email" id="email" placeholder="Почта" required>
								<input type="password" id="password" placeholder="Пароль" minlength="8" required>
								<span @click="sign=!sign" id="reg">Зарегистрироваться</span>
								<button @click="goClick(true)" id="go" formmethod="post">Войти</button>
							</form>
						</div>
						<div class="modal-container" v-else>
							<button @click="show=!show" id="close">x</button>
							<h2 id="popupTitle">Регистрация</h2>
							<form>
								<input type="text" id="name" placeholder="Имя" minlength="2" required>
								<input type="text" id="lastname" placeholder="Фамилия" minlength="2" required>
								<input type="email" id="email" placeholder="Почта" required>
								<input type="password" id="password" placeholder="Пароль" minlength="8" required>
								<span @click="sign=!sign" id="reg">Уже есть аккаунт?</span>
								<button @click="goClick(false)" id="go" formmethod="post">Зарегистрироваться</button>
							</form>
						</div>
					</div>
				</div>
			</Transition>
		</template>
	</div>
</template>

<style>
#go{
	float: right;
	padding: 8px 12px;
	margin-top: 15px;
	background: #012a77;
	border: none;
	color: #fff;
	border-radius: 1px;
	cursor: pointer;
}
#go:hover, #go:active, #go:focus{
	background-color: #0f6cbf;
}
#reg{
	font-size: 13px;
	margin-top: 20px;
}
#popupTitle{
	margin-top: 0;
	color: white;
	transform: translate(0%, -25%);
}
.modal-mask{
	position: fixed;
	z-index: 9998;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, 0.5);
	display: table;
	transition: opacity 0.3s ease;
}
.modal-wrapper{
	display: table-cell;
	vertical-align: middle;
}
.modal-container{
	width: 300px;
	margin: 0px auto;
	padding: 20px 30px;
	background-color: #eee;
	border-radius: 2px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
	transition: all 0.3s ease;
	background: linear-gradient(180deg, rgba(1,42,119,1) 0%, rgba(1,42,119,1) 23%, rgba(238,238,238,1) 24%, rgba(238,238,238,1) 100%);
	border-bottom: 5px solid #012a77;
}
.modal-enter-from, .modal-leave-to{
  opacity: 0;
}
.modal-enter-from .modal-container, .modal-leave-to .modal-container{
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
}
#headerVue{
	display: grid;
	grid-template-rows: 50px;
	grid-template-columns: 100%;
}
#navbar{
	position: absolute;
	opacity: 0.8;
	z-index: 9;
	width: 100%;
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
.header_button:hover, .header_button:focus, .header_button:active{
	font-size: 18px;
}
#main_header{
	background-color: #012a77;
	color: white;
	display: grid;
	grid-template-columns: 20% 80%;
	z-index: 18;
	box-shadow: 0px 5px 5px 2px rgba(6, 22, 34, 0.35);
}
.example-slide{
	align-items: center;
 	background-color: #666;
  	color: #999;
  	display: flex;
  	font-size: 1.5rem;
  	justify-content: center;
  	min-height: 250px;
  	width: 100%;
}
#logo{
	filter: grayscale(100%) invert(100%) brightness(100);
	margin-left: 20px;
	height: 50px;
}
.button{
	display: inline-block;
	font-family: "Montserrat", sans-serif;
	-webkit-font-smoothing: antialiased;
	position: relative;
	padding: 0.8em 1.4em;
	padding-right: 4.7em;
	background: #5a7ec9;
 	border: none;
	color: white;
	transition: 0.2s;
	width: 12em;
	height: 30px;
	margin-top: 10px;
	border-radius: 10px;
	box-shadow: 7px 8px 10px -6px rgba(6, 22, 34, 0.75);
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
.button:hover, .button:active, .button:focus{
	background: #0f6cbf;
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
#avatar, .button{
	float: right;
	margin-right: 25px;
}
#avatar{
	height: 50px;
}
#images{
	margin-bottom: 20px;
}
#close{
	height: 30px;
	width: 30px;
	position: absolute;
	right: calc(50% - 160px);
	background-color: rgba(0, 0, 0, 0);
	border: 0;
	font-size: 20px;
	color: white;
	transform: translate(0%, -30%);
	z-index: 9999;
}
input:focus{
	outline: 0;
}
input{
	width: 275px;
	padding: 10px;
	border: none;
	border-radius: 1px;
}
#reg, #go{
	display: inline-block;
}
input:invalid, input:reqired{
	border: 2px dashed red;
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
			show: false,
			sign: false,
		}
	},
	methods:{
		swap: function(m){
			//Переключение отображения страниц
			this.$emit('swap', {
				mode: m,
			});
		},
		loginClick: function(){
			this.show = true;
		},
		goClick: function(f){
			const form = document.querySelector('form');
			form.addEventListener('submit', evt => {
				evt.preventDefault();
				let user;
				if(f){
					user = {
						login: document.querySelector("#email").value,
						password: document.querySelector("#password").value,
					}
				}else{
					user = {
						name: document.querySelector("#name").value,
						lastname: document.querySelector("#lastname").value,
						login: document.querySelector("#email").value,
						password: document.querySelector("#password").value,
					}
				}
				fetch('./php/' + (f ? 'testreg' : 'save_user') + '.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					console.log(data);
				}).catch((error) => {
					console.warn(error);
				});
			});
			document.querySelector("#go").click();
		}
	},
	mounted(){
		this.$nextTick(function(){
			this.data = [
        		'<div class="imgContainer"><img src=".' + require(`../assets/ban2.png`) + '" alt="baner" class="example-slide"></div>',
        		'<div class="imgContainer"><img src=".' + require(`../assets/ban2.png`) + '" alt="baner" class="example-slide"></div>',
        		'<div class="imgContainer"><img src=".' + require(`../assets/ban2.png`) + '" alt="baner" class="example-slide"></div>',
			];
			let width = document.querySelector("#app").clientWidth;
			let slHeight = width / 2.88;
			document.querySelector("#images").style.height = slHeight + "px";
			document.querySelector("#headerVue").style.gridTemplateRows = "50px " + (slHeight > 250 ? slHeight : 250) + "px";
		})
	}
}
</script>