<div>
<textarea class="border p-2 w-full" id = "content" rows="4" placeholder="Enter Review">{{$comment->content}}</textarea>
<button  style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;" 
                    wire:click="applyEdit(document.getElementById('content').value)" 
                    class="bg-blue-500 text-white px-4 py-2 mt-2">Apply changes</button>
</div>
