if($('#topper_id').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/toppers/estado/"+$('#topper_id').val(),
        data: "data",
        success: function (data) {
            $("#estado_topper").val(data);
        }
    });
}