<?php

/** @var Bukubuku\Models\Contact $model */

use Bukubuku\Core\Form\Form;
use Bukubuku\Core\Form\Button;
use Bukubuku\Core\Form\Field;

$this->title = 'Contact';
$form = new Form('', 'post', $model);
?>

<h1><?= htmlspecialchars($this->title) ?></h1>

<?= $form->start() ?>
<?= $form->field(Field::TEXT, 'subject'); ?>
<?= $form->field(Field::EMAIL, 'email'); ?>
<?= $form->textarea('message') ?>
<?= $form->button(Button::SUBMIT, 'submit', 'Submit') ?>
<?= $form->end() ?>