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