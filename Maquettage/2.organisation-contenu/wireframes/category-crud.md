# Wireframe : Gestion des Catégories (Admin)

## ZONE 1 : Header (Navigation & Actions)
- **Composant** : Breadcrumbs
- **Contenu** : "Admin > Menu > Catégories"
- **Composant** : Titre H1
- **Contenu** : "Gestion des Catégories"
- **Composant** : Bouton CTA
- **Contenu** : "+ Ajouter une catégorie"
- **Action** : Ouvre Modal [Ajouter Catégorie]

## ZONE 2 : Statistiques Rapides (Cards)
- **Composant** : Stat Card
- **Contenu** : "Total : 12 catégories"
- **Composant** : Stat Card
- **Contenu** : "Catégorie la plus fournie : Plats principaux (15 plats)"

## ZONE 3 : Liste des Catégories (Tableau/Grid)
- **Composant** : Tableau de données
- **Colonnes** :
    1. **Icône/Couleur** : Visualisation rapide de la catégorie.
    2. **Nom** : "Entrées", "Boissons", etc.
    3. **Description** : Courte description de l'usage.
    4. **Nombre de Plats** : Compteur dynamique (ex: 8 plats).
    5. **Actions** : 
        - [Bouton] Modifier (Action : Ouvre Modal Édition)
        - [Bouton] Supprimer (Action : Alerte de confirmation)

## ZONE 4 : Modal : Ajouter / Modifier une Catégorie
- **Composant** : Input Texte
- **Label** : "Nom de la catégorie"
- **Composant** : Sélecteur d'Icône/Couleur
- **Description** : Choix d'une couleur et d'un icône représentatif.
- **Composant** : Textarea
- **Label** : "Description"
- **Composant** : Bouton Submit
- **Contenu** : "Enregistrer la catégorie"
