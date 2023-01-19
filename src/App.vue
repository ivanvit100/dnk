<!--File written by develope@ivanvit.ru (ivanvit100@gmail.com)-->
<template>
  <div id="app">
    <!--Header component (headerVue.vue)-->
    <headerVue @updateIndex="updateIndex" :mode="mode" :key="index"></headerVue>
    <main>
      <!--Main component-->
      <router-view :key="index2"></router-view>
    </main>
    <!--Footer component (footerVue.vue)-->
    <footerVue></footerVue>
  </div>
</template>

<style>
*::selection{
  background: rgba(237, 119, 60, 0.3);
}
*::-moz-selection{
  background: rgba(237, 119, 60, 0.3);
}
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
button, p, span, h1, h2, h3, h4, h5, a, b, td, #avatar, .orange-btn, .header_button, .miniText, .wcommunity_wrap, iframe, .td_css, input, #rasp, #rasp > img, #fullCalWrap, li, .pre, .next, select, option{ 
  cursor: url(http://dnk.ivanvit.ru/static/img/link.png), auto !important;
}
</style>

<script>
//Service-worker
if ('serviceWorker' in navigator){
  navigator.serviceWorker.register('/service-worker.js', {
    scope: '/'
  });
}

document.addEventListener("DOMContentLoaded", function(event){ 
  //Preferens check
  let isReduced = window.matchMedia(`prefers-reduced-motion: reduce`) === true || window.matchMedia(`(prefers-reduced-motion: reduce`) === true || window.matchMedia(`prefers-reduced-motion`).matches === true;
  if(!isReduced){
    //Animation
    new WOW().init();
  } 
});

import headerVue from './components/headerVue';
import footerVue from './components/footerVue';
import home from './components/home';
import courses from './components/courses';
import contacts from './components/contacts';
import cabinet from './components/cabinet';
export default{
  name: 'app',
  components: {headerVue, footerVue, home, courses, contacts, cabinet},
  data(){
    return{
      width: 800, //For a header
      slHeight: 250, //For a header
      name: '',
      surname: '',
      id: '',
      login: '',
      index: 0, //For re-render
      index2: 0 //For re-render
    }
  },
  watch: {
    '$route.name'(to, from){
      //Re-render header when a slider is visible
      if(to == "home" || to == "courses" || to == "contacts"){
        this.index += 1;
      }
    }
  },
  methods:{
    resize: function(){
      //A function for set a header's parametrs when page sizes is change
      try{
        this.width = document.querySelector("#app").clientWidth;
        this.slHeight = (this.width * 9 / 16) <= 450 ? this.width * 9 / 16 : 450;
        document.querySelector("#images").style.height = this.slHeight + "px";
        document.querySelector("#headerVue").style.gridTemplateRows = "50px " + this.slHeight + "px";
      }catch(e){
        console.warn("[resize]: Ошибка!")
      }  
    },
    updateIndex: function(){
      //A function for re-render main content when user login
      this.index2 += 1;
    }
  },
  mounted(){
    //Authorisation check
    this.$nextTick(function(){
      window.addEventListener('resize', this.resize);
      if(localStorage.getItem('id') !== null){
        //Check user's role
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
            localStorage.setItem('Role', data['Role']);
          }else{
            localStorage.clear();
            window.location.reload();
          }
        }).catch((error) => {
          console.warn(error);
        });
      }
    });
  }
}
</script>