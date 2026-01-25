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

    <div class="content-wrapper">

        @if (isset($missionData['high_productivity']))
            <a href="{{ url('/high-productivity') }}" class="mission-link">
                <div class="mission-card">
                    <div class="mission-banner">
                        <img src="{{ asset('assets/banner/3ID - High Productivity.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">High Productivity</div>
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
                        <img src="{{ asset('assets/banner/3ID - Low Productivity.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Low Productivity</div>
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
                        <img src="{{ asset('assets/banner/3ID - Low Stock.png') }}">
                    </div>

                    <div class="mission-body">
                        <div>
                            <div class="mission-title">Low Stock</div>
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
            <div class="mission-card">
                <div class="mission-banner">
                    <img src="{{ asset('assets/banner/3ID - ONO.png') }}">
                </div>

                <div class="mission-body">
                    <div>
                        <div class="mission-title">Low Stock</div>
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
        @endif

        <!-- PROGRAM -->
        <div class="section-title mt-4">Program Januari</div>

        <div class="banner-wrapper">
            <div id="serbuCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active"><img src="{{ asset('assets/banner/banner-1.png') }}"></div>
                    <div class="carousel-item"><img src="{{ asset('assets/banner/banner-2.png') }}"></div>
                    <div class="carousel-item"><img src="{{ asset('assets/banner/banner-3.png') }}"></div>
                    <div class="carousel-item"><img src="{{ asset('assets/banner/banner-4.png') }}"></div>
                </div>
            </div>
        </div>

        <div class="indicator-pill">
            <button class="active"></button>
            <button></button>
            <button></button>
            <button></button>
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
