<style>
@keyframes queue {
  0%, 20% { opacity: 0; transform: translateY(100%); }
  25%, 45% { opacity: 1; transform: translateY(0); }
  50%, 100% { opacity: 0; transform: translateY(-100%); }
}

.animate-queue {
  opacity: 0;
  animation: queue 12s linear infinite;
  animation-fill-mode: both;
}

/* Delay agar muncul satu per satu */
.delay-4s { animation-delay: 4s; }
.delay-8s { animation-delay: 8s; }
</style>
<header class="w-full text-white" x-data="{ open: false }">
  <div class="bg-[#636CCB] relative z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 flex flex-col lg:flex-row justify-between items-center gap-4">
      <div class="flex justify-between items-center w-full lg:w-fit py-5">
        <div class="flex items-center gap-5">
          <img src="{{ asset('logo.png')}}" alt="Nagara AC Batang Logo" class="h-12 rounded-full">
          <div class="w-full">
            <h1 class="text-2xl font-extrabold text-white">NAGARA AC BATANG</h1>
          </div>
        </div>

        <button 
          @click="open = true" 
          class="text-white text-3xl lg:hidden focus:outline-none ml-2"
          aria-label="Toggle menu"
        >
          <flux:icon.bars-3-bottom-right />
        </button>
      </div>

      <div class="hidden lg:block text-sm w-full">
        <div class="py-5 rounded-lg">
          <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
            <div class="relative h-6 overflow-hidden w-1/2 text-sm font-semibold">
              <p class="absolute w-full text-left animate-queue">Selamat Datang di Nagara AC Batang.</p>
              <p class="absolute w-full text-left animate-queue delay-4s">Website dalam mode development.</p>
              <p class="absolute w-full text-left animate-queue delay-8s">Terimakasih sudah berkunjung di website kami.</p>
            </div>
            <div class="flex items-center gap-3">
              <span>Follow Us:</span>
              <div class="flex gap-2 text-lg">
                <a href="https://www.facebook.com/nagaraacbatang1" target="_blank" class="hover:text-gray-200"><i class="fa-brands fa-facebook-square"></i></a>
                <a href="https://www.instagram.com/nagaraac/" target="_blank" class="hover:text-gray-200"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.youtube.com/channel/UCT0TvnZHPZddWR7nL1lAwnw" target="_blank" class="hover:text-gray-200"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://www.tiktok.com/@nagaraac" target="_blank" class="hover:text-gray-200"><i class="fa-brands fa-tiktok"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="flex flex-wrap gap-8 pb-5 justify-between">
          <div class="flex items-center gap-4">
            <i class="fas fa-phone text-yellow-500 text-xl"></i>
            <a href="https://wa.me/6281328715078" target="_blank">
              <p class="font-semibold text-white">(+62) 813-2871-5078</p>
              <p class="text-sm">Chat & Call Us 24/7</p>
            </a>
          </div>

          <div class="flex items-center gap-4">
            <i class="far fa-envelope text-yellow-500 text-xl"></i>
            <a href="mailto:info@nagaraacbatang.com?subject=Permintaan%20Informasi&body=Halo%2C%20saya%20ingin%20menanyakan%20tentang..." target="_blank">
              <p class="font-semibold text-white">info@nagaraacbatang.com</p>
              <p class="text-sm">Kirim Pesan</p>
            </a>
          </div>

          <div class="flex items-center gap-4">
            <i class="far fa-clock text-yellow-500 text-xl"></i>
            <div>
              <p class="text-gray-400">Jam Kerja</p>
              <p class="font-semibold">Sen-Min: 08.00-16.30</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <nav class="bg-[#3C467B] relative z-10 hidden lg:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
      <div class="flex justify-between items-center">
        <ul class="flex gap-8 py-6 uppercase tracking-wide text-sm font-semibold text-white">
          <li><a href="{{ route('home') }}" class="hover:text-yellow-500">Home</a></li>
          <li><a href="#tentang-kami" class="hover:text-yellow-500">Tentang Kami</a></li>
          <li><a href="#layanan" class="hover:text-yellow-500">Layanan</a></li>
          <li><a href="#gallery" class="hover:text-yellow-500">Gallery</a></li>
          <li><a href="#" class="hover:text-yellow-500">Artikel</a></li>
          <li><a href="{{ route('testimonial')}}" class="hover:text-yellow-500">Testimoni</a></li>
          <li><a href="#kontak" class="hover:text-yellow-500">Kontak</a></li>
        </ul>
        <div class="flex items-center gap-2 text-yellow-500">
          <a href="{{ route('booking') }}" class="uppercase bg-yellow-500 text-sm rounded-full p-2 px-4 font-semibold text-white">
            BOOKING SERVICE
          </a>
        </div>
      </div>
    </div>
  </nav>

  <div 
    class="fixed inset-0 z-30 lg:hidden" 
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
  >
    <div class="absolute inset-0 bg-black bg-opacity-50" @click="open = false"></div>
    <div 
      class="absolute top-0 left-0 h-full w-72 bg-[#3C467B] p-6 overflow-y-auto flex flex-col gap-6"
      x-show="open"
      x-transition:enter="transition transform duration-300"
      x-transition:enter-start="-translate-x-full"
      x-transition:enter-end="translate-x-0"
      x-transition:leave="transition transform duration-200"
      x-transition:leave-start="translate-x-0"
      x-transition:leave-end="-translate-x-full"
    >
      <button @click="open = false" class="transition duration-300 ease-in-out p-2 hover:bg-gray-500 rounded-lg self-end text-white text-2xl">
        <flux:icon.x-mark />
      </button>
      <div class="flex flex-col gap-3">
        <span class="text-gray-300 font-semibold">Follow Us:</span>
        <div class="flex gap-3 text-lg">
          <a href="https://www.facebook.com/nagaraacbatang1" target="_blank" class="hover:text-yellow-500"><i class="fa-brands fa-square-facebook"></i></a>
          <a href="https://www.instagram.com/nagaraac/" target="_blank" class="hover:text-yellow-500"><i class="fa-brands fa-square-instagram"></i></a>
          <a href="https://www.youtube.com/channel/UCT0TvnZHPZddWR7nL1lAwnw" target="_blank" class="hover:text-yellow-500"><i class="fa-brands fa-square-youtube"></i></a>
          <a href="https://www.tiktok.com/@nagaraac" target="_blank" class="hover:text-yellow-500"><i class="fa-brands fa-tiktok"></i></a>
        </div>
      </div>
      <div class="flex flex-col gap-4 text-gray-300">
        <div class="flex items-center gap-3">
          <i class="fas fa-phone text-yellow-500 text-xl"></i>
          <div>
            <a href="https://wa.me/6281328715078" target="_blank">
              <p class="font-semibold text-white">(+62) 813-2871-5078</p>
              <p class="text-sm">Chat & Call Us 24/7</p>
            </a>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <i class="far fa-envelope text-yellow-500 text-xl"></i>
          <div>
            <a href="mailto:info@nagaraacbatang.com?subject=Permintaan%20Informasi&body=Halo%2C%20saya%20ingin%20menanyakan%20tentang..." target="_blank">
              <p class="font-semibold text-white">info@nagaraacbatang.com</p>
              <p class="text-sm">Kirim Pesan</p>
            </a>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <i class="far fa-clock text-yellow-500 text-xl"></i>
          <div>
            <p class="font-semibold text-white">Sen-Min: 08.00-17.00</p>
            <p class="text-sm">Jam Kerja</p>
          </div>
        </div>
      </div>

      <ul class="flex flex-col gap-4 uppercase font-semibold text-white">
        <li><a href="{{ route('home') }}" class="hover:text-yellow-500">Home</a></li>
        <li><a href="#tentang-kami" class="hover:text-yellow-500">Tentang Kami</a></li>
        <li><a href="#layanan-kami" class="hover:text-yellow-500">Layanan</a></li>
        <li><a href="#gallery" class="hover:text-yellow-500">Gallery</a></li>
        <li><a href="#" class="hover:text-yellow-500">Artikel</a></li>
        <li><a href="{{ route('testimonial')}}" class="hover:text-yellow-500">Testimoni</a></li>
        <li><a href="#kontak" class="hover:text-yellow-500">Kontak</a></li>
      </ul>

      <div class="flex items-center gap-2 text-yellow-500">
          <a href="{{ route('booking') }}" class="uppercase bg-yellow-500 text-sm rounded-full p-2 px-4 font-semibold text-white">
            BOOKING SERVICE
          </a>
      </div>
    </div>
  </div>
</header>
