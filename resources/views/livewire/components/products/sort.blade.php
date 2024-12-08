<?php

use Livewire\Volt\Component;

new class extends Component {
    
};
?>
<div class="flex items-center justify-center py-10 bg-white gap-5">
    <div class="flex flex-col items-center" x-data="{sortData: false}"> 
        <h1 @click="sortData = ! sortData">Sắp xếp theo</h1>
        <div x-show="sortData"
        @click="sortData = ! sortData">
            <p>Bán chạy nhất</p>
            <p>Giá tăng dần</p>
            <p>Giá giảm dần</p>
            <p>Sản phẩm mới</p>
        </div>
    </div>
    <div class="flex flex-col items-center" x-data="{sortSize: false}"> 
        <h1 @click="sortSize= ! sortSize">Size</h1>
        <div x-show="sortSize"
        @click="sortSize = ! sortSize">
            <p>S</p>
            <p>M</p>
            <p>L</p>
            <p>XL</p>
        </div>
    </div>
</div>