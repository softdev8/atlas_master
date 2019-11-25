$(document).ready(function() {
    $('.modal.fade').on('click', e => {
        if($(e.target).hasClass('in')) {
            $(e.target).find('input').val('');
            $(e.target).find('select').html('');
        }
    });

    $('.modal-close').on('click', e => {
        $('form').find('input').val('');
        $('form').find('select').html('');
    });
});