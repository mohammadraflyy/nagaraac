@if ($medias->hasPages())
    <div class="flex items-center justify-between mt-4">
        {{-- Previous --}}
        @if ($medias->onFirstPage())
            <span class="px-3 py-1 rounded-md text-gray-400 cursor-default bg-zinc-700">
                <flux:icon.chevron-left variant="micro" />
            </span>
        @else
            <button wire:click="previousPage" class="px-3 py-1 rounded-md text-white bg-primary hover:bg-primary-dark">
                <flux:icon.chevron-left variant="micro" />
            </button>
        @endif

        {{-- Page Numbers --}}
        <div class="inline-flex space-x-1">
            @foreach ($medias->links()->elements[0] as $page => $url)
                @if ($page == $medias->currentPage())
                    <span class="px-3 py-1 rounded-md bg-primary text-white">{{ $page }}</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 rounded-md text-white bg-primary-light hover:bg-primary">
                        {{ $page }}
                    </button>
                @endif
            @endforeach
        </div>

        {{-- Next --}}
        @if ($medias->hasMorePages())
            <button wire:click="nextPage" class="px-3 py-1 rounded-md text-white bg-primary hover:bg-primary-dark">
                <flux:icon.chevron-right variant="micro" />
            </button>
        @else
            <span class="px-3 py-1 rounded-md text-gray-400 cursor-default bg-zinc-700">
                <flux:icon.chevron-right variant="micro" />
            </span>
        @endif
    </div>
@endif
