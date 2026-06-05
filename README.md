# 🚗 EuroAuto — Site dynamique de vente de véhicules

> Projet PPE BTS SIO option SLAM — Session 2026
> **Étudiant : TAMESSING PIATA HORCHELLE DOLVINE**

Site web complet (front-office public + back-office d'administration) pour
la société fictive **EuroAuto**, concessionnaire de véhicules d'occasion
basé en Île-de-France (45 salariés, 8,5 M€ de CA).

---

## 🎯 Fonctionnalités

### Espace public
- 🏠 Page d'accueil immersive (hero, statistiques animées, sélection mise en avant)
- 🚙 Catalogue de véhicules avec **filtres multicritères** (marque, catégorie, carburant, prix max)
- 🔍 Fiche détaillée par véhicule (galerie, spécifications, véhicules similaires)
- 📜 Page « À propos » présentant l'histoire, les valeurs et les arguments d'EuroAuto
- 💬 Page témoignages avec affichage des avis publiés et **formulaire d'avis** modéré
- 📞 Page contact avec formulaire validé côté serveur et **carte Google Maps**

### Espace administrateur (`/admin`)
- 🔐 Authentification sécurisée (bcrypt + CSRF + régénération de session)
- 📊 Tableau de bord avec KPIs (stock, messages, témoignages, satisfaction)
- 🛠️ **CRUD complet** sur les véhicules (création, édition, suppression, upload d'image)
- ✉️ Gestion des messages reçus (lecture, marquage, suppression)
- ⭐ **Modération** des témoignages (approbation / rejet)
- 🚪 Déconnexion sécurisée (destruction complète de session)

---

## 🏗️ Architecture technique

Le projet suit le **pattern MVC** classique, codé en PHP 8 orienté objet
**sans aucun framework ni Composer** : tout est implémenté à la main pour
démontrer la maîtrise des concepts.

```
euro-auto/
├── public/                  ← Racine web (point d'entrée)
│   ├── index.php           ← Front controller unique
│   ├── .htaccess           ← URL rewriting + cache
│   └── assets/             ← CSS, JS, images
│
├── app/
│   ├── config/             ← Configuration & accès BDD
│   ├── core/               ← Cœur MVC (autoload, Router, Model, Controller)
│   ├── controllers/        ← Logique métier (1 contrôleur par espace)
│   ├── models/             ← Accès aux données (PDO préparées)
│   └── views/              ← Templates PHP (séparation présentation)
│
├── sql/
│   └── euro_auto.sql     ← Script complet (structure + données démo)
│
└── docs/                   ← README + guide d'installation
```

### Stack utilisée
| Composant | Choix | Justification |
|-----------|-------|---------------|
| Langage backend | PHP 8 OOP | Standard du métier, demandé par le référentiel SLAM |
| Base de données | MySQL 8 / MariaDB | SGBD relationnel maîtrisé par le jury |
| Accès BDD | **PDO** + requêtes préparées | Sécurité contre les injections SQL |
| Frontend | Bootstrap 5 + CSS custom | Responsive natif, design rapide |
| Animations | AOS + JS vanilla | Légèreté, pas de framework JS lourd |
| Routing | Router custom + `mod_rewrite` | URLs propres sans dépendance externe |
| Autoloader | PSR-4 maison | Démonstration de la compréhension des namespaces |

---

## 🔒 Sécurité — Mesures implémentées

| Risque OWASP | Contre-mesure |
|--------------|---------------|
| **Injection SQL** | 100 % des requêtes via PDO préparé (`bindValue`/`execute(array)`) |
| **XSS** | Échappement systématique avec `htmlspecialchars()` (helper `e()`) |
| **CSRF** | Jeton anti-CSRF dans tous les formulaires (`hash_equals`) |
| **Brute-force login** | `password_verify()` + hash bcrypt + flash messages génériques |
| **Session fixation** | `session_regenerate_id(true)` au login |
| **Upload malveillant** | Validation MIME (`finfo`), extension blanche, taille max 4 Mo |
| **Directory listing** | `Options -Indexes` dans `.htaccess` |
| **Accès direct au code** | Front controller unique + `BASE_URL` |

---

## 🚀 Démarrage rapide

Voir [`INSTALL.md`](INSTALL.md) pour la procédure complète. En résumé :

```bash
# 1. Placer le projet dans htdocs (XAMPP) ou /var/www/html
# 2. Créer la base et importer le script SQL
mysql -u root -p < sql/euro_auto.sql

# 3. Vérifier la config BDD
# → app/config/database.php

# 4. Ouvrir dans le navigateur
http://localhost/euro-auto/public/
```

### 🔑 Identifiants de démonstration

**Espace administrateur** (`/admin/login`) :
- Identifiant : `admin`
- Mot de passe : `Admin@2026`

> ⚠️ Pensez à changer ces identifiants en production !

---

## 📋 Schéma de la base de données

| Table | Rôle | Lignes démo |
|-------|------|-------------|
| `categories` | Catégories de véhicules (Berline, SUV…) | 5 |
| `vehicules` | Catalogue principal (FK vers `categories`) | 12 |
| `utilisateurs` | Visiteurs ayant déposé un avis | 5 |
| `temoignages` | Avis clients (FK vers `utilisateurs`) | 5 |
| `contacts` | Messages reçus via le formulaire | 2 |
| `admins` | Comptes du back-office | 1 |

Toutes les contraintes d'intégrité (FK, CHECK, UNIQUE) sont définies dans le
script SQL. La base utilise `utf8mb4` pour un support complet des emojis et
caractères internationaux.

---

## 🎨 Identité visuelle

Le design adopte un parti pris **luxe automobile** :
- Palette sombre profonde (`#0a0e15`) ponctuée d'or premium (`#f5b942`)
- Typographies : **Playfair Display** (titres) + **Manrope** (texte courant)
- Animations au scroll subtiles via la lib AOS
- Composants entièrement responsives (mobile, tablette, desktop)

---

## 📚 Compétences BTS SIO mobilisées

- **B1.1** Conception, développement et maintenance d'une solution applicative
- **B1.2** Élaboration et réalisation des composants logiciels (POO PHP)
- **B1.3** Mise en exploitation et déploiement (Apache + MySQL)
- **B2** Conception et développement d'une base de données (MCD → MLD → SQL)
- **B3** Exploitation des données (CRUD, requêtes paramétrées, jointures)
- **B5** Sécurisation des communications et des données (CSRF, hash, prepared)

---

## 📄 Licence & crédits

Projet pédagogique réalisé dans le cadre du **BTS SIO option SLAM** — Session 2026.
Auteur : **TAMESSING PIATA HORCHELLE DOLVINE**.

Code, contenus et architecture sont produits à des fins de soutenance
professionnelle. Les images de démonstration proviennent de banques libres
(Unsplash) et n'ont pas vocation à être exploitées commercialement.
