$( document ).ready(function() {
        $('#register').submit(function(e) {
            e.preventDefault();
        }).validate({
            debug: false,
            rules: {
                "name": {
                    required: true
                },
                "surname": {
                    required: true
                },
                "surname2": {
                    required: true
                },
                "email": {
                    required: true,
                    email: true
                },
                "cpostal": {
                    required: true,
                    number:true,
                    minlength: 5,
                    maxlength: 5
                }
            },

            messages: {
                "name": {
                    required: ""
                },
                "surname": {
                    required: '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic;"> Introduzca un Apellido</font>'
                },
                "surname2": {
                    required: '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic;"> Introduzca un Apellido</font>'
                },
                "email": {
                    required: '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic;"> Introduzca un E-mail</font>',
                    email: 'Ingrese correo electrónico con formato correcto. Ejemplo: user@productivity.com'
                },
                "cpostal": {
                    required: '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic;"> Introduzca Postal.</font>',
                    number: "Introduce un código postal válido.",
                    maxlength: "Debe contener 5 dígitos.",
                    minlength: "Debe contener 5 dígitos."
                }
            }
 
        });
});
/* Validacion de Formulario Creacion Proyecto*/
$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
    $('#formProject').submit(function(e) {
        e.preventDefault();
    }).validate({
        submitHandler: function(form) {  
         if ($(form).valid())
         {
             form.submit(); 
         }
   return false;
},

            debug: true,
            rules: {
                 "cliente": { 
                    required: true
                },
                "nombreProyecto": {
                    required: true,
                    minlength: 3
                },
                "fechaInicio": {
                    required: true,
                    date: true
                }
            },

            messages: {
                "cliente": { 
                    required: fuenteError+' Seleccione un Cliente'+fuenteCierreError
                },
                "nombreProyecto": {
                    required: fuenteError+' Ingrese Nombre Proyecto'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 3 Caracteres'+fuenteCierreError
                },
                "fechaInicio": {
                    required: fuenteError+' Seleccione Fecha Inicio'+fuenteCierreError,
                    date: fuenteError+' Ingrese una Fecha Valida'+fuenteCierreError
                }
            }
        });
});