<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? __('Sitio en construcción').' - '.config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <style>
            :root {
                color-scheme: dark;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
                background: radial-gradient(circle at 20% 10%, #1f2937 0%, #0f172a 45%, #020617 100%);
                color: #e2e8f0;
                display: grid;
                place-items: center;
                padding: 1.5rem;
            }

            .card {
                width: min(920px, 100%);
                border: 1px solid rgba(148, 163, 184, 0.25);
                border-radius: 24px;
                padding: clamp(1.25rem, 3vw, 1.6rem) clamp(1.75rem, 4vw, 3rem) clamp(1.75rem, 4vw, 3rem);
                background: linear-gradient(145deg, rgba(15, 23, 42, 0.88), rgba(30, 41, 59, 0.65));
                backdrop-filter: blur(8px);
                box-shadow: 0 30px 90px rgba(2, 6, 23, 0.55);
            }

            .guest-nav {
                margin-bottom: 1.5rem;
            }

            .guest-nav-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
            }

            .guest-nav-brand {
                color: #f8fafc;
                text-decoration: none;
                font-weight: 700;
                letter-spacing: .03em;
            }

            .guest-nav-toggle {
                display: none;
                align-items: center;
                justify-content: center;
                width: 2.5rem;
                height: 2.5rem;
                border: 1px solid rgba(148, 163, 184, 0.35);
                border-radius: 10px;
                background: rgba(30, 41, 59, 0.45);
                color: #e2e8f0;
                font-size: 1.2rem;
                cursor: pointer;
            }

            .guest-nav-links {
                margin: 0;
                padding: 0;
                list-style: none;
                display: flex;
                gap: .5rem;
            }

            .guest-nav-links a {
                display: inline-block;
                padding: .45rem .75rem;
                border-radius: 999px;
                color: #cbd5e1;
                text-decoration: none;
                font-size: .95rem;
                border: 1px solid transparent;
                transition: background-color .2s ease, border-color .2s ease, color .2s ease;
            }

            .guest-nav-links a:hover {
                color: #f8fafc;
                border-color: rgba(56, 189, 248, 0.5);
                background: rgba(14, 116, 144, 0.2);
            }

            .guest-content {
                border-top: 1px solid rgba(148, 163, 184, 0.2);
                padding-top: 1.5rem;
            }

            .pill {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                border: 1px solid rgba(56, 189, 248, 0.5);
                color: #7dd3fc;
                background: rgba(14, 116, 144, 0.2);
                padding: .5rem .85rem;
                border-radius: 999px;
                font-size: .82rem;
                letter-spacing: .02em;
            }

            h1 {
                margin: 1rem 0 .75rem;
                font-size: clamp(2rem, 7vw, 3.8rem);
                line-height: 1.02;
                color: #f8fafc;
            }

            .lead {
                margin: 0;
                max-width: 60ch;
                color: #cbd5e1;
                line-height: 1.65;
                font-size: clamp(1rem, 2.4vw, 1.15rem);
            }

            .timer {
                margin-top: 2rem;
                display: grid;
                grid-template-columns: repeat(4, minmax(90px, 1fr));
                gap: .85rem;
            }

            .segment {
                border: 1px solid rgba(148, 163, 184, 0.2);
                border-radius: 18px;
                text-align: center;
                padding: 1rem .75rem;
                background: rgba(15, 23, 42, 0.55);
            }

            .value {
                display: block;
                font-size: clamp(1.7rem, 4vw, 2.5rem);
                font-weight: 700;
                color: #f8fafc;
                letter-spacing: .03em;
            }

            .label {
                display: block;
                margin-top: .35rem;
                color: #94a3b8;
                font-size: .78rem;
                text-transform: uppercase;
                letter-spacing: .12em;
            }

            .footer {
                margin-top: 1.5rem;
                color: #94a3b8;
                font-size: .95rem;
            }

            .brand {
                color: #38bdf8;
                font-weight: 700;
            }


            .imagen-hero {
                width: 100%;
            }

            .imagen-hero picture,
            .imagen-hero img {
                display: block;
                width: 100%;
            }

            .imagen-hero img {
                height: 70vh;
                min-height: 320px;
                max-height: 780px;
                object-fit: cover;
                border-radius: 16px;
                border: 1px solid rgba(148, 163, 184, 0.24);
                background: rgba(15, 23, 42, 0.45);
            }

            .imagen-hero-empty {
                height: 70vh;
                min-height: 320px;
                max-height: 780px;
                display: grid;
                place-items: center;
                text-align: center;
                border-radius: 16px;
                border: 1px dashed rgba(148, 163, 184, 0.5);
                color: #94a3b8;
                padding: 1rem;
            }
            @media (max-width: 640px) {
                .guest-nav-toggle {
                    display: inline-flex;
                }

                .guest-nav-links {
                    width: 100%;
                    margin-top: .85rem;
                    flex-direction: column;
                    gap: .35rem;
                    display: none;
                }

                .guest-nav-links.is-open {
                    display: flex;
                }

                .guest-nav-links a {
                    width: 100%;
                    border-radius: 10px;
                    padding: .6rem .75rem;
                }

                .timer {
                    grid-template-columns: repeat(2, minmax(120px, 1fr));
                }
            }
        </style>
    </head>
    <body>
        <div class="card">
            <nav class="guest-nav" aria-label="Navegación principal">
                <div class="guest-nav-row">
                    <a class="guest-nav-brand" href="#">Codari</a>
                    <button class="guest-nav-toggle" type="button" aria-expanded="false" aria-controls="guest-nav-links" data-nav-toggle>
                        ☰
                    </button>
                    <ul class="guest-nav-links" id="guest-nav-links" data-nav-menu>
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Sobre Nosotros</a></li>
                        <li><a href="#">Servicios</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </div>
            </nav>

            <main class="guest-content">
                {{ $slot }}
            </main>
        </div>

        <script>
            const navToggle = document.querySelector('[data-nav-toggle]');
            const navMenu = document.querySelector('[data-nav-menu]');

            if (navToggle && navMenu) {
                navToggle.addEventListener('click', () => {
                    const isOpen = navMenu.classList.toggle('is-open');
                    navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }
        </script>
        @livewireScripts
    </body>
</html>
