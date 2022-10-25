<template>
	<div id="home">
		<div id="about_container">
			<h2 id="aboutH">О нас</h2>
			<div id="about">
				<p>Проект дополнительного образования Дом научной коллаборации реализован в рамках федерального проекта «Успех каждого ребенка» национального проекта «Образование». Татарстанский Дом научной коллаборации находится в Елабуге. <br>Важными задачами ДНК являются развитие у детей навыков проектной и творческой работы, а также обучение по приоритетным направлениям научно-технологического развития, среди которых робототехника, информационные и биотехнологии.</p>
			</div>
			<img src="@/assets/photo1.jpeg" alt="photo" class="about_image">
		</div>
		<br>
		<hr>
		<div id="miniCoursesContainer">
			<h2>Курсы</h2>
			<div id="miniCourses">
				<div class="miniCourse" v-for="item in shortList"> 
					<h3 class="miniTitle">{{item.shortTitle}}</h3>
					<div class="miniCourseCont">
						<div class="miniImgCont"><img class="miniImg" :src="item.img" alt="courseImg"></div>
						<div class="miniText">{{item.shortText}}</div>
						<div class="miniButCont"><button @click="" class="miniBut">Перейти</button></div>
					</div>
				</div>
			</div>
			<button @click="coursesGo" id="more">Ещё</button>
		</div>
		<div id="news">
			<h2 id="newsH">Новости</h2>
		</div>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1122.4925365917768!2d52.016251975954!3d55.75876150433705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8fb0d1ea907eedb9!2zNTXCsDQ1JzMxLjUiTiA1MsKwMDEnMDIuNSJF!5e0!3m2!1sru!2sru!4v1666250654230!5m2!1sru!2sru" width="600" height="256" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
</template>

<style>
#aboutH{
	grid-column: 1/3;
	width: 60%;
	background-color: orange;
	color: white;
}
.triangle-right {
    width: 0;
    height: 0;
    border-top: 100px solid transparent;
    border-left: 200px solid orange;
    border-bottom: 100px solid transparent;
}
#miniCourses{
	display: grid;
	grid-template-columns: 30% 30% 30%;
	justify-content: space-around;
}
.miniImg{
	width: 100%;
}
.miniImgCont{
	margin-bottom: 15px;
}
.miniBut{
	font-size: 16px;
	margin: 15px;
}
.miniText{
	display: block;
	text-align: justify;
}
.miniCourse{
	padding: 0 8%;
}
#more{
	margin-top: 20px;
}
#miniCoursesContainer{
	text-align: center;
	margin: 20px;
}
iframe{
	width: 100% !important;
	margin-top: 50px;
}
#about_container{
	margin-bottom: 10px;
	display: grid;
	grid-template-columns: 60% 40%;
	padding-right: 20px;
	padding-top: 20px;
}
.about_image{
	margin: 0 20px 20px 0;
	width: 100%;
}
hr{
	width: 85%
}
@media(max-width: 600px){
	#miniCourses{
		grid-template-columns: 90%;
	}
	.miniCourse{
		margin-bottom: 20px;
	}
	#sponsors{
		grid-template-columns: 50px 50px 50px 50px 50px;
	}
	.sponsor{
		height: 50px;
	}
	.about_image{
		display: none;
	}
}
</style>

<script>

export default{
	name: 'home',
	props: [],
	data(){
		return{
		}
	},
	computed:{
		shortList: function(){
			return curData.slice(0, 3)
		}
	},
	methods:{
		coursesGo: function(){
			this.$emit('coursesGo', {});
		},
	}
}
</script>