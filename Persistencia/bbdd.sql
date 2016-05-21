--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.2
-- Dumped by pg_dump version 9.5.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: bookings; Type: TABLE; Schema: public; Owner: test
--

CREATE TABLE bookings (
    coduser character varying NOT NULL,
    coder character varying(30) NOT NULL,
    startdate character varying(10) NOT NULL,
    start character varying(5),
    finish character varying(5),
    people smallint,
    codparking smallint,
    price numeric(5,2)
);


ALTER TABLE bookings OWNER TO test;

--
-- Name: erxparking; Type: TABLE; Schema: public; Owner: test
--

CREATE TABLE erxparking (
    coder character varying(30),
    codparking smallint
);


ALTER TABLE erxparking OWNER TO test;

--
-- Name: escaperoom; Type: TABLE; Schema: public; Owner: test
--

CREATE TABLE escaperoom (
    coder character varying(30) NOT NULL,
    name character varying(25) NOT NULL,
    address character varying NOT NULL,
    descrip character varying NOT NULL,
    mark character varying(10) NOT NULL,
    price numeric(5,2) NOT NULL,
    duration smallint NOT NULL,
    administrator character varying
);


ALTER TABLE escaperoom OWNER TO test;

--
-- Name: parking; Type: TABLE; Schema: public; Owner: test
--

CREATE TABLE parking (
    codparking smallint NOT NULL,
    name character varying(45) NOT NULL,
    address character varying(50) NOT NULL,
    latitude numeric(5,2) NOT NULL,
    longitude numeric(5,2) NOT NULL,
    price numeric(5,2) NOT NULL,
    places smallint NOT NULL,
    zip_code character varying(5)
);


ALTER TABLE parking OWNER TO test;



--
-- Name: users; Type: TABLE; Schema: public; Owner: test
--

CREATE TABLE users (
    coduser character varying(30) NOT NULL,
    name character varying(15) NOT NULL,
    surname character varying(30) NOT NULL,
    username character varying(15) NOT NULL,
    email character varying(40) NOT NULL,
    admin character varying(1) NOT NULL,
    password character varying(32) NOT NULL,
    zip_code character varying(5) NOT NULL,
    phone_number character varying(9) NOT NULL,
    gender character varying(1)
);


ALTER TABLE users OWNER TO test;

--
-- Data for Name: bookings; Type: TABLE DATA; Schema: public; Owner: test
--

COPY bookings (coduser, coder, startdate, start, finish, people, codparking, price) FROM stdin;
\.


--
-- Data for Name: erxparking; Type: TABLE DATA; Schema: public; Owner: test
--

COPY erxparking (coder, codparking) FROM stdin;
\.


--
-- Data for Name: escaperoom; Type: TABLE DATA; Schema: public; Owner: test
--

