# Composition UI : Menu en Ligne & Commande WhatsApp (Client)

## 1. Structure de la Page (Layout Client)
- **Conteneur** : Layout Public (Header Fixe + Contenu Centré + Footer Simple).
- **Fond** : `bg-gray-50` avec éléments blancs (`bg-white`).

## 2. Décomposition des Composants (Preline & Custom)

### Atomes
- **Titres (H1, H2, H3)** : Typographie `Outfit`, gras (`bold` ou `extrabold`).
- **Texte Standard** : Typographie `Inter`, gris doux (`gray-500` ou `gray-600`).
- **Badges** : Preline Soft Badges (Success pour le statut, Amber pour le prix).
- **Icons** : Icones SVG Lucide (Search, ShoppingBag, Plus, Minus, WhatsApp).

### Molécules (Livrables)
- **Client Navbar** : Barre de navigation fixe avec logo, recherche et bouton panier (avec badge nombre).
- **Category Nav** : Liste horizontale scrollable (Pills) pour changer de catégorie.
- **Product Card** : Carte produit avec ombre subtile, image `h-44`, titre, prix en DH et bouton d'ajout émeraude.
- **Cart Drawer (WhatsApp Ready)** : Panier latéral Preline (`hs-overlay`) incluant la liste des articles et le bouton de commande WhatsApp.

### Organismes (Assemblage Final)
- **Grille de Produits** : `grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6`.
- **Système de Commande** : Script JS simple pour calculer le total et formater le message WhatsApp (`wa.me`).

## 3. Mapping Graphique
- **Code Couleur Principal** : Émeraude (`emerald-600` / `emerald-900`).
- **Accent** : Ambre (`amber-500`) pour les sélections spéciales.
- **CTA WhatsApp** : Vert WhatsApp (`#25D366`) ou émeraude pour rester cohérent avec la charte graphique.
