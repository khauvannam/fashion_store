<div class="fixed top-100 right-0 left-0 z-50 container mx-auto flex justify-end">
    <div id="toast-container" x-data="toastHandler()">
        <!-- Toasts will be dynamically rendered here -->
        <template x-for="toast in toasts" :key="toast.id">
            <div
                class="flex flex-col mt-3 justify-center w-full overflow-hidden max-w-xs text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow-2xl animate-fade-in"
                x-show="toast.visible"
                x-transition:leave="animate-fade-out"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="flex justify-between items-center w-full p-4">
                    <svg class="w-5 h-5"
                         :class="toast.iconColor"
                         :xmlns="'http://www.w3.org/2000/svg'"
                         fill="none"
                         viewBox="0 0 24 24"
                         aria-hidden="true">
                        <path d="" :d="toast.iconPath" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"></path>
                    </svg>
                    <div class="ps-4 text-sm font-normal" :class="toast.textColor" x-text="toast.message"></div>
                </div>
                <div
                    class="animate-loading-border w-full h-1 rounded-b-lg z-50"
                    :class="toast.borderColor"
                    x-show="toast.visible">
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('toastHandler', () => ({
            toasts: [],
            toastId: 0,

            init() {
                Livewire.on('toast', ({message, type = 'error'}) => {
                    this.addToast(message, type);
                });
            },

            addToast(message, type) {
                const id = this.toastId++;
                const toastDetails = this.getToastDetails(type);

                this.toasts.push({
                    id,
                    message,
                    visible: true,
                    textColor: toastDetails.textColor,
                    borderColor: toastDetails.borderColor,
                    iconColor: toastDetails.iconColor,
                    iconPath: toastDetails.iconPath, // Add the dynamically rendered path for the SVG
                });

                // Ensure no more than 3 toasts
                if (this.toasts.length > 3) {
                    this.removeToast(this.toasts[0].id);
                }

                // Automatically remove toast after 3 seconds
                setTimeout(() => this.removeToast(id), 3000);
            },

            removeToast(id) {
                console.log(this.toasts);
                const toast = this.toasts.find(t => t.id === id);

                if (toast) {
                    toast.visible = false; // Start fade-out transition
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 500); // Allow fade-out animation to finish
                }
            },

            getToastDetails(type) {
                // Define styles and icon paths based on the type
                switch (type) {
                    case 'success':
                        return {
                            textColor: 'text-green-600',
                            borderColor: 'bg-green-400',
                            iconColor: 'text-green-600',
                            iconPath: 'M5 13l4 4L19 7', // Checkmark icon
                        };
                    case 'error':
                        return {
                            textColor: 'text-red-600',
                            borderColor: 'bg-red-400',
                            iconColor: 'text-red-600',
                            iconPath: 'M6 18L18 6M6 6l12 12', // Cross icon
                        };
                    case 'warning':
                        return {
                            textColor: 'text-yellow-600',
                            borderColor: 'bg-yellow-400',
                            iconColor: 'text-yellow-600',
                            iconPath: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.054 0 1.502-1.275.732-2L13.732 4c-.523-.697-1.94-.697-2.464 0L3.34 17c-.77.725-.322 2 .732 2z', // Warning triangle icon
                        };
                    default: // Default to info
                        return {
                            textColor: 'text-blue-600',
                            borderColor: 'bg-blue-400',
                            iconColor: 'text-blue-600',
                            iconPath: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', // Info circle icon
                        };
                }
            },
        }));
    });
</script>
