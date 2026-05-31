export default function ordersApp(initialData) {
    return {
        orders: initialData.orders?.data || [],
        pagination: initialData.orders || {},
        filters: {
            status: initialData.filters?.status || '',
            date_from: initialData.filters?.date_from || '',
            date_to: initialData.filters?.date_to || '',
        },
        isLoading: false,

        init() {
            // Initialization if needed
        },

        async applyFilters(page = 1) {
            this.isLoading = true;
            const params = new URLSearchParams();
            
            if (this.filters.status) params.append('status', this.filters.status);
            if (this.filters.date_from) params.append('date_from', this.filters.date_from);
            if (this.filters.date_to) params.append('date_to', this.filters.date_to);
            params.append('page', page);

            try {
                const response = await fetch(`/admin/orders?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    this.orders = data.orders.data;
                    this.pagination = data.orders;
                    this.filters = data.filters;

                    // Update URL without page reload
                    const newUrl = `${window.location.pathname}?${params.toString()}`;
                    window.history.pushState({ path: newUrl }, '', newUrl);
                }
            } catch (error) {
                console.error('Error loading orders:', error);
            } finally {
                this.isLoading = false;
            }
        },

        async cancelOrder(id) {
            const confirmAction = async () => {
                try {
                    const response = await fetch(`/admin/orders/${id}/cancel`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                            'Accept': 'application/json',
                        }
                    });

                    const data = await response.json();
                    if (response.ok && data.success) {
                        const order = this.orders.find(o => o.id === id);
                        if (order) {
                            order.status = 'cancelled';
                        }
                        if (window.showAlert) {
                            window.showAlert('Commande annulée avec succès', 'success');
                        } else {
                            alert('Commande annulée avec succès');
                        }
                    } else {
                        if (window.showAlert) {
                            window.showAlert(data.message || 'Erreur lors de l\'annulation', 'error');
                        } else {
                            alert(data.message || 'Erreur lors de l\'annulation');
                        }
                    }
                } catch (error) {
                    console.error('Error cancelling order:', error);
                }
            };

            if (window.showConfirm) {
                window.showConfirm('Annuler cette commande ?', confirmAction, {
                    type: 'warning',
                    title: 'Confirmation d\'annulation'
                });
            } else {
                if (confirm('Annuler cette commande ?')) {
                    confirmAction();
                }
            }
        },

        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        },

        getStatusClass(status) {
            const classes = {
                'pending': 'bg-amber-100 text-amber-800',
                'preparing': 'bg-blue-100 text-blue-800',
                'ready': 'bg-purple-100 text-purple-800',
                'delivered': 'bg-emerald-100 text-emerald-800',
                'cancelled': 'bg-red-100 text-red-800',
            };
            return classes[status] || 'bg-gray-100 text-gray-800';
        },

        getStatusLabel(status) {
            const labels = {
                'pending': 'En attente',
                'preparing': 'En préparation',
                'ready': 'Prête',
                'delivered': 'Livrée',
                'cancelled': 'Annulée',
            };
            return labels[status] || 'Inconnu';
        }
    };
}
