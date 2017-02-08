var User = function() {
	this.logged = false;
}


Object.defineProperty(User.prototype, 'logged', {
	get: function() { return this.logged },
	set: function(_) {
		var control = false;
		$.ajax({
			type: 'GET',
			url: baseURL + 'cart/islogged',
			dataType: 'json',
			success: function (json) {
				control =  json.msg;
			}
		});
		this.logged = control;
	}
})

User.prototype.register = function(e, data, callback) {
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: baseURL + 'cart/login',
		data: data.serialize(),
		dataType: 'json',
		success: callback(json)
	});
}

User.prototype.logout = function(e, callback) {
	$.ajax({
		type: 'GET',
		url: baseURL + 'cart/logout',
		dataType: 'json',
		success: callback(json)
	})
}

module.exports = User;