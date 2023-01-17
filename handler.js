var accept = false;
var decline = false;
document.getElementById("accept-button").addEventListener("click", function(){
    document.cookie = "acceptPressed=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
    location.reload();
});
document.getElementById("decline-button").addEventListener("click", function(){
    document.cookie = "declinePressed=true; expires=Fri, 31 Dec 9999 23:59:59 GMT";
    location.reload();
});

function hideText() {
    if (window.innerWidth < 900) {
        //hide the element
        document.getElementById("text-to-hide").style.display = "none";
    } else {
        //show the element
        document.getElementById("text-to-hide").style.display = "flex";
    }
}
window.onresize = hideText;
hideText();