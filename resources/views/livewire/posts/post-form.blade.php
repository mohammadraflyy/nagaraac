<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">{{ $postId ? 'Edit Post' : 'Create Post' }}</h2>
        <flux:button wire:navigate href="{{ route('posts.index') }}">
            ← Back to Posts
        </flux:button>
    </div>

    @if(session()->has('message'))
        <div class="mb-4 p-2 text-xs font-bold bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-6">
        <!-- Main Editor -->
        <div class="flex-1">
            <form wire:submit.prevent="{{ $postId ? 'update' : 'store' }}" class="space-y-4">
                <!-- Title -->
                <flux:input wire:model="title" label="Title" placeholder="Post Title" type="text" required />

                <!-- Content Editor -->
                <div class="border p-4 min-h-[400px] space-y-3" x-data="{ showAddMenu: false }" x-ref="editor">
                    @foreach($content as $index => $block)
                        <div x-data="{ editing: false, showToolbar: false }" class="relative mb-2">

                            <!-- Toolbar on click -->
                            <div x-show="showToolbar" x-cloak
                                 @click.outside="showToolbar=false; editing=false"
                                 class="absolute -top-10 left-0 bg-white border rounded shadow p-1 flex space-x-1 z-50">
                                <select wire:change="updateBlockType({{ $index }}, $event.target.value)"
                                        class="border px-1 py-0 text-sm">
                                    <option value="p" @selected($block['type'] === 'p')>Paragraph</option>
                                    <option value="h1" @selected($block['type'] === 'h1')>H1</option>
                                    <option value="h2" @selected($block['type'] === 'h2')>H2</option>
                                    <option value="h3" @selected($block['type'] === 'h3')>H3</option>
                                    <option value="h4" @selected($block['type'] === 'h4')>H4</option>
                                </select>
                                <button wire:click="toggleBold({{ $index }})" class="px-1 text-sm font-bold">B</button>
                                <button wire:click="toggleItalic({{ $index }})" class="px-1 text-sm italic">I</button>
                                <button wire:click="removeBlock({{ $index }})"
                                        class="px-1 text-sm text-red-600 font-bold">✕</button>
                            </div>

                            @if($block['type'] === 'image')
                                <img src="{{ asset('storage/' . $block['value']) }}" class="max-w-full rounded shadow mb-2"
                                     @click="showToolbar = true">
                            @else
                                @php
                                    $classes = match($block['type']) {
                                        'h1' => 'text-3xl font-bold leading-tight',
                                        'h2' => 'text-2xl font-semibold leading-tight',
                                        'h3' => 'text-xl font-semibold leading-tight',
                                        'h4' => 'text-lg font-semibold leading-snug',
                                        'p'  => 'text-base leading-normal',
                                        default => 'text-base',
                                    };
                                    if(!empty($block['bold'])) $classes .= ' font-bold';
                                    if(!empty($block['italic'])) $classes .= ' italic';
                                @endphp

                                <div>
                                    <div x-show="!editing" @click="editing=true; showToolbar=true"
                                         class="cursor-pointer {{ $classes }}">
                                        {{ $block['value'] }}
                                    </div>
                                    <input x-show="editing" x-cloak type="text"
                                           x-ref="input"
                                           class="w-full border-0 focus:outline-none bg-transparent px-0 {{ $classes }}"
                                           wire:input.debounce.500ms="updateBlock({{ $index }}, $event.target.value)"
                                           x-on:blur="editing = false"
                                           :value="$refs.input?.value || '{{ $block['value'] }}'">
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <!-- Add Block Button & Popup -->
                    <div class="relative mt-2">
                        <button @click="showAddMenu = !showAddMenu"
                                class="px-3 py-1 bg-blue-500 text-white rounded">
                            + Add Block
                        </button>

                        <div x-show="showAddMenu" x-cloak
                             @click.outside="showAddMenu = false"
                             class="absolute left-0 mt-2 w-40 bg-white border rounded shadow-lg flex flex-col z-50">
                            <button wire:click="addBlock('h1'); showAddMenu=false"
                                    class="px-3 py-2 hover:bg-gray-100 text-left">H1</button>
                            <button wire:click="addBlock('h2'); showAddMenu=false"
                                    class="px-3 py-2 hover:bg-gray-100 text-left">H2</button>
                            <button wire:click="addBlock('h3'); showAddMenu=false"
                                    class="px-3 py-2 hover:bg-gray-100 text-left">H3</button>
                            <button wire:click="addBlock('h4'); showAddMenu=false"
                                    class="px-3 py-2 hover:bg-gray-100 text-left">H4</button>
                            <button wire:click="addBlock('p'); showAddMenu=false"
                                    class="px-3 py-2 hover:bg-gray-100 text-left">Paragraph</button>

                            <div class="px-3 py-2 border-t">
                                <input type="file" wire:model="featured_image" accept="image/*" class="mb-1 w-full">
                                <button wire:click="addBlock('image'); showAddMenu=false"
                                        class="px-2 py-1 bg-green-500 text-white rounded w-full">Add Image</button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 mt-4">
                        <flux:button type="submit" variant="primary" size="sm">
                            {{ $postId ? 'Update' : 'Save' }}
                        </flux:button>
                        <flux:button wire:click="resetForm" variant="filled" size="sm">
                            Reset
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right Sidebar -->
        <div class="w-full md:w-72 flex-shrink-0 space-y-4">
            <div class="sticky top-6 space-y-4 bg-gray-50 dark:bg-zinc-800">
                <!-- Status -->
                <div class="p-4">
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select wire:model="status" class="w-full border rounded p-2 dark:bg-zinc-700">
                        <option value="unpublished">Unpublished</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                <!-- Featured Image -->
                <div class="p-4">
                    <label class="block text-sm font-medium mb-1">Featured Image</label>
                    <input type="file" wire:model="featured_image" class="w-full text-sm" accept="image/*">
                    @if ($existingImage)
                        <img src="{{ asset('storage/media/' . $existingImage) }}"
                             class="mt-2 w-full h-32 object-cover rounded">
                    @endif
                </div>

                <!-- Categories -->
                <div class="p-4">
                    <label class="block text-sm font-medium mb-1">Categories</label>
                    <select wire:model="selectedCategories" multiple class="w-full border rounded p-2 dark:bg-zinc-700">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->title ?? $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags -->
                <div class="p-4">
                    <label class="block text-sm font-medium mb-1">Tags</label>
                    <select wire:model="selectedTags" multiple class="w-full border rounded p-2 dark:bg-zinc-700">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->title ?? $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
