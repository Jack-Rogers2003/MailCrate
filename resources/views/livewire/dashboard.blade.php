
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: flex; flex-direction: column; gap: 20px;">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            @if ($isAuthenticated)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <textarea class="border p-2 w-full" id = "content" rows="4" placeholder="Enter Review"></textarea>
                <input type="text" wire:model="inputText" id="title" class="border p-2 w-full mt-2" placeholder="Enter Post Title">
                <input type="text" wire:model="inputText" id="film" class="border p-2 w-full mt-2" placeholder="Enter Film">
                <button wire:click="post(document.getElementById('title').value, 
                document.getElementById('film').value,
                document.getElementById('content').value)" 
                class="bg-blue-500 text-white px-4 py-2 mt-2">Post</button>
                </div>
                @endif
            </div>

            @foreach($posts as $post)
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div style="margin-bottom: 20px;" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h1>{{App\Models\User::find($post -> account_id) -> name}}#{{$post -> account_id}}</h1>
                <h1 style = "font-size: 50px; font-weight: bold">{{$post -> title}}</h1>   
                <p1 style = "font-size: 50px; font-weight: bold">Film: {{$post -> film_name}}</p1>     
                <textarea readonly class="border p-2 w-full" id = "content" rows="4">{{$post -> content}}</textarea>
                </div>
            </div>
            @endforeach
        </div>