<?php

namespace App\Livewire\Users;

use Livewire\Component;

class UserManager extends Component
{
    public $selectedUserId = null;

    protected $listeners = [
        'userSaved' => '$refresh',
        'userDeleted' => '$refresh',
        'editUser' => 'setUserToEdit',
    ];

    public function setUserToEdit($id)
    {
        $this->selectedUserId = $id;
        $this->dispatch('openUserForm', $id);
    }

    public function render()
    {
        return view('livewire.users.user-manager');
    }
}
