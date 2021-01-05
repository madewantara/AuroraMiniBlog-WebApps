function getXMLHTTPRequest(){
    if (window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
    else{
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function callAjax(url,inner){
    var xmlhttp=getXMLHTTPRequest();
    xmlhttp.open('GET',url,true);
    xmlhttp.onreadystatechange=function(){
        document.getElementById(inner).innerHTML =  '<img src="loader.png" width="1%">';
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
            document.getElementById(inner).innerHTML = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}

function add_kategori(){
    var inner="add_response";
    var name = encodeURI(document.getElementById('name').value);
    //validate
    if (name !=""){
        //set url and inner
        var url="add_kategori.php?name="+name;
        //alert
        //open request
        callAjax(url,inner);
    }else {
        Alert ("Please fill in the blanks");
    }
        
}
function deleteKategori(x){
    var id=x;
    var inner="delete_response";
    var url="delete_kategori.php?id="+id;
    callAjax(url,inner);
}
function deleteTulisan(x){
    var id=x;
    var inner="delete_response";
    var url="delete_tulisan.php?id="+id;
    callAjax(url,inner);
}
function editKategori(x){
    var id=x;
    var inner="delete_response";
    var url="edit_kategori.php?id="+id;
    callAjax(url,inner);
}

function editkat(x){
    var id=x;
    var nama = encodeURI(document.getElementById('ngaco').value);
    var inner="delete_response";
    var url="editkategori.php?id="+id+"nama="+nama;
    callAjax(url,inner);
}
function delkat(x){
    var id=x;
    var inner="delete_response";
    var url="delkat.php?id="+id;
    callAjax(url,inner);
}
function deltul(x){
    var id=x;
    var inner="delete_response";
    var url="deltul.php?id="+id;
    callAjax(url,inner);
}
function resetpw(x){
    var id=x;
    var inner="reset";
    var url="reset_password.php?id="+id;
    callAjax(url,inner);
}
function reset(x){
    var id=x;
    var inner="reset";
    var url="resetpw.php?id="+id;
    callAjax(url,inner);
}
function notifTambah(){
    var inner="delete_response";
    var url="notif_tambah.php";
    callAjax(url,inner);
}

function showCustomer(customerid){
    var inner="detail_customer";
    var url="get_customer.php?id="+ customerid;
    if (customerid==""){
        document.getElementById(inner).innerHTML ='';
    }
    else {
        callAjax(url,inner);
    }
}

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
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
var fiveSecond = 5,
    display = document.getElementById('refresh');
    startTimer(fiveSecond, display);
};

function refresh1(x) {
    var fiveSecond = 5,
        display = document.getElementById(x);
        startTimer(fiveSecond, display);
    };


function redirect(x,y) {
    var fiveSecond = 5,
        display = document.getElementById(x);
        startTimer(fiveSecond, display,y);
    };

function startRedirect(duration, display,y) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        
        seconds = parseInt(timer % 60, 10);

        
        seconds = seconds < 10 ?  + seconds : seconds;

        display.textContent = "Memperbarui Data dalam "+seconds+" ...";

        if (--timer < 0) {
            window.location.href = y;
        }
    }, 1000);
}

function addKomen(x,y){
    var idpost=x;
    var idpenulis=y;
    var inner="add_komen";
    var isipost = encodeURI(document.getElementById('comment').value);
    var url="tambah_komen.php?post="+idpost+"&penulis="+idpenulis+"&isi="+isipost;
    
    callAjax(url,inner);
    
}

function deleteKomen(x,y){
    var idkom=x;
    var idpost=y;
    var inner="add_komen";
    var url="delete_komen.php?idkom="+idkom+"&idpost="+idpost;
    callAjax(url,inner);
}


function refreshId() {
    window.location.hash = '#comment';
    window.location.reload(true);
};


function startTimer2(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        
        seconds = parseInt(timer % 60, 10);

        
        seconds = seconds < 10 ?  + seconds : seconds;

        display.textContent = "Memperbarui Data dalam "+seconds+" ...";

        if (--timer < 0) {
            window.location.hash = '#comment';
            window.location.reload(true);
        }
    }, 1000);
}

function refresh3() {
    var fiveSecond = 3,
    display = document.getElementById('refresh');
    startTimer2(fiveSecond, display);
};

function redirect() {
    var fiveSecond = 5,
        display = document.getElementById('refresh');
        startRedirect(fiveSecond, display);
    };

function startRedirect(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        
        seconds = parseInt(timer % 60, 10);

        
        seconds = seconds < 10 ?  + seconds : seconds;

        display.textContent = "Memperbarui Data dalam "+seconds+" ...";

        if (--timer < 0) {
            window.location.href = "profile_penulis.php";
        }
    }, 1000);
}