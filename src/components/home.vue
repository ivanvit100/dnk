<!--File written by develope@ivanvit.ru (ivanvit100@gmail.com)-->
<template>
	<div id="home">
		<!--Timetable-->
		<div id="fullCalWrap" v-if="time" @click="raspClick">
			<img src="/static/img/rasp.svg" alt="Расписание" class="wow zoomIn">
		</div>
		<!--Courses list-->
		<div id="coursesContainer" class="wow slideInUp">
			<h2><b>Дом научной коллаборации это:</b></h2>
			<ul>
				<li v-for="item in coursesData" @click="courseMore(item.title)">{{item.shortTitle}}</li>
			</ul>
		</div>
		<!--Sidebar (navigation subbuttons, partners)-->
		<div id="buttons">
			<button @click="raspClick">Расписание</button>
			<button @click="teachers">Педагоги</button>
			<button>Документы</button>
			<button @click="comments">Отзывы</button>
		</div>
		<br>
		<div id="partners" class="wow slideInRight">
			<h3><b>Партнёры</b></h3>
			<picture>
				<source srcset="/static/img/rf.webp" type="image/webp" class="sponsor">
			<img src="/static/img/rf.jpg" alt="logo" class="sponsor">
			</picture>
			<picture>
				<source srcset="/static/img/rt.webp" type="image/webp" class="sponsor">
				<img src="/static/img/rt.png" alt="logo" class="sponsor">
			</picture>
			<picture>
				<source srcset="/static/img/kpfu.webp" type="image/webp" class="sponsor">
				<img src="/static/img/kpfu.png" alt="logo" class="sponsor">
			</picture>
		</div>
		<div id="info">
			<div id="info3">
				<p class="wow slideInRight"><b>Проект дополнительного образования Дом научной коллаборации реализован в рамках федерального проекта «Успех каждого ребенка» национального проекта «Образование». Татарстанский Дом научной коллаборации находится в Елабуге.</b></p> 
				<p class="hide wow slideInRight"><b>Важными задачами ДНК являются развитие у детей навыков проектной и творческой работы, а также обучение по приоритетным направлениям научно-технологического развития, среди которых робототехника, информационные и биотехнологии.</b></p>
			</div>
			<div id="info2" class="wow zoomIn"></div>
			<img src="/static/img/project.png" alt="project">
		</div>
		<!--Widget of VK news-->
		<!--<div id="vk_groups"></div>
		<hr>-->
		<!--Block of reviews-->
		<!--Thanks to
		https://codepen.io/ehsanshahbazii/pen/bGMKEGx-->
		<div id="comments" name="comments" class="wow fadeInUp">
			<div class="container">
				<div class="img_con">
					<img src="">
					<div class="back"></div>
				</div>
				<h4 class="com_h4"></h4>
				<span class="com_span"></span>
				<p class="com_p"></p>
				<div>
					<button class="pre"><</button>
					<button class="next">></button>
				</div>
			</div>
		</div>
		<!--Google Maps-->
		<iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1122.4925365917768!2d52.016251975954!3d55.75876150433705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8fb0d1ea907eedb9!2zNTXCsDQ1JzMxLjUiTiA1MsKwMDEnMDIuNSJF!5e0!3m2!1sru!2sru!4v1666250654230!5m2!1sru!2sru" height="256" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
</template>

