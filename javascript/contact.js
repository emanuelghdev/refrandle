document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-contact');
    const feedbackDiv = document.getElementById('form-feedback');
    const submitButton = document.getElementById('submit-button');
    const buttonText = document.getElementById('button-text');
    
    // Funciones de validación
    function muestraError(input, msg) {
        const span = input.parentElement.querySelector('.mensaje-error');
        span.textContent = msg;
        span.setAttribute('role', 'alert');
        input.classList.add('campo-error');
        input.setAttribute('aria-invalid', 'true');
    }
    
    function limpiaError(input) {
        const container = input.parentElement;
        const span = container.querySelector('.mensaje-error');
        span.textContent = '';
        span.removeAttribute('role');
        input.classList.remove('campo-error');
        input.removeAttribute('aria-invalid');
        input.style.color.opacity = "60%";
    }
    
    function validarEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    
    // Validación en tiempo real
    const campos = ['email', 'categoria', 'mensaje'];
    
    campos.forEach(id => {
        const input = document.getElementById(id);
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                limpiaError(this);
            }
        });
        
        input.addEventListener('blur', function() {
            if (!this.checkValidity()) {
                if (this.validity.valueMissing) {
                    muestraError(this, 'Este campo es obligatorio.');
                } else if (this.id === 'email' && !validarEmail(this.value)) {
                    muestraError(this, 'Introduce un correo válido.');
                } else if (this.validity.tooShort) {
                    muestraError(this, 'Texto demasiado corto.');
                }
            }
        });
    });
    
    // Manejo de envío del formulario
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            feedbackDiv.style.display = 'block';
            feedbackDiv.textContent = '';
            feedbackDiv.className = '';
            feedbackDiv.removeAttribute('aria-live');
            
            // Verificamos campo anti-bots
            if (document.getElementById('empresa').value) {
                return;
            }
            
            let valido = true;
            
            // Validamos todos los campos
            campos.forEach(id => {
                const input = document.getElementById(id);
                limpiaError(input);
                
                if (id === 'email' && input.value && !validarEmail(input.value)) {
                    muestraError(input, 'Introduce un correo válido.');
                    valido = false;
                } else if (!input.checkValidity()) {
                    valido = false;
                    if (input.validity.valueMissing) {
                        muestraError(input, 'Este campo es obligatorio.');
                    } else if (input.validity.tooShort) {
                        muestraError(input, 'Texto demasiado corto.');
                    }
                }
            });
            
            // Si no es valido mostramos el mensaje
            if (!valido) {
                feedbackDiv.textContent = 'Por favor, corrige los errores marcados...';
                feedbackDiv.className = 'feedback-error';
                feedbackDiv.setAttribute('aria-live', 'assertive');
                return;
            }
            
            // Si es valido
            // Actualizar asunto oculto para Formspree
            const emailVal = document.getElementById('email').value.trim();
            const asuntoVal = document.getElementById('asunto').value.trim();

            // Mostramos el estado de carga
            submitButton.disabled = true;
            buttonText.textContent = 'Enviando...';
            feedbackDiv.textContent = 'Tu mensaje se está mandando...';
            feedbackDiv.className = 'feedback-loading';
            feedbackDiv.setAttribute('aria-live', 'polite');

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
                });
                if (response.ok) {
                    feedbackDiv.textContent = '¡Mensaje enviado! Gracias por tu aportación refranera.';
                    feedbackDiv.className = 'feedback-success';
                    feedbackDiv.setAttribute('aria-live', 'polite');
                    submitButton.disabled = false;
                    buttonText.textContent = 'Enviar mensaje';
                    form.reset();
                } else {
                    const data = await response.json();
                    let msgError = 'Ocurrió un error al enviar. Inténtalo de nuevo más tarde.';
                    if (data && data.errors) {
                        msgError = data.errors.map(err => err.message).join(', ');
                    }
                    feedbackDiv.textContent = msgError;
                    feedbackDiv.className = 'feedback-error';
                    feedbackDiv.setAttribute('aria-live', 'assertive');
                    submitButton.disabled = false;
                    buttonText.textContent = 'Enviar mensaje';
                }
            } catch (err) {
                feedbackDiv.textContent = 'Error de red. Por favor, inténtalo de nuevo.';
                feedbackDiv.className = 'feedback-error';
                feedbackDiv.setAttribute('aria-live', 'assertive');
                submitButton.disabled = false;
                buttonText.textContent = 'Enviar mensaje';
                console.error('Error al enviar el formulario:', err);
            }
        });
    }
});