Dossier des photos de véhicules.

Ce dossier contient les 12 images JPG de démonstration des véhicules,
plus une image placeholder.jpg utilisée par défaut.

Toutes les images sont incluses dans le projet — pas besoin de connexion
Internet pour les afficher.

────────────────────────────────────────────────────────────────────
POUR REMPLACER UNE IMAGE PAR UNE VRAIE PHOTO :
────────────────────────────────────────────────────────────────────

Méthode 1 — Via le back-office (recommandée)
   1. Connecte-toi sur /admin/login (admin / Admin@2026)
   2. Va dans "Véhicules" → clique sur l'icône crayon (modifier)
   3. Dans la section "Photo", clique sur "Parcourir" et choisis ton image
   4. Clique sur "Enregistrer les modifications"
   → L'upload se fait automatiquement avec validation MIME et taille max 4 Mo

Méthode 2 — Manuelle
   1. Dépose ton fichier .jpg (ou .png, .webp) dans CE dossier
   2. Ouvre phpMyAdmin → table "vehicules"
   3. Modifie la colonne "image" du véhicule pour mettre le nom du nouveau fichier

Formats acceptés : JPG, PNG, WEBP
Taille max     : 4 Mo
