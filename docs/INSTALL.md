# 📦 Guide d'installation — EuroAuto

## ⚙️ Prérequis

| Logiciel | Version minimale | Note |
|----------|------------------|------|
| PHP | **8.0** | avec `pdo_mysql`, `fileinfo`, `mbstring` |
| MySQL ou MariaDB | **5.7 / 10.4** | utf8mb4 requis |
| Apache | 2.4 | avec `mod_rewrite` activé |
| Navigateur | Récent | Chrome, Firefox, Edge, Safari |

> 💡 Le plus simple : installer **XAMPP** ([apachefriends.org](https://www.apachefriends.org)),
> qui fournit Apache + MySQL + PHP en une seule installation Windows/Mac/Linux.

---

## 🛠️ Étape 1 — Placer les fichiers

### Avec XAMPP (recommandé pour la soutenance)

1. Démarrer **XAMPP Control Panel**.
2. Cliquer sur **Start** pour Apache et MySQL.
3. Copier le dossier `euro-auto/` dans :
   - **Windows** : `C:\xampp\htdocs\euro-auto\`
   - **Mac** : `/Applications/XAMPP/htdocs/euro-auto/`
   - **Linux** : `/opt/lampp/htdocs/euro-auto/`

### Avec un Apache système (Linux)

```bash
sudo cp -r euro-auto /var/www/html/
sudo chown -R www-data:www-data /var/www/html/euro-auto
sudo a2enmod rewrite
sudo systemctl restart apache2
```

> ⚠️ Vérifier que `AllowOverride All` est défini dans la config Apache
> pour autoriser les `.htaccess`.

---

## 💾 Étape 2 — Créer la base de données

### Via phpMyAdmin (XAMPP)
1. Ouvrir [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Onglet **Importer**.
3. Sélectionner le fichier `sql/euro_auto.sql` et cliquer **Exécuter**.

### En ligne de commande
```bash
mysql -u root -p < sql/euro_auto.sql
```

Le script effectue automatiquement :
- la création de la base `euro_auto` (`CREATE DATABASE IF NOT EXISTS`),
- la création des **6 tables** avec contraintes,
- l'**injection des données de démonstration** (catégories, véhicules, témoignages…),
- la création du compte administrateur par défaut.

---

## 🔧 Étape 3 — Configurer la connexion BDD

Ouvrir `app/config/database.php` et ajuster si besoin :

```php
return [
    'driver'   => 'mysql',
    'host'     => 'localhost',   // ← XAMPP : laisser localhost
    'port'     => '3306',
    'database' => 'euro_auto',
    'username' => 'root',         // ← XAMPP : root par défaut
    'password' => '',             // ← XAMPP : vide par défaut
    'charset'  => 'utf8mb4',
];
```

Vérifier également `app/config/config.php` :

```php
define('BASE_URL', 'http://localhost/euro-auto/public');
```

> Adapter cette URL si vous installez le projet dans un autre sous-dossier.

---

## 🌐 Étape 4 — Accéder au site

| Espace | URL |
|--------|-----|
| Site public | http://localhost/euro-auto/public/ |
| Admin login | http://localhost/euro-auto/public/admin/login |

### 🔐 Identifiants administrateur

```
Identifiant : admin
Mot de passe : Admin@2026
```

> ⚠️ **À changer dès la première connexion en production !**

---

## ✅ Vérifier que tout fonctionne

Après installation, contrôler les points suivants :

- [ ] La page d'accueil affiche le hero EuroAuto avec image
- [ ] La page **Véhicules** liste les 12 véhicules de démonstration
- [ ] Un clic sur un véhicule ouvre la fiche détaillée
- [ ] Le formulaire de contact envoie un message
- [ ] La connexion admin fonctionne avec `admin` / `Admin@2026`
- [ ] Le tableau de bord affiche les statistiques
- [ ] L'ajout d'un véhicule avec upload d'image fonctionne

---

## 🐛 Résolution de problèmes courants

### Erreur 404 sur toutes les pages
→ `mod_rewrite` n'est pas activé. Sur XAMPP : ouvrir
`apache/conf/httpd.conf` et décommenter `LoadModule rewrite_module modules/mod_rewrite.so`.

### « Vue introuvable » au chargement
→ Vérifier que la casse des dossiers et fichiers est respectée
(Linux/Mac sont sensibles à la casse, Windows non).

### Erreur PDO de connexion
→ Vérifier que MySQL est démarré et les identifiants dans
`app/config/database.php`.

### Les images ne s'affichent pas
→ Le projet utilise un fallback automatique vers Unsplash quand l'image
locale est introuvable. C'est normal en démo. Pour ajouter de vraies
images, déposez-les dans `public/assets/images/vehicles/` puis renseignez
le nom dans la table ou via l'admin.

### Erreur « Permission denied » sur l'upload
→ Sur Linux, donner les droits d'écriture au serveur web :
```bash
sudo chmod -R 755 public/assets/images/vehicles/
sudo chown -R www-data:www-data public/assets/images/vehicles/
```

---

## 🎓 Pour la soutenance

Quelques pistes pour valoriser le projet devant le jury :

1. **Démonstration scénarisée** : visiteur → catalogue → fiche → contact → puis admin → modération.
2. **Argumentaire technique** : insister sur la structure MVC, l'autoloader maison, la sécurité (CSRF, prepared, bcrypt).
3. **MCD à présenter** : voir le schéma de la base dans le README + commentaires SQL.
4. **Évolutions possibles** : authentification client, panier, paiement Stripe, e-mails transactionnels…

Bonne soutenance ! 🎓
