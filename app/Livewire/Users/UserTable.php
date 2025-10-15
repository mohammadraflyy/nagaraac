<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Livewire\Traits\WithDataTableActions;

class UserTable extends Component
{
    use WithDataTableActions;

    protected $listeners = ['saved' => '$refresh'];

    public string $modelClass = User::class;
    public string $entityName = 'user';

    protected function getDisplayedItems()
    {
        $searchableFields = ['name', 'email', 'role'];
        
        return User::query()
            ->when($this->searchTerm, function($query) use ($searchableFields) {
                $query->where(function($q) use ($searchableFields) {
                    foreach ($searchableFields as $field) {
                        $q->orWhere($field, 'like', '%' . $this->searchTerm . '%');
                    }
                });
            })
            ->orderByDesc('id')
            ->paginate($this->perPage);
    }
    
    public function render()
    {
        return view('livewire.users.user-table', [
            'users' => $this->getDisplayedItems(),
        ]);
    }
}
