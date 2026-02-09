CREATE DATABASE takalo
    DEFAULT CHARACTER SET = 'utf8mb4';

use takalo;
CREATE TABLE `user`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `mail` TEXT NOT NULL,
    `role` TEXT NOT NULL
);
CREATE TABLE `objet`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `lib` TEXT NOT NULL,
    `descritption` TEXT NOT NULL,
    `id_proprio` INT NOT NULL
);
CREATE TABLE `echange`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_objet` INT NOT NULL,
    `id_actuel` INT NOT NULL,
    `id_new` INT NOT NULL,
    `date_echange` DATE NOT NULL
);
ALTER TABLE
    `echange` ADD CONSTRAINT `echange_id_objet_foreign` FOREIGN KEY(`id_objet`) REFERENCES `objet`(`id`);
ALTER TABLE
    `objet` ADD CONSTRAINT `objet_id_proprio_foreign` FOREIGN KEY(`id_proprio`) REFERENCES `user`(`id`);
ALTER TABLE
    `echange` ADD CONSTRAINT `echange_id_new_foreign` FOREIGN KEY(`id_new`) REFERENCES `user`(`id`);
ALTER TABLE
    `echange` ADD CONSTRAINT `echange_id_actuel_foreign` FOREIGN KEY(`id_actuel`) REFERENCES `user`(`id`);