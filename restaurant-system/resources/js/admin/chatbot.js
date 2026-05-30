export default function chatbotApp(config) {
    const DEFAULT_MESSAGE = {
        sender: 'bot',
        text: "Bonjour ! Je suis votre assistant de gestion IA. Choisissez ce que vous voulez faire ou posez-moi directement votre question :",
        options: [
            { label: "Créer un menu", prompt: "Ajoute le menu [Nom]", icon: "menu" },
            { label: "Créer une catégorie", prompt: "Ajoute la catégorie [Nom]", icon: "category" },
            { label: "Ajouter un plat", prompt: "Ajoute le plat [Nom] à la catégorie [Catégorie] pour [Prix] DH", icon: "item" },
            { label: "Modifier une commande", prompt: "Marque la commande #[ID] comme [prête/livrée/annulée]", icon: "order" },
            { label: "Rapport financier", prompt: "Donne-moi le rapport financier d'aujourd'hui", icon: "report" },
            { label: "Vérifier les ruptures", prompt: "Quels plats sont en rupture de stock ?", icon: "stock" },
            { label: "Signaler une rupture", prompt: "Rend le plat [Nom] indisponible", icon: "block" }
        ]
    };

    const messageUrl = config?.messageUrl || '/admin/chatbot/message';

    return {
        open: false,
        unread: false,
        newMessage: '',
        isLoading: false,
        messages: [],
        reloadTimeoutId: null,
        
        init() {
            window.addEventListener('beforeunload', () => {
                if (this.reloadTimeoutId) {
                    clearTimeout(this.reloadTimeoutId);
                }
            });

            // Load messages from localStorage
            const stored = localStorage.getItem('resto_chatbot_messages');
            if (stored) {
                try {
                    this.messages = JSON.parse(stored);
                } catch(e) {
                    this.messages = [DEFAULT_MESSAGE];
                }
            } else {
                this.messages = [DEFAULT_MESSAGE];
            }

            // Restore open state
            const wasOpen = localStorage.getItem('resto_chatbot_open');
            if (wasOpen === 'true') {
                this.open = true;
            }

            this.scrollToBottom();
        },
        saveState() {
            localStorage.setItem('resto_chatbot_messages', JSON.stringify(this.messages));
            localStorage.setItem('resto_chatbot_open', this.open ? 'true' : 'false');
        },
        toggleOpen() {
            this.open = !this.open;
            if (this.open) {
                this.unread = false;
            }
            this.saveState();
            this.scrollToBottom();
        },
        clearHistory() {
            if (window.showConfirm) {
                window.showConfirm("Effacer tout l'historique de discussion ?", () => {
                    this.messages = [DEFAULT_MESSAGE];
                    this.saveState();
                }, { type: 'warning', title: "Confirmation d'effacement" });
            } else {
                if (confirm("Effacer tout l'historique de discussion ?")) {
                    this.messages = [DEFAULT_MESSAGE];
                    this.saveState();
                }
            }
        },
        useOption(text) {
            this.newMessage = text;
            this.$nextTick(() => {
                const input = this.$el.querySelector('input[type="text"]');
                if (input) {
                    input.focus();
                }
            });
        },
        async sendMessage() {
            if (!this.newMessage.trim() || this.isLoading) return;

            const textToSend = this.newMessage.trim();
            this.messages.push({
                sender: 'user',
                text: textToSend
            });
            this.newMessage = '';
            this.isLoading = true;
            this.saveState();
            this.scrollToBottom();

            try {
                const response = await fetch(messageUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: textToSend })
                });

                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }

                const result = await response.json();
                
                this.messages.push({
                    sender: 'bot',
                    text: result.message,
                    success: result.success || false
                });

                this.saveState();

                if (result.success) {
                    window.dispatchEvent(new CustomEvent('db-updated', { detail: result }));
                    
                    // Reload page after a delay to reflect DB update
                    this.reloadTimeoutId = setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }

            } catch (error) {
                console.error("Chatbot request failed:", error);
                this.messages.push({
                    sender: 'bot',
                    text: "Une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer."
                });
                this.saveState();
            } finally {
                this.isLoading = false;
                this.scrollToBottom();
                if (!this.open) {
                    this.unread = true;
                }
            }
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.chatBox;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        }
    };
}
