DROP DATABASE IF EXISTS pokedex;
CREATE DATABASE pokedex;

USE pokedex;

CREATE TABLE pokemon(
    id int auto_increment PRIMARY KEY ,
    name varchar(255),
    caught bool,
    type varchar(255)
);

INSERT INTO pokemon (name, caught, type) VALUES
                                             ('a',0,'water'),
                                             ('b',0,'fire'),
                                             ('c',0,'wind');

