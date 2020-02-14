function fetchtypes(method, url, done){
    var xhr = new XMLHttpRequest;
    xhr.open(method, url);
    xhr.onload = function(){
        done(null, xhr.response);
    };
    xhr.onerror = function(){
        done(xhr.response);
    };
    xhr.send();
    }

fetchtypes("GET", "./adminTabs/getlocationtypes.php?queryTypes=gettypes", function (err, dataresponse){
    if (err) { throw err;}
    options = document.getElementById("types");
    response = JSON.parse(dataresponse)
    for(var i in response.types){
        options.innerHTML += '<option selected value="' + response.types[i] + '">' + response.types[i] + '</option>';
    }
});

