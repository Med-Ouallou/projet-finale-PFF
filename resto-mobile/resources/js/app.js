import Alpine from 'alpinejs';
import cartStore from './stores/cart';
import { loadAccueil } from './components/accueil';
import { loadMenu } from './components/menu';
import { contactLinks } from './components/contact';

window.Alpine = Alpine;

Alpine.store('cart', cartStore);
Alpine.data('accueil', loadAccueil);
Alpine.data('menu', loadMenu);
Alpine.data('contact', contactLinks);

Alpine.start();
