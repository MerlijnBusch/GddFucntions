var displayMap = false;
var display3dData = false;
var displayStory = false;
function toggle_toMap(){
    document.getElementById("dataviz_charts").style.display = "none";
    document.getElementById("dataviz_map").style.display = "block";
    document.getElementById("form-container-share-story").style.display = "none";
    displayMap = true;
    display3dData = false;
    displayStory = false;
}
function toggle_toDataviz() {
    document.getElementById("dataviz_charts").style.display = "block";
    document.getElementById("dataviz_map").style.display = "none";
    document.getElementById("form-container-share-story").style.display = "none";
    displayMap = false;
    display3dData = true;
    displayStory = false;
    start3DdataViz();
}

function toggleShareStory() {
    document.getElementById("form-container-share-story").style.display = "block";
    document.getElementById("dataviz_charts").style.display = "none";
    document.getElementById("dataviz_map").style.display = "none";
    displayMap = false;
    display3dData = false;
    displayStory = true;
}
