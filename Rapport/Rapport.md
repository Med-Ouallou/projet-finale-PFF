# Projet de Fin de Formation
## Digitalisation des Services de Mini Restaurant : Développement d’une Solution Web Intégrée de Gestion

**Réalisé par :** Mohamed Ouallou  
**Encadré par :** M. ESSARRAJ Fouad  
**Filière :** Développement Mobile et Web  

---

## Sommaire
1. Contexte du projet  
2. Méthodologie de travail  
3. Branche Fonctionnelle  
   - EMPATHIE  
   - DÉFINITION  
   - IDÉATION  
   - Cas d'utilisation  
   - Maquettes (UI/UX)  
4. Branche Technique  
5. Conception : Diagramme de classe  
6. Démonstration : Environnement & Outils  
7. Conclusion  

---

## 1. Contexte du projet

> "Mr. Ayoube Jamali owns a small restaurant and is highly skilled in food preparation and customer service. However, he faces difficulties managing daily operations such as order organization, revenue tracking, and staff coordination, as most processes are handled manually.  
>
> This project aims to design a Mini Restaurant Management System that digitalizes operations, improves workflow efficiency, and enhances overall business performance."

---

## 2. Méthodologie de travail

### Design Thinking
![Design Thinking](/Presentation/images/designThinking.png)

### Scrum (Agile)
![Scrum](/Presentation/images/scrum.jpg)

---

## 3. Branche Fonctionnelle : Design Thinking

### 3.1 EMPATHIE
> "Mr. Ayoube Jamali, owner of a small restaurant, struggles with daily operational management due to manual processes. This causes stress, order confusion during peak hours, and limits business efficiency. He needs a structured digital system to improve organization and performance."

**Key Points**
- Manual order management causes confusion  
- Revenue tracking is time-consuming and error-prone  
- No centralized system for menu and staff management  
- Need for real-time order tracking  
- Desire for a clear dashboard and better control  

---

### 3.2 DÉFINITION
**Cadrage du problème**
- Manual management of daily operations (orders, revenue, menu, staff)  
- Order confusion during peak hours  
- Errors in revenue calculation  
- Lack of real-time visibility on performance  
- Poor menu organization  
- Increased operational stress  
- Absence of a centralized digital system limits efficiency, scalability, and performance  

---

### 3.3 IDÉATION
**Solutions retenues**
- Interface **"Single Question"** pour éviter la surcharge cognitive  
- **Timer dynamique** par catégorie de question  
- **Dashboard** temps réel pour le suivi des opérations  

---

### 3.4 Cas d'utilisation
**Interaction Utilisateur (UML)**
![Use Case](/Presentation/images/use-case.png)

---

### 3.5 Maquettes (UI/UX)
![Maquette](/Presentation/images/maquette.png)

---

## 4. Branche Technique : Tech Stack
**Technologies utilisées**
- **Base de données:** MySQL  
- **Framework:** Laravel 12  
- **Architecture N-Tiers:**  
  - Controller: Requêtes HTTP  
  - Service: Logique métier  
  - Model: Base de données  
- **Architecture MVC**  
- **Blade:** Templates réutilisables  
- **AJAX:** Interactions dynamiques sans rechargement  
- **Alpine.js:** Librairie JavaScript dynamique  
- **Spatie:** Gestion permissions et rôles  
- **Vite:** Outil de build rapide  
- **Lucide:** Librairie d'icônes  
- **Tailwind CSS:** Développement responsive  

---

## 5. Conception : Diagramme de classe
**Modélisation des données (MLD)**
![Diagramme de classe](/Presentation/images/diagramme-class.png)

---

## 6. Démonstration : Environnement & Outils

### Environnement de Développement
- **IDE:** VS Code & Antigravity  
- **Monitoring DB:** Workbench SQL  

### Gestion & Déploiement
- **Modélisation UML:** Mermaid/PlantUML  
- **Gestion de version:** Git (GitHub)  
- **Navigateur:** Chrome DevTools  

---

## 7. Conclusion
Merci pour votre attention !