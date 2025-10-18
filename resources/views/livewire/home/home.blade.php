<div>
  <section 
    x-data="{ 
      currentIndex: 0, 
      autoSlide() { setInterval(() => { this.next() }, 5000) }, 
      next() { this.currentIndex = (this.currentIndex + 1) % this.images.length }, 
      prev() { this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length }, 
      images: @js($medias->pluck('url')) 
    }" 
    x-init="autoSlide()"
    class="relative w-full bg-black flex justify-center overflow-hidden"
  >
    <div class="relative w-full max-w-7xl px-4 sm:px-6 lg:px-10 h-[70vh] sm:h-[80vh]">
      <template x-for="(image, index) in images" :key="index">
        <div 
          x-show="currentIndex === index" 
          x-transition:enter="transition ease-out duration-700"
          x-transition:enter-start="opacity-0 scale-105"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-700"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
          class="absolute inset-0"
        >
          <div 
            class="absolute inset-0 bg-center bg-cover scale-110 blur-2xl brightness-75"
            :style="`background-image: url(${image})`"
          ></div>

          <div class="absolute inset-0 flex items-center justify-center">
            <img 
              :src="image" 
              alt="Carousel Image"
              class="w-full h-full object-cover mx-auto lg:px-10"
              draggable="false"
            >
          </div>
        </div>
      </template>

      <button @click="prev()" class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full z-20" aria-label="Previous Slide">
        <i class="fa-solid fa-chevron-left"></i>
      </button>
      <button @click="next()" class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full z-20" aria-label="Next Slide">
        <i class="fa-solid fa-chevron-right"></i>
      </button>

      <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-20">
        <template x-for="(image, index) in images" :key="index">
          <button 
            @click="currentIndex = index"
            :class="currentIndex === index ? 'bg-yellow-400' : 'bg-white/50'"
            class="w-3 h-3 rounded-full transition-all duration-300"
          ></button>
        </template>
      </div>
    </div>
  </section>

  <section id="tentang-kami" class="bg-white py-16"
           x-data="{ visible: false }"
           x-intersect.once="visible = true"
           :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
           x-transition.duration.100ms
  >
    <div class="max-w-7xl mx-auto px-6 lg:px-10 flex flex-col lg:flex-row items-center gap-12">
      <div class="w-full lg:w-1/2 relative"
           :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
           x-transition.duration.100ms
      >
        <img src="https://placehold.co/800x600" alt="Tentang Kami" 
             class="rounded-2xl shadow-xl w-full object-cover transform transition duration-700"
        >
      </div>

      <div class="w-full lg:w-1/2 space-y-6">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#3C467B]"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
        >
          Tentang Kami
        </h2>
        <p class="text-gray-600 leading-relaxed text-justify"
           :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
        >
          <strong>Nagara AC Batang</strong> merupakan layanan profesional di bidang perawatan, perbaikan, dan instalasi pendingin ruangan (AC) yang berlokasi di Batang, Jawa Tengah. Kami berkomitmen memberikan pelayanan terbaik dengan teknisi berpengalaman dan peralatan modern untuk memastikan kenyamanan dan kepuasan pelanggan.
        </p>
        <p class="text-gray-600 leading-relaxed text-justify"
           :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
        >
          Dengan pengalaman bertahun-tahun, kami tidak hanya memperbaiki masalah AC Anda, tetapi juga memastikan performa optimal dan efisiensi energi jangka panjang.
        </p>
        <div>
          <a href="#layanan" class="inline-block px-6 py-3 bg-[#636CCB] text-white rounded-lg font-semibold hover:bg-[#6E8CFB] transition"
             :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
          >
            Pelajari Lebih Lanjut
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="layanan" class="py-20 bg-gradient-to-r from-[#f3f4fd] to-[#ffffff]"
          x-data="{ visible: false }"
          x-intersect.once="visible = true"
          :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
          x-transition.duration.100ms>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
      <h2 class="text-3xl sm:text-4xl font-extrabold text-[#3C467B] mb-6">Layanan Kami</h2>
      <p class="text-gray-600 mb-12 max-w-2xl mx-auto">
        Kami menyediakan berbagai layanan profesional untuk memenuhi kebutuhan perawatan dan instalasi AC di Batang. Setiap layanan dirancang untuk memberikan hasil optimal, efisien, dan terpercaya.
      </p>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Layanan 1 -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition text-center overflow-hidden"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
          <img src="https://placehold.co/800x400" alt="Pemasangan AC Unit Baru"
              class="w-full h-48 object-cover rounded-xl mb-4">
          <h3 class="font-semibold text-[#3C467B] mb-2">Pemasangan AC Unit Baru</h3>
          <p class="text-gray-600 text-sm">Pemasangan AC baru dengan standar profesional untuk hasil maksimal dan rapi.</p>
        </div>

        <!-- Layanan 2 -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition text-center overflow-hidden"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
          <img src="https://placehold.co/800x400" alt="Pergantian Suku Cadang"
              class="w-full h-48 object-cover rounded-xl mb-4">
          <h3 class="font-semibold text-[#3C467B] mb-2">Pergantian Suku Cadang</h3>
          <p class="text-gray-600 text-sm">Mengganti komponen rusak dengan suku cadang berkualitas asli.</p>
        </div>

        <!-- Layanan 3 -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition text-center overflow-hidden"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
          <img src="https://placehold.co/800x400" alt="Perawatan Berkala"
              class="w-full h-48 object-cover rounded-xl mb-4">
          <h3 class="font-semibold text-[#3C467B] mb-2">Perawatan Berkala</h3>
          <p class="text-gray-600 text-sm">Servis rutin agar AC tetap dingin, hemat energi, dan tahan lama.</p>
        </div>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 mt-8">
        <!-- Layanan 4 -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition text-center overflow-hidden"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
          <img src="https://placehold.co/1000x600" alt="Konsultasi"
              class="w-full h-64 object-cover rounded-xl mb-4">
          <h3 class="font-semibold text-[#3C467B] mb-2">Konsultasi</h3>
          <p class="text-gray-600 text-sm">Saran profesional agar AC Anda awet dan efisien sesuai kebutuhan ruangan.</p>
        </div>

        <!-- Layanan 5 -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition text-center overflow-hidden"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
          <img src="https://placehold.co/1000x600" alt="Layanan Antar Jemput"
              class="w-full h-64 object-cover rounded-xl mb-4">
          <h3 class="font-semibold text-[#3C467B] mb-2">Layanan Antar Jemput</h3>
          <p class="text-gray-600 text-sm">Kami siap menjemput dan mengantarkan unit AC Anda tanpa repot.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="gallery" class="py-20 bg-white"
           x-data="{ visible: false }"
           x-intersect.once="visible = true"
           :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
           x-transition.duration.100ms
  >
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#3C467B]">Gallery</h2>
        <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
          Bengkel kami dilengkapi dengan peralatan modern dan tim teknisi berpengalaman untuk memastikan setiap perawatan dan instalasi AC berjalan lancar dan profesional.
        </p>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach ($medias as $foto)
          <div class="overflow-hidden rounded-lg shadow-lg transition duration-700"
               :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            <img src="{{ asset($foto->url) }}" alt="{{ $foto->client_name }}" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105">
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section id="kontak" class="py-20 bg-gradient-to-r from-[#F0F4FF] to-[#FFFFFF]"
           x-data="{ visible: false }"
           x-intersect.once="visible = true"
           :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
           x-transition.duration.100ms
  >
    <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="bg-white p-8 rounded-2xl shadow-lg"
           :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#3C467B] mb-6">Hubungi Kami</h2>
        <p class="text-gray-600 mb-6">
          Isi form di bawah ini dan tim kami akan segera menghubungi Anda.
        </p>
        <form 
          x-data="{
            nama: '',
            email: '',
            pesan: '',
            kirimEmail() {
              const subject = encodeURIComponent(`Pesan dari ${this.nama || 'Pengunjung Website'}`);
              const body = encodeURIComponent(
                `Halo,\n\nNama: ${this.nama}\nEmail: ${this.email}\n\nPesan:\n${this.pesan}\n\nDikirim dari website Nagara AC Batang.`
              );
              const mailto = `mailto:info@nagaraacbatang.com?subject=${subject}&body=${body}`;
              window.location.href = mailto;
            }
          }"
          @submit.prevent="kirimEmail"
          class="space-y-4"
        >
          <div>
            <label class="block text-sm font-medium text-[#3C467B] mb-1">Nama</label>
            <input type="text" x-model="nama" required
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6E8CFB] focus:outline-none text-black"
                  placeholder="Nama Anda">
          </div>

          <div>
            <label class="block text-sm font-medium text-[#3C467B] mb-1">Pesan</label>
            <textarea x-model="pesan" required
                      class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6E8CFB] focus:outline-none text-black" 
                      rows="4" placeholder="Tulis pesan Anda"></textarea>
          </div>

          <button type="submit" 
                  class="w-full py-3 bg-[#6E8CFB] hover:bg-[#5570EB] text-white font-semibold rounded-lg transition">
            Kirim Pesan
          </button>
        </form>
      </div>

      <div class="h-80 lg:h-full rounded-2xl overflow-hidden shadow-lg"
           :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.795094774429!2d109.74323507576425!3d-6.915085067681538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7024a514c61401%3A0x9692a3d38261962f!2sSevice%20AC%20Mobil%20Pekalongan%20Batang%20(Nagara%20AC%20Mobil%20Batang)!5e0!3m2!1sid!2sid!4v1760628618234!5m2!1sid!2sid" 
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </section>
  <div 
    x-data="{ open: false }" 
    class="fixed bottom-6 right-6 z-50 flex flex-col items-end space-y-2"
  >
    <button 
      @click="open = !open"
      class="w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg flex items-center justify-center transition transform hover:scale-110"
    >
      <i class="fa-brands fa-whatsapp text-3xl"></i>
    </button>

    <template x-if="open">
      <div 
        x-transition.origin-bottom-right 
        class="flex flex-col items-end space-y-2 mb-2"
      >
        <a 
          href="https://wa.me/6281328715078?text=Saya%20menemukan%20web%20anda%20dan%20ingin%20berkomunikasi."
          target="_blank"
          class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-full shadow hover:bg-green-50 hover:text-green-700 transition text-sm font-medium"
        >
          Saya Menemukan Web Anda dan Ingin Berkomunikasi
        </a>

        <a 
          href="https://wa.me/6281328715078?text=Saya%20tertarik%20untuk%20pemasangan%20AC%20baru."
          target="_blank"
          class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-full shadow hover:bg-green-50 hover:text-green-700 transition text-sm font-medium"
        >
          Saya Tertarik untuk Pemasangan AC Baru
        </a>
      </div>
    </template>
  </div>
</div>
