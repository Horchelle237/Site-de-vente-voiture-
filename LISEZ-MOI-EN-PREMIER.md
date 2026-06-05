# 🚀 GUIDE DE DÉMARRAGE — EuroAuto

> **Salut !** Ce guide t'explique tout, pas à pas, en partant de zéro.
> Lis dans l'ordre, ça prend **10 minutes** environ.

---

## 📦 1. Ce que tu as reçu

Dans le dossier `euro-auto/` que tu as dézippé, tu as :

| Dossier / Fichier | À quoi ça sert |
|---|---|
| 📁 `public/` | Le **point d'entrée** du site (la racine web) |
| 📁 `app/` | Tout le **code PHP** (contrôleurs, modèles, vues, config) |
| 📁 `sql/` | Le **script de base de données** à importer |
| 📁 `docs/` | La documentation détaillée (README + INSTALL) |
| 📄 `README.md` | Présentation complète du projet |
| 📄 `LISEZ-MOI-EN-PREMIER.md` | **Ce fichier que tu lis maintenant** |

👉 **Tu n'as pas besoin de comprendre tout le code maintenant.** L'objectif est d'abord de **faire tourner le site sur ton PC**. On comprendra ensuite.

---

## 🛠️ 2. Ce qu'il te faut installer (une seule fois)

Pour faire tourner un site PHP + MySQL sur ton PC, tu as besoin de **3 logiciels** : Apache (serveur web), PHP (langage), MySQL (base de données).

Le plus simple, c'est d'installer **XAMPP** qui contient les 3 en un seul logiciel.

### 👉 Installation de XAMPP

1. Va sur **https://www.apachefriends.org**
2. Télécharge la version pour ton système (Windows, Mac ou Linux)
3. Installe-le (clic suivant > suivant > suivant, laisse les options par défaut)
4. Lance **XAMPP Control Panel**

Tu verras une fenêtre comme ça avec des boutons **Start** :

```
┌─────────────────────────────────┐
│  Apache    [ Start ]            │
│  MySQL     [ Start ]            │
│  FileZilla                       │
│  Mercury                         │
│  Tomcat                          │
└─────────────────────────────────┘
```

✅ Clique sur **Start** à côté d'**Apache** et de **MySQL**. Ils doivent passer en **vert**.

---

## 📂 3. Place le projet au bon endroit

Le dossier `euro-auto/` (celui que tu as dézippé) doit être copié dans le dossier **htdocs** de XAMPP.

### Où est `htdocs` ?

| Système | Chemin |
|---------|--------|
| **Windows** | `C:\xampp\htdocs\` |
| **Mac** | `/Applications/XAMPP/htdocs/` |
| **Linux** | `/opt/lampp/htdocs/` |

### Ce que tu dois faire

1. Ouvre l'explorateur de fichiers
2. Va dans `C:\xampp\htdocs\` (ou l'équivalent Mac/Linux)
3. **Glisse le dossier `euro-auto/`** dedans

Au final tu dois avoir cette structure :

```
C:\xampp\htdocs\
    └── euro-auto\          ← le dossier complet du projet
        ├── public\
        ├── app\
        ├── sql\
        ├── docs\
        └── ...
```

> ⚠️ Vérifie bien que le dossier s'appelle **`euro-auto`** (pas `euro-auto-main`, pas `euro-auto (1)`, etc.). Renomme-le si besoin.

---

## 💾 4. Crée la base de données

C'est là qu'on importe le fichier `sql/euro_auto.sql` qui contient toutes les tables et les données de démo (12 véhicules, 5 témoignages, etc.).

### Étape par étape

1. Dans XAMPP Control Panel, à côté de **MySQL**, clique sur le bouton **Admin** *(ça ouvre phpMyAdmin dans ton navigateur)*

   👉 Ou alors va directement sur : **http://localhost/phpmyadmin**

2. En haut de la page, clique sur l'onglet **Importer**

3. Clique sur **Choisir un fichier**, puis va chercher :
   `C:\xampp\htdocs\euro-auto\sql\euro_auto.sql`

4. Tout en bas de la page, clique sur **Exécuter** (ou **Go**)

5. Tu dois voir un message vert : **« L'importation a été exécutée avec succès »**

✅ Si tu vois la base **`euro_auto`** apparaître dans la liste à gauche, c'est gagné !

---

## 🌐 5. Lance le site dans ton navigateur

Ouvre ton navigateur (Chrome, Firefox, Edge) et va sur :

### 🏠 Site public
👉 **http://localhost/euro-auto/public/**

Tu dois voir la page d'accueil EuroAuto, avec :
- Le hero "L'art de rouler avec excellence"
- Les statistiques animées
- Les 12 véhicules de démo

Teste les pages :
- **Véhicules** → catalogue avec filtres
- **À propos** → présentation EuroAuto
- **Témoignages** → avis clients
- **Contact** → formulaire avec carte

### 🔐 Espace administrateur
👉 **http://localhost/euro-auto/public/admin/login**

Identifiants pour te connecter :

```
Identifiant : admin
Mot de passe : Admin@2026
```

Une fois connecté, tu as accès au **back-office** :
- Tableau de bord avec stats
- Gestion des véhicules (ajout/modif/suppression + upload photo)
- Boîte de réception (messages contact)
- Modération des témoignages

---

## ❓ 6. Ça ne marche pas ? Les bugs les plus courants

### 🔴 « Object not found » ou erreur 404 sur toutes les pages
**Cause** : `mod_rewrite` n'est pas activé dans Apache.
**Solution** :
1. Stoppe Apache dans XAMPP
2. Clique sur **Config** à côté d'Apache → choisis **httpd.conf**
3. Cherche la ligne `#LoadModule rewrite_module modules/mod_rewrite.so`
4. Enlève le `#` au début → enregistre
5. Redémarre Apache

