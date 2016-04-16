# use contactdb;

# Creamos nuestra tabla de usuarios
CREATE TABLE contactos(
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(45) NOT NULL,
  developer VARCHAR(45) NOT NULL,
  description VARCHAR(200) NOT NULL,
  console VARCHAR(45) NOT NULL,
  date VARCHAR(10) NOT NULL,
  rating FLOAT(5),
  url VARCHAR(70),

  PRIMARY KEY (id)
);