COPY escaperoom (coder, name, address, descrip, mark, price, duration, administrator) FROM stdin;
ismael.barcelocked  barcelocked C/Arc de Sant Silvestre 3   Proporcionamos una experiencia de juego de misterio que supera las expectativas y lo mejoramos continuamente con el fin de ser destacados como una de las mejores salas de escape en Europa.\r\nNuestro emocionante juego de escape en vida real esta lleno de enigmas de alta tecnología y rompecabezas con un nivel alto. ¿Puedes resolver el misterio y salir a tiempo?\r\n  8   75.00   60  ismael
ismael.chickenbanana    chiken banana   C/Rocafort 12-20    Juego de aventura física y en vivo con 5 salas en las que los equipos (3-18 personas) están encerrados en una habitación y deben usar elementos de la sala para resolver una serie de rompecabezas, encontrar pistas y escapar de ella en 60 minutos. ¿Podrás hacerlo?  8   70.00   60  ismael
jordi.confined  confined    C/Ramon Batlle 6    Somos una nueva Escape Room de Barcelona! Nos encontrarás en Sant Andreu de Palomar.\r\nResuelve los enigmas para avanzar por las salas hasta conseguir salir, tienes 60 minutos.\r\n¿Te atreves?   7   45.00   60  jordi
jordi.cronologic    cronologic  Av.Meridiana 129    ¡Prepárate para ser cronoviajero! Escoge a tu equipo, busca pistas, resuelve enigmas, encuentra objetos escondidos y regresa antes de 60 minutos. Serás el protagonista de esta aventura donde no todos vuelven al presente, ¿y tú?\r\n 7   48.00   60  jordi
jordi.enigma    enigma  C/Acàcies 38    Room escape juego: Entrar será muy fácil, os abrirán una puerta y accederéis a una habitación donde encontrareis diferentes objetos, todos con un sentido, no hay nada puesto por casualidad. Los elementos que no forman parte de los acertijos del juego estarán señalados para que no perdáis un precioso tiempo y os dediquéis a encajar todas las piezas. Salir no será tan fácil! Organizar vuestro equipo y enfretaos al enigma  5   50.00   60  jordi
jordi.enigmik   enigmik C/Rosselló 508  Enigmik es un Room Escape en Barcelona. Está pensado para grupos de 2 a 6 personas. Tendréis 60 minutos para resolver todos los enigmas que se esconden dentro de una sala. El objetivo es simple: ¡No quedarse atrapado!   5   68.00   60  jordi
jordi.escapasipuedes    escapa si puedes    C/Grassot 97    Adéntrate en esta aventura en vivo y resuelve el misterioso caso del profesor Viruel.\r\nEntrar será fácil, lo difícil será salir. \r\nPon a prueba tu ingenio y habilidad para resolver los enigmas y retos que se te presenten y escapa si puedes.\r\nDispondrás de 60 minutos para salir. No todo el mundo lo consigue. ¿Podrás hacerlo tú?  5   45.00   60  jordi
jordi.escapebarcelona   escape barcelona    Pg.Valldaura 158    Sumérgete en una increible aventura en el nuevo juego de escape en Barcelona donde la aventura la vives tú junto a tus amigos.  6   58.00   60  jordi
jordi.escapehunt    escape hunt C/Nàpols 255bis The Escape Hunt Experience es el líder mundial en esta industria de rápido crecimiento como es el entretenimiento temático, ofreciendo juegos “room escape” o “escape the room” para el público en general y para clientes de empresa de todo el mundo. Con sucursales desde Sydney a París, de Tokio a Londres, y por supuesto en Barcelona, todos los juegos que ofrecemos son una aventura única y una gran experiencia para vuestro grupo. Además, contamos con una excelente hospitalidad y un excelente servicio en todas nuestras sucursales.\r\n    9   88.00   60  jordi
jordi.espaniq   espaniq C/Llibertat 21  Detrás de nuestras puertas cerradas, te están esperando muchos misterios para ser resueltos. La salida está oculta por secretos y cuando intentas encontrarla, los secretos se revelan uno detrás del otro hasta que encuentras el secreto de los secretos: la llave de la salida.  6   49.00   60  jordi
jordi.habitacion73  habitación 73   C/Torrent de les Flors 96   ¿Quieres una aventura que nunca olvidarás? Un juego diferente, ingenioso, intuitivo, divertido.\r\n¿Quieres resolver puzzles, superar retos, descubrir un oscuro misterio o tal vez salir airoso de una difícil situación?\r\nVen con la mente clara. Tómate tu tiempo y no te agotes. A veces trabajar en equipo es la única solución.\r\nHabitación73, un juego de enigma que disfrutarás como un niño. Cada prueba solucionada os introducirá más en el juego. Un nuevo tipo de ocio para grupos de 2 a 5 jugadores, 6 opcional.\r\n 5   40.00   60  jordi
jordi.parapark1 parapark 1  C/Rei Martí 33  ¿SERÀS CAPAÇ DE SORTIR?\r\nUn antic edifici a l`històric barri de Sants enclou un misteri... Una porta s`obrirà per acollir-vos i es tancarà rera vosaltres. Un cop dins, només comptareu amb el vostre enginy per aconseguir sortir-ne abans que transcorrin seixanta minuts; la força física no us servirà de res aquí. En aquest lloc abandonat jau un enigma que haureu de desxifrar. Sí, aquest lloc atrapa, però no només metafòricament..    7   47.00   60  jordi
jordi.parapark2 parapark 2  C/Valladolid 25 Un antic edifici a l històric barri de Sants enclou un misteri... Una porta sobrirà per acollir-vos i es tancarà rera vosaltres. Un cop dins, només comptareu amb el vostre enginy per aconseguir sortir-ne abans que transcorrin seixanta minuts; la força física no us servirà de res aquí. En aquest lloc abandonat jau un enigma que haureu de desxifrar. Sí, aquest lloc atrapa, però no només metafòricament...   8   47.00   60  jordi
jordi.picaderomotel picadero motel  Pg.Nogués 8 En este motel las puertas se cierran y tienes que escapar. Pronto conocereís al Picador, el dueño de este Juego de Escape en vivo que os tiene encerrados y por qué para él no es sólo un juego. ¿Difícil? ¡Sí! Pero no imposible. (Advertencia: hay 60 minutos y puede ser que no se logre escapar).   8   58.00   90  jordi
jordi.proyectotarget    proyecto target C/Santa Dorotea 6   una vez dentro quedaras encerrado durante un maximo de 60 minutos- Nuestro objetivo pricnipal es conseguir que te olvides de la monotonia del dia a dia, que sientas que todo lo que te rodea es real y que esta pasando ahora. 6   64.00   60  jordi
jordi.tacticgame    tactic game C/Castillejos 287   Nuestro juego se presenta en forma de habitaciones. Tan pronto como escapas de una habitación, te lleva a otra y así sucesivamente, hasta que el juego termine. Salir de la habitación no es tan fácil como puede parecer. Para salir de ellas, tendrás que estudiar cada esquina, buscar en los cajones, mesas e incluso rebuscar en los objetos, prendas y todo lo que pertenezca a los antiguos habitantes de la casa, hasta no resolver sus secretos! Y tenga cuidado, a lo mejor la casa aun esta viva. Quién sabe, ¿qué mal se esconde en ella?   5   60.00   60  jordi
jordi.questory  questory    C/Galileu 158   Si buscas experiencias nuevas, te gustan los retos o quieres sorprender a tus amigos o familiares con una actividad original y emocionante, quieres ponerse a prueba a ti mismo en unas circunstancias y ambientes distintos de la realidad habitual, reserva el juego en QUESTORY!\r\nTenéis la oportunidad de aparecer dentro de una cárcel verdadero o realizar el robo más importante en vuestra vida! Descubrirás una nueva y divertida actividad de ocio. 8   60.00   60  jordi
jordi.retobox   retobox C/Fernando Pessoa 17    Se trata de una aventura en vivo en un escenario totalmente personalizado y adecuado a la temática de la actividad durante la cual vuestro ingenio será puesto a prueba, no es necesario ser un genio pero sí observador, metódico y colaborador, ya que el trabajo en equipo es el que mejor resultado da.\r\nEl tiempo corre y el reloj implacable no conoce amigos. Dispondréis de un tiempo limitado para encajar todas las piezas y superar el escape room. Retobox plantea una plena interacción con el entorno y no un reto intelectual de puzzles.  4   60.00   60  jordi
jordi.roomIn    roomin  C/Robí 2-6  Carlo Gambino es sospechoso de estar al mando de una peligrosa banda mafiosa de Barcelona. \r\n\r\nDetenido en comisaría, nuestros agentes lo están interrogando, pero nos faltan evidencias suficientes para encerrarlo. \r\n\r\nEstán a punto de cumplirse las 72 horas de retención y estamos obligados a soltar a Carlo Gambino por falta de pruebas. \r\n\r\nUn soplo nos ha conducido hasta la Guarida, donde se reúne con sus secuaces, situada en la Vila de Gràcia de Barcelona.\r\n\r\nDisponemos de 60 minutos para infiltrarte en su Guarida y conseguir las pruebas suficientes para ponerlo entre rejas. \r\n\r\nBuscamos a los mejores agentes para resolver esta misión.    5   50.00   60  jordi
jordi.simulacrevuit simulacre vuit  C/Varsòvia 15   l primer Room Escape con dos equipos, interaccionando y compitiendo a tiempo real, de hasta 6 personas cada uno, dos objetivos y dos ambientaciones que te transportaran muy lejos. ¿Serás Capaz?   5   50.00   60  jordi
jordi.thehouseofwhispers    the house of whispers   C/Nàpols 307    Ruidos extraños, murmullos, susurros y toda una serie de inquietantes y aterradores fenómenos inexplicables.\r\n\r\n“The House of Whispers” es un concepto pensado y hecho para los que somos seguidores, fans o simplemente curiosos del terror clásico, de lo paranormal y lo extraño.\r\n\r\nSeguro que alguna vez has escuchado sobre alguna experiencia paranormal, esta vez queremos que tu seas el protagonista. Inspirándonos en hechos reales y basándonos en el concepto  de aventura gráfica y survival horror.\r\n\r\nEn grupos de entre 2 y 5 personas os sumergiereis en una terrorífica casa abandonada durante 60 minutos, para buscar pistas y tratar de encontrar los detalles mas recónditos de la historia de Myra Savage. Desde sus amoríos, pecados y gustos hasta su trágico final.  4   60.00   60  jordi
jordi.tictacroom    tic tac room    C/Sant Frederic 8   Un nuevo juego de escape en vivo situado en el corazón del barrio de Sants de Barcelona. Si no conoces este tipo de juegos te sorprenderás, y si ya lo conoces... te volveremos a sorprender!\r\n\r\nForma tu equipo de entre 2 a 6 personas y adentraros en un laboratorio secreto donde resolver enigmas, acertijos y retos mentales hasta lograr escapar en un tiempo máximo de 60 minutos.\r\n\r\nUsar vuestra habilidad, ingenio y destreza mental. Pero sobre todo el éxito de la misión dependerá de vuestra compenetración y trabajo en equipo. 4   50.00   60  jordi
jordi.ultimavis Últim avís  C/Martinez de la Rosa 28    El concepte de joc d’escapament en viu és senzill; resol els misteris usant les pistes que trobaràs a l’habitació per escapar en menys d’una hora.\r\n\r\nSi t’agraden els reptes i busques una experiència única de viure en companyia, aquest és el teu lloc. Un joc per a persones inquietes i curioses que posarà a prova el seu enginy.    6   45.00   60  jordi
jordi.insomniacorporation   insomnia corporation    C/Gran Via 1    studiants, famílies, teambuilding, turistes. Sempre que tinguis 18 anys podràs venir a jugar a la nostra fuita *room. Si ets menor d’edat truca’ns i t’informarem de les opcions que t’oferim.  9   50.00   60  jordi
jordi.missionLeak   mission leak    Carretera de Esplugues 47 local 8   En estos días se encuentra en nuestra ciudad el primer ministro de la República de Thaqar, y ha traído consigo el mayor tesoro de su país. El diamante llamado “La Flor de Thaqar”. Lo ha depositado en una sucursal bancaria de su país, y aquí es donde entráis en juego. Si te gustan los desafíos y quieres pasar sesenta minutos muy divertidos, esta es tu actividad.\r\n\r\nSolo necesitas reunir un grupo de 2 a 5 aventureros y tener ganas de utilizar vuestro ingenio y habilidad para superar el reto: ni más ni menos que asaltar un banco y conseguir escapar con el botín. Debéis tener mucho cuidado, ya que no solo se trata de poder encontrar  el diamante, si no de poder salir del banco antes de que la policía o las propias medidas de seguridad detecten vuestra presencia.\r\n\r\nEsta aventura solo puede acabar de dos formas posibles, con el objetivo cumplido y celebrándolo en las Bahamas o bien esposados y entre rejas, veamos a qué grupo perteneces. Solo los osados y los valientes lo comprobaran. ¡RESERVA TU AVENTURA YA!  8   45.00   60  jordi
jordi.desafioPirata desafio pirata  C/Mota de Sant Pere S/N (cubelles)  2.de los juegos de escape nace "The mysterious legend of Cubelles" el único juego de escape basado en restos históricos, donde revivirás la historia de Bonaventura Almirall y sus grafitis del s.XVIII encontrados en el Castillo de Cubelles. 6   45.00   60  jordi
jordi.escapis   escapis C/Nord 6    UTILIZA TU MENTE! ESTA ES LA REGLA PRINCIPAL. SACA EL SHERLOCK HOLMES QUE LLEVAS DENTRO.\r\nUNA VEZ DENTRO TENDRÁS UNA HORA PARA SALIR Y TE ADVERTIMOS QUE NO TODOS LO CONSIGUEN!\r\nTODO ES INTERACTIVO. A DIFERENCIA DE UN VIDEOJUEGO ESTO ES LA VIDA REAL: EL MANDO ERES TU Y NO HAY LÍMITES A LO QUE PUEDES HACER.\r\nPARA GANAR NECESITARÁS JUGAR EN EQUIPO. VEN CON TUS AMIGOS O CON TU FAMILIA (ENTRE 2 Y 6 PERSONAS)    8   40.00   60  jordi
jordi.theX-Door the x-door  Rambla de Ferran 53 The X-Door es el Juego de Escape en vivo o Room Escape Game que arrasa en Madrid, Valencia y Bilbao, y ya ha llegado a Lleida. Si quieres descubrir una sorprende actividad de ocio en Lleida, forma tu equipo (de 2 a 5 personas), reserva esta actividad y venid a jugar. La diversión está garantizada y os aseguramos que pasaréis días recordando los mejores momentos.    7   50.00   60  jordi
jordi.effugium  effugium    C/Joan Maragall 99  Términos y condiciones\r\nAviso Legal\r\nReservas\r\nEl juego\r\nContacto\r\nBono regalo\r\nLocalización\r\nEffugium es el primer juego de escape en vivo situado en Mataró, uno de los más grandes de Europa y totalmente tematizado.\r\n\r\nEs un juego apto para todo tipo de público que se divierta resolviendo enigmas, jugando a juegos de mesa y misterio y que disfrute en compañía de familiares y amigos.\r\n\r\nLa aventura pondrá a prueba vuestra agudeza e ingenio. Solamente si lográis descifrar cada uno de los enigmas, pruebas y acertijos que iréis encontrando estratégicamente durante el recorrido, conseguiréis salir. La fuerza física no os ayudará en ningún caso.\r\n\r\nEntrar es fácil pero salir… tan sólo lo lograréis con un buen trabajo en equipo, siendo observadores y usando vuestra lógica y destreza ya que a la hora de identificar y analizar las pistas con detalle, la comunicación entre vosotros será una pieza indispensable.   6   50.00   60  jordi
jordi.enigmatiks    enigmatiks  C/Sant Antoni 17    Después de la muerte del Sr. Blake, su familia descubrió que pertenecia a una organización muy antigua y clandestina. Ocupó parte de su vida buscando uno de los tesoros más valiosos de la humanidad, el Santo Grial, escondido por sus eternos guardianes, los caballeros templarios.\r\nEn su afanada búsqueda, el Sr. Blake consiguió descifrar los enigmas más complejos y recopilar información suficiente para acabar resolviendo el misterio de uno de los tesoros más buscados.\r\nCon su muerte, la búsqueda quedó truncada, por ello, en su herencia, les brinda la oportunidad a su familia de acabar con su trabajo y así encontrar el preciado tesoro.\r\nEn esta nueva aventura la familia del Sr. Blake necesita al mejor grupo de historiadores con gran dominio de la criptologia, símbolos y ambigramas para acabar descifrando los enigmas finales que les llevarán a descubrir el econdite del Santo Grial.    8   50.00   60  jordi
jordi.roomescapesantfeliu   room escape sant feliu  C/Verge de Montserrat 9 "Se trata de un juego en grupo (de 2 a 5 personas) que tiene como objetivo lograr salir de un escenario en un tiempo límite de 60 minutos. Participa en esta divertida aventura donde será necesario investigar, resolver enigmas, puzzles, encontrar llaves y obtener combinaciones para lograr escapar "  6   50.00   60  jordi
jordi.skpgame   skp game    C/Major 94  El juego en vivo y en equipo para poner a prueba tus habilidades\r\ny pasarlo bien con aventuras emocionantes   8   50.00   60  jordi
jordi.cafemisteri   café misteri    Pg.Vint-i-dos de Juliol 331 Cafè Misteri és el primer joc d’escapar en viu de la ciutat de Terrassa, el que se‘n diu una ‘Room Escape’, es tracta d’un joc d’equip, heu de formar un equip de 2 a 5 persones amb ganes de passar una bona estona. Entrareu dins d’una habitació amb un compte enrere de 60 minuts, vosaltres sou els protagonistes de la historia, veniu a demostrar que teniu un coeficient intel·lectual de 200 i que sou vàlids per a una missió molt important per a la humanitat.  4   45.00   60  jordi
jordi.vivetuescape  vive tu escape  Carretera de Rubí 400   Room Escape Pirata vive una auténtica aventura de 60 minutos.\r\nSelecciona la fecha en la que quieres hacer tu reserva.\r\nEquipos de 2 a 6 jugadores (los menores de 16 años deben ir acompañados al menos de 1 adulto).\r\nDuración de la sesión 60 minutos. 6   60.00   60  jordi
jordi.escapem   escapem C/Casp 9    Escapem te ofrece su primer reto, “La sospecha” la 1ª sala de escape de Sabadell, una nueva forma de pasar un divertido rato en família, con amigos o compañeros de trabajo.\r\n\r\n60 minutos es el tiempo del que dispondréis, sólo gracias a vuestro ingenio y al trabajo en equipo lograréis conseguirlo.\r\n\r\n¿Os atrevéis a ser los protagonistas de esta historia?\r\n\r\nEl tiempo corre en vuestra contra…   8   65.00   60  jordi
jordi.scaparium scaparium   C/Teatre 7  Todavía no conoces Scaparium, pero..¿Sabes qué es un room escape? Scaparium Room Escape es un juego para todas las edades basado en los juegos de escapismo en vivo (Room Escape). Si te gustan los retos y quieres sorprender a tus amigos con una experiencia única, positiva, y emocionante, reserva tu juego Room escape en Scaparium. Descubrirás una nueva y original forma de ocio. En este Room Escape dispondrás de 60 minutos para intentar escapar de la misión, te va a gustar!! ¿Conseguirás escapar del room escape antes del tiempo límite?  8   45.00   60  jordi
\.


