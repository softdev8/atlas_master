$(document).ready(function() {
    /**
     * User activate switcher
     */
    $('.data-tables').delegate('.btn-user-activate', 'click', function(){
        var btn = $(this);
        var data = {
            'id': btn.data('user')
        };

        $.ajax({
            url: '/admin/users/confirm',
            type: 'POST',
            data: data
        }).done(function(response) {
            if(btn.hasClass('badge-warning')){
                btn.removeClass('badge-warning').addClass('badge-dark').text('Confirmed');
            }
            else {
                btn.removeClass('badge-dark').addClass('badge-warning').text('Need confirm');
            }
        }).fail(function(xhr, status, error) {
            $('.navbar > .container-fluid').append('<div class="alert alert-danger" role="alert">'+response+'</div>');
            setTimeout(function(){
                $('.alert').fadeOut();
                $('.alert').remove();
            }, 2000);
        });
    });
});