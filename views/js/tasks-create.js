// /views/js/tasks-create.js
document.addEventListener('DOMContentLoaded', () => {
    const createModal = document.querySelector('#task-creation-modal');
    if (!createModal) return;

    const form = createModal.querySelector('form');
    const saveButton = createModal.querySelector('#save-task-btn');

    saveButton.addEventListener('click', async () => {
        // 1. Recolectar los datos del formulario
        const taskName = document.querySelector('#task-name').value.trim();
        const customerId = document.querySelector('#task-customer').value;
        const unitId = document.querySelector('#task-unit').value;
        const description = document.querySelector('#task-description').value.trim();
        const typeId = document.querySelector('#task-type').value;

        // Validación simple (puedes mejorarla)
        if (!taskName || !customerId || !typeId) {
            alert('Por favor, completa los campos obligatorios: Nombre, Cliente y Unidad.');
            return;
        }

        // 2. Preparar los datos para enviar
        const formData = new FormData();
        formData.append('label_task', taskName);
        formData.append('cas_customer_id_customer', customerId);
        formData.append('cas_unit_id', unitId);
        formData.append('desc_task', description);
        formData.append('id_type', typeId);

        try {
            // 3. Enviar los datos al controlador
            const response = await fetch('/?controller=tasksnew&action=create', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                // 4. Acciones en caso de éxito
                alert('Tarea creada exitosamente.');
                form.reset(); // Limpiar el formulario
                
                // Cerrar el modal (usando el método de Preline)
                const modalElement = document.querySelector('#task-creation-modal');
                if (window.HSOverlay && modalElement) {
                    HSOverlay.close(modalElement);
                }

                // Recargar la lista de tareas (si la función `load` de tasks-grid.js es global)
                if (window.loadTasks) {
                    window.loadTasks();
                } else {
                    // Si no, simplemente recargamos la página
                    window.location.reload();
                }
            } else {
                alert('Error al crear la tarea: ' + (result.message || 'Error desconocido.'));
            }
        } catch (error) {
            console.error('Error en la petición:', error);
            alert('Ocurrió un error de conexión al intentar crear la tarea.');
        }
    });
});