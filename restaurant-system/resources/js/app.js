import './bootstrap';
import Alpine from 'alpinejs';
import cartManager from './public/cart';
import categoriesApp from './admin/categories';
import menuItemsApp from './admin/menu-items';
import usersApp from './admin/users';
import inventoryApp from './admin/inventory';
import alertComponent from './components/alert';
import adminLayout from './admin/layout';
import menusApp from './admin/menus';

window.Alpine = Alpine;
Alpine.data('cartManager', cartManager);
Alpine.data('categoriesApp', categoriesApp);
Alpine.data('menuItemsApp', menuItemsApp);
Alpine.data('usersApp', usersApp);
Alpine.data('inventoryApp', inventoryApp);
Alpine.data('alertComponent', alertComponent);
Alpine.data('adminLayout', adminLayout);
Alpine.data('menusApp', menusApp);

Alpine.start();
