<div>
    <div style = "position:fixed">
    <button wire:click="postsButton" 
    style="padding: 20px 50px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Posts</button>
    <button wire:click="commentsButton"
    style="padding: 20px 50px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Comments</button>
    </div>
    <div wire:poll.1s class="py-12">
        @if($showPosts)
        @foreach($posts as $post)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div style="margin-bottom: 20px;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <button wire:click="sentToProfile({{$post -> account_id}})">{{App\Models\User::find($post -> account_id) -> name}}#{{$post -> account_id}}</button>
                    @if($isAuthenticated && $post -> account_id && $post -> account_id == App\Models\Account::where('user_id', Auth::id())->first()->id)
                        <button wire:click="delete({{$post->id}})" style="text-align: right;">delete</button>
                    @endif
                    <h1 style = "font-size: 50px; font-weight: bold">{{$post -> title}}</h1>   
                    <p1 style = "font-size: 50px; font-weight: bold">Film: {{$post -> film_name}}</p1>     
                    <textarea readonly class="border p-2 w-full" id = "content" rows="4">{{$post -> content}}</textarea>
                    </div>
                </div>
                @endforeach
        @else
        @foreach($comments as $comment)
        <div style="margin-bottom: 20px;" class="bg-white dark:bg-gray-80 sm:rounded-lg">
            <p1>{{$comment->post->content}}</p1>
            <h1>{{$comment->content}}</h1>
        </div>
        @endforeach
        @endif
    </div>
</div>
