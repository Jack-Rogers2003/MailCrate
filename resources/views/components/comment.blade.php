<div>
<button wire:click.stop="sentToProfile({{$comment -> account_id}})">&emsp;&emsp; {{App\Models\User::find($comment -> account_id) -> name}}#{{$comment->account_id}}</button>
    <p1>- {{ $comment->content }}</p1>
    @if($this->{"showReplyToComment{$comment->id}"} ?? false)
                        <div>
                            <input id = "commentToCommentContent" type="text" placeholder="comment"/>
                                <button wire:click.stop="addCommentToComment(document.getElementById('commentToCommentContent').value,
                                {{$comment->id}})" 
                                style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Enter</button>
                        </div>
                    @else
                    @if(Auth::check())
                    <button wire:click.stop="showReplyToComment({{$comment->id}})"><strong>Comment</strong></button>
                    @endif
                    @if(Auth::check() && $comment -> account_id == App\Models\Account::where('user_id', Auth::id())->first()->id 
                    || App\Models\Account::where('user_id', Auth::id())->where('account_type', 'Admin')->exists())
                    <button wire:click.stop="deleteComment({{$comment->id}})"><strong>Delete</strong></button>
                    @endif
                    @if(Auth::check() && $comment -> account_id == App\Models\Account::where('user_id', Auth::id())->first()->id)
                    <button wire:click.stop="editComment({{$comment->id}})"><strong>Edit</strong></button>
                    @endif
                @endif
    @if($comment->childComments && $comment->childComments->isNotEmpty())
        <div style="margin-left: 20px;">&emsp;
            @foreach($comment->childComments as $child)
            <x-comment :comment="$child" />
            @endforeach
        </div>
    @endif
</div>