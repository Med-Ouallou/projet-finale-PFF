# RestoManager Mobile App - Implementation Plan

## Overview

- **Stack:** Laravel 12 + NativePHP Mobile + Tailwind CSS (CDN) + Alpine.js (CDN)
- **Architecture:** Two separate Laravel projects communicating via REST API
- **Pages:** Accueil, Menu (with cart), Contact

### Project Structure

```
C:\GitHub\projet-finale-PFF\
├── restaurant-system/     ← API Backend (existing, port 8000)
│   ├── MySQL: restaurant_db
│   ├── routes/api.php
│   └── app/Http/Controllers/Api/
└── resto-mobile/          ← Mobile Frontend (new, port 8001)
    ├── No database (pure API consumer)
    ├── RESTO_API_URL=http://localhost:8000
    ├── resources/views/mobile/
    └── NativePHP mobile config
```

---

## Phase 1: API Backend (restaurant-system)

### 1.1 Enable API Routing

Modify `bootstrap/app.php` to register API routes:

```php
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
```

### 1.2 API Controllers

```
restaurant-system/app/Http/Controllers/Api/
├── CategoryController.php
├── MenuItemController.php
├── MenuController.php
├── OrderController.php
└── PromotionController.php
```

### 1.3 API Endpoints

| Method | Endpoint | Description | Service/Model |
|--------|----------|-------------|---------------|
| GET | `/api/categories` | All active categories (per menu) | CategoryService |
| GET | `/api/categories/{id}/items` | Items by category | MenuItemService.getByCategory() |
| GET | `/api/menus` | Active menus | MenuService.getActiveMenus() |
| GET | `/api/menu-items` | All available items | MenuItemService |
| GET | `/api/menu-items/{id}` | Single item detail | MenuItemService |
| POST | `/api/orders` | Create guest order | OrderService.createOrder() |
| GET | `/api/promotions/active` | Active promotions (date-filtered) | Promotion model |

### 1.4 API Routes (restaurant-system/routes/api.php)

```php
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PromotionController;

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}/items', [CategoryController::class, 'items']);
Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menu-items', [MenuItemController::class, 'index']);
Route::get('/menu-items/{id}', [MenuItemController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/promotions/active', [PromotionController::class, 'active']);
```

### 1.5 Controller Pattern

Each controller delegates to existing Service classes. Controllers handle filtering
that services don't provide (is_active, status=available, date ranges).

```php
class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    public function index()
    {
        return response()->json($this->categoryService->getAll());
    }

    public function items(int $id)
    {
        return response()->json($this->categoryService->getById($id)->menuItems);
    }
}
```

### 1.6 Service Filtering Notes

| Service | Method | Filter Needed |
|---------|--------|---------------|
| CategoryService | getAll() | Returns all categories (no is_active filter). Filter in controller or add getActive() |
| MenuItemService | getAll() | Returns all items (no status filter). Filter in controller or add getAvailable() |
| PromotionController | active() | No PromotionService exists. Query model directly with date filter |

### 1.7 Order Creation (Guest Flow)

POST /api/orders accepts:
```json
{
    "customer_name": "John",
    "customer_phone": "+212600000000",
    "items": [
        {"menu_item_id": 1, "quantity": 2},
        {"menu_item_id": 3, "quantity": 1}
    ],
    "notes": "Extra spicy"
}
```

Controller creates/finds Customer, then calls OrderService.createOrder().

### 1.8 CORS Middleware

Create `restaurant-system/app/Http/Middleware/CorsMiddleware.php`:
- Allow origin from mobile app (configurable)
- Allow methods: GET, POST, OPTIONS
- Register in bootstrap/app.php middleware stack

---

## Phase 2: Mobile Frontend (resto-mobile)

### 2.1 Project Creation

```bash
cd C:\GitHub\projet-finale-PFF
composer create-project laravel/laravel resto-mobile
```

### 2.2 Environment Configuration

```env
# resto-mobile/.env
APP_NAME=RestoManager
APP_URL=http://localhost:8001
RESTO_API_URL=http://localhost:8000
```

### 2.3 API Config

Create `resto-mobile/config/resto.php`:
```php
return [
    'api_url' => env('RESTO_API_URL', 'http://localhost:8000'),
    'whatsapp_phone' => env('WHATSAPP_PHONE', '212600000000'),
];
```

