<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SERBU Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/serbu.css') }}">

</head>
<body>

<div class="app-wrapper">

    <!-- HEADER -->
    @include('partials.header')

    @php
        $brandClass = session('user.brand') === '3ID'
            ? 'brand-3id'
            : (session('user.brand') === 'IM3' ? 'brand-im3' : '');


        $brand = session('user.brand') ?? 'IM3';
        $maxBanner = 5;
        $banners = [];

        for ($i = 1; $i <= $maxBanner; $i++) {
            $path = public_path("assets/banner/banner-{$i}-{$brand}.png");

            if (file_exists($path)) {
                $banners[] = asset("assets/banner/banner-{$i}-{$brand}.png");
            }
        }
    @endphp

    <!-- Button Active -->
    <div class="mission-tabs">
        <a href="{{ url('/serbu') }}"
        class="mission-tab {{ $brandClass }} {{ request()->is('serbu') ? 'active' : '' }}">
            Berjalan
        </a>

        <a href="{{ url('/serbu-ach') }}"
        class="mission-tab {{ $brandClass }} {{ request()->is('serbu-ach') ? 'active' : '' }}">
            Selesai
        </a>
    </div>

    <div class="content-wrapper">

        @if (isset($missionData['high_productivity']))
            <a href="{{ url('/high-productivity') }}" class="mission-link">
                <div class="mission-card">
                    <div class="mission-banner">
                        <img src="{{ asset('assets/banner/' . (session('user.brand') ?? 'default') . ' - High Productivity.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Misi Kejar Target</div>
                            <div class="mission-reward">
                                IDR {{ number_format($missionData['high_productivity']['remaining'], 0, ',', '.') }}
                                lagi untuk mendapatkan
                                IDR {{ number_format($missionData['high_productivity']['incentive'], 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="mission-action">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        @if (isset($missionData['low_productivity']))
            <a href="{{ url('/low-productivity') }}" class="mission-link">
                <div class="mission-card">
                    <div class="mission-banner">
                        <img src="{{ asset('assets/banner/' . (session('user.brand') ?? 'default') . ' - Low Productivity.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Misi Kejar Transaksi</div>
                            <div class="mission-reward">
                                IDR {{ number_format($missionData['low_productivity']['remaining'], 0, ',', '.') }}
                                lagi untuk mendapatkan
                                IDR {{ number_format($missionData['low_productivity']['incentive'], 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="mission-action">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        @if (isset($missionData['low_stock']))
            <a href="{{ url('/low-stock') }}" class="mission-link">
                <div class="mission-card">
                    <div class="mission-banner">
                        <img src="{{ asset('assets/banner/' . (session('user.brand') ?? 'default') . ' - Low Stock.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Misi Kejar Target Saldo</div>
                            <div class="mission-reward">
                                {{ number_format($missionData['low_stock']['remaining'], 0, ',', '.') }}
                                hari lagi untuk mendapatkan
                                IDR {{ number_format($missionData['low_stock']['incentive'], 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="mission-action">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        @if (isset($missionData['ono']))
            <a href="{{ url('/outlet-baru') }}" class="mission-link">
                <div class="mission-card">
                    <div class="mission-banner">
                        <img src="{{ asset('assets/banner/' . (session('user.brand') ?? 'default') . ' - ONO.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Outlet Baru</div>
                            <div class="mission-reward">
                                {{ number_format($missionData['ono']['remaining'], 0, ',', '.') }}
                                hit lagi untuk mendapatkan
                                IDR {{ number_format($missionData['ono']['incentive'], 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="mission-action">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        <!-- PROGRAM -->
        <div class="section-title mt-4">Program Januari</div>

        <div class="banner-wrapper">
            <div id="serbuCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ $banner }}" class="d-block w-100" alt="Banner {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="indicator-pill" id="carouselIndicators">
            @foreach ($banners as $index => $banner)
                <button 
                    class="{{ $index === 0 ? 'active' : '' }}" 
                    data-slide="{{ $index }}">
                </button>
            @endforeach
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const carousel = document.getElementById('serbuCarousel');
    const dots = document.querySelectorAll('.indicator-pill button');

    carousel.addEventListener('slid.bs.carousel', function (e) {
        dots.forEach(d => d.classList.remove('active'));
        dots[e.to].classList.add('active');
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            bootstrap.Carousel.getInstance(carousel).to(index);
        });
    });

</script>

</body>
</html>
