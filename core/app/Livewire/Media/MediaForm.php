<?php

namespace App\Livewire\Media;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaForm extends Component
{
    use WithFileUploads;

    public $mediaId = null;
    public $mediaType = 'galleries';
    public $mediaTypes = ['galleries', 'promotions'];
    public $files = []; // 🟢 Multiple files for store
    public $file = null; // 🟡 Single file for update
    public $open = true;

    protected $listeners = ['openMediaForm' => 'openForm'];

    public function openForm($mediaId = null)
    {
        $this->resetForm();

        if ($mediaId) {
            $media = Media::findOrFail($mediaId);
            $this->mediaId = $media->id;
            $this->mediaType = $media->media_type;
        }

        $this->open = true;
    }

    public function store()
    {
        $this->validate([
            'mediaType' => 'required|in:' . implode(',', $this->mediaTypes),
            'files' => 'required|array|min:1',
            'files.*' => 'file|max:10240', // 10MB per file
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

    public function update()
    {
        $this->validate([
            'mediaType' => 'required|in:' . implode(',', $this->mediaTypes),
            'file' => 'nullable|file|max:10240',
        ]);

        $media = Media::findOrFail($this->mediaId);

        $updatedData = [
            'media_type' => $this->mediaType,
        ];

        if ($this->file) {
            if ($media->hash_name && Storage::disk('public')->exists('media/' . $media->hash_name)) {
                Storage::disk('public')->delete('media/' . $media->hash_name);
            }

            $hashedName = $this->file->hashName();
            $this->file->storeAs('media', $hashedName, 'public');

            $updatedData = array_merge($updatedData, [
                'client_name' => $this->file->getClientOriginalName(),
                'file_size'   => $this->file->getSize(),
                'file_format' => $this->file->getClientOriginalExtension(),
                'hash_name'   => $hashedName,
            ]);
        }

        $media->update($updatedData);

        session()->flash('message', 'Media updated successfully.');

        $this->resetForm();
        $this->dispatch('mediaUpdated');
    }

    public function resetForm()
    {
        $this->reset(['mediaId', 'mediaType', 'files', 'file']);
        $this->mediaType = 'galleries';
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.media.media-form');
    }
}
