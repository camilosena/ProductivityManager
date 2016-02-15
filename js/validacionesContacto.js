$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 9px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
    jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z," "]+$/i.test(value);
        }, "Solo letras");
        $('#formContact').submit(function(e) {
            e.preventDefault();
        }).validate({
            submitHandler: function(form) {  
         if ($(form).valid())
         {
             form.submit(); 
         }
        return false;
    },
            debug: false,
            rules: {
                "nombre": {
                    required: true,
                    lettersonly: true
                },
                "apellidos": {
                    required: true,
                    lettersonly: true
                },
                "empresa": {
                    required: true
                },
                "telefono": {
                    required: true,
                    number:true,
                    minlength: 7,
                    maxlength: 10
                },
                "email": {
                    required: true,
                    email: true
                },
                "pais": {
                    required: true
                },
                "motivo": {
                    required: true
                }
            },

            messages: {
                "nombre": {
                    required: fuenteError+' Ingrese Nombre'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError
                },
                "apellidos": {
                    required: fuenteError+' Ingrese Apellido'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError
                },
                "empresa": {
                    required: fuenteError+' Ingrese Empresa'+fuenteCierreError
                },
                "telefono": {
                    required: fuenteError+' Ingrese Teléfono'+fuenteCierreError,
                    number: fuenteError+' Formato Erroneo'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 7 Digitos'+fuenteCierreError,
                    maxlength: fuenteError+' Maximo 10 Digitos'+fuenteCierreError
                },
                "email": {
                    required: fuenteError+' Ingrese E-Mail'+fuenteCierreError,
                    email: fuenteError+'Ej: user@mail.co'+fuenteCierreError
                },
                "pais": {
                    required: fuenteError+' Seleccione País'+fuenteCierreError
                },
                "motivo": {
                    required: fuenteError+' Ingrese Motivo'+fuenteCierreError
                }
            }
 
        });
});