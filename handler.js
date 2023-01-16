var accept = false;
var decline = false;
document.getElementById("accept-button").addEventListener("click", function(){
    document.cookie = "AcceptPressed=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
    location.reload();
});
document.getElementById("decline-button").addEventListener("click", function(){
    document.cookie = "DeclinePressed=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
    location.reload();
});