<div>
    <div class="flex flex-col gap-2 border-[#3A445B] pb-2 border-b">
        @if ($commentId)
        <details class="group">
            <summary class="flex items-center justify-between font-medium list-none cursor-pointer">
                Reply to comment:
                <span class="transition group-open:rotate-180">
                    <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path>
                    </svg>
                </span>
            </summary>
            <input wire:model="content" class="w-full p-2 mb-2 border block border-gray-300 rounded-md shadow-sm dark:bg-[#182F44] dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Write your response here"></input>
            <button wire:click="submit" class="w-full text-white rounded-md p-2 bg-[var(--primary)]">Submit</button>
        </details>

        @else
            <input wire:model="content" class="w-full p-2 border rounded-md block border-gray-300 shadow-sm dark:bg-[#182F44] dark:text-gray-200 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Write your comment here"></input>
            <button wire:click="submit" class="text-white rounded-md p-2 bg-[var(--primary)]">Submit</button>
        @endif
    </div>
</div>
