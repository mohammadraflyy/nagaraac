<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">{{ $id ? 'Edit User' : 'Create User' }}</h2>
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
                    <flux:input wire:model="name" label="Name" placeholder="Name" type="text" required />
                    <flux:input wire:model="email" label="Email" placeholder="Email" type="email" required />
                    @unless($id)
                        <flux:input wire:model="password" label="Password" placeholder="Password" type="password" />
                    @endunless

                    <flux:label class="pb-2">Role</flux:label>
                    <flux:select wire:model="role" placeholder="Select Role">
                        @foreach($roles as $r)
                            <flux:select.option value="{{ $r }}">{{ ucfirst($r) }}</flux:select.option>
                        @endforeach
                    </flux:select>

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
