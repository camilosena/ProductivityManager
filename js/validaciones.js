$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
    jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z áéíóúñüàè," "]+$/i.test(value);
        }, "Solo letras");
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
                    required: true,
                    lettersonly: true,
                    minlength: 3,
                    maxlength: 25
                },
                "apellido": {
                    required: true,
                    lettersonly: true,
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
                    maxlength: fuenteError+' Máximo 10 Digitos'+fuenteCierreError
                },
                "nombre": {
                    required: fuenteError+' Ingrese Nombre'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 3 Letras'+fuenteCierreError,
                    maxlength: fuenteError+' Máximo 25 Letras'+fuenteCierreError
                },
                "apellido": {
                    required: fuenteError+' Ingrese Apellidos'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 3 Letras'+fuenteCierreError,
                    maxlength: fuenteError+' Máximo 25 Letras'+fuenteCierreError
                },
                "telefono": {
                    required: fuenteError+' Ingrese Teléfono'+fuenteCierreError,
                    number: fuenteError+' Formato Erroneo'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 7 Digitos'+fuenteCierreError,
                    maxlength: fuenteError+' Máximo 10 Digitos'+fuenteCierreError
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
                    maxlength: fuenteError+' Máximo 20 Caracteres'+fuenteCierreError
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

/* Validacion olvido contraseña*/
$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
    $('#formContrasena').submit(function(e) {
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
                 "user": { 
                    required: true,
                    number:true,
                    minlength: 3,
                    maxlength: 10
                },
                "email": {
                   required: true,
                    email: true
                },
                "emailConfirm": {
                    required: true,
                    equalTo : "#email"
                }
            },

            messages: {
                "user": { 
                    required: fuenteError+'Documento'+fuenteCierreError,
                    number: fuenteError+'No Valido'+fuenteCierreError,
                    minlength: fuenteError+'Minimo 3'+fuenteCierreError,
                    maxlength: fuenteError+'Maximo 10'+fuenteCierreError
                },
                "email": {
                    required: fuenteError+'E-Mail'+fuenteCierreError,
                    email: fuenteError+'No Valido'+fuenteCierreError
                },
                "emailConfirm": {
                    required: fuenteError+'Confirme Email'+fuenteCierreError,
                    equalTo: fuenteError+'No Coincide'+fuenteCierreError
                }
            }
        });
});
/* Validacion olvido contraseña English Index*/
$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
    $('#formContrasenaEg').submit(function(e) {
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
                 "user": { 
                    required: true,
                    number:true,
                    minlength: 3,
                    maxlength: 10
                },
                "email": {
                   required: true,
                    email: true
                },
                "emailConfirm": {
                    required: true,
                    equalTo : "#email"
                }
            },

            messages: {
                "user": { 
                    required: fuenteError+'Document'+fuenteCierreError,
                    number: fuenteError+'Not Valid'+fuenteCierreError,
                    minlength: fuenteError+'Minimum 3'+fuenteCierreError,
                    maxlength: fuenteError+'Maximum 10'+fuenteCierreError
                },
                "email": {
                    required: fuenteError+'E-Mail'+fuenteCierreError,
                    email: fuenteError+'Not Valid'+fuenteCierreError
                },
                "emailConfirm": {
                    required: fuenteError+'Confirm Mail'+fuenteCierreError,
                    equalTo: fuenteError+'Do Not Match'+fuenteCierreError
                }
            }
        });
});
/*Validacion Formulario Clientes*/
$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
        $('#formClientes').submit(function(e) {
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
                "nombreCompania": {
                    required: true,
                    minlength: 2,
                    maxlength: 25

                },
                "nit": {
                    required: true,
                    number:true,
                    minlength: 5,
                    maxlength: 12
                },
                "sectorEmp": {
                    required: true
                },
                "sectorEco": {
                    required: true
                },
                "direccion": {
                    required: true,
                    minlength: 2,
                    maxlength: 30
                },
                "telefonoFijo": {
                    required: true,
                    number:true,
                    minlength: 7,
                    maxlength: 10
                },
                "nombre": {
                    required: true,
                    lettersonly: true,
                    minlength: 2,
                    maxlength: 25
                },
                "apellido": {
                    required: true,
                    lettersonly: true,
                    minlength: 2,
                    maxlength: 25
                },
                "identificacion": {
                    required: true,
                    number:true,
                    minlength: 3,
                    maxlength: 10
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
                }
            },

            messages: {
                "nombreCompania": {
                    required: fuenteError+' Ingrese Nombre Empresa'+fuenteCierreError,
                    minlength: fuenteError+'Minimo 2 Caracteres'+fuenteCierreError,
                    maxlength: fuenteError+'Máximo 25 Caracteres'+fuenteCierreError
                },
                "nit": {
                    required: fuenteError+' Ingrese N.I.T.'+fuenteCierreError,
                    number: fuenteError+' Documento No Valido'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 5 Digitos'+fuenteCierreError,
                    maxlength: fuenteError+' Maximo 12 Digitos'+fuenteCierreError
                },
                "sectorEmp": {
                    required: fuenteError+'Sector Empresarial'+fuenteCierreError
                },
                "sectorEco": {
                    required: fuenteError+'Sector Económico'+fuenteCierreError
                },
                "direccion": {
                    required: fuenteError+' Ingrese una Dirección'+fuenteCierreError,
                    minlength: fuenteError+'Minimo 2 Caracteres'+fuenteCierreError,
                    maxlength: fuenteError+'Máximo 30 Caracteres'+fuenteCierreError
                },
                "telefonoFijo": {
                    required: fuenteError+' Ingrese Teléfono Fijo'+fuenteCierreError,
                    number: fuenteError+' Formato Erroneo'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 7 Digitos'+fuenteCierreError,
                    maxlength: fuenteError+' Maximo 10 Digitos'+fuenteCierreError
                },
                "nombre": {
                    required: fuenteError+' Ingrese Nombre'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError,
                    minlength: fuenteError+'Minimo 2 Letras'+fuenteCierreError,
                    maxlength: fuenteError+'Máximo 25 Letras'+fuenteCierreError
                },
                "apellido": {
                    required: fuenteError+' Ingrese Apellidos'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError,
                    minlength: fuenteError+'Minimo 2 Letras'+fuenteCierreError,
                    maxlength: fuenteError+'Máximo 25 Letras'+fuenteCierreError
                },
                "identificacion": {
                    required: fuenteError+' Ingrese Documento'+fuenteCierreError,
                    number: fuenteError+' Documento No Valido'+fuenteCierreError,
                    minlength: fuenteError+' Minimo 3 Digitos'+fuenteCierreError,
                    maxlength: fuenteError+' Maximo 10 Digitos'+fuenteCierreError
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
                }
            }
 
        });
});
/* Validacion crear Rol*/
$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
     jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z áéíóúñüàè," "]+$/i.test(value);
        }, "Solo letras");
        $('#formRoles').submit(function(e) {
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
                 "IdRol": { 
                    required: true,
                    number:true,
                    minlength: 1,
                    maxlength: 10
                },
                "NameRol": {
                   required: true,
                   lettersonly: true
                }
            },

            messages: {
                "IdRol": { 
                    required: fuenteError+'Ingrese Id Rol'+fuenteCierreError,
                    number: fuenteError+'Id No Valido'+fuenteCierreError,
                    minlength: fuenteError+'Minimo 1 Caracter'+fuenteCierreError,
                    maxlength: fuenteError+'Máximo 10 Caracteres'+fuenteCierreError
                },
                "NameRol": {
                    required: fuenteError+'Ingrese Rol'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError
                }
            }
        });
});
/* Validacion agregar area*/
$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
     jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z áéíóúñüàè," "]+$/i.test(value);
        }, "Solo letras");
        $('#formArea').submit(function(e) {
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
                 "IdArea": { 
                    required: true,
                    number:true,
                    minlength: 1,
                    maxlength: 10
                },
                "NombreArea": {
                   required: true,
                   lettersonly: true
                }
            },

            messages: {
                "IdArea": { 
                    required: fuenteError+'Ingrese Id Área'+fuenteCierreError,
                    number: fuenteError+'Id No Valido'+fuenteCierreError,
                    minlength: fuenteError+'Minimo 1 Caracter'+fuenteCierreError,
                    maxlength: fuenteError+'Máximo 10 Caracteres'+fuenteCierreError
                },
                "NombreArea": {
                    required: fuenteError+'Ingrese Área'+fuenteCierreError,
                    lettersonly: fuenteError+' Solo Letras'+fuenteCierreError
                }
            }
        });
});