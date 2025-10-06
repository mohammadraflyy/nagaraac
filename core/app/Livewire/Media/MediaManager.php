<?php

namespace App\Livewire\Media;

use Livewire\Component;

class MediaManager extends Component
{
    public $selectedMediaId = null;

    protected $listeners = [
        'mediaSaved' => '$refresh',
        'mediaUpdated' => '$refresh',
        'mediaDeleted' => '$refresh',
        'editMedia' => 'setMediaToEdit',
    ];

    public function setMediaToEdit($id)
    {
        $this->selectedMediaId = $id;
        $this->dispatch('openMediaForm', $id);
    }

    public function render()
    {
        return view('livewire.media.media-manager');
    }
}
