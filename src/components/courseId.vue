<template>
	<div id="courseId">
		<div class="hBackCenter">
			<h2 id="courseTitle"></h2>
		</div>
		<img src="" alt="course" id="courseImg">
		<p id="courseText"></p>
		<p id="places"></p>
		<b id="ages"></b>
		<hr>
		<div id="courseWrite" v-if="!write">
			<h3>Записаться на курс</h3>
			<form>
				<h4>Данные ребёнка</h4>
				<input type="text" id="name" placeholder="Имя" minlength="2" required>
				<input type="text" id="lastname" placeholder="Фамилия" minlength="2" required>
				<input type="text" id="thirdname" placeholder="Отчество" minlength="2">
				<input type="date" id="date" placeholder="Дата рождения" minlength="2" required>
				<input type="text" id="placeOne" placeholder="Место рождения" minlength="2" required>
				<input type="text" id="placeTwo" placeholder="Прописка" minlength="2" required>
				<h4>Данные родителей</h4>
				<input type="text" id="nameOne" placeholder="Ваше имя" minlength="2" readonly required="">
				<input type="text" id="lastnameOne" placeholder="Ваша фамилия" minlength="2" readonly required="">
				<input type="text" id="thirdnameOne" placeholder="Ваше отчество" minlength="2">
				<input type="text" id="nameTwo" placeholder="Имя второго родителя" minlength="2">
				<input type="text" id="lastnameTwo" placeholder="Фамилия второго родителя" minlength="2">
				<input type="text" id="thirdnameTwo" placeholder="Отчество второго родителя" minlength="2">
				<button @click="courseWrite" id="goReady" formmethod="post"></button>
			</form>
			<p id="status"></p>
		</div>
	</div>
</template>

<style>
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
#courseTitle{
	height: 32px;
	position: relative;
	margin-top: 10px;
	background-color: none !important;
}
#courseImg{
	max-width: 100%;
}
</style>

<script>
export default{
	name: 'courseId',
	props: [],
	data(){
		return{
			courseId: '',
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
					patonymic: document.querySelector("#thirdname").value,
					date: document.querySelector("#date").value,
					placeOne: document.querySelector("#placeOne").value,
					placeTwo: document.querySelector("#placeTwo").value,
					nameOne: document.querySelector("#nameOne").value,
					surnameOne: document.querySelector("#lastnameOne").value,
					patronymicOne: document.querySelector("#thirdnameOne").value,
					nameTwo: document.querySelector("#nameTwo").value,
					surnameTwo: document.querySelector("#lastnameTwo").value,
					patronymicTwo: document.querySelector("#nameTwo").value,
				}
				fetch('http://dnk.ivanvit.ru/php/abobus.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					document.querySelector("#status").innerHTML = data['reason'];
				}).catch((error) => {
					console.warn(error);
				});
			});
		}
	},
	mounted(){
		document.querySelector("#headerVue").classList.add("courseHide");
		this.courseId = this.$route.params.courseId;
		this.$nextTick(function(){
			document.querySelector("#courseTitle").innerText = curData[this.courseId]['title'];
			document.querySelector("#courseImg").src = curData[this.courseId]['img'];
			document.querySelector("#courseText").innerText = curData[this.courseId]['text'];
			document.querySelector("#ages").innerText = "Программа обучения предназначена для детей, обучающихся в следующих классах: " + curData[this.courseId]['age'];
			document.querySelector("#places").innerText = "Максимальное число учащихся курса: " + curData[this.courseId]['place'];
			document.querySelector("#nameOne").value = localStorage.getItem('name');
			document.querySelector("#lastnameOne").value = localStorage.getItem('surname');
		})
	}
}
</script>