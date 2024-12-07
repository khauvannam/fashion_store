<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="container mx-auto my-6 flex justify-between items-center">
    <div class="w-5/12">
        <div class="py-6 border-b-gray-300 border-b">
            <h3 class="font-medium text-2xl mb-2">Quên mật khẩu</h3>
            <p>Không có gì khó có <strong>TULOS</strong> lo! Nhập ngay email để lấy lại mật khẩu ngay bây giờ</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <form wire:submit="sendPasswordResetLink" class="my-6">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required
                              autofocus/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Lấy lại mật khẩu') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <div class="w-6/12">
        <img class="h-[80%] object-cover rounded-2xl" src="{{asset('images/auth/banner.png')}}" alt="">
    </div>
</div>

