
$(document).ready(function () {
    $('#opt_forma').change();
});

$("#formulario").submit(function(e){
    if(!validar()){
        alert("error")
        e.preventDefault();
    }
});

function validar(){

    var cubierta_1 = cubierta_2 = sabor_m_1_2 = sabor_m_3_4 = sabor_m = sabor_r = sabor_r1 = sabor_r2 = 0;

    $('.lis_sabor .col').each(function () {
        if($('.'+$(this).find('.cubierta').siblings().val()).is(':checked'))
            cubierta_1 = 1;
    
        if($('.'+$(this).find('.masa_1_2').siblings().val()).is(':checked'))
            sabor_m_1_2 = 1;
    
        if($('.'+$(this).find('.masa_3_4').siblings().val()).is(':checked'))
            sabor_m_3_4 = 1
        
        if($('.'+$(this).find('.masa_m').siblings().val()).is(':checked'))
            sabor_m = 1
        
        if($('.'+$(this).find('.relleno').siblings().val()).is(':checked'))
            sabor_r = 1
    
        if($('.'+$(this).find('.relleno_1').siblings().val()).is(':checked'))
            sabor_r1 = 1
        
        if($('.'+$(this).find('.relleno_2').siblings().val()).is(':checked'))
            sabor_r2 = 1
    });

    if($('#tamano').val() === '1'){
        if((cubierta_1 == 1 && sabor_m_1_2 == 1 && sabor_m_3_4 == 1 && sabor_r == 1)){
            $('#Realizar_Compra').removeAttr('disabled');
            return true;
        }else{
            $('#Realizar_Compra').attr('disabled', 'true');
            return false;
        }
    }else{
        if((cubierta_1 == 1 && sabor_m == 1 && sabor_r1 == 1 && sabor_r2 == 1)){
            $('#Realizar_Compra').removeAttr('disabled');
            return true;
        }else{
            $('#Realizar_Compra').attr('disabled', 'true');
            return false;
        }
    }
}

$('#borde').change(function() { 
    console.log($(this).val()*1)
    if($(this).val()*1 != 0){
        $('#sabor_borde').show();
        $('#borde_sabor').removeAttr('disabled');
    }else{
        $('#sabor_borde').hide();
        $('#borde_sabor').attr('disabled', 'true');
    }
});

$('#numero').change(function() { 
    if($(this).val()*1 != 0){
        $('#color_velas').show();
        $('#velas_color').removeAttr('disabled');
    }else{
        $('#color_velas').hide();
        $('#velas_color').attr('disabled');
    }
});

$('#men_pred').change(function() { 
    if($(this).val() != 'Otro'){
        $('#mensaje').hide();
        $('#mensaje_caja').attr('disabled')
    }else{
        $('#mensaje').show();
        $('#mensaje_caja').removeAttr('disabled', 'true')
    }
});

$('#men_pred').change(function() { 
    if($(this).val() == '0'){
        $('#color_mensaje').hide();
        $('#mensaje_color').attr('disabled', 'true')
    }else{
        $('#color_mensaje').show();
        $('#mensaje_color').removeAttr('disabled')
    }
});

$('#tamano').change(function(){
    if($('#tamano').val() != '1'){
        $('#sabor_2').show();
        $('#sabor').hide();
        $('#sabor .row .col input[type=radio]').attr('disabled', 'true');
        $('#sabor_2 .row .col input[type=radio]').removeAttr('disabled');
        $('.1_libra').attr('disabled', 'true');
        $('.m_libra').removeAttr('disabled');
    }
    else{
        $('#sabor').show();
        $('#sabor_2').hide();
        $('#sabor_2 .row .col input[type=radio]').attr('disabled', 'true');
        $('#sabor .row .col input[type=radio]').removeAttr('disabled');
        $('.m_libra').attr('disabled', 'true');
        $('.1_libra').removeAttr('disabled');
    }
    validar();
})

$('.cubierta, .masa_1_2, .masa_3_4, .masa_m, .relleno, .relleno_1, .relleno_2').click(function () { 
    $("."+$(this).siblings().val()).prop("checked", true);
    calcular();
    validar();
});

$('#tamano, #men_pred, #numero').change(function () { 
    var canvas = $('#renderCanvas');
    canvas.attr("height", "1000");
    calcular();
});

$('.sabor').hover(function () {
        cadena = String($(this).siblings().val()).replaceAll('_', ' ');
        $(this).append( $( "<span style='font-size: 15px;'> "+cadena+"</span>" ) );
    }, function () {
       $( this ).find( "span" ).last().remove();
    }
);

function calcular(){
    var total = cubierta = masa = relleno = 0;
    var mensaje = ($('#men_pred').val()*1 !=0 ? 6000 : 0);
    var topper = ($('#numero').val()*1 !=0 ? 6000 : 0)
    $.ajax({
        type: "GET",
        url: "/admin/products/calculated_value/"+$('#tamano').val()*1+'/0/0',
        dataType: "json",
        success: function (data) {
            if($('#tamano').val() == 1){
                cubierta = ($('#id_coverage').val()*1 != 0 ? data[0][$('#id_coverage').val()*1]*1 : 0 );
                masa     = Math.max(
                            ($('#id_doug_1_2').val()*1 != 0 ? data[1][$('#id_doug_1_2').val()*1]*1 : 0) , 
                            ($('#id_doug_3_4').val()*1 !=0 ? data[1][$('#id_doug_3_4').val()*1]*1 : 0)
                        );
                relleno  = ($('#id_filler').val()*1 !=0 ? data[2][$('#id_filler').val()*1]*1 : 0)
                total = cubierta + masa + relleno + data[3]*1 + topper + mensaje;
            }else{
                cubierta = ($('#id_coverage').val()*1 != 0 ? data[0][$('#id_coverage').val()*1]*1 : 0 );
                masa     = ($('#id_doug').val()*1 != 0 ? data[1][$('#id_doug').val()*1]*1 : 0 );
                relleno  = Math.max(
                            ($('#id_filler_1').val()*1 != 0 ? data[2][$('#id_filler_1').val()*1]*1 : 0 ) , 
                            ($('#id_filler_2').val()*1 != 0 ? data[2][$('#id_filler_2').val()*1]*1 : 0 )
                        );
                total = cubierta + masa + relleno + data[3]*1 + topper + mensaje;
            }
            $('#value').val(total)
        }
    });
}
