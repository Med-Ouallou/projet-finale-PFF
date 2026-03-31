export default {
    items: [],
    isOpen: false,
    whatsappPhone: '',

    init(phone) {
        this.whatsappPhone = phone;
    },

    addItem(item) {
        const existing = this.items.find(c => c.id === item.id);
        if (existing) {
            existing.quantity++;
        } else {
            this.items.push({
                id: item.id,
                name: item.name,
                price: parseFloat(item.price),
                quantity: 1
            });
        }
    },

    changeQty(index, delta) {
        this.items[index].quantity += delta;
        if (this.items[index].quantity <= 0) {
            this.items.splice(index, 1);
        }
    },

    get count() {
        return this.items.reduce((sum, i) => sum + i.quantity, 0);
    },

    get total() {
        return this.items.reduce((sum, i) => sum + (i.price * i.quantity), 0);
    },

    get whatsappUrl() {
        if (this.items.length === 0) return '#';
        let msg = '🍽️ *COMMANDE RestoManager*\n\n';
        this.items.forEach(i => {
            msg += `• *${i.quantity}x* ${i.name} (${(i.price * i.quantity).toFixed(2)} DH)\n`;
        });
        msg += `\n💰 *Total : ${this.total.toFixed(2)} DH*`;
        return `https://wa.me/${this.whatsappPhone}?text=${encodeURIComponent(msg)}`;
    }
};
