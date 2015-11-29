
/* Validacion de Formulario Creacion Proyecto*/
$( document ).ready(function() {
    fuenteError = '<font style="color: red; font-size: 11px; font-family: Sans-Serif;font-style:italic; ">';
    fuenteCierreError= '</font>';
    $('#formNovedades').submit(function(e) {
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
                 "idProyecto": {
                    required: true
                },
                "categoria": {
                    required: true
                },
                "uploadedfile": {
                    required: true
                },
                "descripcion": {
                    required: true,
                    minlength: 5,
                    maxlength: 180
                }
            },

            messages: {
                "idProyecto": {
                    required: fuenteError+' Seleccione un Proyecto'+fuenteCierreError
                },
                "categoria": {
                    required: fuenteError+' Seleccione una Categoria'+fuenteCierreError
                },
                "uploadedfile": {
                    required: fuenteError+' Cargue un Archivo'+fuenteCierreError
                },
                "descripcion": {
                    required: fuenteError+' Ingrese una Descripción'+fuenteCierreError,
                    minLength: fuenteError+' Minimo 5 Carácteres'+fuenteCierreError,
                    maxLength: fuenteError+' Máximo 10 Carácteres'+fuenteCierreError
                }
            }
        });
});