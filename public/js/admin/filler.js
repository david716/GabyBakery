if($('#filler_id').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/filler/estado/"+$('#filler_id').val(),
        data: "data",
        success: function (data) {
            $("#estado_filler").val(data);
        }
    });
}