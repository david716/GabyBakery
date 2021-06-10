$(document).ready(function () {
    var esVisible = $("#btn").is(":visible");
    visible(esVisible);
    $(window).resize(function() {         
        var esVisible = $("#btn").is(":visible");
        visible(esVisible);    
   });   
});

function visible(esVisible){
    if(esVisible === true){
        $('#mySidebar').css('width', '0px');
        $('#main').css('marginLeft', '0px');
        $('#btn-ocultar').hide();
        $('#btn-mostrar').show();
    }else if(esVisible === false){
        $('#mySidebar').css('width', '230px');
        $('#main').css('marginLeft', '230px');
        $('#btn-mostrar').hide();
        $('#btn-ocultar').show();
    }
}

function openNav() {
    $('#mySidebar').css('width', '240px');
    $('#main').css('marginLeft', '240px');
    $('#btn-mostrar').hide();
    $('#btn-ocultar').show();
}

function closeNav() {
    $('#mySidebar').css('width', '0');
    $('#main').css('marginLeft', '0');
    $('#btn-ocultar').hide();
    $('#btn-mostrar').show();
}
