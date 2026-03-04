# Wireframe : Menu en Ligne & Commande WhatsApp (Client)

## ZONE 1 : Header (Sticky)
- **Composant** : Logo "RestoManager"
- **Composant** : Barre de recherche rapide (Plats)
- **Composant** : Bouton Panier avec compteur d'articles (Action: Ouvre le Drawer)

## ZONE 2 : Filtres & Navigation
- **Composant** : Sélecteur de Catégories (Horizontal Pills : Tout voir, Pizzas, Burgers, Tajines, Boissons, Desserts)

## ZONE 3 : Catalogue des Plats (Grille)
- **Composant** : Cartes Plats (Product Card)
    - Image haute qualité
    - Badge (Populaire, Nouveau, Chef)
    - Nom & Description courte
    - Prix en DH
    - Bouton "Ajouter" (+) avec retour visuel

## ZONE 4 : Panier (Drawer Lateral / Offcanvas)
- **Composant** : Liste des articles ajoutés (Image, Nom, Prix, Sélecteur de quantité +/-)
- **Composant** : Résumé des coûts (Sous-total, Livraison 0 DH, Total)
- **Composant** : **BOUTON WHATSAPP** (Action finale)
    - Texte : "Commander via WhatsApp"
    - Icône : Logo WhatsApp
    - Action : Génère un message pré-rempli avec le détail de la commande.

## 2. Flux Utilisateur
1. Le client parcourt le menu.
2. Ajoute les plats au panier.
3. Ouvre le panier pour vérifier.
4. Clique sur "Commander via WhatsApp".
5. Est redirigé vers WhatsApp avec un message : 
   "Bonjour RestoManager ! Je souhaite commander : 2x Pizza Royale (150 DH), 1x Coca (15 DH). Total : 165 DH. Mon adresse est : ..."
