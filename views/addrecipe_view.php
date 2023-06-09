<div class="addrecipe">
    <div class="container">
        <div class="addrecipe__inner container__inner_shadow">
            <div class="title">
                <h1>Додавання рецепту</h1>
            </div>
            <form method="post" class="addrecipe-form" action="/addrecipe/add" enctype="multipart/form-data">
                <div class="addrecipe-form__inner">
                    <div class="general-input">
                        <div class="general-input__title">
                            <input required class="general-input__title-input" name="title" type="text" placeholder="Назва рецепту">
                        </div>
                        <div class="general-input__description">
                            <textarea required placeholder="Опис" class="general-input__desctiption-input" name="description" ></textarea>
                        </div>
                    </div>

                    <div class="img-input__file">
                        <label for="img-input_file-input" class="file-input-label">Зображення рецепта</label>
                        <input required name = "img-input_file" id = "img-input_file-input" type="file" class="section-input_file-input" accept=".jpg, .png, .jpeg">
                    </div>

                    <div style="padding: 5px 30px" class="duration-input">
                        <label for="duration-input__input">Час приготування (хв)</label>
                        <input required name = "duration" id = "duration-input__input" type="number">
                    </div>

                    <div style="padding: 5px 30px" class="complexity-input">
                        <label for="complexity-input__input">Складність приготування</label>
                        <input required name = "complexity" id = "complexity-input__input" type="number">
                    </div>

                    <div style="padding: 5px 30px" class="category-input">
                        <p>Категорія</p>
                        <select required name="category">
                            <option value="2">Десерт</option>
                            <option value="3" selected>Риба</option>
                            <option value="4">Піца</option>
                            <option value="5">М'ясо</option>
                        </select>
                    </div>
                    
                    <div class="section-input">
                        <div class="section-input__title">
                            <h2>Розділи<h2>
                        </div>

                        <div class="section-input__section"  id="section1">
                            <div class="section-input__main">
                                <div class="section-input__section-inner">
                                    <div class="section-input__number">
                                        1
                                    </div>
                                    <div class="section-input__text">
                                        <textarea required name = "section-input_text[]" class="section-input__textarea"></textarea>
                                    </div>
                                    <div class="section-input__delete">
                                        <button class="section-input__delete-button"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="section-input__file">
                                <label for="section-input_file-input" class="file-input-label">Зображення розділу</label>
                                <input required name = "section-input_file[]" id = "section-input_file-input" type="file" class="section-input_file-input" accept=".jpg, .png, .jpeg">
                            </div>
                        </div>


                    </div>
                    <div class="add-section">
                        <input id ="add-section__button" type = "button" class="add-section__button form__submit-button" value="Додати нову секцію">
                    </div>
                    <div class="addrecipe-form__submit">
                        <input type="submit" class="addrecipe-form__submit-button form__submit-button" value="Опубліковати рецепт">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<script src= "/scripts/add_sections.js"></script>