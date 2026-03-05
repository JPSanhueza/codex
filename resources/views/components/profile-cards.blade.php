@php
    $profiles = \App\Models\ProfileCard::query()
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();
@endphp

<section class="mx-auto w-full max-w-6xl px-4 py-8 md:px-6 md:py-12" aria-label="Sección Perfiles">
    <h2 class="text-2xl font-semibold tracking-tight text-slate-100 md:text-3xl">Perfiles</h2>

    @if ($profiles->isEmpty())
        <p class="mt-4 text-slate-400">Sin perfiles aún.</p>
    @else
        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($profiles as $profile)
                @php
                    $bullets = collect($profile->bullets ?? [])->map(function ($item) {
                        if (is_string($item)) {
                            return $item;
                        }

                        if (is_array($item)) {
                            return $item['text'] ?? $item['value'] ?? null;
                        }

                        return null;
                    })->filter()->values();
                @endphp

                <article class="h-full overflow-hidden rounded-xl border border-slate-300/30 bg-white/5 p-6 text-slate-100 shadow-sm break-words">
                    <div class="mx-auto mb-4 block h-28 w-28 max-w-full overflow-hidden rounded-full border border-slate-300/40 bg-slate-300/20">
                        @if ($profile->photo_path)
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($profile->photo_path) }}"
                                alt="{{ $profile->name }}"
                                class="block h-full w-full max-w-full object-cover"
                                loading="lazy"
                            >
                        @else
                            <span class="text-3xl font-semibold text-slate-200">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($profile->name, 0, 1)) }}</span>
                        @endif
                    </div>

                    <h3 class="text-center text-2xl font-bold leading-tight">{{ $profile->name }}</h3>

                    @if ($bullets->isNotEmpty())
                        <ul class="mt-4 list-disc space-y-2 pl-5 text-base leading-7 text-slate-200">
                            @foreach ($bullets as $bullet)
                                <li>{{ $bullet }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if (! blank($profile->quote))
                        <p class="mt-5 italic text-slate-300">“{{ $profile->quote }}”</p>
                    @endif
                </article>
            @endforeach
        </div>
    @endif
</section>
