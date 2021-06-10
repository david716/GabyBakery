$(document).ready(function () {
    $.ajax({
         type: "GET",
         url: "/admin/event",
         dataType: "json",
         success: function (data) {
             localStorage.setItem("info", JSON.stringify(data))
         }
     });
 });

 $('#calendario').click(function () { 
    $.ajax({
        type: "GET",
        url: "/admin/event",
        dataType: "json",
        success: function (data) {
            localStorage.setItem("info", JSON.stringify(data))
        }
    });
});
