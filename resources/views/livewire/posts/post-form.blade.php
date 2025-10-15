<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg" wire:ignore.self>
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">{{ $id ? 'Edit Post' : 'Create Post' }}</h2>
        <flux:button wire:navigate href="{{ route('posts.index') }}" icon="chevron-left" class="flex items-center space-x-2">
            Back to Posts
        </flux:button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-2 text-xs font-bold bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $id ? 'update' : 'store' }}" class="space-y-6">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Left Column - Content -->
            <div class="flex-1 space-y-6">
                <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-6">
                    <label class="block text-sm font-medium mb-4 text-zinc-700 dark:text-zinc-300">
                        Content
                    </label>
                    <flux:textarea 
                        wire:model.defer="content"
                        name="content" 
                        class="min-h-[500px] p-3"
                        placeholder="Enter post content"
                    >{{ $content }}</flux:textarea>
                    
                    @error('content')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="w-full md:w-80 flex-shrink-0 space-y-6">
                <div class="sticky top-6 space-y-6 bg-gray-50 dark:bg-zinc-800 rounded-lg p-6">
                    <!-- Title -->
                    <div>
                        <flux:input 
                            wire:model="title" 
                            label="Title" 
                            placeholder="Enter post title" 
                            type="text" 
                            required
                            class="w-full"
                        />
                        @error('title')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <flux:select wire:model="status" label="Status" required class="w-full">
                            <flux:select.option value="unpublished">Unpublished</flux:select.option>
                            <flux:select.option value="published">Published</flux:select.option>
                        </flux:select>
                        @error('status')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Featured Image -->
                    <div>
                        <flux:label for="featured_image" class="block text-sm font-medium mb-2">
                            Featured Image
                        </flux:label>
                        <input 
                            type="file" 
                            wire:model="featured_image" 
                            id="featured_image"
                            class="w-full text-sm bg-white dark:bg-zinc-700 p-3 rounded-lg border border-zinc-300 dark:border-zinc-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            accept="image/*"
                        >
                        @error('featured_image')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                        
                        @if ($existingImage)
                            <div class="mt-3">
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-2">Current Image:</p>
                                <img 
                                    src="{{ asset('storage/media/' . $existingImage) }}" 
                                    class="w-full h-40 object-cover rounded-lg border border-zinc-300 dark:border-zinc-600"
                                    alt="Current featured image"
                                >
                            </div>
                        @endif

                        @if ($featured_image && !$featured_image->getError())
                            <div class="mt-3">
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-2">New Image Preview:</p>
                                <img 
                                    src="{{ $featured_image->temporaryUrl() }}" 
                                    class="w-full h-40 object-cover rounded-lg border border-zinc-300 dark:border-zinc-600"
                                    alt="New featured image preview"
                                >
                            </div>
                        @endif
                    </div>

                    <!-- Categories -->
                    <div>
                        <flux:label for="selectedCategories" class="block text-sm font-medium mb-2">
                            Categories (Select at least one)
                        </flux:label>
                        <select 
                            wire:model="selectedCategories" 
                            multiple 
                            id="selectedCategories"
                            class="w-full border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 p-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            size="4"
                        >
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ $cat->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('selectedCategories')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                            Hold Ctrl/Cmd to select multiple
                        </p>
                    </div>

                    <!-- Tags -->
                    <div>
                        <flux:label for="selectedTags" class="block text-sm font-medium mb-2">
                            Tags (Select at least one)
                        </flux:label>
                        <select 
                            wire:model="selectedTags" 
                            multiple 
                            id="selectedTags"
                            class="w-full border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 p-3 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            size="4"
                        >
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">
                                    {{ $tag->title ?? $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('selectedTags')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                            Hold Ctrl/Cmd to select multiple
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <button 
                            type="submit" 
                            class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            wire:loading.attr="disabled"
                            wire:target="store,update"
                        >
                            <span wire:loading.remove wire:target="store,update">
                                {{ $id ? 'Update Post' : 'Create Post' }}
                            </span>
                            <span wire:loading wire:target="store,update">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                        
                        <button 
                            type="button" 
                            wire:click="resetForm" 
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition font-medium focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            wire:loading.attr="disabled"
                        >
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
