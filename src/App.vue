<template>
  <div id="app">
    <headerVue @swap="swap" :mode="mode" :key="index"></headerVue>
    <main>
      <router-view></router-view>
    </main>
    <footerVue></footerVue>
  </div>
</template>

<style>
h2{
  background-color: rgba(0,0,0,0) !important;
  margin-top: 3px;
}
h3{
  font-size: 20px;
}
body, html{
  padding: 0 !important;
  margin: 0 !important;
  width: 100%;
  background-color: #e5e5e5;
}
#home, #contactsVue, #courses{
  min-height: 250px;
}
#more, .button_css, .miniBut{
  font-size: 20px;
  background: #FF7800;
  color: #ffffff;
  border-color: #FF7800;
  border-size: 1px;
}
#more:hover, .button_css:hover, .miniBut:hover{
  background-color: #ba5800;
  border-color: #b35400;
}
.table_center_by_css, .miniCourse{
  border: 2px solid gray;
  border-radius: 10px;
  background: #ffffff;
  border-collapse: separate;
  border-spacing: 20px 10px;
}
*{
  cursor: url(http://dnk.ivanvit.ru/static/img/select.png), auto;
}
button, p, span, h1, h2, h3, h4, h5, a, b, td, #avatar, .orange-btn, .header_button, .miniText, .wcommunity_wrap, iframe, .td_css, input, #rasp, #rasp > img, #fullCalWrap{ 
  cursor: url(http://dnk.ivanvit.ru/static/img/link.png), auto !important;
}
</style>

<script>
import headerVue from './components/headerVue';
import registration from './components/registration';
import footerVue from './components/footerVue';
import home from './components/home';
import courses from './components/courses';
import contacts from './components/contacts';
import cabinet from './components/cabinet';
export default{
  name: 'app',
  components: {headerVue, registration, footerVue, home, courses, contacts, cabinet},
  data(){
    return{
      mode: 'home', //Открытая страница
      width: 800, //
      slHeight: 250, //
      name: '',
      surname: '',
      id: '',
      login: '',
      index: 0
    }
  },
  watch: {
    '$route.name'(to, from){
      if(to == "home" || to == "courses" || to == "contacts"){
        this.index += 1;
      }
    }
  },
  methods:{
    swap: function(data){
      //Переключение отображения страниц
      this.mode = data.mode;
    },
    coursesGo: function(){
      this.mode = "courses";
    },
    resize: function(){
      try{
        this.width = document.querySelector("#app").clientWidth;
        this.slHeight = (this.width * 9 / 16) <= 450 ? this.width * 9 / 16 : 450;
        document.querySelector("#images").style.height = this.slHeight + "px";
        document.querySelector("#headerVue").style.gridTemplateRows = "50px " + this.slHeight + "px";
      }catch(e){
        console.warn("[resize]: Ошибка!")
      }  
    },
  },
  mounted(){
    //Проверка кэша, включение/выключение окна регистрации
    this.$nextTick(function(){
      window.addEventListener('resize', this.resize);
      let user = {
        ID: localStorage.getItem('id')
      }
      fetch('http://dnk.ivanvit.ru/php/checkid.php', {
        method: 'POST',
        body: JSON.stringify(user)
      }).then((response) => {
        return response.json()
      }).then((data) => {
        if(data['answer']){
          console.log(data['Role']);
          localStorage.setItem('Role', data['Role']);
        }else{
          localStorage.clear();
          window.location.reload();
        }
      }).catch((error) => {
        console.warn(error);
      });
    });
  }
}
</script>