<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">{{ $tagId ? 'Edit Tag' : 'Create Tag' }}</h2>
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
            @if(session()->has('message'))
                <div class="mb-4 p-2 text-xs font-bold bg-green-100 text-green-800 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="{{ $tagId ? 'update' : 'store' }}" class="space-y-4">
                <flux:input wire:model="title" label="Tag Title" placeholder="Title" type="text" required />
                <flux:textarea wire:model="desc" label="Tag Description" placeholder="Description" type="text" required />
                <div class="flex items-center space-x-2">
                    <flux:button type="submit" variant="primary" size="sm">
                        {{ $tagId ? 'Update' : 'Save' }}
                    </flux:button>
                    <flux:button wire:click="resetForm" variant="filled" size="sm">
                        Reset
                    </flux:button>
                </div>
            </form>
        </div>
    @endif
</div>
