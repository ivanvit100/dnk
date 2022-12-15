<template>
	<div id="cabinet">
		<div id="profile" style="padding-bottom: 20px">
			<center id="nameCont">
				<h2 id="fullname">{{name}} {{surname}}</h2>
				<hr class="orangeUnderline">
			</center>
			<p class="email"><b>Email:</b> {{email}}</p>
			<p class="phone"><b>Телефон:</b> {{phone}}</p>
			<div class="header_button" id="exit" @click="exit">Выйти</div>
		</div>
		<div id="misses" v-if="missesTitle">
			<h2>Пропуски</h2>
			<p class="passes" v-for="item in passes">{{item}}</p>
		</div>
		<div id="func" v-else>
			<h2>Панель</h2>
			<div id="find" v-if="find">
				<input id="findInput" type="text" placeholder="Email">
				<button @click="findUser">Найти</button>
				<br>
				<span id="findStatus">{{findStatus}}</span>
			</div>
			<div id="addFind" v-else>
				<p id="findName"><b>Имя: </b>{{findName}} {{findSurname}}</p>
				<p id="findPhone" class="blueLine"><b>Телефон: </b>{{findPhone}}</p>
				<p id="findGroup"><b>Роль: </b>{{findGroup}}</p>
				<button id="cancel" @click="cancel">Отмена</button>
				<button id="addGroup" @click="readyAdd">Повысить</button>
			</div>
		</div>
		<div id="subscribe">
			<h2>Курсы</h2>
			<span id="subscribeStatus">{{subscribeStatus}}</span>
			<p class="coursesSubscribe" v-for="item in courses" @click="courseMore(item.href)">{{item.name}}</p>
		</div>
	</div>
</template>

