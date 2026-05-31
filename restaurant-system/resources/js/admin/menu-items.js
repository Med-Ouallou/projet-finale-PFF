export default function menuItemsApp(initialData) {
    return {
        items: initialData.items || [],
        allItems: initialData.items || [],
        categories: initialData.categories || [],
        search: initialData.filters?.search || '',
        categoryFilter: initialData.filters?.category_id || '',
        statusFilter: initialData.filters?.status || '',
        showCreateModal: false,
        showEditModal: false,
        editForm: {
            id: null,
            name: '',
            description: '',
            price: 0,
            status: 'available',
            category_id: '',
            image_url: null
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
                description: item.description || '',
                price: item.price || 0,
                status: item.status || 'available',
                category_id: item.category_id,
                image_url: item.image_url
            };
            this.showEditModal = true;
        },
        
        applyFilters() {
            this.filteredItems = this.allItems.filter(item => {
                const matchesSearch = !this.search || 
                    (item.name && item.name.toLowerCase().includes(this.search.toLowerCase()));
                const matchesCategory = !this.categoryFilter || 
                    item.category_id == this.categoryFilter;
                const matchesStatus = !this.statusFilter || 
                    item.status === this.statusFilter;
                return matchesSearch && matchesCategory && matchesStatus;
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
        
        async toggleStatus(id) {
            try {
                const response = await fetch(`/admin/menu-items/${id}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                    }
                });
                if (response.ok) {
                    const data = await response.json();
                    const item = this.allItems.find(i => i.id === id);
                    if (item) {
                        item.status = data.status;
                        this.applyFilters();
                    }
                    if (window.showAlert) window.showAlert('Statut modifié avec succès', 'success');
                }
            } catch (error) {
                console.error('Error toggling status:', error);
                if (window.showAlert) window.showAlert('Erreur lors du changement de statut', 'error');
            }
        },
        
        deleteItem(id) {
            if (window.showConfirm) {
                window.showConfirm('Supprimer ce plat ?', async () => {
                    try {
                        const response = await fetch(`/admin/menu-items/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        const data = await response.json();
                        if (response.ok && data.success) {
                            this.allItems = this.allItems.filter(i => i.id !== id);
                            this.applyFilters();
                            if (window.showAlert) window.showAlert('Plat supprimé avec succès', 'success');
                        } else {
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
