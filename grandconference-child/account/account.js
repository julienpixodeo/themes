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

    // validate
    $("#edit-client").validate({
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
                minlength: 8
            },
            password_confirm: {
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
                minlength: "Votre mot de passe doit contenir au moins 8 caractères."
            },
            password_confirm: {
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
                        window.location.href = $('.url-comple').val();
                    }else{
                        $('form#register-client .message').html(response.data);
                    }
                    $('form#register-client .message').show();
                    $("body").removeClass("ajax-load");
                }
            });
        }
    });

    // js ajax edit client 
    $('form#edit-client').on('click', '.submit_button', function(e){  
        e.preventDefault();
        var formStatus = $('form#edit-client').validate().form(); // Ensure you have validation set up
        $('form#edit-client .message').hide();
        if (formStatus) {
            $("body").addClass("ajax-load");
            $.ajax({
                url: jaxsr.url,
                type: 'POST',
                data: {
                    'action': 'EditClient',
                    'email': $('form#edit-client #email').val(),
                    'password': $('form#edit-client #password').val(),
                    'password_confirm': $('form#edit-client #password_confirm').val(),
                    'first_name': $('form#edit-client #first_name').val(),
                    'last_name': $('form#edit-client #last_name').val(),
                    'edit_client_nonce': $('#edit_client_nonce').val() // Include nonce
                },
                success: function(response){
                    if (response.data === true) {
                        $('form#edit-client .message').text('Information mise à jour avec succès');
                        $('form#edit-client .message').css('color','#008000');
                        if(response.pw == true){
                            window.location.href = $('.url-login').val();
                        } 
                    } else {
                        $('form#edit-client .message').html(response.data);
                    }
                    $('form#edit-client .message').show();
                    $("body").removeClass("ajax-load");
                }
            });
        }
    });

    // refund order
    $('body').on('click','.refund-button', function() {
        var order_id = $(this).data('order-id');
        var messageBox = $('#message-' + order_id);
        $("body").addClass("ajax-load");
        $.ajax({
            url: jaxsr.url,
            type: 'POST',
            data: {
                action: 'process_ajax_refund',
                order_id: order_id,
            },
            success: function(response) {
                $("body").removeClass("ajax-load");
                if (response.success) {
                    messageBox.removeClass('error').addClass('success');
                    messageBox.text('Remboursement traité avec succès !');
                } else {
                    messageBox.removeClass('success').addClass('error');
                    messageBox.text('Le remboursement a échoué: ' + response.data);
                }

                // Show the message
                messageBox.slideDown();

                // Hide the message after 5 seconds
                setTimeout(function() {
                    messageBox.slideUp();
                }, 3000);
                location.reload();
            },
            error: function() {
                $("body").removeClass("ajax-load");
                messageBox.removeClass('success').addClass('error');
                messageBox.text('Une erreur s\'est produite. Veuillez réessayer.');

                // Show the message
                messageBox.slideDown();

                // Hide the message after 5 seconds
                setTimeout(function() {
                    messageBox.slideUp();
                }, 3000);
            }
        });
    });
    
});