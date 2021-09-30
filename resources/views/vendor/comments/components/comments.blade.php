@php
if (isset($approved) and $approved == true) {
$comments = $model->approvedComments;
} else {
$comments = $model->comments;
}
@endphp

@if($comments->count() < 1) <div class="mt-10 mb-5 italic bg-green-100 w-3/12 p-2 text-center rounded-md bg-opacity-50">@lang('comments::comments.there_are_no_comments')</div>
    @endif

    <div>
        @php
        $comments = $comments->sortBy('created_at');

        if (isset($perPage)) {
        $page = request()->query('page', 1) - 1;

        $parentComments = $comments->where('child_id', '');

        $slicedParentComments = $parentComments->slice($page * $perPage, $perPage);

        $m = Config::get('comments.model'); // This has to be done like this, otherwise it will complain.
        $modelKeyName = (new $m)->getKeyName(); // This defaults to 'id' if not changed.

        $slicedParentCommentsIds = $slicedParentComments->pluck($modelKeyName)->toArray();

        // Remove parent Comments from comments.
        $comments = $comments->where('child_id', '!=', '');

        $grouped_comments = new \Illuminate\Pagination\LengthAwarePaginator(
        $slicedParentComments->merge($comments)->groupBy('child_id'),
        $parentComments->count(),
        $perPage
        );

        $grouped_comments->withPath(request()->url());
        } else {
        $grouped_comments = $comments->groupBy('child_id');
        }
        @endphp
        @foreach($grouped_comments as $comment_id => $comments)
        {{-- Process parent nodes --}}
        @if($comment_id == '')
        @foreach($comments as $comment)
        @include('comments::_comment', [
        'comment' => $comment,
        'grouped_comments' => $grouped_comments,
        'maxIndentationLevel' => $maxIndentationLevel ?? 3
        ])
        @endforeach
        @endif
        @endforeach
    </div>

    @isset ($perPage)
    {{ $grouped_comments->links() }}
    @endisset

    @auth
    @include('comments::_form')
    @elseif(Config::get('comments.guest_commenting') == true)
    @include('comments::_form', [
    'guest_commenting' => true
    ])
    @else
    <div class="bg-gray-100 w-6/12 p-2 rounded-md">

        <h5 class="italic mb-2">@lang('comments::comments.authentication_required')</h5>
        <p class="italic mb-2">@lang('comments::comments.you_must_login_to_post_a_comment')</p>
        <div class="py-3">
            <a href="{{ route('login') }}" class="bg-blue-500 text-white text-center px-4 py-2 w-20 rounded-lg">@lang('comments::comments.log_in')</a>
        </div>
    </div>
    @endauth