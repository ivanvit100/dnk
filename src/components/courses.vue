<template>
	<div id="courses">
		<div class="hBackCenter">
			<h2 id="courseTitle">Курсы</h2>
		</div>
		<div class="table_center_by_css" v-for="item in coursesData"> 
			<h3 class="th_css">{{item.title}}</h3>
			<div class="courseCont">
				<div class="td_css_3"><img class="courseImg" :src="item.img" alt="courseImg"></div>
				<div class="td_css">{{item.text}}</div>
				<b>Возраст: {{item.age}} класс</b>
				<div class="td_css_2"><button @click="courseMore(item.courseId)" class="button_css">Перейти</button></div>
			</div>
		</div>
	</div>
</template>

<style>
#courseTitle{
	height: 32px;
	width: 100%;
	background-color: orange;
	color: white;
	margin-top: 30px;
}
#courses{
	text-align: center;
}
.table_center_by_css{
	text-align: center;
	margin: 30px 0;
}
.courseCont{
	display: grid; 
	grid-template-columns: 40% 60%;
}
.th_css{
	padding: 15px;
	vertical-align: top;
	font-size: 20px;
}
.td_css{
	padding: 20px;
 	vertical-align: top;
	text-align: initial;
}
.button_css{
	padding: 5px;
	position: absolute;
	right: 25px;
}
.td_css_2{
	padding: 20px;
 	margin-right: 20px;
}
.td_css_3{
	padding: 20px;
}
.courseImg{
	max-width: 400px;
	width: 100%;
}
@media(max-width: 600px){
	.courseCont{
		grid-template-columns: 100%;
	}
	.th_css, .td_css, .td_css_2, .td_css_3{
		display: block;
	}
}
</style>

<script>
export default{
	name: 'courses',
	props: [],
	data(){
		return{
		}
	},
	computed:{
		coursesData: function(){
    		return curData
    	}
	},
	methods:{
		courseMore: function(id){
			this.$router.push({name: 'course', params: {courseId: id}})
		}
	},
	mounted(){
		document.querySelector("#headerVue").classList.remove("courseHide");
	}
}
</script>