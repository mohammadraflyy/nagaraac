<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class CategoryTable extends Component
{
    protected $listeners = ['categorySaved' => '$refresh'];

    public function edit($id)
    {
        $this->dispatch('editCategory', $id);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $this->dispatch('categoryDeleted');
    }

    public function render()
    {
        return view('livewire.categories.category-table', [
            'categories' => Category::all(),
        ]);
    }
}
