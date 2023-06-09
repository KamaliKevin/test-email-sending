<?php
    require "process.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="p-3">
<div class="container">
    <h1>Contact Us</h1>

    <form method="POST" enctype="multipart/form-data" class="my-4">
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control <?= ($errors['username'] ?? '') ? 'is-invalid' : '' ?>"
                   id="username" name="username" value="<?= $username ?? '' ?>">
            <div class="invalid-feedback">
                <?= $errors['username'] ?? '' ?>
            </div>
        </div>

        <div class="form-group mt-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= ($errors['email'] ?? '') ? 'is-invalid' : '' ?>"
                   id="email" name="email" value="<?= $email ?? '' ?>">
            <div class="invalid-feedback">
                <?= $errors['email'] ?? '' ?>
            </div>
        </div>

        <div class="form-group mt-4">
            <label for="body" class="form-label">Message</label>
            <textarea class="form-control <?= ($errors['body'] ?? '') ? 'is-invalid' : '' ?>"
                      id="body" name="body" rows="5"><?= $body ?? '' ?></textarea>
            <div class="invalid-feedback">
                <?= $errors['body'] ?? '' ?>
            </div>
        </div>

        <div class="form-group mt-4">
            <label for="files" class="form-label">Attach files</label>
            <input type="file" class="form-control" id="files" name="files[]" multiple>
            <div class="form-text mt-2">
                <i class="fa-solid fa-circle-info"></i>
                Only PDF, TXT, DOC, PNG, and JPG files are allowed. Max. of 5 files, 5MB max. each
            </div>
            <div class="text-danger mt-2">
                <?= $errors['files'] ?? '' ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    <?php if(!empty($errors["notSent"])): ?>
    <div class="alert alert-danger my-4">
        <?= $errors["notSent"] ?>
    </div>
    <?php elseif(!empty($successMessage)): ?>
    <div class="alert alert-success my-4">
        <?= $successMessage ?>
    </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>