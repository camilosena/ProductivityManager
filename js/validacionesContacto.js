$( document ).ready(function() {
    fuenteError = '<font style="float:right; color: red; font-size: 9px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
    jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z áéíóúñüàè," "]+$/i.test(value);
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
                    lettersonly: true,
                    minlength: 3,
                    maxlength: 25
                },
                "apellidos": {
                    required: true,
                    lettersonly: true,
                    minlength: 3,
                    maxlength: 25
                },
                "empresa": {
                    required: true,
                    minlength: 3,
                    maxlength: 25
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
                    required: true,
                    minlength: 5,
                    maxlength:100
                }
            },

            messages: {
                "nombre": {
                    required: fuenteError+' Ingrese Nombre'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError,
                    minlength: fuenteError+' Min. 3 Letras'+fuenteCierreError,
                    maxlength: fuenteError+' Max. 25 Letras'+fuenteCierreError
                },
                "apellidos": {
                    required: fuenteError+' Ingrese Apellido'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError,
                    minlength: fuenteError+' Min. 3 Letras'+fuenteCierreError,
                    maxlength: fuenteError+' Max. 25 Letras'+fuenteCierreError
                },
                "empresa": {
                    required: fuenteError+' Ingrese Empresa'+fuenteCierreError,
                    minlength: fuenteError+' Min. 3 Caracteres'+fuenteCierreError,
                    maxlength: fuenteError+' Max. 25 Caracteres'+fuenteCierreError
                },
                "telefono": {
                    required: fuenteError+' Ingrese Teléfono'+fuenteCierreError,
                    number: fuenteError+' Formato Erroneo'+fuenteCierreError,
                    minlength: fuenteError+' Min. 7 Digitos'+fuenteCierreError,
                    maxlength: fuenteError+' Max. 10 Digitos'+fuenteCierreError
                },
                "email": {
                    required: fuenteError+' Ingrese E-Mail'+fuenteCierreError,
                    email: fuenteError+'Ej: user@mail.co'+fuenteCierreError
                },
                "pais": {
                    required: fuenteError+' Seleccione País'+fuenteCierreError
                },
                "motivo": {
                    required: fuenteError+' Ingrese Motivo'+fuenteCierreError,
                    minlength: fuenteError+' Min. 5 Caracteres'+fuenteCierreError,
                    maxlength: fuenteError+' Max. 100 Caracteres'+fuenteCierreError
                }
            }
 
        });
});