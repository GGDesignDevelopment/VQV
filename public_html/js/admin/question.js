function showResults(filtro) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("results").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "question/search?question=" + filtro, true);
    xmlhttp.send();
}