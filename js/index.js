// import { detect } from 'js/detect.js';
$(document).ready(function() {
    var nAgt = navigator.userAgent;
    var verOffset;
    if ((verOffset=nAgt.indexOf("MSIE"))==-1) {
        $(document).ready(function() {$('.goToLogin').on('mouseenter', function() { $(".L").attr("src","images/login0.png");$("img.L").toggleClass('tiny');}, )});
        $(document).ready(function() {$('.goToLogin').on('mouseleave', function() { $(".L").attr("src","images/login1.png");$("img.L").toggleClass('tiny');}, )});
        $(document).ready(function() {$('.goToRegister').on('mouseenter', function() { $(".R").attr("src","images/register1.png");$("img.R").toggleClass('tiny');}, )});
        $(document).ready(function() {$('.goToRegister').on('mouseleave', function() { $(".R").attr("src","images/register0.png");$("img.R").toggleClass('tiny');}, )});
        $(document).ready(function() {$('.goToLogin').on('click', function() {$(location).attr('href',"login.php");}, )});
        $(document).ready(function() {$('.goToRegister').on('click', function() {$(location).attr('href',"register.php");}, )});
    }
});