<template>
	<div id="home">
		<div id="about_container">
			<h2>О нас</h2>
			<div id="about">
				<img src="@/assets/photo1.jpeg" alt="photo" style="float: left" class="about_image">
				<p>Проект дополнительного образования Дом научной коллаборации реализован в рамках федерального проекта «Успех каждого ребенка» национального проекта «Образование». Татарстанский Дом научной коллаборации находится в Елабуге. <br>Важными задачами ДНК являются развитие у детей навыков проектной и творческой работы, а также обучение по приоритетным направлениям научно-технологического развития, среди которых робототехника, информационные и биотехнологии. <br>Каждый Дом научной коллаборации носит  имя учёного, прославившего свой край. <br>ДНК при Елабужском институте КФУ носит имя выдающегося физика-теоретика, общественного деятеля, доктора физико-математических наук, действительного члена Российской академии наук и Академии наук РТ, лауреата Ленинской премии Камиля Ахметовича Валиева. <br>Проект дополнительного образования Дом научной коллаборации реализуются в рамках федерального проекта «Успех каждого ребёнка» национального проекта «Образование». Татарстанский Дом научной коллаборации будет находиться в Елабуге.</p>
			</div>
		</div>
		<br>
		<hr>
		<h2>Курсы</h2>
		<br>
		<hr>
		<center>
			<h2 id="sponsorsH">Спонсоры</h2>
			<div id="sponsors">
				<div></div>
				<img src="@/assets/logo.png" alt="sponsor" class="sponsor">
				<img src="@/assets/account.png" alt="sponsor" class="sponsor">
				<img src="@/assets/account.png" alt="sponsor" class="sponsor">
				<img src="@/assets/account.png" alt="sponsor" class="sponsor">
				<img src="@/assets/account.png" alt="sponsor" class="sponsor">
			</div>
		</center>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1122.4925365917768!2d52.016251975954!3d55.75876150433705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8fb0d1ea907eedb9!2zNTXCsDQ1JzMxLjUiTiA1MsKwMDEnMDIuNSJF!5e0!3m2!1sru!2sru!4v1666250654230!5m2!1sru!2sru" width="600" height="256" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
</template>

<style>
iframe{
	width: 100% !important;
	margin-top: 50px;
}
#sponsors{
	width: 100%;
	display: grid;
	grid-template-columns: 5% 18% 18% 18% 18% 18% 5%;
}
#sponsorsH{
	height: 32px;
	width: 100%;
	background-color: #5a7ec9;
	color: white;
}
.sponsor{
	height: 90px;
}
#about_container{
	margin-bottom: 10px;
	text-align: center;
}
.about_image{
	margin: 0 20px 20px 0;
	width: 280px;
}
#about{
	padding: 0 30px;
	text-align: initial;
}
hr{
	width: 85%
}
@media(max-width: 600px){
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
}
</script>