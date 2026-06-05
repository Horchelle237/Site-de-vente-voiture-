<?php /** @var object $vehicule @var array $similaires */ ?>

<!-- ============== FIL D'ARIANE ============== -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= url('') ?>">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= url('vehicules') ?>">Véhicules</a></li>
                <li class="breadcrumb-item active"><?= e($vehicule->marque) ?> <?= e($vehicule->modele) ?></li>
            </ol>
        </nav>
    </div>
</section>

<!-- ============== DÉTAIL VÉHICULE ============== -->
<section class="vehicle-detail">
    <div class="container">
        <div class="row g-5">
            <!-- Galerie -->
            <div class="col-lg-7" data-aos="fade-right">
                <div class="vehicle-gallery">
                    <div class="gallery-main">
                        <img id="mainImage"
                             src="<?= asset('images/vehicles/' . $vehicule->image) ?>"
                             alt="<?= e($vehicule->marque . ' ' . $vehicule->modele) ?>"
                             onerror="this.src='https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=900&q=80'">
                        <span class="vehicle-badge gallery-badge"><?= e($vehicule->categorie) ?></span>
                    </div>
                </div>
            </div>

            <!-- Infos -->
            <div class="col-lg-5" data-aos="fade-left">
                <div class="vehicle-info">
                    <div class="d-flex align-items-center gap-2 text-muted mb-2">
                        <i class="bi bi-calendar3"></i>
                        <small>Mise en ligne le <?= date('d/m/Y', strtotime($vehicule->date_ajout)) ?></small>
                    </div>
                    <h1 class="vehicle-detail-title">
                        <?= e($vehicule->marque) ?>
                        <span class="text-gold"><?= e($vehicule->modele) ?></span>
                    </h1>
                    <div class="vehicle-detail-price"><?= format_price($vehicule->prix) ?></div>

                    <div class="spec-grid">
                        <div class="spec-item">
                            <i class="bi bi-calendar-event"></i>
                            <div>
                                <div class="spec-label">Année</div>
                                <div class="spec-value"><?= (int) $vehicule->annee ?></div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-speedometer2"></i>
                            <div>
                                <div class="spec-label">Kilométrage</div>
                                <div class="spec-value"><?= format_km($vehicule->kilometrage) ?></div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-fuel-pump"></i>
                            <div>
                                <div class="spec-label">Carburant</div>
                                <div class="spec-value"><?= e($vehicule->carburant) ?></div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <i class="bi bi-gear"></i>
                            <div>
                                <div class="spec-label">Boîte</div>
                                <div class="spec-value"><?= e($vehicule->boite) ?></div>
                            </div>
                        </div>
                        <?php if ($vehicule->puissance): ?>
                        <div class="spec-item">
                            <i class="bi bi-lightning-charge"></i>
                            <div>
                                <div class="spec-label">Puissance</div>
                                <div class="spec-value"><?= (int) $vehicule->puissance ?> ch</div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($vehicule->couleur): ?>
                        <div class="spec-item">
                            <i class="bi bi-palette"></i>
                            <div>
                                <div class="spec-label">Couleur</div>
                                <div class="spec-value"><?= e($vehicule->couleur) ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <a href="<?= url('contact') ?>?vehicule=<?= urlencode($vehicule->marque . ' ' . $vehicule->modele) ?>"
                           class="btn btn-warning btn-lg fw-semibold">
                            <i class="bi bi-envelope me-2"></i>Demander une information
                        </a>
                        <a href="tel:+33145789600" class="btn btn-dark-glass btn-lg">
                            <i class="bi bi-telephone me-2"></i>01 45 78 96 00
                        </a>
                    </div>

                    <div class="trust-row mt-4">
                        <div><i class="bi bi-shield-check text-warning"></i> Garantie 12 mois</div>
                        <div><i class="bi bi-truck text-warning"></i> Livraison 24h</div>
                        <div><i class="bi bi-cash-coin text-warning"></i> Financement</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="row mt-5">
            <div class="col-lg-9">
                <div class="description-card" data-aos="fade-up">
                    <h2 class="h4 text-gold mb-3">
                        <i class="bi bi-file-text me-2"></i>Description
                    </h2>
                    <p class="lead-description"><?= nl2br(e($vehicule->description)) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============== VÉHICULES SIMILAIRES ============== -->
<?php if (!empty($similaires)): ?>
<section class="similar-section">
    <div class="container">
        <h2 class="section-subtitle text-center mb-5" data-aos="fade-up">
            Véhicules <span class="highlight">similaires</span>
        </h2>
        <div class="row g-4">
            <?php foreach ($similaires as $i => $v): ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
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
                                </div>
                                <div class="vehicle-footer">
                                    <span class="vehicle-price"><?= format_price($v->prix) ?></span>
                                    <span class="vehicle-cta">Voir <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
