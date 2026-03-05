<div style="font-family: Arial, sans-serif; line-height:1.5; color:#111827;">
    <h2>Nuevo mensaje de contacto</h2>

    <p><strong>Nombre:</strong> {{ $contactMessage->name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Mensaje:</strong><br>{{ $contactMessage->message }}</p>

    <hr>

    <p><strong>Fecha:</strong> {{ $contactMessage->created_at?->format('Y-m-d H:i:s') ?? now()->format('Y-m-d H:i:s') }}</p>
    <p><strong>IP:</strong> {{ $contactMessage->ip_address ?? 'N/D' }}</p>
    <p><strong>User Agent:</strong> {{ $contactMessage->user_agent ?? 'N/D' }}</p>
</div>
