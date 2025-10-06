<?php

namespace App\Livewire\Tags;

use Livewire\Component;

class TagManager extends Component
{
    public $selectedTagId = null;

    protected $listeners = [
        'tagSaved' => '$refresh',
        'tagDeleted' => '$refresh',
        'editTag' => 'setTagToEdit',
    ];

    public function setTagToEdit($id)
    {
        $this->selectedTagId = $id;
        $this->dispatch('openTagForm', $id);
    }

    public function render()
    {
        return view('livewire.tags.tag-manager');
    }
}
