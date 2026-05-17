export function loadAccueil(apiUrl) {
    return {
        categories: [],
        promo: null,
        loading: true,

        init() {
            Promise.all([
                fetch(`${apiUrl}/api/promotions/active`).then(r => r.json()).catch(() => null),
                fetch(`${apiUrl}/api/categories`).then(r => r.json()).catch(() => [])
            ]).then(([promo, categories]) => {
                this.promo = promo;
                this.categories = categories;
                this.loading = false;
            });
        }
    };
}
