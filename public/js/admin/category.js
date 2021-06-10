if($('#category_id').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/category/estado/"+$('#category_id').val(),
        data: "data",
        success: function (data) {
            $("#estado_category").val(data);
        }
    });
}