<form action="{{ route('pages.edit', $page) }}" method="POST" id="updatePageForm">
    @csrf
    <div class="mt-4">
        <fieldset>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Improvement Title</label>
            <input type="text" name="title" id="title" value="{{ (old('title'))?old('title'):$page->title }}" aria-describedby="title-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <p id="title-explanation" class="text-gray-600 text-xs italic">Please enter a concise and descriptive title for the code you wish to optimize. The title should capture the essence of the problem or desired enhancement in a few words. Example: 'Optimizing Sorting Loop for Increased Efficiency'.</p>
            @if ($errors->has('title'))
                @foreach ($errors->get('title') as $error)
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
                @endforeach
            @endif
        </fieldset>
    </div>
    <div class="mt-4">
        <fieldset>
            <label for="resume" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Summary</label>
            <textarea name="resume" id="resume" rows="3" aria-describedby="resume-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ (old('resume'))?old('resume'):$page->resume }}</textarea>
            <p id="resume-explanation" class="text-gray-600 text-xs italic">Please provide a brief summary describing the code you aim to enhance. This summary should encompass key aspects of the code, such as its function, weaknesses, or specific areas needing particular attention. Example: 'Summary of the current sorting script highlighting inefficiencies in handling large datasets'.</p>
            @if ($errors->has('resume'))
                @foreach ($errors->get('resume') as $error)
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
                @endforeach
            @endif
        </fieldset>
    </div>
    <div class="mt-4">
        <fieldset>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Description</label>
            <textarea name="description" id="description" rows="5" aria-describedby="description-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ (old('description'))?old('description'):$page->description }}</textarea>
            <p id="description-explanation" class="text-gray-600 text-xs italic">Use this space to provide an in-depth description of the code in question. Describe its purpose, structure, any existing issues, and the desired enhancements extensively. Include relevant technical details and any additional information that can aid in understanding the context. Example: 'A comprehensive overview of the current sorting script, highlighting algorithmic gaps and suggestions to enhance efficiency by leveraging optimized data structures'.</p>
            @if ($errors->has('description'))
                @foreach ($errors->get('description') as $error)
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
                @endforeach
            @endif
        </fieldset>
    </div>
    <div class="mt-4">
        <fieldset>
            <label for="editor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Section</label>
            <input type="hidden" name="code" id="code">
            <input type="hidden" name="oldCode" id="oldCode" value="{{ $page->code }}">
            <div name="code" id="editor" rows="5" aria-describedby="code-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></div>
            <p id="code-explanation" class="text-gray-600 text-xs italic">Please enter or paste the code you wish to enhance here. Ensure that the entirety of the relevant code is provided for a comprehensive assessment. You may also include comments or annotations to better explain key sections of the code. Example: Code snippet for sorting algorithm requiring optimization.</p>
            @if ($errors->has('code'))
                @foreach ($errors->get('code') as $error)
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
                @endforeach
            @endif
        </fieldset>
    </div>

    <div class="mt-4">
        <livewire:forms.tags />
    </div>

    <div class="mt-4">
        <fieldset>
            <div class="flex">
                <div class="flex items-center h-5">
                    <input id="is_public" name="is_public" aria-describedby="is_public-text" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if ((old('is_public')||($page->is_public)) == 1) checked @endif>
                </div>
                <div class="ms-2 text-sm">
                    <label for="is_public" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Visibility</label>
                    <p id="is_public-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Indicate the visibility status of the code. Check if the code is accessible to everyone or uncheck if it's restricted to a specific team</p>
                    @if ($errors->has('is_public'))
                        @foreach ($errors->get('is_public') as $error)
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </fieldset>
    </div>
    <div class="mt-4">
        <fieldset>
            <div class="flex">
                <div class="flex items-center h-5">
                    <input id="is_accept_version" name="is_accept_version" aria-describedby="is_accept_version-text" value="1"  type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if ((old('is_accept_version')||($page->is_accept_version)) == 1) checked @endif>
                </div>
                <div class="ms-2 text-sm">
                    <label for="is_accept_version" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Automatic Version Acceptance</label>
                    <p id="is_accept_version-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Specify whether new version proposals are automatically accepted. Check if you want new version proposals to be automatically accepted or uncheck if manual approval is required before implementing new versions. This choice determines the process for incorporating proposed changes.</p>
                    @if ($errors->has('is_accept_version'))
                        @foreach ($errors->get('is_accept_version') as $error)
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </fieldset>
    </div>


    <div class="flex justify-end mt-4">
        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Create</button>
    </div>
</form>
