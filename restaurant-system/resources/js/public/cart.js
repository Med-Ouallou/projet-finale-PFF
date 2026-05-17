export default function cartManager() {
    return {
        cart: JSON.parse(localStorage.getItem('cart')) || [],
        cartOpen: false,
        activeCategory: 'all',
        
        get itemCount() {
            return this.cart.reduce((total, item) => total + item.quantity, 0);
        },
        
        get totalPrice() {
            return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
        },
        
        addToCart(product) {
            const existing = this.cart.find(it => it.id === product.id);
            if (existing) {
                existing.quantity++;
            } else {
                this.cart.push({ ...product, quantity: 1 });
            }
            this.persist();
            this.cartOpen = true;
        },
        
        changeQty(index, delta) {
            this.cart[index].quantity += delta;
            if (this.cart[index].quantity <= 0) {
                this.cart.splice(index, 1);
            }
            this.persist();
        },
        
        persist() {
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        
        async sendToWhatsApp() {
            try {
                // Save to database first
                const response = await fetch('/client/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        items: this.cart,
                        total: this.totalPrice
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 401) {
                        if (window.showAlert) {
                            window.showAlert('Veuillez vous connecter pour commander.', 'warning');
                        } else {
                            alert('Veuillez vous connecter pour commander.');
                        }
                        return;
                    }
                    throw new Error(data.message || 'Erreur lors de l\'enregistrement');
                }

                // If saved successfully, open WhatsApp
                const phoneNumber = "212776440786"; 
                let message = `🍱 *NOUVELLE COMMANDE #${data.order_id} - RESTOMANAGER*\n\n`;
                
                this.cart.forEach(item => {
                    const sub = item.price * item.quantity;
                    message += `• *${item.quantity}x* ${item.name} (_${sub.toFixed(2)} DH_)\n`;
                });
                
                message += `\n💰 *Total : ${this.totalPrice.toFixed(2)} DH*\n\n`;
                message += "📍 _Je souhaite commander ces articles pour une livraison à domicile._\n";
                message += "📞 _Merci de me confirmer la réception._";
                
                const encoded = encodeURIComponent(message);
                
                // Clear cart after success
                this.cart = [];
                this.persist();
                this.cartOpen = false;

                window.open(`https://wa.me/${phoneNumber}?text=${encoded}`, '_blank');

            } catch (error) {
                console.error('Order Error:', error);
                if (window.showAlert) {
                    window.showAlert(error.message, 'error');
                } else {
                    alert(error.message);
                }
            }
        }
    }
}
