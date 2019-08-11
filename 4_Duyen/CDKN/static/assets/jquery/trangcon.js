function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function load(){
    document.getElementById("defaultOpen").click();
}

function giamsoluong(){
    var x = document.getElementById("sum").value;
    if(x > 1){
        document.getElementById("sum").value = x - 1;
    }
}

function tangsoluong(){
    var x = document.getElementById("sum").value;
    if(x < 100){
        document.getElementById("sum").value = parseInt(x) + 1;
    }
}
