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
        
        sendToWhatsApp() {
            const phoneNumber = "212600000000"; 
            let message = "🍱 *NOUVELLE COMMANDE - RESTOMANAGER*\n\n";
            
            this.cart.forEach(item => {
                const sub = item.price * item.quantity;
                message += `• *${item.quantity}x* ${item.name} (_${sub.toFixed(2)} DH_)\n`;
            });
            
            message += `\n💰 *Total : ${this.totalPrice.toFixed(2)} DH*\n\n`;
            message += "📍 _Je souhaite commander ces articles pour une livraison à domicile._\n";
            message += "📞 _Merci de me confirmer la réception._";
            
            const encoded = encodeURIComponent(message);
            window.open(`https://wa.me/${phoneNumber}?text=${encoded}`, '_blank');
        }
    }
}
