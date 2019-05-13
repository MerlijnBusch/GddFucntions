<p>Make persona <span onclick="create_persona_story_form_function()" style="text-decoration: underline;">Click here to add</span></p>
<div id="create_persona_story_form" style="display: none">
    <div class="row">
        <div class="col-md-4 col-lg-3 col-xl-2">
            <img src="https://via.placeholder.com/200" alt="profile_picture" class="img-thumbnail">
            <br>
            <input style="margin: 5px 5px 5px 5px" name="story_image_form" type="file" id="story_image_form">
        </div>

        <div class="col-md-8 col-lg-9 col-xl-10">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">Persona name</span>
                </div>
                <input type="text" class="form-control" id="" aria-describedby="basic-addon3">
            </div>
            {{--Age--}}
            <div class="row">
                <div class="col-sm-2 col-md-3 col-xl-1">
                    <p>Age Y: <span id="output_form_slider_story_age"></span></p>
                </div>
                <div class="col-sm-10 col-md-9 col-xl-11">
                    <input type="range" min="0" max="100" value="50" class="custom-range" id="form_slider_story_age">
                </div>
            </div>
            {{--Wieght kg--}}
            <div class="row">
                <div class="col-sm-2 col-md-3 col-xl-1">
                    <p>Kg: <span id="output_form_slider_story_weight"></span></p>
                </div>
                <div class="col-sm-10 col-md-9 col-xl-11">
                    <input type="range" min="0" max="300" value="90" class="custom-range" id="form_slider_story_weight">
                </div>
            </div>
            {{--Height--}}
            <div class="row">
                <div class="col-sm-2 col-md-3 col-xl-1">
                    <p>Cm: <span id="output_form_slider_story_height"></span></p>
                </div>
                <div class="col-sm-10 col-md-9 col-xl-11">
                    <input type="range" min="0" max="250" value="140" class="custom-range" id="form_slider_story_height">
                </div>
            </div>
        </div>
    </div>
</div>