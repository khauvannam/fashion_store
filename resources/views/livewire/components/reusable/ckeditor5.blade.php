<?php

use Livewire\Attributes\Modelable;
use Livewire\Volt\Component;

new class extends component {

    #[Modelable]
    public string $message = ''
}


?>

<div class="">
    <div wire:ignore>
        <textarea wire:model.lazy="message" id="message" wire:key="wysiwyg-message">{{$message}}</textarea>
    </div>

    <p>{{$message}}</p>
</div>


@push('scripts')
    <script type="module">

        import {
            Bold,
            ClassicEditor,
            Essentials,
            Font,
            GeneralHtmlSupport,
            Italic,
            Paragraph,
            Style,
        } from '{{asset('assets/vendor/ckeditor5.js')}}';

        ClassicEditor
            .create(document.querySelector('#message'), {
                plugins: [Style, Essentials, Paragraph, Bold, Italic, Font, GeneralHtmlSupport],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'style',
                ],
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3MzU4NjIzOTksImp0aSI6IjU5OGNmYzk3LTcwNzMtNDA0My05NTgyLWUyZjVkNmQxYjRlYSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImFjYmYwZGJhIn0.gk0TLH8QK4kT__FRuPSpdFBKCPdgttkVymMvD1VA-vD_ycMjHSwB81Se8gUtdcZaJSFPafnwgwaLDX1AU-lk6w',
                style: {
                    definitions: [
                        {
                            name: 'Article category',
                            element: 'h3',
                            classes: ['category']
                        },
                        {
                            name: 'Info box',
                            element: 'p',
                            classes: ['info-box']
                        },
                    ]
                }
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.
                    set('message', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endpush
