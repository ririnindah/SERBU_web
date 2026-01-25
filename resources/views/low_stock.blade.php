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

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 14px;
            margin-top: 20px;
        }

        .mission-banner {
            width: 100%;
        }

        .mission-banner img {
            width: 100%;
            height: 75px;      /* ikut ukuran asli */
            display: block;
            margin-bottom: 20px;
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

        .mission-desc {
            font-size: 13px;
            color: #6B7280;
            line-height: 1.6;
            margin-bottom: 14px; /* jarak ke bar */
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

        .performance-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 6px 16px rgba(0,0,0,.08);
            margin-bottom: 24px;
            margin-top: 18px;
        }

        .performance-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 10px;
        }

        .performance-actual {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
        }

        .performance-target {
            font-size: 10px;
            font-weight: 600;
            color: #020202;
        }

        .performance-text {
            margin-top: 18px;
            font-size: 12px;
            font-weight: 600;
            color: #3d3d3d;
        }

        .performance-incentive {
            font-size: 15px;
            font-weight: 600;
            color: #3d3d3d;
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
            z-index: 2000;
        }

        .performance-popup-card {
            background: rgba(255,255,255,.95);
            border-radius: 14px;
            padding: 24px 28px;
            width: 90%;
            max-width: 420px;
            box-shadow: 0 30px 60px rgba(0,0,0,.25);
        }

        .performance-popup-title {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 10px;
        }

        .performance-popup-desc {
            font-size: 14px;
            color: #374151;
            line-height: 1.6;
        }

        .high { background: #4AA6AD; }
        .bubble-high { background: #4AA6AD; }

        @media (min-width: 1200px) {
            .content-wrapper {
                max-width: 1100px;
                margin: auto;
            }
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
            <div class="user-pill">
                {{ session('user.outlet_name') ?? '-' }}
            </div>
            <button class="btn-setting"><i class="bi bi-gear"></i></button>

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
        
        <div class="mission-high-productivy">
            <div class="mission-banner">
                <img src="{{ asset('assets/banner/banner-landing.png') }}">
            </div>

            <div class="section-title mt-2">Low Stock</div>

            @php
                $missionFlag = $actual->flag_mission ?? 0;
                $missionStatus = $actual->mission_status ?? 0;
                $targetValue = $target->{'target'.$missionFlag} ?? 0;
                $actualValue = $actual->actual ?? 0;
                $incentive = $target->{'incentive'.$missionFlag} ?? 0;

                $percentage = $targetValue > 0
                    ? min(($actualValue / $targetValue) * 100, 100)
                    : 0;

                $sisaHari = max(($targetValue) - ($actual->actual ?? 0), 0);
            @endphp

            {{-- MISI 1 --}}
            <div class="performance-card">
                <div class="performance-header">
                    <div class="performance-actual">
                        {{ number_format($targetValue, 0, ',', '.') }}
                    </div>
                    <div class="performance-target">
                        {{ number_format($actualValue ?? 0, 0, ',', '.') }}
                    </div>
                </div>

                <div class="performance-row">
                    <div class="performance-bar">
                        <div class="performance-fill high" style="width: {{ $percentage }}%">
                            <div class="performance-bubble bubble-high">
                                {{ number_format($percentage, 0) }}%
                            </div>
                        </div>
                    </div>

                    <div class="performance-text">
                        @if ($sisaHari == 0 && $missionStatus == 1)
                            Selamat anda mendapatkan incentive sebesar
                        @else
                            Kejar {{ number_format($sisaHari, 0, ',', '.') }} hari untuk dapatkan incentive
                        @endif
                    </div>
                    {{-- {{ dd($incentive) }} --}}
                    <div class="performance-incentive">
                        IDR {{ number_format($incentive, 0, ',', '.') }}
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const dots = document.querySelectorAll('.indicator-pill button');
    const btnSetting = document.querySelector('.btn-setting');
    const popup = document.getElementById('settingsPopup');

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
</script>

</body>
</html>
