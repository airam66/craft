const carro = new Carrito();
const gestionCompraBtn = document.getElementById('procesar-pedido');

cargarEventos();

function cargarEventos(){

    gestionCompraBtn.addEventListener('click', (e)=>{carro.procesarPedido(e)});

    let productosLS = carro.obtenerProductosLocalStorage();
    document.getElementById('cantidad').innerHTML = productosLS.length;

}