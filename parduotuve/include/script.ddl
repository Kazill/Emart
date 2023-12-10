#@(#) script.ddl


DROP TABLE IF EXISTS vertinimai;
DROP TABLE IF EXISTS uzsakymo_prekes;

DROP TABLE IF EXISTS komentarai;
DROP TABLE IF EXISTS prekes;
DROP TABLE IF EXISTS pranesimai;
DROP TABLE IF EXISTS apeliacijos;
DROP TABLE IF EXISTS pardavejai;
DROP TABLE IF EXISTS adresai;
DROP TABLE IF EXISTS uzsakymai;
DROP TABLE IF EXISTS administratoriai;

DROP TABLE IF EXISTS pirkejai;
DROP TABLE IF EXISTS naudotojai;

CREATE TABLE naudotojai
(
	Vardas varchar (255) NOT NULL,
	Pavarde varchar (255) NOT NULL,
	El_pastas varchar (255) NOT NULL,
	Slaptazodis varchar (255) NOT NULL,
	Ar_blokuotas boolean NOT NULL,
	Naudotojo_lygis int NOT NULL,
	id_Naudotojas int NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(id_Naudotojas)
);

CREATE TABLE administratoriai
(
	idarbinimo_data date NOT NULL,
	Tel_nr varchar (255) NOT NULL,
	Alga double precision NOT NULL,
	id_Administratorius int NOT NULL AUTO_INCREMENT,
	fk_Naudotojasid_Naudotojas int NOT NULL,
	PRIMARY KEY(id_Administratorius),
	UNIQUE(fk_Naudotojasid_Naudotojas),
	CONSTRAINT Gali_buti FOREIGN KEY(fk_Naudotojasid_Naudotojas) REFERENCES naudotojai (id_Naudotojas)
);

CREATE TABLE adresai
(
	Miestas varchar (255) NOT NULL,
	Salis varchar (255) NOT NULL,
	Pasto_kodas varchar (255) NOT NULL,
	Gatve varchar (255) NOT NULL,
	Namo_nr int NOT NULL,
	id_Adresas int NOT NULL AUTO_INCREMENT,
	fk_Naudotojasid_Naudotojas int NOT NULL,
	PRIMARY KEY(id_Adresas),
	CONSTRAINT Priklauso FOREIGN KEY(fk_Naudotojasid_Naudotojas) REFERENCES naudotojai (id_Naudotojas)
);

CREATE TABLE pardavejai
(
	Ar_patvirtintas boolean NOT NULL,
	patvirtinimo_data date NULL,
	Ikeltu_prekiu_skaicius int NOT NULL,
	vertinimu_vidurkis double precision NULL,
	id_Pardavejas int NOT NULL AUTO_INCREMENT,
	fk_Naudotojasid_Naudotojas int NOT NULL,
	PRIMARY KEY(id_Pardavejas),
	UNIQUE(fk_Naudotojasid_Naudotojas),
	CONSTRAINT Gali_buti2 FOREIGN KEY(fk_Naudotojasid_Naudotojas) REFERENCES naudotojai (id_Naudotojas)
);

CREATE TABLE apeliacijos
(
	tekstas varchar (255) NOT NULL,
	priezastis varchar (255) NOT NULL,
	data date NOT NULL,
	id_Apeliacija int NOT NULL AUTO_INCREMENT,
	fk_Pardavejasid_Pardavejas int NOT NULL,
	PRIMARY KEY(id_Apeliacija),
	CONSTRAINT Daro FOREIGN KEY(fk_Pardavejasid_Pardavejas) REFERENCES pardavejai (id_Pardavejas)
);

CREATE TABLE pranesimai
(
	data date NOT NULL,
	gavejas varchar (255) NOT NULL,
	priezastis varchar (255) NOT NULL,
	tekstas varchar (255) NOT NULL,
	id_Pranesimas int NOT NULL AUTO_INCREMENT,
	fk_Administratoriusid_Administratorius int NOT NULL,
	PRIMARY KEY(id_Pranesimas),
	CONSTRAINT Raso FOREIGN KEY(fk_Administratoriusid_Administratorius) REFERENCES administratoriai (id_Administratorius)
);

