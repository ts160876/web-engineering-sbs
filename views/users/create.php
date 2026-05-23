<?php

use Bukubuku\Core\Form\Button;
use Bukubuku\Core\Form\Form;
use Bukubuku\Core\Form\Field;

$this->title = 'Create User';
$form = new Form('', 'post', $model);

?>

<h1><?= htmlspecialchars($this->title) ?></h1>
<?= $form->start(); ?>
<?= $form->field(Field::TEXT, 'firstName'); ?>
<?= $form->field(Field::TEXT, 'lastName'); ?>
<?= $form->field(Field::TEXT, 'email'); ?>
<?= $form->field(Field::NUMBER, 'isAdmin') ?>
<?= $form->field(Field::PASSWORD, 'password'); ?>
<?= $form->field(Field::PASSWORD, 'confirmPassword'); ?>
<?= $form->button(Button::SUBMIT, 'submit', 'Save') ?>
<?= $form->end(); ?>