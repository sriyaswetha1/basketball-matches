set foreign_key_checks = 0;

-- ============================================================
--   Nom de la base   :  Fédération Basket
-- ============================================================
drop table if exists CLUB cascade;
drop table if exists RESPONSABLE cascade;
drop table if exists JOUEUR cascade;
drop table if exists EQUIPE cascade;
drop table if exists ENTRAINEUR cascade;
drop table if exists RENCONTRE cascade;
drop table if exists ANIMATION cascade;
drop table if exists ENTREE cascade;
drop table if exists PARTICIPATION cascade;
drop table if exists ENTRAINE cascade;

-- ============================================================
--   Table : CLUB
-- ============================================================
create table CLUB
(
    NUMERO_CLUB     INT(11)     not null auto_increment,
    NOM_CLUB        CHAR(20),
    LOCALISATION    CHAR(20),
    constraint pk_club primary key (NUMERO_CLUB)
);

-- ============================================================
--   Table : RESPONSABLE
-- ============================================================
create table RESPONSABLE
(
    NUMERO_RESPONSABLE  INT(11)     not null auto_increment,
    NUMERO_CLUB         INT(11)     not null,
    PRENOM_RESPONSABLE  CHAR(20),
    NOM_RESPONSABLE 	CHAR(20),
    FONCTION            CHAR(20),
    constraint pk_club primary key (NUMERO_RESPONSABLE),
    constraint fk1_responsable foreign key (NUMERO_CLUB)
        references CLUB (NUMERO_CLUB)
);

-- ============================================================
--   Table : ENTRAINEUR
-- ============================================================
create table ENTRAINEUR
(
    NUMERO_ENTRAINEUR   INT(11)     not null auto_increment,
    NOM_ENTRAINEUR      CHAR(20),
    PRENOM_ENTRAINEUR   CHAR(20),
    constraint pk_entraineur primary key (NUMERO_ENTRAINEUR)
);

-- ============================================================
--   Table : EQUIPE
-- ============================================================
create table EQUIPE
(
    NUMERO_EQUIPE       INT(11) not null auto_increment,
    NOM_CATEGORIE    CHAR(20) not null,
    constraint pk_equipe primary key (NUMERO_EQUIPE)
 
);

-- ============================================================
--   Table : RENCONTRE
-- ============================================================
create table RENCONTRE
(
    NUMERO_RENCONTRE                INT(11) not null auto_increment,
    NUMERO_JOURNEE 		    INT(11) not null,
    DATE_RENCONTRE                  DATE,
    SCORE_EQUIPE_DOMICILE          INT(11),
    SCORE_EQUIPE_EXTERIEUR           INT(11),
    NUMERO_EQUIPE_JOUE_DOMICILE     INT(11) not null,
    NUMERO_EQUIPE_JOUE_EXTERIEUR    INT(11) not null,
    constraint pk_rencontre primary key (NUMERO_RENCONTRE),
    constraint fk1_rencontre foreign key (NUMERO_EQUIPE_JOUE_DOMICILE)
        references EQUIPE (NUMERO_EQUIPE),
    constraint fk2_rencontre foreign key (NUMERO_EQUIPE_JOUE_EXTERIEUR)
        references EQUIPE (NUMERO_EQUIPE)
);

-- ============================================================
--   Table : JOUEUR
-- ============================================================
create table JOUEUR
(
    NUMERO_LICENCE          INT(11)     not null auto_increment,
    ADRESSE_JOUEUR          CHAR(30),
    PRENOM_JOUEUR              CHAR(30),
    NOM_JOUEUR           CHAR(30),
    DATE_NAISSANCE_JOUEUR   DATE,
    NUMERO_EQUIPE           INT(11),
    constraint pk_joueur primary key (NUMERO_LICENCE),
    constraint fk1_joueur foreign key (NUMERO_EQUIPE)
        references EQUIPE (NUMERO_EQUIPE)
);

-- ============================================================
--   Table : ANIMATION
-- ============================================================
create table ANIMATION
(
    NUMERO_CLUB             INT(11) not null,
    NUMERO_ENTRAINEUR       INT(11) not null,
    DATE_ENTREE_ENTRAINEUR  DATE,
    constraint pk_animation primary key (NUMERO_ENTRAINEUR, NUMERO_CLUB)
);

-- ============================================================
--   Table : ENTREE
-- ============================================================
create table ENTREE
(
    NUMERO_CLUB         INT(11) not null,
    NUMERO_LICENCE      INT(11) not null,
    DATE_ENTREE_JOUEUR  DATE    not null,
    constraint pk_entree primary key (NUMERO_LICENCE, NUMERO_CLUB)
);

-- ============================================================
--   Table : PARTICIPATION
-- ============================================================
create table PARTICIPATION
(
    NUMERO_LICENCE      INT(11)     not null,
    NUMERO_RENCONTRE    INT(11)     not null,
    FAUTES              INT(11),
    POINTS              INT(11),
    constraint pk_participation primary key (NUMERO_LICENCE, NUMERO_RENCONTRE)
);

-- ============================================================
--   Table : ENTRAINE
-- ============================================================
create table ENTRAINE
(
    NUMERO_ENTRAINEUR      INT(11)     not null,
    NUMERO_EQUIPE          INT(11)     not null,
    constraint pk_entraine primary key (NUMERO_ENTRAINEUR, NUMERO_EQUIPE)
);
