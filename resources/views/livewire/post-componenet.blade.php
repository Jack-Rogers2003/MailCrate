<div class="py-12">
    @foreach($posts as $post)
        <div style="margin-bottom: 20px;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div style="display: flex; justify-content: space-between; width: 100%; margin: 0">    
        <button wire:click.stop="sentToProfile({{$post -> account_id}})">{{App\Models\User::find($post -> account_id) -> name}}#{{$post -> account_id}}</button>
            @if($isAuthenticated && $post -> account_id && $post -> account_id == App\Models\Account::where('user_id', Auth::id())->first()->id)
            <button wire:click.stop="edit({{$post->id}})" style="text-align: right;">Edit</button>
            <button wire:click.stop="delete({{$post->id}})" style="text-align: right;">Delete</button>
            @endif
        </div>
            <h1 style = "font-size: 50px; font-weight: bold">{{$post -> title}}</h1>   
            <p1 style = "font-size: 50px; font-weight: bold">Film: {{$post -> film_name}}</p1>     
            <textarea readonly class="border p-2 w-full" id = "content" rows="4">{{$post -> content}}</textarea>
            <div>
            @if(\App\Models\Post::find($post->id)->tags != null)
            @foreach(\App\Models\Post::find($post->id)->tags as $tag)
            <text>{{$tag->type}},</text> 
            @endforeach
            @endif
            </div>
            @if($this->{"showReplyInput_{$post->id}"} ?? false)
                <div>
                    <input id = "commentContent" type="text" placeholder="comment"/>
                        <button wire:click.stop="addComment(document.getElementById('commentContent').value,
                        {{$post->id}})" 
                        style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Enter</button>
                </div>
            @else
            <button wire:click.stop="toggleCommentReply({{$post->id}})" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Comment</button>  
        @endif
        @if($post->comments()->count() > 0)
        @php
            $loopLimit = min(10, $post->comments()->count());
            $count = 0;
        @endphp
            @foreach($post->comments()->get() as $comment)
            @if($count >= $loopLimit)
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
                    @endif
                </div>
                @php
                    $count++; 
                @endphp
            @endforeach
            <button>View all Replies</button>
        @endif
    </div>
    @endforeach
</div>
