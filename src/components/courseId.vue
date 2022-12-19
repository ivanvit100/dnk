<template>
	<div id="courseId">
		<h2 id="courseTitle"></h2>
		<div class="table_center_by_css">
    		<div class="d-flex flex-justify-center flex-align-center" id="titleImg"><img src="" alt="course" id="courseImg"></div>
			<p id="courseText"></p>
			<b id="ages"></b>
			<div id="rasp" @click="raspClick"><img src="@/assets/calendar.png" alt="" id="cal"></div>
			<div id="fullCalWrap" v-if="time" @click="raspClick">
				<img src="/static/img/rasp.svg" alt="Расписание">
			</div>
			<hr>
			<div id="courseWrite" v-if="!write">
				<div v-if="vis">
					<h4 v-if="roleCheck">Ваши дети на курсе</h4>
					<div v-else>
						<h4>Дети на курсе</h4>
						<div class="select">
							<select v-model="selectedGroup">
								<option v-for="item in groups" v-bind:value="item">{{item}} классы</option>
							</select>
						</div>
					</div>
					<ul>
						<li v-for="item in children"><h6>{{item}} <b class="delete" @click="deleteChild(item)" v-if="!teacher">Отписаться</b><b class="delete" @click="miss(item)" v-else>Отметить</b></h6></li>
					</ul>
					<br>
					<hr>
				</div>
				<div v-if="roleCheck">
					<h4>Записаться на курс</h4>
					<h5>Выберите возрастную группу:</h5>
					<div class="select">
						<select v-model="selectedGroup">
							<option v-for="item in groups" v-bind:value="item">{{item}} классы</option>
						</select>
					</div>
					<form>
						<h5>Данные ребёнка</h5>
						<input type="text" v-on:keyup.enter="enterPress" id="name" placeholder="Имя" minlength="2" required>
						<input type="text" v-on:keyup.enter="enterPress" id="lastname" placeholder="Фамилия" minlength="2" required>
						<input type="text" v-on:keyup.enter="enterPress" id="thirdname" placeholder="Отчество" minlength="2">
						<input type="text" v-on:keyup.enter="enterPress" data-role="calendarpicker" data-input-format="%d/%m/%y" data-locale="ru-RU" data-cls-calendar="compact" placeholder="Дата рождения" id="date" data-week-start="1" required>
						<input type="text" v-on:keyup.enter="enterPress" id="placeOne" placeholder="Место рождения" minlength="2" required>
						<input type="text" v-on:keyup.enter="enterPress" id="placeTwo" placeholder="Прописка" minlength="2" required>
						<h5>Данные родителей</h5>
						<input type="text" v-on:keyup.enter="enterPress" id="nameOne" placeholder="Ваше имя" minlength="2" readonly required="">
						<input type="text" v-on:keyup.enter="enterPress" id="lastnameOne" placeholder="Ваша фамилия" minlength="2" readonly required="">
						<input type="text" v-on:keyup.enter="enterPress" id="thirdnameOne" placeholder="Ваше отчество" minlength="2">
						<input type="text" v-on:keyup.enter="enterPress" id="nameTwo" placeholder="Имя второго родителя" minlength="2">
						<input type="text" v-on:keyup.enter="enterPress" id="lastnameTwo" placeholder="Фамилия второго родителя" minlength="2">
						<input type="text" v-on:keyup.enter="enterPress" id="thirdnameTwo" placeholder="Отчество второго родителя" minlength="2">
						<p id="status"></p>
						<center id="buttonCenterBlock"><button @click="courseWrite" id="goWrite" class="miniBut" formmethod="post">Отправить</button></center>
					</form>
				</div>
				<div id="teachList" v-if="admin">
					<h2>Список преподавателей</h2>
					<ul>
						<li v-for="item in teachList"><h6 class="hClass">{{item}}</h6></li>
					</ul>
					<hr>
					<br>
				</div>
				<div id="edit" v-if="admin">
					<h2>Редактирование курса</h2>
					<div>
						<div style="grid-column: 1/3">
							<h5>Выберите возрастную группу:</h5>
							<div class="select aselect">
								<select v-model="selectedGroup">
									<option v-for="item in groups" v-bind:value="item">{{item}} классы</option>
								</select>
							</div>
						</div>
						<div>
							<h3>Количество детей на курсе</h3>
							<input type="text" v-model="numChildren"><button @click="update(4, numChildren)">Обновить</button>
							<br>
							<h3>Описание курса</h3>
							<input type="text" v-model="description"><button  @click="update(3, description)">Обновить</button>
							<br>
						</div>
						<div class="teachersEdit">
							<h3>Добавить преподавателя</h3>
							<input type="text" v-model="addTeach"><button @click="update(1, addTeach)">Обновить</button>
							<br>
							<h3>Удалить преподавателя</h3>
							<div class="select aselect">
								<select v-model="deletedTeach">
									<option v-for="item in emails" v-bind:value="item"  @click="update(2, deletedTeach)">{{item}}</option>
								</select>
							</div>

							<br>
						</div>
					</div>
				</div>
			</div>
			<p class="noReg" v-else>Зарегистрируйтесь, чтобы записать ребёнка на этот курс.</p>
		</div>
	</div>
