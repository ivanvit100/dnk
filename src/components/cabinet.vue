<!--File written by develope@ivanvit.ru (ivanvit100@gmail.com)-->
<template>
	<div id="cabinet">
		<!--User information block-->
		<div id="profile" style="padding-bottom: 20px" class="wow fadeInLeft">
			<center id="nameCont">
				<h2 id="fullname">{{name}} {{surname}}</h2>
				<hr class="orangeUnderline">
			</center>
			<p class="email"><b>Email:</b> {{email}}</p>
			<p class="phone"><b>Телефон:</b> {{phone}}</p>
			<div class="header_button" id="exit" @click="exit">Выйти</div>
		</div>
		<div id="misses" v-if="missesTitle" class="wow fadeInRight">
			<!--Block of information about passes for children (if user is parent)-->
			<h2>Пропуски</h2>
			<p class="passes" v-for="item in passes">{{item}}</p>
		</div>
		<div id="func" v-else class="wow fadeInRight">
			<!--User search block, displaying information about him, 
			the possibility of increasing the selected user to the role of a teacher
			(if user is admin)-->
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
		<div id="subscribe" v-bind:style="{margin: activeMargin}" class="wow fadeInUp"> 
			<!--Course subscription block (for parents), 
			List of courses to monitor (for admins),
			List of courses taught (for teachers)-->
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
	text-overflow: ellipsis;
	overflow: hidden;
	white-space: nowrap;
	padding-right: 50px;
}
.coursesSubscribe::before{
	content: "❯";
	font-size: 20px;
	position: absolute;
	right: 20px;
}
.coursesSubscribe:hover{
	font-size: 17px;
}
.coursesSubscribe:hover::before{
	font-size: 22px;
}
#profile{
	text-align: left;
	padding: 1px 10px 20px 10px;
	margin: 15px 0;
	position: relative;
	background-color: white;
	min-height: 200px;
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
.passes{
	text-align: initial !important;
	word-break: break-word;
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
@media(min-width: 820px){
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
			email: 'Подождите...', //Email (will be changed)
			phone: 'Подождите...', //Phone (will be changed)
			passes: ['Подождите...', 'Подождите...', 'Подождите...'], //Misses of courses (will be changed)
			courses: [{'name': 'Подождите...', 'href': ''}], //Data of course's subscribes (will be changed)
			coursesBeta: [], //Support variable
			subscribeStatus: 'Подождите...', //Waiting information for course's subscribes block
			missesTitle: true, //Type of title in block "Misses"
			find: true, //Whether to show the search block to administrators
			findName: 'Загрузка...', //Name in search block (will be changed)
			findSurname: 'Загрузка...', //Surname in search block (will be changed)
			findEmail: 'Загрузка...', //Emain in search block (will be changed)
			findPhone: 'Загрузка...', //Phone in search block (will be changed)
			findGroup: 'Загрузка...', //User's group in search block (will be changed)
			findStatus: '', //Status in search block
			activeMargin: '' //Specific margin style
		}
	},
	methods:{
		exit: function(){
			//Function for exit from account
			localStorage.clear();
			location.reload()
		},
		courseMore: function(id){
			//Push user to courseId.vue
			id == "empty" ? this.$router.push("courses") : this.$router.push({name: 'course', params: {courseId: id}});
			window.scroll(0, 0);
		},
		findUser: function(){
			//Find a user by his email (for admin)
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
					//Set user's role
					if(data['Group'] == 1){
						this.findGroup = "Родитель"
					}else{
						data['Group'] == 2 ? this.findGroup = "Преподаватель" : this.findGroup = "Администратор";
					}
					this.findName = data['Name'];
					this.findSurname = data['Surname'];
					this.findPhone = data['Phone'];
				}else{
					//Response when user not found
					this.findStatus = data['reason'];
				}
			}).catch((error) => {
				console.warn(error);
			});
		},
		readyAdd: function(){
			//Feature to promote a user to a teacher
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
			//Back to user search window
			this.find = true;
		}
	},
	mounted(){
		//Custom styles for the page set
		document.querySelector("#headerVue").classList.add("courseHide");
		document.querySelector("#misses").querySelectorAll("p")[1].style.borderBottom = "3px solid rgb(63,72,204)";
		document.querySelector("#images").style.display = "none";
		//Login check
		if(localStorage.getItem('login') == null){
			this.$router.push({name: 'home'})
		}else{
			//Setting styles to replace block position for teachers
			if(localStorage.getItem("Role") == 2){
				document.querySelector("#misses").style.display = "none";
				document.querySelector("#subscribe").style.border = "none";
				document.querySelector("#subscribe").style.gridColumn = "2";
				document.querySelector("#subscribe h2").style.marginBottom = "7px";
				document.querySelector("#subscribe h2").style.marginTop = "15px";
				this.activeMargin = "30px 30px 15px 15px !important";
			}
			//Get user's data
			let user = {
				ID: localStorage.getItem('id')
			}
			fetch('http://dnk.ivanvit.ru/php/cabinet.php', {
				method: 'POST',
				body: JSON.stringify(user)
			}).then((response) => {
				return response.json()
			}).then((data) => {
				if(!data['answer']){
					//Exit if user not found
					this.exit();
				}
				this.email = data['Email'];
				this.phone = data['Phone'];
				this.courses = [];
				if(data['Group'] == 1){
					//Distribution of data for parents
					this.passes = [data['PassOne'] == "" ? "Пропусков нет" : data['PassOne'], data['PassTwo'] == "" ? "Пропусков нет" : data['PassTwo'], data['PassThree'] == "" ? "Пропусков нет" : data['PassThree']];
					document.querySelector("#subscribeStatus").remove();
					try{this.coursesBeta = data['Courses'].split(', ')}
					catch(e){}
					for(var i = 0; i < this.coursesBeta.length; i++){
						this.courses.push({'name': curData[this.coursesBeta[i]]["title"], 'href': this.coursesBeta[i]});
					}
					if(this.courses.length == 0){
						this.courses = [{'name': 'Выбрать курс', 'href': 'empty'}]
					}
				}else if(data['Group'] == 2){
					//Distribution of data for teachers
					try{this.coursesBeta = data['Courses'].split(', ')}
					catch(e){}
					for(var i = 0; i < this.coursesBeta.length; i++){
						this.courses.push({'name': curData[this.coursesBeta[i]]["title"], 'href': this.coursesBeta[i]});
					}
					if(this.courses.length == 0){
						document.querySelector("#subscribeStatus").innerHTML = "Вы не преподаёте на курсах";
					}else{document.querySelector("#subscribeStatus").remove();}
				}else if(data['Group'] == 3){
					//Distribution of data for admins
					if(window.navigator.userAgent.includes("Safari") && !(window.navigator.userAgent.includes("Chrome") || window.navigator.userAgent.includes("Firefox"))){
						this.$nextTick(function(){
							//Fix styles for Safari
							document.querySelector("#find > button").style.top = "-1px";
							document.querySelector("#addFind > button").style.top = "-1px";
						});
					}
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
		//Delete custom styles
		document.querySelector("#images").style.display = "initial";
	}
}
</script>