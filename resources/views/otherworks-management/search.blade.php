<div class="list-group">
    @if (count($search_results) > 0)
        @foreach($search_results as $search_result)
            <div class="list-group-item">
            <a href="{{ route('otherworks.show', $search_result->id) }}">{{ $search_result->name }}</a>
            </div>
        @endforeach
    @else
        <div class="alert alert-warning" role="alert">Không có kết quả</div>
    @endif
</div>
