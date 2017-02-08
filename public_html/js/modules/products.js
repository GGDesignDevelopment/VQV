var Products = function() {
	this.productos = {
		granel: [],
		naturales: [],
		destacados: [],
	}
}

Object.defineProperty(Products.prototype, 'granel', {
	get: function() { return this.productos.granel },
	set: function(_) {
		$.ajax({
			type: 'GET',
			url: baseURL + 'tienda/getProducts?granel=1',
			dataType: 'json',
			success: function (json) {
				this.productos.granel = json
			}
		});
	}
})

Object.defineProperty(Products.prototype, 'naturales', {
	get: function() { return this.productos.naturales },
	set: function(_) {
		$.ajax({
			type: 'GET',
			url: baseURL + 'tienda/getProducts?granel=0',
			dataType: 'json',
			success: function (json) {
				this.productos.naturales = json
			}
		});
	}
})

Object.defineProperty(Products.prototype, 'destacados', {
	get: function() { return this.productos.destacados },
	set: function(_) {
		$.ajax({
			type: 'GET',
			url: baseURL + 'tienda/getProducts?inicio=1',
			dataType: 'json',
			success: function (json) {
				this.productos.destacados = json
			}
		});
	}
})

module.exports = Products;