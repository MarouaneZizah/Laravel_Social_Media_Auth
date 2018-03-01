@if( count($errors) )

    <div class="flashMsg flashMsgError">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>

@endif