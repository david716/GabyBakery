if($('#weigth_id').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/weigths/estado/"+$('#weigth_id').val(),
        data: "data",
        success: function (data) {
            $("#estado_weigth").val(data);
        }
    });
}