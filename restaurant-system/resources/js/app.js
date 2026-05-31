import './bootstrap';
import Alpine from 'alpinejs';
import 'preline';
import cartManager from './public/cart';
import categoriesApp from './admin/categories';
import menuItemsApp from './admin/menu-items';
import usersApp from './admin/users';
import inventoryApp from './admin/inventory';
import alertComponent from './components/alert';
import adminLayout from './admin/layout';
import menusApp from './admin/menus';
import ordersApp from './admin/orders';
import promotionsApp from './admin/promotions';
import chatbotApp from './admin/chatbot';

window.Alpine = Alpine;
Alpine.data('cartManager', cartManager);
Alpine.data('categoriesApp', categoriesApp);
Alpine.data('menuItemsApp', menuItemsApp);
Alpine.data('usersApp', usersApp);
Alpine.data('inventoryApp', inventoryApp);
Alpine.data('alertComponent', alertComponent);
Alpine.data('adminLayout', adminLayout);
Alpine.data('menusApp', menusApp);
Alpine.data('ordersApp', ordersApp);
Alpine.data('promotionsApp', promotionsApp);
Alpine.data('chatbotApp', chatbotApp);

Alpine.start();

// Ensure Preline UI initializes properly, especially useful with Vite HMR
document.addEventListener('DOMContentLoaded', () => {
    if (window.HSStaticMethods && typeof window.HSStaticMethods.autoInit === 'function') {
        window.HSStaticMethods.autoInit();
    }
});

// Re-initialize Preline components after Vite Hot Module Replacement
if (import.meta.hot) {
    import.meta.hot.accept(() => {
        setTimeout(() => {
            if (window.HSStaticMethods && typeof window.HSStaticMethods.autoInit === 'function') {
                window.HSStaticMethods.autoInit();
            }
        }, 100);
    });
}
