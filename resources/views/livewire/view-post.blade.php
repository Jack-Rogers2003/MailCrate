<div>
<div style="margin-bottom: 20px;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div style="display: flex; justify-content: space-between; width: 100%; margin: 0">    
                <button wire:click="sentToProfile({{$post -> account_id}})">{{App\Models\User::find($post -> account_id) -> name}}#{{$post -> account_id}}</button>
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
                    @if(Auth::check())
                     <button wire:click.stop="toggleCommentReply({{$post->id}})" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Comment</button>  
                    @endif
                    @endif
                @if($post->comments()->count() > 0)
                    @foreach($post->comments()->get() as $comment)
                    
                        <div  style="display: flex; gap: 20px;">
                            <button wire:click.stop="sentToProfile({{$comment -> account_id}})"> {{App\Models\User::find($comment -> account_id) -> name}}#{{$comment->account_id}}</button>
                            <p1>{{$comment->content}}</p1>
                        <div>
                        @if($this->{"showReplyToComment{$comment->id}"} ?? false)
                        <div>
                            <input id = "commentToCommentContent" type="text" placeholder="comment"/>
                                <button wire:click="addCommentToComment(document.getElementById('commentToCommentContent').value,
                                {{$comment->id}})" 
                                style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Enter</button>
                        </div>
                    @else
                    <div>
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
                    </div>
                @endif
                        </div>
                        </div>
                        @if($comment->childComments->isNotEmpty())
                        <div>
                            @foreach($comment->childComments as $child)
                            <x-comment :comment="$child" />
                            @endforeach
                        </div>
                        @endif
                    @endforeach  
                @endif
            </div>
</div>
