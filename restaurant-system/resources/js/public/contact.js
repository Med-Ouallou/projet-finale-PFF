export default function contactForm(accessKey) {
    return {
        sending: false,
        async submitForm(e) {
            this.sending = true;
            const form = e.target;
            
            // Safe alert helper in case window.showAlert is not registered yet
            const triggerAlert = (msg, type = 'info') => {
                if (window.showAlert) {
                    window.showAlert(msg, type);
                } else {
                    alert(msg);
                }
            };
            
            // Helper function to clear fields
            const clearFormFields = () => {
                form.reset();
                form.querySelectorAll('input[type="text"], input[type="email"], textarea').forEach(input => {
                    input.value = '';
                });
                if (window.HSStaticMethods && typeof window.HSStaticMethods.autoInit === 'function') {
                    window.HSStaticMethods.autoInit('select');
                }
            };

            // DEMO MODE: If no API key is configured, simulate success to allow easy testing/demo
            if (!accessKey || accessKey.trim() === '' || accessKey.includes('WEB3FORMS_ACCESS_KEY')) {
                await new Promise(resolve => setTimeout(resolve, 1000)); // Simulate network latency
                triggerAlert('Votre message a bien été envoyé (Mode Démo). Nous vous répondrons sous 24h.', 'success');
                clearFormFields();
                this.sending = false;
                return;
            }

            try {
                const formData = new FormData(form);
                const response = await fetch('https://api.web3forms.com/submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        access_key: accessKey,
                        name: formData.get('name'),
                        email: formData.get('email'),
                        subject: formData.get('subject'),
                        message: formData.get('message'),
                        from_name: 'Resto Manager'
                    })
                });
                
                const result = await response.json();
                if (response.ok && result.success) {
                    triggerAlert('Votre message a bien été envoyé. Nous vous répondrons sous 24h.', 'success');
                    clearFormFields();
                } else {
                    triggerAlert(result.message || 'Une erreur est survenue lors de l\'envoi du message.', 'error');
                }
            } catch (error) {
                console.error(error);
                triggerAlert('Impossible de contacter le serveur. Veuillez réessayer plus tard.', 'error');
            } finally {
                this.sending = false;
            }
        }
    }
}


