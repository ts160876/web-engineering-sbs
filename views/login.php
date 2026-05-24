<?php

use Bukubuku\Core\Form\Button;
use Bukubuku\Core\Form\Form;
use Bukubuku\Core\Form\Field;

$this->title = 'Login';
$form = new Form('', 'post', $model);
?>

<h1><?= htmlspecialchars($this->title) ?></h1>
<?= $form->start(); ?>
<?= $form->field(Field::EMAIL, 'email'); ?>
<?= $form->field(Field::PASSWORD, 'password'); ?>
<?= $form->button(Button::SUBMIT, 'submit', 'Login') ?>
<?= $form->end(); ?>