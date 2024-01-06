<div>
    <div class="flex items-center justify-end mb-3">
        <div class="ml-4 text-xs font-bold leading-sm uppercase px-3 py-1 rounded-full bg-white text-gray-700 border">
            <ul>
                <li>{{ $page->is_public ? 'Public' : 'Private' }}</li>
                <li>{{ $page->is_accept_version ? 'Auto accept new version': 'Manual accept new version' }}</li>
            </ul>
        </div>
    </div>
</div>
