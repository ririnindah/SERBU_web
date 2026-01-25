<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SERBU Ach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/serbu-ach.css') }}">

</head>
<body>

    <div class="app-wrapper">

        <!-- HEADER -->
        @include('partials.header')

        @php
            $brandClass = session('user.brand') === '3ID'
                ? 'brand-3id'
                : (session('user.brand') === 'IM3' ? 'brand-im3' : '');
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

        <div class="incentive-summary">
            Total KOIN tercapai
            <span>
                IDR {{ number_format($totalIncentiveAch, 0, ',', '.') }}
            </span>
        </div>

        @foreach ($achMissions as $mission)

            @php
                $labelMap = [
                    'High Productivity' => 'Misi Kejar Target',
                    'Low Productivity'  => 'Misi Kejar Transaksi',
                    'Low Stock'         => 'Misi Kejar Target Saldo',
                    'ONO'               => 'Outlet Baru',
                ];

                $label = $labelMap[$mission['label']] ?? $mission['label'];
            @endphp

            <div class="section-title mt-2">
                {{ $label }}
            </div>

            @for ($level = 1; $level <= ($mission['max_flag'] - 1); $level++)
                @php
                    $targetVal = $mission['target']->{'target'.$level} ?? 0;
                    $incentive = $mission['target']->{'incentive'.$level} ?? 0;
                @endphp

                <div class="ach-wrapper">
                    <div class="ach-card">

                        <div class="ach-title">
                            <div class="ach-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <span>Misi Selesai</span>
                            <span class="ach-emoji">🎯</span>
                        </div>

                        <p class="ach-desc">
                            Target <strong>IDR {{ number_format($targetVal,0,',','.') }}</strong> telah tercapai.
                        </p>

                        <div class="ach-reward">
                            <span class="gift">🎁</span>
                            <span>
                                <strong>KOIN {{ number_format($incentive,0,',','.') }}</strong> berhasil diklaim.
                            </span>
                        </div>

                        {{-- opsional: tampilkan level --}}
                        <div class="mt-1" style="font-size:12px;color:#6b7280;">
                            Misi {{ $level }}
                        </div>

                    </div>
                </div>

            @endfor

        @endforeach

    </div>

<script>
</script>

</body>