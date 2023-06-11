<section class="blog">
    <div class="container">
        <div class="blog__inner container__inner_shadow">
            <div class="title">
                <div class="title__main">
                    <h1>Рецепти</h1>
                </div>
                <div class="title__subtitle">
                    Тільки найкращі рецепти
                </div>
            </div>
            <div class="categories">
                <?php
                foreach($categories_array as $category) 
                {?>
                    
                    <div class="category <?php if($filter_id == $category["category_id"]) echo "category_active"?>">
                        <a class="category__link" href="<?php echo "/recipes/index/?filter=".$category["category_id"]?>">
                            <?=$category["name"]?>
                        </a>
                    </div>
                    <?php
                }?>
            </div>
            <div class="posts">
                <?php
                if (count($recipes_array) == 0) {
                    echo "Нічого не знадено";
                }
                else {
                foreach($recipes_array as $recipe) 
                {?>
                    <div class="posts__item">
                        <a class="post__reference" href="/recipe/list/<?=$recipe["recipe_id"]?>">
                            <div class="post__img-container">
                                <img class="post__img" src="/media/recipes_img/<?=$recipe["picture_path"]?>">
                            </div>
                            <div class="post__description">
                                <div class="post__title"><?=$recipe["title"]?></div>
                                <div class="post__sub-info">
                                    <div class="post-info hard-level">Складність: <?=$recipe["complexity"]?></div>
                                    <div class="post-info time">⏳ <?=$recipe["cooking_time"]?> хв</div>
                                </div>
                                <div class="post__additional-info">
                                    <div class="post__stats">
                                        <div class="post-info post-info__comments">👁 <?=$recipe["views"]?></div>
                                    </div>
                                    <div class="post-info date"><?php echo date("d.m.Y H:i", strtotime($recipe["date"])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                } }?>
            </div>
            <div class="pages-list">
                <?php for ($i = 1; $i <= $pages_count; $i++) 
                {?>
                    <div class="pages-list__page  <?php if ($i == $page) echo "pages-list__page_active"?>">
                        <a class="pages-list__link" href="<?php echo "/recipes/index/?filter=".$filter_id."&page=$i"?>">
                            <?php echo $i ?>
                        </a>
                    </div>
                <?php
                }?>
            </div>
        </div>
    </div>
</section>