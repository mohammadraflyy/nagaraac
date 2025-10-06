<?php

namespace App\Livewire\Tags;

use Livewire\Component;
use App\Models\Tag;

class TagForm extends Component
{
    public $tagId = null;
    public $title;
    public $desc;
    public $open = true;

    protected $listeners = ['openTagForm' => 'openForm'];

    public function mount($tagId = null)
    {
        if ($tagId) {
            $this->loadTag($tagId);
        }
    }

    public function openForm($id = null)
    {
        $this->open = true;

        if ($id) {
            $this->loadTag($id);
        }
    }

    public function loadTag($id)
    {
        $tag = Tag::findOrFail($id);
        $this->tagId = $tag->id;
        $this->title = $tag->title;
        $this->desc = $tag->desc;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string',
            'desc' => 'nullable|string',
        ]);

        Tag::create([
            'title' => $this->title,
            'desc' => $this->desc,
        ]);

        session()->flash('message', 'Tag created successfully.');

        $this->resetForm();
        $this->dispatch('tagSaved');
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string',
            'desc' => 'nullable|string',
        ]);

        $tag = Tag::findOrFail($this->tagId);
        $tag->update([
            'title' => $this->title,
            'desc' => $this->desc,
        ]);

        session()->flash('message', 'Tag updated successfully.');

        $this->resetForm();
        $this->dispatch('tagSaved');
    }
    
    public function resetForm()
    {
        $this->reset(['tagId', 'title', 'desc', 'open']);
    }

    public function render()
    {
        return view('livewire.tags.tag-form');
    }
}
