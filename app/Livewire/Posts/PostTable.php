<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostTable extends Component
{
    protected $listeners = [
        'postDeleted' => '$refresh',
    ];

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->featured_media && $post->media && Storage::disk('public')->exists('media/' . $post->media->hash_name)) {
            Storage::disk('public')->delete('media/' . $post->media->hash_name);
            $post->media->delete();
        }

        $post->delete();

        session()->flash('message', 'Post deleted successfully.');
        $this->dispatch('postDeleted');
    }

    public function render()
    {
        return view('livewire.posts.post-table', [
            'posts' => Post::with(['author', 'featuredImage'])->orderByDesc('created_at')->get(),
        ]);
    }
}