<style scoped>
#findStatus{
	color: red;
}
#find > button, #addFind > button{
	height: 44px;
	margin-left: 0;
	top: -1px;
	left: -5px;
	position: relative;
	background-color: #f77d24;
	border: 2px solid #f77d24;
	color: white;
	width: 70px;
}
#find > button:hover, #addFind > button:hover{
	background-color: #d47837;
}
#addFind > button:hover{
	top: 2px;
}
#addFind > button{
	width: 100px;
	margin: 20px 15px 10px 15px;
}
#cancel{
	background-color: #d47837 !important;
}
.orangeUnderline{
	width: 200px;
	background-color: #f77d24;
	height: 5px;
}
#subscribe{
	border: 1px solid gray;
	background-color: white;
}
.coursesSubscribe{
	border: 1px solid gray;
	margin: 8px;
	border-radius: 5px;
	height: 35px;
	line-height: 35px;
	position: relative;
	padding-left: 20px;
	text-align: initial;
}
.coursesSubscribe::after{
	content: "❯";
	font-size: 20px;
	position: absolute;
	right: 20px;
}
.coursesSubscribe:hover{
	font-size: 17px;
}
.coursesSubscribe:hover::after{
	font-size: 22px;
}
#profile{
	text-align: left;
	padding: 1px 10px 20px 10px;
	margin: 15px 0;
	position: relative;
	background-color: white;
}
#exit{
	position: unset;
	bottom: 10px;
	height: 32px;
}
.passes, #addFind > p{
	position: relative;
	overflow: hidden;
	width: 100%;
	margin: 0 auto;
	background: #333;
	padding: 4%;
	box-sizing: border-box;
	text-align: center;
	display: flex;
	align-items: center;
	color: white;
	border-bottom: 3px solid rgb(230, 96, 46);
}
.blueLine{
	border-bottom: 3px solid rgb(63, 72, 204) !important;
}
#subscribe > h2{
	border-bottom: 5px solid #f77d24;
	max-width: 200px;
	position: relative;
	right: calc(-50% + 100px);
}
#misses, #func{
	background-color: #333;
	color: white;
}
#misses, #subscribe, #func{
	text-align: center;
	margin-top: 15px;
	padding: 15px 0;
	margin-bottom: 20px;
}
#fullname{
	margin-bottom: 7px;
	margin-top: 15px;
}
@media(min-width: 700px){
	#cabinet{
		display: grid;
		grid-template-columns: 350px calc(100% - 350px);
	}
	#misses, #func{
		grid-column: 2;
		grid-row: 1;
		margin: 30px 30px 15px 15px !important;
	}
	#subscribe{
		grid-column: 1/3;
		margin: 15px 30px 30px 30px !important;
	}
	#profile{
		margin: 30px 15px 15px 30px !important;
	}
	#exit{
		position: absolute;
	}
}
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
			passes: ['Подождите...', 'Подождите...', 'Подождите...'],
			courses: [{'name': 'Подождите...', 'href': ''}],
			coursesBeta: [],
			subscribeStatus: 'Подождите...',
			missesTitle: true,
			find: true,
			findName: 'Загрузка...',
			findSurname: 'Загрузка...',
			findEmail: 'Загрузка...',
			findPhone: 'Загрузка...',
			findGroup: 'Загрузка...',
			findStatus: ''
		}
	},
	methods:{
		exit: function(){
			localStorage.clear();
			location.reload()
		},
		courseMore: function(id){
			id == "empty" ? this.$router.push("courses") : this.$router.push({name: 'course', params: {courseId: id}});
			window.scroll(0, 0);
		},
		findUser: function(){
			this.findEmail = document.querySelector("#findInput").value;
			let user = {
				ID: localStorage.getItem('id'),
				Email: this.findEmail,
				Mode: true
			}
			fetch('http://dnk.ivanvit.ru/php/admincheckinfo.php', {
				method: 'POST',
				body: JSON.stringify(user)
			}).then((response) => {
				return response.json()
			}).then((data) => {
				if(data['answer']){
					this.findStatus = "";
					this.find = false;
					if(data['Group'] == 1){
						this.findGroup = "Родитель"
					}else{
						data['Group'] == 2 ? this.findGroup = "Преподаватель" : this.findGroup = "Администратор";
					}
					this.findName = data['Name'];
					this.findSurname = data['Surname'];
					this.findPhone = data['Phone'];
				}else{
					this.findStatus = data['reason'];
				}
			}).catch((error) => {
				console.warn(error);
			});
		},
		readyAdd: function(){
			let user = {
				ID: localStorage.getItem('id'),
				Email: this.findEmail,
				Mode: false
			}
			fetch('http://dnk.ivanvit.ru/php/admincheckinfo.php', {
				method: 'POST',
				body: JSON.stringify(user)
			}).then((response) => {
				return response.json()
			}).then((data) => {
				if(data['answer']){
					this.find = true;
				}
			}).catch((error) => {
				console.warn(error);
			});
		},
		cancel: function(){
			this.find = true;
		}
	},
	mounted(){
		document.querySelector("#headerVue").classList.add("courseHide");
		document.querySelector("#misses").querySelectorAll("p")[1].style.borderBottom = "3px solid rgb(63,72,204)";
		document.querySelector("#images").style.display = "none";
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
				this.courses = [];
				if(data['Group'] == 1){
					this.passes = [data['PassOne'] == null ? "Пропусков нет" : data['PassOne'], data['PassTwo'] == null ? "Пропусков нет" : data['PassTwo'], data['PassThree'] == null ? "Пропусков нет" : data['PassThree']];
					document.querySelector("#subscribeStatus").remove();
					try{this.coursesBeta = data['Courses'].split(', ')}
					catch(e){}
					for(var i = 0; i < this.coursesBeta.length; i++){
						this.courses.push({'name': curData[this.coursesBeta[i]]["title"], 'href': this.coursesBeta[i]});
					}
					if(this.courses.length == 0){
						this.courses = [{'name': 'Выбрать курс', 'href': 'empty'}]
					}
				}else if(data['Group'] == 3){
					this.missesTitle = false;
					let keys = Object.keys(curData);
					document.querySelector("#subscribeStatus").remove();
					for(var i = 0; i < keys.length; i++){
						this.courses.push({'name': curData[keys[i]]["title"], 'href': keys[i]});
					}
				}
			}).catch((error) => {
				console.warn(error);
			});
		}
	},
	destroyed(){
		document.querySelector("#images").style.display = "initial";
	}
}
</script>