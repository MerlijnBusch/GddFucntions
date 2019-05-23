@extends('layouts.master')

@section('css')

    {{--//--}}

@endsection

@section('jumbotron')

    {{--//--}}

@endsection

@section('sidebar')



@endsection

@section('content')

@forelse($story as $oneStory)

    <div class="card float-left" style="width: 18rem; height: 18rem; margin:5px 5px 10px 5px;">
        <div class="card-body">
            <h5 class="card-title">{{$oneStory->title}}</h5>
            <p class="card-text">

                    @if($oneStory->accepted == 'true')
                    <span class="badge badge-pill bg-success align-text-bottom">
                        accepted
                    </span>
                    @elseif($oneStory->accepted == 'declined')
                    <span class="badge badge-pill bg-danger align-text-bottom">
                        declined
                    </span>
                    @elseif($oneStory->accepted == 'false')
                    <span class="badge badge-pill bg-primary align-text-bottom">
                        still pending
                    </span>
                    @endif

            </p>
            @include('profile.partials.links')
        </div>
    </div>
@empty

    <p>no stories found</p>

@endforelse
{{ $story->links() }}


    <div>

        @include('profile.partials.chat')

    </div>


    @include('profile.partials.chatRequest')

@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#search_user_form_profile').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                method: 'POST',
                url: '{{route('user.profile.search')}}',
                data: {
                    'data' :  $value
                },
                success: function(response){
                    var html = '';
                    for(let i = 0; i < response.message.length; i++)
                    {
                        let tempHtml = "<span class=\"border-bottom border-dark\"> <a onclick=\"sendChatRequest(" + response.message[i].id + ")\" style=\"width:25vw;font-size: 1em;\">" + response.message[i].name + "</a></span><br>";
                        html = html + tempHtml;
                    }
                    $( "div.display_user_names" )
                        .html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });

        function sendChatRequest(id){
            setTimeout(function() {
                $.ajax({
                    method: 'POST',
                    url: '{{route('chat.startChat.user')}}',
                    data: {
                        'data' :  id
                    },
                    success: function(response){
                        if(response.status === 'success'){
                            $( "div.success_message_chat_request_send" )
                                .html('<div class=\"alert alert-success\" role=\"alert\">' +
                                    'Request has successfully send </div>');
                        } else {
                            $( "div.success_message_chat_request_send" )
                                .html('<div class=\"alert alert-danger\" role=\"alert\">' +
                                    response.message + ' </div>');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR, textStatus, errorThrown);
                    }
                });
            }, 500);
        }
    </script>


@endsection