<form action="{{ route('pages.store') }}" method="POST" id="createPageForm">
    @csrf
    <div class="mt-4">
        <x-label for="title" value="Code Improvement Title" />
        <x-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" aria-describedby="title-explanation" />
        <p id="title-explanation" class="text-sm font-normal text-gray-500">Please enter a concise and descriptive title for the code you wish to optimize. The title should capture the essence of the problem or desired enhancement in a few words. Example: 'Optimizing Sorting Loop for Increased Efficiency'.</p>
        <x-input-error for="title" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-label for="resume" value="Code summary" />
        <textarea name="resume" id="resume" rows="3" aria-describedby="resume-explanation" class="block w-full mb-2 mt-2 border-gray-300 rounded-md shadow-sm dark:bg-[#182F44] dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('resume') }}</textarea>
        <p id="resume-explanation" class="text-sm font-normal text-gray-500">Please provide a brief summary describing the code you aim to enhance. This summary should encompass key aspects of the code, such as its function, weaknesses, or specific areas needing particular attention. Example: 'Summary of the current sorting script highlighting inefficiencies in handling large datasets'.</p>
        <x-input-error for="resume" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-label for="description" value="Code Description" />
        <textarea name="description" id="description" rows="5" aria-describedby="description-explanation" class="block w-full mb-2 mt-2 border-gray-300 rounded-md shadow-sm dark:bg-[#182F44] dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
        <p id="description-explanation" class="text-sm font-normal text-gray-500">Use this space to provide an in-depth description of the code in question. Describe its purpose, structure, any existing issues, and the desired enhancements extensively. Include relevant technical details and any additional information that can aid in understanding the context. Example: 'A comprehensive overview of the current sorting script, highlighting algorithmic gaps and suggestions to enhance efficiency by leveraging optimized data structures'.</p>
        <x-input-error for="description" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-label for="editor" value="Code Section" />
        <input type="hidden" name="code" id="code">
        <div name="code" id="editor" rows="5" aria-describedby="code-explanation" class="block w-full mt-2 mb-2 border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('code') }}</div>
        <p id="code-explanation" class="text-sm font-normal text-gray-500">Please enter or paste the code you wish to enhance here. Ensure that the entirety of the relevant code is provided for a comprehensive assessment. You may also include comments or annotations to better explain key sections of the code. Example: Code snippet for sorting algorithm requiring optimization.</p>
        <x-input-error for="code" class="mt-2" />
    </div>

    <div class="mt-4">
        <livewire:forms.tags />
    </div>

    <div class="block mt-4">
        <label for="is_public" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            <x-checkbox class="mb-2" id="is_public" name="is_public" value="1" />
            <span class="ml-1 text-lg text-gray-600 dark:text-white">Code Visibility</span>
        </label>
        <p id="is_public-text" class="text-sm font-normal text-gray-500">Indicate the visibility status of the code. Check if the code is accessible to everyone or uncheck if it's restricted to a specific team.</p>
        <x-input-error for="is_public" class="mt-2" />
    </div>
    <div class="block mt-4">
        <label for="is_accept_version" class="block text-sm font-medium text-gray-700 dark:text-white">
            <x-checkbox class="mb-2"  id="is_accept_version" name="is_accept_version" value="1" />
            <span class="ml-1 text-lg">Automatic Version Acceptance</span>
        </label>
        <p id="is_accept_version-text" class="text-sm font-normal text-gray-500">Specify whether new version proposals are automatically accepted. Check if you want new version proposals to be automatically accepted or uncheck if manual approval is required before implementing new versions. This choice determines the process for incorporating proposed changes.</p>
        <x-input-error for="is_accept_version" class="mt-2" />
    </div>


    <div class="flex items-center justify-end mt-4">
        <x-button>
            {{ __('Create') }}
        </x-button>
    </div>
</form>
