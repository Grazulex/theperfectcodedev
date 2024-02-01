<form action="{{ route('versions.store', ['page'=> $page ]) }}" method="POST" id="createVersionForm">
    @csrf
    <div class="mt-4">
        <x-label for="description" value="Code Description" />
        <textarea name="description" id="description" rows="5" aria-describedby="description-explanation" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-[#182F44] dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
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

    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Create') }}
        </x-button>
    </div>
</form>
