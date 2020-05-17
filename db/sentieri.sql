-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 17, 2020 alle 20:02
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sentieri`
--
CREATE DATABASE IF NOT EXISTS `sentieri` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sentieri`;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'camminata'),
(2, 'trekking'),
(3, 'via ferrata');

-- --------------------------------------------------------

--
-- Struttura della tabella `citta`
--

CREATE TABLE `citta` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `citta`
--

INSERT INTO `citta` (`id`, `nome`) VALUES
(1, 'Brescia'),
(2, 'Bergamo'),
(3, 'Monza'),
(4, 'Milano');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `dati_sentiero`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `dati_sentiero` (
`id` int(10) unsigned
,`titolo` varchar(100)
,`descrizione` text
,`lunghezza` int(10) unsigned
,`salita` int(10) unsigned
,`discesa` int(10) unsigned
,`altezza_massima` int(10) unsigned
,`altezza_minima` int(10) unsigned
,`durata` float
,`difficolta_id` int(10) unsigned
,`categoria_id` int(10) unsigned
,`utente_id` int(10) unsigned
,`citta_id` int(10) unsigned
,`categoria` varchar(50)
,`citta` varchar(20)
,`difficolta` varchar(50)
,`partecipanti` bigint(21)
,`mediavoti` decimal(13,2)
,`difficoltamedia` decimal(13,2)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `difficolta`
--

CREATE TABLE `difficolta` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `difficolta`
--

INSERT INTO `difficolta` (`id`, `nome`) VALUES
(1, 'T'),
(2, 'E'),
(3, 'EE'),
(4, 'EEA');

-- --------------------------------------------------------

--
-- Struttura della tabella `esperienza`
--

CREATE TABLE `esperienza` (
  `id` int(10) UNSIGNED NOT NULL,
  `commento` varchar(100) NOT NULL,
  `voto` int(11) NOT NULL,
  `difficolta` int(11) NOT NULL,
  `utente_id` int(10) UNSIGNED NOT NULL,
  `sentiero_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `esperienza`
--

INSERT INTO `esperienza` (`id`, `commento`, `voto`, `difficolta`, `utente_id`, `sentiero_id`) VALUES
(1, 'molto faticoso', 8, 7, 1, 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `sentiero`
--

CREATE TABLE `sentiero` (
  `id` int(10) UNSIGNED NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `descrizione` text NOT NULL,
  `lunghezza` int(10) UNSIGNED NOT NULL,
  `salita` int(10) UNSIGNED NOT NULL,
  `discesa` int(10) UNSIGNED NOT NULL,
  `altezza_massima` int(10) UNSIGNED NOT NULL,
  `altezza_minima` int(10) UNSIGNED NOT NULL,
  `durata` float NOT NULL,
  `difficolta_id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `utente_id` int(10) UNSIGNED NOT NULL,
  `citta_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sentiero`
--

INSERT INTO `sentiero` (`id`, `titolo`, `descrizione`, `lunghezza`, `salita`, `discesa`, `altezza_massima`, `altezza_minima`, `durata`, `difficolta_id`, `categoria_id`, `utente_id`, `citta_id`) VALUES
(8, 'Valbondione- Maslana- Rif. Curò- Lago Barbellino', 'Percorso:\r\npartenza da Valbondione, località Grumetti, nei pressi della teleferica- sentiero 332, che sale nel bosco- borgo di Maslana- Osservatorio floro-faunistico- saliamo lungo una ripida costa non segnalata che dall\'Osservatorio porta a raggiungere il sentiero 305- proseguiamo per questo ampio sentiero fino al rifugio Curò (1895m)- giriamo a sn del lago del Barbellino per raggiungere la diga del Barbellino- ritorniamo sui nostri passi di nuovo al rifugio- costeggiamo il lago per il sentiero 308 che raggiunge il Rifugio Barbellino (2130m) e poi il lago Barbellino naturale- ridiscendiamo nuovamente al rifugio Curò e di lì a Valbondione seguendo sempre il sentiero 305 senza passare per Maslana.\r\n\r\nSentieri:\r\nil sentiero per arrivare a Maslana è nel bosco, ripido e sconnesso.\r\nil tratto di costa usato come raccordo tra l\'Osservatorio e il 305 è breve, ma molto ripido.\r\nil sentiero 305 è molto ampio e per quanto lungo e faticoso, non presenta pendenze eccessive. Nell\'ultimo tratto leggermente più esposto ci sono dei cavi di sicurezza, ma non li abbiamo utilizzati. D\'estate è frequentatissimo da ogni tipo di persone, bambini compresi.\r\nAnche il sentiero 308 è ampio e facile, con pendenza quasi nulla.\r\nFonti: a Maslana, al Rifugio Curò e al Rifugio Barbellino.', 10, 1000, 200, 1900, 900, 6, 3, 2, 1, 1),
(9, 'Corna Blacca dal Passo Maniva', 'Al rif. Chalet si parcheggia nell\'ampio spazio che d\'inverno ospita gli sciatori e ci si incammina verso est prendendo la dorsale del monte Dosso Alto seguendo una traccia evidente del \"Sentiero Tre Valli\" con i classici colori bianco-azzurri. La variante bassa si svolge su comoda strada, ma noi percorriamo l\'alternativa della variante alta più panoramica e gratificante. I sentiero poi si incrociano alla fine del versante opposto e su comoda strada arrivano ad un valico che scende verso Bagolino. Il nostro itinerario prosegue su sentiero in quota e dirige a sud passando per la Capanna Tita Secchi posta a guardia di un monumento in ricordo dei caduti della guerra. Proseguendo si arriva ad un bivio dove la segnaletica divide la salita alla Corna Blacca in \"normale\" e \"diretta\". Noi scegliamo la seconda che con brevi tratti su roccette e semplice arrampicata ci porta alla vetta(la vette sono due adiacenti e con la stessa quota. si possono raggiungere comodamente entrambi). il sentiero di ritorno scende dal passo che divide le due cime e continua verso sud compiendo un percorso più basso e ritornando al sentiero percorso nell\'andata.', 12, 1100, 400, 2000, 900, 4, 2, 2, 1, 1),
(10, 'Lago Aviolo', 'A 1930 m di quota nello splendido scenario del Lago d’Aviolo e del Baitone, nel cuore del Parco dell’Adamello lombardo, in Comune di Edolo Alta Vallecamonica.\r\nIl rifugio del Cai di Edolo “Sandro Occhi” all’Aviolo è un accogliente alberghetto con un’ottima cucina casalinga, aperto da inizio giugno a fine settembre e in altri periodi su prenotazione.\r\nDispone di camere con 54 posti letto, servizi igienici e docce con acqua corrente anche calda. Locale invernale sempre aperto. Fa parte dell’associazione “Albergo Verde” di Vallecamonica, che favorisce l’adozione di pratiche in sintonia con l’ambiente, con la cultura locale e le finalità dell’area protetta del Parco dell’Adamello del cui Marchio Territoriale è partner ufficiale. La sua posizione, sull’Alta Via dell’Adamello, è ideale per numerose escursioni ed ascensioni, per esplorare lo spettacolare ambiente della riserva naturale del Parco e cuore di un Sito Europeo d’Importanza Comunitaria (SIC).\r\nOppure si può semplicemente passare il tempo oziando e prendendo il sole sulle rive dell’incantevole lago – dove è possibile pescare – o del limpidissimo torrente, nella pace e nel silenzio della natura incontaminata.', 4, 400, 100, 1900, 1500, 2, 2, 2, 1, 1),
(11, 'Balota del Coren - Iseo', 'Iseo - passeggiata Balota del Coren.\r\nPartendo da Iseo si sale verso il Santuario della Madonna del Corno, risalente al 1500 e trovata eccezionalmente aperta durante la giornata FAI.\r\nSi prosegue salendo nel boscoso monte del Corno del Creilì, raggiungendo la croce di legno sulla rupe, a picco su Iseo con una panoramica mozzafiato del lago, dalle Torbiere del Sebino, viste nella loro interezza, a Monte Isola e in lontananza fino alle prealpi.\r\nDa qui si scende sul versante opposto, tra crinale del monte, spiazzi aperti e fitti boschi, bello in ogni stagione. Capita spesso di incontrare postazioni di caccia.', 10, 400, 100, 600, 200, 3, 1, 1, 1, 1),
(12, 'Giro lago Endine', 'Giro del Lago di Endine, è adatto anche a gruppi, famiglie e chi vuol fare una scampagnata con passo lento. Noi ce la siamo presi comoda con una sosta pranzo a Spinone al Lago di più di 2 ore, unico neo un pezzo di strada lungo la statale un po\' trafficata sulla sponda nord poco prima di endine paese', 20, 200, 100, 400, 200, 8, 1, 1, 1, 2),
(13, 'Monte Guglielmo', 'Partenza dalla piazza dei caduti di Zone.Si potrebbe parcheggiare anche più vicino all\'imbocco del sentiero di partenza, ma i parcheggi erano già tutti pieni...\r\n\r\nSi imbocca il sentiero Camadone con le indicazioni il Monte Gugliemo.\r\nIl tracciato sale subito ripido su una mulattiera con fondo sassoso e attraversa il Bosco degli Gnomi, che prende il nome dalle molte statue di legno raffiguranti gnomi, draghi e altre bestie fantastiche posate ai lati dei sentieri che lo percorrono.\r\n\r\nLa mulattiera sale nel bosco con moltissimi tornati in pendenza costante e nel giro di 1h e 45 minuti si arriva finalmente in vista della Malga Palmarusso di Sotto. Qui abbiamo il primo splendido scorcio di panorama sul lago d\'Iseo.\r\nSi prosegue, sempre sulla mulattiera di sterrato bianco ed una volta arrivato al colle presso il Pozzo del Culmet si può gettare un nuovo e più ampio sguardo al panorama. Da qui si ha la prima vista anche sulla cima del Monte Guglielmo e il Rifugio Almici.\r\n\r\nSegue nuovamente la mulattiera e in 20 minuti e un paio di tornanti, arrivo al Rifugio.\r\nMi fermo giusto per alcune foto e riparto immediatamente per la vetta del Monte Guglielmo.\r\nQui il panorama sul lago, la pianura e le montagne attorno è magnifico.\r\nSulla vetta troviamo anche il Monumento al Redentore, una costruzione religiosa di pietra alta almeno 7mt. Intorno c\'è anche uno spazioso pianoro erboso dove è possibile fermarsi per il pranzo e un pò di meritato riposo.', 6, 400, 100, 1900, 1500, 3, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(100) NOT NULL,
  `citta_id` int(10) UNSIGNED NOT NULL,
  `admin` char(1) NOT NULL DEFAULT 'n',
  `descrizione` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `cognome`, `mail`, `username`, `password`, `citta_id`, `admin`, `descrizione`) VALUES
(1, 'stefano', 'poma', 'stefano1997poma97@gmail.com', 'stefano', '3d3a8bbcad3d9f91cda207cb0b08f276', 1, 'y', 'Ho creato questo sito.\r\nbla \r\nbla'),
(2, 'prova', 'prova', 'prova@prova.it', 'prova', '189bbbb00c5f1fb7fba9ad9285f193d1', 2, 'n', ''),
(7, 'stefano', 'poma', 'stefanopomatest@gmail.com', 'stefano2', '3d3a8bbcad3d9f91cda207cb0b08f276', 1, 'n', 'ciao');

-- --------------------------------------------------------

--
-- Struttura per vista `dati_sentiero`
--
DROP TABLE IF EXISTS `dati_sentiero`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dati_sentiero`  AS  (select distinct `sentiero`.`id` AS `id`,`sentiero`.`titolo` AS `titolo`,`sentiero`.`descrizione` AS `descrizione`,`sentiero`.`lunghezza` AS `lunghezza`,`sentiero`.`salita` AS `salita`,`sentiero`.`discesa` AS `discesa`,`sentiero`.`altezza_massima` AS `altezza_massima`,`sentiero`.`altezza_minima` AS `altezza_minima`,`sentiero`.`durata` AS `durata`,`sentiero`.`difficolta_id` AS `difficolta_id`,`sentiero`.`categoria_id` AS `categoria_id`,`sentiero`.`utente_id` AS `utente_id`,`sentiero`.`citta_id` AS `citta_id`,`categoria`.`nome` AS `categoria`,`citta`.`nome` AS `citta`,`difficolta`.`nome` AS `difficolta`,count(`esperienza`.`id`) AS `partecipanti`,round(avg(`esperienza`.`voto`),2) AS `mediavoti`,round(avg(`esperienza`.`difficolta`),2) AS `difficoltamedia` from ((((`sentiero` left join `categoria` on(`sentiero`.`categoria_id` = `categoria`.`id`)) left join `citta` on(`sentiero`.`citta_id` = `citta`.`id`)) left join `difficolta` on(`sentiero`.`difficolta_id` = `difficolta`.`id`)) left join `esperienza` on(`sentiero`.`id` = `esperienza`.`sentiero_id`)) group by `sentiero`.`id`) ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `citta`
--
ALTER TABLE `citta`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `difficolta`
--
ALTER TABLE `difficolta`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `esperienza`
--
ALTER TABLE `esperienza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `esperienza_utente_foreign_key` (`utente_id`),
  ADD KEY `esperienza_sentiero_foreign_key` (`sentiero_id`);

--
-- Indici per le tabelle `sentiero`
--
ALTER TABLE `sentiero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sentiero_difficolta_foreign_key` (`difficolta_id`),
  ADD KEY `sentiero_categoria_foreign_key` (`categoria_id`),
  ADD KEY `sentiero_utente_foreign_key` (`utente_id`),
  ADD KEY `sentiero_citta_foreign_key` (`citta_id`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `utente_citta_foreign_key` (`citta_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `citta`
--
ALTER TABLE `citta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `difficolta`
--
ALTER TABLE `difficolta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `esperienza`
--
ALTER TABLE `esperienza`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `sentiero`
--
ALTER TABLE `sentiero`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `esperienza`
--
ALTER TABLE `esperienza`
  ADD CONSTRAINT `esperienza_sentiero_foreign_key` FOREIGN KEY (`sentiero_id`) REFERENCES `sentiero` (`id`),
  ADD CONSTRAINT `esperienza_utente_foreign_key` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `sentiero`
--
ALTER TABLE `sentiero`
  ADD CONSTRAINT `sentiero_categoria_foreign_key` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `sentiero_citta_foreign_key` FOREIGN KEY (`citta_id`) REFERENCES `citta` (`id`),
  ADD CONSTRAINT `sentiero_difficolta_foreign_key` FOREIGN KEY (`difficolta_id`) REFERENCES `difficolta` (`id`),
  ADD CONSTRAINT `sentiero_utente_foreign_key` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_citta_foreign_key` FOREIGN KEY (`citta_id`) REFERENCES `citta` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
