{{--https://quilljs.com/docs/quickstart/ to check how to make form submit--}}

    <div id="form-container-share-story" class="container-fluid" style="display: none">

        <h4 class="display-4">Story writing</h4>
        <p class="lead">
            Now you have the option to enrich you story with some related metrics from the left panel.
            This will generate a data visualization based on your story. Once your story is approved,
            it will be published in the "Stories" section in this website.
        </p>
        <form id="form_make_story" action="{{route('story.store')}}" method="post" class="form_make_story" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title_make_story">Title:</label>
                <div class="form-group">
                    <input class="form-control" name="title_make_story" type="text" id="title_make_story" style="width: 100%" placeholder="An epic title...">
                </div>

                <hr>
                @include('metric.partials.shareStoryPartials.persona')
                <hr>
                @include('metric.partials.shareStoryPartials.topNeeds')
                <hr>
                @include('metric.partials.shareStoryPartials.storyPoints')
                <hr>

                <div class="form-group">
                    <label for="">Additional text </label>
                    <textarea class="form-control" id="" rows="7"></textarea>
                </div>

                <input type="hidden" id="story_add_metric_to_story_hidden" name="story_add_metric_to_story_hidden">
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-check float-left">
                        <input class="form-check-input checkbox-story-submit" type="checkbox" value="" id="add_metric_to_story">
                        <label class="form-check-label" for="add_metric_to_story">
                            Add metrics to story.
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group float-right">
                        <button class="btn btn-success box--shadow" type="button" onclick="submit_form()">Submit Story</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

