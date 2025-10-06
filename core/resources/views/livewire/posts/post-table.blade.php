<div 
    x-data="{ show: false }"
    x-init="
        show = true;
        $el.addEventListener('livewire:navigated', () => { show = true })
    "
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-5"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-5"
    class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg"
>
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">{{ __('Posts') }}</h2>
        <flux:button wire:navigate href="{{ route('posts.create') }}">
            + New Post
        </flux:button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-2 text-xs font-bold bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full border border-gray-200 rounded overflow-hidden">
        <thead class="text-sm bg-gray-100 text-black">
            <tr>
                <th class="px-4 py-2 text-left">Title</th>
                <th class="px-4 py-2 text-left">Author</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Featured</th>
                <th class="px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @foreach($posts as $post)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2 font-medium">{{ $post->title }}</td>
                    <td class="px-4 py-2">{{ $post->author->name ?? '—' }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-xs {{ $post->status === 'published' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-800' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        @if($post->media)
                            <img src="{{ asset('storage/media/' . $post->featuredMedia->hash_name) }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <span class="text-gray-500 text-xs italic">No image</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <flux:dropdown position="top" align="start">
                            <flux:button size="sm" variant="subtle">
                                <flux:icon.ellipsis-horizontal />
                            </flux:button>
                            <flux:navmenu>
                                <flux:navmenu.item>
                                    <a wire:navigate href="{{ route('posts.edit', $post->id) }}">
                                        Edit
                                    </a>
                                </flux:navmenu.item>
                                <flux:navmenu.item wire:click.prevent="delete('{{ $post->id }}')" class="text-red-500">
                                    Delete
                                </flux:navmenu.item>
                            </flux:navmenu>
                        </flux:dropdown>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
