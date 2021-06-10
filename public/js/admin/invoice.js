$('.validation').each(function () { 
    if($(this).val()*1 == 0){
        $(this).val('N/A');
    }
});