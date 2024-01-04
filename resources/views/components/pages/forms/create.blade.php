<form action="{{ route('pages.store') }}" method="POST" id="createPageForm">
    @csrf
    <div class="mt-4">
        <fieldset>
            <x-label for="title" value="Code Improvement Title" />
            <x-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" aria-describedby="title-explanation" />
            <p id="title-explanation" class="text-gray-600 text-xs italic">Please enter a concise and descriptive title for the code you wish to optimize. The title should capture the essence of the problem or desired enhancement in a few words. Example: 'Optimizing Sorting Loop for Increased Efficiency'.</p>
            <x-input-error for="title" class="mt-2" />
        </fieldset>
    </div>
    <div class="mt-4">
        <fieldset>
            <x-label for="resume" value="Code summary" />
            <textarea name="resume" id="resume" rows="3" aria-describedby="resume-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('resume') }}</textarea>
            <p id="resume-explanation" class="text-gray-600 text-xs italic">Please provide a brief summary describing the code you aim to enhance. This summary should encompass key aspects of the code, such as its function, weaknesses, or specific areas needing particular attention. Example: 'Summary of the current sorting script highlighting inefficiencies in handling large datasets'.</p>
            <x-input-error for="resume" class="mt-2" />
        </fieldset>
    </div>
    <div class="mt-4">
        <fieldset>
            <x-label for="description" value="Code Description" />
            <textarea name="description" id="description" rows="5" aria-describedby="description-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
            <p id="description-explanation" class="text-gray-600 text-xs italic">Use this space to provide an in-depth description of the code in question. Describe its purpose, structure, any existing issues, and the desired enhancements extensively. Include relevant technical details and any additional information that can aid in understanding the context. Example: 'A comprehensive overview of the current sorting script, highlighting algorithmic gaps and suggestions to enhance efficiency by leveraging optimized data structures'.</p>
            <x-input-error for="description" class="mt-2" />
        </fieldset>
    </div>
    <div class="mt-4">
        <fieldset>
            <x-label for="editor" value="Code Section" />
            <input type="hidden" name="code" id="code">
            <div name="code" id="editor" rows="5" aria-describedby="code-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('code') }}</div>
            <p id="code-explanation" class="text-gray-600 text-xs italic">Please enter or paste the code you wish to enhance here. Ensure that the entirety of the relevant code is provided for a comprehensive assessment. You may also include comments or annotations to better explain key sections of the code. Example: Code snippet for sorting algorithm requiring optimization.</p>
            <x-input-error for="code" class="mt-2" />
        </fieldset>
    </div>

    <div class="mt-4">
        <livewire:forms.tags />
    </div>

    <div class="mt-4">
        <fieldset>
            <div class="flex">
                <div class="flex items-center h-5">
                    <x-checkbox id="is_public" name="is_public" aria-describedby="is_public-text" :value="1" @if (old('is_public') === "1") checked @endif />
                </div>
                <div class="ms-2 text-sm">
                    <x-label for="is_public" value="Code Visibility" />
                    <p id="is_public-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">Indicate the visibility status of the code. Check if the code is accessible to everyone or uncheck if it's restricted to a specific team</p>
                    <x-input-error for="is_public" class="mt-2" />
                </div>
            </div>
        </fieldset>
    </div>
    <div class="mt-4">
        <fieldset>
            <div class="flex">
                <div class="flex items-center h-5">
                    <input id="is_accept_version" name="is_accept_version" aria-describedby="is_accept_version-text" value="1"  type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if (old('is_accept_version') === "1") checked @endif>
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
