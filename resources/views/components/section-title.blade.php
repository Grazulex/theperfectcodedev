<div class="flex justify-between px-4 pt-6 sm:px-6 md:col-span-1 ">
    <div class="flex">
        <h3 class="mr-2 text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}:</h3>
        <p class="mt-1 text-base text-gray-600 dark:text-gray-400">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
