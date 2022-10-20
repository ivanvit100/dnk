<template>
	<div id="home">
		<h2>О нас</h2>
		<h2>Курсы</h2>
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
	height: 40px;
	width: 100%;
	background-color: #5a7ec9;
	color: white;
}
.sponsor{
	height: 90px;
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