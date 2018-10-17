ALTER TABLE "authors"
ADD COLUMN "sex" varchar(255),
ADD COLUMN "color" jsonb NOT NULL;

ALTER TABLE `authors`
ADD COLUMN `sex`  varchar(255) NULL AFTER `name`,
ADD COLUMN `color`  json NOT NULL AFTER `sex`;
