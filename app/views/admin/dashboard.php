<?php /** @var array $stats @var array $derniers_messages */ ?>

<!-- ============== STATS ============== -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card stat-blue">
            <div class="stat-icon"><i class="bi bi-car-front-fill"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?= (int) $stats['vehicules_total'] ?></div>
                <div class="stat-title">Véhicules au catalogue</div>
                <div class="stat-meta">
                    <i class="bi bi-check-circle"></i>
                    <?= (int) $stats['vehicules_dispo'] ?> disponible<?= $stats['vehicules_dispo'] > 1 ? 's' : '' ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card stat-gold">
            <div class="stat-icon"><i class="bi bi-envelope-fill"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?= (int) $stats['messages_total'] ?></div>
                <div class="stat-title">Messages reçus</div>
                <div class="stat-meta">
                    <?php if ($stats['messages_non_lus'] > 0): ?>
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <?= (int) $stats['messages_non_lus'] ?> non lu<?= $stats['messages_non_lus'] > 1 ? 's' : '' ?>
                    <?php else: ?>
                        <i class="bi bi-check-all"></i>Tout est traité
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card stat-green">
            <div class="stat-icon"><i class="bi bi-chat-quote-fill"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?= (int) $stats['temoignages_total'] ?></div>
                <div class="stat-title">Témoignages</div>
                <div class="stat-meta">
                    <?php if ($stats['temoignages_pend'] > 0): ?>
                        <i class="bi bi-hourglass-split text-warning"></i>
                        <?= (int) $stats['temoignages_pend'] ?> à modérer
                    <?php else: ?>
                        <i class="bi bi-check-all"></i>Tout est validé
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="admin-stat-card stat-purple">
            <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
            <div class="stat-info">
                <div class="stat-value">98<span class="stat-unit">%</span></div>
                <div class="stat-title">Satisfaction client</div>
                <div class="stat-meta">
                    <i class="bi bi-arrow-up-right"></i>Taux historique
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============== ACCÈS RAPIDES ============== -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="admin-card">
            <h2 class="admin-card-title">Accès rapides</h2>
            <div class="quick-actions">
                <a href="<?= url('admin/vehicule/new') ?>" class="quick-action">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>Ajouter un véhicule</span>
                </a>
                <a href="<?= url('admin/messages') ?>" class="quick-action">
                    <i class="bi bi-inbox-fill"></i>
                    <span>Boîte de réception</span>
                </a>
                <a href="<?= url('admin/temoignages') ?>" class="quick-action">
                    <i class="bi bi-shield-check"></i>
                    <span>Modérer les avis</span>
                </a>
                <a href="<?= url('') ?>" target="_blank" class="quick-action">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>Voir le site public</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ============== DERNIERS MESSAGES ============== -->
<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="admin-card-title mb-0">Derniers messages</h2>
        <a href="<?= url('admin/messages') ?>" class="btn btn-sm btn-outline-warning">
            Tout voir <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <?php if (empty($derniers_messages)): ?>
        <p class="text-muted text-center py-4 mb-0">
            <i class="bi bi-inbox display-6 d-block mb-2"></i>
            Aucun message pour le moment.
        </p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>État</th>
                        <th>Expéditeur</th>
                        <th>Sujet</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($derniers_messages as $m): ?>
                        <tr class="<?= $m->lu ? '' : 'row-unread' ?>">
                            <td>
                                <?php if ($m->lu): ?>
                                    <span class="badge bg-secondary">Lu</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Nouveau</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= e($m->prenom . ' ' . $m->nom) ?></strong><br>
                                <small class="text-muted"><?= e($m->email) ?></small>
                            </td>
                            <td><?= e($m->sujet ?: '—') ?></td>
                            <td><small><?= date('d/m/Y H:i', strtotime($m->date_envoi)) ?></small></td>
                            <td class="text-end">
                                <a href="<?= url('admin/messages') ?>" class="btn btn-sm btn-outline-light">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
