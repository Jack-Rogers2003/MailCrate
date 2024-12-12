<div>
    @if($post->comments()->count() > 0)
    @foreach($post->comments()->get() as $comment)
    @break
    @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: flex; gap: 20px;">
            <button wire:click.stop="sentToProfile({{$comment -> account_id}})"> {{App\Models\User::find($comment -> account_id) -> name}}#{{$comment->account_id}}</button>
            <p1>{{$comment->content}}</p1>
            @if($this->{"showReplyToComment{$comment->id}"} ?? false)
            <div>
            <input id = "commentContent" type="text" placeholder="comment"/>
                <button wire:click.stop="addComment(document.getElementById('commentContent').value,
                {{$post->id}})" 
                style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Enter</button>
            </div>
            @else
            <button wire:click.stop="showReplyToComment({{$comment->id}})">reply<button>
            @endif
        </div>
    @endforeach  
    @endif
</div>
