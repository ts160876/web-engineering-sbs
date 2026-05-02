<?php

/** @var Bukubuku\Models\Contact $model */
$this->title = 'Contact';
?>

<h1><?= htmlspecialchars($this->title) ?></h1>

<form method="post">
    <div class="mb-3">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" class="form-control <?= $model->hasError('subject') ? 'is-invalid' : ''  ?>" value="<?= $model->subject ?>">
        <div class="invalid-feedback">
            <?= $model->getFirstError('subject') ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email">E-Mail</label>
        <input type="text" id="email" name="email" class="form-control <?= $model->hasError('email') ? 'is-invalid' : ''  ?>" value="<?= $model->email ?>">
        <div class="invalid-feedback">
            <?= $model->getFirstError('email') ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="message">Message</label>
        <textarea id="message" name="message" class="form-control <?= $model->hasError('message') ? 'is-invalid' : ''  ?>"><?= $model->message ?></textarea>
        <div class="invalid-feedback">
            <?= $model->getFirstError('message') ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>