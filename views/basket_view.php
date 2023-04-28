<section class="basket">
    <div class="container">
        <div class="basket__inner container__inner_shadow">
            <div class="title">
                <div class="title__main">
                    <h1>Інгредієнти</h1>
                </div>
                <div class="title__subtitle">
                    Інгредієнти, що були додані до органайзеру
                </div>
                <div class="basket__ingredients-list">
                    <form class="basket__ingredients-form" name="ingredients" action="basket/remove_ingredients" method="post">
                        <div class="basket__ingredients-list-inner">
                            <?php 
                            if($recipes == null)
                            {
                                echo "<p>Нічого не знайдено</p>";
                                echo "<a class=\"basket__recipes-link\" href=\"/recipes\">Перейти до рецептів</a>";
                            }  
                            else {
                                foreach (array_keys($recipes) as $recipe_title) 
                                {?>
                                    <div class="basket__recipe">
                                    <h2 class="basket__recipe-title"><?php echo $recipe_title?></h2>
                                    <?php
                                    foreach($recipes[$recipe_title] as $ingredient)
                                    {?>
                                        <div class="basket__ingredient">
                                            <label>
                                                <input type="checkbox" name="ingredients[]" value="<?php echo $ingredient["recipe_ingredient_id"]?>">
                                                <?php echo $ingredient["name"].": ".$ingredient["quantity"]." ".$ingredient["measure"]; ?>
                                            </label>
                                        </div>
                                    <?php
                                    }?>
                                    </div>
                                <?php
                                }
                                ?>
                                <input class="form__submit-button" type="submit" value="Видалити з органайзера">
                            <?php }
                            ?>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>