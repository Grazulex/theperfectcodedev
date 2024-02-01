<a {{ $attributes->merge(['class' => 'inline-flex bg-[var(--primary)]  items-center px-4 py-2 border border-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-200 hover:border-gray-600 active:border-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
