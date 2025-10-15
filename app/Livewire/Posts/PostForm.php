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
use Livewire\Attributes\Url;

class PostForm extends Component
{
    use WithFileUploads;

    #[Url]
    public ?string $id = null;
    public $title = '';
    public $content = '';
    public $status = 'unpublished';
    public $featured_image;
    public $existingImage;
    public $selectedCategories = [];
    public $selectedTags = [];
    public $open = true;
    public $standalone = false;

    protected $listeners = [
        'openPostForm' => 'openForm',
        'refreshTinyMCE' => 'refreshTinyMCE',
        'setContent' => 'setContent'
    ];

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function mount()
    {
        if ($this->id) {
            $this->loadPost($this->id);
        }

        $this->dispatch('initTinyMCE');
    }

    public function updatedId($value)
    {
        if ($value) {
            $this->loadPost($value);
        }
    }

    public function loadPost($id)
    {
        $post = Post::with(['featuredImage', 'categories', 'tags'])->findOrFail($id);

        $this->id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->status = $post->status;
        $this->existingImage = $post->featuredImage?->hash_name;
        $this->selectedCategories = $post->categories->pluck('id')->toArray();
        $this->selectedTags = $post->tags->pluck('id')->toArray();

        $this->dispatch('updateTinyMCEContent', content: $this->content);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'status' => 'required|in:published,unpublished',
            'featured_image' => 'nullable|image|max:2048',
            'selectedCategories' => 'required|array|min:1',
            'selectedTags' => 'required|array|min:1',
        ]);

        try {
            $featuredMediaId = null;

            if ($this->featured_image) {
                $hashedName = Str::random(40) . '.' . $this->featured_image->getClientOriginalExtension();
                $path = $this->featured_image->storeAs('media', $hashedName, 'public');
             
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

            session()->flash('message', 'Post created successfully!');

            $this->resetForm();
            $this->dispatch('postSaved');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create post: ' . $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'status' => 'required|in:published,unpublished',
            'featured_image' => 'nullable|image|max:2048',
            'selectedCategories' => 'required|array|min:1',
            'selectedTags' => 'required|array|min:1',
        ]);

        try {
            $post = Post::findOrFail($this->id);
            $featuredMediaId = $post->featured_media;

            if ($this->featured_image) {
                if ($post->featuredImage) {
                    Storage::disk('public')->delete('media/' . $post->featuredImage->hash_name);
                    $post->featuredImage->delete();
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

            // Update post
            $post->update([
                'title' => $this->title,
                'content' => $this->content,
                'status' => $this->status,
                'featured_media' => $featuredMediaId,
            ]);

            // Sync relationships
            $post->categories()->sync($this->selectedCategories);
            $post->tags()->sync($this->selectedTags);
            // Update existing image for display
            $this->existingImage = $post->featuredImage?->hash_name;

            session()->flash('message', 'Post updated successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update post: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset([
            'id', 'title', 'content', 'status',
            'featured_image', 'existingImage',
            'selectedCategories', 'selectedTags'
        ]);
        
        $this->dispatch('resetTinyMCE');
    }

    public function refreshTinyMCE()
    {
        $this->dispatch('refreshTinyMCE');
    }

    public function openForm($id = null)
    {
        if ($id) {
            $this->loadPost($id);
        } else {
            $this->resetForm();
        }
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.posts.post-form', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }
}