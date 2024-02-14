<div {{ $attributes->merge(['class' => '']) }}>


    <div class="mt-5 bg-white shadow md:mt-0 md:col-span-2 dark:bg-gray-800 sm:rounded-lg">
        <x-section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">{{ $description }}</x-slot>
        </x-section-title>
        <div class="p-6">
            {{ $content }}
        </div>
    </div>
</div>
