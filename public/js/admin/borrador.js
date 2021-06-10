$(document).ready(function () {
   $('#weight').change();
   if( $('#id').val()*1 > 0 ){
        $.ajax({
            type: "GET",
            url: "/edit_js/"+$('#id').val()*1,
            dataType: "json",
            success: function (data) {
                $('#product_type').val(data.product_type_id).change();
                $('#product_shape').val(data.product_shape_id).change();
                $('#category').val(data.category_id).change();
                $('#weight').val(data.weight_id).change();
                $('#blonda').val(data.blonda_id).change();
                $('#category').val(data.category_id).change();
                $('#estado').val(data.estado).change();

                
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

                $('#description').val(data.description).change();

            }
        });
   }    
});


$('#weight').change(function () { 
    if($(this).val() == '1'){
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
});

$('.validation').each(function () { 
    if($(this).val()*1 == 0){
        $(this).val('N/A');
    }
});

$('#weight, #value, #coverage_1, #coverage_2, #dough, #dough_1_2, #dough_3_4, #filler, #filler_1, #filler_2').change(function () { 
    var value = $('#value').val()*1;
    if($('#weight').val() == 1){
        arr_id = [$('#coverage_1').val(), $('#dough_1_2').val(), $('#dough_3_4').val(), $('#filler').val()]; 
    }else{
        arr_id = [$('#coverage_2').val(), $('#dough').val(), $('#filler_1').val(), $('#filler_2').val()];
    }
    setTimeout(() => {
        $.ajax({
            type: "GET",
            url: "/calculated_value/"+arr_id+"/"+$('#weight').val(),
            dataType: "json",
            success: function (data) {
                console.log(data);
                var temp = 0;
                for (let i = 0; i < data.length; i++) {
                    temp += data[i][0].value*1;
                }
                var total = temp+value; 
                console.log(temp);
                $('#value_total').val(total).change();
            }
        });
    }, 500);  
});

public function calculated_value($arr_id, $param){

    $arr_id = explode(',', $arr_id);
    switch ($param) {
        case '1':
            $coverage   = DB::select('SELECT value FROM coverages WHERE id = ?', [$arr_id[0]]);
            $doug_1     = DB::select('SELECT value FROM dougs WHERE id = ?', [$arr_id[1]]);
            $doug_2     = DB::select('SELECT value FROM dougs WHERE id = ?', [$arr_id[2]]);
            $filler     = DB::select('SELECT value FROM fillers WHERE id = ?', [$arr_id[3]]);
            $json       = [$coverage, $doug_1, $doug_2, $filler];
            break;
        
        case '2':
            $coverage   = DB::select('SELECT value FROM coverages WHERE id = ?', [$arr_id[0]]);
            $doug       = DB::select('SELECT value FROM dougs WHERE id = ?', [$arr_id[1]]);
            $filler_1   = DB::select('SELECT value FROM fillers WHERE id = ?', [$arr_id[2]]);
            $filler_2   = DB::select('SELECT value FROM fillers WHERE id = ?', [$arr_id[3]]);
            $json       = [$coverage, $doug, $filler_1, $filler_2];
            break;
    }

    return $json;
}