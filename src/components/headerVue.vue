<!--File written by develope@ivanvit.ru (ivanvit100@gmail.com)-->
<template>
	<div id="headerVue">
		<!--Header component-->
		<div id="main_header">
			<!--Login-->
			<picture>
				<source srcset="/static/img/logo2.webp" type="image/webp">
				<img src="/static/img/logo2.png" alt="logo" id="logo">
			</picture>
			<div id="login" v-if="!login">
				<a @click="loginClick" class="orange-btn">Войти<i class="fa fa-arrow-right"></i></a>
			</div>
			<div id="cabinet" v-else>
				<picture>
					<source @click="cabinetMenu" srcset="/static/img/account.webp" type="image/webp">
					<img @click="cabinetMenu" src="/static/img/account.png" alt="avatar" id="avatar">
				</picture>
			</div>
		</div>
		<!--Navbar-->
		<div id="navbar">
			<div class="header_button" @click="move('home')">Главная</div>
			<div class="header_button" @click="move('courses')">Курсы</div>
			<div class="header_button" @click="move('contacts')">Контакты</div>
		</div>
		<!--Slider -->
		<div id="images">
			<picture>
				<source srcset="/static/img/edge.webp" type="image/webp">
				<img src="/static/img/edge.png" alt="" id="edge">
			</picture>
			<div id="logoSlider">
				<center>
					<div id="headText">
						Дом научной коллаборации имени<br>
						Камиля Ахметовича Валиева
					</div>
					<picture>
						<source srcset="/static/img/logo3.webp" type="image/webp">
						<img src="/static/img/logo3.png" alt="logo">
					</picture>
				</center>
			</div>
			<div id="carouselWrap">
				<div data-role="carousel" data-bullet-style="rect" data-control-next="<span class='mif-chevron-right'></span>" data-height="16/9" data-cls-bullet-on="bg-orange drop-shadow" data-cls-controls="fg-white" data-control-prev="<span class='mif-chevron-left'></span>" data-controls-on-mouse="true" data-auto-start="true" data-period="10000" data-duration="750">
					<div class="slide" data-cover="http://dnk.ivanvit.ru/static/img/white.jpg"></div>
					<div class="slide" data-cover="http://dnk.ivanvit.ru/static/img/white.jpg"></div>
					<div class="slide" data-cover="http://dnk.ivanvit.ru/static/img/white.jpg"></div>
				</div>
			</div>
			<div id="shadow"></div>
		</div>
		<!--Authorisation modal-->
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
								<button id="goReady" formmethod="post"></button>
							</form>
							<p id="status"></p>
							<span @click="sign=!sign" id="reg">Зарегистрироваться</span>
							<button @click="goClick(true)" id="go" :key="key" type="button">Войти</button>
						</div>
						<div class="modal-container" v-else>
							<button @click="show=!show" id="close">x</button>
							<h2 id="popupTitle">Регистрация</h2>
							<form>
								<input type="text" id="name" placeholder="Имя" minlength="2" required>
								<input type="text" id="lastname" placeholder="Фамилия" minlength="2" required>
								<input type="tel" id="phone" placeholder="Телефон" minlength="11" maxlength="12" required>
								<input type="email" id="email" placeholder="Почта" required>
								<input type="password" id="password" placeholder="Пароль" minlength="8" required>
								<button id="goReady" formmethod="post"></button>
							</form>
							<p id="status"></p>
							<span @click="sign=!sign" id="reg">Уже есть аккаунт?</span>
							<button @click="goClick(false)" id="go" :key="key" type="button">Зарегистрироваться</button>
						</div>
					</div>
				</div>
			</Transition>
		</template>
	</div>
</template>

