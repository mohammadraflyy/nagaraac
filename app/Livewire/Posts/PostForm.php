<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Media;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostForm extends Component
{
    use WithFileUploads;

    public ?string $postId = null;
    public $title;
    public $content = [];
    public $status = 'unpublished';
    public $featured_image;
    public $existingImage;
    public $selectedCategories = [];
    public $selectedTags = [];
    public $open = true;
    public $standalone = false; 

    protected $listeners = ['openPostForm' => 'openForm'];

    public function mount(?string $postId = null)
    {
        $this->postId = $postId;
        if ($postId) {
            $this->loadPost($postId);
        }
    }

    public function addBlock($type)
    {
        if ($type === 'image') {
            $this->validate([
                'featured_image' => 'nullable|image|max:2048',
            ]);

            if ($this->featured_image) {
                $hash = Str::random(40) . '.' . $this->featured_image->getClientOriginalExtension();
                $this->featured_image->storeAs('media', $hash, 'public');

                $this->content[] = [
                    'type' => 'image',
                    'value' => $hash
                ];

                $this->featured_image = null;
            }

        } else {
            $this->content[] = [
                'type' => $type,
                'value' => "New $type"
            ];
        }
    }

    public function updateBlock($index, $value)
    {
        $this->content[$index]['value'] = $value;
    }

    public function updateBlockType($index, $type)
    {
        $this->content[$index]['type'] = $type;
    }

    public function toggleBold($index)
    {
        $this->content[$index]['bold'] = !($this->content[$index]['bold'] ?? false);
    }

    public function toggleItalic($index)
    {
        $this->content[$index]['italic'] = !($this->content[$index]['italic'] ?? false);
    }

    public function removeBlock($index)
    {
        array_splice($this->content, $index, 1);
    }

    public function loadPost($id)
    {
        $post = Post::with(['featuredImage', 'categories', 'tags'])->findOrFail($id);
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->status = $post->status;
        $this->existingImage = $post->media?->hash_name;
        $this->selectedCategories = $post->categories->pluck('id')->toArray();
        $this->selectedTags = $post->tags->pluck('id')->toArray();
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:published,unpublished',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $featuredMediaId = null;

        if ($this->featured_image) {
            $hashedName = Str::random(40) . '.' . $this->featured_image->getClientOriginalExtension();
            $this->featured_image->storeAs('media', $hashedName, 'public');

            $media = Media::create([
                'client_name' => $this->featured_image->getClientOriginalName(),
                'hash_name' => $hashedName,
                'file_size' => $this->featured_image->getSize(),
                'file_format' => $this->featured_image->getClientOriginalExtension(),
                'media_type' => 'post',
            ]);

            $featuredMediaId = $media->id;
        }

        $post = Post::create([
            'id' => Str::uuid(),
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'users_id' => Auth::id(),
            'featured_media' => $featuredMediaId,
        ]);

        $post->categories()->sync($this->selectedCategories);
        $post->tags()->sync($this->selectedTags);

        session()->flash('message', 'Post created successfully.');

        if ($this->standalone) {
            return redirect()->route('posts.index');
        }

        $this->resetForm();
        $this->dispatch('postSaved');
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:published,unpublished',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $post = Post::findOrFail($this->postId);
        $featuredMediaId = $post->featured_media;

        if ($this->featured_image) {
            if ($post->media && Storage::disk('public')->exists('media/' . $post->media->hash_name)) {
                Storage::disk('public')->delete('media/' . $post->media->hash_name);
                $post->media->delete();
            }

            $hashedName = Str::random(40) . '.' . $this->featured_image->getClientOriginalExtension();
            $this->featured_image->storeAs('media', $hashedName, 'public');

            $media = Media::create([
                'client_name' => $this->featured_image->getClientOriginalName(),
                'hash_name' => $hashedName,
                'file_size' => $this->featured_image->getSize(),
                'file_format' => $this->featured_image->getClientOriginalExtension(),
                'media_type' => 'post',
            ]);

            $featuredMediaId = $media->id;
        }

        $post->update([
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'featured_media' => $featuredMediaId,
        ]);

        $post->categories()->sync($this->selectedCategories);
        $post->tags()->sync($this->selectedTags);

        session()->flash('message', 'Post updated successfully.');

        if ($this->standalone) {
            return redirect()->route('posts.index');
        }

        $this->resetForm();
        $this->dispatch('postUpdated');
    }

    public function resetForm()
    {
        $this->reset([
            'postId', 'title', 'content', 'status',
            'featured_image', 'existingImage',
            'selectedCategories', 'selectedTags', 'open'
        ]);
    }

    public function render()
    {
        return view('livewire.posts.post-form', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }
}
