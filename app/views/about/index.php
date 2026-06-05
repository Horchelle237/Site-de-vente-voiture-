<section class="section pt-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="section-eyebrow">Notre histoire</span>
                <h1 class="section-title">
                    Cinq ans d'<span class="text-gold fst-italic">excellence automobile.</span>
                </h1>
                <p class="lead text-muted">
                    Fondée en 2020 par <strong class="text-gold">M. Valentin Taya</strong>, EuroAuto
                    est devenue en quelques années un acteur reconnu du secteur automobile en Île-de-France.
                </p>
                <p class="text-muted">
                    Spécialisée dans la vente, la maintenance et la réparation de véhicules, ainsi que dans
                    la distribution de pièces détachées, notre entreprise compte aujourd'hui
                    <strong class="text-gold">45 collaborateurs passionnés</strong> répartis entre les services
                    techniques, commerciaux et administratifs.
                </p>
                <p class="text-muted">
                    Avec un chiffre d'affaires de <strong class="text-gold">8,5 millions d'euros</strong>,
                    nous sommes appréciés pour notre réactivité, la qualité de nos services
                    et la rigueur de notre sélection de véhicules.
                </p>
                <div class="d-flex gap-3 flex-wrap mt-4">
                    <a href="<?= url('vehicules') ?>" class="btn btn-warning">Nos véhicules</a>
                    <a href="<?= url('contact') ?>" class="btn btn-outline-warning">Nous rencontrer</a>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1562519819-016930ada31c?w=900&q=80&auto=format"
                         alt="Showroom EuroAuto"
                         onerror="this.src='https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=900&q=80'">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission / Vision -->
<section class="section pt-0">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-bullseye"></i></div>
                    <h4>Notre mission</h4>
                    <p>
                        Offrir à chaque client une expérience d'achat automobile transparente,
                        sereine et personnalisée, en proposant des véhicules rigoureusement
                        sélectionnés et garantis.
                    </p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-eye"></i></div>
                    <h4>Notre vision</h4>
                    <p>
                        Devenir la référence francilienne en matière de vente de véhicules
                        d'occasion premium, en alliant innovation digitale et accompagnement
                        humain à chaque étape.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Valeurs -->
<section class="section pt-0">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-7" data-aos="fade-up">
                <span class="section-eyebrow">Nos valeurs</span>
                <h2 class="section-title">Ce qui nous fait avancer</h2>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-handshake"></i></div>
                    <h4>Confiance</h4>
                    <p>Un engagement éthique et transparent à chaque transaction.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-stars"></i></div>
                    <h4>Excellence</h4>
                    <p>Une exigence de qualité dans chaque détail technique et relationnel.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-people"></i></div>
                    <h4>Proximité</h4>
                    <p>Une équipe à l'écoute, disponible et passionnée par l'automobile.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <div class="value-icon"><i class="bi bi-lightning-charge"></i></div>
                    <h4>Réactivité</h4>
                    <p>Des délais maîtrisés pour répondre rapidement à toutes vos demandes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pourquoi nous choisir -->
<section class="section pt-0">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <span class="section-eyebrow">Pourquoi nous</span>
                <h2 class="section-title">L'équipe qui change<br>la donne automobile.</h2>
                <p class="text-muted">
                    Plus qu'un concessionnaire, nous sommes un partenaire automobile sur le long terme :
                    accompagnement, financement, entretien et reprise.
                </p>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="row g-3">
                    <?php
                    $arguments = [
                        ['bi-award',          'Véhicules certifiés',     '150 points de contrôle systématiques.'],
                        ['bi-credit-card',    'Financement adapté',      'Solutions de crédit dès 0.9 % TAEG.'],
                        ['bi-arrow-repeat',   'Reprise garantie',        'Estimation gratuite de votre véhicule.'],
                        ['bi-tools',          'Entretien complet',       'Service après-vente et atelier dédié.'],
                        ['bi-truck',          'Livraison nationale',     'Partout en France sous 48h ouvrées.'],
                        ['bi-headset',        'Conseillers dédiés',      'Une équipe formée pour vous écouter.'],
                    ];
                    foreach ($arguments as $arg): ?>
                        <div class="col-md-6">
                            <div class="d-flex gap-3 align-items-start p-3 rounded-3"
                                 style="background: var(--eu-bg-card); border: 1px solid var(--eu-border);">
                                <i class="bi <?= $arg[0] ?> text-warning fs-4 mt-1"></i>
                                <div>
                                    <h6 class="mb-1"><?= $arg[1] ?></h6>
                                    <p class="small text-muted mb-0"><?= $arg[2] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
