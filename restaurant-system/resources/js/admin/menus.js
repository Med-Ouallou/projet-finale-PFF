export default function menusApp(initialData) {
    return {
        menus: initialData.menus || [],
        allMenus: initialData.menus || [],
        filters: initialData.filters || {},
        search: '',
        statusFilter: initialData.filters?.is_active !== null ? String(initialData.filters.is_active) : '',
        showCreateModal: false,
        filteredMenus: [],
        hasErrors: initialData.hasErrors || false,
        
        init() {
            this.applyFilters();
            if (this.hasErrors) {
                this.showCreateModal = true;
            }
        },
        
        applyFilters() {
            this.filteredMenus = this.allMenus.filter(menu => {
                const matchesSearch = !this.search || 
                    (menu.name && menu.name.toLowerCase().includes(this.search.toLowerCase()));
                const matchesStatus = this.statusFilter === '' || 
                    menu.is_active === (this.statusFilter === '1');
                return matchesSearch && matchesStatus;
            });
        },
        
        async toggleStatus(id) {
            try {
                const response = await fetch(`/admin/menus/${id}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                    }
                });
                if (response.ok) {
                    const data = await response.json();
                    const menu = this.allMenus.find(m => m.id === id);
                    if (menu) {
                        menu.is_active = data.is_active;
                        this.applyFilters();
                    }
                    if (window.showAlert) window.showAlert('Statut modifié avec succès', 'success');
                }
            } catch (error) {
                console.error('Error toggling status:', error);
                if (window.showAlert) window.showAlert('Erreur lors du changement de statut', 'error');
            }
        },
        
        deleteMenu(id) {
            if (window.showConfirm) {
                window.showConfirm('Supprimer ce menu ?', async () => {
                    try {
                        const response = await fetch(`/admin/menus/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        const data = await response.json();
                        if (response.ok && data.success) {
                            this.allMenus = this.allMenus.filter(m => m.id !== id);
                            this.applyFilters();
                            if (window.showAlert) window.showAlert('Menu supprimé avec succès', 'success');
                        } else {
                            if (window.showAlert) window.showAlert(data.message || 'Erreur lors de la suppression', 'error');
                        }
                    } catch (error) {
                        console.error('Error deleting menu:', error);
                    }
                }, { type: 'warning', title: 'Confirmation de suppression' });
            } else {
                if (confirm('Supprimer ce menu ?')) {
                    // Fallback delete
                }
            }
        }
    }
}
