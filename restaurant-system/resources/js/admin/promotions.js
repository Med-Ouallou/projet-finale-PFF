export default function promotionsApp(initialData) {
    return {
        allPromotions: initialData.promotions || [],
        search: '',
        showCreateModal: false,
        showEditModal: false,
        editForm: {
            id: null,
            code: '',
            discount_percentage: '',
            discount_amount: '',
            valid_from: '',
            valid_until: '',
            usage_limit: ''
        },
        filteredPromotions: [],
        currentPage: 1,
        perPage: 10,

        init() {
            this.applyFilters();
        },

        openEditModal(promotion) {
            this.editForm = {
                id: promotion.id,
                code: promotion.code,
                discount_percentage: promotion.discount_percentage || '',
                discount_amount: promotion.discount_amount || '',
                valid_from: promotion.valid_from ? promotion.valid_from.substring(0, 10) : '',
                valid_until: promotion.valid_until ? promotion.valid_until.substring(0, 10) : '',
                usage_limit: promotion.usage_limit || ''
            };
            this.showEditModal = true;
        },

        applyFilters() {
            this.filteredPromotions = this.allPromotions.filter(promo => {
                const matchesSearch = !this.search || 
                    (promo.code && promo.code.toLowerCase().includes(this.search.toLowerCase()));
                return matchesSearch;
            });
            this.currentPage = 1;
        },

        get paginatedPromotions() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredPromotions.slice(start, start + this.perPage);
        },

        get totalPages() {
            return Math.ceil(this.filteredPromotions.length / this.perPage);
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
        
        deletePromotion(id) {
            if (window.showConfirm) {
                window.showConfirm('Supprimer cette promotion ?', async () => {
                    try {
                        const response = await fetch(`/admin/promotions/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                'Accept': 'application/json',
                            }
                        });
                        const data = await response.json();
                        if (response.ok && data.success) {
                            this.allPromotions = this.allPromotions.filter(p => p.id !== id);
                            this.applyFilters();
                            if (window.showAlert) window.showAlert('Promotion supprimée avec succès', 'success');
                        } else {
                            if (window.showAlert) window.showAlert(data.message || 'Erreur lors de la suppression', 'error');
                        }
                    } catch (error) {
                        console.error('Error deleting promotion:', error);
                    }
                }, { type: 'warning', title: 'Confirmation de suppression' });
            }
        }
    }
}
