<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">{{ __('Media Library') }}</h2>

    {{-- ✅ Flash message --}}
    @if (session()->has('message'))
        <div class="mb-4 p-2 text-xs font-bold bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full border border-gray-200 rounded overflow-hidden">
        <thead class="text-sm bg-gray-100 text-black dark:bg-zinc-800 dark:text-gray-200">
            <tr>
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
                    {{-- ✅ Thumbnail or icon --}}
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

                    {{-- ✅ Name --}}
                    <td class="px-4 py-2 truncate max-w-[200px]" title="{{ $media->client_name }}">
                        {{ $media->client_name }}
                    </td>

                    {{-- ✅ Type --}}
                    <td class="px-4 py-2 capitalize">
                        {{ $media->media_type }}
                    </td>

                    {{-- ✅ Format --}}
                    <td class="px-4 py-2 uppercase">
                        {{ $media->file_format }}
                    </td>

                    {{-- ✅ Size --}}
                    <td class="px-4 py-2">
                        {{ number_format($media->file_size / 1024, 2) }} KB
                    </td>

                    {{-- ✅ Actions --}}
                    <td class="px-4 py-2 text-right">
                        <flux:dropdown position="top" align="end">
                            <flux:button size="sm" variant="subtle">
                                <flux:icon.ellipsis-horizontal />
                            </flux:button>
                            <flux:navmenu>
                                {{-- Edit action --}}
                                <flux:navmenu.item
                                    wire:click.prevent="edit('{{ $media->id }}')"
                                >
                                    Edit
                                </flux:navmenu.item>

                                {{-- Delete action --}}
                                <flux:navmenu.item
                                    wire:click.prevent="delete('{{ $media->id }}')"
                                    class="text-red-500"
                                >
                                    Delete
                                </flux:navmenu.item>
                            </flux:navmenu>
                        </flux:dropdown>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                        No media files found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
