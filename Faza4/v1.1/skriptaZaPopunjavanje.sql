USE `medadvicentreatment`; 
/*ubacivanje menadzera*/
INSERT INTO Korisnik(Ime,Prezime,KorisnickoIme,Lozinka,E_posta,DatumRodjenja,MestoRodjenja,MestoPrebivalista,AdresaPrebivalista,
JMBG,Pol,NaCekanju,JeObrisan,
KrvnaGrupa,
IstorijaBolesti,
HronicneBolesti,
ZarazneBolesti,
LekoviAlergije,
HirurskiZahvati,
Rezime,
Slika,
ZbirOcena,BrojOcena,Uloga,
Specijalnost
)
VALUES('Milan','Petrovic','milan123','sifra123','milan89@gmail.com','1989-08-04','Beograd','Beograd','Dunavska 23',
'0408989123321','M',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,NULL,'M',
NULL
),
('Ana','Petrovic','ana123','sifra456','ana489@gmail.com','1989-04-04','Beograd','Beograd','Dunavska 23',
'0404989456654','Z',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,NULL,'M',
NULL
),


/*ubacivanje lekara*/
/*1*/
('Petar','Cvorovic','petarc111','123456','petarc98@gmail.com','1965-08-09','Kragujevac','Beograd','Dubrovacka 56',
'0908965123321','M',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
2005. - Magistar medicinskih nauka, Medicinski fakultet Univerziteta u Beogradu
1998. - Specijalizacija iz interne medicine, Medicinski fakultet Univerziteta u Beogradu
1991. - Doktor medicine, Medicinski fakultet Univerziteta u Beogradu',
'/web/dr1.jpg',
15,3,'L',
'Kardiologija'
),
/*2*/
('Milena','Bojic','milenab','milena33','bojic77@gmail.com','1961-03-02','Kraljevo','Beograd','Brankova 35',
'0203961845358','Z',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
1987. - Medicinski fakutet u Beogradu
1991. - Magisterijum iz kardiologije
1994. - Specijalizacija iz interne medicine
1995. - Doktorat iz kardiologije',
'/web/dr2.jpg',
9,2,'L',
'Kardiologija'
),
/*3*/
('Milan','Kojic','lanmi71','sifra71','milan71@gmail.com','1971-09-25','Smederevo','Beograd','Dusanova 11',
'2509971415312','M',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
2013. - Subspecijalizacija iz kardiologije - Medicinski fakultet Univerziteta u Beogradu
2002. - 2006. - Specijalizacija iz interne medicine - Vojnomedicinska akademija
1992. - 1999. - Medicinski fakultet Univerziteta u Beogradu',
'/web/dr3.jpg',
3,1,'L',
'Kardiologija'
),
/*4*/
('Sanja','Simic','sanja83','simicsanja83','sanja66@gmail.com','1983-06-26','Bijeljina','Beograd','Narodnih heroja 34',
'2606983417017','Z',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
Doktor medicine, specijalista radiologije, akademski specijalista, doktor medicinskih nauka,
naučni saradnik u oblasti medicinskih nauka',
'/web/dr4.jpg',
10,2,'L',
'Radiologija'
),
/*5*/
('Miroslav','Lomic','lomic45','miro444','lomic72@gmail.com','1972-02-21','Sabac','Beograd','Omladinskih Brigada 14',
'2102972417018','M',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
Doktor medicine, specijalista radiologije, akademski specijalista, doktor medicinskih nauka,
naučni saradnik u oblasti medicinskih nauka',
'/web/dr5.jpg',
8,2,'L',
'Radiologija'
),
/*6*/
('Nada','Jovic','nadanada','njovic','jovicnada34@gmail.com','1966-04-03','Beograd','Beograd','Nemanjina 18',
'0304966731099','Z',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
Specijalista Dermatovenerolog',
'/web/dr6.jpg',
4,1,'L',
'Dermatologija'
),
/*7*/
('Marko','Stefanovic','mare48','markic','marko48@gmail.com','1984-02-01','Valjevo','Beograd','Bulevar kralja Aleksandra 44',
'0102984436653','M',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
2010 Medicinski fakultet u Beogradu
Od 2017 Specijalizacija iz Internističke onkologije, Medicinski fakultet u Beogradu, IORS',
'/web/dr7.jpg',
8,2,'L',
'Onkologija'
),
/*8*/
('Vladimir','Milanovic','vladom','910719','vladmil56@gmail.com','1956-07-08','Subotica','Beograd','Bulevar Mihajla Pupina 22',
'0807956910719','M',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
2012. - Doktorska disretacija iz Hematologije
2003. - Subspecijalizacija iz Hematologije
1997. - Magisterijum iz Onkologije
1991. - Specijalizacija iz Interne medicine
1982. - Medicinski fakultet u Beogradu',
'/web/dr8.jpg',
7,2,'L',
'Onkologija'
),
/*9*/
('Darko','Peric','darkop12','peric12','pericd12@gmail.com','1983-01-02','Novi Sad','Beograd','Deligradska 166',
'0201983316187','M',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Medicinski fakultet Univerziteta u Beogradu – specijalista anesteziologije, reanimatologije i intenzivne terapije',
'/web/dr9.jpg',
9,2,'L',
'Anesteziologija'
),
/*10*/
('Nikola','Vukic','vukic323','9876543','nikolav60@gmail.com','1960-04-01','Beograd','Beograd','Vlajkovićeva 15',
'0104960519515','M',0,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Medicinski fakultet Univerziteta u Beogradu – specijalista anesteziologije, reanimatologije i intenzivne terapije',
'/web/dr10.jpg',
5,1,'L',
'Anesteziologija'
),
/*11*/
('Suzana','Krstovic','suzak','22391','suzak223@gmail.com','1991-03-22','Beograd','Beograd','Trg Nikole Pašića 18',
'2203991487787','Z',1,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
Medicinski fakultet Univerziteta u Beogradu
Specijalizacija iz anestezije sa reanimacijom',
'/web/dr11.jpg',
0,0,'L',
'Anesteziologija'
),
/*12*/
('Vukan','Milovanovic','vuk123','milanvuk','vukkk@gmail.com','1963-06-27','Pristina','Beograd','Makenzijeva 61',
'2706963609102','M',0,1,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
'Obrazovanje:
2015. odbranio magistarsku tezu pod naslovom: Komparativna analiza primene spinalne blok anestezije kod totalne artroplastike
1995. Specijalistički ispit iz Anesteziologije sa reanimatologijom  na Vojnomedicinskoj akademiji u Beogradu
1991. Doktor medicine, Medicinski fakultet u Prištini',
'/web/dr12.jpg',
0,0,'L',
'Anesteziologija'
),

