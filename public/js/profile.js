
$(document).on('click', '#delete' ,function(e){
    $.ajax({
        async: true,
        type: 'POST',
        data: {id:this.value},
        success: function(response) {
			jQuery("body").html(response);
        }
    });
});
