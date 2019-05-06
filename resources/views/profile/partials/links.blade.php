<a href="{{route('story.edit',['story' => $oneStory->id])}}" class="card-link">Edit</a>
<a href="" class="card-link"
   onclick="event.preventDefault();
               document.getElementById('make_share_link_for_story{{$oneStory->id}}').submit();">
    share
</a>
<a href="" class="card-link" id="delete_to_form{{$oneStory->id}}">
    Delete
</a>
<form id="make_share_link_for_story{{$oneStory->id}}" action="{{ route('story.share',['story' => $oneStory->id]) }}" method="POST">
    @csrf
    @method('PUT')
</form>
<form id="delete_own_user_story_form{{$oneStory->id}}" action="{{ route('story.destroy',['story' => $oneStory->id]) }}" method="POST">
    @csrf
    @method('DELETE')
</form>
<script>
    document.getElementById("delete_to_form{{$oneStory->id}}")
        .addEventListener("click", function( e ){
            if( ! confirm("Do you want to delete this story?") ){
                e.preventDefault();
            } else {
                e.preventDefault();
                document.getElementById('delete_own_user_story_form{{$oneStory->id}}').submit();
            }
    });
</script>