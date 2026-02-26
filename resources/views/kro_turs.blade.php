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
    <link rel="stylesheet" href="{{ asset('css/kro_turs.css') }}">

</head>
<body>

<div class="app-wrapper">

    <!-- HEADER -->
    @include('partials.header')

    @php
        $hit = $actual->hit ?? 0;
        $as_of = $actual->as_of ?? 0;
        $amount = $actual->amount ?? 0;

        $remaining = $maxHit - $hit ?? 0;
        $remainingPersen = ($maxHit > 0) ? ($hit / $maxHit) * 100 : 0;
    @endphp

    <div class="content-wrapper">

        <div class="mission-high-productivy">
            <div class="mission-banner">
                <img src="{{ asset('assets/CTA/' . (session('user.brand') ?? 'default') . ' - KRO Turs.png') }}">
            </div>

            <div class="status-date">
                Data per tanggal: 
                {{ \Carbon\Carbon::parse($as_of)->translatedFormat('d F Y') }}
            </div>

            {{-- INCENTIVE CARD --}}
            <div class="incentive-card">

                <div class="incentive-header">
                    <span class="incentive-title">Total Insentif yang didapatkan</span>
                    
                    <div class="incentive-row">
                        <div class="coin-icon">
                            <img src="{{ asset('assets/icon/koin.png') }}" alt="coin">
                        </div>
                        <div class="incentive-value">Rp 
                            {{ number_format($incentive, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD PROGRESS --}}
            <div class="progress-card">
                <h2 class="card-title">Kuota Program Terpakai</h2>

                <div class="progress-container">
                    <div class="tooltip-container" style="left: {{ $remainingPersen }}%;">
                        <div class="tooltip-bubble">
                            Remaining: 
                            {{ number_format($remaining, 0, ',', '.') }}
                        </div>
                    </div>
                    
                    <div class="progress-bar-main">
                        <div class="progress-fill" style="width: {{ $remainingPersen }}%;">
                            {{ number_format($hit, 0, ',', '.') }}
                            dari 
                            {{ number_format($maxHit, 0, ',', '.') }}
                        </div>
                        <div class="progress-remaining"></div>
                    </div>
                </div>

                {{-- <div class="stats-row">
                    <div>
                        <span class="label">Actual</span>
                        <div class="value">18</div>
                    </div>
                    <div style="text-align: right;">
                        <span class="label">Max</span>
                        <div class="value">
                            {{ number_format($maxHit, 0, ',', '.') }}
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="divider"></div> --}}

                {{-- <div class="footer-text">
                    18 
                    dari 
                    {{ number_format($maxHit, 0, ',', '.') }}
                </div> --}}
            </div>

            <!-- TnC Section -->
            <div class="tnc">
                <strong>Syarat & Ketentuan Kejar Pelanggan Baru</strong>
                <ul>
                    <li>Periode program: 20 – 28 Februari 2026.</li>
                    <li>Cashback akan diberikan untuk Pelanggan Baru bundling CVM</li>
                    <li>Pembelian Paket Isi Ulang CVM di outlet yang sama dengan aktivasi SP 3GB</li>
                    <li>Pelanggan baru aktivasi SP 3GB</li>
                    <li>Berlaku per outlet maksimal 100 hit</li>
                    <li>Cashback akan dibayarkan M+1</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script>

</script>
</body>
</html>