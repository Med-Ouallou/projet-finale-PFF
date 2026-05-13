export default function categoriesApp(initialData) {
    return {
        allCategories: initialData.categories || [],
        menus: initialData.menus || [],
        search: '',
        statusFilter: initialData.filters?.is_active || '',
        showCreateModal: false,
        filteredCategories: [],
        
        init() {
            this.applyFilters();
            // In a real app, you might want to handle errors differently since we are in JS now
        },
        
        applyFilters() {
            this.filteredCategories = this.allCategories.filter(category => {
                const matchesSearch = !this.search || 
                    (category.name && category.name.toLowerCase().includes(this.search.toLowerCase()));
                const matchesStatus = this.statusFilter === '' || 
                    category.is_active == (this.statusFilter === '1');
                return matchesSearch && matchesStatus;
            });
        },
        
        async toggleActive(id) {
            try {
                const response = await fetch(`/admin/categories/${id}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                    }
                });
                if (response.ok) {
                    const data = await response.json();
                    const category = this.allCategories.find(c => c.id === id);
                    if (category) {
                        category.is_active = data.is_active;
                        this.applyFilters();
                    }
                    if (window.showAlert) window.showAlert('Statut modifié avec succès', 'success');
                }
            } catch (error) {
                console.error('Error toggling status:', error);
                if (window.showAlert) window.showAlert('Erreur lors du changement de statut', 'error');
            }
        },
        
        deleteCategory(id) {
            if (window.showConfirm) {
                window.showConfirm('Supprimer cette catégorie ?', async () => {
                    try {
                        const response = await fetch(`/admin/categories/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        const data = await response.json();
                        if (response.ok && data.success) {
                            this.allCategories = this.allCategories.filter(c => c.id !== id);
                            this.applyFilters();
                            if (window.showAlert) window.showAlert('Catégorie supprimée avec succès', 'success');
                        } else {
                            if (window.showAlert) window.showAlert(data.message || 'Erreur lors de la suppression', 'error');
                        }
                    } catch (error) {
                        console.error('Error deleting category:', error);
                    }
                }, { type: 'warning', title: 'Confirmation de suppression' });
            } else {
                if (confirm('Supprimer cette catégorie ?')) {
                    // Fallback delete logic
                }
            }
        }
    }
}
