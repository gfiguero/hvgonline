jQuery(document).ready(function($) {
    var optionsFileinput = {
        showPreview: false,
        showRemove: false,
        showUpload: false,
        showCancel: false,
        showClose: false,
        showZoom: false,
        browseClass: 'btn btn-primary btn-block',
        browseLabel: 'Seleccionar Archivo'
    }
    $(".fileinput").find('input').fileinput(optionsFileinput);
});


$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
//        if (width < 992) {
        if (width < 768) {
            $('div.sidebar-collapse').addClass('collapse');
            $('div.navbar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
            $('div.navbar-collapse').removeClass('collapse');
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