</template>

<style>
.teachersEdit{
	grid-column: 1;
}
#edit > div{
	display: grid;
	grid-template-columns: 100%;
	width: 100%;
}
#edit > div > div > button{
	height: 34px;
	margin-left: 0;
	top: -1px;
	left: -5px;
	position: relative;
	background-color: #f77d24;
	border: 2px solid #f77d24;
	color: white;
	width: 100px;
}
#edit > div > div > button:hover{
	background-color: #d47837;
}
#fullCalWrap{
	position: fixed;
	width: 100%;
	height: 100vh;
	background-color: rgba(0, 0, 0, 0.6);
	top: 0;
	left: 0;
	z-index: 9999;
	justify-content: center;
	text-align: center;
}
#fullCalWrap > img{
	max-width: 80%;
	max-height: 90%;
	position: fixed;
	top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}
#rasp{
	background-color: #f77d24;
	width: 65px;
	height: 65px;
	border-radius: 90px;
	position: fixed;
	bottom: calc(0vh + 30px);
	right: 30px;
	color: white;
	z-index: 5;
	-webkit-box-shadow: 4px 4px 6px 0px rgba(1, 7, 11, 0.2); 
	-moz-box-shadow: 4px 4px 6px 0px rgba(1, 7, 11, 0.2); 
	box-shadow: 4px 4px 6px 0px rgba(1, 7, 11, 0.2);
	line-height: 65px;
	text-align: center;
}
#rasp:hover{
	right: 28px;
	bottom: 28px;
	background-color: #ba5800;
}
#cal{
	height: 40%;
	margin-top: 17px;
	filter: invert();
}
.delete:hover{
	font-size: 19px;
}
.delete{
	color: #f77d24;
	left: min(100% - 128px, 365px);	
	margin-right: 15px;
	position: absolute;
}
.successStatus{
	color: limegreen !important;
}
#goWrite{
	width: 120px;
}
#titleImg{
	border: 1px solid lightgray;
}
.calendar-content .today{
	background-color: rgba(230, 96, 46, .7) !important;
}
.hBackCenter{
	background-image: url("http://dnk.ivanvit.ru/static/img/linecenter.png");
	background-size: contain;
	text-align: center;
	background-repeat: no-repeat;
	background-position-x: center;
	height: 45px;
	padding-top: 1px;
	margin: 20px;
	position: relative;
	color: white;
}
#courseId{
	text-align: center;
}
#courseImg{
	max-width: 100%;
}
.noReg{
	color: red;
}
.select, input, .input{
	width: 275px !important;
	margin-bottom: 15px !important;
}
.hClass{
	border: none !important;
}
</style>

