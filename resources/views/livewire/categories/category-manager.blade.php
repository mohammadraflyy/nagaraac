<div class="space-y-5">
    <x-slot name="title">{{ __('Categories') }}</x-slot>

    <livewire:categories.category-form :categoryId="$selectedCategoryId" />

    <livewire:categories.category-table />
</div>
