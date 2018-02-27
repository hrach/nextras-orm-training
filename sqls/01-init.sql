CREATE TABLE "books" (
"id" serial2 NOT NULL,
"title" varchar(255) NOT NULL,
"published_on" date NOT NULL,
PRIMARY KEY ("id")
) WITH (OIDS=FALSE);

CREATE TABLE `books` (
`id` int UNSIGNED NOT NULL AUTO_INCREMENT ,
`title` varchar(255) NOT NULL ,
`published_on` date NOT NULL ,
PRIMARY KEY (`id`)
);
