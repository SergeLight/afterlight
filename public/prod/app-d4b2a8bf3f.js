(()=>{let e=function(e,n){return e.push({name:"_token",value:$("body").data("csrf")}),$.ajax({type:"POST",url:n,cache:!1,data:e})};$((function(){$(document).on("click",".change-auth",(function(){let e=$(this).data("change-to");$(".auth-wrapper").hide(),$("."+e+"-wrap").show()})),$(document).on("click","#register-user",(function(n){n.preventDefault();let t=$("#register-user-form").serializeArray();e(t,"/register-submit").done((function(e){e.hasOwnProperty("login")&&"success"===e.login&&(window.location.href="/wall")}))})),$(document).on("click","#login-user",(function(n){n.preventDefault();let t=$("#login-user-form").serializeArray();e(t,"/login-submit").done((function(e){e.hasOwnProperty("login")&&"success"===e.login&&(window.location.href="/wall")}))}))}))})();