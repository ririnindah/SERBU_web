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
    <link rel="stylesheet" href="{{ asset('css/redeem_koin.css') }}">

<style>

</style>

</head>
<body>

<div class="app-wrapper">
    @include('partials.header')

    <div class="content-body">
        <h2 class="title">Redeem Koin Serbu</h2>
        <h4 class="title-1">KOIN yang bisa di redeem adalah 
            {{ number_format($koin, 0, ',', '.') }}
        </h4>
        <p class="subtitle">Silakan isi data di bawah untuk menukarkan koin Anda.</p>

        {{-- @dd($totalKoin) --}}
        
        <form action="/redeem-koin-process" method="POST" class="redeem-form">
            @csrf
            
            <div class="form-group">
                <label for="msisdn">TRX Owner</label>
                <input type="text" 
                    id="msisdn" 
                    name="msisdn" 
                    placeholder="Contoh: 08xxxxxxxxxx" 
                    pattern="^08[0-9]*$" 
                    minlength="10" 
                    maxlength="13" 
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                    required>
                <small id="msisdn-error" style="color: red; display: none; font-size: 11px;">Nomor harus diawali 08 dan maks 13 digit</small>
                @error('msisdn')
                    <span style="color: #e61e2b; font-size: 12px; font-weight: bold;">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="koin">Jumlah Koin Redeem</label>
                <input type="number" id="koin" name="jumlah_koin" min="500" step="1" placeholder="Masukkan Jumlah Koin" required>
                <small class="input-hint">Minimal KOIN yang di redeem adalah 500</small>

                <span id="koin-error-js" class="error-text" style="display: none;">Jumlah koin minimal adalah 500</span>
                <span id="saldo-error-js" class="error-text" style="display: none;">
                    KOIN yang di redeem harus maksimum {{ number_format($koin, 0, ',', '.') }}
                </span>

                @error('jumlah_koin')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    Saya menyatakan TRX Owner sesuai dan memenuhi semua syarat serta ketentuan yang berlaku.
                </label>
            </div>

            <button type="submit" class="btn-submit">Redeem Sekarang</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('msisdn').addEventListener('input', function() {
        const errorHint = document.getElementById('msisdn-error');
        if (!this.value.startsWith('08') && this.value.length > 0) {
            errorHint.style.display = 'block';
        } else {
            errorHint.style.display = 'none';
        }
    });

    document.querySelector('.redeem-form').addEventListener('submit', function(e) {
        const koinInput = document.getElementById('koin');
        const koinErrorMin = document.getElementById('koin-error-js');
        const koinErrorSaldo = document.getElementById('saldo-error-js');
        
        const inputVal = parseInt(koinInput.value) || 0;
        const minKoin = 500;
        const totalKoinUser = {{ $koin }}; // Mengambil variabel dari Controller

        // Reset state error
        koinErrorMin.style.display = 'none';
        koinErrorSaldo.style.display = 'none';
        koinInput.style.borderColor = '#e0e0e0';

        // Kondisi 1: Cek Minimal 10.000
        if (inputVal < minKoin) {
            e.preventDefault();
            koinErrorMin.style.display = 'block';
            koinInput.style.borderColor = '#e61e2b';
            koinInput.focus();
        } 
        // Kondisi 2: Cek apakah input >= total koin (sesuai requestmu)
        else if (inputVal >= totalKoinUser) {
            e.preventDefault();
            koinErrorSaldo.style.display = 'block';
            koinInput.style.borderColor = '#e61e2b';
            koinInput.focus();
        }

        const inputMsisdn = document.getElementById('msisdn');
        const errorMsisdn = document.getElementById('msisdn-error');

        const msisdnServer = "{{ $msisdn }}"; // dari controller
        const msisdnInput = inputMsisdn.value;

        errorMsisdn.style.display = 'none';

        if (msisdnInput !== msisdnServer) {
            e.preventDefault();
            errorMsisdn.innerText = "TRX Owner harus sama dengan nomor terdaftar";
            errorMsisdn.style.display = 'block';
            inputMsisdn.focus();
        }
    });


</script>
</body>
</html>