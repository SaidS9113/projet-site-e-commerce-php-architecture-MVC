<main>
    <section>
        <h2>Avatar de <?= $user['id'] ?></h2>
        <p><img style="border-radius: 8%;" src="<?= '/upload/' . $user['photo_filename'] ?>" /></p>
    </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/view/partial/footer.php' ?>
