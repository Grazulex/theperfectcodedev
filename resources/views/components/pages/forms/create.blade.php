<form action="{{ route('pages.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
            <input type="text" name="title" id="title" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @if($errors->has('title'))
                @foreach ($errors->get('title') as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
        </div>
    </div>
    <div class="mt-4">
        <label for="resume" class="block text-sm font-medium text-gray-700 dark:text-gray-200">resume</label>
        <textarea name="resume" id="resume" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        @if($errors->has('resume'))
            @foreach ($errors->get('resume') as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </div>
    <div class="mt-4">
        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content</label>
        <textarea name="content" id="content" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        @if($errors->has('content'))
            @foreach ($errors->get('content') as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </div>

    <div class="mt-4">
        <label for="tags[]" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tags</label>
        <input type="text" name="tags[]" id="tags[]">
        @if($errors->has('tags'))
            @foreach ($errors->get('tags') as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </div>

    <div class="flex justify-end mt-4">
        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Create</button>
    </div>
</form>