$(function(){
    $('.formulaire').on('submit', function( e ){
        e.preventDefault();
        $form = $(this);
        submitForm($form);
    });

});

function submitForm($form){

    // $footer = $form.parent('.modal-body').next('.modal-footer');
    $.ajax({
        url: $form.attr('action'),
        method: $form.attr('method'),
        data: $form.serialize(),
        success: function (response) {
            response = $.parseJSON(response);
            console.log(response)
            
        }
    });

}
 