### 2.4 Mobile Page Controller

`resto-mobile/app/Http/Controllers/MobilePageController.php`
- accueil() → returns mobile.pages.accueil view
- menu() → returns mobile.pages.menu view
- contact() → returns mobile.pages.contact view

### 2.5 Web Routes

```php
// resto-mobile/routes/web.php
use App\Http\Controllers\MobilePageController;

Route::prefix('mobile')->group(function () {
    Route::get('/', [MobilePageController::class, 'accueil'])->name('mobile.accueil');
    Route::get('/menu', [MobilePageController::class, 'menu'])->name('mobile.menu');
    Route::get('/contact', [MobilePageController::class, 'contact'])->name('mobile.contact');
});
```

### 2.6 Blade View Structure

```
resto-mobile/resources/views/mobile/
├── layouts/
│   └── app.blade.php              # Master layout
│       - <meta viewport> for mobile
│       - Tailwind CSS via CDN
│       - Alpine.js via CDN
│       - Google Fonts (Outfit + Inter)
│       - @yield('content')
│
├── components/
│   ├── bottom-nav.blade.php       # Fixed bottom navigation
│   │   - Accepts $activePage prop for active state
│   │   - Links: /mobile, /mobile/menu, /mobile/contact
│   │
│   ├── header.blade.php           # Reusable page header
│   │   - Accepts $title, $subtitle props
│   │
│   └── cart-drawer.blade.php      # Alpine.js cart overlay
│       - x-data="{ open: false, items: [], total: 0 }"
│       - Add/remove/quantity controls
│       - WhatsApp order button
│
└── pages/
    ├── accueil.blade.php          # Home page
    │   - Fetches /api/promotions/active for banner
    │   - Fetches /api/categories for quick access
    │   - @include bottom-nav with active='accueil'
    │
    ├── menu.blade.php             # Menu page
    │   - Fetches /api/categories for filter pills
    │   - Fetches /api/menu-items for product cards
    │   - Category filter (client-side Alpine.js filtering)
    │   - Add to cart functionality
    │   - @include cart-drawer
    │   - @include bottom-nav with active='menu'
    │
    └── contact.blade.php          # Contact page
        - Static info cards (Call, Maps)
        - WhatsApp support card
        - @include bottom-nav with active='contact'
```

### 2.7 Data Fetching Pattern (Alpine.js)

All data comes from API. No local database:

```html
<div x-data="{ categories: [], loading: true }"
     x-init="
        fetch('{{ config('resto.api_url') }}/api/categories')
            .then(r => r.json())
            .then(d => { categories = d; loading = false; })
     ">
    <div x-show="loading">Loading...</div>
    <template x-for="cat in categories" :key="cat.id">
        <div x-text="cat.name"></div>
    </template>
</div>
```

### 2.8 Cart Logic (Alpine.js - No Database)

Cart is client-side only. WhatsApp checkout sends order summary:

