var data;
if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
} else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.open("GET", "DataPreza.php");
xmlhttp.send();
xmlhttp.onreadystatechange = function()
{
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
        console.log(xmlhttp.responseText);
    response = JSON.parse(xmlhttp.responseText);
    console.log(response);


    data = response.data;
    }
};
