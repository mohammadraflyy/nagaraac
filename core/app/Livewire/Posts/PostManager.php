<?php

namespace App\Livewire\Posts;

use Livewire\Component;

class PostManager extends Component
{
    public $selectedPostId = null;

    protected $listeners = [
        'postSaved' => '$refresh',
        'postDeleted' => '$refresh',
        'editPost' => 'setPostToEdit',
    ];

    public function setPostToEdit($id)
    {
        $this->selectedPostId = $id;
        $this->dispatch('openPostForm', $id);
    }

    public function render()
    {
        return view('livewire.posts.post-manager');
    }
}
