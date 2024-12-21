<?php

use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {

    public int $totalPages;

    #[Reactive]
    public int $currentPage = 1;

    #[Reactive]
    public array $pagination = [];

};

?>

<div x-data="pagination" class="flex justify-center items-center mt-4 gap-5 my-5">
    <button
        @click=" scrollToId('product-container'); "
        wire:click="$parent.updateCurrentPage('1')"
        class="px-4 py-2 rounded-md  bg-gray-200 hover:bg-gray-300">
        <svg class="w-6 h-6 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m17 16-4-4 4-4m-6 8-4-4 4-4"/>
        </svg>

    </button>
    @foreach($pagination as $pag)
        <div class="" wire:key="pag_{{ $loop->index  }}">
            <button
                @click="scrollToId('product-container');"
                wire:click="$parent.updateCurrentPage('{{ $pag <= 0 ? 1 : $pag }}' )"
                class="px-4 py-2 text-gray-800 rounded-md {{ $pag == $currentPage ? 'bg-black text-white' : ' bg-gray-200 hover:bg-gray-300' }} "
                {{ $pag < 0 || $pag === $currentPage ? 'disabled' : '' }}>
                {{ $pag > 0 ? $pag : '...' }}
            </button>
        </div>
    @endforeach
    <button
        @click="scrollToId('product-container');"
        wire:click=" $parent.updateCurrentPage('{{ $totalPages }}' ) "
        class="px-4 py-2 rounded-md  bg-gray-200 hover:bg-gray-300">
        <svg class="w-6 h-6 text-black " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m7 16 4-4-4-4m6 8 4-4-4-4"/>
        </svg>

    </button>
    {{--    <div class="flex items-center space-x-4">--}}
    {{--        <label for="page" class="text-gray-700">Đến trang:</label>--}}
    {{--        <input--}}
    {{--            id="page"--}}
    {{--            type="number"--}}
    {{--            min="1"--}}
    {{--            value="1"--}}
    {{--            max="{{ $totalPages }}"--}}
    {{--            x-on:input="clearTimeout(timeout); timeout = setTimeout(() => scrollToId('product-container'), 500)"--}}
    {{--            wire:input.debounce.500ms="$dispatch('updated-current-page', { currentPage:  $event.target.value })"--}}
    {{--            class="px-4 py-2 border rounded-md focus:ring-0 focus:ring-transparent no-spinner"--}}
    {{--            placeholder=""--}}
    {{--        />--}}
    {{--        <span class="text-gray-500">/ {{ $totalPages }} pages</span>--}}
    {{--    </div>--}}
</div>

@push('scripts')
    @script
    <script>
        Alpine.data('pagination', () => {
            return {
                scrollToId(id) {
                    const elementToScroll = document.querySelector(`#${id}`);
                    if (elementToScroll) {
                        elementToScroll.scrollIntoView({
                            behavior: 'smooth', // Smooth scrolling
                            block: 'start', // Align the element to the top of the viewport
                        });
                    }
                }
            }
        })

    </script>
    @endscript
@endpush
