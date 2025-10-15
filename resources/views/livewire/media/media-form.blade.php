<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">
            {{ $id ? 'Edit Media' : 'Add Photos' }}
        </h2>

        <flux:button wire:click="$toggle('open')" variant="filled" size="sm">
            @if ($open)
                <flux:icon.chevron-up variant="micro" />
            @else
                <flux:icon.chevron-down variant="micro" />
            @endif
        </flux:button>
    </div>

    @if ($open)
        <div x-transition>
            @if (session()->has('message'))
                <div class="mb-4 p-2 text-xs font-bold bg-green-100 text-green-800 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="{{ $id ? 'update' : 'store' }}" class="space-y-4">
                <div>
                    <flux:select wire:model="mediaType" placeholder="Choose Media Type..." lable="Media Type">
                        @foreach ($mediaTypes as $type)
                        <flux:select.option value="{{ $type }}">{{ ucfirst($type) }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    @error('mediaType')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:label class="pb-2">Upload Files</flux:label>
                    <input
                        type="file"
                        wire:model="files"
                        id="files"
                        multiple
                        class="p-2 mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-zinc-800 dark:text-gray-200 focus:outline-none"
                    />
                    @error('files.*')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    @if ($files)
                        <div class="mt-3 space-y-2">
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Previews:</p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach ($files as $file)
                                    <div class="border border-gray-200 dark:border-zinc-700 rounded-lg p-2">
                                        @if (in_array(strtolower($file->getClientOriginalExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ $file->temporaryUrl() }}" alt="Preview" class="max-h-32 mx-auto rounded-md">
                                        @else
                                            <p class="text-xs text-gray-500 italic text-center mt-4">
                                                {{ $file->getClientOriginalName() }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <flux:button type="submit" variant="primary" size="sm">
                        {{ $id ? 'Update' : 'Save' }}
                    </flux:button>
                    <flux:button type="button" wire:click="resetForm" variant="filled" size="sm">
                        Reset
                    </flux:button>
                </div>
            </form>
        </div>
    @endif
</div>
