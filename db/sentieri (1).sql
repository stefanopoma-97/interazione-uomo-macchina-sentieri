-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Set 30, 2020 alle 08:35
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
(4, 'Milano'),
(5, 'Agrigento'),
(6, 'Alessandria'),
(7, 'Ancona'),
(8, 'Aosta'),
(9, 'Arezzo'),
(10, 'Ascoli Piceno'),
(11, 'Asti'),
(12, 'Avellino'),
(13, 'Bari'),
(14, 'Belluno'),
(15, 'Benevento'),
(16, 'Biella'),
(17, 'Bologna'),
(18, 'Bolzano'),
(19, 'Brindisi'),
(20, 'Cagliari'),
(21, 'Campobasso'),
(22, 'Caserta'),
(23, 'Catania'),
(24, 'Catanzaro'),
(25, 'Chieti'),
(26, 'Como'),
(27, 'Cosenza'),
(28, 'Cremona'),
(29, 'Crotone'),
(30, 'Cuneo'),
(31, 'Enna'),
(32, 'Fermo'),
(33, 'Ferrara'),
(34, 'Firenze'),
(35, 'Foggia'),
(36, 'Forlì'),
(37, 'Genova'),
(38, 'Gorizia'),
(39, 'Grosseto'),
(40, 'Imperia'),
(41, 'Isernia'),
(42, 'L\'Aquila'),
(43, 'La Spezia'),
(44, 'Latina'),
(45, 'Lecce'),
(46, 'Livorno'),
(47, 'Lodi'),
(48, 'Lucca'),
(49, 'Macerata'),
(50, 'Mantova'),
(51, 'Massa-Carrara'),
(52, 'Matera'),
(53, 'Messina'),
(54, 'Modena'),
(55, 'Napoli'),
(56, 'Novara'),
(57, 'Nuoro'),
(58, 'Oristano'),
(59, 'Palermo'),
(60, 'Padova'),
(61, 'Parma'),
(62, 'Pavia'),
(63, 'Perugia'),
(64, 'Pesaro e Urbino'),
(65, 'Pescara'),
(66, 'Piacenza'),
(67, 'Pisa'),
(68, 'Pistoia'),
(69, 'Pordenone'),
(70, 'Potenza'),
(71, 'Prato'),
(72, 'Reggio Calabria'),
(73, 'Ragusa'),
(74, 'Ravenna'),
(75, 'Reggio Emilia'),
(76, 'Rieti'),
(77, 'Rimini'),
(78, 'Roma'),
(79, 'Rovigo'),
(80, 'Salerno'),
(81, 'Sassari'),
(82, 'Savona'),
(83, 'Siena'),
(84, 'Siracusa'),
(85, 'Sondrio'),
(86, 'Taranto'),
(87, 'Teramo'),
(88, 'Terni'),
(89, 'Torino'),
(90, 'Trapani'),
(91, 'Trento'),
(92, 'Treviso'),
(93, 'Trieste'),
(94, 'Udine'),
(95, 'Varese'),
(96, 'Venezia'),
(97, 'Vercelli'),
(98, 'Verona'),
(99, 'Vicenza'),
(100, 'Viterbo');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `dati_sentiero`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `dati_sentiero` (
`id` int(10) unsigned
,`titolo` varchar(100)
,`descrizione` text
,`lunghezza` decimal(10,1) unsigned
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
,`difficolta` varchar(50)
,`citta` varchar(20)
,`creatore` varchar(32)
,`creatore_id` int(11) unsigned
,`partecipanti` bigint(21)
,`mediavoti` decimal(13,2)
,`difficoltamedia` decimal(13,2)
,`preferiti` bigint(21)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `dati_sentiero_2`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `dati_sentiero_2` (
`id` int(10) unsigned
,`titolo` varchar(100)
,`descrizione` text
,`lunghezza` decimal(10,1) unsigned
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
,`difficolta` varchar(50)
,`citta` varchar(20)
,`creatore` varchar(255)
,`creatore_id` int(10) unsigned
,`partecipanti` bigint(21)
,`mediavoti` decimal(13,2)
,`difficoltamedia` decimal(13,2)
,`preferiti` bigint(21)
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
  `commento` varchar(1000) NOT NULL,
  `voto` int(11) NOT NULL,
  `difficolta` int(11) NOT NULL,
  `utente_id` int(10) UNSIGNED NOT NULL,
  `sentiero_id` int(10) UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `revisore_id` int(10) UNSIGNED DEFAULT NULL,
  `approvato` tinyint(1) NOT NULL DEFAULT 0,
  `stato` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'revisione',
  `nota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `esperienza`
--

INSERT INTO `esperienza` (`id`, `commento`, `voto`, `difficolta`, `utente_id`, `sentiero_id`, `data`, `revisore_id`, `approvato`, `stato`, `nota`) VALUES
(1, 'molto faticoso .....', 8, 7, 1, 13, '2020-05-06', NULL, 1, 'approvato', ''),
(2, 'stanco', 7, 7, 1, 8, '2020-05-10', NULL, 1, 'approvato', ''),
(5, 'bah', 1, 1, 7, 13, '2020-05-01', NULL, 1, 'approvato', ''),
(6, 'mi è piaciuto', 10, 8, 7, 13, '2020-05-08', NULL, 1, 'approvato', ''),
(7, 'bellissimo', 10, 5, 1, 8, '2020-06-04', NULL, 1, 'approvato', ''),
(13, 'bo', 6, 6, 1, 13, '2020-07-01', NULL, 1, 'approvato', ''),
(14, 'bo', 7, 7, 1, 9, '2020-07-01', NULL, 1, 'approvato', ''),
(15, 'bello', 4, 7, 1, 9, '2020-07-01', NULL, 1, 'approvato', ''),
(17, 'bo', 1, 1, 1, 12, '2020-07-01', 1, 1, 'approvato', ''),
(27, 'un commento', 6, 6, 11, 9, '2020-07-01', 1, 0, 'rifiutato', ''),
(38, 'percorso da stefano4', 5, 6, 11, 12, '2020-07-01', 1, 0, 'approvato', ''),
(55, 'Quia impedit aut maxime voluptatem.', 9, 6, 1, 8, '1973-08-03', NULL, 0, 'approvato', ''),
(56, 'Dignissimos beatae voluptatem voluptatibus dolorem.', 9, 1, 1, 9, '2007-06-15', NULL, 0, 'approvato', ''),
(57, 'Iste vitae veritatis quam.', 5, 9, 1, 16, '1995-12-26', NULL, 0, 'approvato', ''),
(58, 'Maxime error.', 5, 3, 2, 12, '2017-01-08', NULL, 0, 'approvato', ''),
(59, 'Qui vel.', 3, 1, 11, 11, '2010-09-27', 1, 0, 'rifiutato', 'Expedita eum.'),
(60, 'Molestiae dicta ea.', 9, 1, 23, 8, '1974-08-30', 1, 0, 'rifiutato', 'Omnis.'),
(61, 'Debitis sit facere nihil ex est est.', 7, 8, 1, 16, '1989-08-23', NULL, 0, 'approvato', ''),
(62, 'Aut dolores at laudantium.', 7, 5, 1, 9, '1978-01-14', NULL, 0, 'approvato', ''),
(64, 'Qui quis fuga id corporis.', 7, 4, 22, 10, '2012-07-30', 1, 0, 'rifiutato', 'Dolorem itaque dolor.'),
(65, 'lago del barbellino -stefano', 7, 6, 1, 8, '2020-07-06', 1, 0, 'approvato', ''),
(89, 'TEST', 1, 1, 11, 12, '2020-07-22', 1, 0, 'rifiutato', 'rifiutata');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `id` int(10) UNSIGNED NOT NULL,
  `utente_id` int(10) UNSIGNED NOT NULL,
  `sentiero_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `preferiti`
--

INSERT INTO `preferiti` (`id`, `utente_id`, `sentiero_id`) VALUES
(48, 1, 8),
(49, 1, 9),
(60, 1, 12),
(23, 7, 13),
(46, 7, 16),
(45, 11, 16);

-- --------------------------------------------------------

--
-- Struttura della tabella `sentiero`
--

CREATE TABLE `sentiero` (
  `id` int(10) UNSIGNED NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `descrizione` text NOT NULL,
  `lunghezza` decimal(10,1) UNSIGNED NOT NULL,
  `salita` int(10) UNSIGNED NOT NULL,
  `discesa` int(10) UNSIGNED NOT NULL,
  `altezza_massima` int(10) UNSIGNED NOT NULL,
  `altezza_minima` int(10) UNSIGNED NOT NULL,
  `durata` float NOT NULL,
  `difficolta_id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `utente_id` int(10) UNSIGNED NOT NULL,
  `citta_id` int(10) UNSIGNED NOT NULL,
  `dislivello` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sentiero`
--

INSERT INTO `sentiero` (`id`, `titolo`, `descrizione`, `lunghezza`, `salita`, `discesa`, `altezza_massima`, `altezza_minima`, `durata`, `difficolta_id`, `categoria_id`, `utente_id`, `citta_id`, `dislivello`) VALUES
(8, 'Valbondione - Maslana- Curò- Lago Barbellino', 'Percorso:\r\npartenza da Valbondione, località Grumetti, nei pressi della teleferica- sentiero 332, che sale nel bosco- borgo di Maslana- Osservatorio floro-faunistico- saliamo lungo una ripida costa non segnalata che dall\'Osservatorio porta a raggiungere il sentiero 305- proseguiamo per questo ampio sentiero fino al rifugio Curò (1895m)- giriamo a sn del lago del Barbellino per raggiungere la diga del Barbellino- ritorniamo sui nostri passi di nuovo al rifugio- costeggiamo il lago per il sentiero 308 che raggiunge il Rifugio Barbellino (2130m) e poi il lago Barbellino naturale- ridiscendiamo nuovamente al rifugio Curò e di lì a Valbondione seguendo sempre il sentiero 305 senza passare per Maslana.\r\n\r\nSentieri:\r\nil sentiero per arrivare a Maslana è nel bosco, ripido e sconnesso.\r\nil tratto di costa usato come raccordo tra l\'Osservatorio e il 305 è breve, ma molto ripido.\r\nil sentiero 305 è molto ampio e per quanto lungo e faticoso, non presenta pendenze eccessive. Nell\'ultimo tratto leggermente più esposto ci sono dei cavi di sicurezza, ma non li abbiamo utilizzati. D\'estate è frequentatissimo da ogni tipo di persone, bambini compresi.\r\nAnche il sentiero 308 è ampio e facile, con pendenza quasi nulla.\r\nFonti: a Maslana, al Rifugio Curò e al Rifugio Barbellino.', '16.0', 1000, 1000, 1900, 1900, 10.33, 2, 2, 1, 3, 0),
(9, 'Corna Blacca dal Passo Maniva', 'Al rif. Chalet si parcheggia nell\'ampio spazio che d\'inverno ospita gli sciatori e ci si incammina verso est prendendo la dorsale del monte Dosso Alto seguendo una traccia evidente del \"Sentiero Tre Valli\" con i classici colori bianco-azzurri. La variante bassa si svolge su comoda strada, ma noi percorriamo l\'alternativa della variante alta più panoramica e gratificante. I sentiero poi si incrociano alla fine del versante opposto e su comoda strada arrivano ad un valico che scende verso Bagolino. Il nostro itinerario prosegue su sentiero in quota e dirige a sud passando per la Capanna Tita Secchi posta a guardia di un monumento in ricordo dei caduti della guerra. Proseguendo si arriva ad un bivio dove la segnaletica divide la salita alla Corna Blacca in \"normale\" e \"diretta\". Noi scegliamo la seconda che con brevi tratti su roccette e semplice arrampicata ci porta alla vetta(la vette sono due adiacenti e con la stessa quota. si possono raggiungere comodamente entrambi). il sentiero di ritorno scende dal passo che divide le due cime e continua verso sud compiendo un percorso più basso e ritornando al sentiero percorso nell\'andata.', '12.0', 1100, 1100, 2000, 2000, 4, 2, 2, 1, 1, 0),
(10, 'Lago Aviolo', 'A 1930 m di quota nello splendido scenario del Lago d’Aviolo e del Baitone, nel cuore del Parco dell’Adamello lombardo, in Comune di Edolo Alta Vallecamonica.\r\nIl rifugio del Cai di Edolo “Sandro Occhi” all’Aviolo è un accogliente alberghetto con un’ottima cucina casalinga, aperto da inizio giugno a fine settembre e in altri periodi su prenotazione.\r\nDispone di camere con 54 posti letto, servizi igienici e docce con acqua corrente anche calda. Locale invernale sempre aperto. Fa parte dell’associazione “Albergo Verde” di Vallecamonica, che favorisce l’adozione di pratiche in sintonia con l’ambiente, con la cultura locale e le finalità dell’area protetta del Parco dell’Adamello del cui Marchio Territoriale è partner ufficiale. La sua posizione, sull’Alta Via dell’Adamello, è ideale per numerose escursioni ed ascensioni, per esplorare lo spettacolare ambiente della riserva naturale del Parco e cuore di un Sito Europeo d’Importanza Comunitaria (SIC).\r\nOppure si può semplicemente passare il tempo oziando e prendendo il sole sulle rive dell’incantevole lago – dove è possibile pescare – o del limpidissimo torrente, nella pace e nel silenzio della natura incontaminata.', '4.0', 400, 400, 1900, 1900, 2, 2, 2, 1, 1, 0),
(11, 'Balota del Coren - Iseo', 'Iseo - passeggiata Balota del Coren.\r\nPartendo da Iseo si sale verso il Santuario della Madonna del Corno, risalente al 1500 e trovata eccezionalmente aperta durante la giornata FAI.\r\nSi prosegue salendo nel boscoso monte del Corno del Creilì, raggiungendo la croce di legno sulla rupe, a picco su Iseo con una panoramica mozzafiato del lago, dalle Torbiere del Sebino, viste nella loro interezza, a Monte Isola e in lontananza fino alle prealpi.\r\nDa qui si scende sul versante opposto, tra crinale del monte, spiazzi aperti e fitti boschi, bello in ogni stagione. Capita spesso di incontrare postazioni di caccia.', '10.0', 400, 400, 600, 300, 3, 1, 1, 1, 1, 300),
(12, 'Giro lago Endine', 'Giro del Lago di Endine, è adatto anche a gruppi, famiglie e chi vuol fare una scampagnata con passo lento. Noi ce la siamo presi comoda con una sosta pranzo a Spinone al Lago di più di 2 ore, unico neo un pezzo di strada lungo la statale un po\' trafficata sulla sponda nord poco prima di endine paese', '20.0', 200, 200, 400, 400, 8, 1, 1, 1, 2, 0),
(13, 'Monte Guglielmo', 'Partenza dalla piazza dei caduti di Zone.Si potrebbe parcheggiare anche più vicino all\'imbocco del sentiero di partenza, ma i parcheggi erano già tutti pieni...\r\n\r\nSi imbocca il sentiero Camadone con le indicazioni il Monte Gugliemo.\r\nIl tracciato sale subito ripido su una mulattiera con fondo sassoso e attraversa il Bosco degli Gnomi, che prende il nome dalle molte statue di legno raffiguranti gnomi, draghi e altre bestie fantastiche posate ai lati dei sentieri che lo percorrono.\r\n\r\nLa mulattiera sale nel bosco con moltissimi tornati in pendenza costante e nel giro di 1h e 45 minuti si arriva finalmente in vista della Malga Palmarusso di Sotto. Qui abbiamo il primo splendido scorcio di panorama sul lago d\'Iseo.\r\nSi prosegue, sempre sulla mulattiera di sterrato bianco ed una volta arrivato al colle presso il Pozzo del Culmet si può gettare un nuovo e più ampio sguardo al panorama. Da qui si ha la prima vista anche sulla cima del Monte Guglielmo e il Rifugio Almici.\r\n\r\nSegue nuovamente la mulattiera e in 20 minuti e un paio di tornanti, arrivo al Rifugio.\r\nMi fermo giusto per alcune foto e riparto immediatamente per la vetta del Monte Guglielmo.\r\nQui il panorama sul lago, la pianura e le montagne attorno è magnifico.\r\nSulla vetta troviamo anche il Monumento al Redentore, una costruzione religiosa di pietra alta almeno 7mt. Intorno c\'è anche uno spazioso pianoro erboso dove è possibile fermarsi per il pranzo e un pò di meritato riposo.', '6.5', 500, 500, 1900, 1900, 3, 2, 2, 1, 1, 0),
(16, 'Monte Sparavera', 'Partenza da Gandino per poi salire sul monte Sparavera a quota 1300m. Abbastanza semplice', '8.5', 600, 600, 1300, 1300, 3, 2, 2, 1, 2, 0),
(21, 'Via ferrata Brescia', 'Via ferrata di Brescia', '1.0', 200, 0, 1000, 800, 2, 4, 3, 1, 1, 200);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` char(1) CHARACTER SET utf8 NOT NULL DEFAULT 'n',
  `descrizione` text CHARACTER SET utf8 NOT NULL DEFAULT '',
  `citta_id` int(10) UNSIGNED NOT NULL,
  `cognome` varchar(12) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`, `descrizione`, `citta_id`, `cognome`) VALUES
(1, 'stefano', 'stefano@gmail.com', '2020-06-28 09:02:47', 'poma', NULL, '2020-06-26 09:28:45', '2020-06-27 09:28:45', 'n', '', 0, ''),
(7, 'stefano2', 'stefano2@gmail.com', '2020-06-28 09:03:05', 'poma', NULL, '2020-06-26 09:29:06', '2020-06-27 09:29:06', 'n', '', 0, ''),
(8, 'stefano3', 'stefano3@gmail.com', NULL, '$2y$10$Ym.DPzBVLAFjm2sMt.xZIu9XqY3aHdbsnxeOJDgVFhOV4H1XhifL.', NULL, '2020-06-30 07:33:23', '2020-06-30 07:33:23', 'n', 'bla bla', 1, 'poma');

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
  `descrizione` text NOT NULL DEFAULT '',
  `consiglio_password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `codice` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `cognome`, `mail`, `username`, `password`, `citta_id`, `admin`, `descrizione`, `consiglio_password`, `codice`) VALUES
(1, 'Stefano', 'Poma', 'stefano1997poma@gmail.com', 'stefano', '612b4c33a6882508d2c0e584bb426a61', 1, 'y', 'Ho creato questo sito', '2 volte cognome', 'null'),
(2, 'prova', 'prova', 'prova@prova.it', 'prova', '147e03ab3bf33e06c20b8794da0ed9c7', 2, 'n', 'descrizione', 'provaprova', 'null'),
(7, 'stefano', 'poma', 'stefanopomatest@gmail.com', 'stefano2', '612b4c33a6882508d2c0e584bb426a61', 1, 'n', 'ciao', '', '89299'),
(11, 'stefano', 'poma', 's@gmail.com', 'stefano4', '612b4c33a6882508d2c0e584bb426a61', 1, 'n', 'bo', '', 'null'),
(22, 'Izabella Pouros', 'Champlin', 'ncarroll@example.com', 'A.', '612b4c33a6882508d2c0e584bb426a61', 3, 'n', 'Tempore.', 'è pomapoma', NULL),
(23, 'Wanda Gutkowski', 'McKenzie', 'wrice@example.net', 'Dolores nobis.', '612b4c33a6882508d2c0e584bb426a61', 3, 'n', 'Dolor et ad expedita.', 'è pomapoma', NULL),
(24, 'stefano', 'poma', 'stefano1997poma@gmail.com', 'stefano5', 'd41d8cd98f00b204e9800998ecf8427e', 1, 'n', 'zdfdzh', 'pomapoma', NULL);

-- --------------------------------------------------------

--
-- Struttura per vista `dati_sentiero`
--
DROP TABLE IF EXISTS `dati_sentiero`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dati_sentiero`  AS  (select distinct `sentiero`.`id` AS `id`,`sentiero`.`titolo` AS `titolo`,`sentiero`.`descrizione` AS `descrizione`,`sentiero`.`lunghezza` AS `lunghezza`,`sentiero`.`salita` AS `salita`,`sentiero`.`discesa` AS `discesa`,`sentiero`.`altezza_massima` AS `altezza_massima`,`sentiero`.`altezza_minima` AS `altezza_minima`,`sentiero`.`durata` AS `durata`,`sentiero`.`difficolta_id` AS `difficolta_id`,`sentiero`.`categoria_id` AS `categoria_id`,`sentiero`.`utente_id` AS `utente_id`,`sentiero`.`citta_id` AS `citta_id`,`categoria`.`nome` AS `categoria`,`difficolta`.`nome` AS `difficolta`,`citta`.`nome` AS `citta`,`utente`.`nome` AS `creatore`,`utente`.`id` AS `creatore_id`,count(`esperienza`.`id`) AS `partecipanti`,round(avg(`esperienza`.`voto`),2) AS `mediavoti`,round(avg(`esperienza`.`difficolta`),2) AS `difficoltamedia`,count(distinct `preferiti`.`id`) AS `preferiti` from ((((((`sentiero` left join `categoria` on(`sentiero`.`categoria_id` = `categoria`.`id`)) left join `difficolta` on(`sentiero`.`difficolta_id` = `difficolta`.`id`)) left join `esperienza` on(`sentiero`.`id` = `esperienza`.`sentiero_id` and `esperienza`.`stato` = 'approvato')) left join `preferiti` on(`sentiero`.`id` = `preferiti`.`sentiero_id`)) left join `citta` on(`sentiero`.`citta_id` = `citta`.`id`)) left join `utente` on(`sentiero`.`utente_id` = `utente`.`id`)) group by `sentiero`.`id`) ;

-- --------------------------------------------------------

--
-- Struttura per vista `dati_sentiero_2`
--
DROP TABLE IF EXISTS `dati_sentiero_2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dati_sentiero_2`  AS  (select distinct `sentiero`.`id` AS `id`,`sentiero`.`titolo` AS `titolo`,`sentiero`.`descrizione` AS `descrizione`,`sentiero`.`lunghezza` AS `lunghezza`,`sentiero`.`salita` AS `salita`,`sentiero`.`discesa` AS `discesa`,`sentiero`.`altezza_massima` AS `altezza_massima`,`sentiero`.`altezza_minima` AS `altezza_minima`,`sentiero`.`durata` AS `durata`,`sentiero`.`difficolta_id` AS `difficolta_id`,`sentiero`.`categoria_id` AS `categoria_id`,`sentiero`.`utente_id` AS `utente_id`,`sentiero`.`citta_id` AS `citta_id`,`categoria`.`nome` AS `categoria`,`difficolta`.`nome` AS `difficolta`,`citta`.`nome` AS `citta`,`users`.`name` AS `creatore`,`users`.`id` AS `creatore_id`,count(`esperienza`.`id`) AS `partecipanti`,round(avg(`esperienza`.`voto`),2) AS `mediavoti`,round(avg(`esperienza`.`difficolta`),2) AS `difficoltamedia`,count(distinct `preferiti`.`id`) AS `preferiti` from ((((((`sentiero` left join `categoria` on(`sentiero`.`categoria_id` = `categoria`.`id`)) left join `difficolta` on(`sentiero`.`difficolta_id` = `difficolta`.`id`)) left join `esperienza` on(`sentiero`.`id` = `esperienza`.`sentiero_id`)) left join `preferiti` on(`sentiero`.`id` = `preferiti`.`sentiero_id`)) left join `citta` on(`sentiero`.`citta_id` = `citta`.`id`)) left join `users` on(`sentiero`.`utente_id` = `users`.`id`)) group by `sentiero`.`id`) ;

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
  ADD KEY `esperienza_sentiero_foreign_key` (`sentiero_id`),
  ADD KEY `esperienza_utente_foreign_key` (`utente_id`),
  ADD KEY `revisione_id` (`revisore_id`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `utente_id` (`utente_id`,`sentiero_id`),
  ADD KEY `preferiti_sentiero_foreign_key` (`sentiero_id`);

--
-- Indici per le tabelle `sentiero`
--
ALTER TABLE `sentiero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sentiero_difficolta_foreign_key` (`difficolta_id`),
  ADD KEY `sentiero_categoria_foreign_key` (`categoria_id`),
  ADD KEY `sentiero_citta_foreign_key` (`citta_id`),
  ADD KEY `sentiero_utente_foreign_key` (`utente_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT per la tabella `difficolta`
--
ALTER TABLE `difficolta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `esperienza`
--
ALTER TABLE `esperienza`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT per la tabella `sentiero`
--
ALTER TABLE `sentiero`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `esperienza`
--
ALTER TABLE `esperienza`
  ADD CONSTRAINT `esperienza_revisore_foreign_key` FOREIGN KEY (`revisore_id`) REFERENCES `utente` (`id`),
  ADD CONSTRAINT `esperienza_sentiero_foreign_key` FOREIGN KEY (`sentiero_id`) REFERENCES `sentiero` (`id`),
  ADD CONSTRAINT `esperienza_utente_foreign_key` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`);

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_sentiero_foreign_key` FOREIGN KEY (`sentiero_id`) REFERENCES `sentiero` (`id`),
  ADD CONSTRAINT `preferiti_utente_foreign_key` FOREIGN KEY (`utente_id`) REFERENCES `utente` (`id`);

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
  ADD CONSTRAINT `utente_citta_foreign_key` FOREIGN KEY (`citta_id`) REFERENCES `citta` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
