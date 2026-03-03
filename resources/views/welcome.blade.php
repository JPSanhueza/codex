<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('Sitio en construcción') }} - {{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
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
                padding: clamp(1.75rem, 4vw, 3rem);
                background: linear-gradient(145deg, rgba(15, 23, 42, 0.88), rgba(30, 41, 59, 0.65));
                backdrop-filter: blur(8px);
                box-shadow: 0 30px 90px rgba(2, 6, 23, 0.55);
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

            @media (max-width: 640px) {
                .timer {
                    grid-template-columns: repeat(2, minmax(120px, 1fr));
                }
            }
        </style>
    </head>
    <body>
        <main class="card">
            <span class="pill">🚧 Sitio en construcción</span>
            <h1>Estamos creando algo increíble</h1>
            <p class="lead">
                Nuestro nuevo sitio estará disponible muy pronto. Estamos afinando los últimos detalles para ofrecer una experiencia moderna, rápida y confiable.
            </p>

            <section class="timer" aria-label="Cuenta regresiva de lanzamiento">
                <article class="segment">
                    <span class="value" id="days">07</span>
                    <span class="label">Días</span>
                </article>
                <article class="segment">
                    <span class="value" id="hours">00</span>
                    <span class="label">Horas</span>
                </article>
                <article class="segment">
                    <span class="value" id="minutes">00</span>
                    <span class="label">Minutos</span>
                </article>
                <article class="segment">
                    <span class="value" id="seconds">00</span>
                    <span class="label">Segundos</span>
                </article>
            </section>

            <p class="footer">
                Desarrollo del sitio a cargo de <span class="brand">Codari</span>.
            </p>
        </main>

        <script>
            const countdownStart = new Date();
            const launchDate = new Date(countdownStart.getTime() + 7 * 24 * 60 * 60 * 1000);

            const parts = {
                days: document.getElementById('days'),
                hours: document.getElementById('hours'),
                minutes: document.getElementById('minutes'),
                seconds: document.getElementById('seconds'),
            };

            const pad = (value) => value.toString().padStart(2, '0');

            const render = () => {
                const now = new Date();
                const distance = Math.max(0, launchDate - now);

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((distance / (1000 * 60)) % 60);
                const seconds = Math.floor((distance / 1000) % 60);

                parts.days.textContent = pad(days);
                parts.hours.textContent = pad(hours);
                parts.minutes.textContent = pad(minutes);
                parts.seconds.textContent = pad(seconds);
            };

            render();
            setInterval(render, 1000);
        </script>
    </body>
</html>
