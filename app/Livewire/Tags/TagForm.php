<?php

namespace App\Livewire\Tags;

use Livewire\Component;
use App\Models\Tag;

class TagForm extends Component
{
    public $id = null;
    public $title;
    public $desc;
    public $open = true;
    public $loading = false;

    protected $listeners = [
        'openForm' => 'openForm',
        'loadTagDeferred' => 'loadTag'
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->loadTag($id);
        }
    }

    public function openForm($id = null)
    {
        $this->open = true;

        if ($id) {
            $this->loading = true;

            $this->dispatch('loadTagDeferred', id: $id);
        } else {
            $this->reset(['id', 'title', 'desc']);
        }
    }

    public function loadTag($id)
    {
        $tag = Tag::findOrFail($id);
        $this->id = $tag->id;
        $this->title = $tag->title;
        $this->desc = $tag->desc;

        sleep(1);
        $this->loading = false;
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
        $this->dispatch('saved');
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string',
            'desc' => 'nullable|string',
        ]);

        $tag = Tag::findOrFail($this->id);
        $tag->update([
            'title' => $this->title,
            'desc' => $this->desc,
        ]);

        session()->flash('message', 'Tag updated successfully.');
        $this->resetForm();
        $this->dispatch('saved');
    }

    public function resetForm()
    {
        $this->reset(['id', 'title', 'desc', 'open']);
    }

    public function render()
    {
        return view('livewire.tags.tag-form');
    }
}
