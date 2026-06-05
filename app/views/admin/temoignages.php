<?php /** @var array $pending @var array $published */ ?>

<!-- ============== EN ATTENTE ============== -->
<div class="admin-card mb-4">
    <h2 class="admin-card-title">
        <i class="bi bi-hourglass-split text-warning me-2"></i>
        En attente de modération
        <span class="badge bg-warning text-dark ms-2"><?= count($pending) ?></span>
    </h2>

    <?php if (empty($pending)): ?>
        <p class="text-muted text-center py-4 mb-0">
            <i class="bi bi-check-all display-6 d-block mb-2 text-success"></i>
            Aucun témoignage en attente. Tout est à jour !
        </p>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($pending as $t): ?>
                <div class="col-md-6">
                    <div class="moderation-card pending">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <strong><?= e($t->nom_affiche) ?></strong>
                                <div class="testimonial-stars text-warning">
                                    <?php for ($s = 1; $s <= 5; $s++): ?>
                                        <i class="bi bi-star<?= $s <= $t->note ? '-fill' : '' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <small class="text-muted"><?= date('d/m/Y', strtotime($t->date_creation)) ?></small>
                        </div>
                        <p class="moderation-message"><?= e($t->message) ?></p>
                        <div class="d-flex gap-2">
                            <a href="<?= url('admin/temoignage/approve/' . $t->id) ?>"
                               class="btn btn-sm btn-success">
                                <i class="bi bi-check-lg me-1"></i>Approuver
                            </a>
                            <a href="<?= url('admin/temoignage/delete/' . $t->id) ?>"
                               class="btn btn-sm btn-outline-danger js-confirm-delete"
                               data-confirm-message="Supprimer ce témoignage ?">
                                <i class="bi bi-x-lg me-1"></i>Rejeter
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- ============== PUBLIÉS ============== -->
<div class="admin-card">
    <h2 class="admin-card-title">
        <i class="bi bi-check-circle text-success me-2"></i>
        Témoignages publiés
        <span class="badge bg-success ms-2"><?= count($published) ?></span>
    </h2>

    <?php if (empty($published)): ?>
        <p class="text-muted text-center py-4 mb-0">Aucun témoignage publié.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Auteur</th>
                        <th>Note</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($published as $t): ?>
                        <tr>
                            <td><strong><?= e($t->nom_affiche) ?></strong></td>
                            <td>
                                <span class="text-warning">
                                    <?php for ($s = 1; $s <= 5; $s++): ?>
                                        <i class="bi bi-star<?= $s <= $t->note ? '-fill' : '' ?>"></i>
                                    <?php endfor; ?>
                                </span>
                            </td>
                            <td><?= e(mb_substr($t->message, 0, 100)) . (mb_strlen($t->message) > 100 ? '…' : '') ?></td>
                            <td><small><?= date('d/m/Y', strtotime($t->date_creation)) ?></small></td>
                            <td class="text-end">
                                <a href="<?= url('admin/temoignage/delete/' . $t->id) ?>"
                                   class="btn btn-sm btn-outline-danger js-confirm-delete"
                                   data-confirm-message="Supprimer ce témoignage publié ?">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
