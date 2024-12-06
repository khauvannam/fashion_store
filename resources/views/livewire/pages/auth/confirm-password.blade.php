<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="container mx-auto my-6 flex justify-center items-center">
    <div class="w-5/12">
        <div class="py-6 border-b-gray-300 border-b">
            <h3 class="font-medium text-2xl mb-2">Xác nhận mật khẩu</h3>
            <p>Đây là khu vực bảo mật của ứng dụng. Vui lòng xác nhận mật khẩu của bạn trước khi tiếp tục.</p>
        </div>

        <form wire:submit="confirmPassword" class="my-6">
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Mật khẩu')"/>
                <x-text-input wire:model="password"
                              id="password"
                              class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Xác nhận') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
