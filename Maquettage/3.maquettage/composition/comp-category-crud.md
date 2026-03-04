# Composition UI : Gestion des Catégories ($PAGE = category-crud)

## 🏗️ Structure de la Page
La page utilise le layout Admin standard avec une Sidebar et un Header collant.

## ⚛️ Décomposition Atomic Design

### 1. Atomes (Utilisés)
- **Atoms/Title** : Titre de la page (H1) et titres des sections/modales.
- **Atoms/Button** : Boutons d'action (Ajouter, Modifier, Supprimer, Annuler).
- **Atoms/Text** : Descriptions et étiquettes.
- **Atoms/Icon** : Icônes Lucide (catégories, édition, corbeille).

### 2. Molécules (Mise en œuvre)

#### [EXISTANTES]
- **Molecules/Sidebar** : Navigation latérale gauche.
- **Molecules/Stat-Card** : Affichage des statistiques en haut de page.

#### [À CRÉER / À DÉVELOPPER]
- **Molecules/Category-Table** : 
    - **Description** : Tableau Preline avec tri, recherche et actions.
    - **Sous-composants** : Atoms/Icon, Atoms/Button (Modifier/Action).
- **Molecules/Category-Modal** :
    - **Description** : Overlay Preline pour l'ajout/édition de catégories.
    - **Champs** : Nom, Icône (sélecteur), Couleur (sélecteur), Description.

## 🗺️ Mapping Wireframe -> Composants
- **ZONE 1 (Header)** -> Molecules/Sidebar + Atoms/Title + Atoms/Button.
- **ZONE 2 (Stats)** -> Molecules/Stat-Card.
- **ZONE 3 (List)** -> Molecules/Category-Table.
- **ZONE 4 (Modal)** -> Molecules/Category-Modal.
