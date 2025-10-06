<?php

namespace App\Livewire\Categories;

use Livewire\Component;

class CategoryManager extends Component
{
    public $selectedCategoryId = null;

    protected $listeners = [
        'categorySaved' => '$refresh',
        'categoryDeleted' => '$refresh',
        'editCategory' => 'setCategoryToEdit',
    ];

    public function setCategoryToEdit($id)
    {
        $this->selectedCategoryId = $id;
        $this->dispatch('openCategoryForm', $id);
    }

    public function render()
    {
        return view('livewire.categories.category-manager');
    }
}
