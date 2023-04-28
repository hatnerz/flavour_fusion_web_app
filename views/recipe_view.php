<section class="post">
    <div class="container">
        <div class="post__inner container__inner_shadow">
            <div class="title">
                <div class="title__main">
                    <h1><?=$article["title"]?></h1>
                </div>
                <div class="title__subtitle">
                    <?=$article["description"]?>
                </div>
            </div>

            <section class="ingredients">
                <div class="ingredients__title">
                    <h2>Інгредієнти</h2>
                </div>
                <form class="ingredients-form form" name="ingredients" action="../add_ingredients" method="post">
                    <div class="ingredients-form__list">
                
                        <?php foreach ($ingredients as $ingredient) 
                        {
                        ?>
                            <div class="ingredients-form__item">
                                <label>
                                    <input type="checkbox" name="ingredients[]" value="<?php echo $ingredient["recipe_ingredient_id"]?>">
                                    <?php echo $ingredient["name"].": ".$ingredient["quantity"]." ".$ingredient["measure"]; ?>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <input class="form__submit-button" type="submit" value="Додати до органайзера">
                </form>
            </section>

            <section class="cooking">
                <div class="cooking__title">
                    <h2>Приготування</h2>
                </div>
                <div class="cooking__steps">
                    <?php for($i = 0; $i < count($article["content"]); $i++)
                    {
                    ?>
                        <div class="cooking-step">
                            <div class="cooking-step__text">
                                <h3 class="cooking-step__title">Крок <?=$i+1?></h3>
                                <div class="cooking-step__info">
                                    <?=$article["content"][$i][1]?>
                                </div>
                            </div>
                            <div class="cooking-step__img-container">
                                <img class="cooking-step__img" src="/../media/recipe_img/<?=$article["recipe_id"]."/".$article["content"][$i][0]?>">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                
            </section>

            <section class="comments">

                <div class="comments__title">
                    <h2>Коментарі</h2>
                </div>

                <form class="form-add-comment form" method="post" action="/recipe/add_comment/<?=$article["recipe_id"] ?>">
                    <h3 class="form-add-comment__title">Додати коментар</h3>
                    <div class="form-add-comment__name-container">
                        <label for="form-add-comment__name">Ім'я:</label>
                        <input type="text" id="form-add-comment__name" name="username"  <?php if (isset($user)) echo "value = \"".$user->first_name." ".$user->last_name."\"" ?> required>
                    </div>
                    <div class="form-add-comment__comment-container">
                        <label for="form-add-comment__comment">Коментар:</label>
                        <textarea type="text" id="form-add-comment__comment" name="comment" required></textarea>
                    </div>
                    <button class="form__submit-button" type="submit">Опубліковати коментар</button>
                </form>


                <div class="comments__items">
                    <?php foreach($comments as $comment)
                    {
                        ?>
                    <div class="comment">
                        <div class="comment__head">
                            <div class="comment__author"> <?= $comment["username"] ?> </div>
                            <div class="comment__date"><?= $comment["date"] ?> </div>
                        </div>
                        <div class="comment__body">
                            <div class="comment__text">
                            <?= $comment["text"] ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    } ?>
                    
                </div>

            </section> 

        </div>
        
    </div>
</section>