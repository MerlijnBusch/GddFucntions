<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name file</th>
        <th scope="col">View</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    @forelse($metrics as $metric)
        <tr>
            <th scope="row">{{$metric->id}}</th>
            <td>{{$metric->file_name}}</td>
            <td><a href="{{ route('moderator.metric.show',['metric' => $metric->id]) }}">View</a></td>
            <td><a href="" id="delete_metric_moderator_link" name="delete_metric_moderator_link"
                   onclick="event.preventDefault();
                           document.getElementById('delete_metric_moderator{{$metric->id}}').submit();">
                    Delete
                </a>
            </td>
        </tr>

        <form id="delete_metric_moderator{{$metric->id}}" action="{{ route('moderator.destroy.metric',['metric' => $metric->id]) }}" onclick="delete_metric_moderator_link{{$metric->id}}()" method="POST">
            @csrf
            @method('DELETE')
        </form>
    @empty
        <tr>
            <td><h1>No data sets</h1></td>
        </tr>
    @endforelse
    </tbody>
</table>