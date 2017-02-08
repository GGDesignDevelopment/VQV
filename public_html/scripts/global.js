var baseURL = 'http://vqv/';

var session = (function() {
	
	function create(key, value) {
			sessionStorage.setItem(key, JSON.stringify(value));
	}

	function retrieve(key) {
		var result = JSON.parse(sessionStorage.getItem(key));
		return result; 
	}

	function remove(key) {
		sessionStorage.removeItem(key);
	}

	return {
		create: create,
		retr: retrieve,
		delete: remove,
	}

})();