<style scoped>
#info{
	grid-column: 1/4;
	grid-row: 3;
	height: 300px;
	margin: 30px 0;
	background-image: url(http://dnk.ivanvit.ru/static/img/fon.jpg);
	background-size: cover;
	position: relative;
	color: white;
}
#info2{
	width: 100%;
	height: 100%;
	background-color: #f77d24;
	opacity: .75;
}
#info3{
	width: 100%;
	font-size: 17.4px;
	padding: 30px;
	display: block;
	position: absolute;
	z-index: 2;
}
#info > img{
	position: absolute;
	z-index: 2;
	width: 120px;
	opacity: .9;
	bottom: 8px;
	right: 8px;
	filter: sepia(10%) grayscale(55%) hue-rotate(200deg);
}
.sponsor{
	width: 100%;
}
#home{
	display: grid;
	padding-top: 30px;
	grid-template-columns: min(100% - 350px, 65%) max(350px, 35%);
	width: 100%;
	background: linear-gradient(180deg, #f77d24 0%, #f77d24 24px, rgba(238,238,238,1) 25px, rgba(238,238,238,1) 100%);
}
#comments, #map{
	grid-column: 1/3;
}
iframe{
	width: 100%;
}
#coursesContainer{
	grid-row: 1/3;
}
#comments, #partners, #coursesContainer{
	border: 0;
	background-color: white;
	margin: 30px;
	padding: 15px 30px;
	text-align: center;
	height: max-content;
}
#vk_groups{
	grid-column: 1/3;
	padding: 0 !important;
	margin: 30px !important;
	height: auto !important;
}
#buttons > button{
	width: calc(100% - 60px);
	height: 40px;
	text-align: center;
	margin: 30px 30px 0 30px;
	display: block;
	border: 0;
	background-color: white;
	font-size: 18px;
}
#buttons > button:hover{
	-webkit-box-shadow: 0px 0px 10px -4px rgba(34, 60, 80, 0.6) inset; 
	-moz-box-shadow: 0px 0px 10px -4px rgba(34, 60, 80, 0.6) inset;
	box-shadow: 0px 0px 10px -4px rgba(34, 60, 80, 0.6) inset;
}
#coursesContainer > h2, #partners > h3{
	color: orange;
}
ul{
	text-align: initial;
}
li{
	margin-bottom: 15px;
	line-height: normal;
	list-style-type: none;
	padding-left: 35px;
}
li:before{
	content: url(/static/img/circle.svg);
	position: relative;
	left: -8px;
	top: 2px;
	display: inline-block;
	transition: .4s;
	transform: rotate(0deg);
}
li:hover:before{
	transform: rotate(180deg);
}
.img_con > img{
	max-width: 150px;
	clip-path: circle();
	z-index: 2;
}
.img_con{
	position: relative;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
}
.back{
	background-color: #f77d24;
	min-width: 130px;
	min-height: 130px;
	border-radius: 50%;
	position: absolute;
	left: 10%;
	bottom: 5px;
	z-index: 1;
}
.container{
	position: relative;
	height: 350px;
	background-color: #fff;
	padding: 1.5rem;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}
h4{
	text-align: center;
	font-size: 22px;
	margin-top: 6px;
	margin-bottom: 10px;
	letter-spacing: 2px;
	font-weight: 900;
}
span{
	font-size: 14px;
	opacity: 0.7;
}
p{
	text-align: center;
}
.pre, .next{
	outline: none;
	background: none;
	border: none;
	font-size: 40px;
	color: #f77d24;
	opacity: 0.7;
	transition: color 0.3s;
}
.pre:hover, .next:hover{
	color: #333;
}
.pre, .next{
	position: absolute;
	top: calc(50% - 20px);
	left: 5px;
}
.next{
	left: auto;
	right: 5px;
}
#comments{
	padding: 0;
	position: relative;
	height: 350px;
	margin: 30px 30px 60px 30px;
}
#partners{
	grid-row: 2;
	margin: 30px;
}
@media(min-width: 1250px){
	#home{
		grid-template-columns: 28% 44% 28%;
	}
	br{
		display: none;
	}
	#buttons{
		grid-column: 1;
	}
	#partners{
		grid-row: 1;
		grid-column: 3;
	}
	#coursesContainer{
		grid-column: 2;
		grid-row: 1;
	}
	#comments, #map{
		grid-column: 1/4;
	}
}
@media(max-width: 745px){
	#home{
		grid-template-columns: 100%;
	}
	#buttons{
		display: none;
	}
	#partners{
		grid-row: 2;
	}
	#coursesContainer{
		grid-row: 1;
	}
	.sponsor{
		width: calc(100% - 30px);
		max-width: 300px;
		margin: 0 15px 0 0;
	}
	#comments, #map{
		grid-column: 1;
	}
	#comments{
		padding: 10px;
		height: 370px;
	}
	#info3{
		padding: 15px;
	}
	#info > img{
		width: 90px;
	}
	.hide{
		display: none;
	}
}
</style>

