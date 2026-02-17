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
    <link rel="stylesheet" href="{{ asset('css/high_productivity.css') }}">

</head>
<body>

<div class="app-wrapper">

    <!-- HEADER -->
    @include('partials.header')

    <div class="content-wrapper">
        
        <div class="mission-high-productivy">
            <div class="mission-banner">
                <div class="mission-banner">
                    <img src="{{ asset('assets/CTA/' . (session('user.brand') ?? 'default') . ' - High Productivity.png') }}">
                </div>
            </div>

            @php
                $missionFlag = $actual->flag_mission ?? 0;
                $missionStatus = $actual->mission_status ?? 0;
                $targetValue = $target->{'target5'} ?? 0;
                // $targetValue = $target->{'target'.$missionFlag} ?? 0;
                $actualValue = $actual->actual ?? 0;
                $incentive = $target->{'incentive'.$missionFlag} ?? 0;

                $achievedCount = max($missionFlag - 1, 0);

                $totalIncentive = 0;

                $percentage = $targetValue > 0
                    ? min(($actualValue / $targetValue) * 100, 100)
                    : 0;

                $sisaHari = max(($targetValue) - ($actual->actual ?? 0), 0);

                if ($sisaHari == 0) {
                    for ($i = 1; $i <= $missionFlag; $i++) {
                        $totalIncentive += $target->{'incentive'.$i} ?? 0;
                    }
                } else {
                    for ($i = 1; $i <= $achievedCount; $i++) {
                        $totalIncentive += $target->{'incentive'.$i} ?? 0;
                    }
                }

            @endphp

            {{-- @dd($sisaHari) --}}

            {{-- <div class="section-title mt-2">Misi Kejar Target</div> --}}

            {{-- MISI --}}
            <div class="section-title mt-3">
                @if ($sisaHari == 0 || $missionStatus == 1)
                    Selamat Telah Menyelesaikan Semua Misi
                @else
                    Sekarang di Misi {{ number_format($missionFlag ?? 0, 0, ',', '.') }}
                @endif
            </div>

            @if ($sisaHari != 0 )
                <div class="performance-card">
                    <div class="performance-header">
                        <div class="performance-target">
                            {{ number_format($actualValue ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="performance-actual">
                            {{ number_format($targetValue, 0, ',', '.') }}
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
                            Kejar IDR {{ number_format($sisaHari, 0, ',', '.') }} untuk dapatkan
                        </div>
                        {{-- {{ dd($incentive) }} --}}
                        <div class="performance-incentive">
                            KOIN {{ number_format($incentive, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- MISSION STEPS -->
            <div class="mission-steps">
                @for ($i = 1; $i <= 5; $i++)
                    @php
                        if ($i < $missionFlag) {
                            $status = 'done';
                        } elseif ($i == $missionFlag && $sisaHari == 0) {
                            $status = 'done';
                        } elseif ($i == $missionFlag) {
                            $status = 'active';
                        } else {
                            $status = '';
                        }

                        $reward = match($i) {
                            1 => $target->{'incentive'.$i},
                            2 => $target->{'incentive'.$i},
                            3 => $target->{'incentive'.$i},
                            4 => $target->{'incentive'.$i},
                            5 => $target->{'incentive'.$i},
                        };
                    @endphp

                    <div class="mission-step {{ $status }}">
                        <div class="step-icon">
                            @if ($status === 'done')
                                <img 
                                    src="{{ asset('assets/icon/ach.png') }}" 
                                    alt="Achieved"
                                    class="step-icon-img"
                                >
                            @elseif ($status === 'active')
                                🎁
                            @else
                                🎯
                            @endif
                        </div>

                        <div class="step-reward">
                            {{ number_format($reward, 0, ',', '.') }}
                        </div>
                        <div class="step-day">Misi {{ $i }}</div>
                    </div>
                @endfor
            </div>

            {{-- Ach --}}
            @if ($missionFlag > 1)
                <div class="mission-summary-card">
                    <div class="mission-summary-header">
                        <div class="mission-summary-check">
                            ✓
                        </div>

                        <div class="mission-summary-badge">
                            ACHIEVED
                        </div>
                    </div>

                    <div class="mission-summary-body">
                        <div class="mission-summary-title">
                            Total 
                            @if ($sisaHari == 0 || $missionStatus == 1)
                                {{ number_format($missionFlag ?? 0, 0, ',', '.') }}
                            @else
                                {{ number_format($achievedCount ?? 0, 0, ',', '.') }}
                            @endif
                            Misi Tercapai
                        </div>

                        <div class="mission-summary-incentive">
                            Total 
                            <span>KOIN {{ number_format($totalIncentive ?? 0, 0, ',', '.') }}</span> 
                            berhasil diraih
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

</script>

</body>
</html>