<style scoped>
li{
	list-style-type: none;
	padding-left: 8px !important;
	position: relative;
}
.aselect{
	width: 369px !important;
}
.button{
	position: relative !important;
	right: -20px !important;
	margin: 0 !important;
}
#courseTitle{
	line-height: 32px;
	height: auto;
	word-break: break-word;
	position: relative;
	margin-top: 25px;
	background-color: orange !important;
}
input, select{
	height: 34px;
	border: 1px solid lightgray;
}
.table_center_by_css{
	margin: 10px;
	padding: 30px 20px;
	text-align: initial;
}
select, #date{
	background-color: white;
	appearance: none;
	outline: 0;
	display: block;
	border: none;
	flex: 1;
	padding: 0 1em;
	border-radius: 1px;
	height: 100%;
}
select::-ms-expand{
	display: none;
}
.select{
	position: relative;
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	width: 297px;
	height: 34px;
	overflow: hidden;
}
.select::after{
	content: "\25BC";
	position: absolute;
	top: 0;
	right: 0;
	padding: .01em 2.75em;
	background-color: rgba(200, 200, 200, .95);
	transition: all .25s ease;
	pointer-events: none;
	border-radius: 1px;
	color: white;
	width: 100px;
}
.select:hover::after{
	background-color: #f77d24;
}
h6{
	border: 1px solid gray;
	border-radius: 3px;
	line-height: 35px;
	margin-right: 10%;
	max-width: 480px;
	word-break: break-word;
	padding-left: 8px;
}
@media(max-width: 725px){
	h6{
		margin-right: 0;
	}
	ul{
		margin: 0;
		padding: 0;
	}
}
@media(min-width: 620px){
	form{
		display: grid;
		grid-template-columns: 50% 50%;
	}
	h5, #buttonCenterBlock, #status{
		grid-column: 1/3;
	}
}
@media(min-width: 825px){
	#edit > div{
		grid-template-columns: 50% 50%;
	}
	.teachersEdit{
		grid-column: 2;
	}
}
@media(min-width: 880px){
	form{
		display: grid;
		grid-template-columns: 33% 33% 33%;
	}
	h5, #buttonCenterBlock, #status{
		grid-column: 1/4;
	}
}
</style>

