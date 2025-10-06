<?php

namespace App\Livewire\Media;

use Livewire\Component;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaTable extends Component
{
    protected $listeners = [
        'mediaSaved' => '$refresh', 
        'mediaUpdated' => '$refresh'
    ];

    public function delete($id)
    {
        $media = Media::findOrFail($id);

        if ($media->hash_name && Storage::disk('public')->exists('media/' . $media->hash_name)) {
            Storage::disk('public')->delete('media/' . $media->hash_name);
        }

        $media->delete();

        session()->flash('message', 'Media deleted successfully.');

        $this->dispatch('mediaDeleted');
    }

    public function edit($id)
    {
        $this->dispatch('openMediaForm', $id);
    }

    public function render()
    {
        return view('livewire.media.media-table', [
            'medias' => Media::orderByDesc('id')->where('media_type', '!=' ,'post')->get(),
        ]);
    }
}
