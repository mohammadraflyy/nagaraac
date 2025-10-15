<?php

namespace App\Livewire\Traits;

use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait WithDataTableActions
{
    use WithPagination;

    public $selectedItems = [];
    public bool $selectAll = false;
    public $searchTerm = '';
    public $perPage = 10;

    protected ?string $mediaDisk = 'public';
    protected ?string $mediaPath = 'media';

    abstract public function getDisplayedItems();

    public function updatingPerPage() { $this->resetPage(); }
    public function updatingSearchTerm() { $this->resetPage(); }

    public function updatedSelectAll($value)
    {
        $items = $this->getDisplayedItems();
        $currentPageIds = $items->pluck('id')->toArray();

        if ($value) {
            $this->selectedItems = array_unique(array_merge($this->selectedItems, $currentPageIds));
        } else {
            $this->selectedItems = array_diff($this->selectedItems, $currentPageIds);
        }
    }

    public function updatedSelectedItems()
    {
        $items = $this->getDisplayedItems();
        $currentPageIds = $items->pluck('id')->toArray();

        $this->selectAll = count(array_intersect($currentPageIds, $this->selectedItems)) === count($currentPageIds);
    }

    public function bulkDelete()
    {
        if (empty($this->selectedItems)) {
            session()->flash('message', 'No items selected.');
            return;
        }

        $modelClass = $this->modelClass ?? null;

        if (! $modelClass || ! class_exists($modelClass)) {
            throw new \Exception('Property $modelClass not set in component using WithDataTableActions.');
        }

        $items = $modelClass::whereIn('id', $this->selectedItems)->get();

        foreach ($items as $item) {
            $this->deleteAssociatedFiles($item);
        }

        $modelClass::whereIn('id', $this->selectedItems)->delete();

        $this->selectedItems = [];
        $this->selectAll = false;

        session()->flash('message', 'Selected ' . Str::plural($this->entityName) . ' deleted successfully.');
        $this->dispatch($this->entityName . 'Deleted');
    }

    public function delete($id)
    {
        $modelClass = $this->modelClass ?? null;

        if (! $modelClass || ! class_exists($modelClass)) {
            throw new \Exception('Property $modelClass not set in component using WithDataTableActions.');
        }

        $item = $modelClass::findOrFail($id);

        $this->deleteAssociatedFiles($item);

        $item->delete();

        $this->selectedItems = array_diff($this->selectedItems, [$id]);
        $this->updatedSelectedItems();

        session()->flash('message', ucfirst($this->entityName) . ' deleted successfully.');
        $this->dispatch($this->entityName . 'Deleted');
    }

    public function edit($id)
    {
        $this->dispatch('openForm', $id)->to(Str::plural($this->entityName) . '.' . $this->entityName . '-form');
    }

    protected function deleteAssociatedFiles($item)
    {
        if ($item->hash_name && Storage::disk('public')->exists('media/' . $item->hash_name)) {
            Storage::disk('public')->delete('media/' . $item->hash_name);
        }

        if ($item->featuredMedia) {
            Storage::disk('public')->delete('media/' . $item->hash_name);
        }
    }
}
