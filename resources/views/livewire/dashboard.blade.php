
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: flex; flex-direction: column; gap: 20px;">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            @if ($isAuthenticated)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <label for="image">Select an Image (JPG only):</label>
                <input type="file" id="imageEntry" wire:model="image" accept="image/*">
                <textarea class="border p-2 w-full" id = "content" rows="4" placeholder="Enter Review"></textarea>
                <div style="margin-bottom: 20px;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <h1>Select Tags:</h1>
                        @foreach($tagButtons as $newButton)
                            <button wire:click="tagSelected('{{$newButton}}')" style="padding: 10px 20px; background-color: blue; color: white; border: none; border-radius: 5px;">
                                {{$newButton}}
                            </button>
                        @endforeach
                        <div>
                            <p>@json($selectedTags)</p>
</div>
                <input type="text" wire:model="inputText" id="title" class="border p-2 w-full mt-2" placeholder="Enter Post Title"></input>
                    <input type="text" wire:model="inputText" id="film" class="border p-2 w-full mt-2" placeholder="Enter Film"></input>
                    <button  style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;" 
                    wire:click="post(document.getElementById('title').value, 
                    document.getElementById('film').value,
                    document.getElementById('content').value)" 
                    class="bg-blue-500 text-white px-4 py-2 mt-2">Post</button>
                </div>
            @endif
            </div>

            @foreach($posts as $post)
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div style="margin-bottom: 20px;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div style="display: flex; justify-content: space-between; width: 100%; margin: 0">    
                <button wire:click="sentToProfile({{$post -> account_id}})">{{App\Models\User::find($post -> account_id) -> name}}#{{$post -> account_id}}</button>
                    @if($isAuthenticated && $post -> account_id && $post -> account_id == App\Models\Account::where('user_id', Auth::id())->first()->id)
                    <button wire:click="edit({{$post->id}})" style="text-align: right;">Edit</button>
                    <button wire:click="delete({{$post->id}})" style="text-align: right;">Delete</button>
                    @endif
                </div>
                    <h1 style = "font-size: 50px; font-weight: bold">{{$post -> title}}</h1>   
                    <p1 style = "font-size: 50px; font-weight: bold">Film: {{$post -> film_name}}</p1>     
                    <textarea readonly class="border p-2 w-full" id = "content" rows="4">{{$post -> content}}</textarea>
                    <div>
                    @foreach(\App\Models\Post::find($post->id)->tags as $tag)
                    <text>{{$tag->type}},</text> 
                    @endforeach
                    </div>
                    @if($this->{"showReplyInput_{$post->id}"} ?? false)
                        <div>
                            <input id = "commentContent" type="text" placeholder="comment"/>
                                <button wire:click="addComment(document.getElementById('commentContent').value,
                                {{$post->id}})" 
                                style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Enter</button>
                        </div>
                    @else
                    <button wire:click="toggleCommentReply({{$post->id}})" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Comment</button>  
                @endif
                @if($post->comments()->count() > 0)
                <div>
                    @if($this->{"showCommentInput__{$post->id}"} ?? false)
                    
                    @foreach($post->comments()->get() as $comment)
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: flex; gap: 20px;">
                            <button wire:click="sentToProfile({{$comment -> account_id}})"> {{App\Models\User::find($comment -> account_id) -> name}}#{{$comment->account_id}}</button>
                            <p1>{{$comment->content}}</p1>
                        </div>
                        @endforeach  
                    @else
                    <button wire:click="togglePostComments({{$post->id}})" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Show Replies</button>
                    @endif
                </div>
                @endif
            </div>
            </div>
            @endforeach
        </div>