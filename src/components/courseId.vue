<template>
	<div id="courseId">
		<h2 id="courseTitle"></h2>
		<img src="" alt="course" id="courseImg">
		<p id="courseText"></p>
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
				<input type="text" id="ThirdnameTwo" placeholder="Ваше отчество" minlength="2">
				<input type="text" id="nameTwo" placeholder="Имя второго родителя" minlength="2">
				<input type="text" id="lastnameTwo" placeholder="Фамилия второго родителя" minlength="2">
				<input type="text" id="ThirdnameThree" placeholder="Отчество второго родителя" minlength="2">
				<button id="goReady" formmethod="post"></button>
			</form>
			<p id="status"></p>
		</div>
	</div>
</template>

<style scoped="true">
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
		}
	},
	computed:{
		write: function(){
			return localStorage.getItem('login') == null
		}
	},
	mounted(){
		document.querySelector("#headerVue").classList.add("courseHide");
		var courseId = this.$route.params.courseId;
		this.$nextTick(function(){
			document.querySelector("#courseTitle").innerText = curData[courseId]['title'];
			document.querySelector("#courseImg").src = curData[courseId]['img'];
			document.querySelector("#courseText").innerText = curData[courseId]['text'];
		})
	}
}
</script>