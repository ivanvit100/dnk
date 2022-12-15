<template>
	<div id="footerVue">
		<div id="img_container">
			<img src="@/assets/logo.png" alt="logo" id="footer_logo">
		</div>
		<div id="contacts">
			<h2>Наши контакты</h2>
			<p>По вопросам методического сопровождения дистанционных программ: (843) 233-74-26
			<br>
			Портал электронного обучения КФУ:
			<a href="https://kpfu.ru/open">https://kpfu.ru/open</a>
		    </p>
		</div>
	</div>
</template>

<style>
a{
	text-decoration: none !important;
	color: white !important;
}
#footerVue{
	background-color: #d47837;
	display: grid;
	grid-template-columns: 35% 50%;
	grid-template-rows: 40px 200px 40px;
	color: white;
	line-height: 22px;
	min-height: 240px;
	position: relative;
}
#contacts{
	height: 240px;
}
#footer_logo{
	height: 140px;
	width: auto;
	float: right;
	margin-right: 30px;
	filter: grayscale(100) invert(100) brightness(100);
}
#contacts, #img_container{
	grid-row: 2;
}
#img_container{
	width: 100%;
}
@media(max-width: 600px){
	#footerVue{
		grid-template-columns: 10% 80% 10%;
		grid-template-rows: 40px 140px 20px 60px 40px;
		min-height: 440px;
	}
	#contacts{
		grid-row: 4;
	}
	#contacts, #img_container{
		grid-column: 2;
	}
	#footer_logo{
		float: unset;
		display: block;
		margin-right: auto;
		margin-left: auto;
	}
	#img_container{
		align-items: center;
	}
}
</style>

<script>
export default{
	name: 'footerVue',
	props: [],
	data(){
		return{
		}
	},
}
</script>