<template>
	<div id="cabinet">
		<div id="profile" style="padding-bottom: 20px">
			<h2 id="fullname">{{name}} {{surname}}</h2>
			<p class="email"><b>Email:</b> {{email}}</p>
			<p class="phone"><b>Телефон:</b> {{phone}}</p>
			<div class="header_button" id="exit" @click="exit">Выйти</div>
		</div>
		<div id="misses">
			<h2>Пропуски</h2>
			<p class="passes" v-for="item in passes">{{item}}</p>
		</div>
		<div id="subscribe">
			<h2>Курсы</h2>
			<span id="subscribeStatus">{{subscribeStatus}}</span>
			<p class="coursesSubscribe" v-for="item in courses" @click="courseMore(item.href)">{{item.name}}</p>
		</div>
	</div>
</template>

<style scoped>
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
}
.coursesSubscribe::after{
	content: "❯";
	font-size: 20px;
	position: absolute;
	right: 20px;
}
.coursesSubscribe:hover{
	font-size: 17px;
}
.coursesSubscribe:hover::after{
	font-size: 22px;
}
#profile{
	text-align: left;
	padding: 1px 10px 20px 10px;
	background-color: linear-gradient(180deg, #f77d24 0%, #f77d24 50px, rgba(238,238,238,1) 51px, rgba(238,238,238,1) 100%);;
	background: linear-gradient(180deg, #f77d24 0%, #f77d24 50px, rgba(255,255,255,1) 51px, rgba(255,255,255,1) 100%);;
	border-bottom: 8px solid #f77d24;
	margin: 15px 0;
	position: relative;
}
#exit{
	position: unset;
	bottom: 10px;
	height: 32px;
}
.passes{
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
#subscribe > h2{
	border-bottom: 7px solid #f77d24;
	max-width: 200px;
	position: relative;
	right: calc(-50% + 100px);
}
#fullname{
	color: white;
	margin: 10px 5px;
}
#misses{
	background-color: #333;
	color: white;
}
#misses, #subscribe{
	text-align: center;
	margin-top: 15px;
	padding: 15px 0;
	margin-bottom: 20px;
}
@media(min-width: 700px){
	#cabinet{
		display: grid;
		grid-template-columns: 350px calc(100% - 350px);
	}
	#misses{
		grid-column: 2;
		grid-row: 1;
	}
	#subscribe{
		grid-column: 1/3;
	}
	#profile, #misses, #subscribe{
		margin: 15px !important;
	}
	#misses{
		margin-top: 0;
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
			email: 'Подождите...',
			phone: 'Подождите...',
			passes: ['Подождите...', 'Подождите...', 'Подождите...'],
			courses: [{'name': 'Тестовый курс', 'href': 'robo'}],
			subscribeStatus: 'Подождите...'
		}
	},
	methods:{
		exit: function(){
			localStorage.clear();
			location.reload()
		},
		courseMore: function(id){
			this.$router.push({name: 'course', params: {courseId: id}});
			window.scroll(0, 0);
		}
	},
	mounted(){
		document.querySelector("#headerVue").classList.add("courseHide");
		document.querySelector("#misses").querySelectorAll("p")[1].style.borderBottom = "3px solid rgb(63,72,204)";
		if(localStorage.getItem('login') == null){
			this.$router.push({name: 'home'})
		}else{
			let user = {
				ID: localStorage.getItem('id')
			}
			fetch('http://dnk.ivanvit.ru/testphp/cab_test.php', {
				method: 'POST',
				body: JSON.stringify(user)
			}).then((response) => {
				return response.json()
			}).then((data) => {
				this.email = data['Email'];
				this.phone = data['Phone'];
				this.passes = [data['PassOne'] == "0000-00-00" ? "Пропусков нет!" : data['PassOne'], data['PassTwo'] == "0000-00-00" ? "Больше пропусков нет!" : data['PassTwo'], data['PassThree'] == "0000-00-00" ? "Больше пропусков нет!" : data['PassThree']];
				document.querySelector("#subscribeStatus").remove();
			}).catch((error) => {
				console.warn(error);
			});
		}
	}
}
</script>