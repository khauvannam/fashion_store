<div class="fixed top-100 right-0 left-0 z-50 container mx-auto flex justify-end  ">
    <div id="toast-container">
        <!-- Container for the toasts -->
    </div>
</div>

<script>
    let toastQueue;
    if (!window.toastQueue) {
        toastQueue = [];
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('toast', ({message, type = 'error'}) => {

            let color;
            let svg;

            switch (type) {
                case 'success': {
                    color = 'bg-green-500';
                    svg = `<svg class="w-5 h-5 text-blue-600 dark:text-blue-500 rotate-45"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 18 20">
                    <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9" />
                </svg>`;
                    break;
                }

                case 'error': {
                    color = 'bg-red-500';
                    svg = `<svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                   <path d="M12 2L2 22h20L12 2zm0 16v2h-2v-2h2zm0-8v6h-2V10h2z" fill="currentColor"/>
               </svg>`;
                    break;
                }

                case 'message': {
                    color = 'bg-blue-500';
                    svg = `<svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                   <path d="M4 4h16v14H5.17L4 20.17V4z" stroke="currentColor" stroke-width="2"/>
               </svg>`;
                    break;
                }
            }

            // Push the new message to the queue
            toastQueue.push(message);

            // Get the toast container element
            const toastContainer = document.getElementById('toast-container');

            // Re-render only the newly pushed messages
            const newToast = document.createElement('div');
            newToast.classList.add('flex', 'flex-col', 'mt-3', 'justify-center', 'w-full', 'max-w-xs',
                'text-gray-500', 'bg-white', 'divide-x',
                'divide-gray-200', 'rounded-lg', 'shadow-2xl');
            newToast.setAttribute('data-message', message); // Unique identifier for the toast

            // Toast content
            newToast.innerHTML = `
                <div class="flex justify-between items-center w-full p-4">
                    ${type}
                    <div class="ps-4 text-sm font-normal">${message}</div>
                </div>`;

            toastContainer.appendChild(newToast);

            const progress = document.createElement('div');
            progress.innerHTML = `
              <div class="toast-loading-progress w-full h-1 ${color} rounded-b-lg z-50 animate-loadingBorder"></div>
            `;
            // Add toast to the container
            newToast.appendChild(progress);

            // Apply fade-in effect
            newToast.classList.add('animate-fade-in');

            // Ensure no more than 3 toasts are visible
            if (toastQueue.length > 3) {
                const oldestToast = toastContainer.querySelector('[data-message="' + toastQueue[0] + '"]');
                if (oldestToast) {
                    toastContainer.removeChild(oldestToast);
                    toastQueue.shift(); // Remove the oldest toast from the queue
                }
            }

            // Automatically hide the toast after 3 seconds and remove from the DOM
            setTimeout(() => {

                newToast.classList.add('animate-fade-out');
                // Wait for the fade-out animation to finish before removing the toast
                setTimeout(() => {
                    toastContainer.removeChild(newToast);

                    // Shift the toastQueue to maintain up-to-date messages
                    toastQueue.shift();
                }, 500); // Match the duration of the fade-out animation

            }, 3000);
        });
    });
</script>


