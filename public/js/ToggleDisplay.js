function toggle_toMap(){
    document.getElementById("dataviz_charts").style.display = "none";
    document.getElementById("dataviz_map").style.display = "block";
    document.getElementById("form-container-share-story").style.display = "none";
}
function toggle_toDataviz() {
    document.getElementById("dataviz_charts").style.display = "block";
    document.getElementById("dataviz_map").style.display = "none";
    document.getElementById("form-container-share-story").style.display = "none";
}

function toggleShareStory() {
    document.getElementById("form-container-share-story").style.display = "block";
    document.getElementById("dataviz_charts").style.display = "none";
    document.getElementById("dataviz_map").style.display = "none";
}
