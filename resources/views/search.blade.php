<!DOCTYPE html>
<html>
<head>
    <title>Semantic Search</title>
</head>
<body>
    <h1>Semantic Category Search</h1>
    <form method="POST" action="{{ route('search') }}">
        @csrf
        <input type="text" name="query" placeholder="Enter your query..." value="{{ old('query', $query ?? '') }}">
        <button type="submit">Search</button>
    </form>

    @if(isset($results))
        <h3>Results:</h3>
        <ul>
            @forelse($results as $result)
                <li>{{ $result['name'] }} (Score: {{ number_format($result['score'], 3) }})</li>
            @empty
                <li>No results found.</li>
            @endforelse
        </ul>
    @endif
</body>
</html>
