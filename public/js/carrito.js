class Carrito {

    //Añadir producto al carrito
    comprarProducto(e){
        e.preventDefault();
        //Delegado para agregar al carrito
        if(e.target.classList.contains('agregar-carrito')){
            const producto = e.target.parentElement.parentElement;
            //Enviamos el producto seleccionado para tomar sus datos
            this.leerDatosProducto(producto);        
        }
 
    }

    //Leer datos del producto
    leerDatosProducto(producto){
        const infoProducto = {
            imagen : producto.querySelector('img').src,
            titulo: producto.querySelector('h5 b').textContent,
            precio: producto.querySelector('.precio span').textContent,
            precioAux: producto.querySelector('.precio span').textContent,
            precioSale: producto.querySelector('.precioSale span').textContent,
            maximo: producto.querySelector('.cant span').textContent,
            id: producto.querySelector('a').getAttribute('data-id'),
            cantidad: 1
        } 

        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (productoLS){
            if(productoLS.id === infoProducto.id){
                productosLS = productoLS.id;
            }
        });

        if(productosLS === infoProducto.id){
            Swal.fire({
                type: 'info',
                title: 'El producto ya está agregado',
                showConfirmButton: false,
                timer: 2000
            })
        }
        else {
            this.insertarCarrito(infoProducto);
            document.getElementById('icono'+infoProducto.id).className='glyphicon glyphicon-check';
            let count=document.getElementById('cantidad');
            count.innerHTML=productosLS.length+1;
        }

        
    }

    //muestra producto seleccionado en carrito
    insertarCarrito(producto){
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <img src="${producto.imagen}" width=100>
            </td>
            <td>${producto.titulo}</td>
            <td>${producto.precio}</td>
            <td>
                <a href="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a>
            </td>
        `;
        listaProductos.appendChild(row);
        this.guardarProductosLocalStorage(producto);

    }

    //Eliminar el producto del carrito en el DOM
    eliminarProducto(e){
        e.preventDefault();
        let producto, productoID;
        if(e.target.classList.contains('borrar-producto')){
            e.target.parentElement.parentElement.remove();
            producto = e.target.parentElement.parentElement;
            productoID = producto.querySelector('a').getAttribute('data-id');
        }
        this.eliminarProductoLocalStorage(productoID);
        this.calcularTotal();
    }

    //Elimina todos los productos
    vaciarCarrito(e){
        e.preventDefault();
        while(listaProductos.firstChild){
            listaProductos.removeChild(listaProductos.firstChild);
        }
        this.vaciarLocalStorage();

        return false;  
    }

    //Almacenar en el LS
    guardarProductosLocalStorage(producto){
        let productos;
        //Toma valor de un arreglo con datos del LS
        productos = this.obtenerProductosLocalStorage();
        //Agregar el producto al carrito
        productos.push(producto);
        //Agregamos al LS
        localStorage.setItem('productos', JSON.stringify(productos));

    }

    //Comprobar que hay elementos en el LS
    obtenerProductosLocalStorage(){
        let productoLS;

        //Comprobar si hay algo en LS
        if(localStorage.getItem('productos') === null){
            productoLS = [];
        }
        else {
            productoLS = JSON.parse(localStorage.getItem('productos'));
        }
        return productoLS;
    }

    //Mostrar los productos guardados en el LS
    leerLocalStorage(){
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        productosLS.forEach(function (producto){
            //Construir plantilla
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <img src="${producto.imagen}" width=100>
                </td>
                <td>${producto.titulo}</td>
                <td>${producto.precio}</td>
                <td>
                    <a href="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a>
                </td>
            `;
            listaProductos.appendChild(row);
        });  
    }

    //Mostrar los productos guardados en el LS en compra.html
    leerLocalStorageCompra(){
        let productosLS;
        productosLS = this.obtenerProductosLocalStorage();
        if (productosLS.length === 0) {
            Swal.fire({
                type: 'error',
                title: 'No hay productos, selecciona alguno',
                showConfirmButton: false,
                timer: 3000
            }).then(function () {
                window.location = baseUrl("catalogue");
            })
        }else{
            productosLS.forEach(function (producto){
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <input type="hidden"  name="idproductos[]" readonly value=${producto.id}>
                        <img src="${producto.imagen}" width="40" height="40" >
                    </td>
                    <td>${producto.titulo}</td>
                    <td id='precios'> $${producto.precio}</td>
                    <td>
                        <input type="number" class="form-control cantidad" name="cantidad[]" min="1" value=${producto.cantidad}>
                    </td>
                    <td id='subtotales'>$${producto.precio * producto.cantidad}</td>
                    <td>
                        <a href="#" class="borrar-producto fas fa-times-circle" style="font-size:30px" data-id="${producto.id}"></a>
                    </td>
                `;
                listaCompra.appendChild(row);
            }); 
        }
    }

    //Eliminar producto por ID del LS
    eliminarProductoLocalStorage(productoID){
        let productosLS;
        let count=document.getElementById('cantidad');
        //Obtenemos el arreglo de productos
        productosLS = this.obtenerProductosLocalStorage();
        //Comparar el id del producto borrado con LS
        productosLS.forEach(function(productoLS, index){
            if(productoLS.id === productoID){
                productosLS.splice(index, 1);
                count.innerHTML=productosLS.length;
            }
        }); 
        //Añadimos el arreglo actual al LS
        localStorage.setItem('productos', JSON.stringify(productosLS));

        if (productosLS.length==0){
              location.href = baseUrl("catalogue");  
        }
    }

    //Eliminar todos los datos del LS
    vaciarLocalStorage(){
        localStorage.clear();
    }

    //Procesar pedido
    procesarPedido(e){
        e.preventDefault();

        if(this.obtenerProductosLocalStorage().length === 0){
            Swal.fire({
                type: 'error',
                title: 'El carrito está vacío, agrega algún producto',
                showConfirmButton: false,
                timer: 3000
            })
        }
        else {
            location.href = baseUrl("carrito");
        }  
    }

    //Calcular montos
    calcularTotal(){
        let productosLS;
        let total = 0;
        let element = 0;
        productosLS = this.obtenerProductosLocalStorage();
        for(let i = 0; i < productosLS.length; i++){
            if(productosLS[i].cantidad<Number(productosLS[i].maximo)){
                element = Number(productosLS[i].precio * productosLS[i].cantidad); 
            }else{
                element = Number(productosLS[i].precioSale * productosLS[i].cantidad);
            }
            total = total + element;
        }
        document.getElementById('total').value = total.toFixed(2);
    }

    obtenerEvento(e) {
        e.preventDefault();
        let id, cantidad, producto, productosLS;
        if (e.target.classList.contains('cantidad')) {
            producto = e.target.parentElement.parentElement;
            id = producto.querySelector('a').getAttribute('data-id');
            cantidad = producto.querySelector('.cantidad').value;
            let actualizarMontos = document.querySelectorAll('#subtotales');
            let actualizarPrecios = document.querySelectorAll('#precios');
            productosLS = this.obtenerProductosLocalStorage();
            productosLS.forEach(function (productoLS, index) {
                if (productoLS.id === id) {
                    productoLS.cantidad = cantidad;   
                    if(cantidad<Number(productosLS[index].maximo)){           
                        actualizarMontos[index].innerHTML = "$ " + Number(cantidad * productosLS[index].precio);
                        actualizarPrecios[index].innerHTML = '$' + productosLS[index].precio;
                    }else{
                        actualizarMontos[index].innerHTML = "$ " + Number(cantidad * productosLS[index].precioSale)
                        actualizarPrecios[index].innerHTML = '$' + productosLS[index].precioSale;
                    }
                }    
            });
            localStorage.setItem('productos', JSON.stringify(productosLS));
            
        }
        else {
            console.log("click afuera");
        }
    }
}