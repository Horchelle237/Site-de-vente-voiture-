# 🚀 GUIDE DE DÉMARRAGE — EuroAuto

> **Bonjour !** Ce guide t'explique tout pas à pas : ce que tu as reçu, ce que tu dois installer, et comment lancer ton site EuroAuto sur ton PC.
> Suis les étapes dans l'ordre, ça prend **10 minutes**.

---

## 📦 1. Qu'est-ce que tu as reçu exactement ?

Tu as téléchargé un fichier `euro-auto.zip`. Quand tu le dézippes, tu obtiens un dossier `euro-auto/` qui contient **TON site web complet** pour ton projet BTS.

Imagine que ce dossier, c'est comme un **classeur de cours** : il y a plusieurs sections (dossiers) qui ont chacune un rôle précis :

| Dossier | À quoi ça sert ? |
|---|---|
| 📂 `public/` | **C'est la "vitrine"** : ce que les visiteurs voient quand ils ouvrent ton site. C'est par ici qu'on rentre. |
| 📂 `app/` | **C'est le "moteur"** : le code PHP qui fait tourner le site (logique, base de données, pages). Le visiteur ne le voit jamais directement. |
| 📂 `sql/` | **Contient la base de données** : un fichier `.sql` à importer dans phpMyAdmin pour créer les tables et les données. |
| 📂 `docs/` | La documentation (ce guide + README technique + INSTALL.md). |
| 📄 `README.md` | Présentation générale du projet (à montrer au jury). |

**👉 En résumé : ton site = `public/` (vitrine) + `app/` (cerveau) + `sql/` (mémoire/base de données).**

---

## 🛠️ 2. De quoi as-tu besoin pour faire tourner le site ?

Un site web PHP, ça ne marche pas tout seul en double-cliquant dessus. Il faut **3 logiciels** qui tournent en même temps sur ton PC :

1. **Apache** : le serveur web qui distribue les pages au navigateur.
2. **PHP** : le langage qui génère les pages dynamiques.
3. **MySQL** : la base de données qui stocke les véhicules, les messages, etc.

**👉 Bonne nouvelle :** un seul logiciel — **XAMPP** — installe les 3 en même temps. C'est gratuit et fait pour ça.

### 📥 Télécharger XAMPP

1. Va sur https://www.apachefriends.org
2. Télécharge la version pour **Windows** (ou Mac/Linux selon ton PC).
3. Installe-le en cliquant suivant-suivant (laisse les options par défaut). Il sera installé dans `C:\xampp\` par défaut.

---

## 🟢 3. Démarrer XAMPP (à faire à chaque session)

1. Ouvre **XAMPP Control Panel** (raccourci dans le menu Démarrer).
2. Tu vois une liste de services. **Clique sur "Start"** à côté de :
   - ✅ **Apache**
   - ✅ **MySQL**

Quand les deux deviennent **verts**, c'est bon : ton serveur tourne sur ton PC. 🎉

> 💡 **Si Apache ne démarre pas** : c'est souvent que Skype ou un autre logiciel occupe le port 80. Ferme Skype et réessaie, ou demande à ton prof.

---

## 📁 4. Installer le projet EuroAuto

### Étape 4.1 — Dézipper

1. Dézippe `euro-auto.zip` quelque part (ex. : sur ton Bureau).
2. Tu obtiens un dossier **`euro-auto`**.

### Étape 4.2 — Copier dans htdocs

1. Ouvre l'explorateur de fichiers et va dans :
   ```
   C:\xampp\htdocs\
   ```
2. **Glisse-dépose** le dossier `euro-auto` dedans.

Tu dois obtenir cette arborescence :
```
C:\xampp\htdocs\euro-auto\
   ├── app\
   ├── docs\
   ├── public\
   ├── sql\
   └── README.md
```

> ❓ **Pourquoi `htdocs` ?** C'est le dossier que XAMPP "publie" sur le web local. Tout ce qui est dedans devient accessible via `http://localhost/...`.

---

## 💾 5. Créer la base de données

Le site a besoin d'une base de données MySQL. Le fichier `sql/euro_auto.sql` contient tout ce qu'il faut pour la créer **automatiquement** : tables, contraintes, et même 12 véhicules de démonstration.

### Étape 5.1 — Ouvrir phpMyAdmin

1. Dans ton navigateur, va sur :
   ```
   http://localhost/phpmyadmin
   ```
2. Une interface s'ouvre. C'est l'outil graphique pour gérer MySQL.

### Étape 5.2 — Importer le fichier SQL

1. En haut, clique sur l'onglet **« Importer »**.
2. Clique sur **« Choisir un fichier »**.
3. Va chercher le fichier :
   ```
   C:\xampp\htdocs\euro-auto\sql\euro_auto.sql
   ```
4. Tout en bas de la page, clique sur **« Importer »** (ou « Exécuter »).

Si tout se passe bien, tu vois un message vert : *"L'importation s'est terminée avec succès"*. ✅

