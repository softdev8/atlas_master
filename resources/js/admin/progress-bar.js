window.NProgress =require('nprogress');
NProgress.start();

window.onload = function(){
    NProgress.done();
    $('.fade').removeClass('out');

    var $preloader = $('#fade-background');
    $preloader.delay(150).fadeOut(200);
}