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

function reload(){
    location.reload();
}

$(".btnclose").click(function() {
    setTimeout(function() {
        window.location.reload();
     }, 5000);
  });