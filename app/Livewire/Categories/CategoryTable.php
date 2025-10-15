<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use App\Livewire\Traits\WithDataTableActions;

class CategoryTable extends Component
{
    use WithDataTableActions;

    protected $listeners = ['saved' => '$refresh'];
    
    public string $modelClass = Category::class;
    public string $entityName = 'category';

    protected function getDisplayedItems()
    {
        $searchableFields = ['title', 'desc'];

        return Category::query()
            ->when($this->searchTerm, function ($query) use ($searchableFields) {
                $query->where(function ($q) use ($searchableFields) {
                    foreach ($searchableFields as $field) {
                        $q->orWhere($field, 'like', '%' . $this->searchTerm . '%');
                    }
                });
            })
            ->orderByDesc('id')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.categories.category-table', [
            'categories' => $this->getDisplayedItems(),
        ]);
    }
}
