$(document).ready(function() {
    /**
     * Render Delete modal window on click del-button
     */
    $('.data-tables').delegate('.btn-delete', 'click', function(){
        var self = $(this);
        var url = $(this).val();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this entry!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: false,
                },
                confirm: {
                    text: "Delete",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                },
            },
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("Deleted! The entry has been deleted!", {
                    icon: "success",
                });
                dataTablesDelete(self, url);
            } else {
                swal("The entry is safe!", {
                    icon: "error",
                });
            }
        });
    });

    /**
     * Ajax delete function
     *
     * @param self
     */
    function dataTablesDelete(self, url) {
        $.ajax({
            url: url,
            method: 'DELETE'
        })
        .done(function(response) {
            self.parent().parent().remove();
            $('.navbar > .container-fluid').append('<div class="alert alert-success" role="alert">'+response+'</div>');
            setTimeout(function(){
                $('.alert').fadeOut();
                $('.alert').remove();
            }, 2000);
        })
        .fail(function(xhr, status, error) {
            $('.navbar > .container-fluid').append('<div class="alert alert-danger" role="alert">'+response+'</div>');
            setTimeout(function(){
                $('.alert').fadeOut();
                $('.alert').remove();
            }, 2000);
        });
    }

});