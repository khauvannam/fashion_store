<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[layout('layouts.guest')] class extends component {
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="container mx-auto my-6 flex justify-between items-center">
    <div class="w-5/12">

        <div class="py-6 border-b-gray-300 border-b">
            <h3 class="font-medium text-2xl mb-2">Chào mừng</h3>
            <p>Đăng nhập ngay tại đây!</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')"/>

        <form wire:submit="login" class="my-6">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                              required autofocus autocomplete="username"/>
                <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mật khẩu')"/>

                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password"/>

                <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>
            </div>

            <!-- Remember Me -->
            <div class="mt-4 flex justify-between items-center  ">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ghi nhớ đăng nhập') }}</span>
                </label>
                @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Quên mật khẩu?') }}
                </a>
            @endif
            </div>

            <div class="flex items-center justify-end mt-4">

                @if (Route::has('register'))
                    <a class="ml-7 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('register') }}" wire:navigate>
                        {{ __('Đăng ký ngay!') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Đăng nhập') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    <div class="w-6/12">
        <img class="h-[80%] object-cover rounded-2xl" src="{{asset('images/auth/banner.png')}}" alt="">
    </div>
</div>