/*ubacivanje pacijenata*/

('Milan','Mitrovic','miki92','milan323','milan32@gmail.com','1981-06-05','Beograd','Beograd','Dusanova 55',
'0506981666777','M',0,0,
'A+',
NULL,
'Astma',
NULL,
'Penicilin',
NULL,
NULL,
NULL,
NULL,NULL,'P',
NULL
),
('Milica','Jovanovic','mica82','sifra82','milica82@gmail.com','1982-03-21','Beograd','Beograd','Batutova 18',
'2103982723185','Z',0,0,
'AB-',
NULL,
'Dijabetes',
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,NULL,'P',
NULL
),
('Petar','Lazic','pera98','989898','lazzzic@gmail.com','1998-11-22','Novi Sad','Beograd','Ruže Jovanovića 35a',
'2211998460040','M',0,0,
'0+',
NULL,
'Bronhitis',
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,NULL,'P',
NULL
),
('Milica','Peric','mica94','sifra94','milicap944@gmail.com','1994-04-04','Loznica','Beograd','Carice Milice 18',
'0404994476293','Z',1,0,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL,NULL,'P',
NULL
);

/*ubacivanje u uslugu*/

INSERT INTO Usluga(Naziv)
VALUES
('Kardiologija'),
('Radiologija'),
('Dermatologija'),
('Onkologija'),
('Anesteziologija');

/*ubacivanje u pruza*/

INSERT INTO Pruza(IdU,IdLek,Cena)
VALUES
(1,3,6000),
(1,4,4500),
(1,5,2500),
(2,6,7000),
(2,7,5500),
(3,8,3800),
(4,9,4500),
(4,10,4500),
(5,11,5000),
(5,12,4700);

/*ubacivanje u termin*/

INSERT INTO TERMIN(DatumIVreme,Ostvaren,IdPru,IdPac,
TekstNalaza,
Snimak)
VALUES
/*ostvareni ocenjeni nalazi  x18*/  
/*dr1*/
('2021-04-01 13:00:00',1,1,15,
'Pellentesque nec suscipit ante. Maecenas eu iaculis urna.
Quisque convallis lectus facilisis purus bibendum, ac sollicitudin urna suscipit.',
'/web/ekg.jpg'),
('2021-04-02 13:00:00',1,1,15,
'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
NULL),
('2021-04-02 17:00:00',1,1,17,
'Proin vestibulum urna nulla. Donec eget finibus massa, a sagittis augue.',
NULL),

