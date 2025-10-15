<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $id = null;
    public $name;
    public $email;
    public $password;
    public $role = 'user';
    public $roles = ['administrator','user'];
    public $open = true;
    public $loading = false;

    protected $listeners = [
        'openForm' => 'openForm',
        'loadUserDeferred' => 'loadUser'
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->loadUser($id);
        }
    }

    public function openForm($id = null)
    {
        $this->open = true;

        if ($id) {
            $this->loading = true;

            $this->dispatch('loadUserDeferred', id: $id);
        } else {
            $this->reset(['id', 'name', 'email', 'password', 'role']);
        }
    }

    public function loadUser($id)
    {
        $user = User::findOrFail($id);
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;

        sleep(1);
        $this->loading = false;
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
        $this->dispatch('saved');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($this->id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        session()->flash('message', 'User updated successfully.');
        $this->resetForm();
        $this->dispatch('saved');
    }

    public function resetForm()
    {
        $this->reset(['id', 'name', 'email', 'password', 'role']);
    }

    public function render()
    {
        return view('livewire.users.user-form');
    }
}
