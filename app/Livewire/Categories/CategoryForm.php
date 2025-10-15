<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public $id = null;
    public $title;
    public $desc;
    public $open = true;
    public $loading = false;

    protected $listeners = [
        'openForm' => 'openForm',
        'loadCategoryDeferred' => 'loadCategory'
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->loadCategory($id);
        }
    }

    public function openForm($id = null)
    {
        $this->open = true;

        if ($id) {
            $this->loading = true;

            $this->dispatch('loadCategoryDeferred', id: $id);
        }
    }

    public function loadCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->id = $category->id;
        $this->title = $category->title;
        $this->desc = $category->desc;
        
        sleep(1);
        $this->loading = false;
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

        $category = Category::findOrFail($this->id);
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
        $this->reset(['id', 'title', 'desc', 'open']);
    }

    public function render()
    {
        return view('livewire.categories.category-form');
    }
}
