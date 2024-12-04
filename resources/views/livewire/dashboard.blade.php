
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
        </div>