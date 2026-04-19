<?php
$this->title = 'Contact';
?>

<h1><?= htmlspecialchars($this->title) ?></h1>

<form method="post">
    <div class="mb-3">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" class="form-control">
    </div>
    <div class="mb-3">
        <label for="email">E-Mail</label>
        <input type="text" id="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label for="message">Message</label>
        <textarea id="message" name="message" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>