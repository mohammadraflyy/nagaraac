<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use App\Livewire\Traits\WithDataTableActions;

class PostTable extends Component
{
    use WithDataTableActions;

    protected $listeners = [
        'postDeleted' => '$refresh',
    ];

    public string $modelClass = Post::class;
    public string $entityName = 'post';

    protected function getDisplayedItems()
    {
        $searchableFields = ['title', 'desc'];

        return Post::query()
            ->when($this->searchTerm, function ($query) use ($searchableFields) {
                $query->where(function ($q) use ($searchableFields) {
                    foreach ($searchableFields as $field) {
                        $q->orWhere($field, 'like', '%' . $this->searchTerm . '%');
                    }
                });
            })
            ->with(['author', 'featuredImage'])
            ->orderByDesc('created_at')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.posts.post-table', [
            'posts' => $this->getDisplayedItems(),
        ]);
    }
}
