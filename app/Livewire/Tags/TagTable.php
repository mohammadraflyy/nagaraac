<?php

namespace App\Livewire\Tags;

use Livewire\Component;
use App\Models\Tag;
use App\Livewire\Traits\WithDataTableActions;

class TagTable extends Component
{
    use WithDataTableActions;

    protected $listeners = ['saved' => '$refresh'];

    public string $modelClass = Tag::class;
    public string $entityName = 'tag';

    protected function getDisplayedItems()
    {
        $searchableFields = ['title', 'desc'];

        return Tag::query()
            ->when($this->searchTerm, function ($query) use ($searchableFields) {
                $query->where(function ($q) use ($searchableFields) {
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
        return view('livewire.tags.tag-table', [
            'tags' => $this->getDisplayedItems(),
        ]);
    }
}
