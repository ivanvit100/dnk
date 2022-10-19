<template>
  <div id="app">
    <headerVue @swap="swap" :mode="mode" :login="login"></headerVue>
    <main>
      <home v-if="mode == 'home'"></home>
      <courses v-else-if="mode == 'courses'"></courses>
      <contats v-else-if="mode == 'contacts'"></contats>
    </main>
    <footerVue></footerVue>
  </div>
</template>

<style>
body, html{
  padding: 0 !important;
  margin: 0 !important;
  width: 100%;
  background-color: #e5e5e5;
}
</style>

<script>
import headerVue from './components/headerVue';
import registration from './components/registration';
import footerVue from './components/footerVue';
import home from './components/home';
import courses from './components/courses';
import contats from './components/contacts';
export default{
  name: 'app',
  components: {headerVue, registration, footerVue, home, courses, contats},
  data(){
    return{
      login: false,
      mode: 'home', //Открытая страница
    }
  },
  methods:{
    swap: function(data){
      //Переключение отображения страниц
      this.mode = data.mode;
    },
  },
  mounted(){
    //Проверка кэша, включение/выключение окна регистрации
  }
}
</script>