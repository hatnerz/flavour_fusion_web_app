CREATE TABLE `role`
(
	role_id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(20)
)

CREATE TABLE `user`
(
	user_id INT AUTO_INCREMENT PRIMARY KEY,
    login varchar(32),
    password varchar(32),
	role_id INT,
	FOREIGN KEY (role_id) REFERENCES `role`(role_id)
	ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE `category`
(
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80)
);

CREATE TABLE `ingredient`
(
    ingredient_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60),
    measure VARCHAR(10)
);
    
CREATE TABLE `recipe`
(
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    content TEXT,
    complexity TINYINT,
    views INT,
    date DATETIME,
    cooking_time INT,
    picture_path VARCHAR(200),
    category_id INT,
    user_ID INT,
    FOREIGN KEY (category_id) REFERENCES category(category_id)
    ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (user_id) REFERENCES `user`(user_id)
    ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE `recipe_ingredient`
(
    recipe_ingredient_id INT AUTO_INCREMENT PRIMARY KEY,
    ingredient_id INT,
    recipe_id INT,
    quantity SMALLINT,
    FOREIGN KEY (ingredient_id) REFERENCES ingredient(ingredient_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipe(recipe_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `like`
(
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    recipe_id INT,
    date DATETIME,
    FOREIGN KEY (user_ID) REFERENCES user(user_id)
    ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipe(recipe_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `comment`
(
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    recipe_id INT,
    date DATETIME,
    text TEXT,
    FOREIGN KEY (user_ID) REFERENCES user(user_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipe(recipe_id)
    ON DELETE CASCADE ON UPDATE CASCADE
)