if($('#coverage_id').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/coverage/estado/"+$('#coverage_id').val(),
        data: "data",
        success: function (data) {
            $("#estado_coverage").val(data);
        }
    });
}