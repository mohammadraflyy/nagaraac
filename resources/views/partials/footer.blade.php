<footer class="w-full bg-[#3C467B] text-white py-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

    <div class="space-y-4">
        <div class="flex justify-between items-center gap-5">
            <img src="{{ asset('logo.png')}}" alt="Nagara AC Batang Logo" class="h-12 rounded-full">
            <div>
              <h1 class="text-2xl font-extrabold text-white">NAGARA AC BATANG</h1>
              <p class="text-sm text-gray-300 italic">Since 1996</p>
            </div>
        </div>
        <p class="white text-sm text-justify">
            Nagara AC Batang menyediakan layanan profesional perawatan dan instalasi AC dengan kualitas terbaik dan teknisi berpengalaman.
        </p>
        <div class="flex gap-4 text-lg mt-2">
            <a href="https://www.facebook.com/nagaraacbatang1" target="_blank" class="hover:text-[#6E8CFB]"><i class="fa-brands fa-facebook-square"></i></a>
            <a href="https://www.instagram.com/nagaraac/" target="_blank" class="hover:text-[#6E8CFB]"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCT0TvnZHPZddWR7nL1lAwnw" target="_blank" class="hover:text-[#6E8CFB]"><i class="fa-brands fa-youtube"></i></a>
            <a href="https://www.tiktok.com/@nagaraac" target="_blank" class="hover:text-[#6E8CFB]"><i class="fa-brands fa-tiktok"></i></a>
        </div>
    </div>

    <div>
      <h3 class="text-lg font-semibold text-[#FFD700] mb-4">Layanan Kami</h3>
      <ul class="space-y-2 white text-sm">
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Pemasangan AC Unit Baru</a></li>
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Pergantian Suku Cadang</a></li>
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Perawatan Berkala</a></li>
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Konsultasi</a></li>
        <li><a href="#layanan" class="hover:text-[#6E8CFB]">Layanan Antar Jemput</a></li>
      </ul>
    </div>

    <div>
      <h3 class="text-lg font-semibold text-[#FFD700] mb-4">Kontak</h3>
      <ul class="space-y-2 white text-sm">
        <li>
          <a href="https://wa.me/6281328715078" target="_blank" class="flex items-center gap-2">
            <flux:icon.phone class="text-yellow-500" variant="micro"/>
            <span>(+62) 813-2871-5078</span>
          </a>
        </li>
        <li>
          <a href="mailto:info@nagaraacbatang.com?subject=Permintaan%20Informasi&body=Halo%2C%20saya%20ingin%20menanyakan%20tentang..." class="flex items-center gap-2">
            <flux:icon.envelope class="text-yellow-500" variant="micro" />
            <span>info@nagaraacbatang.com</span>
          </a>
        </li>
        <li class="flex items-center gap-2">
          <flux:icon.clock class="text-yellow-500" variant="micro"/>
          <span>Sen-Min: 08.00-16.30</span>
        </li>
      </ul>
    </div>

    <div>
      <h3 class="text-lg font-semibold text-[#FFD700] mb-4">Cabang Kami</h3>
      <ul class="space-y-3 text-sm">
        <li>
          <a href="https://maps.app.goo.gl/rL24asxA3RSqHtiH9" target="_blank" class="hover:text-[#6E8CFB] flex items-center gap-2">
            <flux:icon.map-pin />
            <span>NAGARA AC Batang</span>
          </a>
        </li>
        <li>
          <a href="https://maps.app.goo.gl/b3GFPbizLksTtLrH7" target="_blank" class="hover:text-[#6E8CFB] flex items-center gap-2">
            <flux:icon.map-pin />
            <span>NAGARA AC Limpung</span>
          </a>
        </li>
        <li>
          <a href="https://maps.app.goo.gl/1GxU7hzymtCXaQZE6" target="_blank" class="hover:text-[#6E8CFB] flex items-center gap-2">
            <flux:icon.map-pin />
            <span>NAGARA AC Wiradesa</span>
          </a>
        </li>
      </ul>
    </div>

  </div>

  <div class="mt-12 pt-6 text-center text-gray-300 text-sm">
    &copy; {{ date('Y') }} Nagara AC Batang. All rights reserved.
  </div>
</footer>
