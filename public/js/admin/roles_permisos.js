if($('#id_role').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/roles_permission/"+$('#id_role').val(),
        dataType: "json",
        success: function (data) {
            $('#permissions').val(data[0].permissions.split(',')).change();
        }
    });    
}

if($('#id_user').val()*1 > 0){
    $.ajax({
        type: "GET",
        url: "/admin/role_user/"+$('#id_user').val(),
        dataType: "json",
        success: function (data) {
            var rol = ( data.length != 0 ? data[0].role_id : 2);
            $('#role').val(rol).change();
        }
    });    
}