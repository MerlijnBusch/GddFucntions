@forelse($story as $oneStory)



    <div class="card float-left" style="width: 18rem; height: 18rem; margin:5px 5px 10px 5px;">
        <div class="card-body">
            <form method="post" action="{{route('moderator.persona.update.display', ['story' => $oneStory->id])}}" id="form_update_display" name="form_update_display">
            @csrf
            <h5 class="card-title">{{$oneStory->title}}</h5>
            <p class="card-text">

                @if($oneStory->accepted == 'true')
                    <span class="badge badge-pill bg-success align-text-bottom">
                        accepted
                        <select name="accepted_select">
                            <option value="false" name="false">Pending</option>
                            <option value="true" name="true">Accepted</option>
                            <option value="declined" name="declined">Declined</option>
                        </select>
                        <input type="submit">
                    </span>
                @elseif($oneStory->accepted == 'declined')
                    <span class="badge badge-pill bg-danger align-text-bottom">
                        declined
                        <select name="declined_select">
                            <option value="false" name="false">Pending</option>
                            <option value="true" name="true">Accepted</option>
                            <option value="declined" name="declined">Declined</option>
                        </select>
                        <input type="submit">
                    </span>
                @elseif($oneStory->accepted == 'false')
                    <span class="badge badge-pill bg-primary align-text-bottom">
                        still pending
                        <select name="pending_select">
                            <option value="false" name="false">Pending</option>
                            <option value="true" name="true">Accepted</option>
                            <option value="declined" name="declined">Declined</option>
                        </select>
                        <input type="submit">
                    </span>
                @endif
                    <br>
            </p>
            </form>

            <a href="{{route('moderator.persona.edit',['story' => $oneStory->id])}}" class="card-link">Edit</a>
            <a href="" class="card-link"
               onclick="event.preventDefault();
                       document.getElementById('make_share_link_for_story{{$oneStory->id}}').submit();">
                share
            </a>
            <a href="" class="card-link" id="delete_to_form{{$oneStory->id}}">
                Delete
            </a>
            <form id="make_share_link_for_story{{$oneStory->id}}" action="{{ route('moderator.persona.share',['story' => $oneStory->id]) }}" method="POST">
                @csrf
                @method('PUT')
            </form>
            <form id="delete_own_user_story_form{{$oneStory->id}}" action="{{ route('moderator.persona.destroy',['story' => $oneStory->id]) }}" method="POST">
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

        </div>
    </div>
@empty

    <p>no stories found</p>

@endforelse