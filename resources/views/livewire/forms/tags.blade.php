<div>
    <fieldset>
        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tags</label>
        <input id="tagsInput" type="text"  aria-describedby="tags-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.blur="tagInput">
        <ul class="flex flex-wrap">
            @foreach ($tagsSelected as $index => $tag)
                <input type="hidden" name="tags[]" wire:model="tagsSelected.{{$index}}">
                <li class="bg-gray-200 rounded-full py-1 px-3 text-sm mr-2 mb-2">
                    {{ $tag }}
                    <button class="ml-1" wire:click.prevent="removeTag({{ $index }})">x</button>
                </li>
            @endforeach
        </ul>
        <p id="tags-explanation" class="text-gray-600 text-xs italic">Add keywords or labels to identify key aspects of your code. Use commas to separate different tags. These labels should represent languages, features, or specific issues addressed in the code. Example: 'Python, Sorting Algorithm, Efficiency, Optimization'.</p>
        @if ($errors->has('tags'))
            @foreach ($errors->get('tags') as $error)
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
            @endforeach
        @endif
        @if ($errors->has('tags.*'))
            @foreach ($errors->get('tags.*') as $error)
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error[0] }}</p>
            @endforeach
        @endif
    </fieldset>
</div>