```javascript
x-data="{
    cart: [],
    isOpen: false,
    addToCart(item) {
        let existing = this.cart.find(i => i.id === item.id);
        if (existing) existing.quantity++;
        else this.cart.push({...item, quantity: 1});
    },
    get total() {
        return this.cart.reduce((sum, i) => sum + (i.price * i.quantity), 0);
    },
    get whatsappUrl() {
        let msg = 'Commande:\\n';
        this.cart.forEach(i => msg += `${i.quantity}x ${i.name} (${i.price * i.quantity} DH)\\n`);
        msg += `Total: ${this.total} DH`;
        return `https://wa.me/{{ config('resto.whatsapp_phone') }}?text=${encodeURIComponent(msg)}`;
    }
}"
```

---

## Phase 3: NativePHP Configuration

### 3.1 Installation (in resto-mobile)

```bash
cd resto-mobile
composer require nativephp/mobile
php artisan native:install
```

### 3.2 Configuration

```env
NATIVEPHP_APP_ID=com.restomanager.mobile
NATIVEPHP_APP_VERSION="1.0.0"
NATIVEPHP_APP_VERSION_CODE="1"
```

### 3.3 config/nativephp.php

```php
'status_bar_style' => 'light',
'min_sdk' => 24,
```

### 3.4 Assets

- App icon: `nativephp/resources/icons/`
- Splash screen: `nativephp/resources/splash/`

---

## File Creation Order

### restaurant-system (API Backend) - 8 files

| # | File | Action | Purpose |
|---|------|--------|---------|
| 1 | `bootstrap/app.php` | Modify | Add API route registration |
| 2 | `routes/api.php` | Create | 7 API endpoints |
| 3 | `app/Http/Controllers/Api/CategoryController.php` | Create | Categories API |
| 4 | `app/Http/Controllers/Api/MenuItemController.php` | Create | Menu items API |
| 5 | `app/Http/Controllers/Api/MenuController.php` | Create | Menus API |
| 6 | `app/Http/Controllers/Api/OrderController.php` | Create | Guest orders API |
| 7 | `app/Http/Controllers/Api/PromotionController.php` | Create | Promotions API |
| 8 | `app/Http/Middleware/CorsMiddleware.php` | Create | CORS headers |

### resto-mobile (Mobile Frontend) - 13 files

| # | File | Action | Purpose |
|---|------|--------|---------|
| 1 | `composer create-project` | Run | Scaffold Laravel 12 |
| 2 | `.env` | Modify | Add RESTO_API_URL, WHATSAPP_PHONE |
| 3 | `config/resto.php` | Create | API URL + WhatsApp config |
| 4 | `app/Http/Controllers/MobilePageController.php` | Create | Page controller |
| 5 | `routes/web.php` | Modify | Mobile page routes |
| 6 | `resources/views/mobile/layouts/app.blade.php` | Create | Master layout |
| 7 | `resources/views/mobile/components/bottom-nav.blade.php` | Create | Bottom nav |
| 8 | `resources/views/mobile/components/header.blade.php` | Create | Header |
| 9 | `resources/views/mobile/components/cart-drawer.blade.php` | Create | Cart drawer |
| 10 | `resources/views/mobile/pages/accueil.blade.php` | Create | Home page |
| 11 | `resources/views/mobile/pages/menu.blade.php` | Create | Menu page |
| 12 | `resources/views/mobile/pages/contact.blade.php` | Create | Contact page |
| 13 | `composer require nativephp/mobile` + `artisan native:install` | Run | NativePHP setup |

---

## Key Design Decisions

1. **Two separate projects** - Clean API/frontend separation
2. **Mobile has no database** - Pure API consumer via RESTO_API_URL
3. **No authentication** - Public API for menu browsing and guest orders
4. **Alpine.js via CDN** - No build step, simple data fetching + cart
5. **Tailwind CSS via CDN** - Matches mockup approach
6. **WhatsApp checkout** - Cart sends order summary to configured phone
7. **Reuses existing Services** - No duplicate business logic in API controllers
8. **CORS middleware** - Manual implementation, no extra packages

---

## Known Issues to Handle

1. **CategoryService::getAll()** returns all categories (no is_active filter)
   → Add is_active filter in CategoryController or add getActive() method
2. **MenuItemService::getAll()** returns all items (no status filter)
   → Add status=available filter in MenuItemController or add getAvailable() method
3. **No PromotionService** exists
   → PromotionController queries model directly with date range filter
4. **OrderService.createOrder()** requires customer_id
   → OrderController must create/find Customer from name+phone before calling service
5. **Category scope**: Categories are per-menu
   → GET /api/categories returns active categories; menu page uses them for filtering

---

## Mobile Pages Map

### Accueil (Home) - /mobile
- Welcome section with branding
- Promo banner (fetched from /api/promotions/active)
- Categories quick access - horizontal scroll (fetched from /api/categories)
- Bottom navigation (active: accueil)

### Menu - /mobile/menu
- Sticky header with cart button + badge
- Category filter pills - horizontal scroll (fetched from /api/categories)
- Product cards - image, name, description, price, add button (fetched from /api/menu-items)
- Category filtering client-side via Alpine.js
- Cart drawer (Alpine.js client-side cart, no API call)
- WhatsApp order button
- Bottom navigation (active: menu)

### Contact - /mobile/contact
- Info cards (Call, Maps links)
- WhatsApp support card
- Bottom navigation (active: contact)

---

## Mockup Reference Files

- `Maquettage/3.maquettage/mockups/mobile-index.html` - Accueil
- `Maquettage/3.maquettage/mockups/mobile-menu.html` - Menu
- `Maquettage/3.maquettage/mockups/mobile-contact.html` - Contact
