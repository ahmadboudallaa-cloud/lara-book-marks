🚀 LaraBookmarks

Application web professionnelle de gestion de ressources développée avec Laravel 11.

LaraBookmarks permet aux utilisateurs d’organiser, catégoriser et rechercher efficacement leurs liens favoris grâce à une architecture sécurisée et conforme aux standards modernes de développement web.

🎯 Objectif du projet

Valider la maîtrise de :

L’architecture MVC

L’authentification Laravel

Les relations Eloquent (One-to-Many & Many-to-Many)

La sécurisation via Middleware

La structuration d’un projet Laravel professionnel

🏗 Architecture Technique
Élément	Technologie
Framework	Laravel 11
Base de données	MySQL
ORM	Eloquent
Frontend	Blade + Tailwind CSS
Authentification	Laravel Breeze
Sécurité	Middleware personnalisé
📊 Structure de la Base de Données
Tables principales

users

categories

links

tags

link_tag (table pivot)

🔗 Relations Eloquent
🔹 One-to-Many

Un utilisateur → plusieurs catégories

Un utilisateur → plusieurs liens

Une catégorie → plusieurs liens

🔹 Many-to-Many

Un lien ↔ plusieurs tags

Un tag ↔ plusieurs liens

🔐 Sécurité & Middleware
Authentification complète

Inscription

Connexion / Déconnexion

Profil utilisateur

Middleware is_active

Si le champ users.is_active = false :

L’accès est bloqué

L’utilisateur est automatiquement déconnecté

Message affiché :

“Votre compte est désactivé. Veuillez contacter l’administrateur.”

⚙ Fonctionnalités Principales
📂 Gestion des Catégories

Création

Modification

Suppression

Isolation par utilisateur

🔗 Gestion des Liens

Ajout

Édition

Suppression

Association à une catégorie

🏷 Système de Tags

Création dynamique des tags

Association multiple via table pivot

Synchronisation automatique

🔎 Recherche Avancée

Recherche par :

Titre

Catégorie

Tags

Requête sécurisée et isolée par utilisateur.

🎨 Design & UX

Interface moderne et claire

Palette professionnelle : blanc / gris clair / rouge sombre

Responsive

Sidebar de navigation

Dashboard avec statistiques

Gestion des textes longs

Expérience utilisateur optimisée
