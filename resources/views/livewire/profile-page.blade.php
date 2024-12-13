<div>
<div class="flex justify-end">

    <button wire:click="postsButton" 
    style="padding: 20px 50px; background-color: #007bff; color: white; border: none; border-radius: 5px; text-align: right;">Posts</button>
    <button wire:click="commentsButton"
    style="padding: 20px 50px; background-color: #007bff; color: white; border: none; border-radius: 5px; text-align: right;">Comments</button>
</div>
    <div class="py-12">
        @if($showPosts)
        @foreach($posts as $post)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div style="margin-bottom: 20px;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div style="display: flex; justify-content: space-between; width: 100%; margin: 0">    
                    <button wire:click="sentToProfile({{$post -> account_id}})">{{App\Models\User::find($post -> account_id) -> name}}#{{$post -> account_id}}</button>
                    @if($isAuthenticated && $post -> account_id == App\Models\Account::where('user_id', Auth::id())->first()->id)
                    <button wire:click.stop="edit({{$post->id}})" style="text-align: right;">Edit</button>
                    @endif

                    @if($isAuthenticated && $post -> account_id == App\Models\Account::where('user_id', Auth::id())->first()->id 
                    || App\Models\Account::where('user_id', Auth::id())->where('account_type', 'Admin')->exists())
                    <button wire:click.stop="delete({{$post->id}})" style="text-align: right;">Delete</button>
                    @endif
                    </div>
                    <h1 style = "font-size: 50px; font-weight: bold">{{$post -> title}}</h1>   
                    <p1 style = "font-size: 50px; font-weight: bold">Film: {{$post -> film_name}}</p1>     
                    <textarea readonly class="border p-2 w-full" id = "content" rows="4">{{$post -> content}}</textarea>
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
                            <p1 style="text-align: left;">{{$comment->content}}</p1>
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
                    <button wire:click.stop="viewPost({{$post->id}})">View all Replies</button>
                @endif
                @endforeach
                @else
                
                @foreach($comments as $newCommnent)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <button wire:click.stop="sentToProfile({{$newCommnent -> account_id}})"> {{App\Models\User::find($newCommnent -> account_id) -> name}}#{{$newCommnent->account_id}}</button>
                <p1 style="text-align: left;">{{$newCommnent->content}}</p1>
                </div>
                @endforeach
                @endif

</div>
