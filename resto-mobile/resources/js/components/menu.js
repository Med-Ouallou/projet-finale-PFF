export function loadMenu(apiUrl) {
    return {
        categories: [],
        items: [],
        selectedCategory: null,
        loading: true,

        init() {
            const params = new URLSearchParams(window.location.search);
            const catId = params.get('category');
            if (catId) this.selectedCategory = parseInt(catId);

            Promise.all([
                fetch(`${apiUrl}/api/categories`).then(r => r.json()).catch(() => []),
                fetch(`${apiUrl}/api/menu-items`).then(r => r.json()).catch(() => [])
            ]).then(([categories, items]) => {
                this.categories = categories;
                this.items = items;
                this.loading = false;
            });
        },

        get filteredItems() {
            if (!this.selectedCategory) return this.items;
            return this.items.filter(i => i.category_id === this.selectedCategory);
        }
    };
}
