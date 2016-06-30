# VQV
estructura {
	idProd: num,
	img: ruta,
	nombre: text,
	desc: text,
	unidad: num,
	presentacion: num,
	precio: num,

}
compra {
	idProd: num,
	cantidad: num,
	usuario: ,
}
ticket {
	usuario: ,
	direccion: ,
	prod: [nombre, cantidad, preciofinal],
	total: num,
}
//////////////////////////////
Global to-do {
	- concatenar javascripts
	- Concatenar css
}
Index to-do {
	- Agregar script de carrousel,
	- Revisar css, overflow, margins, y row wrap,
	- Revisar diseño ajax form suscripcion, agregar mensaje al final,
	- Revisar responsive, margins, overflow, etc,
	- Preguntas Frecuentes,
}
Tienda to-do {
	- Hacer responsive,
	- Agregar scripts ajax para carrito, filtro de categorias
	- Sacar placeholder, agregar presentacion del articulo afuera
	- Diseñar carrito, y css
}
