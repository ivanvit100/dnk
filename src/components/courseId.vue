<template>
	<div id="courseId">
		<h2 id="courseTitle"></h2>
		<div class="table_center_by_css">
			<div data-role="splitter" class="h-100" data-split-sizes="75, 25" data-split-mode="vertical" id="titleImg">
    			<div @dblclick="dataShow(true)" class="d-flex flex-justify-center flex-align-center" id="firstDataShow"><img src="" alt="course" id="courseImg"></div>
    			<div @dblclick="dataShow(false)" class="d-flex flex-justify-center flex-align-center" id="secondDataShow">
       				<table class="table">
       					<caption><h2>Расписание</h2></caption>
						<thead>
							<tr>
								<th>Группа</th>
								<th>Дни недели</th>
								<th>Время</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in timetable">
								<td>{{item.group}}</td>
								<td>{{item.days}}</td>
								<td>{{item.time}}</td>
							</tr>
						</tbody>
					</table>
    			</div>
			</div>
			<p id="courseText"></p>
			<b id="ages"></b>
			<hr>
			<div id="courseWrite" v-if="!write">
				<h4>Записаться на курс</h4>
				<h5>Выберите возрастную группу:</h5>
				<div class="select">
					<select v-model="selectedGroup">
						<option v-for="item in groups" v-bind:value="item">{{item}} классы</option>
					</select>
				</div>
				<form>
					<h5>Данные ребёнка</h5>
					<input type="text" id="name" placeholder="Имя" minlength="2" required>
					<input type="text" id="lastname" placeholder="Фамилия" minlength="2" required>
					<input type="text" id="thirdname" placeholder="Отчество" minlength="2">
					<input type="text" data-role="calendarpicker" data-input-format="%d/%m/%y" data-locale="ru-RU" data-cls-calendar="compact" placeholder="Дата рождения" id="date" data-week-start="1" required>
					<input type="text" id="placeOne" placeholder="Место рождения" minlength="2" required>
					<input type="text" id="placeTwo" placeholder="Прописка" minlength="2" required>
					<h5>Данные родителей</h5>
					<input type="text" id="nameOne" placeholder="Ваше имя" minlength="2" readonly required="">
					<input type="text" id="lastnameOne" placeholder="Ваша фамилия" minlength="2" readonly required="">
					<input type="text" id="thirdnameOne" placeholder="Ваше отчество" minlength="2">
					<input type="text" id="nameTwo" placeholder="Имя второго родителя" minlength="2">
					<input type="text" id="lastnameTwo" placeholder="Фамилия второго родителя" minlength="2">
					<input type="text" id="thirdnameTwo" placeholder="Отчество второго родителя" minlength="2">
					<p id="status"></p>
					<center id="buttonCenterBlock"><button @click="courseWrite" id="goWrite" class="miniBut" formmethod="post">Отправить</button></center>
				</form>
			</div>
			<p class="noReg" v-else>Зарегистрируйтесь, чтобы записать ребёнка на этот курс.</p>
		</div>
	</div>
</template>

<style>
#goWrite{
	width: 120px;
}
#titleImg{
	height: 70vh !important;
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
</style>

<style scoped>
.button{
	position: relative !important;
	right: -20px !important;
	margin: 0 !important;
}
#courseTitle{
	height: 32px;
	position: relative;
	margin-top: 25px;
	background-color: orange !important;
}
input{
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
	padding: .01em .95em;
	background-color: rgba(200, 200, 200, .95);
	transition: all .25s ease;
	pointer-events: none;
	border-radius: 1px;
	color: white;
}
.select:hover::after{
	background-color: orange;
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
			wait: false,
			groups: []
		}
	},
	computed:{
		write: function(){
			return localStorage.getItem('login') == null
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
						this.wait = false;
						document.querySelector("#status").innerHTML = data['reason'];
					}).catch((error) => {
						console.warn(error);
					});
				}
			});
		},
		dataShow: function(f){
			event.preventDefault();
			document.querySelector("#firstDataShow").style.flexBasis = "calc(" + (f ? "90" : "10") + "% - 4px)";
			document.querySelector("#secondDataShow").style.flexBasis = "calc(" + (f ? "10" : "90") + "% - 4px)";
		}
	},
	mounted(){
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
			document.querySelector("#nameOne").value = localStorage.getItem('name');
			document.querySelector("#lastnameOne").value = localStorage.getItem('surname');
		})
	}
}
</script>