<div>
    <fieldset>
        <label for="tagsInput" class="block mb-2 text-2xl text-gray-600 dark:text-white">Tags</label>
        <input id="tagsInput" type="text"  aria-describedby="tags-explanation" class="block w-full mt-2 mb-2 border-gray-300 bg-white rounded-md shadow-sm dark:bg-[#182F44] dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model.blur="tagInput">
        <ul class="flex flex-wrap">
            @foreach ($tagsSelected as $index => $tag)
                <input type="hidden" name="tags[]" value="{{ $tag }}">
                <li class="px-3 py-1 mb-2 mr-2 text-sm bg-gray-200 rounded-full">
                    {{ $tag }}
                    <button class="ml-1" wire:click.prevent="removeTag({{ $index }})">x</button>
                </li>
            @endforeach
        </ul>
        <p id="tags-explanation" class="text-sm font-normal text-gray-500">Add keywords or labels to identify key aspects of your code. Use commas to separate different tags. These labels should represent languages, features, or specific issues addressed in the code. Example: 'Python, Sorting Algorithm, Efficiency, Optimization'.</p>
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
