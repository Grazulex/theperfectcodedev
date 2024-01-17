@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[var(--light-gray)] dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
