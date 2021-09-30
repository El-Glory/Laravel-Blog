@inject('markdown', 'Parsedown')
@php
// TODO: There should be a better place for this.
$markdown->setSafeMode(true);
@endphp

<div id="comment-{{ $comment->getKey() }}" class="w-6/12 bg-white p-6 rounded-lg mt-3 shadow-lg flex">
    <div class="justify-between flex">
        <img class="h-20 mr-10" src="https://www.gravatar.com/avatar/{{ md5($comment->commenter->email ?? $comment->guest_email) }}.jpg?s=64" alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar">
    </div>
    <div class="media-body">


        <h5 class="mt-0">{{ $comment->commenter->name ?? $comment->guest_name }} <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
        <div class="text-sm font-light mb-1">{!! $markdown->line($comment->comment) !!}</div>

        <div>
            @can('reply-to-comment', $comment)
            <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.reply')</button>
            @endcan
            <!-- @can('edit-comment', $comment)
            <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" class="text-sm font-light uppercase text-green-500">@lang('comments::comments.edit')</button>
            @endcan -->
            @can('delete-comment', $comment)
            <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="text-sm font-light uppercase text-red-500 ml-4">@lang('comments::comments.delete')</a>
            <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                @method('DELETE')
                @csrf
            </form>
            @endcan
        </div>

        <!-- @can('edit-comment', $comment)
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">

            <div class="mt-3 text-center" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="sr-only">@lang('comments::comments.update_your_message_here')</label>
                            <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-gray-50 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"" data-dismiss=" modal">@lang('comments::comments.cancel')</button>
                            <button type="submit" class="bmt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-black hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"">@lang('comments::comments.update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan -->

        @can('reply-to-comment', $comment)
        <div class=" modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">


            <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                        <textarea required class="form-control" name="message" rows="3"></textarea>
                        <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                    <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
                </div>
            </form>


        </div>
        @endcan

        <br />{{-- Margin bottom --}}

        <?php
        if (!isset($indentationLevel)) {
            $indentationLevel = 1;
        } else {
            $indentationLevel++;
        }
        ?>

        {{-- Recursion for children --}}
        @if($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel) {{-- TODO: Don't repeat code. Extract to a new file and include it. --}} @foreach($grouped_comments[$comment->getKey()] as $child)
            @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments
            ])
            @endforeach
            @endif

    </div>
</div>

{{-- Recursion for children --}}
@if($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
{{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
@foreach($grouped_comments[$comment->getKey()] as $child)
@include('comments::_comment', [
'comment' => $child,
'grouped_comments' => $grouped_comments
])
@endforeach
@endif