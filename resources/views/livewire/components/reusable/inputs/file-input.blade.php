<?php

use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends component {
    use WithFileUploads;

    #[Validate(['photos.*' => 'image|max:5120'])]
    public array $photos = [];

    public function save(): void
    {
        foreach ($this->photos as $photo) {
            $photo->store(path: 'photos');
        }
    }
}

?>

<div>
    <form wire:submit="save">
        <input type="file" wire:model="photos" multiple>

        @error('photos.*') <span class="error">{{ $message }}</span> @enderror
        @if ($photos)
            @foreach($photos as $photo)
                <div class="" wire:key="file-input_{{ $loop->index }}">
                    <img src="{{ $photo->temporaryUrl() }}" alt="">
                </div>
            @endforeach
        @endif
        <button type="submit">Save photo</button>
    </form>
</div>
