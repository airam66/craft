const compra = new Carrito();
const listaCompra = document.querySelector("#lista-compra tbody");
const carrito = document.getElementById('carrito');
const procesarCompraBtn = document.getElementById('procesar-compra');
const cliente = document.getElementById('cliente');
const correo = document.getElementById('correo');
const fecha = document.getElementById('datepicker');


cargarEventos();

function cargarEventos() {
    document.addEventListener('DOMContentLoaded', compra.leerLocalStorageCompra());

    //Eliminar productos del carrito
    carrito.addEventListener('click', (e) => { compra.eliminarProducto(e) });

    compra.calcularTotal();

    //cuando se selecciona procesar Compra
    procesarCompraBtn.addEventListener('click', procesarCompra);

    carrito.addEventListener('change', (e) => { compra.obtenerEvento(e) });
    carrito.addEventListener('keyup', (e) => { compra.obtenerEvento(e) });


}

function procesarCompra() {
    // e.preventDefault();
    if (compra.obtenerProductosLocalStorage().length === 0) {
        Swal.fire({
            type: 'error',
            title: 'No hay productos, selecciona alguno',
            showConfirmButton: false,
            timer: 3000
        }).then(function () {
            window.location = baseUrl("catalogue");
        })
    }
    else if (fecha.value === '') {
        Swal.fire({
            type: 'error',
            title: 'Ingrese la fecha de pedido',
            showConfirmButton: false,
            timer: 3000
        })
    }
    else {
        compra.vaciarLocalStorage();

        window.location = baseUrl("catalogue");
    }
}

