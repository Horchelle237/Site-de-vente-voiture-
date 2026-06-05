<?php /** @var array $featured @var array $stats @var array $temoignages */ ?>

<!-- ============== HERO ============== -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="hero-badge">
                    <span class="pulse-dot"></span>
                    +200 véhicules disponibles
                </span>
                <h1 class="hero-title">
                    L'art de rouler<br>
                    <span class="highlight">avec excellence.</span>
                </h1>
                <p class="hero-subtitle">
                    EuroAuto sélectionne, contrôle et sublime chaque véhicule pour vous offrir
                    une expérience d'achat à la hauteur de vos exigences. Premium. Fluide. Humain.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?= url('vehicules') ?>" class="btn btn-warning btn-lg px-4 py-3">
                        Découvrir nos véhicules <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="<?= url('contact') ?>" class="btn btn-dark-glass btn-lg px-4 py-3">
                        <i class="bi bi-headset me-2"></i> Nous contacter
                    </a>
                </div>
                <div class="d-flex gap-4 mt-5 pt-3">
                    <div>
                        <div class="h4 mb-0 text-gold fw-bold">5 ans</div>
                        <div class="small text-muted">d'expertise</div>
                    </div>
                    <div class="border-start border-secondary"></div>
                    <div>
                        <div class="h4 mb-0 text-gold fw-bold">98%</div>
                        <div class="small text-muted">de satisfaction</div>
                    </div>
                    <div class="border-start border-secondary"></div>
                    <div>
                        <div class="h4 mb-0 text-gold fw-bold">24h</div>
                        <div class="small text-muted">de livraison</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-visual">
                    <div class="hero-image-wrap">
                        <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=900&q=80&auto=format"
                             alt="Voiture de luxe EuroAuto"
                             onerror="this.src='<?= asset('images/hero-placeholder.jpg') ?>'">
                    </div>
                    <div class="floating-card card-1">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shield-check text-warning fs-4"></i>
                            <div>
                                <div class="small text-muted">Garantie</div>
                                <div class="fw-bold small">12 mois inclus</div>
                            </div>
                        </div>
                    </div>
                    <div class="floating-card card-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-cash-coin text-warning fs-4"></i>
                            <div>
                                <div class="small text-muted">Financement</div>
                                <div class="fw-bold small">Dès 0.9 % TAEG</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============== STATS ============== -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-card">
                    <div class="stat-number" data-counter="<?= (int) $stats['vehicules'] ?>">0</div>
                    <div class="stat-label">Véhicules en stock</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-number" data-counter="<?= (int) $stats['ventes'] ?>">0</div>
                    <div class="stat-label">Ventes réalisées</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-number" data-counter="<?= (int) $stats['satisfaits'] ?>">0</div>
                    <div class="stat-label">Clients satisfaits</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-number" data-counter="<?= (int) $stats['temoignages'] ?>">0</div>
                    <div class="stat-label">Avis clients</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============== FEATURED VEHICLES ============== -->
