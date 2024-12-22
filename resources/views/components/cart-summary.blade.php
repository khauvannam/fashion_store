<div class="w-full lg:w-1/2">
    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
        <p class="text-xl font-semibold text-gray-900">Giá trị đơn hàng</p>
        <div class="space-y-4">
            <dl class="flex items-center justify-between gap-4">
                <dt class="text-base font-normal text-gray-500">Tổng giá</dt>
                <dd class="text-base font-medium text-gray-900">
                    $<span x-text="Number(cart.total_price).toFixed(2)"></span>
                </dd>
            </dl>
        </div>
        <a href="/"
           class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline">
            Tiếp tục mua hàng
        </a>
    </div>
    <div class="flex justify-center mt-5">

    </div>
</div>

