import './bootstrap';
import Alpine from 'alpinejs';
import cartManager from './public/cart';

window.Alpine = Alpine;
Alpine.data('cartManager', cartManager);

Alpine.start();
