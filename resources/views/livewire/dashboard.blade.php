
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <textarea readonly class="border p-2 w-full" rows="4">{{ $text }}</textarea>
                <input type="text" wire:model="inputText" id="input" class="border p-2 w-full mt-2" placeholder="Type something">
                <button wire:click="addText(document.getElementById('input').value)" class="bg-blue-500 text-white px-4 py-2 mt-2">Add Text</button>
                </div>
            </div>
        </div>
    </div>
