<template>
	<div id="footerVue">
		<img src="@/assets/logo.png" alt="logo" id="footer_logo">
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
#footerVue{
	background-color: #012a77;
	display: grid;
	grid-template-columns: 30% 50%;
	color: white;
	line-height: 22px;
	min-height: 240px;
	position: relative;
}
#contacts{
	height: 240px;
}
a{
	color: white;
}
#footer_logo{
	height: 140px;
	width: auto;
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