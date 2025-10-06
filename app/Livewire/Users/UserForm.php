<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $role = 'user';
    public $roles = ['administrator','user'];
    public $open = true;

    protected $listeners = ['openUserForm' => 'openForm'];

    public function mount($userId = null)
    {
        if ($userId) {
            $this->loadUser($userId);
        }
    }

    public function openForm($id = null)
    {
        $this->open = true;

        if ($id) {
            $this->loadUser($id);
        }
    }

    public function loadUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        session()->flash('message', 'User created successfully.');
        $this->resetForm();
        $this->dispatch('userSaved');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        session()->flash('message', 'User updated successfully.');
        $this->resetForm();
        $this->dispatch('userSaved');
    }

    public function resetForm()
    {
        $this->reset(['userId', 'name', 'email', 'password', 'role']);
    }

    public function render()
    {
        return view('livewire.users.user-form');
    }
}
