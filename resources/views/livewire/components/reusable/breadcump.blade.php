<?php

use function Livewire\Volt\{state};

state(['name' => '']);
?>

<div class="flex mt-[150px] gap-3">
    <a href="/" class="hover:underline">Trang chủ</a>
    /
    <a href="{{ route('products') }}" class="hover:underline">Tất cả sản phẩm</a>
    /
    <span class="text-gray-600">{{ $name }}</span>
</div>
