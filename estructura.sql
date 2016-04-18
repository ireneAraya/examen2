CREATE TABLE videogames(
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  developer VARCHAR(255),
  description VARCHAR(255),
  console VARCHAR(255),
  date VARCHAR(255),
  rating VARCHAR(255),
  url VARCHAR(255),
  PRIMARY KEY (id),
  UNIQUE KEY `id_UNIQUE` (`id`)
);
