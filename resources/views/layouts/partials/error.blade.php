@if($errors->any())
    <div class="form-group">

        @foreach($errors->all() as $error)

            <div class="alert alert-danger">

                <ul>

                    <li> {{ $error }} </li>

                </ul>

            </div>
        @endforeach

    </div>
@endif