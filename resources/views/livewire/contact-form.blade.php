<div class="w-full">
    @if ($sent)
        <div class="mb-4 rounded-lg border border-emerald-400/40 bg-emerald-500/15 px-4 py-3 text-emerald-100">
            Tu mensaje ha sido enviado correctamente. Te responderemos pronto.
        </div>
    @endif

    @error('rate_limit')
        <div class="mb-4 rounded-lg border border-amber-400/40 bg-amber-500/15 px-4 py-3 text-amber-100">
            {{ $message }}
        </div>
    @enderror

    <form wire:submit="submit" class="space-y-5" novalidate>
        <div class="hidden" aria-hidden="true">
            <label for="website">Website</label>
            <input id="website" type="text" wire:model.defer="website" tabindex="-1" autocomplete="off">
        </div>

        <div>
            <label for="name" class="mb-1 block text-sm font-medium text-slate-100">Nombre</label>
            <input
                id="name"
                type="text"
                wire:model.live.debounce.300ms="name"
                class="w-full rounded-lg border border-slate-400/30 bg-slate-900/40 px-3 py-2 text-slate-100 placeholder-slate-400 outline-none ring-0 transition focus:border-sky-400/70 focus:bg-slate-900/60 focus:shadow-[0_0_0_3px_rgba(56,189,248,0.2)]"
                placeholder="Tu nombre"
                maxlength="120"
            >
            <p class="mt-1 text-xs text-slate-400">Mínimo 3 caracteres.</p>
            @error('name') <p class="mt-1 text-sm text-rose-300">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="mb-1 block text-sm font-medium text-slate-100">Correo electrónico</label>
            <input
                id="email"
                type="email"
                wire:model.live.debounce.300ms="email"
                class="w-full rounded-lg border border-slate-400/30 bg-slate-900/40 px-3 py-2 text-slate-100 placeholder-slate-400 outline-none ring-0 transition focus:border-sky-400/70 focus:bg-slate-900/60 focus:shadow-[0_0_0_3px_rgba(56,189,248,0.2)]"
                placeholder="tu@email.com"
                maxlength="190"
            >
            <p class="mt-1 text-xs text-slate-400">Usaremos este correo para responderte.</p>
            @error('email') <p class="mt-1 text-sm text-rose-300">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="message" class="mb-1 block text-sm font-medium text-slate-100">Mensaje</label>
            <textarea
                id="message"
                wire:model.live.debounce.300ms="message"
                rows="6"
                class="w-full rounded-lg border border-slate-400/30 bg-slate-900/40 px-3 py-2 text-slate-100 placeholder-slate-400 outline-none ring-0 transition focus:border-sky-400/70 focus:bg-slate-900/60 focus:shadow-[0_0_0_3px_rgba(56,189,248,0.2)]"
                placeholder="Cuéntanos cómo podemos ayudarte..."
                maxlength="5000"
            ></textarea>
            <p class="mt-1 text-xs text-slate-400">Entre 10 y 5000 caracteres.</p>
            @error('message') <p class="mt-1 text-sm text-rose-300">{{ $message }}</p> @enderror
        </div>

        <button
            type="submit"
            wire:loading.attr="disabled"
            class="inline-flex items-center justify-center rounded-lg bg-sky-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-400 disabled:cursor-not-allowed disabled:opacity-70"
        >
            <span wire:loading.remove wire:target="submit">Enviar mensaje</span>
            <span wire:loading wire:target="submit">Enviando...</span>
        </button>
    </form>
</div>
