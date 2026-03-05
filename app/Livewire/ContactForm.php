<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $message = '';

    public string $website = '';

    public bool $sent = false;

    /**
     * Get validation rules.
     *
     * @return array<string, string>
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|min:3|max:120',
            'email' => 'required|email:rfc,dns|max:190',
            'message' => 'required|min:10|max:5000',
            'website' => 'nullable|size:0',
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'message.max' => 'El mensaje no puede superar los 5000 caracteres.',
        ];
    }

    public function updated(string $property): void
    {
        if ($property === 'website') {
            return;
        }

        $this->validateOnly($property);
    }

    public function submit(): void
    {
        $this->sent = false;

        if (! blank($this->website)) {
            $this->reset(['name', 'email', 'message', 'website']);
            $this->resetValidation();
            $this->sent = true;

            return;
        }

        $validated = $this->validate();

        $ipAddress = request()->ip() ?? 'unknown';
        $throttleKey = 'contact-form:'.$ipAddress;

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $this->addError('rate_limit', 'Has enviado demasiados mensajes. Intenta nuevamente en unos minutos.');

            return;
        }

        RateLimiter::hit($throttleKey, 10 * 60);

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        Mail::to('contacto@codari.cl')->send(new ContactFormMail($contactMessage));

        $this->reset(['name', 'email', 'message', 'website']);
        $this->resetValidation();
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
