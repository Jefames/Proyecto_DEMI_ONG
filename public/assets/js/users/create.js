$(document).ready(function() {
    //Validación previa de si se está seleccionado el tipo de servicio de atención de sedes
    validarTipoServicio();

    // Mostrar u ocultar el div según la selección de tipo_servicio_id
    $('#tipo_servicio_id').change(function() {
        const isAtencionSedes = $(this).find('option:selected').text().trim() === 'Atención de Sedes';
        $('#atencionSedeDiv').toggle(isAtencionSedes);

        if (isAtencionSedes) {
            $('#tipo_atencion_sede').attr('required', 'required'); // Agregar el atributo required si es 'Atención de Sedes'
        } else {
            $('#tipo_atencion_sede').val(''); // Resetear el select si no es 'Atención de Sedes'
            $('#tipo_atencion_sede').removeAttr('required'); // Quitar el atributo required si no es 'Atención de Sedes'
        }
    });

    // Validar el formulario en el evento submit
    $('form').submit(function(event) {
        const isAtencionSedes = $('#tipo_servicio_id').find('option:selected').text().trim() === 'Atención de Sedes';
        const tipoAtencionSedeVal = $('#tipo_atencion_sede').val();

        if (isAtencionSedes && !tipoAtencionSedeVal) {
            alert('Por favor, seleccione un tipo de atención sede.');
            $('#tipo_atencion_sede').focus();
            event.preventDefault(); // Prevenir el envío del formulario
        }
    });
});

// Contraseñas view icon y validaciones
document.addEventListener('DOMContentLoaded', function() {
    // Función para alternar la visibilidad de la contraseña
    function togglePasswordVisibility() {
        let passwordInput = document.getElementById('password');
        let passwordIcon = document.getElementById('togglePassword').getElementsByTagName('i')[0];

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }

    // Agregar listener al icono de toggle de visibilidad de contraseña
    document.getElementById('togglePassword').addEventListener('click', togglePasswordVisibility);
    // Agregar listener al campo de contraseña
    document.getElementById('password').addEventListener('keyup', habilitarConfirmacion);
    // Deshabilitar el campo de confirmación de contraseña inicialmente
    document.getElementById('confirm_password').disabled = true;
    
    document.getElementById('tipo_servicio_id').addEventListener('click', validarTipoServicio);
});

// Función para habilitar el campo de confirmación de contraseña
function habilitarConfirmacion() {
    let password = document.getElementById('password').value;
    let confirm_password_field = document.getElementById('confirm_password');

    // Habilitar el campo de confirmación si la contraseña es válida
    if (validarPassword(password)) {
        confirm_password_field.disabled = false;
        confirm_password_field.addEventListener('keyup', validarContraseñas);
    } else {
        confirm_password_field.disabled = true;
    }
}

// Función para validar la contraseña
function validarPassword(password) {
    let regex = /^(?=.*[!@#\$%\^&\*])(?=.*[A-Z])(?=.{8,})/;
    let mensajeValidacion = document.getElementById('mensaje-validacion');

    // Mostrar mensaje de error si la contraseña no es válida
    if (!regex.test(password)) {
        mensajeValidacion.textContent = 'La contraseña debe tener al menos 8 caracteres, 1 mayúscula y contener al menos un carácter especial.';
        mensajeValidacion.style.color = 'red';
        return false;
    } else {
        // Mostrar mensaje de éxito si la contraseña es válida
        mensajeValidacion.textContent = 'Contraseña válida.';
        mensajeValidacion.style.color = 'green';
        return true;
    }
}

// Función para validar que las contraseñas coincidan
function validarContraseñas() {
    let password = document.getElementById('password').value;
    let confirm_password = document.getElementById('confirm_password').value;
    let mensajeConfirmacion = document.getElementById('mensaje-confirmacion');

    // Mostrar mensaje de éxito si las contraseñas coinciden
    if (password === confirm_password) {
        mensajeConfirmacion.textContent = 'Las contraseñas coinciden.';
        mensajeConfirmacion.style.color = 'green';
    } else {
        // Mostrar mensaje de error si las contraseñas no coinciden
        mensajeConfirmacion.textContent = 'Las contraseñas no coinciden.';
        mensajeConfirmacion.style.color = 'red';
    }
}

// Función que valida el tipo de servicio y muestra el bombobox  de atención de sedes
function validarTipoServicio() {
    let tipoServicio = document.getElementById('tipo_servicio_id').value;
    let atencionSedeDiv = document.getElementById('atencionSedeDiv');
    let tipoAtencionSede = document.getElementById('tipo_atencion_sede');

    if (tipoServicio === '4') {
        atencionSedeDiv.style.display = 'block';
        tipoAtencionSede.required = true;
    } else {
        atencionSedeDiv.style.display = 'none';
        tipoAtencionSede.required = false;
    }
}