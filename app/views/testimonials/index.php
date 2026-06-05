<?php /** @var array $temoignages @var float $moyenne @var string $csrf */ ?>

<!-- ============== HEADER PAGE ============== -->
<section class="page-hero">
    <div class="container">
        <span class="hero-badge" data-aos="fade-up">
            <span class="pulse-dot"></span>
            Avis vérifiés
        </span>
        <h1 class="page-hero-title" data-aos="fade-up" data-aos-delay="100">
            Ils nous ont fait <span class="highlight">confiance</span>
        </h1>
        <p class="page-hero-subtitle" data-aos="fade-up" data-aos-delay="200">
            Des centaines de clients satisfaits partagent leur expérience EuroAuto.
        </p>

        <?php if ($moyenne > 0): ?>
            <div class="average-rating" data-aos="zoom-in" data-aos-delay="300">
                <div class="big-stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="bi bi-star<?= $i <= round($moyenne) ? '-fill' : '' ?>"></i>
                    <?php endfor; ?>
                </div>
                <div class="big-rating-value"><?= number_format($moyenne, 1) ?> / 5</div>
                <div class="big-rating-label">Note moyenne — <?= count($temoignages) ?> avis publié<?= count($temoignages) > 1 ? 's' : '' ?></div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============== LISTE TÉMOIGNAGES ============== -->
<section class="testimonials-section">
    <div class="container">
        <?php if (empty($temoignages)): ?>
            <div class="empty-state text-center py-5" data-aos="fade-up">
                <i class="bi bi-chat-quote display-1 text-muted mb-3"></i>
                <h3 class="text-light">Aucun avis pour le moment</h3>
                <p class="text-muted">Soyez le premier à partager votre expérience !</p>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($temoignages as $i => $t): ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">"</div>
                            <div class="testimonial-stars">
                                <?php for ($s = 1; $s <= 5; $s++): ?>
                                    <i class="bi bi-star<?= $s <= $t->note ? '-fill' : '' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="testimonial-text"><?= e($t->message) ?></p>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <?= strtoupper(mb_substr($t->nom_affiche, 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="author-name"><?= e($t->nom_affiche) ?></div>
                                    <div class="author-date"><?= date('d/m/Y', strtotime($t->date_creation)) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============== FORMULAIRE D'AJOUT ============== -->
<section class="add-testimonial-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card" data-aos="fade-up">
                    <h2 class="form-card-title">Partagez votre expérience</h2>
                    <p class="form-card-subtitle">
                        Votre avis sera publié après validation par notre équipe.
                    </p>

                    <form method="post" action="<?= url('temoignages') ?>" novalidate>
                        <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= e($csrf) ?>">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom complet *</label>
                                <input type="text" id="nom" name="nom" class="form-control"
                                       maxlength="100" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email (facultatif)</label>
                                <input type="email" id="email" name="email" class="form-control"
                                       maxlength="150">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Votre note *</label>
                                <div class="star-rating" data-rating="0">
                                    <i class="bi bi-star" data-value="1"></i>
                                    <i class="bi bi-star" data-value="2"></i>
                                    <i class="bi bi-star" data-value="3"></i>
                                    <i class="bi bi-star" data-value="4"></i>
                                    <i class="bi bi-star" data-value="5"></i>
                                </div>
                                <input type="hidden" name="note" id="note" value="0" required>
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label">Votre message *</label>
                                <textarea id="message" name="message" class="form-control"
                                          rows="5" minlength="10" maxlength="1000" required
                                          placeholder="Décrivez votre expérience avec EuroAuto..."></textarea>
                                <small class="text-muted">Entre 10 et 1000 caractères.</small>
                            </div>

                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-warning btn-lg fw-semibold">
                                    <i class="bi bi-send me-2"></i>Publier mon avis
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
