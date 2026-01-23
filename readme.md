# JobLink — Job Dating Platform

**JobLink** est une plateforme moderne de *job dating* développée en **PHP** avec une **architecture MVC personnalisée**.  
Elle permet de mettre en relation des **étudiants** et des **entreprises** autour d’**offres d’emploi**, avec une séparation claire entre **Front Office** et **Back Office**.

---

## 🌐 Démo en ligne

- 🔗 **Front Office (Étudiant)** :  
  👉 https://joblink.sekkah.dev

- 🔐 **Back Office (Admin)** :  
  👉 https://joblink.sekkah.dev/admin/login  

### Identifiants Admin (démo)
- **Email** : `admin@youcode.ma`  
- **Mot de passe** : `admin123`

---

## 🎯 Objectifs du projet

- Mettre en pratique une **architecture MVC** sans framework
- Implémenter une **authentification sécurisée**
- Gérer des **annonces d’emploi**, **entreprises**, **étudiants** et **candidatures**
- Respecter les bonnes pratiques de **sécurité web**
- Proposer une interface **moderne et intuitive**

---

## 🧱 Architecture Technique

- **Langage** : PHP (POO)
- **Architecture** : MVC personnalisé
- **Vues** : Twig
- **Base de données** : MySQL
- **Accès DB** : PDO + requêtes préparées
- **CSS** : Tailwind CSS
- **JavaScript** : Vanilla JS

---

## 🔐 Sécurité

- Protection **CSRF** sur tous les formulaires
- Validation **serveur-side**
- Sessions sécurisées
- Contrôle strict des rôles (Admin / Étudiant)
- Upload sécurisé (CV PDF uniquement – bonus)
- Accès restreint aux données sensibles

---

## 👤 Rôles & Fonctionnalités

### 🧑‍🎓 Étudiant (Front Office)
- Authentification (Login / Register)
- Consultation des offres d’emploi actives
- Postuler à une offre (une seule fois par annonce)
- Suivi de ses candidatures *(en cours d’extension)*

### 🛠️ Administrateur (Back Office)
- Dashboard avec statistiques globales
- Gestion des annonces :
  - Création
  - Modification
  - Archivage / Restauration
- Gestion des entreprises (CRUD)
- Consultation des étudiants
- Gestion des candidatures :
  - Visualisation par annonce
  - Mise à jour du statut (En attente / Acceptée / Refusée)

---

## 📊 Dashboard Admin

- Nombre d’annonces actives
- Nombre d’annonces archivées
- Nombre d’entreprises
- Nombre d’étudiants
- Liste des annonces récentes

---

## 🗃️ Modèle de données (extrait)

### announcements
- id
- title
- company_id
- description
- location
- contract_type
- skills
- image
- deleted
- created_at
- updated_at

### companies
- id
- name
- sector
- location
- email
- phone
- avatar
- created_at
- updated_at

### users (students)
- id
- name
- email
- password
- role
- promotion
- specialization
- created_at

### applications
- id
- student_id
- announcement_id
- motivation
- cv_path
- status (pending | accepted | rejected)
- created_at
- updated_at

---

## 🎨 Interface Utilisateur

- Design **moderne** et **responsive**
- Identité visuelle cohérente (JobLink)
- UX inspirée des plateformes SaaS
- Pages d’authentification type *landing page*
- Navigation claire et intuitive

---
