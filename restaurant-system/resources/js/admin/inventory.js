export default function inventoryApp(initialData) {
    return {
        allItems: initialData.items || [],
        search: '',
        lowStockOnly: initialData.filters?.low_stock || false,
        showCreateModal: false,
        showEditModal: false,
        editForm: {
            id: null,
            name: '',
            reference: '',
            quantity_in_stock: 0,
            unit: '',
            min_threshold: 0
        },
        filteredItems: [],
        currentPage: 1,
        perPage: 10,

        init() {
            this.applyFilters();
        },

        openEditModal(item) {
            this.editForm = {
                id: item.id,
                name: item.name,
                reference: item.reference || '',
                quantity_in_stock: item.quantity_in_stock || 0,
                unit: item.unit || '',
                min_threshold: item.min_threshold || 0
            };
            this.showEditModal = true;
        },
        
        applyFilters() {
            this.filteredItems = this.allItems.filter(item => {
                const searchTerm = this.search.toLowerCase();
                const matchesSearch = !this.search || 
                    (item.name && item.name.toLowerCase().includes(searchTerm)) ||
                    (item.reference && item.reference.toLowerCase().includes(searchTerm));
                const matchesLowStock = !this.lowStockOnly || 
                    item.quantity_in_stock <= item.min_threshold;
                return matchesSearch && matchesLowStock;
            });
            this.currentPage = 1;
        },

        get paginatedItems() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredItems.slice(start, start + this.perPage);
        },

        get totalPages() {
            return Math.ceil(this.filteredItems.length / this.perPage);
        },

        nextPage() {
            if (this.currentPage < this.totalPages) this.currentPage++;
        },

        prevPage() {
            if (this.currentPage > 1) this.currentPage--;
        },

        goToPage(page) {
            this.currentPage = page;
        },
        
        deleteItem(id) {
            if (window.showConfirm) {
                window.showConfirm('Supprimer cet article ?', async () => {
                    try {
                        const response = await fetch(`/admin/inventory/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        if (response.ok) {
                            this.allItems = this.allItems.filter(i => i.id !== id);
                            this.applyFilters();
                            if (window.showAlert) window.showAlert('Article supprimé avec succès', 'success');
                        } else {
                            const data = await response.json();
                            if (window.showAlert) window.showAlert(data.message || 'Erreur lors de la suppression', 'error');
                        }
                    } catch (error) {
                        console.error('Error deleting item:', error);
                    }
                }, { type: 'warning', title: 'Confirmation de suppression' });
            }
        }
    }
}
