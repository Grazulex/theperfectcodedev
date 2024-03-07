<div>
    <div class="flex flex-col gap-2">
        @if ($commentId)
            <textarea wire:model="content" class="w-full h-24 border border-neutral-300 rounded-md p-2" placeholder="Write your response here"></textarea>
        @else
            <textarea wire:model="content" class="w-full h-24 border border-neutral-300 rounded-md p-2" placeholder="Write your comment here"></textarea>
        @endif
        <button wire:click="submit" class="bg-neutral-500 text-white rounded-md p-2">Submit</button>
    </div>
</div>
