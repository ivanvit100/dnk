<template>
	<div id="contactsVue">
		<table class="table_center_by_css1" >
			<tr>
				<td class="td_css1" cellspacing="10">Руководитель</td>
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
			<tr><td><hr class="contactHr"></td></tr>
			<tr>
				<td class="td_css1" cellspacing="10">Учебный мастер</td>
				<td class="td_css1" valign="top">Хузина Альбина Маратовна</td>
			</tr> 
			<tr>
				<td class="td_css1" cellspacing="10">Телефон</td>
				<td class="td_css1" valign="top">+7 987 064-45-78</td>
			</tr>
		</table>
	</div>
</template>

<style>
.contactHr{
	position: absolute;
	width: calc(50% - 20px);
	right: calc(25% + 8px);
}
.title1{
	font-weight: bold;
	font-size: 25px;
}
table{
	margin: 20px;
	width: 50%;
	border-radius: 0px;
	background: #ffffff;
	border-collapse: separate;
	border-spacing: 20px 10px;
}
.table_center_by_css2{
	margin: auto;
}
.table_center_by_css1{
	margin: auto;
	border-bottom: 2px solid gray;
}
.td_css1{
	padding: 20px;
	margin: auto;
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