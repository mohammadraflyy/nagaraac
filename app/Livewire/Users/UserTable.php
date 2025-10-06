<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class UserTable extends Component
{
    protected $listeners = ['userSaved' => '$refresh'];

    public function edit($id)
    {
        $this->dispatch('editUser', $id);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->dispatch('userDeleted');
    }

    public function render()
    {
        return view('livewire.users.user-table', [
            'users' => User::all(),
        ]);
    }
}