--
-- Data for Name: parking; Type: TABLE DATA; Schema: public; Owner: test
--
INSERT INTO parking values(0,'-','-',0.00,0.00,0.00,0);
INSERT INTO parking VALUES (1,'Esportiu Rocafort','Carrer de Floridablanca, 41',41.404285, 2.1973176,5.00,125,08015);
INSERT INTO parking VALUES (2,'Rambla Poblenou',' Rambla del Poblenou, 130',41.427593, 2.177014,5.00,120,08018);
INSERT INTO parking VALUES (3,'Illa Borbó','Carrer de Ramon Albó, 77',41.396473, 2.1499686,5.00,340,08027);
INSERT INTO parking VALUES (4,'Abart','Travessera de Gracia, 57',41.39784, 2.1255937,5.00,240,08006);
INSERT INTO parking VALUES (5,'Sentmenat-Vergos',' Carrer del Cardenal Sentmenat, 8',41.39609, 2.1967173,5.00,290,08017);
INSERT INTO parking VALUES (6,'Avila','Carrer de Sancho de Ávila, 35',41.40541, 2.1425724,5.00,160,08018);
INSERT INTO parking VALUES (7,'Mitre-Putget','Ronda del General Mitre, 203',41.37184, 2.1430528,5.00,240,08021);
INSERT INTO parking VALUES (8,'Plafer','Carrer de Sant Pere Abanto, 14',41.402355, 2.2048793,5.00,250,08014);
INSERT INTO parking VALUES (9,'Bilbao-Llull','S, Carrer de Bilbao, 29',41.38364, 2.1511855,5.00,275,08005);
INSERT INTO parking VALUES (10,'BAMSA Valencia-Calabria','Carrer de València, 77',41.37768, 2.1834967,5.00,124,08015);
INSERT INTO parking VALUES (11,'Bus Moll Espanya','Carrer del Ictíneo',41.394047, 2.1064656,5.00,240,08003);
INSERT INTO parking VALUES (12,'IESE','Pl. del Escultor Ramir Rocamora / Av. Pearson',41.37927, 2.1698232,5.00,150,08034);
INSERT INTO parking VALUES (13,'BAMSA Illa Raval','Carrer de Sant Rafael, 15',41.37427, 2.1593733,5.00,200,08001);
INSERT INTO parking VALUES (14,'Roma','Carrer del Consell de Cent, 264',41.390358,2.138361,5.00,100,08011);
INSERT INTO parking VALUES (15,'Gracia Motos','Carrer Gran de Gràcia, 190',41.40443, 2.1894672,5.00,240,08012);
INSERT INTO parking VALUES (16,'Ona Glories','Carrer de la Ciutat de Granada, 171',41.385544, 2.1939995,5.00,120,08018);
INSERT INTO parking VALUES (17,'Parc de Recerca','C Doctor Aiguader, 88',41.405704, 2.1626039,5.00,100,08003);
INSERT INTO parking VALUES (18,'Plaça Joanic','C del Escorial, 1',41.4399, 2.1553316,5.00,220,08024);
INSERT INTO parking VALUES (19,'Tanatori de les Corts','Av. de Joan XXIII, 23 - 25',41.406624, 2.2183669,5.00,300,08028);
INSERT INTO parking VALUES (20,'Garcia Faria','Carrer de Josep Pla, 14',41.37983, 2.189115,5.00,170,08019);
INSERT INTO parking VALUES (21,'BAMSA Barceloneta','C.del Baluard,27',41.391182, 2.14791,5.00,195,08003);
INSERT INTO parking VALUES (22,'BAMSA Londres-Villaroel','Carrer de Londres, 56',41.406788, 2.1334794,5.00,250,08029);
INSERT INTO parking VALUES (23,'Plaça Bonanova','Passeig de la Bonanova, 12',41.425777, 2.1838083,5.00,250,08022);
INSERT INTO parking VALUES (24,'Concepcio Arenal','Carrer de Concepción Arenal, 143',41.412884, 2.221218,5.00,400,08027);
INSERT INTO parking VALUES (25,'Plaça del Forum','Carrer Sant Ramon de Penyafort, 1U',41.411854, 2.132396,5.00,400,08005);
INSERT INTO parking VALUES (26,'CosmoCaixa','Carrer dels Quatre Camins, 89',41.382847, 2.1425192,5.00,400,08022);
INSERT INTO parking VALUES (27,'BAMSA Josep Tarradellas II','Av Josep Tarradellas, 46',41.37208, 2.1575017,5.00,320,08029);
INSERT INTO parking VALUES (28,'Ciutat de Teatre','Carrer de la França Xica, 35',41.34672, 2.1447077,5.00,150,08004);
INSERT INTO parking VALUES (29,'Rentamar S.A','C Entença, 328*334',41.399353,2.2033215,5.00,100,08029);
INSERT INTO parking VALUES (30,'Superficie Almogavers','C Llacuna, 101',41.395737,2.1693575,5.00,200,08018);
  


