webpackJsonp([0],[,,,function(t,e,s){t.exports=s.p+"static/img/white.5d63e1b.jpg"},function(t,e,s){"use strict";var i=s(5),a=s(7),n=s(9),r=s(11),o=s(13),c=s(15);e.a={name:"app",components:{headerVue:i.a,registration:a.a,footerVue:n.a,home:r.a,courses:o.a,contats:c.a},data:function(){return{mode:"home",width:800,slHeight:250,name:"",surname:"",id:""}},methods:{swap:function(t){this.mode=t.mode},coursesGo:function(){this.mode="courses"},resize:function(){try{this.width=document.querySelector("#app").clientWidth,this.slHeight=9*this.width/16<=450?9*this.width/16:450,document.querySelector("#images").style.height=this.slHeight+"px",document.querySelector("#headerVue").style.gridTemplateRows="50px "+this.slHeight+"px"}catch(t){console.warn("[resize]: Ошибка!")}}},mounted:function(){this.$nextTick(function(){window.addEventListener("resize",this.resize)})}}},function(t,e,s){"use strict";function i(t){s(24)}var a=s(6),n=s(29),r=s(0),o=i,c=r(a.a,n.a,!1,o,null,null);e.a=c.exports},function(t,e,s){"use strict";var i=s(25),a=s.n(i),n=s(1),r=s(28),o=s.n(r);n.a.use(o.a),e.a={name:"headerVue",props:["mode"],data:function(){return{data:[],show:!1,sign:!1,login:localStorage.getItem("login"),wait:!1}},watch:{sign:function(t,e){document.querySelector("#email").style.border="none",document.querySelector("#password").style.border="none",document.querySelector("#status").innerHTML=""}},methods:{swap:function(t){this.$emit("swap",{mode:t})},loginClick:function(){this.show=!0},goClick:function(t){var e=this;document.querySelector("form").addEventListener("submit",function(s){s.preventDefault();var i=void 0;i=t?{login:document.querySelector("#email").value,password:document.querySelector("#password").value}:{name:document.querySelector("#name").value,lastname:document.querySelector("#lastname").value,login:document.querySelector("#email").value,password:document.querySelector("#password").value},e.wait||(e.wait=!0,fetch("./php/"+(t?"testreg":"save_user")+".php",{method:"POST",body:a()(i)}).then(function(t){return t.json()}).then(function(t){e.login=t.answer,e.wait=!1,e.login?(localStorage.setItem("login",!0),document.querySelector("#close").click(),e.login=!0):(e.sign||(document.querySelector("#email").style.border="1px dashed red",document.querySelector("#password").style.border="1px dashed red"),document.querySelector("#status").innerHTML=t.reason)}).catch(function(t){console.warn(t)}))}),document.querySelector("#goReady").click()},cabinetMenu:function(){localStorage.clear(),this.login=!1}},mounted:function(){this.$nextTick(function(){this.data=['<div class="imgContainer"><img src=".'+s(3)+'" alt="baner" class="example-slide"></div>','<div class="imgContainer"><img src=".'+s(3)+'" alt="baner" class="example-slide"></div>','<div class="imgContainer"><img src=".'+s(3)+'" alt="baner" class="example-slide"></div>'];var t=document.querySelector("#app").clientWidth,e=9*t/16<=450?9*t/16:450;document.querySelector("#images").style.height=e+"px",document.querySelector("#headerVue").style.gridTemplateRows="50px "+e+"px"})}}},function(t,e,s){"use strict";function i(t){s(32)}var a=s(8),n=s(33),r=s(0),o=i,c=r(a.a,n.a,!1,o,null,null);e.a=c.exports},function(t,e,s){"use strict";e.a={name:"registration",props:[],data:function(){return{}}}},function(t,e,s){"use strict";function i(t){s(34)}var a=s(10),n=s(35),r=s(0),o=i,c=r(a.a,n.a,!1,o,null,null);e.a=c.exports},function(t,e,s){"use strict";e.a={name:"footerVue",props:[],data:function(){return{}}}},function(t,e,s){"use strict";function i(t){s(37)}var a=s(12),n=s(38),r=s(0),o=i,c=r(a.a,n.a,!1,o,null,null);e.a=c.exports},function(t,e,s){"use strict";e.a={name:"home",props:[],data:function(){return{}},computed:{shortList:function(){return curData.slice(0,3)}},methods:{coursesGo:function(){this.$emit("coursesGo",{})}}}},function(t,e,s){"use strict";function i(t){s(40)}var a=s(14),n=s(41),r=s(0),o=i,c=r(a.a,n.a,!1,o,null,null);e.a=c.exports},function(t,e,s){"use strict";e.a={name:"courses",props:[],data:function(){return{}},computed:{coursesData:function(){return curData}}}},function(t,e,s){"use strict";function i(t){s(42)}var a=s(16),n=s(43),r=s(0),o=i,c=r(a.a,n.a,!1,o,null,null);e.a=c.exports},function(t,e,s){"use strict";e.a={name:"contacts",props:[],data:function(){return{}}}},function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=s(1),a=s(21);s(5),s(7),s(9),s(11),s(13),s(15),s(45);i.a.config.productionTip=!1,new i.a({el:"#app",template:"<App/>",components:{App:a.a}})},,,,function(t,e,s){"use strict";function i(t){s(22)}var a=s(4),n=s(44),r=s(0),o=i,c=r(a.a,n.a,!1,o,null,null);e.a=c.exports},function(t,e){},,function(t,e){},,,,,function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{attrs:{id:"headerVue"}},[i("div",{attrs:{id:"main_header"}},[i("img",{attrs:{src:s(30),alt:"logo",id:"logo"}}),t._v(" "),t.login?i("div",{attrs:{id:"cabinet"},on:{click:t.cabinetMenu}},[i("img",{attrs:{src:s(31),alt:"avatar",id:"avatar"}})]):i("div",{attrs:{id:"login"}},[i("a",{staticClass:"orange-btn",on:{click:t.loginClick}},[t._v("Войти"),i("i",{staticClass:"fa fa-arrow-right"})])])]),t._v(" "),i("div",{attrs:{id:"navbar"}},[i("div",{staticClass:"header_button",on:{click:function(e){return t.swap("home")}}},[t._v("Главная")]),t._v(" "),i("div",{staticClass:"header_button",on:{click:function(e){return t.swap("courses")}}},[t._v("Курсы")]),t._v(" "),i("div",{staticClass:"header_button",on:{click:function(e){return t.swap("contacts")}}},[t._v("Контакты")])]),t._v(" "),i("center",[i("div",{attrs:{id:"images"}},[[i("carousel",{attrs:{data:t.data}})]],2)]),t._v(" "),[i("Transition",{attrs:{name:"modal"}},[t.show?i("div",{staticClass:"modal-mask"},[i("div",{staticClass:"modal-wrapper"},[t.sign?i("div",{staticClass:"modal-container"},[i("button",{attrs:{id:"close"},on:{click:function(e){t.show=!t.show}}},[t._v("x")]),t._v(" "),i("h2",{attrs:{id:"popupTitle"}},[t._v("Регистрация")]),t._v(" "),i("form",[i("input",{attrs:{type:"text",id:"name",placeholder:"Имя",minlength:"2",required:""}}),t._v(" "),i("input",{attrs:{type:"text",id:"lastname",placeholder:"Фамилия",minlength:"2",required:""}}),t._v(" "),i("input",{attrs:{type:"email",id:"email",placeholder:"Почта",required:""}}),t._v(" "),i("input",{attrs:{type:"password",id:"password",placeholder:"Пароль",minlength:"8",required:""}}),t._v(" "),i("button",{attrs:{id:"goReady",formmethod:"post"}})]),t._v(" "),i("p",{attrs:{id:"status"}}),t._v(" "),i("span",{attrs:{id:"reg"},on:{click:function(e){t.sign=!t.sign}}},[t._v("Уже есть аккаунт?")]),t._v(" "),i("button",{attrs:{id:"go"},on:{click:function(e){return t.goClick(!1)}}},[t._v("Зарегистрироваться")])]):i("div",{staticClass:"modal-container"},[i("button",{attrs:{id:"close"},on:{click:function(e){t.show=!t.show}}},[t._v("x")]),t._v(" "),i("h2",{attrs:{id:"popupTitle"}},[t._v("Авторизация")]),t._v(" "),i("form",[i("input",{attrs:{type:"email",id:"email",placeholder:"Почта",required:""}}),t._v(" "),i("input",{attrs:{type:"password",id:"password",placeholder:"Пароль",minlength:"8",required:""}}),t._v(" "),i("button",{attrs:{id:"goReady",formmethod:"post"}})]),t._v(" "),i("p",{attrs:{id:"status"}}),t._v(" "),i("span",{attrs:{id:"reg"},on:{click:function(e){t.sign=!t.sign}}},[t._v("Зарегистрироваться")]),t._v(" "),i("button",{attrs:{id:"go"},on:{click:function(e){return t.goClick(!0)}}},[t._v("Войти")])])])]):t._e()])]],2)},a=[],n={render:i,staticRenderFns:a};e.a=n},function(t,e,s){t.exports=s.p+"static/img/logo2.8f9d40e.png"},function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAQAAAD2e2DtAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAHdElNRQfiBgEJBgGOKC5zAAAd6klEQVR42u2deXyVxdXHv9mAAIGwCAGRRRDFiqJIccGlCoiAu1BREVttFVGp4PK61E/rVlfUtigWcC/WXcEVsCriQnEBlEXAACKrkECAhIQk9/2DprkhZ57tPjPz3OT+5p98njx3zpkz88ycmTkLpJBCCimkkEIKKaRQ75BmmwEDaEB7OtKGPNrSglxa0IRsGtOADDKACiooo5gSdlHINraxhY1s4id+osQ287pRNwdAJl05jB4cSHe60jZwK2NsIp+VrGQJ37OcMtsNCx91aQBk0Yu+HEFvfkEDDfWXsZiFfMV8FlBqu7FhoS4MgGYcz0n04yiyDVEs42vm8Alz2Wa78YkimQdAJsfQnwH0JcMSBxV8ySxm8jnltoVRv5DDBTzHFmIRKQVM49c0ty2W+oCmjOR1Sqx3uVR2M52RNLMtorqKDIbyArusd7NbKeYlziDTtrjqFrpxH+utd62fspH7Odi22OoCMjmH96m03qFBSiWzOS/qc0GUdwEtuJwxdAqptiI2sYnNbGMbRRRTTCkVlAOZZNCQxjSmGbnk0oa2tA1tLf+RvzElutvFqA6ADlzH78hJqI51fMf3/MBK1rLWdxfk0IEudKMr3elBx4QktYtJPMw63UKrK+jMZEoDTrsVLOFJrqVfyNp4M45jDE+yiPKAnJUymS62RRt9dGYyZQHEu5uPuYvTyNXOYQ6ncidz2B2Ayz1MDW1Jq4Now6MBxLqUCQyhiXFuGzGICSwLMFQfoY1tUUcP2dxCkc/J/jPGRWCr1Y3r+IQKX7wXcauxe4skQBoj+NHX9moeY9nfNts1kMe1fOZru/ojIyKrghtFTz7yIbY13EU32ywr0Y0/+xrKH3O4bZbtogkPsMejsMqZziDSbbPsinRO43XPrdrDgxb0l4jgdFZ7FNNW7uMA2+z6wgHc7fm2cjWDbbNrHrk86VE8P3BVkn4j2VzJCo+tfJoWttk1idNY50ksixlhzdgjHGQwgkWe2rqO020zawaNmehJW/6WYUmw4ntBOufznafdzWM0ts2sbvT0JIp8LknyL39fpDOSfA8tX1K39wWjPdjyFDKehrYZ1YIGjKPAtf0ljLbNqB405Z8etnoTaWWbUa1oxUQP10nTaGqb0bDRncWuzZ5LL9tsGsERzPWg/na3zWaYGEKhS4ML+H09OhhN43LXxWAbQ2yzGRZucL0qeZW2tpk0jra87CKVCm60zWTiyGKqSzN/ZrhtJq1hGJtdpDNVi5ObMTTnA5cGvkWeJd4akkcnDuIgOpFnbd+RxwwXCX2QvA4n+7PQsWnFhjc8rTiFsUxmFivYUYubHaxgFpMZR3+jO5E0RlPsKKeFEbv69ojurHFs1hIOM8RJS4YzhaU+busrWcoURtDSEIc9XfZIq5NvT9CLTY5N+qeRC562XMVHgc04Y5Qzh6uNKKhNeN6Rk00caYCL0HCM47av1MDUn87pvOH5Vt657OF1hhq4l7jK0Ry2kGO0cxASjme7Q0M2coJm+tlcwfehdH18WcFV2u34TmCjAwdF9NNMPxQcLyhY8QpNR63UGzJGoxfheq6lkVb+O7LAgf6O6A+Bvo5f/wzNZ9zns0pb51eVVQzT2oYcpjtQ3x7theBIx7X/ca1XvAfxb+2dX1U+1KqVZ/CYA+3C6KqD3R01/1u1iuwml7102KWEm7QO51scNq2borkp3N/BxLOcKzRS7sjHRju/qsyhs8ZWXeFwg7I6vKOhsG7gmjNHacuyh5G8qE1Qg3neh0HlLr5lEStZzUa2spMyoAFNaUUenenG4fT0cUJRwMW8q61lF/CcMrrAQk5iuzbKvtHA4cy/lHO00U3jNo9OWaXMYjx9yHKtM4PejGeWR//kCm7TeI19rgMXsz20xRjUN35lnKmNagOe8dBFlXzApQEOdZtzKbM9HR8/rfHG7kyHITBFG1WfuNGh+8/VRrUJ77t2TRGP0DUhKt2Y4MFp9X2N1rznOpxn3qCNqg8MUU7C5VygjWoz5rh2/p0hOVu04A7XQTBHY3i4C5QSrrDvU3SwcudfqVHzb+LS/eX8I2Qf/DZMcrlU+kTj9dYVyqWo0O6WsClLlAK5RRvVBsx07IqF9NFCt4/jMW2MmRp1gVuVVBfbtCBWG3o/ro1mGs86fvv3aNSOs7jLcR54VuOO4HEl1WnaaLpgtJKl6RpPyW536IBNnKy91b9yvLG7XRvdDAfjMSuuJIcrvXwWaJyUhjrs+7+kg5GWd2C+kocKjcbcTZVLUIl5h7LGytV/o8YL3y4Ol00zDDqRN3H4Ggs0HhB3VN62LDbtVjpRwUipRnOPDAePmhcMn4tlMU3Jy1yNC+AJSquhiSabP0i5LdG5Gt3ioAaZ9yXOcBgC+nZAMEZBs5JBppreQhne4TmNVHsoYwhOt3QqnqlcCEo4RCNd1d5rnakoI08r1yF9q3Ca8uhnvsUAMk2U6uAcjRvCJkoj8qdMNPp0BfFiemqkOkJBdQPtTTRaifbKTaG+Y3DoqTR/0R5mponS7EPn6p+tiL5Xzom6G+yKkxRHQ2u02hBfpeiF1brnwwcUhGdopTpOQfUOvY31iDsV3F2nlepbCqoP6CR6uOJqcrNW75kmit3v1xHJxpHJ1yJ/m7R+jXn8LFLdo28pTlPa3uk1lB6raOhRWqn6wVGKZeBarVSHK3rjI10K6IUKgq9obWamwtbf6MGHK2RD7nzN5xOvmlRAVYpYgWbnyXNEqoURCybVmm0in/rsIQHyFIFmtCigqhvp32ltIrwjUtV36xYU8i3l25qp/l7RK6GfRbZRGEXN1RzaqYO4uhZGMD9nc3EOKNd8Q5nGp2K/FIWdleRRkUy59sBu8gbwfs1Ug+F+kVe9m0E4UqGAPhomkc6Kc3j9itgX4rCLZuKlTqKtwufa6coK6O4wpTRFof7pVsTaireO72imGhzvCtxWaI8w0lphJRGa30AXxR30eM0Ng1Ei3RHa6QaFvFG+RDvd8SLdsrDyFE4Wq883EMHuOYHurgjH0c0RL2l0XpLvRUPFWck/wqi8g8I5aaT2ZiE26y0DdIPjbfFT0Y9LxD4qDcOL+CGx6m8N2OC0FymPMSDO4Lha5Fn/lXW6Ig/Dg4lW3EIR8ed8A8IcKlI2FV0wGHqKPJsI+yzfDBQlmkz3BsX3byKZi2QDWBDxNDLpokZ+sxHK8hxwfSKVZirMP3Rau1RDCp34byOUE8GHAtfPGqEsW02tdr40d/6ezhQPE37gZSMN6iw8+9YI5UQgcWgmbfzLorrZyTlCg/MAkM28HqLCSIMksa0wQjkRSByaGQDlPCQ+vzJohd3Fc7gthnxQ0kTro6FGaCcCSXXdYygbSmO2CtQrOUj9E6cZ4DKR7ckUG2lMrrh2bTBCOxFsFJ5lGor5X8xk4WkalwWpLFMMuVpuLIfvgaJK09kQ9eDoIvJtZhGAA8S7wfVqRVA9AwyinfD0LdYaaoqcw2OnIerBsUN8qjfCcDXWiiYo7ThN9QP1AJCPeicZaohqAJQZox8UMofmMv/IPeT74D6HXcJUssbgMcyR4lSaY4x+UOSIfJuL75su2m7uUklO1aFni7r+M1Qaa0i5+DT6ObTkmWuPMfqV4rFTY87yV40UsrySbsaaAV3FLymatkDx6CTyfaBBDrqJ2/c3/VSRI4Z/+cKoIFuLgoyOM4gKvUW+zRqxzxM4KJEXAXkJGCJqrWajURWK543RzzAqcVhBoVEepJ5qJAeVlAfAGcKzSs0eQPuigs3C085GeQgCicNNBnUngJdFelKvigMgUww28jnrjTYCfhSeHeS7FtOQ9CRTZydVWC8u14MkIx5pABwrxtZ+zXAj4Afhmc4gFOFA4nClcS6k3mol5RuSBsAAscrpxhuxTHjWK+JJ5tPEHf8y3/UkCrm3Bnr7seSMsdR4E+BsUZ8+2AIn3nGIyLPPPXgoWCbw8Vnt12rPAM05WqhOX2IUNb4Sn55kgRPvkLn7ymctYUDqsT61fSprD4B+or3vTAtNWMs64amxaHiBIHH3Ez9Z4GSW8CyT491/eJ8wdew2HYj0v5BCMRZpT+AaHNmiDbWdaN5NRH/Oe/d9rfYMIIV6nWfICGRffCA8y9EfCi0wBoteS7Ot8LKL/whPXQP5NhAPge+00gTYXzzVNr8h9YrXxRuU0HL8+cRd4oGwy3XaL0UtdoA3ihrwpcBNmWiqYh/tRCvG+db4GSj25T7ZVPZdAn4pVFQpTiZmIB0/ZwW3c9WK0aLhldkD9HjMEw+Ef+n8IykD4HfWmqAKuvCzJaXUCY3FuH0VGrMnuEOKKTy15iv7zgDSOZa97x/W8LHwtDVXWeRJxhhaC08/FG80TGGe8MzRNilLdAW/2mIT4NfiSrY5YmGiminidv7aKlfXiFt6B1exHmIjPBweaEQWP4lcRStQlBwg6ifL+X37iVw55DI4X9zG2P7WbhKbsZselvmqRg9FEI2bLPPVXNxGn6f+wW3C6zbXsKpmFIri/SQiruLpilxGBdY/HVgr8HVrTebjIZlbLLHdBrYzQXzej3G2WQNgnGKRnECRbdbE3nMwqpFGcqgBBwMiR5GXYze9bbNGb8X0vzESwaz+KnA2V/36BuH1a2y3AVDHxF0lbr7MoZUiPpf+GMreMFbgTGna11BUGawnKAcgQzwUjhHjQ4vOIg3EeCAxYsyPiH4yROCtQiUx2RXjF7bb8F/0VqZtfs6SsNPFIDYxYpRHYGnai8NE/hRuKieJL9vXZKtwr0LcdpJHpCmzpwq37tbQXORPkWpLOnPbbrsFcWjIQqXIHzM8C6TxdyUvCxX+gXYghfkfLr8qHRx+b5v/GviF6LNctRCY0wUaiEFs95adHGpbTDWwXOAx7nA//ruRUgxsss1/DSx2uAi+mPcMeeC15D0uVv53dAROTuIh+VcpkklIa9qrtvmvhUeU316MfAPOo0eR78DBw7bFUwuvCVz+XX5VSko81R81A8hQpkyMEaOU8Rq1gTSuE03mqspbFrKYu+FJgc/n5VelSNcP+aNmBE1F15Xq8pEm55HuyryJe8sXkTj72xcPiQP1f4j/WqQ8l1HaBVRhJ0NY5PD/k1jAX0IOJtOUu1nomKl4EUMiGcJKuo9QZDSVwgrcYJt/Bdo4bAn3lo38IaTYXI0Yq8wRXr3128+2SBSQwn3Pk1/9Vng1utH5W4kDtmbZxB8T7Jj9uFW8IdlXoC0ToqITYwR+FRGXvxdevdw2/w5o4qgOVquFL3JmgKOZLAbzL8VNX83ytu6U7QnhcoFjhbfySuHV39jm3xEZPOyhg2LEKORFRtHVU62dGMU0hRFK7fJIBDX/ePxG4DkuoHW8gaDUkHK3+q2iguv4msc9fIG5DGc4sI6FLGI5q9nIVnZSCjSkKa3IozPd6MlRPjx5djHaQEqoRGVUGwqz0FXCWDGRGipRHMoCj19ruGVhxA59ZUjppOLyCsRvA6WvPdrTG0A2rXndQgjZMqbTNpI7/5qQejBuVsiUH4v/jxqOZCCncbwlg5AG3MZt7OFzZvIuX9sWhhIuC3t8B0vhTKN0sVmNPlzA2Uajb6qQxYmcyF2s4RVesupDpYLUgwrNTtpXJ5RzSgP240ZFdqwolKXcFHba9oThchAUrwNIQSCi5IR5NM+ylvsiY6RWG4dwL2t53s0D1yikHtxV/We6/Ph/MJPqxB39mcV8RkZ0SYpHAy5iHh96DcmmHVIPxn3q8QNAuvjJtc0/cAJzmEV/22z4wsm8z6eRiGgmDYBt1X/GDwApoHELy+wfzAzmuEe2iSSO4yPednLFNAKpB+N6On4AFAiv2rzjasqDLEqCRHFOGMwiHrKa50RSSuN6On4buMXjz81gKI8FyFBWyg+sYjUb2MpWiimjNKE0lxk0pAGNaUVr8uhCZ7r61EOyGMf5jLGW9l7qwS3yq1L+aTvujblKlwu5lPMNf+NCDjPgj5/FYVzII8wXQ0Kpy/OW9CnJLHyY/OoJIuPm9wEns8azWNczhfMtOa805xye8GAtUFXWcLJxHnNFThQ6VTfxZbO77nRuU7qA1SyFTOKUCNxVZPArJnm8PC7nVsMOLLJrmOJavKEYkWuIQXZzeceTIL9gVKSOqCCbUXzmifd3jC4FUibjCvXtyTrh9WuNMXsQS13FV8kbEd4UHsfrood1zbKM7sY4GivQdwhd/anwuqkAESeIma9rlun0Mia6oOjFm66DoMDYIPYZIOIZ4fX3jTB6FsUuQvuSfoaEljiO5z8urSnmbCOczBRoP61+/RbhdRNBoka6KH5buSwiARe8Ip3fssVFITRhbSUFibpZ/bocJk73RvA3ovJZXV5MgmyBEtryL5choNvkNtdvmLhDRUb1rlcXOXZ/IRdqFpJejGCbQ+sqHLyMw8CJIlWH+IqZouujzlCxZ1LmIKDPkyBRpBs68blDC/dwpkbaUsSHEmczv6/9KQ0J4jhHX9tJSZAr3Asa8phDK0s0huKVlHqXBFaSM/FiTex1VQRY3vtljNYmFhu40uHm4GdtWdmXCNRcHP6vElcqHWpgM4djn6KIBKcLE6eLCaX2lmVabjNyRe3K5cPqIzIYfqq2NDG/zt5SIKU4rQPo63DU9YaGjKini5SOdv5RQzHZ2F2hM3ezUhSbk+C0LyiOYJOy3TcnXv0+uFvUOFz1qk+En30SMmvHKlfEQueMFkmPXhQotZ5jQ6Y1N1hPSuEYS0N1gWqmDLO0o45O/vE4RqkL5Ieqa+WIG+y/uP9wqMhcmMkaJysEUG706tkehioPvieHSGWISMGDct1MnJ7DuxMcqLwri240krAxRiGByhC9CaR7wDJv5qmSYcPykNjKVk7/U3RIOrKYolwGwsqMvEKo/VNvP71DZC0cI4Y7FQ2fH1JAp2RBI+YrJHFHKPUfLNb9Z28/Pk788Y0hsNVV3GTGKIqEp69ZdBXtdWOUhCILOdGWx31GhniT/VkIbL2oGPWjdEo6shilkMa/QqhbuoD62bsJrRQ0tiKAm0ZN9FWof29oFXOU8YZCFUzUu7ijKGkf0YyGiYwlmqPrfbHWbdbSq9vH/gprgUTN8MaLtZ7vvYKmooVeYvEvjlFMeNHLAmwSqg1hYgdikoJZ7C+a4ZsiW4l4uspBHRdFwLXDJjLF+KyxhDwJ5QTAb/ir5CKxkrsTYEpe/081IuYoo79CDwj+sd0j1ujTtK6pmJzlp8Df6ySRqVnm5BxhzBZl83jA2jLFZNs7/YezfUFk64xATDVnp1hb2PdfyQn53GVnQCORM8TapvmvaLBY0YxATF0p1jXTpJQjjVmifK4IVNcMsa4Al3kZoqdgBV0CMCUfe0YljJJ9nCbKZ36Amg4UzcACLt1yosYHfNfTXaH/h28ElaxIU+wF/N+/PCDWc08wtrqJo6nQd8Sb20Wm6s/lrxdcLcrojz5ryRHjFFR4DJMvQD67G+uzFml074pEALroIFc8elvks5axYn+9F5yts8UKV/mKxNNZrOOfNqQcaUwT5dTJRw1ZrBbrOCs4UxliDgF/t3fyYadOh6jkxFkJL5SXijXkJ3bWOk6sdKmPSqcLv9+WBCFfTaOheDH0puffZ7BM7KvrEmOrOdvFai/yzJaklrxoT84RxkuCpAo8x0W4WOyn7Yn7HN0vVrzM4xxwlPjraKeisoXfirLy5ieRKeZ8i3F/4my1U5hxXebp17IG0N6mnCOL/UVZebsuv1z8bQntwmBMvshZ68l+VfI2XmlTypHGD4K0vKTvzhYvgIJfKO2Dzor0if/n4bdSgtdnbMo40nhWkNYCD7+TPS1LfW0iHSHPAdtdY/dkikOnftsAOUFaMHe7Ju7KU9gXh/T9A3RU6AFurkzyLUDyhHszDTla80Euv5qqWP8TNeKtgQkikQoX+1Xpblp/1LHkhRzVyzljQl9FkK2HwmWttcJ+db7jdlC64lhvW8qRhpSm3uk0MENx1b6NVt4Iej1m2MJ94vOjHVf0DsKz1fqlmMRYJTxzmsrHKCJ+/IWtYbPWSHEvUCR2815IaR8CGCfVI0iGeGqHjg4K9S/fu6el9wCsuxXegTk8ofyNNA1tNCDG5IUkHfVk/oTCNuNGdnsl6CcC78t8JD4fzCWKX0gZq0KfmuoUpGw+qsxtoxThHj7kFV3sHaqI61mgWKek+6krdcswqSGZzy4V3zxAkaWk1CkUbG34i8G9hAni8xY8JVr4SZe+JUYEmayQpCOt5+k8pbCpmqAYMCGhsXheHSPGeOFtya74Au1CTGaMECQmZfgYr+iFlfpT6fRXOHmVChuSzcJ75wWgWX9wniCxzbXeOlpxO1NpxtVuqmL0rah1xicNgHNtyzjSONfDAGjOSkUPGIqz1EyZ1++1fTSB1ADwC/cBkMarCumvMXfI3l8Z6u2GGu+lBoBfuA+A6xWSNzT9V+FRBRvlDIh7KzUA/MJtAAxQBpk0ld3tv2gkmnrEiLE1Lvp9agD4hfMA6KaMN74waJi9oLm4dnOhYkffkhkprx8tyGUGLcX/FHOh98PfmgiejG2xMpfQIbxcR5K9RAlZvKKMGnKNtqwuLnhaMSHFeJY0UkuAf6iWgDQx/8/e8rQ9dpsoNYG9LsmpAeAXqgFwj1LOC+2m0T7QIQ3KuNQA8A15AFynlPFW+0F2Byo3JpXif1IDwAnSAChXnrrU3HQHQuIZeWeK10AAafU8BmBYyFDGUhkflThrTokRUzOAH5zrQ5Ih2v0niizeSw2AUOB9ALzr6jDiCeEkZd/DMLeUpCmEiq8YRnkYFYUzAGAHQ8i3KJD6hXyGsjOcqsIaALCJASmnDyPYwIDwbKvDGwCQz2kUWBBI/UIBA8Oca8McAPAdAyk0LJD6hW0M5LswKwx3AMBXDGK74xt+QszVPzhLZzuDkkHZPkZhsb63/Ex/2wxGFic7JJeOUUhf2wx6xVFi3rHqA8ybU3GCayGN65UptWPE2EJv2yz6QU/WOx5jvJaKElADzXjFUV7r6WmbRb/oIiYvrS759SBTuFf0URp67y0rg4d7tok8Rey6qlLGTaErocmHNK5XuHlUleXk2WYyKFoz1+VEe7ZDdIH6gDxFRPbq8hmtbTOZCBox2aWBW7nYNpPWMMJRWY4RY0pdSKo9xlG7jRFjRrgRrZIC7XndRSp7uMY2k2HhVNeRvp1rw7neTApkcLUi6Fb8zFinzks687VLg2MsrCcRBI/1IItv7Nv6hY1sprg2u5Jn6ngq6TZMVVr4VZfJdWHllzCKHa6N38Ef/We5TApkc7Mi+0J82clI24zqxCF84yqCGOu5so5dGmVyGWs9tHwBh9pmVTca8qAiuGnNspJL64hamMGFLkdie0sFD9aXVDq/UgSd3Lcs5/Ik9zLM4hJPnR9jNSfbZtYkcnjCgzIUI8aPXJ+k3sY5/EEZS2Vf5XeS73ScdQCnuFwXxSuGEznYNru+0JUHXXf61YvdKbbZtYVs7na5CIn/Sj5gRBKskRmcwTuetJwYMcq4x1PqnTqMQxTJ0+WymUfpY5tlJQ7lXhc7iJpldt3X+b3hLJb7EFuMxdyuDJZgB525wcP5XnxZwdm2mY4SGjDOwdFcLt/xJ/pYNy47lJuZ51GhrSoFXJ8Ei5lxtOB+MYe2c1nPkwy3cGfenLOYSL5vfot5QBn/OwX25zHPamFNFXEBDzPcQErK1pzBfcxzveKWSimP1/G7jlDQkYmKLGVeyipe5hYGhWxG1ZpTGM80Vvqc7KvLbh6no23R1obtFVSFdozlygQth7eymOWs4AdW8yNbiPn6dUs60YmudONgeiQ4nLYziUfZoF1qARDVAQDQjN8yJi7sZGIoZQM/s5UCCihiB8WUUE45kEkm2WTTjBxa0JKWtKFdaLvzfP7KUxRZkmHSI52hzFBGIYp2qeBdzkzZPYeBLvyJ1dY71E9Zy510ti22uoV0+vOUB4MK22UHzzIw9d3rQmPO5QV2Wu9mqezkJYbZDdtYX9CIIUwRMxLZKRuZylnJ2fVR3gW4896LwZzKsdZMKEv5nNm8xzdU2hZGUCTzAKhCNsfSjxPoa8yoYgfzmcsnfJr8SfDqwgCoQjo96MsR9OZwLUNhB9+ygK/4ksVU2G5sWKhLAyC+VR04jB50pTsHckBgC+M9rGUNK1nGMpayGn9niUmBujkAaiKDdrSnPfvRita0pDnNaEI22WSSAVRQTgkl7GI7RRSwha1sYT3r2FB3vvQUUkghhRRSSCGFFFL4H/4fFdHKhUblzLUAAAAuelRYdGRhdGU6Y3JlYXRlAAB42jMyMLTQNTDTNTAMMbC0MjC1MrXUNjCwMjAAAEILBRZUm4GTAAAALnpUWHRkYXRlOm1vZGlmeQAAeNozMjC00DUw0zUwDDGwtDIwtTK11DYwsDIwAABCCwUWfaQpGwAAAABJRU5ErkJggg=="},function(t,e){},function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement;return(t._self._c||e)("div",{attrs:{id:"registration"}},[t._v("Test message from registration")])},a=[],n={render:i,staticRenderFns:a};e.a=n},function(t,e){},function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement;t._self._c;return t._m(0)},a=[function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{attrs:{id:"footerVue"}},[i("div",{attrs:{id:"img_container"}},[i("img",{attrs:{src:s(36),alt:"logo",id:"footer_logo"}})]),t._v(" "),i("div",{attrs:{id:"contacts"}},[i("h2",[t._v("Наши контакты")]),t._v(" "),i("p",[t._v("По вопросам методического сопровождения дистанционных программ: (843) 233-74-26\n\t\t"),i("br"),t._v("\n\t\tПортал электронного обучения КФУ:\n\t\t"),i("a",{attrs:{href:"https://kpfu.ru/open"}},[t._v("https://kpfu.ru/open")])])])])}],n={render:i,staticRenderFns:a};e.a=n},function(t,e,s){t.exports=s.p+"static/img/logo.b575671.png"},function(t,e){},function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{attrs:{id:"home"}},[t._m(0),t._v(" "),s("br"),t._v(" "),s("hr"),t._v(" "),s("div",{attrs:{id:"miniCoursesContainer"}},[s("h2",[t._v("Курсы")]),t._v(" "),s("div",{attrs:{id:"miniCourses"}},t._l(t.shortList,function(e){return s("div",{staticClass:"miniCourse"},[s("h3",{staticClass:"miniTitle"},[t._v(t._s(e.shortTitle))]),t._v(" "),s("div",{staticClass:"miniCourseCont"},[s("div",{staticClass:"miniImgCont"},[s("img",{staticClass:"miniImg",attrs:{src:e.img,alt:"courseImg"}})]),t._v(" "),s("div",{staticClass:"miniText"},[t._v(t._s(e.shortText))]),t._v(" "),s("div",{staticClass:"miniButCont"},[s("button",{staticClass:"miniBut",on:{click:function(t){}}},[t._v("Перейти")])])])])}),0),t._v(" "),s("button",{attrs:{id:"more"},on:{click:t.coursesGo}},[t._v("Ещё")])]),t._v(" "),t._m(1),t._v(" "),s("iframe",{staticStyle:{border:"0"},attrs:{src:"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1122.4925365917768!2d52.016251975954!3d55.75876150433705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8fb0d1ea907eedb9!2zNTXCsDQ1JzMxLjUiTiA1MsKwMDEnMDIuNSJF!5e0!3m2!1sru!2sru!4v1666250654230!5m2!1sru!2sru",width:"600",height:"256",allowfullscreen:"",loading:"lazy",referrerpolicy:"no-referrer-when-downgrade"}})])},a=[function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{attrs:{id:"about_container"}},[i("h2",{attrs:{id:"aboutH"}},[t._v("О нас")]),t._v(" "),i("div",{attrs:{id:"about"}},[i("p",[t._v("Проект дополнительного образования Дом научной коллаборации реализован в рамках федерального проекта «Успех каждого ребенка» национального проекта «Образование». Татарстанский Дом научной коллаборации находится в Елабуге. "),i("br"),t._v("Важными задачами ДНК являются развитие у детей навыков проектной и творческой работы, а также обучение по приоритетным направлениям научно-технологического развития, среди которых робототехника, информационные и биотехнологии.")])]),t._v(" "),i("img",{staticClass:"about_image",attrs:{src:s(39),alt:"photo"}})])},function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{attrs:{id:"news"}},[s("h2",{attrs:{id:"newsH"}},[t._v("Новости")])])}],n={render:i,staticRenderFns:a};e.a=n},function(t,e,s){t.exports=s.p+"static/img/photo1.3b560a3.jpeg"},function(t,e){},function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{attrs:{id:"courses"}},[s("h2",{attrs:{id:"courseTitle"}},[t._v("Курсы")]),t._v(" "),t._l(t.coursesData,function(e){return s("div",{staticClass:"table_center_by_css"},[s("h3",{staticClass:"th_css"},[t._v(t._s(e.title))]),t._v(" "),s("div",{staticClass:"courseCont"},[s("div",{staticClass:"td_css_3"},[s("img",{staticClass:"courseImg",attrs:{src:e.img,alt:"courseImg"}})]),t._v(" "),s("div",{staticClass:"td_css"},[t._v(t._s(e.text))]),t._v(" "),s("div",{staticClass:"td_css_2"},[s("button",{staticClass:"button_css",on:{click:function(t){}}},[t._v("Перейти")])])])])})],2)},a=[],n={render:i,staticRenderFns:a};e.a=n},function(t,e){},function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement;t._self._c;return t._m(0)},a=[function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{attrs:{id:"contactsVue"}},[s("table",{staticClass:"table_center_by_css1"},[s("tr",[s("td",{staticClass:"td_css1",attrs:{cellspacing:"10"}},[t._v("Руководитель")]),t._v(" "),s("td",{staticClass:"td_css1",attrs:{valign:"top"}},[t._v("Латипова Лилия Николаевна, директор ДНК имени Камиля Ахметовича Валиева")])]),t._v(" "),s("tr",[s("td",{staticClass:"td_css1",attrs:{cellspacing:"10"}},[t._v("Телефон")]),t._v(" "),s("td",{staticClass:"td_css1",attrs:{valign:"top"}},[t._v("+7 917 261-86-58")])]),t._v(" "),s("tr",[s("td",{staticClass:"td_css1",attrs:{cellspacing:"10"}},[t._v("Адрес")]),t._v(" "),s("td",{staticClass:"td_css1",attrs:{valign:"top"}},[t._v("Республика Татарстан, г. Елабуга, ул.Строителей, д.16.")])]),t._v(" "),s("tr",[s("td",[s("hr",{staticClass:"contactHr"})])]),t._v(" "),s("tr",[s("td",{staticClass:"td_css1",attrs:{cellspacing:"10"}},[t._v("Учебный мастер")]),t._v(" "),s("td",{staticClass:"td_css1",attrs:{valign:"top"}},[t._v("Хузина Альбина Маратовна")])]),t._v(" "),s("tr",[s("td",{staticClass:"td_css1",attrs:{cellspacing:"10"}},[t._v("Телефон")]),t._v(" "),s("td",{staticClass:"td_css1",attrs:{valign:"top"}},[t._v("+7 987 064-45-78")])])])])}],n={render:i,staticRenderFns:a};e.a=n},function(t,e,s){"use strict";var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{attrs:{id:"app"}},[s("headerVue",{attrs:{mode:t.mode},on:{swap:t.swap}}),t._v(" "),s("main",["home"==t.mode?s("home",{on:{coursesGo:t.coursesGo}}):"courses"==t.mode?s("courses"):"contacts"==t.mode?s("contats"):t._e()],1),t._v(" "),s("footerVue")],1)},a=[],n={render:i,staticRenderFns:a};e.a=n},function(t,e,s){"use strict";var i=s(1),a=s(46);i.a.use(a.a);new a.a({routes:[{path:"/"},{path:"*",redirect:"/"}]})}],[17]);
//# sourceMappingURL=app.7e77fdfe78d29963192a.js.map