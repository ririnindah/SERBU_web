<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SERBU Web</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('assets/icon/image.png') }}">

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

    @if ($brand == '3ID' && $isRedeemed == 0)
        <div class="container-action">
            <a href="{{ url('/redeem-koin') }}" class="btn-primary-black" style="text-decoration: none;">
                <svg class="icon-gift" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 12 20 22 4 22 4 12"></polyline>
                    <rect x="2" y="7" width="20" height="5"></rect>
                    <line x1="12" y1="22" x2="12" y2="7"></line>
                    <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                    <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                </svg>
                Redeem Koin Sekarang
            </a>
        </div>
    @else
        <div class="card-process">
            <div class="card-process-body">
                <div class="icon-process">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"></path>
                    </svg>
                </div>
                <div class="text-process">
                    <p class="process-title">Redeem Sedang Diproses</p>
                    <p class="process-desc">Redeem KOIN sejumlah 
                        <strong>{{ number_format($jumlahKoinRedeem ?? 0, 0, ',', '.') }}</strong> 
                        sedang dalam proses.</p>
                </div>
            </div>
            <div class="process-shimmer"></div>
        </div>
    @endif

    @if(session('success'))
        <div class="alert-success-container">
            <div class="alert-content">
                <div class="icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div class="alert-text-group">
                    <span class="alert-title">Berhasil!</span>
                    <span class="alert-msg">{{ session('success') }}</span>
                </div>
            </div>
            <div class="progress-bar"></div>
        </div>
    @endif

    {{-- @dd($missionData['low_productivity_rebuy']['target']) --}}

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
                                @if ($missionData['high_productivity']['actual'] >= $missionData['high_productivity']['target'])
                                    Selamat Telah Menyelesaikan 5 Misi
                                @else
                                    IDR {{ number_format($missionData['high_productivity']['remaining'], 0, ',', '.') }}
                                    lagi untuk mendapatkan
                                    KOIN {{ number_format($missionData['high_productivity']['incentive'], 0, ',', '.') }}
                                @endif
                            </div>
                        </div>

                        <div class="mission-action">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        @if (isset($missionData['low_productivity_voucher']))
            <a href="{{ url('/low-productivity-voucher') }}" class="mission-link">
                <div class="mission-card">
                    <div class="mission-banner">
                        <img src="{{ asset('assets/banner/' . (session('user.brand') ?? 'default') . ' - Low Productivity Voucher.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Misi Kejar Transaksi Voucher</div>
                            <div class="mission-reward">
                                @if ($missionData['low_productivity_voucher']['actual'] >= $missionData['low_productivity_voucher']['target'])
                                    Selamat Telah Menyelesaikan 5 Misi
                                @else
                                    {{ number_format($missionData['low_productivity_voucher']['remaining'], 0, ',', '.') }}
                                    hit lagi untuk mendapatkan
                                    KOIN {{ number_format($missionData['low_productivity_voucher']['incentive'], 0, ',', '.') }}
                                @endif
                            </div>
                        </div>

                        <div class="mission-action">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        @if (isset($missionData['low_productivity_rebuy']))
            <a href="{{ url('/low-productivity-rebuy') }}" class="mission-link">
                <div class="mission-card">
                    <div class="mission-banner">
                        <img src="{{ asset('assets/banner/' . (session('user.brand') ?? 'default') . ' - Low Productivity Rebuy.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Misi Kejar Transaksi Rebuy</div>
                            <div class="mission-reward">
                                @if ($missionData['low_productivity_rebuy']['actual'] >= $missionData['low_productivity_rebuy']['target'])
                                    Selamat Telah Menyelesaikan 5 Misi
                                @else
                                    {{ number_format($missionData['low_productivity_rebuy']['remaining'], 0, ',', '.') }}
                                    hit lagi untuk mendapatkan
                                    KOIN {{ number_format($missionData['low_productivity_rebuy']['incentive'], 0, ',', '.') }}
                                @endif
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
                                KOIN {{ number_format($missionData['low_stock']['incentive'], 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="mission-action">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        {{-- @if (isset($missionData['ono']))
            <a href="{{ url('/outlet-baru') }}" class="mission-link">
                <div class="mission-card">
                    <div class="mission-banner">
                        <img src="{{ asset('assets/banner/' . (session('user.brand') ?? 'default') . ' - ONO.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Outlet Baru</div>
                            <div class="mission-reward">
                                IDR {{ number_format($missionData['ono']['remaining'], 0, ',', '.') }}
                                sellin lagi untuk mendapatkan
                                IDR {{ number_format($missionData['ono']['incentive'], 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="mission-action">
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endif --}}

        <!-- PROGRAM -->
        <div class="section-title mt-4">Program Februari</div>

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

    setTimeout(function() {
        let alert = document.querySelector('.alert-success-container');
        if (alert) {
            alert.style.transition = "all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
            alert.style.opacity = "0";
            alert.style.transform = "translateY(-20px)"; // Efek melayang naik saat hilang
            setTimeout(() => alert.remove(), 600);
        }
    }, 4000);

</script>

</body>
</html>
