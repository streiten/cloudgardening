$(document).ready(function() {
    /*  console.log($(window).height());
        console.log($(window).width());*/

    $('#typer').css('height',$(window).height());
    $('#typer').css('width',$(window).width() / 1.5);

    textFit(document.getElementById('typer'),
        {   alignHoriz: true,
            alignVert: true,
            multiLine: true,
            maxFontSize: 400
        });
    //  $("#vertCentered span").lettering('words');

});
