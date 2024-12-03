<div>
<textarea class="border p-2 w-full" id = "content" rows="4" placeholder="Enter Review">{{$post->content}}</textarea>
                    <input type="text" wire:model="inputText" id="title" class="border p-2 w-full mt-2" placeholder="Enter Post Title" value="{{$post->title}}"></input>
                    <input type="text" wire:model="inputText" id="film" class="border p-2 w-full mt-2" placeholder="Enter Film" value="{{$post->film_name}}"></input>
                    <button  style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;" 
                    wire:click="applyEdit(document.getElementById('title').value, 
                    document.getElementById('film').value,
                    document.getElementById('content').value)" 
                    class="bg-blue-500 text-white px-4 py-2 mt-2">Apply changes</button>
</div>
