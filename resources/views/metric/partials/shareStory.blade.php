{{--https://quilljs.com/docs/quickstart/ to check how to make form submit--}}
<div class="share-story" id="share-story">

    <div id="form-container-share-story" class="container-fluid" style="display: none">

        <h4 class="display-4">Story writing</h4>
        <p class="lead">
            Now you have the option to enrich you story with some related metrics from the left panel.
            This will generate a data visualization based on your story. Once your story is approved,
            it will be published in the "Stories" section in this website.
        </p>
        <form id="form_make_story" action="{{route('story.store')}}" method="post" class="form_make_story">
            @csrf
            <div class="form-group">
                <label for="title_make_story">Title:</label>
                <div class="form-group">
                    <input name="title_make_story" class="box--shadow" type="text" id="title_make_story" style="width: 100%" placeholder="An epic title...">
                </div>
                <div class="form-group box--shadow">
                    <input name="about" type="hidden" id="about" class="hidden_input_body_text_story">
                    <div id="editor-container" style="background: white;height: 300px;" class="hidden_input_body_text_story">
                    </div>
                </div>
            </div>
            <input type="hidden" id="story_add_metric_to_story_hidden" name="story_add_metric_to_story_hidden">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <button class="btn btn-success box--shadow" type="submit" onclick="submit_form()">Save Profile</button>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check float-right">
                        <input class="form-check-input checkbox-story-submit" type="checkbox" value="" id="add_metric_to_story">
                        <label class="form-check-label" for="add_metric_to_story">
                            Add metrics to story.
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

