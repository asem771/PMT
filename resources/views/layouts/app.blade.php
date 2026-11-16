
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PMT — PixelMindTraining</title>

    <!-- Cairo Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* =========================
           LIGHT THEME
        ========================= */

        :root {
            --bg: #F5F6F8;
            --surface: #FFFFFF;
            --surface-alt: #F8F9FB;
            --text: #263445;
            --muted: #718096;
            --border: #E2E5EA;
            --navbar: #14243A;
            --primary: #C6A15B;
            --primary-hover: #D6B875;
            --table-head: #E9EDF3;
            --table-alt: #F8F9FB;
            --input-bg: #FFFFFF;
            --shadow: 0 5px 20px rgba(20, 36, 58, .07);
            --row-hover: rgba(198, 161, 91, .10);
        }

        /* =========================
           DARK THEME
        ========================= */

        [data-theme="dark"] {
            --bg: #0B1220;
            --surface: #172438;
            --surface-alt: #1C2B40;
            --text: #E8EDF5;
            --muted: #A7B4C7;
            --border: #2C3D54;
            --navbar: #081321;
            --primary: #C6A15B;
            --primary-hover: #D6B875;
            --table-head: #26374D;
            --table-alt: #1C2B40;
            --input-bg: #111E30;
            --shadow: 0 8px 28px rgba(0, 0, 0, .25);
            --row-hover: rgba(198, 161, 91, .09);
        }

        /* GENERAL */

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', Tahoma, Arial, sans-serif;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.8;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            transition: background .25s, color .25s;
        }

        /* =========================
           NAVIGATION
        ========================= */

        .navbar {
            background: var(--navbar);
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            box-shadow: 0 4px 18px rgba(10, 20, 35, .15);
            border-bottom: 3px solid var(--primary);
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 .5rem;
            font-weight: 600;
            transition: color .2s;
        }

        .navbar a:hover {
            color: var(--primary);
        }

        .navbar .brand {
            font-size: 1.25rem;
            font-weight: 800;
            margin: 0;
            white-space: nowrap;
        }

        .nav-links,
        .nav-controls {
            display: flex;
            align-items: center;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .nav-control {
            display: inline-block;
            border: 1px solid rgba(198, 161, 91, .55);
            background: rgba(198, 161, 91, .08);
            color: white;
            padding: .5rem .8rem;
            border-radius: 8px;
            cursor: pointer;
            font: inherit;
            font-weight: 700;
            text-decoration: none;
            transition: .2s;
        }

        .nav-control:hover {
            background: var(--primary);
            color: #14243A;
        }

        /* =========================
           MAIN LAYOUT
        ========================= */

        .container {
            max-width: 1350px;
            margin: 2.5rem auto;
            padding: 0 1.25rem;
            min-height: 70vh;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .page-header h1 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--text);
            position: relative;
            padding-bottom: .35rem;
        }

        .page-header h1::after {
            content: "";
            display: block;
            width: 55px;
            height: 3px;
            background: var(--primary);
            border-radius: 5px;
            margin-top: .35rem;
        }

        /* =========================
           CARDS
        ========================= */

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-top: 3px solid var(--primary);
            border-radius: 14px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
            transition: background .25s, border-color .25s;
        }

        .card h2 {
            color: var(--text);
            margin-top: 0;
            padding-bottom: .7rem;
            border-bottom: 1px solid var(--border);
        }

        /* =========================
           FILTERS AND FORMS
        ========================= */

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            align-items: center;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 700;
            margin-bottom: .4rem;
            color: var(--text);
        }

        input,
        select,
        textarea {
            padding: .7rem .85rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font: inherit;
            background: var(--input-bg);
            color: var(--text);
            max-width: 100%;
            transition: border-color .2s, box-shadow .2s;
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--muted);
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(198, 161, 91, .15);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
        }

        /* =========================
           GOLD BUTTONS
        ========================= */

        .btn {
            display: inline-block;
            padding: .65rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--primary);
            font-family: 'Cairo', Tahoma, Arial, sans-serif;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.7;
            text-decoration: none;
            cursor: pointer;
            background: var(--primary);
            color: #14243A;
            transition: .2s;
        }

        .btn:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            color: #14243A;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(198, 161, 91, .2);
        }

        /* SECONDARY BUTTONS */

        .btn-secondary {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: #14243A;
            border-color: var(--primary);
        }

        /* DELETE BUTTON */

        .btn-danger {
            background: #DC2626;
            color: #FFFFFF;
            border: 1px solid #DC2626;
        }

        .btn-danger:hover {
            background: #B91C1C;
            color: #FFFFFF;
            border-color: #B91C1C;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: .35rem .7rem;
            font-size: .9rem;
        }

        /* =========================
           TABLES
        ========================= */

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border-radius: 8px;
        }

        th,
        td {
            text-align: start;
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            color: var(--text);
        }

        th {
            background: var(--table-head);
            font-weight: 800;
            color: var(--primary);
        }

        tbody tr {
            background: var(--surface);
            transition: background .2s;
        }

        tbody tr:nth-child(even) {
            background: var(--table-alt);
        }

        tbody tr:hover {
            background: var(--row-hover);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* =========================
           STATUS BADGES
        ========================= */

        .badge {
            display: inline-block;
            padding: .25rem .7rem;
            border-radius: 99px;
            font-size: .8rem;
            font-weight: 700;
        }

        .badge-pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-in_progress {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .badge-done {
            background: #DCFCE7;
            color: #166534;
        }

        /* =========================
           ALERTS
        ========================= */

        .alert-success {
            background: #DCFCE7;
            color: #166534;
            padding: .9rem 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-inline-start: 4px solid #16A34A;
        }

        .alert-error {
            background: #FEE2E2;
            color: #991B1B;
            padding: .9rem 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-inline-start: 4px solid #DC2626;
        }

        .inline-form {
            display: inline;
        }

        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: .4rem;
            margin-top: 1.5rem;
        }

        .pagination a,
        .pagination span {
            padding: .45rem .8rem;
            border-radius: 7px;
            border: 1px solid var(--border);
            color: var(--text);
            text-decoration: none;
        }

        .pagination .active,
        .pagination a:hover {
            background: var(--primary);
            color: #14243A;
            border-color: var(--primary);
        }

        /* =========================
           DEVELOPER TOOLS FOOTER
        ========================= */

        .site-footer {
            text-align: center;
            padding: 2rem 1.5rem;
            color: var(--muted);
            border-top: 1px solid var(--border);
            margin-top: 3rem;
        }

        .developer-tools {
            margin-bottom: 20px;
        }

        .developer-tools h3 {
            color: var(--text);
            font-size: 16px;
            font-weight: 800;
            margin: 0 0 12px;
        }

        .developer-links {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .developer-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 9px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--muted);
            text-decoration: none;
            font-family: 'Cairo', Tahoma, Arial, sans-serif;
            font-weight: 700;
            transition: .2s;
        }

        .developer-link:hover {
            background: var(--primary);
            color: #14243A;
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .developer-icon {
            color: var(--primary);
            font-weight: 800;
            direction: ltr;
        }

        .developer-link:hover .developer-icon {
            color: #14243A;
        }

        .footer-copyright {
            margin-top: 18px;
            font-size: 14px;
        }

        /* =========================
           RTL
        ========================= */

        [dir="rtl"] .navbar,
        [dir="rtl"] .nav-links,
        [dir="rtl"] .nav-controls {
            direction: rtl;
        }

        [dir="rtl"] body {
            font-family: 'Cairo', Tahoma, Arial, sans-serif;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .navbar {
                padding: 1rem;
                align-items: flex-start;
                flex-direction: column;
            }

            .container {
                margin: 1.5rem auto;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .card {
                overflow-x: auto;
            }

            .nav-links,
            .nav-controls {
                width: 100%;
            }

            table {
                min-width: 650px;
            }

            .developer-links {
                flex-direction: column;
            }

            .developer-link {
                width: 100%;
                max-width: 260px;
            }
        }

    </style>
</head>

<body>

    <!-- NAVIGATION -->

    <nav class="navbar">

        <a href="/tasks" class="brand">
            PMT — PixelMindTraining
        </a>

        <div class="nav-links">

            <a href="/tasks">
                {{ __('All Tasks') }}
            </a>

            <a href="/tasks/create">
                + {{ __('New Task') }}
            </a>

            <a href="/posts">
                {{ __('Posts') }}
            </a>

        </div>

        <div class="nav-controls">

            @if (app()->getLocale() === 'ar')

                <a href="{{ route('language.switch', 'en') }}"
                   class="nav-control">
                    English
                </a>

            @else

                <a href="{{ route('language.switch', 'ar') }}"
                   class="nav-control">
                    العربية
                </a>

            @endif

            <button type="button"
                    class="nav-control"
                    id="themeToggle">
                🌙 Dark Mode
            </button>

        </div>

    </nav>

    <!-- MAIN CONTENT -->

    <main class="container">

        @if (session('success'))

            <div class="alert-success">
                {{ __(session('success')) }}
            </div>

        @endif

        @if ($errors->any())

            <div class="alert-error">

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        @yield('content')

    </main>

    <!-- FOOTER -->


    <!-- FOOTER -->
    <footer class="site-footer">

        <div class="developer-tools">

            <h3>
                أدوات المطورين
            </h3>

            <div class="developer-links">

                <a href="{{ route('developer.login', ['redirect' => '/api/tasks']) }}"
                   class="developer-link">

                    <span class="developer-icon">{ }</span>
                    JSON API

                </a>

                <a href="{{ route('developer.login', ['redirect' => '/docs/api']) }}"
                   class="developer-link">

                    <span class="developer-icon">📘</span>
                    API Docs

                </a>

            </div>

        </div>

        <div class="footer-copyright">
            © {{ date('Y') }} PMT — PixelMindTraining
        </div>

    </footer>


    <!-- THEME SCRIPT -->

    <script>

        const html = document.documentElement;

        const themeToggle = document.getElementById('themeToggle');

        const currentLanguage = html.lang;

        function applyTheme(theme) {

            html.dataset.theme = theme;

            localStorage.setItem('pmt-theme', theme);

            if (currentLanguage === 'ar') {

                themeToggle.textContent = theme === 'dark'
                    ? '☀️ الوضع النهاري'
                    : '🌙 الوضع الليلي';

            } else {

                themeToggle.textContent = theme === 'dark'
                    ? '☀️ Light Mode'
                    : '🌙 Dark Mode';

            }

        }

        const savedTheme = localStorage.getItem('pmt-theme') || 'light';

        applyTheme(savedTheme);

        themeToggle.addEventListener('click', function () {

            const nextTheme = html.dataset.theme === 'dark'
                ? 'light'
                : 'dark';

            applyTheme(nextTheme);

        });

    </script>

</body>
</html>
