function getXMLHTTPRequest(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
    else{
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}
function add_task(id){
    var xmlhttp = getXMLHTTPRequest();
    var tugas = encodeURI(document.getElementById('tugas').value);
    var deadline = encodeURI(document.getElementById('deadline').value);
    var idadmin = encodeURI(id);
    if(tugas != "" && deadline != ""){
        var url = "add_task.php";
        var inner = "add_response";
        var params = "tugas=" + tugas + "&deadline=" + deadline + "&idadmin=" + idadmin;
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
    else{
        alert("Please fill all the fields");
    }
}
function simpan(session){
    var xmlhttp = getXMLHTTPRequest();
    var nama = encodeURI(document.getElementById('nama').value);
    var email = encodeURI(document.getElementById('email').value);
    var id_session = encodeURI(session);
    if(nama != "" && email != "" && password != ""){
        var url = "simpan.php";
        var inner = "save_response";
        var params = "nama=" + nama + "&email=" + email + "&password=" + password + "&session=" + id_session;
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
    else{
        alert("Please fill all the fields");
    }
}

function notif(id){
    var xmlhttp = getXMLHTTPRequest();
    var id = encodeURI(id);
    if(id != ""){
        var url = "notif.php";
        var inner = "notif";
        var params = "id=" + id;
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

function startTimer(duration, display) {
    var timer = duration, seconds;
    setInterval(function () {

        seconds = parseInt(timer % 60, 10);


        seconds = seconds < 10 ?  + seconds : seconds;

        display.textContent = "Memperbarui Data dalam "+seconds+" ...";

        if (--timer < 0) {
            window.location.href = window.location.href;
        }
    }, 1000);
}

function refresh() {
    var fiveSecond = 3;
    var display = document.getElementById('refresh');
    startTimer(fiveSecond, display);
};

function refresh1() {
    var fiveSecond = 3;
    var display = document.getElementById('refresh1');
    startTimer(fiveSecond, display);
};