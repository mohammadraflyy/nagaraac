@if ($data->count())
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 gap-2">
        {{-- Results Info --}}
        <div class="text-sm text-gray-800 dark:text-white">
            Showing 
            <span class="font-medium">{{ $data->firstItem() }}</span>
            to 
            <span class="font-medium">{{ $data->lastItem() }}</span>
            of 
            <span class="font-medium">{{ $data->total() }}</span>
            results
        </div>

        {{-- Pagination Controls --}}
        <div class="flex items-center space-x-1">
            {{-- Previous --}}
            @if ($data->onFirstPage())
                <flux:button size="xs">
                    <flux:icon.chevron-left variant="micro" />
                </flux:button>
            @else
                <flux:button size="xs" wire:click="previousPage">
                    <flux:icon.chevron-left variant="micro" />
                </flux:button>
            @endif

            {{-- Page Numbers --}}
            @foreach ($data->links()->elements[0] as $page => $url)
                @if ($page == $data->currentPage())
                    <flux:button size="xs" class="px-3 py-1 rounded-md bg-primary text-white font-medium">{{ $page }}</flux:button>
                @else
                    <flux:button size="xs" wire:click="gotoPage({{ $page }})">
                        {{ $page }}
                    </flux:button>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($data->hasMorePages())
                <flux:button size="xs" wire:click="nextPage">
                    <flux:icon.chevron-right variant="micro" />
                </flux:button>
            @else
                <flux:button size="xs">
                    <flux:icon.chevron-right variant="micro" />
                </flux:button>
            @endif
        </div>
    </div>
@else
    <div class="text-gray-500 dark:text-gray-400 mt-4 text-sm">
        No results found.
    </div>
@endif
