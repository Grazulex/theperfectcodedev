@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-2xl text-[var(--text-dark)] dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
