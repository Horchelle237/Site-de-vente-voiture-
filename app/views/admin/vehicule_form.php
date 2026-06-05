<?php /** @var ?object $vehicule @var array $categories @var string $csrf */ ?>

<div class="mb-4">
    <a href="<?= url('admin/vehicules') ?>" class="text-muted text-decoration-none">
        <i class="bi bi-arrow-left me-1"></i>Retour à la liste
    </a>
</div>

<div class="admin-card">
    <form method="post" action="<?= url('admin/vehicule/save') ?>" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= e($csrf) ?>">
        <?php if ($vehicule): ?>
            <input type="hidden" name="id" value="<?= (int) $vehicule->id ?>">
            <input type="hidden" name="image_existante" value="<?= e($vehicule->image) ?>">
        <?php endif; ?>

        <h2 class="form-section-title">
            <i class="bi bi-info-circle me-2"></i>Informations générales
        </h2>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="marque" class="form-label">Marque *</label>
                <input type="text" id="marque" name="marque" class="form-control"
                       maxlength="60" required
                       value="<?= e($vehicule->marque ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label for="modele" class="form-label">Modèle *</label>
                <input type="text" id="modele" name="modele" class="form-control"
                       maxlength="60" required
                       value="<?= e($vehicule->modele ?? '') ?>">
            </div>
            <div class="col-md-4">
                <label for="annee" class="form-label">Année *</label>
                <input type="number" id="annee" name="annee" class="form-control"
                       min="1990" max="<?= date('Y') + 1 ?>" required
                       value="<?= e($vehicule->annee ?? date('Y')) ?>">
            </div>
            <div class="col-md-4">
                <label for="prix" class="form-label">Prix (€) *</label>
                <input type="number" id="prix" name="prix" class="form-control"
                       min="0" step="0.01" required
                       value="<?= e($vehicule->prix ?? '') ?>">
            </div>
            <div class="col-md-4">
                <label for="kilometrage" class="form-label">Kilométrage</label>
                <input type="number" id="kilometrage" name="kilometrage" class="form-control"
                       min="0"
                       value="<?= e($vehicule->kilometrage ?? 0) ?>">
            </div>

            <div class="col-md-3">
                <label for="categorie_id" class="form-label">Catégorie *</label>
                <select id="categorie_id" name="categorie_id" class="form-select" required>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= (int) $c->id ?>"
                            <?= ($vehicule && $vehicule->categorie_id == $c->id) ? 'selected' : '' ?>>
                            <?= e($c->nom) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="carburant" class="form-label">Carburant *</label>
                <select id="carburant" name="carburant" class="form-select" required>
                    <?php foreach (['Essence','Diesel','Hybride','Electrique','GPL'] as $c): ?>
                        <option value="<?= $c ?>"
                            <?= ($vehicule && $vehicule->carburant === $c) ? 'selected' : '' ?>>
                            <?= $c ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="boite" class="form-label">Boîte *</label>
                <select id="boite" name="boite" class="form-select" required>
                    <?php foreach (['Manuelle','Automatique'] as $b): ?>
                        <option value="<?= $b ?>"
                            <?= ($vehicule && $vehicule->boite === $b) ? 'selected' : '' ?>>
                            <?= $b ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="puissance" class="form-label">Puissance (ch)</label>
                <input type="number" id="puissance" name="puissance" class="form-control"
                       min="0"
                       value="<?= e($vehicule->puissance ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label for="couleur" class="form-label">Couleur</label>
                <input type="text" id="couleur" name="couleur" class="form-control"
                       maxlength="40"
                       value="<?= e($vehicule->couleur ?? '') ?>">
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input type="checkbox" id="disponible" name="disponible" class="form-check-input"
                           value="1"
                           <?= (!$vehicule || $vehicule->disponible) ? 'checked' : '' ?>>
                    <label for="disponible" class="form-check-label">
                        Véhicule disponible à la vente
                    </label>
                </div>
            </div>
        </div>

        <h2 class="form-section-title">
            <i class="bi bi-card-text me-2"></i>Description
        </h2>
        <div class="mb-4">
            <label for="description" class="form-label">Description complète *</label>
            <textarea id="description" name="description" class="form-control" rows="6" required><?= e($vehicule->description ?? '') ?></textarea>
            <small class="text-muted">
                Détaillez l'état général, les équipements, l'historique d'entretien...
            </small>
        </div>

        <h2 class="form-section-title">
            <i class="bi bi-image me-2"></i>Photo
        </h2>
        <div class="row g-3 mb-4">
            <?php if ($vehicule && $vehicule->image): ?>
                <div class="col-md-3">
                    <p class="small text-muted mb-1">Photo actuelle :</p>
                    <img src="<?= asset('images/vehicles/' . $vehicule->image) ?>"
                         alt="Aperçu"
                         class="img-fluid rounded border border-secondary"
                         onerror="this.src='https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=300&q=70'">
                </div>
            <?php endif; ?>
            <div class="<?= ($vehicule && $vehicule->image) ? 'col-md-9' : 'col-12' ?>">
                <label for="image" class="form-label">
                    <?= $vehicule ? 'Remplacer la photo' : 'Photo du véhicule' ?>
                </label>
                <input type="file" id="image" name="image" class="form-control"
                       accept="image/jpeg,image/png,image/webp">
                <small class="text-muted">
                    Formats acceptés : JPG, PNG, WEBP — Taille max : 4 Mo
                </small>
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <a href="<?= url('admin/vehicules') ?>" class="btn btn-outline-light">
                <i class="bi bi-x me-2"></i>Annuler
            </a>
            <button type="submit" class="btn btn-warning fw-semibold">
                <i class="bi bi-check-lg me-2"></i>
                <?= $vehicule ? 'Enregistrer les modifications' : 'Créer le véhicule' ?>
            </button>
        </div>
    </form>
</div>
