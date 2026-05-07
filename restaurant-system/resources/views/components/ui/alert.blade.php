{{--
    Reusable Alert Component
    Usage: Include this in your layout once, then use window.showAlert(message, type) from anywhere
    
    Types: 'success', 'error', 'warning', 'info'
--}}
<div x-data="alertComponent()" x-show="visible" x-cloak style="display: none;"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
    @keydown.escape.window="close()">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="close()"></div>
    
    <!-- Alert Dialog -->
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden transform transition-all"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95">
        
        <!-- Header with Icon -->
        <div class="p-6 pb-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                    :class="{
                        'bg-emerald-100 text-emerald-600': type === 'success',
                        'bg-red-100 text-red-600': type === 'error',
                        'bg-amber-100 text-amber-600': type === 'warning',
                        'bg-blue-100 text-blue-600': type === 'info'
                    }">
                    <svg x-show="type === 'success'" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="type === 'error'" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    <svg x-show="type === 'warning'" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    <svg x-show="type === 'info'" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900" x-text="title"></h3>
                    <p class="text-sm text-gray-500 mt-0.5" x-show="subtitle" x-text="subtitle"></p>
                </div>
            </div>
        </div>
        
        <!-- Message -->
        <div class="px-6 pb-4">
            <p class="text-gray-700" x-text="message"></p>
        </div>
        
        <!-- Actions -->
        <div class="px-6 py-4 bg-gray-50 flex gap-3 justify-end">
            <button x-show="showCancel" @click="close()" 
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                Annuler
            </button>
            <button @click="confirm()" 
                class="px-4 py-2 text-sm font-bold text-white rounded-xl transition"
                :class="{
                    'bg-emerald-600 hover:bg-emerald-700': type === 'success',
                    'bg-red-600 hover:bg-red-700': type === 'error',
                    'bg-amber-600 hover:bg-amber-700': type === 'warning',
                    'bg-blue-600 hover:bg-blue-700': type === 'info'
                }"
                x-text="confirmText">
            </button>
        </div>
    </div>
</div>

<script>
    function alertComponent() {
        return {
            visible: false,
            type: 'info',
            title: '',
            message: '',
            subtitle: '',
            confirmText: 'OK',
            showCancel: false,
            onConfirm: null,
            
            init() {
                // Register global function
                window.showAlert = (message, type = 'info', options = {}) => {
                    this.message = message;
                    this.type = type;
                    this.title = options.title || this.getDefaultTitle(type);
                    this.subtitle = options.subtitle || '';
                    this.confirmText = options.confirmText || 'OK';
                    this.showCancel = options.showCancel || false;
                    this.onConfirm = options.onConfirm || null;
                    this.visible = true;
                };
                
                window.showConfirm = (message, onConfirm, options = {}) => {
                    this.message = message;
                    this.type = options.type || 'warning';
                    this.title = options.title || 'Confirmation';
                    this.subtitle = options.subtitle || '';
                    this.confirmText = options.confirmText || 'Confirmer';
                    this.showCancel = true;
                    this.onConfirm = onConfirm;
                    this.visible = true;
                };
            },
            
            getDefaultTitle(type) {
                const titles = {
                    'success': 'Succès',
                    'error': 'Erreur',
                    'warning': 'Attention',
                    'info': 'Information'
                };
                return titles[type] || 'Information';
            },
            
            close() {
                this.visible = false;
                this.onConfirm = null;
            },
            
            confirm() {
                if (this.onConfirm) {
                    this.onConfirm();
                }
                this.close();
            }
        }
    }
</script>
