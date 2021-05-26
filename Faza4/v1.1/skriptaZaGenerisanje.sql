CREATE DATABASE `medadvicentreatment` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `medadvicentreatment`; 
CREATE TABLE Korisnik
(
	IdK                  INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	Ime                  VARCHAR(50) NOT NULL,
	Prezime              VARCHAR(50) NOT NULL,
	KorisnickoIme        VARCHAR(50) NOT NULL,
	Lozinka              VARCHAR(50) NOT NULL,
	E_posta              VARCHAR(50) NOT NULL,
	DatumRodjenja        DATE NOT NULL,
	MestoRodjenja        VARCHAR(50) NOT NULL,
	MestoPrebivalista    VARCHAR(50) NOT NULL,
	AdresaPrebivalista   VARCHAR(50) NOT NULL,
	JMBG                 CHAR(13) NOT NULL,
	Pol                  CHAR(1) NOT NULL CHECK ( Pol IN ('M', 'Z') ),
	NaCekanju            SMALLINT NOT NULL DEFAULT 1,
	JeObrisan            SMALLINT NOT NULL DEFAULT 0,
	KrvnaGrupa           VARCHAR(3) NULL,
	IstorijaBolesti      VARCHAR(200) NULL,
	HronicneBolesti      VARCHAR(200) NULL,
	ZarazneBolesti       VARCHAR(200) NULL,
	LekoviAlergije       VARCHAR(200) NULL,
	HirurskiZahvati      VARCHAR(200) NULL,
	Rezime               VARCHAR(500) NULL,
	Specijalnost         VARCHAR(50) NULL,
	Slika                VARCHAR(500) NULL,
	ZbirOcena            INTEGER NULL DEFAULT 0,
	BrojOcena            INTEGER NULL DEFAULT 0,
	Uloga                CHAR(1) NOT NULL CHECK ( Uloga IN ('P', 'L', 'M') )
);

CREATE UNIQUE INDEX XAK1Korisnik ON Korisnik
(
	KorisnickoIme ASC
);

CREATE UNIQUE INDEX XAK3Korisnik ON Korisnik
(
	E_posta ASC
);

CREATE UNIQUE INDEX XAK4Korisnik ON Korisnik
(
	JMBG ASC
);

CREATE TABLE Lecio
(
    IdLec                INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	IdPac                INTEGER NOT NULL,
	IdLek                INTEGER NOT NULL,
	PreostaloOcena       INTEGER NOT NULL DEFAULT 1
);

CREATE UNIQUE INDEX XAK1Lecio ON Lecio
(
	IdPac ASC,
	IdLek ASC
);

CREATE TABLE Pruza
(
    IdPru                INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	IdU                  INTEGER NOT NULL,
	IdLek                INTEGER NOT NULL,
	Cena                 INTEGER NOT NULL DEFAULT 3000
);

CREATE UNIQUE INDEX XAK1Pruza ON Pruza
(
	IdU ASC,
	IdLek ASC
);

CREATE TABLE Termin
(
	IdT                  INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	IdPac                INTEGER NOT NULL,
	IdPru                INTEGER NOT NULL,
	DatumIVreme          TIMESTAMP NOT NULL,
	Ostvaren             SMALLINT NOT NULL DEFAULT 0,
	TekstNalaza          VARCHAR(500) NULL,
	Snimak               VARCHAR(500) NULL
);

CREATE TABLE Usluga
(
	IdU                  INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	Naziv                VARCHAR(50) NOT NULL
);

ALTER TABLE Lecio
ADD CONSTRAINT R_14 FOREIGN KEY (IdLek) REFERENCES Korisnik (IdK);

ALTER TABLE Lecio
ADD CONSTRAINT R_15 FOREIGN KEY (IdPac) REFERENCES Korisnik (IdK);

ALTER TABLE Pruza
ADD CONSTRAINT R_4 FOREIGN KEY (IdU) REFERENCES Usluga (IdU);

ALTER TABLE Pruza
ADD CONSTRAINT R_16 FOREIGN KEY (IdLek) REFERENCES Korisnik (IdK);

ALTER TABLE Termin
ADD CONSTRAINT R_7 FOREIGN KEY (IdPru) REFERENCES Pruza (IdPru);

ALTER TABLE Termin
ADD CONSTRAINT R_17 FOREIGN KEY (IdPac) REFERENCES Korisnik (IdK);
