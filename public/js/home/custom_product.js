$(document).ready(function () {
    $('#total_value').val('');
    //$('#weight, #topper').change();
    weight($('#weight').val()*1);
    topper($('#topper').val()*1)
    if(localStorage.getItem("id")*1 > 0){
        $.ajax({
            type: "GET",
            url: "/edit_js/"+localStorage.getItem("id")*1,
            dataType: "json",
            success: function (data) {
                $('#weight').val(data.weight_id).change();
                if($('#weight').val() == 1){
                    $('#coverage_1').val((data.coverage_id*1 != 0 ? data.coverage_id : 1)).change();
                }else{
                    $('#coverage_2').val((data.coverage_id*1 != 0 ? data.coverage_id : 1)).change();
                }
                $('#dough').val((data.dough_id*1 !=0 ? data.dough_id : 1)).change();
                $('#dough_1_2').val((data.dough_1_2_id*1 != 0 ? data.dough_1_2_id : 1)).change();
                $('#dough_3_4').val((data.dough_3_4_id*1 != 0 ? data.dough_3_4_id : 1)).change();
                $('#filler').val((data.filler_id*1 != 0 ? data.filler_id : 1)).change();
                $('#filler_1').val(data.filler_1_id*1 != 0 ? data.filler_1_id : 1).change();
                $('#filler_2').val((data.filler_2_id*1 != 0 ? data.filler_2_id : 1)).change();                
            }
        });
    }

        $('#estado_id').val(localStorage.getItem("estado"));
        $('#purchase_date').val(localStorage.getItem("fecha_pedido"));
        $('#purchase_hour').val(localStorage.getItem("hora_pedido"));
        $('#delivery_date').val(localStorage.getItem("fecha_entrega"));
        $('#delivery_hour').val(localStorage.getItem("hora_entrega"));
});

$('#topper').change(function () { 
    topper($(this).val()*1)
});

$('#weight').change(function () { 
    ban = 0;
    $.ajax({
        type: "GET",
        url: "/slice/"+$('#weight').val()*1,
        dataType: "json",
        success: function (data) {
           $('#slice_id').val(data[0].id);
           $('#slice').val(data[0].name);
        }
    });
    weight($(this).val()*1);
});

var ban  = aux1 = 0;
$('#weight, #coverage_1, #coverage_2, #dough, #dough_1_2, #dough_3_4, #filler, #filler_1, #filler_2, #topper').change(function () { 
    var total = aux = cubierta = masa = relleno = 0;
        $.ajax({
        type: "GET",
        url: "/admin/products/calculated_value/"+$('#weight').val()*1+'/'+localStorage.getItem("id")+'/'+$('#topper').val()*1,
        dataType: "json",
        success: function (data) {
            if($('#weight').val() == '1'){
                cubierta = data[0][$('#coverage_1').val()*1]*1;
                masa     = Math.max(data[1][$('#dough_1_2').val()*1]*1 , data[1][$('#dough_3_4').val()*1]*1);
                relleno  = data[2][$('#filler').val()*1]*1
            }else{
                cubierta = data[0][$('#coverage_2').val()*1]*1;
                masa     = data[1][$('#dough').val()*1]*1;
                relleno  = Math.max(data[2][$('#filler_1').val()*1]*1 , data[2][$('#filler_2').val()*1]*1)
            }
            aux   = cubierta + masa + relleno + data[3];
            if(ban == 0){
                aux1  = data[4] - aux;
                ban = 1;
            }
            total = aux1 + aux;
            $('#total_value').val(total);
        }
    });
});

function weight(n){
    if(n == 1){
        $('#1_libra').show();
        $('#menor_1_libra').hide();
        $('#menor_1_libra .row .col select').prop('disabled', true);
        $('#1_libra .row .col select').removeAttr('disabled');
    }else{
        $('#1_libra').hide();
        $('#menor_1_libra').show();
        $('#1_libra .row .col select').prop('disabled', true);
        $('#menor_1_libra .row .col select').removeAttr('disabled');
    }
}

function topper(n){
    if(n == 0){
        $('#vela, #color').prop('disabled', true);
        $('.vela, .color').hide();
    }else if(n == 1){
        $('#vela, #color').removeAttr('disabled');
        $('.vela, .color').show();
    }else{
        $('#vela').prop('disabled', true);
        $('.vela').hide();
        $('#color').removeAttr('disabled');
        $('.color').show();
    }
}



