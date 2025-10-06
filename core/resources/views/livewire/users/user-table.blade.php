<div class="p-6 mx-auto bg-white dark:bg-zinc-900 shadow-md rounded-lg">
    <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">{{ __('Users') }}</h2>

    <table class="min-w-full border border-gray-200 rounded overflow-hidden">
        <thead class="text-sm bg-gray-100 text-black">
            <tr>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Verified At</th>
                <th class="px-4 py-2 text-left">Role</th>
                <th class="px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @foreach($users as $user)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2">
                        <div>{{ $user->name }}</div>
                        <span class="block text-gray-500 text-xs">{{ $user->email }}</span>
                    </td>
                    <td class="px-4 py-2">{{ $user->email_verified_at ?? '-' }}</td>
                    <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                    <td class="px-4 py-2">
                        <flux:dropdown position="top" align="start">
                            <flux:button size="sm" variant="subtle">
                                <flux:icon.ellipsis-horizontal />
                            </flux:button>
                            <flux:navmenu>
                                <flux:navmenu.item wire:click.prevent="edit('{{ $user->id }}')">Edit</flux:navmenu.item>
                                <flux:navmenu.item wire:click.prevent="delete('{{ $user->id }}')" class="text-red-500">
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
