export default function usersApp(initialData) {
    return {
        allUsers: initialData.users || [],
        authId: initialData.authId,
        search: '',
        roleFilter: initialData.filters?.role || '',
        showCreateModal: false,
        filteredUsers: [],
        
        init() {
            this.applyFilters();
        },
        
        applyFilters() {
            this.filteredUsers = this.allUsers.filter(user => {
                const searchTerm = this.search.toLowerCase();
                const matchesSearch = !this.search || 
                    (user.name && user.name.toLowerCase().includes(searchTerm)) ||
                    (user.email && user.email.toLowerCase().includes(searchTerm));
                const matchesRole = this.roleFilter === '' || 
                    user.role_name === this.roleFilter;
                return matchesSearch && matchesRole;
            });
        },
        
        deleteUser(id) {
            if (window.showConfirm) {
                window.showConfirm('Supprimer cet utilisateur ?', async () => {
                    try {
                        const response = await fetch(`/admin/users/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        const data = await response.json();
                        if (response.ok && data.success) {
                            this.allUsers = this.allUsers.filter(u => u.id !== id);
                            this.applyFilters();
                            if (window.showAlert) window.showAlert('Utilisateur supprimé avec succès', 'success');
                        } else {
                            if (window.showAlert) window.showAlert(data.message || 'Erreur lors de la suppression', 'error');
                        }
                    } catch (error) {
                        console.error('Error deleting user:', error);
                    }
                }, { type: 'warning', title: 'Confirmation de suppression' });
            }
        }
    }
}
