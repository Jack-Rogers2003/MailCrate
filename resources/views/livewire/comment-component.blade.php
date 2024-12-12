<div>
<button wire:click.stop="sentToProfile({{$comment -> account_id}})">&emsp;&emsp; {{App\Models\User::find($comment -> account_id) -> name}}#{{$comment->account_id}}</button>
    <p1>- {{ $comment->content }}</p1>
    <input id = "commentContent" type="text" placeholder="comment"/>
                                <button wire:click.stop="addCommentToComment(document.getElementById('commentContent').value,
                                {{$comment->id}})" 
                                style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Enter</button>
    @if($comment->childComments->isNotEmpty())
        <div style="margin-left: 20px;">&emsp;
            @foreach($comment->children as $child)
                @livewire('CommentComponent', ['comment' => $child])
            @endforeach
        </div>
    @endif
</div>