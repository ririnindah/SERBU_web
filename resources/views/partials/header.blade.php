<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Header</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
    /* ================= HEADER ================= */
    .app-header {
        background: #ffffff;
        padding: 14px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e5e7eb;
    }

    /* LEFT */
    .header-left {
        display: flex;
        align-items: center;
    }

    /* STORY BUTTON (HEAD ONLY) */
    .story-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(15deg, #fff700, #f94df0);
        padding: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .story-btn img {
        width: 110%;
        height: 110%;
        border-radius: 50%;
        object-fit: cover;
        transform: translateY(4%);
    }

    /* RIGHT */
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
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .user-pill {
        font-size: 14px;
        font-weight: 600;
        max-width: 140px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .btn-setting {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
    }

    /* SETTINGS POPUP */
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

    /* ================= STORY MODAL ================= */
    .story-modal {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.8);
        display: none;
        z-index: 9999;
    }

    .story-frame {
        max-width: 420px;
        margin: auto;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .story-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 16px;
    }

    .story-close {
        position: absolute;
        top: 14px;
        right: 14px;
        color: #fff;
        font-size: 26px;
        cursor: pointer;
        z-index: 10;
    }

    /* STORY CLICK */
    .story-click {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 50%;
        z-index: 9;
    }

    .story-click.left { left: 0; }
    .story-click.right { right: 0; }

    /* STORY PROGRESS */
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
        background: rgba(255,255,255,.3);
        border-radius: 999px;
        overflow: hidden;
    }

    .story-progress-fill {
        height: 100%;
        width: 0%;
        background: #ffffff;
        transition: width 5s linear;
    }

    .icon-coin {
        width: 20px;
        height: 20px;
        object-fit: contain;
        vertical-align: middle;
    }
</style>

</head>
<body>

    <div class="app-header">

        @php
            $brand = session('user.brand') ?? 'IM3';
            $maxKv = 5;

            $stories = [];

            for ($i = 1; $i <= $maxKv; $i++) {
                $path = public_path("assets/KV/{$brand}-KV{$i}.png");

                if (file_exists($path)) {
                    $stories[] = asset("assets/KV/{$brand}-KV{$i}.png");
                }
            }
        @endphp

        <div class="header-left">
            <div class="story-btn" onclick="openStory()">
                <img src="{{ asset('assets/icon/icon.png') }}" alt="Story">
            </div>
        </div>

        <div class="header-right">
            <div class="badge-koin">
                <img src="{{ asset('assets/icon/koin.png') }}" alt="Koin" class="icon-coin">
                {{ number_format($userCoin, 0, ',', '.') }}
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

    <!-- ================= STORY MODAL ================= -->
    <div class="story-modal" id="storyModal">
        <div class="story-progress-wrapper" id="storyProgressWrapper"></div>
        <div class="story-close" onclick="closeStory()">✕</div>

        <div class="story-click left" onclick="prevStory()"></div>
        <div class="story-click right" onclick="nextStory()"></div>

        <div class="story-frame">
            <img id="storyImage" class="story-img">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        const btnSetting = document.querySelector('.btn-setting');
        const popup = document.getElementById('settingsPopup');

        btnSetting.onclick = e => {
            e.stopPropagation();
            popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
        };

        document.onclick = () => popup.style.display = 'none';
        popup.onclick = e => e.stopPropagation();

        /* STORY DATA */
        const stories = @json($stories);

        let storyIndex = 0;
        let storyTimeout;

        /* STORY FUNCTIONS */
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
                wrapper.innerHTML += `
                    <div class="story-progress-bar">
                        <div class="story-progress-fill"></div>
                    </div>
                `;
            });
        }

        function showStory() {
            const img = document.getElementById('storyImage');
            const fills = document.querySelectorAll('.story-progress-fill');

            img.src = stories[storyIndex];

            fills.forEach((f, i) => {
                f.style.transition = 'none';
                f.style.width = i < storyIndex ? '100%' : '0%';
            });

            setTimeout(() => {
                fills[storyIndex].style.transition = 'width 5s linear';
                fills[storyIndex].style.width = '100%';
            }, 50);

            clearTimeout(storyTimeout);
            storyTimeout = setTimeout(() => {
                storyIndex++;
                storyIndex < stories.length ? showStory() : closeStory();
            }, 5000);
        }

        function closeStory() {
            clearTimeout(storyTimeout);
            document.getElementById('storyModal').style.display = 'none';
        }

        function nextStory() {
            clearTimeout(storyTimeout);
            storyIndex < stories.length - 1 ? storyIndex++ : closeStory();
            showStory();
        }

        function prevStory() {
            clearTimeout(storyTimeout);
            storyIndex = Math.max(0, storyIndex - 1);
            showStory();
        }
        
    </script>
</body>