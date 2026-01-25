<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SERBU Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font: INTER (FORMAL) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #f4f4f4;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .app-wrapper {
            min-height: 100vh;
            background: #ffffff;
        }

        /* ===== HEADER (SIMPLE & POLOS) ===== */
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
            color: #111827;
            letter-spacing: .2px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .badge-koin {
            background: #f3f4f6;
            color: #111827;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
        }

        .user-pill {
            font-weight: 600;
            font-size: 14px;
            color: #374151;
        }

        .btn-setting {
            background: transparent;
            border: none;
            color: #374151;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
        }

        .btn-setting:hover {
            color: #111827;
        }

        /* ===== SETTINGS POPUP (ADD-ON ONLY) ===== */
        .settings-popup {
            position: absolute;
            top: 34px;
            right: 0;
            width: 160px;
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(8px);
            border-radius: 10px;
            box-shadow: 0 12px 30px rgba(0,0,0,.12);
            border: 1px solid #e5e7eb;
            display: none;
            z-index: 999;
        }

        .settings-popup a {
            display: flex;
            align-items: center;
            padding: 12px 14px;
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            text-decoration: none;
        }

        .settings-popup a:hover {
            background: #f3f4f6;
        }

        /* ===== CONTENT ===== */
        .content-wrapper {
            padding: 20px;
        }

        @media (min-width: 1200px) {
            .content-wrapper {
                max-width: 1100px;
                margin: auto;
            }
        }

        /* ===== SECTION ===== */
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 14px;
            color: #111827;
        }

        /* ======================
           PERFORMANCE
        ====================== */

        .performance-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 6px 16px rgba(0,0,0,.08);
            margin-bottom: 24px;
        }

        .performance-row {
            margin-bottom: 18px;
        }

        .performance-row:last-child {
            margin-bottom: 0;
        }

        .performance-label {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: #374151;
        }

        .performance-bar {
            position: relative;
            height: 14px;
            background: #e5e7eb;
            border-radius: 999px;
        }

        .performance-fill {
            height: 100%;
            border-radius: 999px;
            position: relative;
        }

        .performance-bubble {
            position: absolute;
            right: -18px;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #ffffff;
            font-size: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,.2);
        }

        .performance-popup {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.35);
            backdrop-filter: blur(6px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 2000;
        }

        .performance-popup-card {
            background: rgba(255,255,255,.96);
            border-radius: 16px;
            padding: 26px 30px;

            width: 100%;
            max-width: 560px;      /* 🔥 DESKTOP LEBIH LEBAR */
            max-height: 85vh;
            overflow-y: auto;

            box-shadow: 0 30px 60px rgba(0,0,0,.25);
        }

        /* TITLE */
        .performance-popup-title {
            font-size: 18px;       /* 🔥 lebih proporsional di laptop */
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
        }

        /* DESC */
        .performance-popup-desc {
            font-size: 15px;
            color: #374151;
            line-height: 1.65;
        }

        .high { background: #4AA6AD; }
        .low { background: #F59E0B; }
        .stock { background: #EF4444; }
        .new { background: #10B981; }

        .bubble-high { background: #4AA6AD; }
        .bubble-low { background: #F59E0B; }
        .bubble-stock { background: #EF4444; }
        .bubble-new { background: #10B981; }

        /* ======================
           CAROUSEL
        ====================== */

        .banner-wrapper {
            border-radius: 16px;
            overflow: hidden;
            background: #eee;
        }

        .carousel-item img {
            width: 100%;
            height: auto;
            display: block;
        }

        .indicator-pill {
            margin-top: 14px;
            background: #e5e7eb;
            padding: 6px 14px;
            border-radius: 999px;
            display: flex;
            justify-content: center;
            gap: 10px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
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

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            all: unset;
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #f3f4f6;
        }
    </style>
</head>
<body>

<div class="app-wrapper">

    <!-- HEADER -->
    <div class="app-header">
        <div class="header-left">SERBU</div>

        <div class="header-right">
            <div class="badge-koin">1250 Koin</div>
            <div class="user-pill">Vialli Cell</div>
            <button class="btn-setting" title="Settings">
                <i class="bi bi-gear"></i>
            </button>

            <!-- SETTINGS POPUP -->
            <div class="settings-popup" id="settingsPopup">
                <form method="POST" action="/logout" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="content-wrapper">

        <div class="section-title">Performance</div>

        <div class="performance-card">

            <div class="performance-row">
                <div class="performance-label">High Productivity</div>
                <div class="performance-bar">
                    <div class="performance-fill high" style="width:65%">
                        <div class="performance-bubble bubble-high">65%</div>
                    </div>
                </div>
            </div>

            <div class="performance-row">
                <div class="performance-label">Low Productivity</div>
                <div class="performance-bar">
                    <div class="performance-fill low" style="width:40%">
                        <div class="performance-bubble bubble-low">40%</div>
                    </div>
                </div>
            </div>

            <div class="performance-row">
                <div class="performance-label">Low Stock</div>
                <div class="performance-bar">
                    <div class="performance-fill stock" style="width:25%">
                        <div class="performance-bubble bubble-stock">25%</div>
                    </div>
                </div>
            </div>

            <div class="performance-row">
                <div class="performance-label">Outlet Baru</div>
                <div class="performance-bar">
                    <div class="performance-fill new" style="width:15%">
                        <div class="performance-bubble bubble-new">15%</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="section-title">Program Januari</div>

        <div class="banner-wrapper">
            <div id="serbuCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/banner/banner-1.png') }}">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/banner/banner-2.png') }}">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/banner/banner-3.png') }}">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/banner/banner-4.png') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="indicator-pill">
            <button class="active"></button>
            <button></button>
            <button></button>
            <button></button>
        </div>

        <!-- PERFORMANCE HIGH POPUP -->
        <div class="performance-popup" id="performanceHighPopup">
            <div class="performance-popup-card">
                <div class="performance-popup-title">
                    Performance High Productivity
                </div>
                <div class="performance-popup-desc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident unde ipsum voluptatum quam maxime, delectus commodi, corrupti veritatis, tempore illo doloribus. Magnam ut molestiae, aliquid quas tenetur iure tempora totam?
                </div>
            </div>
        </div>

        <!-- PERFORMANCE LOW PRODUCTIVITY POPUP -->
        <div class="performance-popup" id="performanceLowPopup">
            <div class="performance-popup-card">
                <div class="performance-popup-title">
                    Performance Low Productivity
                </div>
                <div class="performance-popup-desc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Kinerja outlet berada di bawah rata-rata dan perlu peningkatan.
                </div>
            </div>
        </div>

        <!-- PERFORMANCE LOW STOCK POPUP -->
        <div class="performance-popup" id="performanceStockPopup">
            <div class="performance-popup-card">
                <div class="performance-popup-title">
                    Performance Low Stock
                </div>
                <div class="performance-popup-desc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Stok produk di outlet ini tergolong rendah.
                </div>
            </div>
        </div>

        <!-- PERFORMANCE OUTLET BARU POPUP -->
        <div class="performance-popup" id="performanceNewPopup">
            <div class="performance-popup-card">
                <div class="performance-popup-title">
                    Performance Outlet Baru
                </div>
                <div class="performance-popup-desc">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Outlet baru memerlukan waktu adaptasi untuk mencapai performa optimal.
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const carousel = document.getElementById('serbuCarousel');
    const dots = document.querySelectorAll('.indicator-pill button');
    const btnSetting = document.querySelector('.btn-setting');
    const popup = document.getElementById('settingsPopup');

    const highBar = document.querySelector('.performance-fill.high');
    const lowBar   = document.querySelector('.performance-fill.low');
    const stockBar = document.querySelector('.performance-fill.stock');
    const newBar   = document.querySelector('.performance-fill.new');

    const lowPopup   = document.getElementById('performanceLowPopup');
    const stockPopup = document.getElementById('performanceStockPopup');
    const newPopup   = document.getElementById('performanceNewPopup');
    const highPopup = document.getElementById('performanceHighPopup');

    carousel.addEventListener('slid.bs.carousel', function (e) {
        dots.forEach(d => d.classList.remove('active'));
        dots[e.to].classList.add('active');
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            bootstrap.Carousel.getInstance(carousel).to(index);
        });
    });

    btnSetting.addEventListener('click', function (e) {
        e.stopPropagation();
        popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function () {
        popup.style.display = 'none';
    });

    popup.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    highBar.addEventListener('click', function (e) {
        e.stopPropagation();
        highPopup.style.display = 'flex';
    });

    lowBar.addEventListener('click', function (e) {
        e.stopPropagation();
        lowPopup.style.display = 'flex';
    });

    stockBar.addEventListener('click', function (e) {
        e.stopPropagation();
        stockPopup.style.display = 'flex';
    });

    newBar.addEventListener('click', function (e) {
        e.stopPropagation();
        newPopup.style.display = 'flex';
    });

    highPopup.addEventListener('click', function () {highPopup.style.display = 'none';});
    lowPopup.addEventListener('click', () => lowPopup.style.display = 'none');
    stockPopup.addEventListener('click', () => stockPopup.style.display = 'none');
    newPopup.addEventListener('click', () => newPopup.style.display = 'none');
    
</script>

</body>
</html>
