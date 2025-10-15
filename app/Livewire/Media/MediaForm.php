<?php

namespace App\Livewire\Media;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Media;

class MediaForm extends Component
{
    use WithFileUploads;

    public $id = null;
    public $mediaType = 'galleries';
    public $mediaTypes = ['galleries', 'promotions'];
    public $files = [];
    public $file = null;
    public $open = true;

    protected $listeners = ['openMediaForm' => 'openForm'];

    public function openForm($id = null)
    {
        $this->resetForm();

        if ($id) {
            $media = Media::findOrFail($id);
            $this->id = $media->id;
            $this->mediaType = $media->media_type;
        }

        $this->open = true;
    }

    public function store()
    {
        $this->validate([
            'mediaType' => 'required|in:' . implode(',', $this->mediaTypes),
            'files' => 'required|array|min:1',
            'files.*' => 'file|max:10240', 
        ]);

        foreach ($this->files as $file) {
            $hashedName = $file->hashName();
            $file->storeAs('media', $hashedName, 'public');

            Media::create([
                'media_type'  => $this->mediaType,
                'client_name' => $file->getClientOriginalName(),
                'file_size'   => $file->getSize(),
                'file_format' => $file->getClientOriginalExtension(),
                'hash_name'   => $hashedName,
            ]);
        }

        session()->flash('message', 'Media files uploaded successfully.');

        $this->resetForm();
        $this->dispatch('mediaSaved');
    }

    public function resetForm()
    {
        $this->reset(['id', 'mediaType', 'files', 'file']);
        $this->mediaType = 'galleries';
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.media.media-form');
    }
}
