<?php

namespace App\Livewire\Home;

use Livewire\Attributes\Layout;
use App\Models\Media;
use Livewire\Component;

class Home extends Component
{
    #[Layout('components.layouts.blog')] 
    public function render()
    {
        return view('livewire.home.home', [
            'medias' => Media::where('media_type', 'galleries')
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}
