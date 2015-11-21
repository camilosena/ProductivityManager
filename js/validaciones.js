$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
        $('#formUsuarios').submit(function(e) {
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
                "nombre": {
                    required: true
                },
                "apellido": {
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
                "fechaNacimiento": {
                    required: true,
                    date: true
                },
                "password": {
                    required: true,
                    minlength: 5,
                    maxlength: 20
                },
                "password2": {
                    required: true,
                    equalTo : "#pass1"
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
                    required: fuenteError+' Ingrese Documento'+fuenteCierreError,
                    number: fuenteError+' Documento No Valido'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 3 Digitos'+fuenteCierreError,
                    maxlength: fuenteError+' Maximo 10 Digitos'+fuenteCierreError
                },
                "nombre": {
                    required: fuenteError+' Ingrese Nombre'+fuenteCierreError
                },
                "apellido": {
                    required: fuenteError+' Ingrese Apellidos'+fuenteCierreError
                },
                "telefono": {
                    required: fuenteError+' Ingrese Teléfono'+fuenteCierreError,
                    number: fuenteError+' Formato Erroneo'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 7 Digitos'+fuenteCierreError,
                    maxlength: fuenteError+' Maximo 10 Digitos'+fuenteCierreError
                },
                "email": {
                    required: fuenteError+' Ingrese E-Mail'+fuenteCierreError,
                    email: fuenteError+'No Valido Ej: user@productivity.co'+fuenteCierreError
                },
                 "fechaNacimiento": {
                    required: fuenteError+' Seleccione Fecha Nacimiento'+fuenteCierreError,
                    date: fuenteError+' Ingrese una Fecha Válida'+fuenteCierreError
                },
                "password": {
                    required: fuenteError+' Ingrese Contraseña'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 5 Caracteres'+fuenteCierreError,
                    maxlength: fuenteError+' Maximo 20 Caracteres'+fuenteCierreError
                },
                "password2": {
                    required: fuenteError+' Confirme Contraseña'+fuenteCierreError,
                    equalTo: fuenteError+' Contraseñas No Coinciden'+fuenteCierreError
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