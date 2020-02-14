var response;

function state(){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.open("POST", "./adminTabs/dbstate.php",true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
            response = JSON.parse(xmlhttp.responseText);
            for(i=0; i<6; i++){
                var chartx = "chart" + (i+1);
                var labelx = "response.label" + (i+1);
                var datax = "response.data" + (i+1);
                var table = ["activity", "username", "month", "weekday", "hour","year"];
            Chart.defaults.global.defaultFontColor = '#c7c7c7';
            new Chart(document.getElementById(chartx),
            {type:"pie",
            data:
            {labels: eval(labelx),
            datasets:[
            {label: "test",
                backgroundColor: ["#e6194b", "#3cb44b", "#ffe119", "#4363d8", "#f58231", "#911eb4", "#46f0f0", "#f032e6", "#bcf60c", "#fabebe", "#008080", "#e6beff", "#9a6324", "#fffac8", "#800000", "#aaffc3", "#808000", "#ffd8b1", "#000075", "#808080", "#ffffff", "#000000", "#230f24","#14240f","#24160f","#0f1f24"],
                data: eval(datax)
                ,fill:true,
                borderColor:"rgb(255, 51, 0)",
                borderWidth: 0.3,
                lineTension:0.01}]},options:{
                    title: {display: true, text: "Distribution of records per "+ table[i]}
                }});
            }

        }
}
}