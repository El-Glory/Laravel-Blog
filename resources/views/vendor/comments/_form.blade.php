<div class="flex">
    <div class="w-8/12 bg-white p-6 rounded-lg mt-3 shadow-lg">
        @if($errors->has('commentable_type'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('commentable_type') }}
        </div>
        @endif
        @if($errors->has('commentable_id'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('commentable_id') }}
        </div>
        @endif
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            @honeypot
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

            {{-- Guest commenting --}}
            @if(isset($guest_commenting) and $guest_commenting == true)
            <div class="mb-4">
                <label for="name" class="sr-only">@lang('comments::comments.enter_your_name_here')</label>
                <input type="text" id="name" placeholder="Enter name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @if($errors->has('guest_name')) is-invalid @endif" name="guest_name" />
                @error('guest_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="message" class="sr-only">@lang('comments::comments.enter_your_email_here')</label>
                <input type="email" placeholder="Enter email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @if($errors->has('guest_email')) is-invalid @endif" name="guest_email" />
                @error('guest_email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endif

            <div class="mb-4">
                <label for="message" class="sr-only">@lang('comments::comments.enter_your_message_here')</label>
                <textarea name="message" id="message" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @if($errors->has('message')) is-invalid @endif" placeholder="Enter Comment"></textarea>



            </div>
            <button type="submit" class="bg-blue-500 text-white text-center px-4 py-2 w-30 rounded-lg uppercase">@lang('comments::comments.submit')</button>
        </form>
    </div>
</div>
<br />