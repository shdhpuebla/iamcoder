CREATE TABLE users (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL, 
    created INT UNSIGNED NOT NULL,
    updated INT UNSIGNED NOT NULL,
    knows INT UNSIGNED NOT NULL DEFAULT 0,
    recommendations INT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB SET DEFAULT CHARACTER SET=utf8;

CREATE TABLE user_profiles (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    profile ENUM('linkedin', 'deviantart', 'github'),
    profile_data BLOB NOT NULL,
    updated INT UNSIGNED NOT NULL,
) ENGINE=InnoDB SET DEFAULT CHARACTER SET=utf8;

CREATE TABLE user_login (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    token VARCHAR(255) NOT NULL,
    created INT UNSIGNED NOT NULL, 
    updated INT UNSIGNED NOT NULL
) ENGINE=InnoDB SET DEFAULT CHARACTER SET=utf8;

CREATE TABLE user_relationships (
    user_id_from INT UNSIGNED NOT NULL,
    user_id_to INT UNSIGNED NOT NULL,
    relationship ENUM('know', 'recommends'),
    created INT UNSIGNED NOT NULL /* time of creation */
) ENGINE=InnoDB SET DEFAULT CHARACTER SET=utf8;

ALTER TABLE user_relationships ADD `user_tags_fk_user_id_from` FOREIGN KEY(user_id) REFERENCES users(user_id);
ALTER TABLE user_relationships ADD `user_tags_fk_user_id_to` FOREIGN KEY(user_id) REFERENCES users(user_id);

CREATE TABLE tags (
    tag_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    tag VARCHAR(20) NOT NULL,
    url VARCHAR(20) NOT NULL,
    total INT UNSIGNED NOT NULL DEFAULT 0,
    weight DECIMAL(6, 2) DEFAULT 1, /* weight for usage of tags */
) ENGINE=InnoDB SET DEFAULT CHARACTER SET=utf8;

CREATE TABLE user_tags (
    user_id INT UNSIGNED NOT NULL,
    tag_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(user_id, tag_id)
) ENGINE=InnoDB SET DEFAULT CHARACTER SET=utf8;

ALTER TABLE user_tags ADD `user_tags_fk_user_id` FOREIGN KEY(user_id) REFERENCES users(user_id);
ALTER TABLE user_tags ADD `user_tags_fk_tag_id` FOREIGN KEY(tag_id) REFERENCES tags(tag_id);

