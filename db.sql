USE wapidb;

CREATE TABLE characters (
  id int NOT NULL,
  name varchar(255) NOT NULL,
  race varchar(255) NOT NULL,
  gender varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE professions (
  id int NOT NULL,
  profession varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE char_prof (
  char_id int NOT NULL,
  prof_id int NOT NULL,
  PRIMARY KEY (char_id, prof_id)
);

CREATE TABLE countries (
  id int NOT NULL,
  country varchar(255) NOT NULL,
  capital varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE cities (
  id int NOT NULL,
  city varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE country_city (
  country_id int NOT NULL,
  city_id int NOT NULL,
  PRIMARY KEY (country_id, city_id)
);