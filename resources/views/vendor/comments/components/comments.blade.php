<style media="screen">
  .auth-button-hollow {
    background: white;
    color: #212121;
    border-radius: 5px;
    border: 1px solid #212121;
    padding: 12px 50px;
  }

  .auth-button-hollow:hover {
      background: #212121;
      color: #e9e9e9;
  }

  .alert-warning {
    background-color: #F5F5F5;
    color: #212121;
    border: 1px solid rgba(0, 0, 0, 0.125);
  }
</style>

@php
    if (isset($approved) and $approved == true) {
        $comments = $model->approvedComments;
    } else {
        $comments = $model->comments;
    }
@endphp

<ul class="list-unstyled">
    @php
        $comments = $comments->sortByDesc('created_at');

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

            $grouped_comments->withPath(request()->path());
        } else {
            $grouped_comments = $comments->groupBy('child_id');
        }
    @endphp

    @auth
        @include('comments::_form')
    @elseif(Config::get('comments.guest_commenting') == true)
        @include('comments::_form', [
            'guest_commenting' => true
        ])
    @else
        <div class="card m-b-5">
            <div class="card-body">
                <h5 class="card-title">Authentication required</h5>
                <p class="card-text">You must log in to post a comment.</p>
                <div class="spacer"></div>
                <a href="{{ route('login') }}" class="auth-button-hollow" style="">Log in</a>
                <div class="spacer"></div>
            </div>
        </div>
        <div class="spacer"></div>
    @endauth

    @if($comments->count() < 1)
        <div class="alert alert-warning">There are no comments yet.</div>
    @endif

    @foreach($grouped_comments as $comment_id => $comments)
        {{-- Process parent nodes --}}
        @if($comment_id == '')
            @foreach($comments as $comment)
                @include('comments::_comment', [
                    'comment' => $comment,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif
    @endforeach
</ul>

@isset ($perPage)
    {{ $grouped_comments->links() }}
@endisset
