function showResults() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var type = document.getElementById("type").value;
    var phone = document.getElementById("phone").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("results").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "user/search?name=" + name + "&email=" + email + "&type=" + type + "&phone=" + phone, true);
    xmlhttp.send();
}
