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

function create_persona_story_form_function() {
    var x = document.getElementById('create_persona_story_form');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}

function add_points_to_story_function() {
    var x = document.getElementById('add_points_to_story');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}

function add_top_needs_to_story_function() {
    var x = document.getElementById('add_top_needs_to_story');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
