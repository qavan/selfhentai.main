//
//autosize of window
$(document).ready(function(){1280<=$(window).width()&&720<=$(window).height()?$(".gigaForm").css("transform","scale(1.35)"):$(".gigaForm").css("transform","scale(1)")}),$(window).resize(function(){if(480<=$(window).width()&&480<=$(window).height()){var i=1+2/9*$(window).height()/1980+2/9*$(window).width()/1080;$(".gigaForm").css("transform","scale("+i.toFixed(1)+")")}else if($(window).width()<=320&&$(window).height()<=480){i=1-2/9*$(window).height()/1980-2/9*$(window).width()/1080;$(".gigaForm").css("transform","scale("+i.toFixed(1)+")")}else $(".gigaForm").css("transform","scale(1)")});
//
//login validator
$(document).ready(function() {$("#login").on("input", function(e) {let label = $('#first_warn_label');let button = $('.login-button');if ((/^[a-zA-Z]+[a-zA-Z0-9]{4,32}/).test($(e.target).val())===false) {label.text('Введите допустимый логин!');label.css('color', '#ffab00');button.attr('disabled', 'disabled');} else {label.text('Логин:');label.removeAttr('style');button.removeAttr('disabled');}});$("#first_warn_label").trigger("input");});//check login pattern
//
//password validator
$(document).ready(function(){$("#password").on("input",function(e){let label=$('#second_warn_label');let button=$('.login-button');if((/^[a-zA-Z0-9]{6,32}/).test($(e.target).val())===!1){label.text('Введите допустимый пароль!');label.css('color','#ffab00');button.attr('disabled','disabled')}else{label.text('Пароль:');label.removeAttr('style');button.removeAttr('disabled')}});$("#second_warn_label").trigger("input")});
//login-button all form validator
function check(){let button=$('.login-button');if((/^[a-zA-Z]+[a-zA-Z0-9]{4,32}/).test($("#login").val())&&(/^[a-zA-Z0-9]{6,32}/).test($("#password").val())){button.removeAttr('disabled')}else{alert('Вы не ввели данные для входа!');button.attr('disabled','disabled')}}
