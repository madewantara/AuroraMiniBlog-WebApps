function refresh(){
    window.location.href = window.location.href;
}

function other(){
    if (document.forms["formRegistrasi"]["city"].value == "other"){
        document.getElementById("other").innerHTML = 
            '<input class="form-control form-control-user" type="text" id="city" placeholder="Kota" name="city" value="">'
    }
}

function password(id){
    var xmlhttp = getXMLHTTPRequest();
    var lama = encodeURI(document.getElementById('lama').value);
    var baru = encodeURI(document.getElementById('baru').value);
    var baru2 = encodeURI(document.getElementById('baru2').value);
    var id = encodeURI(id);
    var url = "password.php";
    var inner = "password-response";
    var params = "id=" + id + "&lama=" + lama + "&baru=" + baru + "&baru2=" + baru2;
    xmlhttp.open('POST', url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function(){
        if((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
            document.getElementById(inner).innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(params);
}