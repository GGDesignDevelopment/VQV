var Cart = function() {
	this.products = []
}

Object.defineProperty(Cart.prototype, 'products', {
	get: function() { return this.products },
	set: function(_) {
		$.ajax({
			type: 'GET',
			url: baseURL + 'cart/get',
			dataType: 'json',
			success: function (json) {
				this.products = json.items;
			}
		})
	}
})

Cart.prototype.addItem = function(e, data, callback) {
	$.ajax({
		type: 'POST',
		url: 'cart/addItem',
		data: data.serialize(),
		dataType: 'json',
		success: callback()
	})
	e.preventDefault();
}

Cart.prototype.removeItem = function(e, id, callback) {
	$.ajax({
		type: 'POST',
		url: baseURL + 'cart/removeItem/' + id,
		success: callback()
	});
	e.preventDefault();
}

Cart.prototype.checkout = function(e, data, callback) {
	$.ajax({
		type: 'POST',
		url: baseURL + 'cart/confirm',
		data: data.serialize(),
		dataType: 'json',
		success: callback(json)
	})
	e.preventDefault();
}

module.exports = Cart;