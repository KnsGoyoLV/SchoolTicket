var accept = false;
var decline = false;
document.getElementById("accept-button").addEventListener("click", function(){
    document.cookie = "buttonPressed=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
    location.reload();
});
document.getElementById("decline-button").addEventListener("click", function(){
    location.reload();
    console.log(this.innerHTML);
    location.href = location.href + "?myButton=" + this.innerHTML;
});