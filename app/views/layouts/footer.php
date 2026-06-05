    </main>

    <!-- ====== FOOTER ====== -->
    <footer class="euroauto-footer">
        <div class="container py-5">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <h4 class="brand-text mb-3">
                        Euro<span class="text-warning">Auto</span>
                    </h4>
                    <p class="text-secondary small">
                        L'excellence automobile à portée de main. Plus de 200 véhicules sélectionnés
                        et révisés en Île-de-France depuis 2020.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <h6 class="text-uppercase small fw-bold text-warning mb-3">Navigation</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="<?= url('/') ?>">Accueil</a></li>
                        <li class="mb-2"><a href="<?= url('vehicules') ?>">Véhicules</a></li>
                        <li class="mb-2"><a href="<?= url('a-propos') ?>">À propos</a></li>
                        <li class="mb-2"><a href="<?= url('temoignages') ?>">Témoignages</a></li>
                        <li class="mb-2"><a href="<?= url('contact') ?>">Contact</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <h6 class="text-uppercase small fw-bold text-warning mb-3">Contact</h6>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>15 Avenue des Champs<br>75008 Paris</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>+33 1 23 45 67 89</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>contact@euroauto.fr</li>
                        <li class="mb-2"><i class="bi bi-clock me-2"></i>Lun. - Sam. : 9h - 19h</li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h6 class="text-uppercase small fw-bold text-warning mb-3">Newsletter</h6>
                    <p class="small text-secondary">Recevez nos dernières annonces.</p>
                    <form class="d-flex gap-2" onsubmit="event.preventDefault(); alert('Inscription enregistrée. Merci !');">
                        <input type="email" class="form-control form-control-sm" placeholder="votre@email.fr" required>
                        <button class="btn btn-warning btn-sm" type="submit"><i class="bi bi-send"></i></button>
                    </form>
                </div>
            </div>

            <hr class="border-secondary mt-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-secondary small">
                <span>© <?= date('Y') ?> EuroAuto. Tous droits réservés.</span>
                <span>Site BTS SIO SLAM · Session 2026 · TAMESSING PIATA H. D.</span>
            </div>
        </div>
    </footer>

    <!-- Bouton retour en haut -->
    <button id="backToTop" class="btn btn-warning btn-back-top" aria-label="Retour en haut">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