À gauche, dans la liste des bases de données, tu dois voir apparaître **`euro_auto`** avec 6 tables dedans (categories, vehicules, utilisateurs, temoignages, contacts, admins).

---

## 🌐 6. Ouvrir le site dans le navigateur

Dans n'importe quel navigateur (Chrome, Firefox…), tape :

```
http://localhost/euro-auto/public/
```

🎉 **Tu dois voir le site EuroAuto** : page d'accueil avec un hero noir et or, des véhicules en vedette, etc.

### Les pages que tu peux visiter

| URL | Ce que tu y trouves |
|---|---|
| `http://localhost/euro-auto/public/` | Page d'accueil |
| `http://localhost/euro-auto/public/vehicules` | Catalogue des véhicules + filtres |
| `http://localhost/euro-auto/public/a-propos` | Page « À propos » d'EuroAuto |
| `http://localhost/euro-auto/public/temoignages` | Avis clients + formulaire pour en laisser un |
| `http://localhost/euro-auto/public/contact` | Formulaire de contact |

---

## 🔐 7. Accéder à l'espace administrateur

C'est la partie cachée du site, réservée aux gestionnaires d'EuroAuto.

1. Va sur :
   ```
   http://localhost/euro-auto/public/admin/login
   ```
2. Connecte-toi avec :
   - **Identifiant** : `admin`
   - **Mot de passe** : `Admin@2026`

Tu arrives sur un **tableau de bord** avec des statistiques. Tu peux :
- Ajouter / modifier / supprimer des véhicules (avec upload d'images)
- Lire et supprimer les messages reçus
- Valider ou rejeter les avis laissés par les visiteurs

---

## 🧠 8. Ce que tu dois comprendre pour le jury

Voilà ce que ton site démontre techniquement (à expliquer en soutenance) :

### Architecture
> *« Mon site utilise le pattern MVC (Modèle-Vue-Contrôleur). Le code est séparé en 3 couches : les modèles gèrent la base de données, les contrôleurs traitent les requêtes, les vues affichent le HTML. »*

### Sécurité
> *« J'ai mis en place plusieurs protections : les requêtes SQL utilisent des **requêtes préparées PDO** (anti-injection SQL), les formulaires ont un **jeton CSRF**, les mots de passe sont **hachés en bcrypt**, et les uploads d'images vérifient le type MIME. »*

### Base de données
> *« Ma base contient 6 tables avec des clés étrangères. Par exemple, chaque véhicule appartient à une catégorie (relation N:1), et chaque témoignage peut être lié à un utilisateur. »*

### Front-end
> *« Le design est responsive grâce à Bootstrap 5, avec un thème sombre/or pour évoquer l'univers automobile premium. Les animations au scroll sont gérées par la librairie AOS. »*

---

## ❓ 9. Problèmes courants

### 🔴 « Cette page ne fonctionne pas » / Erreur 404
→ Vérifie que **Apache est bien démarré** dans XAMPP (voyant vert).
→ Vérifie que tu as bien tapé `/public/` à la fin de l'URL.

### 🔴 « Erreur de connexion à la base de données »
→ Vérifie que **MySQL est bien démarré** dans XAMPP (voyant vert).
→ Vérifie que tu as bien importé `euro_auto.sql` (étape 5).

### 🔴 « Vue introuvable »
→ Le projet a été mal dézippé. Re-dézippe l'archive proprement.

### 🔴 Les images des voitures ne s'affichent pas
→ **C'est normal !** Le projet utilise un système de **fallback** : si l'image n'existe pas localement, il en charge une depuis internet (Unsplash). Il faut donc juste être connecté à internet pour voir les images de démo.

### 🔴 Les CSS ne se chargent pas (page toute blanche/cassée)
→ Vérifie l'URL : il faut bien `http://localhost/euro-auto/public/` (avec `/public/` à la fin).

---

## 🎓 10. Pour aller plus loin

Une fois que tout marche, voilà des choses à faire pour briller à la soutenance :

1. **Ajoute tes propres véhicules** via l'admin (avec photos personnelles)
2. **Modifie quelques textes** dans les vues (`app/views/...`) pour personnaliser
3. **Imprime le MCD** de la base de données (à partir des `CREATE TABLE` du fichier SQL)
4. **Prépare une démo de 5 min** : visite client → admin → modification
5. **Apprends à expliquer 2-3 lignes de ton code** : par exemple une requête préparée PDO

---

## 📞 Récapitulatif des accès

```
🌐 SITE PUBLIC
   URL  : http://localhost/euro-auto/public/

🔐 ADMINISTRATION
   URL  : http://localhost/euro-auto/public/admin/login
   User : admin
   Pass : Admin@2026

🗄️ BASE DE DONNÉES
   URL  : http://localhost/phpmyadmin
   Base : euro_auto
```

---

**Bonne soutenance ! Tu as un projet solide entre les mains. 💪**

*Auteur du projet : TAMESSING PIATA HORCHELLE DOLVINE — BTS SIO SLAM, Session 2026*
