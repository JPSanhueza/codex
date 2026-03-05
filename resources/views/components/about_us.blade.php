@php
    $aboutUsSection = \App\Models\AboutUsSection::query()->orderBy('id')->first();
    $aboutUsContent = $aboutUsSection?->content
        ?? '(Contenido pendiente. Edita esta sección desde el panel de administración.)';
@endphp

<section class="mx-auto w-full max-w-4xl px-4 py-10 md:px-6 md:py-14" aria-label="Sección Sobre Nosotros">
    <h2 class="text-2xl font-semibold tracking-tight text-slate-100 md:text-3xl">Sobre Nosotros</h2>
    <div class="mt-4 text-base leading-7 text-slate-300 md:text-lg [&_p]:mb-4">
        {!! nl2br(e($aboutUsContent)) !!}
    </div>
</section>
