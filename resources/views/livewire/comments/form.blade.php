<div>
    <div class="flex flex-col gap-2">
        @if ($commentId)
            <textarea wire:model="content" class="w-full h-24 p-2 border rounded-md block border-gray-300 rounded-md shadow-sm dark:bg-[#182F44] dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Write your response here"></textarea>
        @else
            <textarea wire:model="content" class="w-full h-24 p-2 border rounded-md block border-gray-300 rounded-md shadow-sm dark:bg-[#182F44] dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Write your comment here"></textarea>
        @endif
        <button wire:click="submit" class="text-white rounded-md p-2 bg-[var(--primary)]">Submit</button>
    </div>
</div>
