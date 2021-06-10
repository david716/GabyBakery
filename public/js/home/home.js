$(document).ready(function () {
    $("#letra").hide();
    $(window).resize(function() {
        var esVisible = $("#btn").is(":visible");
        if(esVisible == true){
            $("#boton").hide();
            $("#letra").show();
            $(".info-producto").hide();
            $('#mySidebar').css('width', '0');
            $('#main').css('marginLeft', '0');
            $('#btn-ocultar').hide();
            $('#btn-mostrar').show();
        }else if(esVisible == false){
            $("#boton").show();
            $("#letra").hide();
            $(".info-producto").show();
            $('#mySidebar').css('width', '200px');
            $('#main').css('marginLeft', '200px');
            $('#btn-mostrar').hide();
            $('#btn-ocultar').show();
        }
    });  

    $(window).resize(function() {
        var anchod=$(document).width();
        if(anchod <= 1190){
            $('.card-deck').css('display', 'block');
        }else if(anchod > 1190){
            $('.card-deck').css('display', 'flex');
        } 
    });  
});

$('#cancelar, #inicio').click(function() { 
    localStorage.clear();
});

function modal(imagen, nombre, informacion, tipo, id) {
    localStorage.clear();
    $('#imagen').attr('src', "http://127.0.0.1:8000"+imagen);
    $('#titulo').text(nombre);
    $('#informacion').text(informacion);
    cargar_id(id);
    var html = '';
    
    if(tipo*1 == 2){
        html +='<div class="col">'+
                    '<a  href="date/" type="button" class="btn btn-success btn-block" onclick="cargar_estado_perzonalizar(0)"> Perzonlaizar</a>'+
                '</div>';
    }

    html += '<div class="col">'+
                '<a href="date/" type="button" class="btn btn-warning btn-block" onclick="cargar_estado_comprar(0)"> Comprar</a>'+
            '</div>';
    ;

    $('#botones').html(html);
}

function cargar_estado_perzonalizar(n) {
    if(n != 0)
        localStorage.clear();
    localStorage.setItem("estado", 2);
}

function cargar_estado_perzonalizar_2(n) {
    if(n != 0)
        localStorage.clear();
    localStorage.setItem("estado", 3);
}

function cargar_estado_comprar(n) {
    if(n != 0)
        localStorage.clear();
    localStorage.setItem("estado", 1);
} 

function cargar_id(id){
    //localStorage.clear();
    setTimeout(() => {
        localStorage.setItem("id", id);
    }, 100);
    
}

  (
    function(){
        var w=window;
        var ic=w.callbell;
        if(typeof ic==="function"){
            ic('reattach_activator');
            ic('update',callbellSettings);
        }else{
            var d=document;
            var i=function(){
            i.c(arguments)};
            i.q=[];
            i.c=function(args){
                i.q.push(args)
            };
            w.Callbell=i;
            var l=function(){
                var s=d.createElement('script');
                s.type='text/javascript';
                s.async=true;
                s.src='https://dash.callbell.eu/include/'+window.callbellSettings.token+'.js';
                var x=d.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s,x);
            };
            if(w.attachEvent){
                w.attachEvent('onload',l);
            }else{
                w.addEventListener('load',l,false);
            }
        }
    }
    )()

$('.validation').each(function () { 
    if($(this).val()*1 == 0){
        $(this).val('N/A');
    }
});