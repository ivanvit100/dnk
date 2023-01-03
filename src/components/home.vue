<template>
	<div id="home">
		<div id="about_container">
			<div class="hLeft" id="homeH"><h2 id="aboutH">О нас</h2></div>			
			<div id="about">
				<p>Проект дополнительного образования Дом научной коллаборации реализован в рамках федерального проекта «Успех каждого ребенка» национального проекта «Образование». Татарстанский Дом научной коллаборации находится в Елабуге. <br>Важными задачами ДНК являются развитие у детей навыков проектной и творческой работы, а также обучение по приоритетным направлениям научно-технологического развития, среди которых робототехника, информационные и биотехнологии.</p>
			</div>
			<img src="@/assets/photo1.jpeg" alt="photo" class="about_image">
		</div>
		<br>
		<hr>
		<div id="miniCoursesContainer">
			<div class="hBackCenter">
				<h2>Курсы</h2>
			</div>
			<div id="miniCourses">
				<div class="miniCourse" v-for="item in items"> 
					<h3 class="miniTitle">{{item.shortTitle}}</h3>
					<div class="miniCourseCont">
						<div class="miniImgCont"><img class="miniImg" :src="item.img" alt="courseImg"></div>
						<div class="miniText">{{item.shortText}}</div>
					</div>
					<div class="miniButCont"><button @click="courseMore(item.courseId)" class="miniBut">Перейти</button></div>
				</div>
			</div>
			<button @click="coursesGo" id="more">Ещё</button>
		</div>
		<br>
		<hr>
		<div id="news">
			<div class="hBackCenter">
				<h2 id="newsH">Новости</h2>
			</div>
			<center><div id="vk_groups"></div></center>
		</div>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1122.4925365917768!2d52.016251975954!3d55.75876150433705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8fb0d1ea907eedb9!2zNTXCsDQ1JzMxLjUiTiA1MsKwMDEnMDIuNSJF!5e0!3m2!1sru!2sru!4v1666250654230!5m2!1sru!2sru" width="600" height="256" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
</template>

<style>
#homeH{
	grid-column: 1/3;
	margin-bottom: -22px;
	z-index: 2;
}
.hLeft{
	margin-top: 15px;
	height: 45px;
	background-image: url("http://dnk.ivanvit.ru/static/img/lineleft.png");
	background-repeat: no-repeat;
	background-size: contain;
	color: white;
}
#aboutH{
	margin-left: 15px;
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
.miniButCont{
	position: absolute;
	left: calc(50% - 56px);
	bottom: 0px;
}
.miniText{
	display: block;
	text-align: justify;
}
.miniCourse{
	padding: 0 8% 57px 8%;
	position: relative;
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
#about{
	border: 2px solid grey;
	border-radius: 0 10px 10px 0;
	background: #fff;
	border-collapse: separate;
	border-spacing: 20px 10px;
	padding: 20px 15px 2px 15px;
	width: 85%;
	position: relative;
}
#news{
	margin-bottom: 30px;
}
@media(max-width: 600px){
	#about_container{
		grid-template-columns: 100%;
	}
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
	#about{
		width: 95%;
	}
}
</style>

<script>
export default{
	name: 'home',
	props: [],
	data(){
		return{
			items: [curData["robo"], curData["dmodel"], curData["promdesign"]],
		}
	},
	methods:{
		coursesGo: function(){
			this.$router.push({name: 'courses'});
			window.scroll(0, 0);
		},
		courseMore: function(id){
			this.$router.push({name: 'course', params: {courseId: id}});
			window.scroll(0, 0);
		}
	},
	mounted(){
		let width = document.querySelector("#app").clientWidth;
		document.querySelector("#headerVue").classList.remove("courseHide");
		VK.Widgets.Group("vk_groups", {mode: 2, width: width * 0.95, height: "300"}, 198006866);
	}
}
</script>