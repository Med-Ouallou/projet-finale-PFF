export default function cartManager() {
    return {
        cart: JSON.parse(localStorage.getItem('cart')) || [],
        cartOpen: false,
        activeCategory: 'all',
        couponCode: '',
        appliedCoupon: null,
        couponError: '',
        couponSuccess: '',
        paymentMethod: 'cash',
        
        get itemCount() {
            return this.cart.reduce((total, item) => total + item.quantity, 0);
        },
        
        get subtotal() {
            return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
        },

        get totalPrice() {
            const sub = this.subtotal;
            if (this.appliedCoupon) {
                return Math.max(0, sub - this.appliedCoupon.discount);
            }
            return sub;
        },
        
        addToCart(product) {
            const existing = this.cart.find(it => it.id === product.id);
            if (existing) {
                existing.quantity++;
            } else {
                this.cart.push({ ...product, quantity: 1 });
            }
            this.removeCoupon();
            this.persist();
            this.cartOpen = true;
        },
        
        changeQty(index, delta) {
            this.cart[index].quantity += delta;
            if (this.cart[index].quantity <= 0) {
                this.cart.splice(index, 1);
            }
            this.removeCoupon();
            this.persist();
        },
        
        persist() {
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },

        async applyCoupon() {
            this.couponError = '';
            this.couponSuccess = '';
            if (!this.couponCode.trim()) {
                this.couponError = 'Veuillez saisir un code.';
                return;
            }
            try {
                const response = await fetch('/client/orders/apply-coupon', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        code: this.couponCode,
                        subtotal: this.subtotal
                    })
                });
                const data = await response.json();
                if (response.ok && data.success) {
                    this.appliedCoupon = {
                        code: data.code,
                        discount: data.discount,
                        promotion_id: data.promotion_id
                    };
                    this.couponSuccess = data.message;
                } else {
                    this.couponError = data.message || 'Code invalide.';
                    this.appliedCoupon = null;
                }
            } catch (error) {
                console.error('Error applying coupon:', error);
                this.couponError = 'Erreur lors de la validation.';
                this.appliedCoupon = null;
            }
        },

        removeCoupon() {
            this.appliedCoupon = null;
            this.couponCode = '';
            this.couponError = '';
            this.couponSuccess = '';
        },
        
        async submitOrder() {
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
                        promotion_code: this.appliedCoupon ? this.appliedCoupon.code : null,
                        total: this.totalPrice,
                        payment_method: this.paymentMethod
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
 
                // Clear cart after success
                const savedCart = [...this.cart];
                const savedAppliedCoupon = this.appliedCoupon;
                
                this.cart = [];
                this.persist();
                this.removeCoupon();
                this.cartOpen = false;

                if (this.paymentMethod === 'stripe') {
                    // Redirect to Stripe checkout
                    window.location.href = data.checkout_url;
                    return;
                }
 
                // If saved successfully with Cash on Delivery, open WhatsApp
                const phoneNumber = "212776440786"; 
                let message = `🍱 *NOUVELLE COMMANDE #${data.order_id} - RESTOMANAGER*\n\n`;
                
                savedCart.forEach(item => {
                    const sub = item.price * item.quantity;
                    message += `• *${item.quantity}x* ${item.name} (_${sub.toFixed(2)} DH_)\n`;
                });
                
                if (savedAppliedCoupon) {
                    message += `\n🏷️ *Code Promo :* ${savedAppliedCoupon.code} (-${savedAppliedCoupon.discount.toFixed(2)} DH)\n`;
                }
 
                const totalVal = savedAppliedCoupon ? Math.max(0, savedCart.reduce((t, i) => t + (i.price * i.quantity), 0) - savedAppliedCoupon.discount) : savedCart.reduce((t, i) => t + (i.price * i.quantity), 0);
                message += `\n💰 *Total : ${totalVal.toFixed(2)} DH*\n\n`;
                message += "📍 _Je souhaite commander ces articles pour une livraison à domicile._\n";
                message += "📞 _Merci de me confirmer la réception._";
                
                const encoded = encodeURIComponent(message);
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
