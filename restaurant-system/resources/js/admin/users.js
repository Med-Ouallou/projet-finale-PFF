export default function usersApp(initialData) {
    return {
        allUsers: initialData.users || [],
        authId: initialData.authId,
        search: '',
        roleFilter: initialData.filters?.role || '',
        showCreateModal: false,
        showEditModal: false,
        editForm: {
            id: null,
            name: '',
            email: '',
            password: '',
            role: ''
        },
        filteredUsers: [],
        currentPage: 1,
        perPage: 10,
        
        init() {
            this.applyFilters();
        },

        openEditModal(user) {
            this.editForm = {
                id: user.id,
                name: user.name,
                email: user.email,
                password: '',
                role: user.roles?.[0]?.name || ''
            };
            this.showEditModal = true;
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
            this.currentPage = 1;
        },

        get paginatedUsers() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredUsers.slice(start, start + this.perPage);
        },

        get totalPages() {
            return Math.ceil(this.filteredUsers.length / this.perPage);
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
