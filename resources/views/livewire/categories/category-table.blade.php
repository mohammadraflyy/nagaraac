<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">{{ __('Category') }}</h2>
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
                    placeholder="Search Category" 
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
                <th class="px-4 py-2 text-left">Title</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse ($categories as $category)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2 text-center">
                        <flux:checkbox 
                            wire:model.live="selectedItems" 
                            value="{{ $category->id }}" 
                            wire:key="category-{{ $category->id }}"
                        />
                    </td>
                    <td class="px-4 py-2">{{ $category->title }}</td>
                    <td class="px-4 py-2">{{ $category->desc }}</td>
                    <td class="px-4 py-2">
                        <flux:dropdown position="top" align="start">
                            <flux:button size="sm" variant="subtle">
                                <flux:icon.ellipsis-horizontal />
                            </flux:button>
                            <flux:navmenu>
                                <flux:navmenu.item wire:click.prevent="edit('{{ $category->id }}')">Edit</flux:navmenu.item>
                                <flux:navmenu.item wire:click.prevent="delete('{{ $category->id }}')" class="text-red-500">
                                    Delete
                                </flux:navmenu.item>
                            </flux:navmenu>
                        </flux:dropdown>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                        No categories found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        @include('partials.pagination', ['data' => $categories])
    </div>
</div>
