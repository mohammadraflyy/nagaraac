<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <title>{{ $data['appName'] }} — Dalam Perbaikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-white dark:bg-neutral-900 flex flex-col lg:flex-row items-center justify-center">

    <div class="flex-1 flex flex-col items-center justify-center text-center space-y-6 p-8">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">
            Website Sedang Dalam Perbaikan
        </h1>

        <p class="text-gray-600 dark:text-gray-400">
            Kami sedang melakukan pemeliharaan sistem.<br>
            Silakan kembali lagi nanti.
        </p>

        <div id="countdown" class="text-2xl font-semibold text-gray-700 dark:text-gray-200"></div>

        <div id="finished" class="text-2xl font-semibold text-green-600 dark:text-green-400 hidden">
            Website sudah aktif kembali!
        </div>

        <p class="text-sm text-gray-400 dark:text-gray-500">
            Hingga 20 Oktober 2025, 00:00 WIB
        </p>
    </div>

    <div class="flex-1 relative w-full h-1/2 lg:h-full overflow-hidden">
        @php
            $images = $data['image']->pluck('hash_name');
        @endphp

        @foreach ($images as $index => $img)
            <div 
                class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0"
                style="background-image: url('{{ asset('storage/media/' . $img) }}');"
            ></div>
        @endforeach

        <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <script>
        const countdownEl = document.getElementById('countdown');
        const finishedEl = document.getElementById('finished');
        const targetTime = new Date('2025-10-20T00:00:00+07:00').getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetTime - now;

            if (distance <= 0) {
                countdownEl.classList.add('hidden');
                finishedEl.classList.remove('hidden');
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.textContent = `${days} hari ${hours} jam ${minutes} menit ${seconds} detik`;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;

        if (slides.length > 0) {
            slides[0].classList.add('opacity-100');

            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('opacity-100');
            }, 5000);
        }
    </script>
</body>
</html>
