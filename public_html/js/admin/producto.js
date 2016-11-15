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
  var $envases = $('#listaEnvases');
  var $form = $('#formEnvases');
  var $hidden = $('#hiddens');
  var $borrar = $envases.find('.glyphicon');


  $boton.on('click', agregarEnvase);
  $form.on('submit', levantarEnvases);
  $borrar.on('click', borrarEnvase);

  function borrarEnvase() {
      $(this).parents('tr').remove();
  }

  function agregarEnvase() {
    var envaseid = $dropdown.val();
        envaseDesc = $dropdown.find(':selected').text();
    if ($envases.find('[data-id="'+envaseid+'"]').length === 0) {
        $envases.append('<tr data-id="'+envaseid+'">><td>'+envaseDesc+'</td><td><a href="#" class="glyphicon glyphicon-trash"></a></td></tr>');
    }

  }

  function levantarEnvases() {
    var $element = $envases.find('tr');
        comboEnvases = [];
    $element.each(function(i) {
      $hidden.append('<input type="hidden" name="envases[]" value="'+$(this).attr('data-id')+'">');
    })
  }



}();