<section class="section">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-md-7" data-aos="fade-up">
                <span class="section-eyebrow">Sélection du moment</span>
                <h2 class="section-title">Véhicules à la une</h2>
                <p class="section-subtitle">
                    Notre sélection rigoureuse, contrôlée et garantie. Toutes les voitures sont
                    inspectées sur 150 points par nos techniciens.
                </p>
            </div>
            <div class="col-md-5 text-md-end" data-aos="fade-up">
                <a href="<?= url('vehicules') ?>" class="btn btn-outline-warning">
                    Voir le catalogue complet <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="vehicle-grid">
            <?php if (empty($featured)): ?>
                <p class="text-muted">Aucun véhicule disponible pour le moment.</p>
            <?php else: ?>
                <?php foreach ($featured as $i => $v): ?>
                    <article class="vehicle-card" data-aos="fade-up" data-aos-delay="<?= $i * 80 ?>">
                        <div class="vehicle-card-image">
                            <span class="vehicle-card-badge"><?= e($v->categorie) ?></span>
                            <button class="vehicle-card-fav" type="button" aria-label="Favoris">
                                <i class="bi bi-heart"></i>
                            </button>
                            <img src="<?= asset('images/vehicles/' . e($v->image)) ?>"
                                 alt="<?= e($v->marque . ' ' . $v->modele) ?>"
                                 onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=600&q=80'">
                        </div>
                        <div class="vehicle-card-body">
                            <h3 class="vehicle-card-title"><?= e($v->marque . ' ' . $v->modele) ?></h3>
                            <p class="vehicle-card-sub"><?= (int) $v->annee ?> · <?= e($v->couleur) ?></p>
                            <div class="vehicle-specs">
                                <span class="vehicle-spec"><i class="bi bi-fuel-pump"></i><?= e($v->carburant) ?></span>
                                <span class="vehicle-spec"><i class="bi bi-speedometer2"></i><?= format_km((int) $v->kilometrage) ?></span>
                                <span class="vehicle-spec"><i class="bi bi-gear"></i><?= e($v->boite) ?></span>
                            </div>
                            <div class="vehicle-card-price"><?= format_price((float) $v->prix) ?></div>
                            <div class="vehicle-card-foot">
                                <a href="<?= url('vehicule/' . $v->id) ?>" class="btn btn-warning flex-grow-1">
                                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============== POURQUOI EUROAUTO ============== -->
<section class="section" style="background: linear-gradient(180deg, transparent, rgba(245,185,66,0.03));">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-7" data-aos="fade-up">
                <span class="section-eyebrow">Pourquoi EuroAuto</span>
                <h2 class="section-title">Une promesse simple : <span class="text-gold fst-italic">la confiance.</span></h2>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-patch-check-fill"></i></div>
                    <h4>150 points contrôlés</h4>
                    <p>Chaque véhicule est inspecté minutieusement par nos techniciens certifiés.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-shield-shaded"></i></div>
                    <h4>Garantie 12 mois</h4>
                    <p>Une garantie pièces et main d'œuvre offerte sur toute la gamme.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-cash-stack"></i></div>
                    <h4>Reprise possible</h4>
                    <p>Nous reprenons votre ancien véhicule au meilleur prix du marché.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-truck"></i></div>
                    <h4>Livraison rapide</h4>
                    <p>Livraison partout en France métropolitaine sous 48h ouvrées.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============== TÉMOIGNAGES ============== -->
<section class="section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-7" data-aos="fade-up">
                <span class="section-eyebrow">Ils nous font confiance</span>
                <h2 class="section-title">L'avis de nos clients</h2>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($temoignages as $i => $t): ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                    <div class="testimonial-card">
                        <span class="quote-mark">"</span>
                        <div class="stars">
                            <?php for ($s = 1; $s <= 5; $s++): ?>
                                <i class="bi <?= $s <= $t->note ? 'bi-star-fill' : 'bi-star' ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="testimonial-text">« <?= e($t->message) ?> »</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <?= strtoupper(mb_substr($t->nom_affiche, 0, 1)) ?>
                            </div>
                            <div>
                                <div class="author-name"><?= e($t->nom_affiche) ?></div>
                                <div class="author-role">Client EuroAuto</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= url('temoignages') ?>" class="btn btn-outline-warning">
                Tous les témoignages <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ============== CTA FINAL ============== -->
<section class="section pb-0">
    <div class="container">
        <div class="p-5 rounded-4 text-center position-relative overflow-hidden"
             style="background: linear-gradient(135deg, #1a2030, #232a3d); border: 1px solid var(--eu-border-strong);">
            <div data-aos="zoom-in">
                <h2 class="display-5 fw-bold mb-3">
                    Prêt à trouver <span class="text-gold fst-italic">votre voiture idéale</span> ?
                </h2>
                <p class="lead text-muted mb-4">
                    Notre équipe vous accompagne à chaque étape, du premier essai à la remise des clés.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="<?= url('vehicules') ?>" class="btn btn-warning btn-lg px-4">
                        Voir les véhicules
                    </a>
                    <a href="<?= url('contact') ?>" class="btn btn-dark-glass btn-lg px-4">
                        Prendre rendez-vous
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
