export function contactLinks(whatsappPhone) {
    return {
        whatsappPhone,

        get whatsappUrl() {
            return `https://wa.me/${this.whatsappPhone}`;
        },

        get callUrl() {
            return `tel:+${this.whatsappPhone}`;
        }
    };
}
