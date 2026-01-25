<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SERBU Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .mission-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        body {
            margin: 0;
            background: #f4f4f4;
            font-family: 'Inter', system-ui, sans-serif;
        }

        .app-wrapper {
            min-height: 100vh;
            background: #ffffff;
        }

        /* HEADER */
        .app-header {
            background: #ffffff;
            padding: 14px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
        }

        .header-left {
            font-size: 20px;
            font-weight: 800;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
        }

        .badge-koin {
            background: #f3f4f6;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .user-pill {
            font-size: 14px;
            font-weight: 600;
        }

        .btn-setting {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        /* SETTINGS */
        .settings-popup {
            position: absolute;
            top: 42px;
            right: 0;
            width: 160px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 12px 30px rgba(0,0,0,.12);
            border: 1px solid #e5e7eb;
            display: none;
            z-index: 1000;
        }

        .logout-btn {
            all: unset;
            display: flex;
            width: 100%;
            padding: 12px 14px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #f3f4f6;
        }

        /* CONTENT */
        .content-wrapper {
            padding: 20px;
        }

        @media (min-width: 1200px) {
            .content-wrapper {
                max-width: 1100px;
                margin: auto;
            }
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 14px;
        }

        /* ===== MISSION WIDGET (COMPACT) ===== */
        .mission-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,.06);
            overflow: hidden;
            margin-bottom: 12px;
        }

        /* banner lebih pendek */
        .mission-banner {
            max-height: 110px;
            overflow: hidden;
        }

        .mission-banner img {
            width: 100%;
            height: 50px;
            object-fit: cover;
        }

        /* body lebih rapat */
        .mission-body {
            padding: 10px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mission-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .mission-reward {
            color: #afa6ad;
            font-weight: 700;
            font-size: 10px;
        }

        /* tombol panah lebih kecil */
        .mission-action {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #fc0000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        /* CAROUSEL */
        .banner-wrapper {
            border-radius: 16px;
            overflow: hidden;
        }

        .carousel-item img {
            width: 100%;
        }

        .indicator-pill {
            margin-top: 14px;
            background: #e5e7eb;
            padding: 6px 14px;
           border-radius: 999px;
            display: flex;
            gap: 10px;
            width: fit-content;
            margin-inline: auto;
        }

        .indicator-pill button {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #9ca3af;
            border: none;
            opacity: .6;
        }

        .indicator-pill button.active {
            background: #111827;
            opacity: 1;
        }

        /* STORY BUTTON */
        .story-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(15deg, #fff700, #f94df0); /* ring */
            padding: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
        }

        .story-dot {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #ffffff;        /* isi polos */
        }

        .story-btn img {
            width: 110%;
            height: 110%;
            object-fit: cover;
            transform: translateY(4%);
        }

        /* STORY MODAL */
        .story-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            z-index: 9999;
        }

        .story-img {
            width: 100%;
            height: 100%;
            object-fit: contain;     /* PENTING */
            padding: 16px;           /* ruang kiri kanan */
            background: transparent;
        }

        /* CLOSE BUTTON */
        .story-close {
            position: absolute;
            top: 14px;
            right: 14px;
            color: #fff;
            font-size: 26px;
            cursor: pointer;
            z-index: 10;
        }

        /* PROGRESS BAR */
        .story-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 4px;
            background: #22c55e;
            width: 0%;
            transition: width 5s linear;
        }

        .story-frame {
            max-width: 420px;        /* ukuran HP */
            margin: auto;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .story-progress-wrapper {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            display: flex;
            gap: 6px;
            z-index: 10;
        }

        .story-progress-bar {
            flex: 1;
            height: 3px;
            background: rgba(255,255,255,0.3);
            border-radius: 999px;
            overflow: hidden;
        }

        .story-progress-fill {
            height: 100%;
            width: 0%;
            background: #ffffff;
            transition: width 5s linear;
        }

        .story-click {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 50%;
            z-index: 9;
        }

        .story-click.left {
            left: 0;
        }

        .story-click.right {
            right: 0;
        }

    </style>
</head>
<body>

<div class="app-wrapper">

    <!-- HEADER -->
    <div class="app-header">
        <div class="header-left">
            <div class="story-btn" onclick="openStory()">
                <img src="{{ asset('assets/icon/icon.png') }}" alt="Story Head">
            </div>
        </div>

        <div class="header-right">
            <div class="badge-koin">
                <i class="bi bi-coin"></i>
                125.000
            </div>

            <div class="user-pill">
                {{ session('user.outlet_name') ?? '-' }}
            </div>

            <button class="btn-setting">
                <i class="bi bi-gear"></i>
            </button>

            <div class="settings-popup" id="settingsPopup">
                <form method="POST" action="/logout">
                    @csrf
                    <button class="logout-btn">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

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

<div class="story-modal" id="storyModal">
    <div class="story-progress-wrapper" id="storyProgressWrapper"></div>
    <div class="story-close" onclick="closeStory()">✕</div>

    <!-- CLICK AREA -->
    <div class="story-click left" onclick="prevStory()"></div>
    <div class="story-click right" onclick="nextStory()"></div>

    <div class="story-frame">
        <img id="storyImage" class="story-img">
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const carousel = document.getElementById('serbuCarousel');
    const dots = document.querySelectorAll('.indicator-pill button');
    const btnSetting = document.querySelector('.btn-setting');
    const popup = document.getElementById('settingsPopup');

    carousel.addEventListener('slid.bs.carousel', function (e) {
        dots.forEach(d => d.classList.remove('active'));
        dots[e.to].classList.add('active');
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            bootstrap.Carousel.getInstance(carousel).to(index);
        });
    });

    btnSetting.onclick = e => {
        e.stopPropagation();
        popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
    };

    document.onclick = () => popup.style.display = 'none';
    popup.onclick = e => e.stopPropagation();

    const stories = [
        "{{ asset('assets/KV/IM3-KV1.png') }}",
        "{{ asset('assets/KV/IM3-KV2.png') }}",
        "{{ asset('assets/KV/IM3-KV3.png') }}",
        "{{ asset('assets/KV/IM3-KV4.png') }}",
        "{{ asset('assets/KV/IM3-KV5.png') }}"
    ];

    let storyIndex = 0;
    let storyTimeout;

    function openStory() {
        storyIndex = 0;
        document.getElementById('storyModal').style.display = 'block';
        renderProgressBars();
        showStory();
    }

    function renderProgressBars() {
        const wrapper = document.getElementById('storyProgressWrapper');
        wrapper.innerHTML = '';

        stories.forEach(() => {
            const bar = document.createElement('div');
            bar.className = 'story-progress-bar';

            const fill = document.createElement('div');
            fill.className = 'story-progress-fill';

            bar.appendChild(fill);
            wrapper.appendChild(bar);
        });
    }

    function showStory() {
        const img = document.getElementById('storyImage');
        const fills = document.querySelectorAll('.story-progress-fill');

        img.src = stories[storyIndex];

        // reset semua
        fills.forEach((f, i) => {
            f.style.transition = 'none';
            f.style.width = i < storyIndex ? '100%' : '0%';
        });

        // animate aktif
        setTimeout(() => {
            fills[storyIndex].style.transition = 'width 5s linear';
            fills[storyIndex].style.width = '100%';
        }, 50);

        clearTimeout(storyTimeout);
        storyTimeout = setTimeout(() => {
            storyIndex++;
            if (storyIndex < stories.length) {
                showStory();
            } else {
                closeStory();
            }
        }, 5000);
    }

    function closeStory() {
        clearTimeout(storyTimeout);
        document.getElementById('storyModal').style.display = 'none';
    }

    function nextStory() {
        clearTimeout(storyTimeout);
        storyIndex++;

        if (storyIndex < stories.length) {
            showStory();
        } else {
            closeStory();
        }
    }

    function prevStory() {
        clearTimeout(storyTimeout);
        storyIndex--;

        if (storyIndex < 0) {
            storyIndex = 0;
        }

        showStory();
    }

</script>

</body>
</html>
