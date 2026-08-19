<div class="container">
    <nav aria-label="Page navigation example">
        <ul class="pagination">

            <?php if (!empty($start_page)): ?>
                <li class="page-item"><a class="page-link" href="<?= $start_page ?>">Start Page</a></li>
            <?php endif; ?>

            <?php if (!empty($back)): ?>
                <li class="page-item"><a class="page-link" href="<?= $back ?>">&lt Previous page</a></li>
            <?php endif; ?>

            <?php if (!empty($pages_left)): ?>
                <?php foreach ($pages_left as $pg) : ?>
                    <li class="page-item"><a class="page-link" href="<?= $pg['link'] ?>"><?= $pg['number']?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>

            <li class="page-item active">
                <a class="page-link" href="#" aria-current="page"><?= $current_page ?></a>
            </li>

            <?php if (!empty($pages_right)): ?>
                <?php foreach ($pages_right as $pg) : ?>
                    <li class="page-item"><a class="page-link" href="<?= $pg['link'] ?>"><?= $pg['number']?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($forward)): ?>
                <li class="page-item"><a class="page-link" href="<?= $forward ?>">Next page &gt </a></li>
            <?php endif; ?>

            <?php if (!empty($last_page)): ?>
                <li class="page-item"><a class="page-link" href="<?= $last_page ?>">Last Page</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>