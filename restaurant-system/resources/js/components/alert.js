export default function alertComponent() {
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
