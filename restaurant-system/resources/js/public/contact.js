export default function contactForm(accessKey) {
    return {
        sending: false,
        async submitForm(e) {
            this.sending = true;
            try {
                const formData = new FormData(e.target);
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
                    window.showAlert('Votre message a bien été envoyé. Nous vous répondrons sous 24h.', 'success');
                    e.target.reset();
                } else {
                    window.showAlert(result.message || 'Une erreur est survenue lors de l\'envoi du message.', 'error');
                }
            } catch (error) {
                console.error(error);
                window.showAlert('Impossible de contacter le serveur. Veuillez réessayer plus tard.', 'error');
            } finally {
                this.sending = false;
            }
        }
    }
}
