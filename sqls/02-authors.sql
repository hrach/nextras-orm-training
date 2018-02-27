CREATE TABLE "authors" (
"id" serial4 NOT NULL,
"name" varchar(255) NOT NULL,
PRIMARY KEY ("id")
) WITH (OIDS=FALSE);

CREATE TABLE "books_x_authors" (
"book_id" int4 NOT NULL,
"author_id" int4 NOT NULL,
PRIMARY KEY ("book_id", "author_id"),
CONSTRAINT "fk_books_x_authors_book_id" FOREIGN KEY ("book_id") REFERENCES "books" ("id") ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT "fk_books_x_authors_author_id" FOREIGN KEY ("author_id") REFERENCES "authors" ("id") ON DELETE RESTRICT ON UPDATE CASCADE
) WITH (OIDS=FALSE);




CREATE TABLE `authors` (
`id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(255) NOT NULL ,
PRIMARY KEY (`id`)
);

CREATE TABLE `books_x_authors` (
`book_id`  int UNSIGNED NOT NULL ,
`author_id`  int UNSIGNED NOT NULL ,
PRIMARY KEY (`book_id`, `author_id`),
CONSTRAINT `fk_books_x_authors_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT `fk_books_x_authors_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);
