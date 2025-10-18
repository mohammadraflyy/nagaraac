<?php

namespace App\Livewire\Testimonials;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Testimonial as ModelTestimonial;

class Testimonial extends Component
{
    public $nomor_polisi, $pelayanan, $durasi, $kesan, $saran;

    public function save()
    {
        $this->validate([
            'nomor_polisi' => 'required|string|max:10',
            'pelayanan' => 'required|integer|min:1|max:5',
            'durasi' => 'required|integer|min:1|max:5',
            'kesan' => 'required|string',
            'saran' => 'required|string',
        ]);

        ModelTestimonial::create([
            'id' => Str::uuid(),
            'nomor_polisi' => $this->nomor_polisi,
            'pelayanan' => $this->pelayanan,
            'durasi' => $this->durasi,
            'kesan' => $this->kesan,
            'saran' => $this->saran,
        ]);

        $this->reset();
        $this->dispatch('testimonial-success', 'Terima kasih! Testimonial Anda telah dikirim.');
    }

    #[Layout('components.layouts.blog')]
    public function render()
    {
        return view('livewire.testimonials.testimonial');
    }
}