/*dr2*/
('2021-04-03 13:00:00',1,2,16,
'Donec neque enim, porttitor eget vestibulum sed, placerat faucibus lectus.',
NULL),
('2021-04-04 17:00:00',1,2,16,
'Nulla fermentum, dui id pretium gravida, nibh risus condimentum nibh, semper porta metus arcu a leo.
Nunc varius sagittis velit tincidunt viverra.',
NULL),

/*dr3*/
('2021-04-05 13:00:00',1,3,17,
'Proin ullamcorper nulla quis erat luctus, at posuere erat facilisis.',
'/web/kicma.jpg'),

/*dr4*/
('2021-04-06 13:00:00',1,4,15,
'Ut id mi nec urna vestibulum euismod eget ut dolor.',
NULL),
('2021-04-07 18:00:00',1,4,16,
'Donec mi metus, volutpat non varius sit amet, sollicitudin at nunc.',
NULL),

/*dr5*/
('2021-04-08 13:00:00',1,5,16,
'Ut tellus felis, rhoncus ac dui vitae, varius molestie velit. Etiam molestie rhoncus fermentum.',
'/web/mladez.jpg'),
('2021-04-09 15:00:00',1,5,17,
'Praesent eget justo nisl.',
NULL),

/*dr6*/
('2021-04-10 14:00:00',1,6,17,
'Sed dignissim commodo purus et dictum.',
NULL),

/*dr7*/
('2021-04-11 14:00:00',1,7,15,
'Integer non dui neque.',
'/web/pluca.jpg'),
('2021-04-12 16:00:00',1,7,15,
'Vivamus imperdiet, libero sed volutpat semper, lectus ante porta orci, id congue augue mi id odio.',
NULL),

/*dr8*/
('2021-04-13 15:00:00',1,8,16,
'Integer non dui neque.',
NULL),
('2021-04-14 16:00:00',1,8,16,
'Vivamus imperdiet, libero sed volutpat semper, lectus ante porta orci, id congue augue mi id odio.',
NULL),

/*dr9*/
('2021-04-15 12:00:00',1,9,15,
'Phasellus vestibulum aliquam lacus id vulputate.',
NULL),
('2021-04-15 17:00:00',1,9,17,
'Nunc pulvinar tempor molestie. Donec gravida tellus ac ante tempor vulputate.',
NULL),

/*dr10*/
('2021-04-16 17:00:00',1,10,16,
'Nunc pulvinar tempor molestie. Donec gravida tellus ac ante tempor vulputate.',
NULL),

/*ostvareni neocenjeni nalazi x9*/
/*pac1*/
('2021-04-17 12:00:00',1,1,15,
'Donec vel tincidunt erat.',
NULL),
('2021-04-18 13:00:00',1,1,15,
'Nunc congue, metus vel vestibulum finibus, lacus nulla gravida mauris, et maximus orci neque eget ex.',
NULL),
('2021-04-19 14:00:00',1,1,15,
'Duis non diam ac erat molestie faucibus sit amet et diam.',
NULL),
('2021-04-20 14:00:00',1,7,15,
'Integer blandit dui sit amet vestibulum molestie.',
NULL),

/*pac2*/
('2021-04-21 12:00:00',1,2,16,
'Donec vel tincidunt erat.',
NULL),
('2021-04-22 12:00:00',1,2,16,
'Vivamus ut ullamcorper tellus, vel venenatis neque.',
NULL),
('2021-04-23 14:00:00',1,8,16,
'Mauris nec sem sem. Ut sed gravida est.',
NULL),
('2021-04-24 17:00:00',1,8,16,
'Cras eu justo viverra, rutrum neque et, pulvinar eros.',
NULL),

/*pac3*/
('2021-04-25 17:00:00',1,9,17,
'Sed at placerat ipsum. Sed sodales urna nulla, in sollicitudin quam consequat et.
Pellentesque rhoncus ex fermentum justo pulvinar accumsan.',
NULL),
/*neostvareni termini*/
('2021-07-03 13:00:00',0,4,15,
NULL,
NULL),
('2021-07-03 15:00:00',0,4,16,
NULL,
NULL),
('2021-07-03 17:00:00',0,4,17,
NULL,
NULL);

/*ubacivanje u lecio*/
INSERT INTO LECIO(IdPac,IdLek,PreostaloOcena)
VALUES
(15,3,3),
(17,3,0),
(16,4,2),
(17,5,0),
(15,6,0),
(16,6,0),
(16,7,0),
(17,7,0),
(17,8,0),
(15,9,1),
(16,10,2),
(15,11,0),
(17,11,1),
(16,12,0);