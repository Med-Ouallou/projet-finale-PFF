# Wireframe : Rapports & Statistiques Avancés (Admin)

## 1. Structure de la Page
- **Header** : 
    - Titre : Rapports et Statistiques
    - Fil d'Ariane : Admin > Rapports
    - Sélecteur de période (Date Range Picker rapide : Aujourd'hui, 7J, 30J, Année)
    - Bouton "Exporter PDF/Excel"

- **Section 1 : KPIs Flash (4 colonnes)**
    - Revenu Total (+% vs période précédente)
    - Panier Moyen
    - Total Commandes
    - Taux de Complétion

- **Section 2 : Graphiques de Performance (Grille 2/3 - 1/3)**
    - **Gauche (Grand)** : Evolution du Chiffre d'Affaires (Area Chart)
    - **Droite (Petit)** : Répartition par Catégorie (Donut Chart)

- **Section 3 : Analyse Détaillée (Grille 1/2 - 1/2)**
    - **Gauche** : Top 5 des Plats les plus vendus (Liste avec miniatures)
    - **Droite** : Performance du Personnel (Tableau simple : Nom, Commandes, Note moyenne)

- **Section 4 : État des Stocks (Full Width)**
    - Tableau des alertes (Produits en rupture ou bientôt épuisés)

## 2. Interactions
- Survol des graphiques pour voir les détails (Tooltips).
- Changement de période qui rafraîchit les KPIs et Graphiques.
- Clique sur un plat dans le Top 5 pour voir sa fiche détaillée (optionnel).
