# Composition UI : Rapports & Statistiques Avancés (Admin)

## 1. Structure Globale
- **Conteneur** : Layout Admin Standard (Sidebar + Main + Topbar).
- **Grille** : Flexbox/Grid responsive (Tailwind).

## 2. Décomposition Atomique

### Atomes
- **Titre (H1, H2)** : Style `Outfit`, couleurs `emerald-900` ou `gray-800`.
- **Texte** : Style `Inter`, couleur `gray-600`.
- **Icones** : Lucide/HeroIcons (via SVG wrappers).
- **Boutons** : Preline Emerald (Secondary/Primary).
- **Badges** : Preline Soft (Success/Warning/Danger).

### Molécules
- **Admin Sidebar** : Molécule existante.
- **Admin Topbar** : Navigation bar existante avec fil d'ariane.
- **KPI Card** : Réutilisation de la molécule `stat-card` (Revenu, Panier, Commandes, Taux).
- **Date Range Selector** : Dropdown ou Input group pour filtrer.
- **Performance Chart (Area)** : Molécule à créer ou intégrer (Box avec titre + Placeholder Chart).
- **Category Donut** : Molécule à créer (Box avec titre + Placeholder Donut).
- **Top Sellers List** : Nouvelle Molécule (Liste compacte avec images et badges).
- **Inventory Alerts Table** : Molécule existante (Table simple).

### Organismes (Assemblage)
- **Dashboard Stats** : Assemblage de toutes les molécules ci-dessus dans `mockups/admin-reports.html`.

## 3. Mapping Wireframe -> UI
| Section Wireframe | Composant UI |
| :--- | :--- |
| Header & Filtres | `Admin Topbar` + `Date Range selector` |
| KPIs Flash | Grid 4 cols [ `KPI Card` ] |
| Graphiques | Flex/Grid [ `Performance Chart`, `Category Donut` ] |
| Analyse Détaillée | Grid 2 cols [ `Top Sellers List`, `Staff Table` ] |
| État des Stocks | `Inventory Alerts Table` |
