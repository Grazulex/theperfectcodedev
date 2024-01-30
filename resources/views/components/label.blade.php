@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg text-[var(--light-gray)] dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
