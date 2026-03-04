<section class="imagen-hero" aria-label="Imagen principal del sitio">
    @if ($desktopImageUrl && $mobileImageUrl)
        <picture>
            <source media="(max-width: 768px)" srcset="{{ $mobileImageUrl }}">
            <img src="{{ $desktopImageUrl }}" alt="Imagen hero" loading="lazy">
        </picture>
    @else
        <div class="imagen-hero-empty">
            Aún no hay una imagen hero configurada desde Filament.
        </div>
    @endif
</section>