INSERT INTO erxparking VALUES('ismael.barcelocked',1);
INSERT INTO erxparking VALUES('ismael.chickenbanana',2);
INSERT INTO erxparking VALUES('jordi.confined',3);
INSERT INTO erxparking VALUES('jordi.cronologic',4);
INSERT INTO erxparking VALUES('jordi.enigma',5);
INSERT INTO erxparking VALUES('jordi.enigmik',6);
INSERT INTO erxparking VALUES('jordi.escapasipuedes',7);
INSERT INTO erxparking VALUES('jordi.escapebarcelona',8);
INSERT INTO erxparking VALUES('jordi.escapehunt',9);
INSERT INTO erxparking VALUES('jordi.espaniq',10);
INSERT INTO erxparking VALUES('jordi.habitacion73',11);
INSERT INTO erxparking VALUES('jordi.parapark1',12);
INSERT INTO erxparking VALUES('jordi.parapark2',13);
INSERT INTO erxparking VALUES('jordi.picaderomotel',14);
INSERT INTO erxparking VALUES('jordi.proyectotarget',15);
INSERT INTO erxparking VALUES('jordi.tacticgame',16);
INSERT INTO erxparking VALUES('jordi.questory',17);
INSERT INTO erxparking VALUES('jordi.retobox',18);
INSERT INTO erxparking VALUES('jordi.roomIn',19);
INSERT INTO erxparking VALUES('jordi.simulacrevuit',20);
INSERT INTO erxparking VALUES('jordi.thehouseofwhispers',21);
INSERT INTO erxparking VALUES('jordi.tictacroom',22);
INSERT INTO erxparking VALUES('jordi.ultimavis',23);
INSERT INTO erxparking VALUES('jordi.insomniacorporation',24);
INSERT INTO erxparking VALUES('jordi.missionLeak',25);
INSERT INTO erxparking VALUES('jordi.desafioPirata',26);
INSERT INTO erxparking VALUES('jordi.escapis',27);
INSERT INTO erxparking VALUES('jordi.theX-Door',28);
INSERT INTO erxparking VALUES('jordi.effugium',29);
INSERT INTO erxparking VALUES('jordi.enigmatiks',30);



