function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("push_content").style.marginLeft = "250px";
    document.getElementById("floatLeft").style.cssFloat = "left";
    document.getElementById("floatLeft").style.marginLeft = "auto 0";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("push_content").style.marginLeft = "0";
    document.getElementById("floatLeft").style.cssFloat = null;
    // document.getElementById("floatLeft").style.marginLeft = "auto 0";
}
