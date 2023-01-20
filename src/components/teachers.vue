<!--File written by develope@ivanvit.ru (ivanvit100@gmail.com)-->
<template>
	<div id="teachers">
		<div class="contain" v-for="item in List">
			<h2>{{item.title}}</h2>
			<span v-for="name in item.names">• {{name}}</span>
			<center><hr></center>
		</div>
	</div>
</template>

<style scoped>
#teachers{
	margin: auto;
	border-bottom: 2px solid grey;
	width: 70%;
	border-radius: 0;
	background: #fff;
	padding: 30px;
	word-break: break-word;
}
span{
	margin-top: 5px;
	display: block;
	font-size: 18px;
}
h2{
	margin: 10px auto 5px auto;
}
hr{
	width: 80%;
	height: .5px;
	background-color: black;
	opacity: .3
}
@media(max-width: 690px){
	#teachers{
		width: 100%;
	}
}
</style>

<script>
export default{
	name: 'teachers',
	data(){
		return{
			teachersList: {}, //Support list
			List: [] //Display list
		}
	},
	computed:{
		coursesData: function(){
			//Courses data JSON
    		return curData
    	},
    },
	mounted(){
		this.$nextTick(function(){
			//Get list of teachers in all courses
			fetch('http://dnk.ivanvit.ru/php/teacherslist.php', {
				method: 'POST',
			}).then((response) => {
				return response.json()
			}).then((data) => {
				if(data['answer']){
					//Parsing a string into JSON
					let list = data['teachers'].split(";");
					for(var i = 0; i < list.length - 1; i++){
						let list2 = list[i].replaceAll(":", ", ").split(", ");
						//Create object as value
						this.teachersList[list2[0].trim()] = {};
						//Push title from server's JSON to variable
						this.teachersList[list2[0].trim()]['title'] = this.coursesData[Object.keys(this.teachersList)[i]]['title'];
						//Create array as value
						this.teachersList[list2[0].trim()]['names'] = [];
						//Filling an array
						for(var j = 1; j < list2.length; j++){
							this.teachersList[list2[0].trim()]['names'].push(list2[j]);
						}
						list2 = [];
					}
					//Push object to array
					for(var i = 0; i < Object.keys(this.teachersList).length; i++){
						this.List.push(this.teachersList[Object.keys(this.teachersList)[i]]);
					}
				}
			}).catch((error) => {
				console.warn(error);
			});
		});
	}
}
</script>