--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: test
--
    
COPY users (coduser, name, surname, username, email, admin, password, zip_code, phone_number, gender) FROM stdin;
jordi   jordi   jordi   jordi   jordi@admin.com t   202cb962ac59075b964b07152d234b70    12345   123456789   M
ismael  ismael  ismael  ismael  ismael@admin.com    t   202cb962ac59075b964b07152d234b70    12345   123456789   M
user1   user1   user1   user1   user1@auser.com f   202cb962ac59075b964b07152d234b70    12345   123456789   M
user2   user2   user2   user2   user2@auser.com f   202cb962ac59075b964b07152d234b70    12345   123456789   M
\.


--
-- Name: er_coder_pk; Type: CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY escaperoom
    ADD CONSTRAINT er_coder_pk PRIMARY KEY (coder);


--
-- Name: parking_codparking_pk; Type: CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY parking
    ADD CONSTRAINT parking_codparking_pk PRIMARY KEY (codparking);


--
-- Name: reserva_socofep_pk; Type: CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY bookings
    ADD CONSTRAINT reserva_socofep_pk PRIMARY KEY (coder, startdate,start);



--
-- Name: users_codusuari_pk; Type: CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_codusuari_pk PRIMARY KEY (coduser);


--
-- Name: erxparking_coder_fk; Type: FK CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY erxparking
    ADD CONSTRAINT erxparking_coder_fk FOREIGN KEY (coder) REFERENCES escaperoom(coder);


--
-- Name: erxparking_codparking_fk; Type: FK CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY erxparking
    ADD CONSTRAINT erxparking_codparking_fk FOREIGN KEY (codparking) REFERENCES parking(codparking);


--
-- Name: escaperoom_administrator_fk; Type: FK CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY escaperoom
    ADD CONSTRAINT escaperoom_administrator_fk FOREIGN KEY (administrator) REFERENCES users(coduser) ON DELETE CASCADE;


--
-- Name: reserva_coder_fk; Type: FK CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY bookings
    ADD CONSTRAINT reserva_coder_fk FOREIGN KEY (coder) REFERENCES escaperoom(coder);


--
-- Name: reserva_codparking_fk; Type: FK CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY bookings
    ADD CONSTRAINT reserva_codparking_fk FOREIGN KEY (codparking) REFERENCES parking(codparking);


--
-- Name: reserva_codusuari_fk; Type: FK CONSTRAINT; Schema: public; Owner: test
--

ALTER TABLE ONLY bookings
    ADD CONSTRAINT reserva_codusuari_fk FOREIGN KEY (coduser) REFERENCES users(coduser);




--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

