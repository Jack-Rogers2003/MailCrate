<div class="py-12">
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
</div>
