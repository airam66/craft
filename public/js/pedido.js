const shopping = new Carrito();
const pedido = document.getElementById('carritoId');
const productos = document.getElementById('lista-productos');
const listaProductos = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');
const procesarPedidoBtn = document.getElementById('procesar-pedido');

cargarEventos();

function cargarEventos(){

    let productosLS = shopping.obtenerProductosLocalStorage();
    document.getElementById('cantidad').innerHTML = productosLS.length;
    productosLS.forEach(function (productoLS){
        let span = document.querySelector('#icono'+productoLS.id);
        document.getElementById('icono'+productoLS.id).className = 'glyphicon glyphicon-check';
    });
    
    //Se ejecuta cuando se presionar agregar carrito
    productos.addEventListener('click', (e)=>{shopping.comprarProducto(e)});

    //Cuando se elimina productos del carrito
    pedido.addEventListener('click', (e)=>{shopping.eliminarProducto(e)});

    //Al vaciar carrito
    vaciarCarritoBtn.addEventListener('click', (e)=>{shopping.vaciarCarrito(e)});

    //Al cargar documento se muestra lo almacenado en LS
    document.addEventListener('DOMContentLoaded', shopping.leerLocalStorage());

    //Enviar pedido a otra pagina
    procesarPedidoBtn.addEventListener('click', (e)=>{shopping.procesarPedido(e)});

}