<x-layouts::guest :title="__('Sitio en construcción').' - '.config('app.name', 'Laravel')">
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

    <script>
        const COUNTDOWN_KEY = 'codari_launch_date';
        const now = Date.now();
        const storedDate = Number(localStorage.getItem(COUNTDOWN_KEY));
        const launchTimestamp = Number.isFinite(storedDate) && storedDate > now
            ? storedDate
            : now + 7 * 24 * 60 * 60 * 1000;

        localStorage.setItem(COUNTDOWN_KEY, String(launchTimestamp));

        const parts = {
            days: document.getElementById('days'),
            hours: document.getElementById('hours'),
            minutes: document.getElementById('minutes'),
            seconds: document.getElementById('seconds'),
        };

        const pad = (value) => value.toString().padStart(2, '0');

        const render = () => {
            const distance = Math.max(0, launchTimestamp - Date.now());

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
</x-layouts::guest>
