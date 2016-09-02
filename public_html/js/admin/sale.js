function showResults() {
    var email = document.getElementById("email").value;
    var status = document.getElementById("status").value;
    var fecha = document.getElementById("fecha").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("results").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "sale/search?email=" + email + "&status=" + status + "&fecha=" + fecha, true);
    xmlhttp.send();
}

$(function () {
    $('#dtp').datetimepicker({format: "YYYY-MM-DD HH:mm",
        defaultDate: new Date()
        }).on('dp.change', function(e) {
        // `e` here contains the extra attributes
        showResults();
    });
});