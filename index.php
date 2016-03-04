<?php require_once './detector.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form method="post">
            <label>
                <?= $config->get('view.input1.label') ?>
                <input type="<?= $config->get('view.input1.type') ?>" name="<?= $config->get('view.input1.name') ?>">
            </label>
            <label>
                <?= $config->get('view.input2.label') ?>
                <input type="<?= $config->get('view.input2.type') ?>" name="<?= $config->get('view.input2.name') ?>">
            </label>
            <button type="submit"><?= $config->get('view.button.label') ?></button>
        </form>
    </body>
</html>
