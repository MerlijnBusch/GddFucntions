@forelse($chatRequests as $chatRequest)

    {{$chatRequest->user_id_belongs_to}}
    <form  action="{{ route('chat.request.accept',['chat' => $chatRequest->id]) }}" method="POST">
        @csrf
        @method('put')
        <button class="btn btn-success" type="submit">Accept</button>
    </form>

    <form  action="{{ route('chat.request.destroy',['chat' => $chatRequest->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Denied</button>
    </form>

@empty

    <p>no chat request found</p>

@endforelse