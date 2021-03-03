drop table paniers;
drop table factures;
drop table utilisateurs;



create table utilisateurs (
email varchar(50) primary key, 
pseudo varchar(20), 
motdepasse varchar(255)
);

create table jeux (
id_jeu varchar(20) primary key,
nom varchar(50),
developpeur varchar(30),
editeur varchar(30), 
rating varchar(20), 
prix double,
rabais double,
date_de_sortie date, 
imagelien varchar(255)
);

create table utilisateurs_jeux (
email varchar(50),
id_jeu varchar(20),
note double,
avis varchar(255),
foreign key(email) references utilisateurs(email),
foreign key(id_jeu) references jeux(id_jeu),
primary key(email, id_jeu)
);

create table categories (
nom_cat varchar(20) primary key
);

create table jeux_categories (
id_jeu varchar(20),
categorie varchar(20),
foreign key(id_jeu) references jeux(id_jeu),
foreign key(categorie) references categories(nom_cat),
primary key(id_jeu, categorie)
);

create table factures (
id_facture varchar(20) primary key,
email_client varchar(50),
foreign key(email_client) references utilisateurs(email)
);

create table factures_jeux (
id_facture varchar(20),
id_jeu varchar(20),
foreign key(id_facture) references factures(id_facture),
foreign key(id_jeu) references jeux(id_jeu),
primary key(id_facture, id_jeu)
);

create table paniers (
id_panier varchar(20) primary key,
email_client varchar(20), 
foreign key(email_client) references utilisateurs(email)
);

create table paniers_jeux (
id_panier varchar(20),
id_jeu varchar(20),
foreign key(id_panier) references paniers(id_panier),
foreign key(id_jeu) references jeux(id_jeu),
primary key(id_panier, id_jeu)
);

