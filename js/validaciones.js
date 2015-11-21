$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
        $('#formUsuarios').submit(function(e) {
            e.preventDefault();
        }).validate({
            debug: false,
            rules: {
                "selectRol": {
                    required: true
                },
                "selectArea": {
                    required: true
                },
                "identificacion": {
                    required: true,
                    number:true,
                    minlength: 3,
                    maxlength: 10
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
                "selectRol": {
                    required: fuenteError+' Seleccione un Rol'+fuenteCierreError
                },
                "selectArea": {
                    required: fuenteError+' Seleccione un Área'+fuenteCierreError
                },
                "identificacion": {
                    required: '',
                    number: "Introduce un código postal válido.",
                    maxlength: "Debe contener 5 dígitos.",
                    minlength: "Debe contener 5 dígitos."
                },
                "email": {
                    required: fuenteError+' Seleccione un Cliente'+fuenteCierreError,
                    email: 'Ingrese correo electrónico con formato correcto. Ejemplo: user@productivity.com'
                },
                "cpostal": {
                    required: '',
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