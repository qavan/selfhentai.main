//
//autosize of window
$(document).ready(function(){1280<=$(window).width()&&720<=$(window).height()?$(".gigaForm").css("transform","scale(1.25)"):$(".gigaForm").css("transform","scale(1)")}),$(window).resize(function(){if(480<=$(window).width()&&480<=$(window).height()){var i=1+3/17*$(window).height()/1980+4/19*$(window).width()/1080;$(".gigaForm").css("transform","scale("+i.toFixed(1)+")")}else $(window).width()<=320&&$(window).height()<=480?(i=1-4/18*$(window).height()/1980-5/36*$(window).width()/1080,$(".gigaForm").css("transform","scale("+i.toFixed(1)+")")):$(".gigaForm").css("transform","scale(1)")});
//
//login validator
$(document).ready(function() {$("#login").on("input", function(e) {let label = $('#first_warn_label');let button = $('.login-button');if ((/^[a-zA-Z]+[a-zA-Z0-9]{4,32}/).test($(e.target).val())===false) {label.text('Введите допустимый логин!');label.css('color', '#ff7400');button.attr('disabled', 'disabled');} else {label.text('Логин:');label.removeAttr('style');button.removeAttr('disabled');}});$("#first_warn_label").trigger("input");});//check login pattern
//
//password validator
$(document).ready(function(){$("#password").on("input",function(e){let label=$('#second_warn_label');let button=$('.login-button');if((/^[a-zA-Z0-9]{6,32}/).test($(e.target).val())===!1){label.text('Введите допустимый пароль!');label.css('color','#ff7400');button.attr('disabled','disabled')}else{label.text('Пароль:');label.removeAttr('style');button.removeAttr('disabled')}});$("#second_warn_label").trigger("input")});
//login-button all form validator
function check(){let button=$('.login-button');if((/^[a-zA-Z]+[a-zA-Z0-9]{4,32}/).test($("#login").val())&&(/^[a-zA-Z0-9]{6,32}/).test($("#password").val())){button.removeAttr('disabled')}else{alert('Вы не ввели данные для входа!');button.attr('disabled','disabled')}}
// $(".a1").hover(function(event){$(".symbol").css("color","red");},function(){$(".symbol").css("color","#cecece;")});
$(function(){$(document).on("mouseenter",".a1", function (e) {let s=$(".symbol");s.css("transform","rotate(-90deg) translateX(-1px) translateY(-1px)");s.css("color","#ff7400");s.css("font-weight","bold");s.css("font-size","14px");s.text("\u2633")});});
$(function(){$(document).on("mouseleave",".a1", function (e) {let s=$(".symbol");s.css("transform","rotate(0deg) translateX(1px) translateY(1px)");s.css("color","#ff00a0");s.css("font-weight","bolder");s.css("font-size","10px");s.text("\u2632");});});
$(function(){$(document).on("mouseenter",".a2", function (e) {let s=$(".symbol");s.css("transform","rotate(-90deg) translateX(-1px) translateY(-1px)");s.css("color","#ff0000");s.css("font-weight","bold");s.css("font-size","14px");s.text("\u2636");});});
$(function(){$(document).on("mouseleave",".a2", function (e) {let s=$(".symbol");s.css("transform","rotate(-180deg) translateX(1px) translateY(-4px)");s.css("color","#008cff");s.css("font-weight","bolder");s.css("font-size","10px");s.text("\u2632");});});