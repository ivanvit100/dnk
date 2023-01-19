<!--File written by develope@ivanvit.ru (ivanvit100@gmail.com)-->
<template>
	<div id="courses">
		<!--Generating course blocks by iterating over JSON-->
		<div class="table_center_by_css wow zoomIn animate__faster" v-for="item in coursesData"> 
			<h3 class="th_css">{{item.title}}</h3>
			<div class="courseCont">
				<div class="td_css_3"><img class="courseImg" alt="courseImg"></div>
				<div class="td_css">{{item.text}}</div>
				<b>Возраст: {{item.age}} класс</b>
				<div class="td_css_2"><button v-if="adm" @click="deleteCourse(item.courseId)" class="button_css" style="right: 125px; background-color: #c46917;">Удалить</button><button @click="courseMore(item.courseId)" class="button_css">Перейти</button></div>
			</div>
		</div>
		<!--Course create block for administrators-->
		<div class="table_center_by_css wow zoomIn animate__faster" v-if="adm" style="padding: 20px;">
		<center> 
			<input v-model="name" class="th_css" placeholder="Создать курс"></input>
			<div class="courseCont">
				<div class="td_css_3"><img class="courseImg" id="newImage" src="/static/img/white.jpg" alt="courseImg"></div>
				<textarea class="td_css" placeholder="Описание курса" v-model="description"></textarea>
				<input v-model="age" placeholder="Возрастные группы через запятую"></input>
				<input v-model="count" placeholder="Количество детей на Возрастные группы, через запятую"></input>
				<input v-model="short" placeholder="Краткое имя курса"></input>
				<input v-model="courseId" id="courseId" placeholder="Идентификатор (вида 'robo')" style="text-align: initial;"></input>
				<input type="file" accept="image/png, image/jpg, image/jpeg" id="file" name="file"/>
				<input type="button" id="btn" value="Загрузить"/>
				<div class="td_css_2"><button @click="create" class="button_css">Создать</button></div>
			</div>
		</center>
		</div>
	</div>
</template>

<style>
#btn{
	height: 51px;
	position: relative;
	top: 2px;
	background-color: #f6954e;
	color: white;
	font-size: 18px;
}
#btn:hover{
	background-color: #b45917;	
}
#courseTitle{
	height: 32px;
	width: 100%;
	background-color: orange;
	color: white;
}
#courses{
	text-align: center;
}
.table_center_by_css{
	text-align: center;
	margin: 30px 0;
	--animate-duration: 0.3s;
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
textarea{
	width: 90%;
	border: 1px solid #d3d3d3;
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
<style scoped>
textarea{
	white-space: nowrap;
	padding-right: 50px;
}
input{
	border: 1px solid #d3d3d3;
}
</style>

<script>
export default{
	name: 'courses',
	props: [],
	data(){
		return{
			name: '',
			age: '',
			count: '',
			description: '',
			short: '',
			courseId: '',
		}
	},
	computed:{
		coursesData: function(){
			//Courses data JSON
    		return curData
    	},
    	adm: function(){
    		//User's role check
    		return localStorage.getItem('Role') == 3
    	}
	},
	methods:{
		courseMore: function(id){
			//Push the user to a course page
			this.$router.push({name: 'course', params: {courseId: id}}).catch(()=>{});
			window.scroll(0, 0);
		},
		create: function(){
			//A function to create new course (admin only)
			let user = {
				courseID: this.courseId,
				userID: localStorage.getItem('id'),
				title: this.name,
				short: this.short,
				description: this.description.replaceAll(',', '`'),
				age: this.age.replaceAll(',', '`'),
				count: this.count.replaceAll(',', '`')
			}
			fetch('http://dnk.ivanvit.ru/php/newcourse.php', {
				method: 'POST',
				body: JSON.stringify(user)
			}).then((response) => {
				return response.json()
			}).then((data) => {
				alert(data['reason']);
			}).catch((error) => {
				console.warn(error);
			});
		},
		deleteCourse: function(id){
			//A function to delete a course (admin only)
			let user = {
				courseID: id,
				userID: localStorage.getItem('id')
			}
			//Confirmation of the decision in order to avoid missclick
			let result = confirm("Вы уверены, что хотите удалить курс '" + this.coursesData[id]["title"] + "'?");
			if(result){
				fetch('http://dnk.ivanvit.ru/php/delcourse.php', {
					method: 'POST',
					body: JSON.stringify(user)
				}).then((response) => {
					return response.json()
				}).then((data) => {
					alert(data['reason']);
				}).catch((error) => {
					console.warn(error);
				});
			}else{
				console.log("Операция отменена!")
			}
		}
	},
	mounted(){
		document.querySelector("#headerVue").classList.remove("courseHide");
		this.$nextTick(function(){
			//Iterating over indexes and adding src to images
			for(var i = 0; i < Object.keys(this.coursesData).length; i++){
				document.querySelectorAll(".table_center_by_css .courseCont .td_css_3 img")[i].src = "../php/img/" + Object.keys(this.coursesData)[i] + ".png";
			}
			//An event listener that updates the image in the course 
			//creation block when the user uploads an image.
			//Direct image upload.
			document.getElementById("file").addEventListener('change', (event) => {
				let reader = new FileReader();
				var imgtag = document.getElementById("newImage");
				reader.onload = function(readerEvt){
					let er = 13;
					imgtag.src = event.target.result;
					let dataURL = reader.result;
					name = readerEvt.target.fileName;
					name = name.toLowerCase();
					let formats = [".png", ".jpg", ".jpeg", ".jfif", ".pjpeg", ".pjp", ".webp"];
					for(var i = 0; i < 13; i++){
						if(name.endsWith(formats[i])){
							er = 100;
						}
						else{
							er = er - 1;
						}
					}
					document.getElementById("newImage").setAttribute("src", dataURL);
				}
				let file = document.getElementById("file").files[0];
				reader.readAsDataURL(file);
				reader.fileName = file.name;
			});
			//An event listener that sends a user-uploaded image to the server
			$(document).on('click', '#btn', function(){
				var formData = new FormData();
				formData.append("file", document.getElementById("file").files[0], document.querySelector("#courseId").value.trim().concat(".png"));
				if(document.getElementById("file").files.length != 0 && document.querySelector("#courseId").value.trim() != ""){
					var xhr = new XMLHttpRequest();
					xhr.open("POST", "/php/upload.php");
					xhr.send(formData);
				}
			});
		});
	}
}
</script>