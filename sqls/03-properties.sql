ALTER TABLE "authors"
ADD COLUMN "sex" varchar(255),
ADD COLUMN "data" jsonb NOT NULL;

ALTER TABLE `authors`
ADD COLUMN `sex`  varchar(255) NULL AFTER `name`,
ADD COLUMN `data`  json NOT NULL AFTER `sex`;
