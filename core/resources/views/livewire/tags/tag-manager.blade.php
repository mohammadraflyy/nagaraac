<div class="space-y-5">
    <x-slot name="title">{{ __('Tags') }}</x-slot>

    <livewire:tags.tag-form :tagId="$selectedTagId" />

    <livewire:tags.tag-table />
</div>
