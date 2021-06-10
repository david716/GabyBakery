$(document).ready(function () {
    $('#weight, #product_type').change();
    /** Asigna los valores a los select **/
    if( $('#id').val()*1 > 0 ){
        $.ajax({
            type: "GET",
            url: "/edit_js/"+$('#id').val()*1,
            dataType: "json",
            success: function (data) {
                $.ajax({
                    type: "GET",
                    url: "/slice/"+data.slice_id,
                    dataType: "json",
                    success: function (data) {
                        $('#slice_id').val(data[0].id);
                        $('#slice').val(data[0].name);
                    }
                });
                $('#product_type').val(data.product_type_id).change();
                $('#product_shape').val(data.product_shape_id).change();
                $('#category').val(data.category_id).change();
                $('#weight').val(data.weight_id).change();
                $('#blonda').val(data.blonda_id).change();
                $('#category').val(data.category_id).change();
                $('#estado_product').val(data.estado_id).change();
                
                if($('#weight').val() == '1'){
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
                $('#value_extra').val(data.total_value - data.sub_value);
                $('#description').val(data.description).change();
            }
        });
    }    
});
var  total;
/** Calcula el Valor del producto **/
$('#weight, #coverage_1, #coverage_2, #dough, #dough_1_2, #dough_3_4, #filler, #filler_1, #filler_2').change(function () { 
    var  cubierta = masa = relleno = 0;
    total = 0;
    $('#value_total').val(0).change();
    $.ajax({
        type: "GET",
        url: "/admin/products/calculated_value/"+$('#weight').val()+'/0/0',
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
            total = cubierta + masa + relleno + data[3];
            $('#value').val(total)*1;
        }
    });
});

$('#value_extra').change(function () { 
    var total = 0;
    $('#value_total').val(0).change();
    total = $(this).val()*1 + $('#value').val()*1;
    $('#value_total').val(total);
});

/** Oculta o Muestra las masa rellenos y cubiertas dependineod del peso **/

$('#weight').change(function () { 
    $.ajax({
        type: "GET",
        url: "/slice/"+$('#weight').val()*1,
        dataType: "json",
        success: function (data) {
           $('#slice_id').val(data[0].id);
           $('#slice').val(data[0].name);
        }
    });
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
    $('#value_extra').val('');
    setTimeout(() => {
        value_extra();
    }, 500);
});

/* Oculta o Muestra los valores extras de los productos***/

$('#product_type').change(function () { 
    $('#weight').change();
    if($(this).val() == '2'){
        $('.semi_perzonalizado').show();
        $('.semi_perzonalizado .row .col input').removeAttr('disabled');
        $('#value_extra').prop('readonly', true);
    }else{
        $('.semi_perzonalizado').hide();
        $('.semi_perzonalizado .row .col input').prop('disabled', true);
        $('#value_extra').removeAttr('readonly');
    }
});

$('#libra_1, #libra_3_4, #libra_1_2, #libra_1_4').change(function () { 
    value_extra();
});

$(document).on('change','input[type="file"]',function(){
	// this.files[0].size recupera el tamaño del archivo
	// alert(this.files[0].size);
	
	var fileName = this.files[0].name;
	var fileSize = this.files[0].size;
    
    var nombre = fileName.split('');
    var ban = 0;
    for (let i = 0; i < nombre.length; i++) {
        if(nombre[i] === ' ')
            ban = 1;
    }

	if(fileSize > 8000000){
		alert('Tamaño del archivo', 'El archivo no debe superar los 8MB');        
		this.value = '';
		this.files[0].name = '';
	}else if(ban == 1){
        alert('Nombre del archivo', 'El nombre no puede contener espacios');
        this.value = '';
		this.files[0].name = '';
    }else{
		// recuperamos la extensión del archivo
		var ext = fileName.split('.').pop();
		
		// Convertimos en minúscula porque 
		// la extensión del archivo puede estar en mayúscula
		ext = ext.toLowerCase();
    
		// console.log(ext);
		switch (ext) {
			case 'jpg':
			case 'jpeg':
			case 'png': break;
			default:
				alert('Extencion del archivo','El archivo no tiene la extensión adecuada');
				this.value = ''; // reset del valor
				this.files[0].name = '';
		}
	}
});

function alert(titulo, mensaje){
    Swal.fire({
        title: titulo,
        text : mensaje,
        icon : 'warning',
        showCancelButton  : true,
        showConfirmButton: false,
        cancelButtonColor : '#d33',
    });
}

function value_extra(){
    $('#value_extra').val('');
    if($('#product_type').val()*1 == 2){
        if($('#weight').val()*1 == 1)
            $('#value_extra').val($('#libra_1').val()*1 - $('#value').val()*1);
        else if($('#weight').val()*1 == 2)
            $('#value_extra').val($('#libra_3_4').val()*1 - $('#value').val()*1);
        else if($('#weight').val()*1 == 3)
            $('#value_extra').val($('#libra_1_2').val()*1 - $('#value').val()*1);
        else if($('#weight').val()*1 == 4)
            $('#value_extra').val($('#libra_1_4').val()*1 - $('#value').val()*1); 
    }
    setTimeout(() => {
        var value_total = $('#value_extra').val()*1 + total;
        $('#value_total').val(value_total);
    }, 500);
}