<style>
#shadow{
	position: absolute;
	width: 100%;
	height: 20px;
	bottom: 0;
	box-shadow: 0px -7px 5px -5px rgba(0, 0, 0, 0.6) inset;
	z-index: 3;
}
#headText{
	position: absolute;
	z-index: 99;
	font-size: 30px;
	text-align: center;
	color: white;
	top: 40px;
	text-shadow: 2px 2px 0 #333, 2px -2px 0 #333, -2px 2px 0 #333, -2px -2px 0 #333, 2px 0px 0 #333, 0px 2px 0 #333, -2px 0px 0 #333, 0px -2px 0 #333;
}
#logoSlider{
	position: absolute;
	left: calc((100vw - 830px)/2 - 5vw);
	z-index: 9;
	top: 280px;
	width: 25vw;
	transform: translate(0%, -60%);
}
#logoSlider > center > picture > source, #logoSlider > center > picture > img{
	width: calc(100vw - 730px);
	max-width: 250px;
	opacity: 0.6;
}
.carousel{
	position: absolute;
	right: 0;
}
.slide, .carousel{
	max-width: 800px !important;
	max-height: 450px;
}
#carouselWrap{
	width: 100%;
	position: relative;
}
#edge{
	position: absolute;
	height: 100%;
	z-index: 3;
	left: calc(100vw - 850px);
	width: 150px;
}
#goReady{
	opacity: 0;
	position: absolute;
	top: -1000px;
	left: -1000px;
}
#go{
	float: right;
	padding: 8px 12px;
	margin-top: 15px;
	background: #f77d24;
	border: none;
	color: #fff;
	border-radius: 1px;
	cursor: pointer;
	font-size: 12px;
}
#go:hover, #go:active, #go:focus{
	background-color: orange;
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
	width: 335px;
	margin: 0px auto;
	padding: 20px 30px;
	background-color: #eee;
	border-radius: 2px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
	transition: all 0.3s ease;
	background: linear-gradient(180deg, #f77d24 0%, #f77d24 50px, rgba(238,238,238,1) 51px, rgba(238,238,238,1) 100%);
	border-bottom: 5px solid #f77d24;
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
	background-color: rgba(255, 255, 255, 0.95);
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
	color: white;
	display: grid;
	grid-template-columns: 20% 80%;
	z-index: 18;
	box-shadow: 0px 5px 5px 2px rgba(6, 22, 34, 0.35);
}
#logo{
	height: 50px;
}
.orange-btn{
  background: #f77d24;
  display: inline-block;
  color: #fff;
  text-decoration: none;
  text-transform: uppercase;
  font-family: Sans-serif;
  font-size: 18px;
  padding-left: 15px;
  height: 50px;
  float: right;
}
.orange-btn i{
  display: inline-block;
  border-left: 1px solid rgba(255, 255, 255, 0.35);
  padding: 15px;
  margin-left: 15px;
}
.orange-btn:hover{
	background-color: #ba5800;
}
#avatar{
	float: right;
	margin-right: 25px;
}
#avatar{
	height: 40px;
	margin-top: 5px;
}
#avatar:hover{
	height: 41px;
	margin-top: 4px;
}
#images{
	background-color: white;
	margin-bottom: 20px;
	max-height: 450px;
	max-width: 100%;
	position: relative;
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
	margin-bottom: 15px;
	background-color: white;
}
#reg, #go{
	display: inline-block;
}
#status{
	font-size: 13px;
	color: red;
}
.courseHide{
	grid-template-rows: 80px !important;
}
.courseHide > center > #images{
	display: none !important;
}
.courseHide > #navbar{
	z-index: 9998;
}
.waitStatus{
	color: black !important;
}
@media(max-width: 600px){
	.button, .button:before, .button:after{
		font-size: 10px;
	}	
}
@media(max-width: 800px){
	#edge, #logoSlider{
		display: none;
	}	
}
@media(max-width: 1100px){
	#headText{
		display: none;
	}
	#logoSlider > center > picture > source, #logoSlider > center > picture > img{
		opacity: 1;
	}
	#logoSlider{
		transform: translate(0%, -80%);
	}
}
</style>

<script>
import Vue from 'vue';

