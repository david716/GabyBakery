$(document).ready(function() {
    var info_producto;
    /*var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();*/

    /*  className colors
    className: default(transparent), important(red), chill(pink), success(green), info(blue)
    */

    /* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });

    if(localStorage.getItem("id")*1 > 0){
        $.ajax({
            type: "GET",
            url: "/get_product/"+localStorage.getItem("id")*1,
            dataType: "json",
            success: function (data) {
                info_producto = data;
            }
        });
    }

    /* initialize the calendar
    -----------------------------------------------------------------*/

    var calendar =  $('#calendar').fullCalendar({
        header: {
            left: 'title',
            center: 'agendaDay,agendaWeek,month',
            right: 'prev,next today'
        },
        editable: true,
        firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
        selectable: true,
        defaultView: 'month',
        axisFormat: 'hh:mm:ss tt',
        columnFormat: {
            month: 'ddd',    // Mon
            week: 'ddd d', // Mon 7
            day: 'dddd M/d',  // Monday 9/7
            agendaDay: 'dddd d'
        },
        titleFormat: {
            month: 'MMMM yyyy', // September 2009
            week: "MMMM yyyy", // September 2009
            day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
        },
        allDaySlot: false,
        selectHelper: true,
       
        select: function(start, end, allDay) {
            var fecha_entrega = $.fullCalendar.formatDate(start,'yyyy-MM-dd');
            var hora_entrega;

            var fecha_pedido = $.fullCalendar.formatDate(new Date(),'yyyy-MM-dd');           
            var hora_pedio   = $.fullCalendar.formatDate(new Date(), 'hh:mm:ss TT');

            var horaInicio = moment('09:00', 'h:mma');
            var horaFin = moment('16:00', 'h:mma');
            var horaV = moment('00:00', 'h:mma');
            var hora = moment($.fullCalendar.formatDate(start,'HH:mm'), 'h:mma');
            var duration = moment.duration(hora.diff(horaV)).asHours();
            
            if(duration == 0){
                hora_entrega = '10:00:00 AM';
            }else{
                hora_entrega = $.fullCalendar.formatDate(start,'hh:mm:ss TT');
            }

         
            var tem_f_p  = fecha_pedido.split('-');
            var n = 0;
            if(localStorage.getItem("id")*1 > 0){
                if(info_producto.product_type_id*1 != 1){
                    n = 5;
                }else{
                    n = 2;
                }
            }else{
                n = 5;
            }
            var dia = parseInt(tem_f_p[2])+n;
            if(dia < 10){
                tem_f_p[2] = "0"+dia.toString();
            }else{
                tem_f_p[2] = dia.toString();
            }
            var fecha_anticipacion = tem_f_p.toString().replaceAll(',' , '-');
            var f_e, h_e;
            var ban = 0;

            $.ajax({
                type: "GET",
                url: "/check_data",
                dataType: "json",
                success: function (data) {
                    if(data == 0){
                        if (fecha_entrega >= fecha_pedido) {
                            if(fecha_entrega >= fecha_anticipacion){
                                if((hora > horaInicio && hora < horaFin) || duration == 0){
                                    ban = 1;
                                    f_e = fecha_entrega;
                                    h_e = hora_entrega;
                                    Swal.fire({
                                        title: 'Realizar Pedido',
                                        text: 'Para el dia: '+ fecha_entrega +' y hora: '+ hora_entrega,
                                        icon : 'success',
                                        showCancelButton  : true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor : '#d33',
                                        confirmButtonText : 'Confirmar'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            if(localStorage.getItem("estado")*1 == 1){
                                                url = "../standarProduct/"+info_producto.id+"/standar";
                                            }
                                            else if (localStorage.getItem("estado")*1 == 2){
                                                url = "../customizeProduct/"+info_producto.id+"/customize";
                                            }
                                            else{
                                                url = "../customize";
                                            }
                                            $(location).attr('href',url);
                                        }else{
                                            localStorage.removeItem("fecha_pedido");
                                            localStorage.removeItem("hora_pedido");
                                            localStorage.removeItem("fecha_entrega");
                                            localStorage.removeItem("hora_entrega");
                                        }
                                    }); 
                                    calendar.fullCalendar('unselect');
                                }else{
                                    alerta('Selecione una hora comprendida entre las \n 9:00 am y las 4:00 pm');
                                }
                            }else{
                                alerta('Se necesita por lo menos '+n+' dias de anticipacion');
                            }
                        }
                        else{
                            alerta('No es posible realizar pedido en dias pasados');                   
                        }
                    }else{
                        $.ajax({
                            type: "GET",
                            url: "/validate_date/"+fecha_entrega+"/"+hora_entrega,
                            dataType: "json",
                            success: function (data) {
                                if (fecha_entrega >= fecha_pedido) {
                                    if(fecha_entrega >= fecha_anticipacion){
                                        if((hora > horaInicio && hora < horaFin) || duration == 0){
                                            if(data[0] < 5){
                                                if(data[1] == 0){
                                                    ban = 1, 
                                                    f_e = fecha_entrega;
                                                    h_e = hora_entrega;
                                                    Swal.fire({
                                                        title: 'Realizar Pedido',
                                                        text: 'Para el dia: '+ fecha_entrega +' y hora: '+ hora_entrega,
                                                        icon : 'success',
                                                        showCancelButton  : true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor : '#d33',
                                                        confirmButtonText : 'Confirmar'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            if(localStorage.getItem("estado")*1 == 1){
                                                                url = "../standarProduct/"+info_producto.id+"/standar";
                                                            }
                                                            else if (localStorage.getItem("estado")*1 == 2){
                                                                url = "../customizeProduct/"+info_producto.id+"/customize";
                                                            }
                                                            else{
                                                                url = "../customize";
                                                            }
                                                                
                                                            $(location).attr('href',url);
                                                        }else{
                                                            localStorage.removeItem("fecha_pedido");
                                                            localStorage.removeItem("hora_pedido");
                                                            localStorage.removeItem("fecha_entrega");
                                                            localStorage.removeItem("hora_entrega");
                                                        }
                                                    }); 
                                                    calendar.fullCalendar('unselect');
                                                }else{
                                                    alerta('Ya hay una entrega asiganda a esta hora', 'Favor selecione otra hora');
                                                }
                                            }
                                            else{
                                                alerta('No es posible relizar pedidos para esta fecha (Agotado)', "Por favor seleciona otra fecha");
                                            }
                                        }else{
                                            alerta('Selecione una hora comprendida entre las \n 9:00 am y las 4:00 pm');
                                        }
                                    }else{
                                        alerta('Se necesita por lo menos '+n+' dias de anticipacion', "Por favor seleciona otra fecha",);
                                    }
                                }else{
                                    alerta('No es posible realizar pedido en dias pasados', "Por favor seleciona otra fecha",);
                                }
                            }
                        });
                    }
                }
            });

            setTimeout(() => {
                if(ban == 1){
                    localStorage.setItem("fecha_pedido", fecha_pedido);
                    localStorage.setItem("hora_pedido", hora_pedio);
                    localStorage.setItem("fecha_entrega", f_e);
                    localStorage.setItem("hora_entrega", h_e);
                }
            }, 500);

        },
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }

        }
    });


});

function alerta(titulo, texto){
    Swal.fire({
        title: titulo,
        text : texto,
        icon : 'warning',
        showCancelButton  : true,
        showConfirmButton: false,
        cancelButtonColor : '#d33',
    });
}