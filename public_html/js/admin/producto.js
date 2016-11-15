function showResults() {
    var name = document.getElementById("filtroNombre").value;
    var description = document.getElementById("filtroDescripcion").value;
    var catdes = document.getElementById("filtroFamilia").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("results").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "producto/search?name=" + name + "&description=" + description + "&catdes=" + catdes, true);
    xmlhttp.send();
}
var levantarDatos = function(){
  var $container = $('#envases');
  var $dropdown = $container.find('select');
  var $boton = $container.find('.add');

  $boton.on('click', agregarEnvase);

  function agregarEnvase() {

    var id = $container.data('id');
    var envaseid = $dropdown.val();
    var envaseDesc = $dropdown.find(':selected').text();
    $.ajax({
      type: 'POST',
      url: 'http://localhost/admin/producto/add_envase/'+id+'/'+envaseid+'/'+envaseDesc,
      success: function(){
        alert('exito');
      },
      error: function(){
        alert('error');
      }
    })
  }
}();
