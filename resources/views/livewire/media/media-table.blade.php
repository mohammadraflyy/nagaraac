<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ __('Media Library') }}</h2>
    <div class="flex items-center justify-between my-4">
        <div class="flex items-center gap-2">
            <div class="w-max">
                <flux:select wire:model.live="perPage" type="select" size="sm" class="w-20 text-sm">
                    <flux:select.option value="5">5</flux:select.option>
                    <flux:select.option value="10">10</flux:select.option>
                    <flux:select.option value="25">25</flux:select.option>
                    <flux:select.option value="50">50</flux:select.option>
                    <flux:select.option value="100">100</flux:select.option>
                </flux:select>
            </div>
            <div>
                <flux:input 
                    type="text" 
                    size="sm" 
                    placeholder="Search Media" 
                    class="w-full"
                    wire:model.live="searchTerm"
                    icon="magnifying-glass"
                />
            </div>
        </div>
        <div class="flex items-center">
            <flux:button 
                size="sm" 
                variant="danger"
                class="bg-red-500 text-white hover:bg-red-600"
                wire:click="bulkDelete"
            >
                Delete Selected
            </flux:button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-2 text-xs font-bold bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full border border-gray-200 rounded overflow-hidden">
        <thead class="text-sm bg-gray-100 text-black dark:bg-zinc-800 dark:text-gray-200">
            <tr>
                <th class="px-4 py-2 w-10 text-center">
                    <flux:checkbox wire:model.live="selectAll" />
                </th>
                <th class="px-4 py-2 text-left">Preview</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Type</th>
                <th class="px-4 py-2 text-left">Format</th>
                <th class="px-4 py-2 text-left">Size</th>
                <th class="px-4 py-2 text-left">Action</th>
            </tr>
        </thead>

        <tbody class="text-sm divide-y divide-gray-200 dark:divide-zinc-800">
            @forelse ($medias as $media)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2 text-center">
                        <flux:checkbox 
                            wire:model.live="selectedItems" 
                            value="{{ $media->id }}" 
                            wire:key="media-{{ $media->id }}"
                        />
                    </td>
                    <td class="px-4 py-2">
                        @if (in_array(strtolower($media->file_format), ['jpg','jpeg','png','gif','webp']))
                            <img src="{{ asset('storage/media/' . $media->hash_name) }}"
                                 alt="{{ $media->client_name }}"
                                 class="h-10 w-10 object-cover rounded-md border border-gray-200 dark:border-zinc-700">
                        @else
                            <div class="h-10 w-10 flex items-center justify-center bg-gray-100 dark:bg-zinc-800 rounded-md text-gray-500">
                                <flux:icon.photo class="h-5 w-5" />
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-2 truncate max-w-[200px]" title="{{ $media->client_name }}">
                        {{ $media->client_name }}
                    </td>
                    <td class="px-4 py-2 capitalize">{{ $media->media_type }}</td>
                    <td class="px-4 py-2 uppercase">{{ $media->file_format }}</td>
                    <td class="px-4 py-2">{{ number_format($media->file_size / 1024, 2) }} KB</td>
                    <td class="px-4 py-2 text-right">
                        <flux:dropdown position="top" align="end">
                            <flux:button size="sm" variant="subtle">
                                <flux:icon.ellipsis-horizontal />
                            </flux:button>
                            <flux:navmenu>
                                <flux:navmenu.item wire:click.prevent="edit('{{ $media->id }}')">
                                    Edit
                                </flux:navmenu.item>
                                <flux:navmenu.item wire:click.prevent="delete('{{ $media->id }}')" class="text-red-500">
                                    Delete
                                </flux:navmenu.item>
                            </flux:navmenu>
                        </flux:dropdown>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                        No media files found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        @include('partials.pagination', ['data' => $medias])
    </div>
</div>
