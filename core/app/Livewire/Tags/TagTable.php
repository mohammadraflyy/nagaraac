<?php

namespace App\Livewire\Tags;

use Livewire\Component;
use App\Models\Tag;

class TagTable extends Component
{
    protected $listeners = ['tagSaved' => '$refresh'];

    public function edit($id)
    {
        $this->dispatch('editTag', $id);
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        $this->dispatch('tagDeleted');
    }

    public function render()
    {
        return view('livewire.tags.tag-table', [
            'tags' => Tag::all(),
        ]);
    }
}
