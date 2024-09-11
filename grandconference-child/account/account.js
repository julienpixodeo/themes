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

    // validate
    $("#register-client").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirm: {
                required: true,
                minlength: 8,
                equalTo: "#password" // Ensures the confirmation matches the password
            }
        },
        messages: {
            first_name: {
                required: "Ce champ est obligatoire.",
            },
            last_name: {
                required: "Ce champ est obligatoire.",
            },
            email: {
                required: "Ce champ est obligatoire.",
                email: "Veuillez entrer une adresse email valide."
            },
            password: {
                required: "Ce champ est obligatoire.",
                minlength: "Votre mot de passe doit contenir au moins 8 caractères."
            },
            password_confirm: {
                required: "Ce champ est obligatoire.",
                minlength: "Votre mot de passe doit contenir au moins 8 caractères.",
                equalTo: "Les mots de passe ne correspondent pas."
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
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

    // js ajax register 
    $('form#register-client').on('click','.submit_button',function(e){  
        e.preventDefault();
        var formStatus = $('form#register-client').validate().form();
        $('form#register-client .message').hide();
        if (formStatus == true) {
            $("body").addClass("ajax-load"); 
            $.ajax({
                url: jaxsr.url,
                type :'POST',
                data: { 
                    'action': 'RegisterClient', 
                    'email': $('form#register-client #email').val(), 
                    'password': $('form#register-client #password').val(), 
                    'password_confirm': $('form#register-client #password_confirm').val(),
                    'first_name': $('form#register-client #first_name').val(),
                    'last_name': $('form#register-client #last_name').val()
                },
                success: function(response){
                    if(response.data == true){
                        $('form#register-client .message').text('Compte créé avec succès');
                        $('form#register-client .message').css('color','#008000');
                        location.reload();
                    }else{
                        $('form#register-client .message').html(response.data);
                    }
                    $('form#register-client .message').show();
                    $("body").removeClass("ajax-load");
                }
            });
        }
    });
});