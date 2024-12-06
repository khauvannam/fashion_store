<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="container mx-auto my-6 flex justify-between items-center">
    <div class="w-5/12">
        <div class="py-6 border-b-gray-300 border-b">
            <h3 class="font-medium text-2xl mb-2">Bắt đầu ngay</h3>
            <p>Đăng ký ngay bây giờ để nhận ngay ưu đãi tại <STRONG>TULOS!</STRONG></p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')"/>

        <form wire:submit="register" class="my-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Tên đăng nhập')"/>
                <x-text-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text" name="name"
                              required autofocus autocomplete="name"/>
                <x-input-error :messages="$errors->get('form.name')" class="mt-2"/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                              required autocomplete="username"/>
                <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mật khẩu')"/>
                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password"/>
                <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')"/>
                <x-text-input wire:model="form.password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password"/>
                <x-input-error :messages="$errors->get('form.password_confirmation')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}" wire:navigate>
                    {{ __('Đã có tài khoản?') }}
                </a>

                <x-primary-button class="ms-3">
                    {{ __('Đăng ký') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <div class="w-6/12">
        <img class="h-[80%] object-cover rounded-2xl" src="{{asset('images/auth/banner.png')}}" alt="">
    </div>
</div>

