$.ajax({
    type: "GET",
    url: "/admin/extras/validate_weigth/",
    dataType: "json",
    success: function (data) {
        data.forEach(element => {
            $("#weight_extras").find("option[value='"+element+"']").css({ "display": "none"});
        });
    }
});

if($('#extras_id').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/extras/weigth_extras/"+$('#extras_id').val(),
        data: "data",
        success: function (data) {
            $("#weight_extras").val(data);
        }
    });
}