### 🔴 « SQLSTATE[HY000] [2002] Connection refused »
**Cause** : MySQL n'est pas démarré dans XAMPP.
**Solution** : retourne dans XAMPP Control Panel et clique sur **Start** à côté de MySQL.

### 🔴 « Access denied for user 'root'@'localhost' »
**Cause** : ton MySQL a un mot de passe.
**Solution** : ouvre `app/config/database.php` et mets ton mot de passe dans le champ `'password'`.

### 🔴 La page s'affiche mais sans style (texte brut)
**Cause** : les fichiers CSS ne sont pas trouvés.
**Solution** : vérifie que `BASE_URL` dans `app/config/config.php` correspond bien à l'URL que tu utilises (`http://localhost/euro-auto/public`).

### 🔴 Les images de voitures ne s'affichent pas
Les **12 images des véhicules de démo sont déjà incluses** dans `public/assets/images/vehicles/`. Si elles ne s'affichent pas :
- Vérifie que le dossier `euro-auto/` est bien complet (n'a pas été tronqué au dézippage)
- Vérifie que `BASE_URL` dans `app/config/config.php` correspond à `http://localhost/euro-auto/public`

Pour mettre tes propres photos, utilise le **formulaire admin → Véhicules → modifier**, ou dépose directement tes fichiers dans `public/assets/images/vehicles/` et renseigne le nom dans la table `vehicules`.

---

## 🧠 7. Comprendre l'architecture (pour la soutenance)

Ton site est construit selon le **pattern MVC** (Modèle - Vue - Contrôleur), exigé par le référentiel SLAM.

```
   👤 Le visiteur tape une URL : /vehicule/3
              │
              ▼
   📍 public/index.php  (front controller — seul point d'entrée)
              │
              ▼
   🚦 app/core/Router.php  →  "tiens, /vehicule/{id} = VehiculeController@show"
              │
              ▼
   🧠 app/controllers/VehiculeController::show(3)
              │
              ├─→ Demande au Modèle : "donne-moi le véhicule n°3"
              │       │
              │       ▼
              │   📊 app/models/Vehicule.php  →  requête SQL via PDO
              │       │
              │       ▼
              │   💾 MySQL renvoie les données
              │
              └─→ Passe les données à la Vue : "affiche cette page"
                      │
                      ▼
                  🎨 app/views/vehicules/show.php  →  HTML final renvoyé au navigateur
```

### Les 3 rôles à expliquer au jury

| Couche | Rôle | Fichiers |
|--------|------|----------|
| **Modèle** | Parle à la base de données (lecture/écriture) | `app/models/` |
| **Vue** | Affichage HTML (la "façade") | `app/views/` |
| **Contrôleur** | Reçoit la requête, fait la logique, choisit la vue | `app/controllers/` |

**Pourquoi cette séparation ?** Pour pouvoir modifier l'affichage sans toucher à la logique, et inversement. C'est la base de tout projet pro.

---

## 🛡️ 8. Les points sécurité à mettre en avant

Le jury BTS adore quand on parle sécurité. Voici ce que tu peux citer :

| Risque | Comment c'est protégé dans ton site |
|--------|--------------------------------------|
| **Injection SQL** | 100% des requêtes utilisent **PDO préparé** (`bindValue`) |
| **XSS** (injection de JS) | Tous les affichages passent par `htmlspecialchars()` |
| **CSRF** (faux formulaires) | Jeton anti-CSRF dans chaque formulaire |
| **Mots de passe en clair** | Hashage **bcrypt** (`password_hash`) |
| **Session fixation** | `session_regenerate_id()` après login |
| **Upload de malware** | Vérification du **type MIME réel** (pas juste l'extension) |

---

## 🎓 9. Prêt pour la soutenance !

Pour démontrer ton projet au jury, je te conseille ce scénario :

1. **Page d'accueil** → présentation de la société EuroAuto
2. **Catalogue + filtres** → "voici comment on filtre les véhicules"
3. **Fiche véhicule** → "détail technique + véhicules similaires"
4. **Formulaire contact** → envoie un message de test
5. **Témoignage** → dépose un avis
6. **Connexion admin** → "et maintenant côté coulisses"
7. **Dashboard** → "j'ai mes stats en temps réel"
8. **Modération** → approuve le témoignage que tu viens de déposer
9. **Boîte de réception** → tu vois le message contact arrivé
10. **Ajout véhicule** → crée un véhicule avec une vraie photo

➕ N'oublie pas de préparer ton **MCD** (Modèle Conceptuel de Données) à montrer : 6 tables liées (regarde le fichier `sql/euro_auto.sql` pour les contraintes).

---

## 📞 Récap des URLs importantes

| Quoi | URL |
|------|-----|
| Site public | http://localhost/euro-auto/public/ |
| Login admin | http://localhost/euro-auto/public/admin/login |
| phpMyAdmin | http://localhost/phpmyadmin |
| XAMPP doit avoir Apache et MySQL en **vert** |  |

## 🔑 Identifiants admin

```
Login : admin
Pass  : Admin@2026
```

---

Bonne installation et bonne soutenance ! 🎓🚗

— Projet **EuroAuto** — TAMESSING PIATA HORCHELLE DOLVINE — BTS SIO SLAM — Session 2026
