drop database if exists gestion_stagiaires;
create database if not exists gestion_stagiaires;
use gestion_stagiaires;
create table filiere(
    idFiliere int(4) auto_increment primary key,
    nomFiliere varchar(50),
    niveau varchar(50)
);
create table stagiaire
(
    idStagiaire int(4) auto_increment primary key,
    nom varchar(50),
    prenom varchar(50),
    civilite varchar(1),
    photo varchar(100),
    idFiliere int(4)
);

create table utilisateur(
    idUser int(4) auto_increment primary key,
    login varchar(50),
    email varchar(255),
    role varchar(50),
    etat int(1),
    pwd varchar(255)
);
-- maniere la plus simple pour indiauer la clé etrageur dans une table
Alter table satagiaire add constraint foreign key(idFiliere) references filiere(idFiliere);
-- insertion de valeur dans les differentes tables de la base de donnees
INSERT INTO filiere(nomFiliere,niveau)VALUES
('GINFOMARTIQUE','MASTER'),
('GELECTRIQUE','TECHNICIEN'),
('GELCTRONIQUE','LICENCE'),
('EOLOGIE','MASTER'),
('MECANIQUE','QUALIFIER'),
('PYSCHOLOGIE','QUALIFIER');

INSERT INTO stagiaire(nom,prenom,civilite,photo,idFiliere) VALUES
    ('Alice','jeanne','F','alice.jpg',1),
    ('Bob','lay','M','bob.jpg',1),
    ('Claire','rachel','F','claire.jpg',2),
    ('David','alphan','M','david.jpg',4),
    ('Eva','elonga','F','eva.jpg',4),
    ('Frank','franck','M','frank.jpg',1),
    ('Grace','grace','M','grace.jpg',2),
    ('Henry','henry','M','henry.jpg',2),
    ('Isabel','isabel','F','isabel.jpg',3),
    ('Jack','jack','M','jack.jpg',5);


INSERT INTO utilisateur(login,email,role,etat,pwd) VALUES
('ADMIN','admi@gamil.com','admin',1,md5('1234')),
('USER1','user1@gamil.com','visiteur',0,md5('1234')),
('USER2','user2@gamil.com','visiteur',1,md5('1234'));
SELECT * FROM filiere;
SELECT * FROM satagiaire;
SELECT * FROM utilisateur;
create table personne
(
    idStagiaire int(4) auto_increment primary key,
    nom varchar(50),
    prenom varchar(50),
    adresse varchar(50),
    sex VARCHAR(10)
);
INSERT INTO personne(nom,prenom,adresse,sex) VALUES
('ADHULE','Jean','BUTEMBO','M'),
('SAD','Calvin','BENI','M'),
('AMEMA','Joseph','GOMA','F'),
('FATUMA','Rachel','WATSA','M'),
('KAHINDO','Sanyu','DURBA','F'),
('KITOKO','neema','ARU','F'),
('SIKULI','Prince','BUNIA','M'),
('AGGEE','Systeme''ARIWARA','M'),
('LETASI','agel','MAHAGI','F'),
('ELEKU','guyline','UGANDA','F'),
('L_REZ','zaki','MUGBERE','F');
