try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    //require('bootstrap-sass');
    require('datatables.net');
    require('datatables.net-bs4'); //( window, $ )
    require('cropit/dist/jquery.cropit.js');
    require('sweetalert');
    require('jquery-datetimepicker');

    require('./admin/layout.js');
    require('./admin/datatables.js');
    require('./admin/confirm.js');
    require('./admin/chatroom.js');
    require('./admin/alert.js');
    require('./admin/progress-bar.js');
    require('./admin/modals.js');

} catch (e) {}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});