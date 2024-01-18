<div>
    <div class="flex items-center justify-end">
        <div class="px-3 py-1 ml-4 text-xs font-bold text-white uppercase bg-[var(--light-blue)] rounded-full leading-sm">
            <ul>
                <li>{{ $page->is_public ? 'Public' : 'Private' }}</li>
                <!-- <li>{{ $page->is_accept_version ? 'Auto accept new version': 'Manual accept new version' }}</li> -->
            </ul>
        </div>
    </div>
</div>
