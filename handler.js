
function hideText() {
    if (window.innerWidth < 900) {
        document.getElementById("text-to-hide").style.display = "none";
    } else {
        document.getElementById("text-to-hide").style.display = "flex";
    }
}
window.onresize = hideText;
hideText();