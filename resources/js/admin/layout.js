/**
 * Admin sidebar toggle
 */
$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    $('#content-wrapper').toggleClass('stretch');
    $('.admin-title').toggleClass('admin-title-hide');
});

$('.quickview-collapse-btn').on('click', function () {
    $('#quickview').toggleClass('quickview-open');
});

$('.close-quickview').on('click', function () {
    $('#quickview').toggleClass('quickview-open');
});