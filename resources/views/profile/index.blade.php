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

    <div>

        @include('profile.partials.chat')

    </div>


    @include('profile.partials.chatRequest')


    <div>
        @forelse($conversations as $conversation)
            persoon waarmee je chat<br>
            {{$conversation->conversation_id}}
            ur chatting with john doe
            <br>
            {{--{{dd($allMessages)}}--}}
            @forelse($allMessages as $message)
                @foreach($message as $text)
                    @if($text->conversation_id_foreign === $conversation->conversation_id)
                        {{$text->message}}
                        <br>
                    @endif
                @endforeach
            @empty
            @endforelse
            <form method="post" action="{{route('chat.message.create',['conversation_id' => $conversation->conversation_id])}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <input type="text" class="form-control" id="chat_text_message_form" name="chat_text_message_form" placeholder="Type message..">
                </div>
                <button class="btn-success btn-sm float-right" type="submit">Submit</button>
            </form>
        @empty

        @endforelse

    </div>
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