export default{
	name: 'headerVue',
	props: ['mode'],
	data(){
		return{
			show: false, //For authorisation modal
			sign: false, //Login or sign in
			login: localStorage.getItem('login'), //User's login
			wait: false, //For blocking double request
			key: 0
		}
	},
	watch:{
		sign(newVal, oldVal){
			document.querySelector("#email").style.border = "none";
			document.querySelector("#password").style.border = "none";
			document.querySelector("#status").innerHTML = "";
		},
	},
	methods:{
		cyrb53: function(str, seed = 0){
			//A function that encrypts password before sending on server
			let h1 = 0xdeadbeef ^ seed;
			let h2 = 0x41c6ce57 ^ seed;
			for(let i = 0, ch; i < str.length; i++){
				ch = str.charCodeAt(i);
				h1 = Math.imul(h1 ^ ch, 2654435761);
				h2 = Math.imul(h2 ^ ch, 1597334677);
			}
			h1 = Math.imul(h1 ^ (h1 >>> 16), 2246822507) ^ Math.imul(h2 ^ (h2 >>> 13), 3266489909);
			h2 = Math.imul(h2 ^ (h2 >>> 16), 2246822507) ^ Math.imul(h1 ^ (h1 >>> 13), 3266489909);
			return 4294967296 * (2097151 & h2) + (h1 >>> 0);
		},
		move: function(way){
			//Push user to other page
			this.$router.push({name: way})
		},
		loginClick: function(){
			//Show a login modal window
			this.show = true;
		},
		goClick: function(f){
			//A function that authorizes the user when the a button is clicked
			const form = document.querySelector('form');
			form.addEventListener('submit', evt => {
				evt.preventDefault();
				let user;
				if(f){
					//Data for login
					user = {
						login: document.querySelector("#email").value,
						password: this.cyrb53(document.querySelector("#password").value),
					}
				}else{
					//Data for sig in
					user = {
						name: document.querySelector("#name").value,
						surname: document.querySelector("#lastname").value,
						phone: document.querySelector("#phone").value,
						login: document.querySelector("#email").value,
						password: this.cyrb53(document.querySelector("#password").value),
					}
				}
				//If any function isn't go now
				if(!this.wait){
					this.wait = true;
					document.querySelector("#status").innerHTML = "Подождите...";
					document.querySelector("#status").classList.add("waitStatus");
					fetch('http://dnk.ivanvit.ru/php/' + (f ? 'testreg' : 'save_user') + '.php', {
						method: 'POST',
						body: JSON.stringify(user)
					}).then((response) => {
						return response.json()
					}).then((data) => {
						this.login = data['answer'];
						if(!this.login){//Check server's answer
							if(!this.sign){
								document.querySelector("#email").style.border = "1px dashed red";
								document.querySelector("#password").style.border = "1px dashed red";
							}
							document.querySelector("#status").classList.remove("waitStatus");
							document.querySelector("#status").innerHTML = data['reason'];
						}else{
							//If success - set data in localStorage
							localStorage.setItem('login', true);
							localStorage.setItem('name', f ? data['name'] : user.name);
							localStorage.setItem('surname', f ? data['surname'] : user.surname);
							localStorage.setItem('email', f ? data['email'] : user.login);
							localStorage.setItem('id', data['id']);
							localStorage.setItem('Role', f ? data['role'] : 1);
							//Close modal
							document.querySelector("#close").click();
							this.login = true;
							//Update and re-render page for synchronization
							this.$emit('updateIndex');
						}
					}).catch((error) => {
						console.warn(error);
						document.querySelector("#status").innerHTML = "Ошибка!";
					});
					this.wait = false;
				}
			});
			document.querySelector("#goReady").click();
		},
		cabinetMenu: function(){
			//Push the user to personal cabinet
			this.$router.push({name: 'cabinet'})
		}
	},
	mounted(){
		this.$nextTick(function(){
			//Set params for header block
			let width = document.querySelector("#app").clientWidth;
       		let slHeight = (width * 9 / 16) <= 450 ? width * 9 / 16 : 450;
        	document.querySelector("#images").style.height = slHeight + "px";
        	document.querySelector("#headerVue").style.gridTemplateRows = "50px " + slHeight + "px";
		})
	}
}
</script>