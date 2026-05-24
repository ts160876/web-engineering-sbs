<?php

$this->title = 'List Users';
?>

<h1><?= htmlspecialchars($this->title) ?></h1>

<a class="btn btn-primary" href="/web-engineering-sbs/public/index.php/users/create" role="button">Create User</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">E-Mail</th>
            <th scope="col">User Role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><a href="/web-engineering-sbs/public/index.php/users/edit?userId=<?= htmlspecialchars($user['userId']) ?>"><?= htmlspecialchars($user['userId']) ?></a></td>
                <td><?= htmlspecialchars($user['firstName']) ?></td>
                <td><?= htmlspecialchars($user['lastName']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['isAdmin']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>