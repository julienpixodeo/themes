jQuery(function($){
    // validate
    $("form#login").validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            username: {
                required: "Ce champ est obligatoire."
            },
            password: {
                required: "Ce champ est obligatoire."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    // js ajax login
    $('form#login').on('click','.submit_button',function(e){ 
        e.preventDefault();
        var formStatus = $('form#login').validate().form();
        $('form#login .message').hide();
        if (formStatus == true) {
            $("body").addClass("ajax-load"); 
            $.ajax({
                url: jaxsr.url,
                type :'POST',
                data: { 
                    'action': 'ajaxlogin', 
                    'username': $('form#login #username').val(), 
                    'password': $('form#login #password').val(), 
                    'security': $('form#login #security').val() },
                success: function(response){
                    if(response.data == true){
                        $('form#login .message').text('Connectez-vous avec succès');
                        $('form#login .message').css('color','#008000');
                        window.location.href = $('.referring-url').val();
                    }
                    $('form#login .message').show();
                    $("body").removeClass("ajax-load");
                }
            });
        }
    });
});