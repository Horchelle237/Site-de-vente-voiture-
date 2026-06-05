<?php /** @var string $csrf */ ?>

<section class="section pt-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-7" data-aos="fade-up">
                <span class="section-eyebrow">Contact</span>
                <h1 class="section-title">Parlons de <span class="text-gold fst-italic">votre prochaine voiture.</span></h1>
                <p class="section-subtitle">
                    Une question, une demande d'essai, un projet de reprise ?
                    Notre équipe vous répond sous 24 h.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Tuiles infos -->
            <div class="col-lg-4">
                <div class="row g-3">
                    <div class="col-12" data-aos="fade-up">
                        <div class="info-tile">
                            <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <h5 class="h6">Notre adresse</h5>
                            <p class="text-muted small mb-0">
                                15 Avenue des Champs-Élysées<br>75008 Paris, France
                            </p>
                        </div>
                    </div>
                    <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="info-tile">
                            <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                            <h5 class="h6">Téléphone</h5>
                            <p class="text-muted small mb-0">
                                +33 1 23 45 67 89<br>
                                <span class="text-gold">Lun. - Sam. : 9h - 19h</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="info-tile">
                            <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
                            <h5 class="h6">Email</h5>
                            <p class="text-muted small mb-0">
                                contact@euroauto.fr<br>commercial@euroauto.fr
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="col-lg-8" data-aos="fade-up">
                <div class="form-card">
                    <h2 class="h4 mb-1">Envoyez-nous un message</h2>
                    <p class="text-muted mb-4 small">Tous les champs marqués d'un * sont obligatoires.</p>

                    <form action="<?= url('contact') ?>" method="post" class="needs-validation" novalidate>
                        <input type="hidden" name="<?= CSRF_TOKEN_NAME ?>" value="<?= e($csrf) ?>">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="prenom">Prénom *</label>
                                <input type="text" class="form-control" id="prenom" name="prenom"
                                       value="<?= old('prenom') ?>" maxlength="80" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="nom">Nom *</label>
                                <input type="text" class="form-control" id="nom" name="nom"
                                       value="<?= old('nom') ?>" maxlength="80" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="<?= old('email') ?>" maxlength="150" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="telephone">Téléphone</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone"
                                       value="<?= old('telephone') ?>" pattern="[\d\s\+\-\.]{6,20}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="sujet">Sujet</label>
                                <select class="form-select" id="sujet" name="sujet">
                                    <option value="">— Choisir un sujet —</option>
                                    <option>Demande d'essai</option>
                                    <option>Reprise de mon véhicule</option>
                                    <option>Demande de financement</option>
                                    <option>Question générale</option>
                                    <option>Autre</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="message">Votre message *</label>
                                <textarea class="form-control" id="message" name="message"
                                          rows="6" minlength="10" required><?= old('message') ?></textarea>
                            </div>
                            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center mt-4">
                                <small class="text-muted">
                                    <i class="bi bi-shield-check me-1 text-warning"></i>
                                    Vos données sont protégées et ne seront jamais partagées.
                                </small>
                                <button type="submit" class="btn btn-warning btn-lg px-4">
                                    Envoyer le message <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Carte Google Maps -->
        <div class="mt-5" data-aos="fade-up">
            <div class="rounded-4 overflow-hidden border" style="border-color: var(--eu-border) !important;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.876912245366!2d2.300580776922789!3d48.8698679013014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fc36cf1a0f7%3A0xd57e88f04d5b65a4!2sChamps-%C3%89lys%C3%A9es%2C%20Paris!5e0!3m2!1sfr!2sfr!4v1700000000000"
                    width="100%" height="400" style="border:0; filter: invert(0.9) hue-rotate(180deg);"
                    allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>
