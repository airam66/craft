/*=============================================
SUBIENDO LA FOTO DE LA SECCÍON SOBRE NOSOTROS
=============================================*/

$(".foto").change(function(){
	console.log('llego');
	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$(".foto").val("");

		swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen debe estar en formato JPG o PNG!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen); //convertimos la vlble en un archivo

  		$(datosImagen).on("load", function(event){
		
  			var rutaImagen = event.target.result;

  			$(".previsualizarFoto").attr("src", rutaImagen);

		})
  	}

})

/*=============================================
SUBIENDO LA FOTO DE LA SECCÍON CONTACTO
=============================================*/

$(".fotoContacto").change(function(){
	var imagen = this.files[0]; 

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$(".fotoContacto").val("");

		swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen debe estar en formato JPG o PNG!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen); //convertimos la vlble en un archivo

  		$(datosImagen).on("load", function(event){
		
  			var rutaImagen = event.target.result;

  			$(".previsualizarFotoC").attr("src", rutaImagen);

		})
  	}

});