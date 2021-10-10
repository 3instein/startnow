@foreach ($startups as $startup)
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $startup->name }}</h1>
                <a href="{{ route('startups.show', $startup->id) }}">users</a>
            </div>
        </div>
    </div>
@endforeach