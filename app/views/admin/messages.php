<?php /** @var array $messages */ ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">
        <?= count($messages) ?> message<?= count($messages) > 1 ? 's' : '' ?> reçu<?= count($messages) > 1 ? 's' : '' ?>
    </p>
</div>

<div class="admin-card">
    <?php if (empty($messages)): ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox display-1 text-muted"></i>
            <h3 class="mt-3">Aucun message reçu</h3>
            <p class="text-muted">Vous serez notifié dès qu'un visiteur prendra contact.</p>
        </div>
    <?php else: ?>
        <div class="messages-list">
            <?php foreach ($messages as $m): ?>
                <article class="message-item <?= $m->lu ? 'is-read' : 'is-unread' ?>">
                    <div class="message-head">
                        <div class="message-sender">
                            <div class="message-avatar">
                                <?= strtoupper(mb_substr($m->prenom, 0, 1) . mb_substr($m->nom, 0, 1)) ?>
                            </div>
                            <div>
                                <div class="message-name">
                                    <?= e($m->prenom . ' ' . $m->nom) ?>
                                    <?php if (!$m->lu): ?>
                                        <span class="badge bg-warning text-dark ms-2">Nouveau</span>
                                    <?php endif; ?>
                                </div>
                                <div class="message-contact">
                                    <a href="mailto:<?= e($m->email) ?>"><i class="bi bi-envelope"></i> <?= e($m->email) ?></a>
                                    <?php if ($m->telephone): ?>
                                        · <a href="tel:<?= e($m->telephone) ?>"><i class="bi bi-telephone"></i> <?= e($m->telephone) ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="message-meta">
                            <small class="text-muted">
                                <i class="bi bi-clock"></i>
                                <?= date('d/m/Y à H:i', strtotime($m->date_envoi)) ?>
                            </small>
                        </div>
                    </div>

                    <?php if ($m->sujet): ?>
                        <div class="message-subject">
                            <i class="bi bi-tag-fill text-warning"></i>
                            <strong><?= e($m->sujet) ?></strong>
                        </div>
                    <?php endif; ?>

                    <div class="message-body">
                        <?= nl2br(e($m->message)) ?>
                    </div>

                    <div class="message-actions">
                        <a href="mailto:<?= e($m->email) ?>?subject=Re: <?= e($m->sujet ?: 'Votre demande EuroAuto') ?>"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-reply me-1"></i>Répondre
                        </a>
                        <?php if (!$m->lu): ?>
                            <a href="<?= url('admin/message/read/' . $m->id) ?>"
                               class="btn btn-sm btn-outline-light">
                                <i class="bi bi-check2 me-1"></i>Marquer comme lu
                            </a>
                        <?php endif; ?>
                        <a href="<?= url('admin/message/delete/' . $m->id) ?>"
                           class="btn btn-sm btn-outline-danger js-confirm-delete"
                           data-confirm-message="Supprimer ce message ?">
                            <i class="bi bi-trash me-1"></i>Supprimer
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
