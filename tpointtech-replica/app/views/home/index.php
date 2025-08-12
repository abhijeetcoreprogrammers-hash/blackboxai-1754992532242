<section class="hero" style="background-color: <?= COLOR_LIGHT_GREEN ?>; padding: 2rem 0; text-align: center;">
    <div class="container">
        <h1 style="color: <?= COLOR_BLACK ?>; font-size: 2.5rem; margin-bottom: 0.5rem;">Welcome to TPoint Tech Replica</h1>
        <p style="color: <?= COLOR_BLACK ?>; font-size: 1.2rem; margin-bottom: 1.5rem;">Get access to 500+ tutorials from top instructors around the world in one place.</p>
        <div class="banners" style="display: flex; justify-content: center; gap: 1rem;">
            <img src="https://images.tpointtech.com/images/small_home.png" alt="Banner 1" style="max-width: 300px; border-radius: 8px;">
            <img src="https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/home-1.webp" alt="Banner 2" style="max-width: 300px; border-radius: 8px;">
        </div>
    </div>
</section>

<section class="tutorial-categories" style="padding: 2rem 0;">
    <div class="container">
        <h2 style="color: <?= COLOR_ORANGE ?>; font-size: 2rem; margin-bottom: 1rem;">Tutorial Categories</h2>
        <div class="categories-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
            <?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $cat) : ?>
                    <div class="category-card" style="border: 1px solid <?= COLOR_BLACK ?>; padding: 1rem; text-align: center; border-radius: 8px; background-color: <?= COLOR_WHITE ?>;">
                        <a href="<?= BASE_URL ?>?controller=Category&action=index&id=<?= $cat['id'] ?>" style="text-decoration: none; color: <?= COLOR_BLACK ?>;">
                            <div class="category-image" style="margin-bottom: 0.5rem;">
                                <img src="<?= h($cat['image_url'] ?: $cat['icon_url']) ?>" alt="<?= h($cat['name']) ?>" style="max-width: 80px; height: auto;">
                            </div>
                            <div class="category-title" style="font-weight: bold; font-size: 1.1rem;"><?= h($cat['name']) ?></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No categories available.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="featured-tutorials" style="background-color: <?= COLOR_LIGHT_ORANGE ?>; padding: 2rem 0;">
    <div class="container">
        <h2 style="color: <?= COLOR_GREEN ?>; font-size: 2rem; margin-bottom: 1rem;">Featured Tutorials</h2>
        <div class="tutorials-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
            <?php if (!empty($featuredTutorials)) : ?>
                <?php foreach ($featuredTutorials as $tutorial) : ?>
                    <div class="tutorial-card" style="border: 1px solid <?= COLOR_BLACK ?>; padding: 1rem; border-radius: 8px; background-color: <?= COLOR_WHITE ?>;">
                        <a href="<?= BASE_URL ?>?controller=Tutorial&action=show&id=<?= $tutorial['id'] ?>" style="text-decoration: none; color: <?= COLOR_BLACK ?>;">
                            <div class="tutorial-image" style="margin-bottom: 0.5rem;">
                                <img src="<?= h($tutorial['image_url']) ?>" alt="<?= h($tutorial['title']) ?>" style="max-width: 100%; height: auto; border-radius: 4px;">
                            </div>
                            <div class="tutorial-title" style="font-weight: bold; font-size: 1.1rem;"><?= h($tutorial['title']) ?></div>
                            <p style="font-size: 0.9rem; color: <?= COLOR_BLACK ?>; margin-top: 0.3rem;"><?= h(substr($tutorial['description'], 0, 100)) ?>...</p>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No featured tutorials available.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
