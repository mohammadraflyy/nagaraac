<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">{{ $id ? 'Edit category' : 'Create category' }}</h2>
        <flux:button wire:click="$toggle('open')" variant="filled" size="sm">
            @if($open)
                <flux:icon.chevron-down variant="micro" />
            @else
                <flux:icon.chevron-up variant="micro" />
            @endif
        </flux:button>
    </div>

    @if($open)
        <div x-transition>
            @if($loading)
                <div class="flex flex-col items-center justify-center h-32">
                    <flux:icon.arrow-path class="animate-spin w-6 h-6 text-gray-500" />
                    <span class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        Loading...
                    </span>
                </div>
            @else
                @if(session()->has('message'))
                    <div class="mb-4 p-2 text-xs font-bold bg-green-100 text-green-800 rounded-lg">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="{{ $id ? 'update' : 'store' }}" class="space-y-4">
                    <flux:input wire:model="title" label="Category Title" placeholder="Title" type="text" required />
                    <flux:textarea wire:model="desc" label="Category Description" placeholder="Description" type="text" required />
                    <div class="flex items-center space-x-2">
                        <flux:button type="submit" variant="primary" size="sm">
                            {{ $id ? 'Update' : 'Save' }}
                        </flux:button>
                        <flux:button wire:click="resetForm" variant="filled" size="sm">
                            Reset
                        </flux:button>
                    </div>
                </form>
            @endif
        </div>
    @endif
</div>
