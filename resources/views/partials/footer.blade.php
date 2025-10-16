<!-- Footer -->
<footer class="w-full bg-[#3C467B] text-white py-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

    <!-- Logo & Deskripsi -->
    <div class="space-y-4">
        <div class="flex justify-between items-center gap-5">
            <img src="{{ asset('logo.png')}}" alt="Nagara AC Batang Logo" class="h-12 rounded-full">
            <h1 class="text-2xl font-extrabold text-white">NAGARA AC BATANG</h1>
        </div>
        <p class="white text-sm">
            Nagara AC Batang menyediakan layanan profesional perawatan dan instalasi AC dengan kualitas terbaik dan teknisi berpengalaman.
        </p>
        <div class="flex gap-4 text-lg mt-2">
            <a href="#" class="hover:text-[#6E8CFB]"><i class="fa-brands fa-facebook-square"></i></a>
            <a href="#" class="hover:text-[#6E8CFB]"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="hover:text-[#6E8CFB]"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" class="hover:text-[#6E8CFB]"><i class="fa-brands fa-tiktok"></i></a>
        </div>
    </div>

    <!-- Layanan -->
    <div>
      <h3 class="text-lg font-semibold text-[#FFD700] mb-4">Layanan Kami</h3>
      <ul class="space-y-2 white text-sm">
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Perawatan AC</a></li>
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Instalasi AC</a></li>
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Perbaikan AC</a></li>
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Konsultasi & Tips</a></li>
      </ul>
    </div>

    <!-- Kontak -->
    <div>
      <h3 class="text-lg font-semibold text-[#FFD700] mb-4">Kontak</h3>
      <ul class="space-y-2 white text-sm">
        <li class="flex items-center gap-2">
          <i class="far fa-envelope text-yellow-500"></i>
          <span>info@nagaraacbatang.com</span>
        </li>
        <li class="flex items-center gap-2">
          <i class="fas fa-phone text-yellow-500"></i>
          <span>(+62) 852-8108-0861</span>
        </li>
        <li class="flex items-center gap-2">
          <i class="far fa-clock text-yellow-500"></i>
          <span>Sen-Min: 08.00-17.00</span>
        </li>
      </ul>
    </div>

    <!-- Alamat & Map -->
    <div>
      <h3 class="text-lg font-semibold text-[#FFD700] mb-4">Lokasi</h3>
      <p class="white text-sm mb-4">
        Jl. Pahlawan No.123, Batang, Jawa Tengah, Indonesia
      </p>
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.795094774429!2d109.74323507576425!3d-6.915085067681538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7024a514c61401%3A0x9692a3d38261962f!2sSevice%20AC%20Mobil%20Pekalongan%20Batang%20(Nagara%20AC%20Mobil%20Batang)!5e0!3m2!1sid!2sid!4v1760628618234!5m2!1sid!2sid" 
        class="w-full h-32 rounded-lg border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

  </div>

  <!-- Copyright -->
  <div class="mt-12 pt-6 text-center text-gray-300 text-sm">
    &copy; {{ date('Y') }} Nagara AC Batang. All rights reserved.
  </div>
</footer>
