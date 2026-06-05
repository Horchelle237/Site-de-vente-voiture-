<?php /** @var array $vehicules */ ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">
        <?= count($vehicules) ?> véhicule<?= count($vehicules) > 1 ? 's' : '' ?> au catalogue
    </p>
    <a href="<?= url('admin/vehicule/new') ?>" class="btn btn-warning fw-semibold">
        <i class="bi bi-plus-circle me-2"></i>Ajouter un véhicule
    </a>
</div>

<div class="admin-card">
    <?php if (empty($vehicules)): ?>
        <div class="text-center py-5">
            <i class="bi bi-car-front display-1 text-muted"></i>
            <h3 class="mt-3">Aucun véhicule au catalogue</h3>
            <p class="text-muted">Commencez par ajouter votre premier véhicule.</p>
            <a href="<?= url('admin/vehicule/new') ?>" class="btn btn-warning">
                <i class="bi bi-plus-circle me-2"></i>Ajouter
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:80px">Image</th>
                        <th>Véhicule</th>
                        <th>Catégorie</th>
                        <th>Année</th>
                        <th>Km</th>
                        <th>Carburant</th>
                        <th>Prix</th>
                        <th>État</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehicules as $v): ?>
                        <tr>
                            <td>
                                <img src="<?= asset('images/vehicles/' . $v->image) ?>"
                                     alt="<?= e($v->marque) ?>"
                                     class="admin-thumb"
                                     onerror="this.src='https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=120&q=70'">
                            </td>
                            <td>
                                <strong><?= e($v->marque) ?> <?= e($v->modele) ?></strong>
                                <?php if ($v->couleur): ?>
                                    <br><small class="text-muted"><?= e($v->couleur) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge bg-secondary"><?= e($v->categorie) ?></span></td>
                            <td><?= (int) $v->annee ?></td>
                            <td><?= format_km($v->kilometrage) ?></td>
                            <td><?= e($v->carburant) ?></td>
                            <td class="text-gold fw-bold"><?= format_price($v->prix) ?></td>
                            <td>
                                <?php if ($v->disponible): ?>
                                    <span class="badge bg-success">En vente</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Vendu</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="<?= url('vehicule/' . $v->id) ?>"
                                       target="_blank"
                                       class="btn btn-outline-light"
                                       title="Voir sur le site">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= url('admin/vehicule/edit/' . $v->id) ?>"
                                       class="btn btn-outline-warning"
                                       title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= url('admin/vehicule/delete/' . $v->id) ?>"
                                       class="btn btn-outline-danger js-confirm-delete"
                                       data-confirm-message="Supprimer définitivement <?= e($v->marque . ' ' . $v->modele) ?> ?"
                                       title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
