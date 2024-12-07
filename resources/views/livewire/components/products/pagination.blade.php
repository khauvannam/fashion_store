<?php


use Livewire\Volt\Component;
use App\Models\Product;


new class extends Component {
    public int $totalPages;

    public int $page;
    public function setPage(int $page)
    {
        $this->page = $page;
        $this->emit('pageChanged', $this->page);
    }
};

?>
    <div class="flex justify-center items-center mt-4 gap-5 my-5">
        @for ($pageIndex = 0; $pageIndex < $totalPages; $pageIndex++)
            <button 
                wire:click="setPage({{ $pageIndex }})" 
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 {{ $pageIndex == $page ? 'bg-blue-500 text-white' : '' }}">
                {{ $pageIndex + 1 }}
            </button>
        @endfor
    </div>