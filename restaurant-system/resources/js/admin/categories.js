export default function categoriesApp(initialData) {
    return {
        allCategories: initialData.categories || [],
        menus: initialData.menus || [],
        search: '',
        statusFilter: initialData.filters?.is_active || '',
        showCreateModal: false,
        showEditModal: false,
        editForm: {
            id: null,
            name: '',
            menu_id: '',
            description: '',
            display_order: 0,
            is_active: 1
        },
        filteredCategories: [],

        init() {
            this.applyFilters();
        },

        openEditModal(category) {
            this.editForm = {
                id: category.id,
                name: category.name,
                menu_id: category.menu_id,
                description: category.description || '',
                display_order: category.display_order || 0,
                is_active: category.is_active ? 1 : 0
            };
            this.showEditModal = true;
        },

        async submitUpdate() {
            try {
                const response = await fetch(`/admin/categories/${this.editForm.id}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.editForm)
                });

                if (response.ok) {
                    const data = await response.json();
                    
                    // Update local state
                    const catIndex = this.allCategories.findIndex(c => c.id === this.editForm.id);
                    if (catIndex !== -1) {
                        // Find the menu object for the display
                        const selectedMenu = this.menus.find(m => m.id == this.editForm.menu_id);
                        
                        this.allCategories[catIndex] = {
                            ...this.allCategories[catIndex],
                            name: this.editForm.name,
                            menu_id: this.editForm.menu_id,
                            description: this.editForm.description,
                            display_order: this.editForm.display_order,
                            is_active: this.editForm.is_active == 1,
                            menu: selectedMenu ? { name: selectedMenu.name } : null
                        };
                        this.applyFilters();
                    }

                    this.showEditModal = false;
                    if (window.showAlert) window.showAlert('Catégorie modifiée avec succès', 'success');
                } else {
                    const errorData = await response.json();
                    if (window.showAlert) window.showAlert(errorData.message || 'Erreur de validation', 'error');
                }
            } catch (error) {
                console.error('Error updating category:', error);
                if (window.showAlert) window.showAlert('Erreur de connexion', 'error');
            }
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
