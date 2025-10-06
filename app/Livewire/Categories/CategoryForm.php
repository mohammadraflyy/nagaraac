<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public $categoryId;
    public $title;
    public $desc;
    public $open = true;

    protected $listeners = ['openCategoryForm' => 'openForm'];

    public function mount($categoryId = null)
    {
        if ($categoryId) {
            $this->loadCategory($categoryId);
        }
    }

    public function openForm($id = null)
    {
        $this->open = true;

        if ($id) {
            $this->loadCategory($id);
        }
    }

    public function loadCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->title = $category->title;
        $this->desc = $category->desc;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string',
            'desc' => 'nullable|string',
        ]);

        Category::create([
            'title' => $this->title,
            'desc' => $this->desc,
        ]);

        session()->flash('message', 'Category created successfully.');

        $this->resetForm();
        $this->dispatch('categorySaved');
    }
    
    public function update()
    {
        $this->validate([
            'title' => 'required|string',
            'desc' => 'nullable|string',
        ]);

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'title' => $this->title,
            'desc' => $this->desc,
        ]);

        session()->flash('message', 'Category updated successfully.');
        $this->resetForm();
        $this->dispatch('categorySaved');
    }

    public function resetForm()
    {
        $this->reset(['categoryId', 'title', 'desc', 'open']);
    }

    public function render()
    {
        return view('livewire.categories.category-form');
    }
}