<script>
export default{
	name: 'home',
	data(){
		return{//Data for reviews/comments
			data: [
				{
					id: 1,
					img: "https://randomuser.me/api/portraits/women/72.jpg",
					title: "lorem epson",
					span: "Web developer",
					text: "Lorem ipsum dolor sit amet consectetur, adipisicing elit. ipsum dolor sit amet consecteturipsum dolor sit amet consectetur ",
				},
				{
					id: 2,
					img: "https://randomuser.me/api/portraits/women/79.jpg",
					title: "many pixels",
					span: "Back-End developer",
					text: "Lorem ipsum ipsum dolor sit amet consectetur adipisicing elit. ipsum dolor sit amet consectetur",
				},
				{
					id: 3,
					img: "https://randomuser.me/api/portraits/men/0.jpg",
					title: "scarllet jon",
					span: "Front-End developer",
					text: "Lorem ipsum dolor sitipsum dolor sit amet consecteturcteturipsum dolor sit amet consectetur, adipisicing elit.",
				},
				{
					id: 4,
					img: "https://randomuser.me/api/portraits/men/84.jpg",
					title: "Thomas shelby",
					span: "Web developer",
					text: "Loipsum dolor sit amet conser sit amet consecteturipsum dolor sit amet consecteturipsum dolor sit amet consecteturtetur ",
				},
			],
			time: false, //Condition for show timetable
		}
	},
	computed:{
		coursesData: function(){
			//Courses data JSON
    		return curData
    	},
    },
	methods:{
		courseMore: function(id){
			let courseId;
			for(var i = 0; i < Object.keys(this.coursesData).length; i++){
				if(this.coursesData[Object.keys(this.coursesData)[i]]["title"] == id){
					courseId = Object.keys(this.coursesData)[i];
				}
			}
			if(courseId.length == 0){courseId = Object.keys(this.coursesData)[0]}
			this.$router.push({name: 'course', params: {courseId: courseId}});
			window.scroll(0, 0);
		},
		raspClick: function(event){
			//Timetable show/hide
			this.time = !this.time;
		},
		teachers: function(){
			this.$router.push({name: 'teachers'});
		},
		comments: function(){
			//Scroll to review block
			document.querySelector("#comments").scrollIntoView(false);
		},
		reviewFilter: function(){
			//Function that fill data in review block
			let img = document.querySelector(".img_con > img");
			let title = document.querySelector(".com_h4");
			let span = document.querySelector(".com_span");
			let text = document.querySelector(".com_p");
			let pre = document.getElementsByClassName("pre")[0];
			let next = document.getElementsByClassName("next")[0];
			let current = 1;
			//Set variables
			const setData = (arr) => {
				img.src = arr[current - 1].img;
				title.innerText = arr[current - 1].title;
				span.innerText = arr[current - 1].span;
				text.innerText = arr[current - 1].text;
			};
			//Add pre logic
			pre.addEventListener("click", () => {
				if(current != 1){
					current--;
				}else{
					current = 4;
				}
				setData(this.data);
			});
			//Add next logic
			next.addEventListener("click", () => {
				if(current != 4){
					current++;
				}else{
					current = 1;
				}
				setData(this.data);
			});
			window.onload = () => {
				setData(this.data);
			};
			//Upload data in first
			setData(this.data);
		}
	},
	mounted(){
		this.$nextTick(function(){
			this.reviewFilter();
			let width = document.querySelector("#app").clientWidth;
			document.querySelector("#headerVue").classList.remove("courseHide");
			//VK.Widgets.Group("vk_groups", {mode: 2, width: Math.min(width - 350, width * 0.65) - 60, height: "300"}, 198006866);
		});
	}
}
</script>