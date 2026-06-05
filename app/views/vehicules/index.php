<?php /** @var array $vehicules @var array $categories @var array $filters */ ?>

<!-- ============== HEADER PAGE ============== -->
<section class="page-hero">
    <div class="container">
        <span class="hero-badge" data-aos="fade-up">
            <span class="pulse-dot"></span>
            Catalogue EuroAuto
        </span>
        <h1 class="page-hero-title" data-aos="fade-up" data-aos-delay="100">
            Nos véhicules <span class="highlight">d'exception</span>
        </h1>
        <p class="page-hero-subtitle" data-aos="fade-up" data-aos-delay="200">
            Une sélection rigoureuse de véhicules contrôlés et garantis par nos experts.
        </p>
    </div>
</section>

<!-- ============== FILTRES ============== -->
<section class="filter-section">
    <div class="container">
        <form method="get" action="<?= url('vehicules') ?>" class="filter-bar" data-aos="fade-up">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small text-muted">Marque</label>
                    <input type="text" name="marque" class="form-control"
                           placeholder="BMW, Audi, Tesla..."
                           value="<?= e($filters['marque']) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Catégorie</label>
                    <select name="categorie_id" class="form-select">
                        <option value="">Toutes</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= (int) $cat->id ?>"
                                <?= (int) $filters['categorie_id'] === (int) $cat->id ? 'selected' : '' ?>>
                                <?= e($cat->nom) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted">Carburant</label>
                    <select name="carburant" class="form-select">
                        <option value="">Tous</option>
                        <?php foreach (['Essence','Diesel','Hybride','Electrique','GPL'] as $c): ?>
                            <option value="<?= $c ?>" <?= $filters['carburant'] === $c ? 'selected' : '' ?>>
                                <?= $c ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted">Prix max (€)</label>
                    <input type="number" name="prix_max" class="form-control"
                           placeholder="50 000" min="0" step="1000"
                           value="<?= e($filters['prix_max']) ?>">
                </div>
                <div class="col-md-2 d-grid gap-2">
                    <button class="btn btn-warning fw-semibold">
                        <i class="bi bi-search me-2"></i>Filtrer
                    </button>
                    <a href="<?= url('vehicules') ?>" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-x-circle me-1"></i>Réinitialiser
                    </a>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- ============== GRILLE VÉHICULES ============== -->
<section class="vehicles-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-subtitle mb-0"><?= count($vehicules) ?> véhicule<?= count($vehicules) > 1 ? 's' : '' ?> trouvé<?= count($vehicules) > 1 ? 's' : '' ?></h2>
        </div>

        <?php if (empty($vehicules)): ?>
            <div class="empty-state text-center py-5" data-aos="fade-up">
                <i class="bi bi-search display-1 text-muted mb-3"></i>
                <h3 class="text-light">Aucun véhicule ne correspond à vos critères</h3>
                <p class="text-muted">Essayez de modifier vos filtres ou consultez toute notre collection.</p>
                <a href="<?= url('vehicules') ?>" class="btn btn-warning mt-2">Voir tous les véhicules</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($vehicules as $i => $v): ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
                        <article class="vehicle-card">
                            <a href="<?= url('vehicule/' . $v->id) ?>" class="vehicle-card-link">
                                <div class="vehicle-image-wrap">
                                    <img src="<?= asset('images/vehicles/' . $v->image) ?>"
                                         alt="<?= e($v->marque . ' ' . $v->modele) ?>"
                                         onerror="this.src='https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=600&q=80'">
                                    <span class="vehicle-badge"><?= e($v->categorie) ?></span>
                                </div>
                                <div class="vehicle-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h3 class="vehicle-title"><?= e($v->marque) ?> <?= e($v->modele) ?></h3>
                                        <span class="vehicle-year"><?= (int) $v->annee ?></span>
                                    </div>
                                    <div class="vehicle-specs">
                                        <span><i class="bi bi-speedometer2"></i> <?= format_km($v->kilometrage) ?></span>
                                        <span><i class="bi bi-fuel-pump"></i> <?= e($v->carburant) ?></span>
                                        <span><i class="bi bi-gear"></i> <?= e($v->boite) ?></span>
                                    </div>
                                    <div class="vehicle-footer">
                                        <span class="vehicle-price"><?= format_price($v->prix) ?></span>
                                        <span class="vehicle-cta">
                                            Voir <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
