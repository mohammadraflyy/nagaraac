<?php

namespace App\Livewire\Media;

use Livewire\Component;
use App\Models\Media;
use App\Livewire\Traits\WithDataTableActions;

class MediaTable extends Component
{
    use WithDataTableActions;

    protected $listeners = ['mediaSaved' => '$refresh'];

    public string $modelClass = Media::class;
    public string $entityName = 'media';

    protected function getDisplayedItems()
    {
        $searchableFields = ['client_name', 'file_format', 'media_type'];
        
        return Media::query()
            ->when($this->searchTerm, function($query) use ($searchableFields) {
                $query->where(function($q) use ($searchableFields) {
                    foreach ($searchableFields as $field) {
                        $q->orWhere($field, 'like', '%' . $this->searchTerm . '%');
                    }
                });
            })
            ->where('media_type', '!=', 'post')
            ->orderByDesc('id')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.media.media-table', [
            'medias' => $this->getDisplayedItems(),
        ]);
    }
}