<script>
export default{
	name: 'courseId',
	props: [],
	data(){
		return{
			courseId: '',
			selectedGroup: '',
			timetable: '',
			numChildren: '',
			description: '',
			addTeach: '',
			removeTeach: '',
			wait: false,
			time: false,
			groups: [],
			children: [],
			teachList: [],
			emails: [],
			vis: false
		}
	},
	computed:{
		write: function(){
			return localStorage.getItem('login') == null
		},
		roleCheck: function(){
			return localStorage.getItem('Role') != "2" && localStorage.getItem('Role') != "3"
		},
		coursesData: function(){
    		return curData
    	},
    	admin: function(){
    		return localStorage.getItem("Role") == "3"
    	},
    	teacher: function(){
    		return localStorage.getItem("Role") == "2"
    	}
	},
	methods:{
		courseWrite: function(){
			const form = document.querySelector('form');
			form.addEventListener('submit', evt => {
				evt.preventDefault();
				let user = {
					courseID: this.courseId,
					parentID: localStorage.getItem('id'),
					name: document.querySelector("#name").value,
					surname: document.querySelector("#lastname").value,
					patronymic: document.querySelector("#thirdname").value,
					date: document.querySelector("#date").value,
					placeOne: document.querySelector("#placeOne").value,
					placeTwo: document.querySelector("#placeTwo").value,
					nameOne: document.querySelector("#nameOne").value,
					surnameOne: document.querySelector("#lastnameOne").value,
					patronymicOne: document.querySelector("#thirdnameOne").value,
					nameTwo: document.querySelector("#nameTwo").value,
					surnameTwo: document.querySelector("#lastnameTwo").value,
					patronymicTwo: document.querySelector("#nameTwo").value,
					group: this.selectedGroup
				}
				if(!this.wait){
					this.wait = true;
					fetch('http://dnk.ivanvit.ru/php/course.php', {
						method: 'POST',
						body: JSON.stringify(user)
					}).then((response) => {
						return response.json()
					}).then((data) => {
						if(data['answer']){
							document.querySelector("#status").classList.add("successStatus");
							let user = {
								courseID: this.courseId,
								parentID: localStorage.getItem('id')
							}
							fetch('http://dnk.ivanvit.ru/php/children.php', {
								method: 'POST',
								body: JSON.stringify(user)
							}).then((response) => {
								return response.json()
							}).then((data) => {
								this.children = data['names'];
							}).catch((error) => {
								console.warn(error);
							});
						}else{
							document.querySelector("#status").classList.remove("successStatus")
						}
						document.querySelector("#status").innerHTML = data['reason'];
					}).catch((error) => {
						console.warn(error);
					});
					this.wait = false;
				}
			});
		},
		enterPress: function(event){
			document.querySelector("#goWrite").click();
		},
		raspClick: function(event){
			this.time = !this.time;
		},
		deleteChild: function(name){
			let user = {
				courseID: this.courseId,
				parentID: localStorage.getItem('id'),
				childName: name
			}
			if(!this.wait){
				this.wait = true;
				fetch('http://dnk.ivanvit.ru/php/coursedelchild.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					if(data['answer']){
						let i = this.children.indexOf(name);
						if(i >= 0){
							this.children.splice(i,1);
						}
					}
				}).catch((error) => {
					console.warn(error);
				});
				this.wait = false;
			}
		},
		miss: function(name){
			let user = {
				courseID: this.courseId,
				teachID: localStorage.getItem('id'),
				childName: name
			}
			if(!this.wait){
				this.wait = true;
				fetch('http://dnk.ivanvit.ru/php/childmiss.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					if(data['answer']){
						let i = this.children.indexOf(name);
						if(i >= 0){
							this.children.splice(i,1);
						}
					}
				}).catch((error) => {
					console.warn(error);
				});
				this.wait = false;
			}
		},
		update: function(mode, text){
			let user = {
				Course: this.courseId,
				ID: localStorage.getItem('id'),
				Group: this.selectedGroup,
				Mode: mode,
				Text: text.replaceAll(',', '`')
			}
			if(!this.wait){
				this.wait = true;
				fetch('http://dnk.ivanvit.ru/php/adminmenu.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					console.log(data['reason']);
					if(data['answer']){
						let i = this.children.indexOf(name);
						if(i >= 0){
							this.children.splice(i,1);
						}
					}
				}).catch((error) => {
					console.warn(error);
				});
				this.wait = false;
			}
		}
	},
	mounted(){
		document.querySelector("#images").style.display = "none";
		document.querySelector("#headerVue").classList.add("courseHide");
		this.courseId = this.$route.params.courseId;
		this.groups = Object.keys(curData[this.courseId]['groups'])
		this.selectedGroup = this.groups[0];
		this.timetable = curData[this.courseId]['timetable'];
		this.$nextTick(function(){
			document.querySelector("#courseTitle").innerText = curData[this.courseId]['title'];
			document.querySelector("#courseImg").src = curData[this.courseId]['img'];
			document.querySelector("#courseText").innerText = curData[this.courseId]['text'];
			document.querySelector("#ages").innerText = "Программа обучения предназначена для детей, обучающихся в следующих классах: " + curData[this.courseId]['age'];
			try{
				document.querySelector("#nameOne").value = localStorage.getItem('name');
				document.querySelector("#lastnameOne").value = localStorage.getItem('surname');
			}catch(e){console.warn("Запись на курс закрыта!")}
			if(!this.write && this.roleCheck){
				let user = {
					courseID: this.courseId,
					parentID: localStorage.getItem('id'),
				}
				fetch('http://dnk.ivanvit.ru/php/children.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					this.children = data['names'];
					Object.keys(this.children).length != 0 ? this.vis = true : this.vis = false;
				}).catch((error) => {
					console.warn(error);
				});
			}else if(!this.write){
				console.log(this.selectedGroup);
				let user = {
					courseID: this.courseId,
					parentID: localStorage.getItem('id'),
					GroupName: this.selectedGroup
				}
				fetch('http://dnk.ivanvit.ru/php/children.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					this.children = data['names'];
					Object.keys(this.children).length != 0 ? this.vis = true : this.vis = false;
				}).catch((error) => {
					console.warn(error);
				});
			}
			if(localStorage.getItem('Role') == 3){
				let user = {
					courseID: this.courseId,
					userID: localStorage.getItem('id')
				}
				fetch('http://dnk.ivanvit.ru/php/teachList.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					this.teachList = data['names'];
					this.emails = data['emails'];
				}).catch((error) => {
					console.warn(error);
				});
			}
		})
	},
	destroyed(){
		document.querySelector("#images").style.display = "initial";
	}
}
</script>