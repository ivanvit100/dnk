<template>
	<div id="contactsVue">
		<table class="table_center_by_css1">
			<tr>
				<td class="td_css1" cellspacing="10" width="200">Руководитель</td>
				<td class="td_css1" valign="top">Латипова Лилия Николаевна, директор ДНК имени Камиля Ахметовича Валиева</td>
			</tr>
			<tr>
				<td class="td_css1" cellspacing="10">Телефон</td>
				<td class="td_css1" valign="top">+7 917 261-86-58</td>
			</tr>
			<tr>
				<td class="td_css1" cellspacing="10">Адрес</td>
				<td class="td_css1" valign="top">Республика Татарстан, г. Елабуга, ул.Строителей, д.16.</td>
			</tr>
			<hr class="tableHr">
			<tr>
				<td class="td_css1" cellspacing="10" width="200">Учебный мастер</td>
				<td class="td_css2" valign="top">Хузина Альбина Маратовна</td>
			</tr>
			<tr>
				<td class="td_css1" cellspacing="10">Телефон</td>
				<td class="td_css1" valign="top">+7 987 064-45-78</td>
			</tr>
			<hr class="tableHr">
			<tr>
				<td class="td_css1" cellspacing="10"><b>Разработчики</b></td>
			</tr>
			<hr class="tableHr">
			<tr>
				<td class="td_css1" cellspacing="10" width=200>Иванущенко Виталий Александрович</td>
				<td class="td_css1" valign="top"><a href="mailto: develope@ivanvit.ru">develope@ivanvit.ru</a></td>
			</tr>
			<tr>
				<td class="td_css1" cellspacing="10" width=200>Миннахметов Алмаз Ильдарович</td>
				<td class="td_css1" valign="top"><a href="mailto: minnakhmetovalmazdev@gmail.com">minnakhmetovalmazdev@gmail.com</a></td>
			</tr>
			<tr>
				<td class="td_css1" cellspacing="10" width=200>Шипков Александр Владимирович</td>
				<td class="td_css1" valign="top"><a href="mailto: gipkin9@mail.ru">gipkin9@mail.ru</a></td>
			</tr>
			<tr>
				<td class="td_css1" cellspacing="10" width=200>Ивашкевич Диана Вячеславовна</td>
				<td class="td_css1" valign="top">+7 917 290-84-99</td>
			</tr>
			<tr>
				<td class="td_css1" cellspacing="10" width=200>Шамилова Диана Эльжановна</td>
				<td class="td_css1" valign="top">+7 962 652-82-42</td>
			</tr>
		</table>
	</div>
</template>

<style>
.tableHr{
	position: absolute;
	width: calc(50% - 20px);
	right: calc(25% + 8px);
}
.title1{
	font-weight: bold;
	font-size: 25px;
}
table{
	width: 70%;
	border-radius: 0px;
	background: #ffffff;
	border-collapse: separate;
	border-spacing: 20px 10px;
}
.table_center_by_css1{
	margin: auto;
	border-bottom: 2px solid gray;
}
.td_css1, .td_css2{
	padding:20px;
	margin: auto;
	word-break: break-word;
}
@media(max-width: 700px){
	table{
		width: 90%;
	}
}
@media(max-width: 600px){
	table{
		width: 100%;
	}
}
</style>

<style scoped="true">
a{
	color: black !important;
}
</style>

<script>
export default{
	name: 'contacts',
	props: [],
	data(){
		return{
		}
	},
	mounted(){
		document.querySelector("#headerVue").classList.remove("courseHide");
	}
}
</script>