CREATE TABLE prekes
(
	pavadinimas varchar (255) NOT NULL,
	kaina double precision NOT NULL,
	kategorija varchar (255) NOT NULL,
	gamintojas varchar (255) NULL,
	ar_paslepta boolean NOT NULL,
	id_Preke int NOT NULL AUTO_INCREMENT,
	fk_Pardavėjasid_Pardavėjas int NOT NULL,
	PRIMARY KEY(id_Preke),
	CONSTRAINT Parduoda FOREIGN KEY(fk_Pardavėjasid_Pardavėjas) REFERENCES pardavejai (id_Pardavejas)
);

CREATE TABLE pirkejai
(
	vertinimu_vidurkis double NULL,
	uzsakymu_skaicius int NOT NULL,
	komentaru_skaicius int NOT NULL,
	id_Pirkejas int NOT NULL AUTO_INCREMENT,
	fk_Naudotojasid_Naudotojas int NOT NULL,
	PRIMARY KEY(id_Pirkejas),
	UNIQUE(fk_Naudotojasid_Naudotojas),
	CONSTRAINT Gali_buti3 FOREIGN KEY(fk_Naudotojasid_Naudotojas) REFERENCES naudotojai (id_Naudotojas)
);

CREATE TABLE komentarai
(
	tekstas varchar (255) NOT NULL,
	data date NOT NULL,
	laikas varchar (255) NOT NULL,
	id_Komentaras int NOT NULL AUTO_INCREMENT,
	fk_Prekeid_Preke int NOT NULL,
	fk_Pirkejasid_Pirkejas int NOT NULL,
	PRIMARY KEY(id_Komentaras),
	CONSTRAINT Gavo FOREIGN KEY(fk_Prekeid_Preke) REFERENCES prekes (id_Preke),
	CONSTRAINT Paraso FOREIGN KEY(fk_Pirkejasid_Pirkejas) REFERENCES pirkejai (id_Pirkejas)
);

CREATE TABLE uzsakymai
(
	data date NOT NULL,
	uzsakymo_kaina double precision NOT NULL,
	būsena varchar (255) NOT NULL,
	pristatymo_budas varchar (255) NOT NULL,
	id_Uzsakymas int NOT NULL AUTO_INCREMENT,
	fk_Pirkejasid_Pirkejas int NOT NULL,
	fk_Administratoriusid_Administratorius int NOT NULL,
	PRIMARY KEY(id_Uzsakymas),
	CONSTRAINT Gauna FOREIGN KEY(fk_Pirkejasid_Pirkejas) REFERENCES pirkejai (id_Pirkejas),
	CONSTRAINT Tvarko FOREIGN KEY(fk_Administratoriusid_Administratorius) REFERENCES administratoriai (id_Administratorius)
);


CREATE TABLE uzsakymo_prekes
(
	kiekis int NOT NULL,
	id_Uzsakymo_prekė int NOT NULL AUTO_INCREMENT,
	fk_Uzsakymasid_Uzsakymas int NOT NULL,
	fk_Prekeid_Preke int NOT NULL,
	PRIMARY KEY(id_Uzsakymo_prekė),
	CONSTRAINT Yra2 FOREIGN KEY(fk_Uzsakymasid_Uzsakymas) REFERENCES uzsakymai (id_Uzsakymas),
	CONSTRAINT Yra FOREIGN KEY(fk_Prekeid_Preke) REFERENCES prekes (id_Preke)
);

CREATE TABLE vertinimai
(
	Ivertis int NOT NULL,
	data date NOT NULL,
	id_Vertinimas int NOT NULL AUTO_INCREMENT,
	fk_Pirkejasid_Pirkejas int NOT NULL,
	fk_Prekeid_Preke int NOT NULL,
	PRIMARY KEY(id_Vertinimas),
	CONSTRAINT Duoda FOREIGN KEY(fk_Pirkejasid_Pirkejas) REFERENCES pirkejai (id_Pirkejas),
	CONSTRAINT Turi FOREIGN KEY(fk_Prekeid_Preke) REFERENCES prekes (id_Preke)
);

