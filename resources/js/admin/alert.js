$(".alert").is( function(){
    setTimeout(function(){
        $('.alert').fadeOut();
        $('.alert').remove();
    }, 2000);
});
