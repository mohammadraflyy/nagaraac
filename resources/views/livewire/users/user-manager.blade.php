<div class="space-y-5">
    <x-slot name="title">{{ __('Users') }}</x-slot>

    <livewire:users.user-form :userId="$selectedUserId" />

    <livewire:users.user-table />
</div>
