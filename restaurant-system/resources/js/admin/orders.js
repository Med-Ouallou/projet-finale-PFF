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
        selectedOrder: null,
        showDetailModal: false,

        init() {
            // Initialization if needed
        },

        openDetailModal(order) {
            this.selectedOrder = order;
            this.showDetailModal = true;
            
            // Sync Preline custom select value
            this.$nextTick(() => {
                // Re-initialize Preline select components
                if (window.HSStaticMethods && typeof window.HSStaticMethods.autoInit === 'function') {
                    window.HSStaticMethods.autoInit('select');
                }

                const selectEl = document.getElementById('modal-order-status-select');
                if (selectEl && window.HSSelect) {
                    let selectInstance = window.HSSelect.getInstance(selectEl, true);
                    if (!selectInstance) {
                        try {
                            selectInstance = new window.HSSelect(selectEl);
                        } catch(e) {
                            console.warn("Failed to instantiate HSSelect:", e);
                        }
                    }
                    if (selectInstance) {
                        selectInstance.value = [order.status];
                        // Force refresh UI
                        selectInstance.destroy();
                        selectInstance.init();
                    }
                }
            });
        },

        async updateOrderStatus(id, status) {
            try {
                const response = await fetch(`/admin/orders/${id}/status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ status: status })
                });

                const data = await response.json();
                if (response.ok) {
                    const order = this.orders.find(o => o.id === id);
                    if (order) {
                        order.status = status;
                    }
                    if (this.selectedOrder && this.selectedOrder.id === id) {
                        this.selectedOrder.status = status;
                        // Sync select UI
                        const selectEl = document.getElementById('modal-order-status-select');
                        if (selectEl && window.HSSelect) {
                            const selectInstance = window.HSSelect.getInstance(selectEl, true);
                            if (selectInstance) {
                                selectInstance.value = [status];
                                selectInstance.destroy();
                                selectInstance.init();
                            }
                        }
                    }
                    if (window.showAlert) {
                        window.showAlert('Statut mis à jour avec succès', 'success');
                    } else {
                        alert('Statut mis à jour avec succès');
                    }
                } else {
                    if (window.showAlert) {
                        window.showAlert(data.message || 'Erreur lors de la mise à jour', 'error');
                    } else {
                        alert(data.message || 'Erreur lors de la mise à jour');
                    }
                }
            } catch (error) {
                console.error('Error updating order status:', error);
            }
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
