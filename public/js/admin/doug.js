if($('#dough_id').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/dough/estado/"+$('#dough_id').val(),
        data: "data",
        success: function (data) {
            $("#estado_dough").val(data);
        }
    });
}