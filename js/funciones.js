$(document).on('click', '#btn-validar', () => {
    let rut = $('#rut').val();
    let rutValidador = new RutValidador(rut)

    if (rutValidador.esValido) {
        $('#resultado').html(mostrarMensaje('success', `Rut Válido, ${rutValidador.formato()}`));
        return;
    }

    $('#resultado').html(mostrarMensaje('danger','Rut inválido, vuelve a ingresarlo'));
})

function mostrarMensaje(tipo, mensaje) {
    return `
        <div class='alert alert-${tipo} mt-1'>
            <strong class='text-center'>${mensaje}</strong>
        </div>
    `;
}