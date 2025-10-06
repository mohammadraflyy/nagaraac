<div class="space-y-5">
    <x-slot name="title">{{ __('Galleries') }}</x-slot>

    <livewire:media.media-form :mediaId="$selectedMediaId" />

    <livewire:media.media-table />
</div>
