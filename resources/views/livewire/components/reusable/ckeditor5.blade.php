<?php

use function Livewire\Volt\{state};

state(['message']);

?>

<div wire:ignore>
    <textarea wire:model.lazy="message" id="message" wire:key="wysiwyg-message">{{$message}}</textarea>
</div>

<script type="module">
    import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
    import Autoformat from '@ckeditor/ckeditor5-autoformat/src/autoformat';
    import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
    import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
    import BlockQuote from '@ckeditor/ckeditor5-block-quote/src/blockquote';
    import Heading from '@ckeditor/ckeditor5-heading/src/heading';
    import Link from '@ckeditor/ckeditor5-link/src/link';
    import List from '@ckeditor/ckeditor5-list/src/list';
    import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';

    document.addEventListener('livewire:load', () => {
        const messageElement = document.querySelector('#message');
        if (messageElement && !messageElement.classList.contains('ckeditor-initialized')) {
            ClassicEditor
                .create(messageElement, {
                    plugins: [
                        Essentials,
                        Autoformat,
                        Bold,
                        Italic,
                        BlockQuote,
                        Heading,
                        Link,
                        List,
                        Paragraph,
                    ],
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            'bulletedList',
                            'numberedList',
                            'blockQuote',
                            'undo',
                            'redo',
                        ]
                    },
                    language: 'en'
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('message', editor.getData());
                    });
                    messageElement.classList.add('ckeditor-initialized');
                })
                .catch(error => {
                    console.error('Editor initialization failed:', error);
                    alert('Failed to initialize the editor. Please try again or contact support.');
                });
        }
    });
</script>
