-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 11:39 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `access_id` int(12) NOT NULL,
  `module` varchar(60) NOT NULL DEFAULT 'default',
  `module_controller` varchar(40) NOT NULL DEFAULT 'index',
  `action` varchar(40) NOT NULL DEFAULT '',
  `access` enum('true','false') NOT NULL DEFAULT 'false',
  `role_id` int(12) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`access_id`, `module`, `module_controller`, `action`, `access`, `role_id`) VALUES
(1, 'default', 'index', '', 'true', 1),
(4, 'default', 'error', '', 'true', 1),
(11, 'default', 'index', '', 'true', 2),
(12, 'default', 'javascript', '', 'true', 2),
(13, 'default', 'json', '', 'true', 2),
(14, 'default', 'error', '', 'true', 2),
(15, 'default', 'index', 'secure', 'true', 2),
(23, 'default', 'javascript', 'login', 'true', 1),
(29, 'access', 'access:index', '', 'true', 5),
(30, 'access', 'access:javascript', '', 'true', 5),
(31, 'access', 'access:json', '', 'true', 5),
(36, 'access', 'access:json', 'edit', 'true', 6),
(45, 'default', 'index', 'secure', 'false', 1),
(46, 'default', 'index', 'logout', 'true', 1),
(266, 'customers', 'customers:javascript', '', 'true', 5),
(265, 'profitcenters', 'profitcenters:json', '', 'true', 5),
(264, 'profitcenters', 'profitcenters:javascript', '', 'true', 5),
(263, 'profitcenters', 'profitcenters:index', '', 'true', 5),
(262, 'projects', 'projects:json', '', 'true', 5),
(95, 'default', 'json', 'gen', 'true', 2),
(96, 'default', 'json', 'accountsave', 'true', 2),
(97, 'default', 'json', 'change', 'true', 2),
(102, 'default', 'index', '', 'true', 3),
(103, 'default', 'javascript', '', 'true', 3),
(104, 'default', 'json', '', 'true', 3),
(105, 'default', 'error', '', 'true', 3),
(106, 'default', 'index', 'secure', 'true', 3),
(107, 'default', 'json', 'gen', 'true', 3),
(108, 'default', 'json', 'accountsave', 'true', 3),
(109, 'default', 'json', 'change', 'true', 3),
(261, 'projects', 'projects:javascript', '', 'true', 5),
(260, 'projects', 'projects:index', '', 'true', 5),
(152, 'users', 'users:javascript', 'addsuperadmin', 'false', 5),
(154, 'users', 'users:javascript', 'addsuperadmin', 'true', 6),
(259, 'qualifications', 'qualifications:json', '', 'true', 5),
(156, 'users', 'users:json', 'addsuperadmin', 'true', 6),
(157, 'default', 'json', 'userislogedin', 'false', 1),
(158, 'default', 'json', 'userislogedin', 'true', 2),
(258, 'qualifications', 'qualifications:javascript', '', 'true', 5),
(257, 'qualifications', 'qualifications:index', '', 'true', 5),
(256, 'tes', 'tes:json', '', 'true', 5),
(255, 'tes', 'tes:javascript', '', 'true', 5),
(254, 'tes', 'tes:index', '', 'true', 5),
(253, 'title', 'title:json', '', 'true', 5),
(252, 'title', 'title:javascript', '', 'true', 5),
(251, 'title', 'title:index', '', 'true', 5),
(250, 'toimittaja', 'toimittaja:json', '', 'true', 5),
(249, 'toimittaja', 'toimittaja:javascript', '', 'true', 5),
(248, 'toimittaja', 'toimittaja:index', '', 'true', 5),
(179, 'timesheet', 'timesheet:javascript', '', 'true', 2),
(178, 'timesheet', 'timesheet:json', '', 'true', 2),
(177, 'timesheet', 'timesheet:index', '', 'true', 2),
(247, 'workplaces', 'workplaces:json', '', 'true', 5),
(185, 'timesheet', 'timesheet:index', '', 'false', 3),
(246, 'workplaces', 'workplaces:javascript', '', 'true', 5),
(245, 'workplaces', 'workplaces:index', '', 'true', 5),
(186, 'timesheet', 'timesheet:javascript', '', 'false', 3),
(187, 'timesheet', 'timesheet:json', '', 'false', 3),
(188, 'timesheetscrm', 'timesheetscrm:index', '', 'true', 3),
(189, 'timesheetscrm', 'timesheetscrm:javascript', '', 'true', 3),
(190, 'timesheetscrm', 'timesheetscrm:json', '', 'true', 3),
(244, 'jobseekers', 'jobseekers:json', '', 'true', 5),
(239, 'careers', 'careers:index', '', 'true', 5),
(240, 'careers', 'careers:javascript', '', 'true', 5),
(241, 'careers', 'careers:json', '', 'true', 5),
(242, 'jobseekers', 'jobseekers:index', '', 'true', 5),
(243, 'jobseekers', 'jobseekers:javascript', '', 'true', 5),
(226, 'ostoreskontra', 'ostoreskontra:javascript', '', 'true', 4),
(224, 'ostoreskontra', 'ostoreskontra:index', '', 'true', 4),
(225, 'ostoreskontra', 'ostoreskontra:json', '', 'true', 4),
(203, 'timesheetsarm', 'timesheetsarm:index', '', 'true', 5),
(204, 'timesheetsarm', 'timesheetsarm:javascript', '', 'true', 5),
(205, 'timesheetsarm', 'timesheetsarm:json', '', 'true', 5),
(238, 'timesheetscrm', 'timesheetscrm:javascript', '', 'false', 4),
(237, 'timesheetscrm', 'timesheetscrm:json', '', 'false', 4),
(236, 'timesheetscrm', 'timesheetscrm:index', '', 'false', 4),
(235, 'agreements', 'agreements:json', '', 'true', 5),
(234, 'agreements', 'agreements:javascript', '', 'true', 5),
(233, 'agreements', 'agreements:index', '', 'true', 5),
(232, 'accounts', 'accounts:json', '', 'true', 5),
(231, 'accounts', 'accounts:index', '', 'true', 5),
(230, 'accounts', 'accounts:javascript', '', 'true', 5),
(229, 'users', 'users:javascript', '', 'true', 5),
(228, 'users', 'users:json', '', 'true', 5),
(227, 'users', 'users:index', '', 'true', 5),
(267, 'customers', 'customers:index', '', 'true', 5),
(268, 'customers', 'customers:json', '', 'true', 5),
(269, 'courseagreements', 'courseagreements:index', '', 'true', 5),
(270, 'courseagreements', 'courseagreements:javascript', '', 'true', 5),
(271, 'courseagreements', 'courseagreements:json', '', 'true', 5),
(272, 'timesheetconfig', 'timesheetconfig:index', '', 'true', 5),
(273, 'timesheetconfig', 'timesheetconfig:json', '', 'true', 5),
(274, 'timesheetconfig', 'timesheetconfig:javascript', '', 'true', 5),
(275, 'ostoreskontra', 'ostoreskontra:javascript', 'employeeview', 'false', 4),
(276, 'ostoreskontra', 'ostoreskontra:javascript', 'employeeview', 'true', 5),
(281, 'default', 'json', 'lostpassword', 'true', 1),
(280, 'default', 'javascript', 'lostpassword', 'true', 1),
(282, 'salary', 'salary:index', '', 'true', 5),
(283, 'salary', 'salary:javascript', '', 'true', 5),
(284, 'salary', 'salary:json', '', 'true', 5),
(285, 'erpagreements', 'erpagreements:index', '', 'true', 5),
(286, 'erpagreements', 'erpagreements:json', '', 'true', 5),
(287, 'erpagreements', 'erpagreements:javascript', '', 'true', 5),
(288, 'dailymoney', 'dailymoney:index', '', 'true', 5),
(289, 'dailymoney', 'dailymoney:json', '', 'true', 5),
(290, 'dailymoney', 'dailymoney:javascript', '', 'true', 5);

-- --------------------------------------------------------

--
-- Table structure for table `crm_delivery_address`
--

CREATE TABLE `crm_delivery_address` (
  `delivery_address_id` int(12) NOT NULL,
  `partner_id` int(12) NOT NULL,
  `delivery_address` text NOT NULL,
  `delivery_city` varchar(255) NOT NULL,
  `delivery_postal_code` varchar(80) NOT NULL,
  `delivery_country_language_id` int(12) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_events`
--

CREATE TABLE `crm_events` (
  `event_id` int(12) NOT NULL,
  `lead` int(12) NOT NULL,
  `pipe_line_id` int(12) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_incoterms`
--

CREATE TABLE `crm_incoterms` (
  `incoterm_id` int(12) NOT NULL,
  `incoterm_short` text NOT NULL,
  `incoterm` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_invoice`
--

CREATE TABLE `crm_invoice` (
  `invoice_id` int(12) NOT NULL,
  `order_confirmation_id` int(12) NOT NULL,
  `partner_id` int(12) NOT NULL,
  `client_reference` varchar(255) NOT NULL,
  `status_id` int(12) NOT NULL,
  `incoterm_id` int(12) NOT NULL,
  `incoterm_location` varchar(255) NOT NULL,
  `validity` date DEFAULT NULL,
  `delivery_time` date DEFAULT NULL,
  `total_vat` float NOT NULL,
  `vat_amount` float NOT NULL,
  `total_in_euros` float NOT NULL,
  `p_l_account_number` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_invoice_status`
--

CREATE TABLE `crm_invoice_status` (
  `status_id` int(12) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_languages`
--

CREATE TABLE `crm_languages` (
  `language_id` int(12) NOT NULL,
  `language` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_lead`
--

CREATE TABLE `crm_lead` (
  `lead_id` int(12) NOT NULL,
  `account_number` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_offers`
--

CREATE TABLE `crm_offers` (
  `offer_id` int(12) NOT NULL,
  `partner_id` int(12) NOT NULL,
  `client_reference` varchar(255) NOT NULL,
  `lead` int(12) NOT NULL,
  `status` int(12) NOT NULL,
  `delilvery_address_id` int(12) NOT NULL,
  `payment_terms_id` int(12) NOT NULL,
  `incoterm_id` int(12) NOT NULL,
  `incoterm_location` varchar(255) NOT NULL,
  `validity` date DEFAULT NULL,
  `delivery_time` date DEFAULT NULL,
  `total_vat` float NOT NULL,
  `vat_amount` float NOT NULL,
  `total_in_euros` float NOT NULL,
  `p_l_account_number` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_offer_status`
--

CREATE TABLE `crm_offer_status` (
  `status_id` int(12) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_order_confirmation`
--

CREATE TABLE `crm_order_confirmation` (
  `order confirmation_id` int(12) NOT NULL,
  `offer_id` int(12) NOT NULL,
  `client_reference` varchar(255) NOT NULL,
  `status_id` int(12) NOT NULL,
  `incoterm_id` int(12) NOT NULL,
  `incoterm_location` varchar(255) NOT NULL,
  `validity` date DEFAULT NULL,
  `delivery_time` date DEFAULT NULL,
  `total_vat` float NOT NULL,
  `vat_amount` float NOT NULL,
  `total_in_euros` float NOT NULL,
  `p_l_account_number` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_order_confirmation_status`
--

CREATE TABLE `crm_order_confirmation_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_partners`
--

CREATE TABLE `crm_partners` (
  `accountno` int(12) NOT NULL,
  `cilent_or_supplier_name` varchar(255) NOT NULL,
  `VAT_ID` varchar(80) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `web_site` varchar(255) NOT NULL,
  `post_address` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(80) NOT NULL,
  `information_e_mail` varchar(255) NOT NULL,
  `invoicing_method` enum('Electronic','Paper','E-mail') NOT NULL DEFAULT 'E-mail',
  `language_id` int(12) NOT NULL,
  `e_invoice_operator` varchar(255) NOT NULL,
  `e_invoice_address` text NOT NULL,
  `OVT_ID` varchar(255) NOT NULL,
  `invoicing_e_mail` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `is_client` tinyint(1) NOT NULL,
  `is_supplier` tinyint(1) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_products`
--

CREATE TABLE `crm_products` (
  `product_id` int(12) NOT NULL,
  `product_category` int(12) NOT NULL,
  `product_name_fin` varchar(255) NOT NULL,
  `product_name_eng` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `service_or_product` set('Service','Product') NOT NULL,
  `weight` float NOT NULL,
  `package_size` float NOT NULL,
  `procurement_price` float NOT NULL,
  `sales_price` float NOT NULL,
  `supplier` int(12) NOT NULL,
  `on_stock` int(12) NOT NULL,
  `P_L_account_number` int(12) NOT NULL,
  `VAT` float NOT NULL,
  `unit` int(12) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_products_under_document`
--

CREATE TABLE `crm_products_under_document` (
  `pud_id` int(12) NOT NULL,
  `document_id` int(12) NOT NULL,
  `document_type` enum('Offer','Order_Confirmation','Invoice','Purchase_Order') NOT NULL,
  `amount` float NOT NULL,
  `amount_received_delivered` float NOT NULL,
  `discount` float NOT NULL,
  `discount_euro` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_product_categories`
--

CREATE TABLE `crm_product_categories` (
  `category_id` int(12) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_product_units`
--

CREATE TABLE `crm_product_units` (
  `unit_id` int(12) NOT NULL,
  `unit_name` varchar(80) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_purchase_order_status`
--

CREATE TABLE `crm_purchase_order_status` (
  `status_id` int(12) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_purhcase_order`
--

CREATE TABLE `crm_purhcase_order` (
  `purchase_order_id` int(12) NOT NULL,
  `order_confirmation_id` int(12) NOT NULL,
  `supplier_reference` varchar(255) NOT NULL,
  `status_id` int(12) NOT NULL,
  `incoterms_id` int(12) NOT NULL,
  `incoterm_location` varchar(255) NOT NULL,
  `validity` date DEFAULT NULL,
  `delivery_time` date DEFAULT NULL,
  `total_vat` float NOT NULL,
  `vat_amount` float NOT NULL,
  `total_in_euros` float NOT NULL,
  `p_l_account_number` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crm_sales_pipe_lines`
--

CREATE TABLE `crm_sales_pipe_lines` (
  `pipeline_id` int(12) NOT NULL,
  `pipe_line_name` varchar(255) NOT NULL,
  `pipeline_status_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `erp_agreements`
--

CREATE TABLE `erp_agreements` (
  `aid` int(12) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `erp_agreements`
--

INSERT INTO `erp_agreements` (`aid`, `text`) VALUES
(1, '<p><strong>KUVAUS JA TAVOITE</strong><br>\n  Tämä ohjeistus sisältää Henkilöstöohjeistukset työtehtävittäin sekä työturvallisuusohjeistuksen. Jokaisen työntekijän tulee perehtyä ohjeeseen huolellisesti sekä noudattaa ohjeiden määräyksiä. Ohjeista poikkeamiseen tulee aina hankkia toimitusjohtajalta lupa.</p>\n<p><strong>1	OHJEISTUS HENKILÖSTÖLLE</strong></p>\n<p><strong>KUVAUS</strong></p>\n<p>Tässä kohdassa ohjeistetaan asioita, joista jokaisen työntekijän tulee olla tietoisia ja noudattaa.<br>\n</p>\n<p><strong>TAVOITE</strong></p>\n<p>Yhtenäistää yhtiön henkilöstön toimintamallit ja tehostaa toimintaa työturvallisuusasioista tinkimättä.</p>\n<p> <br>\n  <strong>1.1	Tuntikortin täyttöohjeistus</strong></p>\n<p>Työntekijän tulee kirjata tuntikirjaukset kahden viikon välein tuntikorttiin. </p>\n<p>Tuntikorttien kierrätys: <br>\n  1.	Tuntikortti täytetään yllä mainitun aikavälein työntekijän toimesta. Työntekijän tulee kirjata palkkavaatimuksensa tuntikorttiin työlainsäädännön, työehtosopimuksen ja paikallisten sopimuksien mukaisesti. Työntekijän tulee toimittaa tuntikortti heti palkanlaskujakson päätyttyä.<br>\n  a.	Määrittele tuntikortin täyttämispaikka tähän. Suosittelemme sähköistä järjestelmää.<br>\n  2.	Tuntikortin hyväksyy työntekijän esimies allekirjoittamalla tuntikortin erikseen sovittuun määräaikaan mennessä (määrittele kierron määräaika). Esimiehen tulee tarkastaa tuntikortin sisällön paikkansapitävyys. Esimies toimittaa tuntikortin palkanlaskentaan heti hyväksynnän jälkeen.<br>\n  a.	Määrittele tuntikortin hyväksyntätapa tähän. Suosittelemme sähköistä järjestelmää.<br>\n  3.	Palkanlaskenta laskee ja maksattaa palkat yhtiön palkkakierron mukaisesti, sekä toimittaa palkanlaskun yhteydessä palkkanauhan.<br>\n  a.	Määrittele palkkakierto tähän.<br>\n  b.	Jos tunteja laskutetaan asiakkaalta. Määrittele laskutus tähän.<br>\n  c.	Määrittele palkkanauhan toimitustapa tähän<br>\n  4.	Työntekijä tarkastaa palkkanauhasta palkan oikeellisuuden. Mahdollisissa virheissä työntekijä ottaa yhteyttä palkanlaskentaan palkanlaskennan ja mahdollisen laskutuksen korjaamiseksi.<br>\n  a.	Määrittele palkanlaskennan yhteystiedot tähän</p>\n<p><strong>1.2	Ylityöt</strong></p>\n<p>Ylitöistä tulee aina sopia etukäteen työmaan työnjohdon kanssa. Työntekijän toimiessa henkilöstövuokrauksen ehdoilla asiakkaan työnjohdon alaisuudessa, asiakas voi sopia ylitöitä lain määräämissä rajoissa.<br>\n  Yhtiön omissa töissä esimies sopii ylitöistä henkilöstön kanssa tapauskohtaisesti. Toimihenkilöiden ohjeessa kohdassa 2.3 käsitellään ylitöiden teettämistä tarkemmin.<br>\n  </p>\n<p><strong>1.3	Työterveyshuolto</strong></p>\n<p>Yhtiö Oy:n työntekijöiden työterveydenhuolto on järjestetty yhteistyössä ”Määrittele työterveyspalveluiden tuottaja” kanssa. <br>\n  Ajanvarauksen voi hoitaa sähköisesti ”määrittele ajanvarauskanavat tähän”.<br>\n</p>\n<p><strong>1.4	Työtapaturmavakuutus</strong></p>\n<p>Yhtiö Oy:n työntekijöiden lakisääteinen työtapaturmavakuutus on Määrittele vakuutusyhtiö tähän:ssä vakuutusnumerolla Määrittele vakuutusnumero tähän.<br>\n</p>\n<p><strong>1.5	Sairasloma</strong></p>\n<p>Aikaisella lääkärikäynnillä voimme ennaltaehkäistä pitkittyneitä sairaslomia ja tästä syystä sairaslomista tulee esittää työnantajalle aina lääkärintodistus. <br>\n</p>\n<p><strong>1.5.1	Työntekijän pitkä sairasloma:</strong></p>\n<p>Työntekijän jouduttua pitkälle sairaslomalle, maksaa yhtiö palkkaa alan työehtosopimuksen mukaisen määräajan. <br>\n  Oman voimassaolevan työehtosopimuksen löydät osoitteesta: http://www.finlex.fi/fi/viranomaiset/tyoehto/<br>\n  Jos työehtosopimuksessa ei ole erikseen määritelty palkanmaksuaikaa maksetaan sairausajan palkkaa lain mukaan sairastumispäivältä (jos se työssä oltaessa olisi ollut työntekijän työpäivä) ja sitä seuraaviin yhdeksään arkipäivään (ei lasketa mukaan pyhäpäiviä) sisältyviltä työpäiviltä. Jos työsuhde on työkyvyttömyyden alkamishetkellä kestänyt vähintään yhden kuukauden, työntekijälle maksetaan edellä mainitulta ajanjaksolta täysi palkka. Jos työsuhde on kestänyt alle kuukauden, maksetaan samalta ajanjaksolta puolet palkasta. Jos työntekijällä ei ole työvuoroluetteloon merkittyjä työvuoroja, lasketaan sairausajan palkka toteutuneen, keskimääräisen työajan mukaan. <br>\nPalkanmaksun keskeytettyä maksaa kela sairauspäivärahaa. Sairauspäivärahasta saa lisätietoa osoitteesta: http://www. kela.fi/tyokyvyton-yli-10-paivaa_sairauspaivaraha</p>\n<p><strong>1.6	Tapaturmat ja vaaratilanteet</strong></p>\n<p>Työturvallisuus on kaikkien asia.</p>\n<p>Yhtiön Oy:n työntekijöiden tulee tehdä työmaalla sattuneesta vaaratilanteesta sekä tapaturmasta ilmoitus työsuojelupäällikölle. <br>\n  •	Jokaisesta vaaratilanteesta tehdystä ilmoituksesta työntekijälle kirjataan 20 euron kertakorvaus seuraavaan palkkakiertoon<br>\n  o	Vaaratilanne on tapahtuma, joka olisi voinut johtaa henkilö- tai materiaalivahinkoihin<br>\n  o	Ilmoitus tehtävä sähköpostitse osoitteeseen määrittele sähköpostiosoite tähän.<br>\n  o	Ilmoituksen tulee sisältää tiedot vaaratilanteesta sekä kehitysehdotuksen vaaratilanteen välttämiseksi<br>\n  •	Tapaturmailmoitukselle on oma lomake<br>\n  o	Tapaturman ei tarvitse olla sairaalahoitoa vaativa, jotta siitä tuli tehdä ilmoitus</p>\n<p>Sähkötapaturmista välitön ilmoitus sähkötyönjohtajalle ja työtapaturmista välitön ilmoitus työsuojelupäällikölle. </p>\n<p>Jokainen ilmoitus edesauttaa turvallisemman työympäristön kehittämisessä ja ehkäisee mahdollisia työtapaturmia. Tavoitteena on poistaa kaikki vaaratilanteet ja tapaturmat työmaalta.</p>\n<p>Lisäohjeita:<br>\n  Määrittele yhteystiedot tähän<br>\n</p>\n<p><strong>1.6.1	Tapaturmalomakkeen täyttöohjeistus</strong></p>\n<p>Tee tapaturmailmoitus huolellisesti. Huolella ja oikein täytetty tapaturmailmoituslomake helpottaa asian nopeaa käsittelyä sekä auttaa ehkäisemään mahdollisia tulevia tapaturmia. </p>\n<p>Jos tapaturmaan liittyy monta henkilöä, jokainen heistä täyttää oman lomakkeen ja esittää näkemyksensä tapaturmasta.</p>\n<p>Lomakkeen kohdat: </p>\n<p>•	Tapahtuma / Tilanne: Mitä on sattunut (esim. tapaturma, ruhjevamma, lievä loukkaantuminen…)<br>\n  •	Vahingoittuneen nimi: Kuka vahingoittui tapaturmassa <br>\n  •	Päiväys: Milloin tapaturma sattui<br>\n  •	Tapahtumapaikka / Osasto: Tarkka selvitys missä tapaturma tapahtui<br>\n  •	Mitä tapahtui: Yksityiskohtainen oman näkökulman selostus tapahtuneesta (vahingoittunut, vahingon aiheuttaja, silminnäkijä…) <br>\n  •	Miksi tapaturma sattui: Henkilökohtainen analyysi mitkä asiat vaikuttivat siihen, että tapaturma syntyi (esim. häiriötekijät, väärät varusteet, kommunikointi, perehdytyksen vajeellisuus…) <br>\n  •	Miten vastaava tapahtuma/tilanne voitaisiin jatkossa estää: Analyysi miten työntekijä voi itse vaikuttaa, ettei tapahtuma toistu sekä arvio siitä, että miten työnantaja ja tapaturman toiset osapuolet voivat edesauttaa tapaturman välttämisessä tulevaisuudessa<br>\n  •	Sovitut toimenpiteet: Mitä asian korjaamiseksi on tehty ja ketkä ovat osallisina toimenpiteisiin <br>\n  •	Aikataulu: Milloin sovitut asiat ovat tehtyinä<br>\n  •	Vastuuhenkilö: Nimetään vastuuhenkilö, joka pitää huolta, että sovitut toimenpiteet tulevat tehdyksi (vastuuhenkilö työmaalla, työsuojelupäällikkö…)<br>\n  •	Jakelu: Raportin vastaanottaja täyttää<br>\n  •	Käsitelty: Raportin vastaanottaja täyttää ja kommentoi raporttia ilmoittajalle<br>\n  <br>\n  <strong>1.7	Työnkuittauslomakkeen täyttöohjeistus</strong></p>\n<p>Työnkuittauslomake täytetään vain tuntitöissä ja lisätöissä. Jos et ole ennen käyttänyt työnkuittauslomaketta ole yhteydessä toimitusjohtajaan ohjeistuksen ja toimitapojen läpikäymistä varten.</p>\n<p>Täytä vähintään seuraavat kohdat: </p>\n<p>o	Asiakkaan nimi: Asiakkaan nimi<br>\n  o	Laskutusosoite: Asiakkaan antama laskutusosoite<br>\n  o	Työntekijä: Oma nimi<br>\n  o	Viite/Merkki: Projektinumero<br>\n  o	Tuntihinta: Tämä pitää täyttää, jos työmaa tehdään tuntilaskutuksena<br>\n  o	PVM: Päivämäärä(t) jolloin työskennelty<br>\n  o	Alkoi klo: Kellonaika jolloin työ alkoi<br>\n  o	Loppui klo: Kellonaika jolloin työ päättyi<br>\n  o	Tehty työ: Mitä työmaalla tehty kyseisenä päivänä<br>\n  o	KP: Kustannuspaikka (projektinumeron kaksi ensimmäistä numeroa)<br>\n  o	Alanro: Projektinumeron loppuosa<br>\n  o	Tunnit: Montako tuntia työskenneltiin työmaalla kyseisenä päivänä<br>\n  o	50%: Ylityötunnit jotka ylittävät 0-2 tuntia normaalityöajan, sovittava työmaapäällikön kanssa<br>\n  o	100%: Ylityötunnit jotka ylittävät yli 2 tuntia normaalityöajan, sovittava työmaapäällikön kanssa<br>\n  o	Muut lisät: Kilometrikorvaukset, päivärahat jne. (jos oikeutettu kyseenomaisiin lisiin)<br>\n  o	Materiaalit: Käytetyt materiaalit ja määrät<br>\n  o	Tuotenimike: Tarkka tuotteen nimike ja kokotieto<br>\n  o	Kpl: Tuotteen metri-, neliö- tai kappalemäärä<br>\n  o	A-hinta: Tuotteen metri-, neliö- tai kappalehinta<br>\n  <br>\n  <strong>1.8	Sosiaalisen median –ohjeistus</strong></p>\n<p>Internet ja sosiaalinen media (Facebook, Twitter, Google+, Instagram jne.) ovat julkisia paikkoja, jonne päivittäessä tietoja pitää ottaa huomioon markkinoinnin ja tietosuojan näkökulmat. Sosiaaliseen mediaan tehtyjä päivityksiä kannattaa verrata esimerkiksi lehtijulkaisuun – mitä et kirjoittaisi lehteen, älä kirjoita myöskään sosiaalisen mediaan tai internetiin. <br>\n  Yhtiön linjauksen mukaan seuraavia asioita ei tule internetissä julkaista: <br>\n  Älä hauku tai arvostele työnantajaa<br>\n  •	Jos asiat eivät ole kunnossa, ota ensisijaisesti yhteyttä esimieheesi ja keskustele hänen kanssaan asiasta. Jos asia ei tällä ratkea, ole yhteydessä toimitusjohtajaan.</p>\n<p>Älä hauku tai arvostele kollegoitasi, esimiehiäsi tai alaisia<br>\n  •	Työpaikan asiat selvitetään aina sisäisesti. Julkinen arvostelu ei ratkaise ongelmaa vaan todennäköisesti pahentaa sitä. Näissä erotuomarina toimii lähin esimiehesi tai toimitusjohtaja, ei sosiaalinen media.</p>\n<p>Älä hauku tai arvostele asiakkaita<br>\n  •	Asiakkaan haukkumista näkee paljonkin sosiaalisessa mediassa, asiakas on kuitenkin lopulta se, joka palkkasi maksaa. Ottaisitko itse töihin tekijän, joka arvostelee sinua julkisesti?</p>\n<p>Älä hauku tai arvostele kilpailijoita<br>\n  •	Kilpailijoiden mustamaalaaminen yleensä aiheuttaa vastareaktion ja kilpailija helposti alkaa arvostella myös meidän yhtiötämme.<br>\n  •	Parhaimmassa tapauksessa julkisen imagon puhdistamiseen menee omalta työyhteisöltäsi suuri työmäärä, mutta pahimmassa tapauksessa tähän joudutaan palkkaamaan ammattilaisia. Yhtiöllämme ei ole yksinkertaisesti varaa lähteä taistelemaan kilpailijoiden kanssa maineesta median kautta. Maine tehdään työllä, ei muita arvostelemalla.<br>\n  •	Kilpailijan työntekijät ovat myös alan ammattilaisia, jotka voivat joskus olla meille voimavara. Lähtisitkö sinä töihin yhtiöön, jonka henkilöstö on sinua arvostellut julkisesti? </p>\n<p>Yksinkertaisesti sosiaalisessa mediassa tai internetissä töistä kertoessa keskitytään omaan toimintaan ja kehutaan oman yhtiön toimintaa. Tällöin sosiaalisessa mediassa ja internetissä voidaan saada aikaan positiivinen mielikuva yhtiöstä ja näin ollen saada lisää menestystä aikaiseksi. </p>\n<p>Yksinkertainen sääntö sosiaalisessa mediassa ja internetissä on: älä hauku tai arvostele ketään. <br>\n  Töihin liittyen tämä on yhtiön virallinen ohjeistus ja näin ollen kaikkien on sitä noudatettava. Ohjeistuksella ei haluta rajoittaa yksilön sananvapautta tai vapautta ilmaista itseään, vaan saada jokainen harkitsemaan työhönsä liittyvien tietojen julkaisemisen mahdolliset seuraukset ennen tietojen julkaisemista.<br>\n  </p>\n<p><strong>1.9	Lomat</strong></p>\n<p>Lomat yhtiössä myöntää aina esimies kirjallisesti. Työntekijä toimittaa vähintään kuukautta ennen haluamaansa loma-ajankohtaa kirjallisen anomuksen esimiehelleen. <br>\n  Lomien täsmällisellä sopimisella pyritään tasa-arvoistamaan henkilöstön lomia ja takaamaan riittävä suunnitteluaika yhtiön henkilöstöhallinnossa.<br>\n  Asiakkailla ei ole edes henkilöstövuokrauksena tehtävissä töissä oikeutta myöntää yhtiömme henkilöstölle lomia. Asiakkaan kanssa sovitut lomat katsotaan luvattomiksi poissaoloiksi.<br>\n  Jos loma-ajankohta on kiiretapauksen johdosta alle kuukauden sisällä, on tästä sovittava erikseen soittamalla henkilöstöjohtajale. <br>\n</p>\n<p><strong>2	OHJEISTUS TOIMIHENKILÖILLE</strong></p>\n<p><strong>KUVAUS</strong></p>\n<p>Tässä kohdassa ohjeistetaan asioita, joista yhtiön toimihenkilöstön tulee olla tietoisia ja noudattaa.<br>\n</p>\n<p><strong>TAVOITE</strong></p>\n<p>Yhtenäistää yhtiön henkilöstön toimihenkilöiden toimintamallit ja tehostaa toimintaa työturvallisuusasioista tinkimättä.<br>\n  <br>\n  <strong>2.1	Pätevyydet</strong></p>\n<p>Henkilöstön pätevyyksien tulee aina vastata alalla olevien lakien, määräysten ja käytössä olevien standardien mukaisuutta.<br>\n  Toimihenkilöiden tulee selvittää työn vaatimat pätevyydet ja varmistaa, että käytettävä henkilöstö täyttää pätevyysvaatimukset.<br>\n  </p>\n<p><strong>2.2	Palkankorotukset ja bonuspalkkiot</strong></p>\n<p>Henkilöstön palkankorotus- ja bonuspalkkioprosessi on seuraava<br>\n  1.	Toimihenkilö esittää palkankorotusta tai bonuspalkkiota toimitusjohtajalle<br>\n  a.	Kirjallisesti sähköpostitse<br>\n  i.	Sisältää perustelut palkankorotukselle tai bonuspalkkiolle<br>\n  2.	Toimitusjohtaja hyväksyy/hylkää palkankorotuksen tai bonuspalkkion <br>\na.	Hyväksymisen jälkeen toimitusjohtaja ilmoittaa palkankorotuksesta tai bonuspalkkiosta palkanlaskentaan</p>\n<p>Palkankorotuksen perusteet<br>\n  •	TES-palkkaluokat<br>\n  •	Henkilökohtainen palkanosuus<br>\n  •	Yhtiön taloudelliset toimintaedellytykset ja kilpailukyky palkankorotuksen jälkeen<br>\n  o	Yhtiö ei halua irtisanoa henkilöstöään taloudellisiin ja tuotannollisiin syihin vedoten palkankorotuksen jälkeen<br>\n  o	Palkat tulee olla linjassa työtehtävien mukaan<br>\n  	Yhden henkilön palkankorotus voidaan katsoa koko henkilöstöä koskevaksi<br>\n  </p>\n<p><strong>2.3	Ylityöt</strong></p>\n<p>Ylitöiden teettämistä tulisi välttää seuraavista syistä <br>\n  •	Ylityöt synnyttävät aina prosentuaalisesti enemmän kustannuksia kuin sen aikana tehty työ nostattaa prosentuaalisesti tuotantoa<br>\n  o	Kilpailukyky heikkenee  <br>\n  •	Ylityöt tehdään usein samojen henkilöiden toimesta<br>\n  o	Kyseisten henkilöiden fyysinen rasitus ja henkinen stressi kasvavat<br>\n  •	Ylitöitä teettämällä yhtiö ei kykene kasvattamaan osaajamääräänsä<br>\n  •	Ylitöiden teettäminen on rajoitettu lainsäädännössä<br>\n  o	Ylityöt tulee kohdistaa aina äärimmäiseen tarpeeseen<br>\n	Yhtiöllä täytyy olla aina mahdollisuus teettää ylitöitä, kun todellinen tarve syntyy</p>\n<p>Yhtiössä on käytössä valvontamekanismi ylitöiden teettämisen suhteen<br>\n  •	Mahdollistaa henkilöstötarpeiden kartoittamisen<br>\n  •	Yhtiö kehittyy projektien kiireavun oikeaoppisessa käytössä<br>\n  •	Tarjoaa yhtiön johdolle tietoa ylitöiden käytöstä<br>\n  o	Mahdollistaa paremman resurssisuunnittelun</p>\n<p>Valvontamekanismiin kuuluu ylitöiden tekemisen lupapyyntö seuraavien rajojen ylittyessä:<br>\n  •	Projektipäälliköiden tekemän ylityön osalta<br>\n  o	5 viikoittaisen ylityötunnin ylittämisestä lupa toimitusjohtajalta<br>\n  •	Työmaapäällikön tekemän ylityön osalta<br>\n  o	5 viikoittaisen ylityötunnin ylittämisestä lupa projektipäälliköltä <br>\n  •	Asentajan tekemän ylityön osalta<br>\n  o	5 viikoittaisen ylityötunnin ylittämisestä lupa työmaapäälliköltä  <br>\n  •	Kenen tahansa henkilön<br>\n  o	yli 10 viikoittaisen ylityötunnin ylittämisestä lupa toimitusjohtajalta<br>\n  </p>\n<p><strong>2.4	Työkalujen hallinta</strong></p>\n<p>Työmaalla olevat työkalut tulee aina palauttaa yhtiön lähimpään toimipisteeseen välittömästi käyttötarpeen päättymisen jälkeen.<br>\n•	Työkalut tulee palauttaa yhtiön lähimpään toimipisteeseen myös siinä tapauksessa, jos työkaluja ei käytetä työmaalla kuukauden mittaisella ajanjaksolla</p>\n<p>Jos samaa työkalua samanaikaisesti tarvitaan kahdella eri työmaalla, työkalun käytöstä yhteistyössä sopivat työmaiden toimihenkilöt.<br>\n  </p>\n<p><strong>2.5	Luottopäätökset</strong></p>\n<p>Asiakkaasta tulee ottaa aina luottopäätös<br>\n  •	Luottopäätöksen antaa talousjohtaja<br>\n  •	Luottopäätöksen rajoja tulee noudattaa<br>\n  •	Toimihenkilön ylittäessä rajat, tai jättäessä luottopäätöksen ottamatta vastaan, vastaa kyseinen henkilö henkilökohtaisesti aiheutuneista vahingoista<br>\n</p>\n<p><strong>2.6	Urakkalaskenta</strong></p>\n<p>Urakat lasketaan yhteistyössä <br>\n•	Tarjouspäällikkö ja projektipäälliköt käyttävät henkilöstöä apuna urakkalaskennassa</p>\n<p>Lopullisen tarkistuksen ja tarjouksen tekee tarjouspäällikkö.<br>\n  </p>\n<p><strong>2.6.1	Tarjoamatta jätetyt urakat</strong></p>\n<p>Jos projektipäällikön/työmaapäällikön mielestä yhtiöllä ei ole edellytyksiä toteuttaa tarjouspyynnön hanketta, tulee tarjoamatta jättämisestä informoida aina toimitusjohtajaa<br>\n  •	Asia tulee esittää tarjouspäällikölle sähköpostitse<br>\no	Sähköpostin sisältö käsitellään keskustelemalla</p>\n<p><strong>2.6.2	Hävityt urakat</strong></p>\n<p>Hävityistä urakoista tulee aina tehdä ilmoitus sähköpostitse tarjouspäällikölle. Sähköpostin tulee sisältää vähintään seuraavat tiedot:<br>\n  •	Urakan sisältö<br>\n  •	Urakan voittanut yhtiö<br>\n  •	Urakan voittaneen yhtiön tarjoussumma <br>\n  •	Syyt urakan häviämiselle<br>\n  •	Tarjouspyyntömateriaali liitteenä</p>\n<p>Yhtiössä halutaan käsitellä urakan häviämisen syyt, jotta toimintaa pystytään kehittämään seuraavaa tarjouslaskentaa varten.<br>\n</p>\n<p><strong>2.6.3	Urakkapalkkausmalli työntekijöille</strong></p>\n<p>Työntekijöiden kanssa urakkapalkkauksesta sovittaessa käytetään aina urakkapalkkaussopimuspohjaa<br>\n  •	Toimihenkilöt voivat käyttää urakkapalkkaussopimuspohjaa omissa projekteissaan<br>\n  o	Projektipäällikkö laatii sopimukset työntekijöiden kanssa<br>\n  o	Työmaan työmaapäällikkö esittää halutessaan toiveen urakkapalkkausmallista projektipäällikölle</p>\n<p>Urakka sidotaan aina työvaiheeseen, johon sisällytetään urakan työtunnit.<br>\n  Urakan valmistuttua nopeammin kuin urakkaan oli työntekijälle laskettu tunteja, voi työntekijä:<br>\n  1.	pitää vapaata, jolloin tunnit maksetaan urakan mukaisesti tai<br>\n  2.	jatkaa töitä, jolloin hänelle maksetaan urakan osuus yksinkertaisina tunteina</p>\n<p>Jos urakan tunnit tulevat täyteen, mutta työ ei ole valmis, työntekijän palkka maksetaan normaalisti työehtosopimuksen mukaisesti<br>\n  •	Työntekijällä on aina työtunteihin perustuva takuupalkka</p>\n<p>Urakkamallit tulee perustua laskennassa käytettyihin työtunteihin. Laskennan työtuntimäärää ei saa urakassa ylittää ilman toimitusjohtajan lupaa<br>\n  •	Seurannan avulla havaitaan mahdolliset virhelaskelmat<br>\n  o	Yhtiön urakkalaskenta kehittyy<br>\n•	Estetään liian suurien urakkatuntimäärien kirjaaminen</p>\n<p>LAATU on tärkeä osa urakkamallin toimivuutta. Urakkapalkkausmalli ei saa missään nimessä aiheuttaa laatuongelmia. Urakka on valmis vasta, kun työnlaatu vastaa asetettuja kriteerejä. Työmaapäällikkö tarkastaa sekä hyväksyy tehdyn työn laadun urakan valmistuttua<br>\n  •	Työntekijöiden tulee olla tietoisia ja ymmärtää laatuun liittyvät vaatimukset ennen työn aloittamista<br>\n  •	Jos laatuongelmia ilmenee, urakkapalkkausmallista luovutaan<br>\n  </p>\n<p><strong>2.7	Projektit</strong></p>\n<p>Projektiprosessi<br>\n  •	Kysely<br>\n  o	Verkkolomake<br>\n  o	Sähköposti<br>\n  o	Puhelin<br>\n  	Vaihde ohjaa tarvittaessa kyselyn projektipäällikölle<br>\n  •	Yhteydenotto ja katselmus<br>\n  o	Projektipäällikkö ottaa yhteyden asiakkaaseen ja sopii katselmusajankohdan<br>\n  •	Tarjous<br>\n  o	Ennen tarjouksen lähettämistä projektipäällikkö ottaa luottopäätöksen yhtiön toimitusjohtajalta<br>\n  o	Projektipäällikkö laskee tarjouksen ja tarjoaa kohteen töitä kirjallisesti yhtiön käyttämän ohjelman kautta<br>\n  •	Tilaus ja tilausvahvistus<br>\n  o	Projektipäällikkö ottaa tilauksen vastaan<br>\n  	Projektipäällikkö aikatauluttaa urakan ja hyväksyttää aikataulutetun urakan toimitusjohtajalla<br>\n  	Hyväksytty projekti vahvistetaan tilaajalle kirjallisesti yhtiön käyttämän järjestelmän kautta<br>\n  o	Projektipäällikkö täyttää projektilomakkeen ja avaa projektinumeron<br>\n  	Projektinumeroa käytettävä kaikissa projektiin liittyvissä asiakirjoissa<br>\n  •	Työnhoito<br>\n  o	Projektipäällikkö ja työmaapäällikkö(t) vastaavat työmaasta ohjeistuksen mukaisesti<br>\n  	Työjäljen oltava aina laadukasta<br>\n  o	Myöhästymisistä välitön raportointi sähköpostitse osoitteeseen määrittele sähköposti<br>\n  o	Poikkeuksista ja reklamaatioista välitön raportointi sähköpostitse osoitteeseen määrittele sähköposti<br>\n  •	Valmistuminen ja laskutus<br>\n  o	Projektipäällikkö laskuttaa asiakasta yhtiön käyttämän järjestelmän kautta maksupostien mukaisesti<br>\n  o	Projektipäällikkö ilmoittaa projektin valmistumisesta toimitusjohtajalle<br>\no	Projektipäällikkö arkistoi dokumentit</p>\n<p><strong>2.7.1	Projektinumerointi</strong></p>\n<p>Projektinumeroa tulee käyttää kaikissa projektiin liittyvissä asiakirjoissa. Projektinumeroinnin avulla toteutetaan seurantaa, joka mahdollistaa kannattavan liiketoiminnan<br>\n  •	Mitkä ovat projektin todelliset syntyneet kustannukset ja tulot<br>\n  o	Projektilaskenta kehittyy<br>\n  	Tunnistetaan mahdolliset virheet, joita tehty projektilaskennassa<br>\n  o	Liiketoiminnan sekä työllistämisen jatkuminen mahdollistetaan<br>\n  	Yhtiölle mahdollistetaan kasvun edellytykset myös taloudellisesti</p>\n<p>Projektinumero koostuu kahdesta osasta ja kuusi merkkiä pitkä<br>\n  •	Kaksinumeroinen alkuosa<br>\n  o	Esimerkiksi kustannuspaikka 2 Urakat on projektinumeroinnin alkuosa 02<br>\n  •	Nelimerkkinen loppuosa<br>\n  o	Yksi aakkonen: P = Projektit<br>\n  o	Kolme itse määriteltyä numeroa: 001<br>\n  •	ESIMERKIKSI: 02P001</p>\n<p>Ilman asianmukaisesti projektinumeroinnilla merkittyjä asiakirjoja joudutaan selvittämään jälkeenpäin<br>\n  •	Synnyttää yhtiössä ylimääräisiä kustannuksia<br>\n  o	Paine hintojen nostamiseen kasvaa<br>\n  	Mahdollinen asiakkaiden menettäminen<br>\n  	Liiketoiminnan jatkumisen vaarantuminen</p>\n<p><strong>2.7.2	Pienprojektit</strong></p>\n<p>Pienprojekti on alle 3000 euron projekti<br>\n•	Suuremmista hankkeista tulee avata oma projektinumero projektilomakkeella</p>\n<p>Pienprojektien työt alkavat siitä hetkestä, kun työkohteeseen lähdetään<br>\n  o	Kertokaa asiakkaalle puhelimitse vähintään seuraavat asiat selkeästi<br>\n  	hinnoittelu<br>\n  	milloin työmaalle lähdetään<br>\n  	milloin työmaalle saavutaan<br>\n  	laskutettava työaika alkaa työntekijän lähtiessä toimipisteestä<br>\n  	laskutettava työaika päättyy työntekijän palattua toimipisteeseen</p>\n<p>Projektipäällikkö/työmaapäällikkö luo laskut työnkuittauslomakkeen perusteella<br>\n  o	Ohjeistakaa henkilöstä täyttämään työnkuittauslomakkeet oikein<br>\n  	Sisältäen mm. Y-tunnuksen tai henkilötunnuksen<br>\n  	Lomakkeeseen merkataan kenen ja mitä tuotteita työmaalla on käytetty<br>\n  o	Pientyön perustuntilaskutus on aina vähintään 52 euroa / tunti + alv 24 %<br>\n  	Ylityöt ja kulukorvaukset työaikalain ja noudatettavan työehtosopimuksen mukaan.<br>\n  •	Ylityö 50% kerroin 1,5<br>\n  •	Ylityö 100% kerroin 2,0<br>\n  •	Ylityö 200% kerroin 3,0<br>\n  •	Ylityö 300% kerroin 4,0<br>\n  •	Muut lisät laskutetaan kertoimella 1,75<br>\n  •	Muut kulut, päivärahat, matkakulut ja majoitus laskutetaan kertoimella 1,05<br>\n  o	Laskutus vähintään kerran viikossa.<br>\n  o	Tuotehinnat tukkurihinnaston mukaan, ei alennuksia ilman toimitusjohtajan lupaa.<br>\n  o	Projektipäällikkö/työmaapäällikkö arkistoi työnkuittauslomakkeen yhtiön käytössä olevaan järjestelmään<br>\n</p>\n<p><strong>2.7.3	Ohje projektin sisäisestä kommunikaatiosta</strong></p>\n<p>Kaikki projektin toimihenkilöt pidetään ajan tasalla projektin etenemisestä päivittämällä projektikansiota<br>\n  •	Projektikansio on yhtiön käytössä olevassa arkistointi järjestelmässä<br>\n•	Arkistoon tulee tallentaa kaikki projektin tietomateriaali </p>\n<p>Kaikki projektiin liittyvät sähköpostikeskustelut tulee toimittaa kopiona jokaiselle projektin toimihenkilölle<br>\n  •	Sähköposti osoitetaan henkilölle, jota kyseinen sähköposti koskee<br>\n  •	Sähköposti lähetetään kopiona kaikille muille projektin toimihenkilöille<br>\n  2.7.4	Projektilaskennan materiaalin kilpailutus</p>\n<p>Projektien (yli 3000 euroa) materiaalit projektipäällikkö/työmaapäällikkö kilpailuttaa projektilaskennan yhteydessä.<br>\n  Materiaalin kilpailutuksen prosessi:<br>\n  •	Projektipäällikkö/työmaapäällikkö massoittaa urakkamateriaalit<br>\n  •	Projektipäällikkö/työmaapäällikkö kilpailuttaa materiaalit lähettämällä tarjouspyynnön vähintään kolmelle eri toimittajalle<br>\n  o	Tiedot yhdessä sähköpostissa<br>\n  o	Tarjouspyynnön lähetys mahdollisimman nopeasti<br>\n  o	Tarjouspyynnön tulee sisältää viimeinen tarjouksen jättämispäivämäärä toimittajien tiedoksi<br>\n  •	Projektipäällikkö/työmaapäällikkö täyttää tarjousten halvimmat hinnat projektilaskennan materiaalitaulukkoon<br>\n  o	Projektipäällikkö/työmaapäällikkö tarkastaa materiaalilistan ja hinnat<br>\n  •	Toimitusjohtaja laskee viimeisen katteen ja tarjoushinnan sekä antaa kirjallisen luvan tehdä tarjous asiakkaalle kirjallisesti yhtiön järjestelmän kautta</p>\n<p><strong>2.7.5	Projektin hankintojen kilpailutus</strong></p>\n<p>Hankinnat kilpailutetaan uudestaan projektin saamisen jälkeen<br>\n•	Vähintään kolmen toimittajan kesken</p>\n<p>Tarjous vastaanotetaan aina kirjallisesti. Tarjouksesta tulee vähintään ilmetä seuraavat asiat<br>\n  •	hinta<br>\n  •	toimitusehto<br>\n  •	toimitusaika</p>\n<p>Tarpeet tulee määritellä mahdollisimman selkeästi kirjalliseen tarjouspyyntöön<br>\n  •	Vastaanotetut tarjoukset ovat vertailukelpoisia keskenään</p>\n<p>Tarjouspyyntöön tulee kirjata tarjouksen viimeinen palautuspäivä<br>\n  •	Aikarajan jälkeen tulleita tarjouksia ei enää hyväksytä<br>\n  o	Poikkeuksena erittäin painava syy<br>\n  •	Päämiehet oppivat täsmällisyyteen<br>\n  o	Yhtiö kykenee järjestämään omat työnsä helpommin</p>\n<p>Jos tarjouksessa viitataan yleisiin toimitusehtoihin, tulee nämä olla myös kirjallisesti toimitettuna tarjouksen yhteydessä.<br>\n  Suullisia tai vajavaisia tarjouksia ei oteta huomioon.</p>\n<p>Kaikki tarjouspyyntöön liittyvät lisäkysymykset tulee vastaanottaa sähköpostitse <br>\n  •	Kirjoitettu vastaus lähetetään aina sähköpostitse kaikille toimittajille, joille tarjouspyyntö on lähetetty<br>\n  o	Sähköposti sisältää kysymyksen sekä vastauksen<br>\n  •	Eri toimittajien kanssa puhelimitse keskustellut asiat pyydetään myös sähköpostitse<br>\n  o	Kirjallinen todistus sovituista asioista<br>\n  o	Kysymykset ja vastaukset jaetaan myös muille tarjouspyynnön vastaanottaneille toimijoille<br>\n</p>\n<p><strong>2.8	Ostot</strong></p>\n<p>Ostot suoritetaan projektipäällikön/työmaapäällikön toimesta aina yhtiön käytössä olevan järjestelmän kautta (ostotilaus)<br>\n  •	Poikkeus materiaalien osalta: vanhoilta sopimustoimittajilta voidaan hakea pienempiä tilauksia jo valmiiksi sovituin hinnoin 300 euroon asti<br>\n  o	Pienprojektit tai työmaalla esiintyneen nopean tarpeen takia<br>\n  •	Myös alihankintatyöstö tulee tehdä aina ja poikkeuksetta ostotilaus <br>\n  o	Tilausehdoissamme käsittelemme työnjälkeä, työmaavastuita jne.<br>\n  	Kyseiset asiat ovat tärkeitä asioita alihankkijoiden kanssa toimiessa, varsinkin jos ongelmia työmaalla alkaa ilmetä<br>\n  •	Urakkatöistä tehtävä erikseen ostotilaus alihankkijalle<br>\n  o	Selkeästi määriteltynä tehtävät työt ja urakan sisältö</p>\n<p>Tilaaminen ilman hintatietoa ei ole missään tapauksessa hyväksyttävää. Tuotteesta ja ehdoista tulee aina olla kirjallinen ostotilaus yhtiön käytössä olevan järjestelmän kautta.<br>\n  Ainoastaan työmaan projektipäällikkö/työmaapäällikkö voi tilata tuotteita tai palveluita työmaalle<br>\n  •	Muun henkilöstön tekemät tilaukset tullaan katsomaan tilaajan henkilökohtaiseksi tilaukseksi <br>\n  2.8.1	Toimittajien tilinavaukset </p>\n<p>Toimittajille tulee aina avata tili tämän kohdan mukaisin rajoituksin.<br>\n  Maksuehdon tulee olla vähinään 30 päivää netto<br>\n  •	Tavoitteena keskiarvo 45 päivää netto<br>\n  o	Maksuehtoneuvottelut aloitetaan asiakkaan kanssa 90 päivän maksuehdosta<br>\n  •	Yhtiön kassavarat paranevat ja yhtiön kasvulla on paremmat taloudelliset edellytykset<br>\n  •	Maksuehdon alituksesta tulee aina pyytää lupa toimitusjohtajalta</p>\n<p>Konkreettisen tilinavauksen tekee ostopäällikkö toimihenkilön pyynnöstä.<br>\n</p>\n<p><strong>2.8.2	Tarjoukset</strong></p>\n<p>Tarjouksen teko-oikeus on erikseen nimetyillä henkilöillä.<br>\n  Tarjoukseen tulee vastata viiden (5) päivän sisällä tarjouspyynnön vastaanottamisesta tai vähintään vuorokautta ennen tarjouksen jättöajankohtaa ja varmistaa että asiakas on vastaanottanut tarjouksen ajoissa. <br>\n  Tarjous tulee tehdä ohjeistetun tarjousprosessin mukaisesti. Tarjous tulee jättää asiakkaalle kirjallisena yhtiön käytössä olevan järjestelmän kautta<br>\n  •	Tarjouksia ei voi tehdä suullisesti yhtiön nimissä<br>\n  o	Suullisista tarjouksista vastaa aina tarjouksen tekijä henkilökohtaisesti<br>\n  <br>\n  Urakkatarjoukset hyväksytetään aina tarjouspäälliköllä ennen tarjouksen lähettämistä.<br>\n  </p>\n<p><strong>2.9	Tilausvahvistukset</strong></p>\n<p>Tilausvahvistuksien teko-oikeus on erikseen nimetyillä henkilöillä.<br>\n  Tilausvahvistuksia tehdessä tulee aina noudattaa ohjeistettua prosessia. Yhtiön tekemistä töistä on tehtävä aina kirjallinen tilausvahvistus yhtiön käytössä olevan järjestelmän kautta<br>\n  •	Kirjallinen tilausvahvistus vähentää huomattavasti reklamaatioita<br>\n  •	Suullisista tilausvahvistuksista vastaan aina tilausvahvistuksen tekijä henkilökohtaisesti<br>\n  <br>\n  Tilausvahvistukseen tulee kirjata mahdollisimman tarkasti vähintään seuraavat asiat<br>\n  •	Työn sisältö<br>\n  •	Urakan rajat<br>\n  o	Urakoita koskevia tilausvahvistukset hyväksytetään aina ennen lähettämistä toimitusjohtajalla<br>\n2.10	Laskutus</p>\n<p>Laskutus heti kun mahdollista, kuitenkin vähintään kerran viikossa tai projektien laskutuspostien mukaisesti<br>\n  •	Tavoitteena mahdollisimman nopea laskutus, joka mahdollistaa yhtiön kasvun taloudelliset edellytykset<br>\n  •	Lisätyöt laskutetaan viikoittain.</p>\n<p>2.10.1	Laskujen asiatarkastus</p>\n<p>Toimihenkilöt vastaavat laskun asiatarkastuksesta. Laskusta tulee tarkistaa vähintään seuraavat asiat:<br>\n  •	Yhtiön tarkastus<br>\n  o	Lasku tullut oikeaan yhtiöön<br>\n  o	Nimi ja Y-tunnus oltava oikein<br>\n  •	Viitteen tarkastus<br>\n  o	Oikea projektinumero<br>\n  •	Yhteyshenkilön tarkastus<br>\n  o	Oikea yhteyshenkilö<br>\n  •	Maksuehdon tarkastus<br>\n  o	Oikea maksuehto <br>\n  •	Hinnat sovitut<br>\n  o	Työstä ja materiaalista on tehty ostotilaus<br>\n  •	Työn sisältö kirjattu selkeästi<br>\n  o	Kuka tehnyt<br>\n  o	Koska tehty<br>\n  o	Mitä tehty<br>\n  o	Kuka tarkastanut ja miten<br>\n  	Liitteenä kopio työntekijän tuntikortista</p>\n<p>Alihankkijoiden työ tarkastetaan ja hyväksytään erikseen ennen laskutuslupaa työkohteessa tilauksen tehneen henkilön toimesta.<br>\n  2.10.2	Reklamaatiot</p>\n<p>Reklamaatiot kirjallisesti sähköpostitse osoitteeseen määrittele sähköposti tähän<br>\n  •	Sähköposti sisältää vähintään:<br>\n  o	Reklamaation tekijän yhteystiedot<br>\n  o	Kuvauksen reklamaatiosta<br>\n  •	Toimitusjohtaja hoitaa reklamaatiot sähköpostitse tehdyn ilmoituksen jälkeen</p>\n<p>Asiakkaita tulee kannustaa reklamaatioiden tekemiseen<br>\n  •	Reklamaatioiden avulla yhtiö pystyy kehittämään toimintaansa</p>\n<p>Henkilöstön tulisi informoida kaikki saamansa asiakaspalaute yhtiön toimitusjohtajalle<br>\n  •	Asiakkaiden kanssa toimiessa heidän tarpeiden tunnistaminen sekä niiden täyttäminen ovat kannattavan liiketoiminnan yksi oleellisimmista tekijöistä <br>\n  </p>\n<p><strong>3	TYÖSUOJELU- JA TYÖTURVALLISUUSOHJE</strong></p>\n<p><strong>KUVAUS</strong></p>\n<p>Yhtiö Oy:n työntekijät työskentelevät erityyppisissä tehtävissä ja erilaisilla työpaikoilla. Työnantajana Yhtiö Oy vastaa aina työntekijöidensä työsuojelusta ja työturvallisuudesta. Tämä ohje on tarkoitettu antamaan pohjan turvalliselle työskentelylle.</p>\n<p>Tarvittaessa työsuojeluohjetta voidaan täydentää työntekijän työsopimuksen yhteydessä niillä erityisseikoilla, jotka eivät esim. työkohteen ohjeistuksista tai tästä työsuojeluohjeesta suoraan ilmene.</p>\n<p><strong>TAVOITE</strong></p>\n<p>Tämän ohjeen tarkoitus on antaa perusteet kaiken tyyppisen työn turvalliselle suorittamiselle. Työntekijä perehtyy tähän ohjeeseen ja työnantajan osoittamiin muihin työsuojelua ja työturvallisuutta koskeviin erityisohjeisiin. Työntekijä sitoutuu noudattamaan niissä annettuja ohjeita ja velvoitteita.<br>\n  <br>\n  <strong>3.1	Vastuu työsuojelusta ja työturvallisuudesta</strong></p>\n<p>Työnantajana Yhtiö Oy vastaa aina työsuojelusta ja työturvallisuudesta sekä siitä, että työsuojelussa ja työturvallisuudessa noudatetaan ajantasaisia määräyksiä.</p>\n<p>Työnantaja on nimennyt työsuojelupäällikön, joka tulee olla työkohteen työntekijöiden ja yhteyshenkilöiden tiedossa.</p>\n<p>Työnantaja vastaa, että voimassa olevat ja päivitetyt työsuojelu- ja työturvallisuusohjeet ovat kaikkien helposti saatavilla.</p>\n<p>Työnantajan nimeämä työmaapäällikkö perehdyttää työntekijän kulloinkin kyseessä olevan työmaan työtehtäviin ja erityispiirteisiin. Työntekijä on velvoitettu huomauttamaan työmaapäällikköä ja työnantajaa, mikäli perehdytystä ei anneta tai sitä ei anneta riittävästi.</p>\n<p>Kumpikin osapuoli, työntekijä ja työnantaja, sitoutuvat noudattamaan aina voimassa olevia lakeja (työturvallisuuslaki, työsuojelun valvontalaki, työterveyslaki jne.), säännöksiä ja työsuojeluohjeita.</p>\n<p>Työnantajana Yhtiö Oy vastaa aina työntekijöidensä työsuojelusta ja työturvallisuudesta. Työsuojelu- ja työturvallisuusohjeen tarkoitus on antaa pohjan turvalliselle työskentelylle. työskentelylle. Työsuojelu- ja työturvallisuusohjeen tarkoitus on antaa perusteet kaiken tyyppisen työn turvalliselle suorittamiselle. Työntekijä perehtyy työsuojelu- ja työturvallisuusohjeeseen ja työnantajan osoittamiin muihin työsuojelua ja työturvallisuutta koskeviin erityisohjeisiin. Työntekijä sitoutuu noudattamaan niissä annettuja ohjeita ja velvoitteita.<br>\n  <br>\n  <strong>3.1.1	Yhtiö Oy:n työsuojelupäällikkö ja sähkötöiden johtaja</strong></p>\n<p>YHTIÖ OY:n<br>\n  (Y-tunnus määrittele y-tunnus)</p>\n<p>Työsuojelupäällikkö on<br>\n  Nimeä työsuojelupäällikkö</p>\n<p>Määrittele sähköposti<br>\n  Määrittele puhelinnumero</p>\n<p>Yhtiö OY<br>\n  Määrittele osoite<br>\n  Määrittele postinumero ja -toimipaikka</p>\n<p>Sähkötöiden johtaja on<br>\n  Nimeä sähkötöiden johtaja<br>\n  Määrittele sähköposti<br>\n  Määrittele puhelinnumero</p>\n<p><strong>3.2	Työntekijän ilmoittamis- ja huomauttamisvelvoite</strong></p>\n<p>Työntekijän havaitessa tai kokiessa puutteita, laiminlyöntejä tai muuta huomautettavaa työmaansa työsuojelu- ja/tai työturvallisuusasioissa, on hän velvoitettu ilmoittamaan/huomauttamaan asiasta viipymättä työmaan työmaapäällikölle ja työnantajalle.<br>\n  Työntekijän havaitessa työmaansa muiden työntekijöiden kokevan tai havaitsevan puutteita, laiminlyöntejä tai muuta huomautettavaa työmaansa työsuojelu- ja/tai työturvallisuusasioissa, on hän velvoitettu ilmoittamaan/huomauttamaan asiasta viipymättä työn suorittajalle (toinen työntekijä), työmaan työmaapäällikölle ja työnantajalle.<br>\n  </p>\n<p><strong>3.3	Työsuojelu ja työturvallisuus työpaikalla yleisesti</strong></p>\n<p>Erilaisissa työtehtävissä vaaditaan työntekijältä erityyppisiä ominaisuuksia työn turvalliselle suorittamiselle. Nämä ominaisuudet voivat olla fyysisiä tai psyykkisiä, kuitenkin sellaisia asioita, jotka tuodaan ilmi työntekijälle jo työhaastatteluvaiheessa. Edelleen tietyissä työtehtävissä vaaditaan työntekijällä olevan tietty pohjakoulutus ja tarvittavat voimassa olevat lisäkoulutukset ja pätevyydet.</p>\n<p>Työnantajalla on velvollisuus selvittää työntekijälle tietoon työntekijältä vaadittavat koulutukset ja pätevyydet. Työntekijän tulee osoittaa omaavansa työssä vaadittavat koulutukset ja pätevyydet esittämällä työnantajalle tarvittavat todistukset tai muut dokumentit.</p>\n<p>Tässä ohjeistuksessa on eritelty koulutukset ja pätevyydet Yhtiö Oy:n työntekijöiden keskeisimmille työpaikkatyypeille. Mikäli tiettyä työpaikkaa/työtehtävää ei tästä ohjeistuksesta suoraan löydy, tulee työnantajan selvittää työntekijälle työssä sovellettavat työsuojelu- ja työturvallisuusohjeet. <br>\n  </p>\n<p><strong>3.3.1	Yhtiö Oy:n toimitilat</strong></p>\n<p>Yhtiö Oy:n henkilöstön toimitiloissa työskentelevien henkilöiden työsuojelussa ja työturvallisuudessa noudatetaan toimistotyöhön liittyviä seuraavia ohjeistuksia:</p>\n<p>•	Jokainen huolehtii omasta henkilökohtaisesta työn turvallisesta suorittamisesta ilman, että työstä aiheutuu vaaratilanteita itselle tai muille työntekijöille.</p>\n<p>•	Työnantaja huolehtii jokaiselle työntekijälle ergonomisesti hyvin valitut ja suunnitellut työpisteet ja -välineet, joilla työtehtävät voidaan suorittaa ilman ylimääräisiä fyysisiä rasitteita.</p>\n<p>•	Jokainen työntekijä vastaa omasta hygieniastaan niin, ettei siitä aiheudu ongelmia itselle ja muille. Työnantaja vastaa toimitilan säännöllisestä siistimisestä ja siitä, että toimitilan wc-tiloissa on riittävät välineet henkilökohtaisen hygienian ylläpitämiseksi.</p>\n<p>•	Työnantaja ei tarjoa työntekijälle työvaatteita. Työntekijää velvoitetaan pukeutumaan siististi toimistotyön edellyttämällä tavalla ja siten, että vaatetuksesta ei löydy sellaisia seikkoja, jotka voisivat heikentää työturvallisuutta toimitiloissa (esim. irtonaisia, herkästi takertuvia osia yms.).</p>\n<p>•	Toimitilassa jokainen työntekijä tietää, mistä löytää ensisammutus- ja ensiapuvälineet ja miten niitä käytetään onnettomuuden sattuessa. Edelleen työntekijät tuntevat toimitilan kaikki varauloskäynnit.</p>\n<p>•	Työssään työntekijän tulee noudattaa voimassa olevia lakeja ja säännöksiä.</p>\n<p>•	Työntekijän havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminlyöntejä tai muuta huomautettavaa työsuojelu- ja/tai työturvallisuusasioissa, on hän velvoitettu ilmoittamaan/huomauttamaan asiasta viipymättä työn suorittajalle (toinen työntekijä) ja työnantajalle.<br>\n  </p>\n<p><strong>3.3.2	Yhtiö Oy:n asiakaskäynnit</strong></p>\n<p>Yhtiö Oy:n henkilöstön asiakaskäynneillä noudatetaan asiakkaan/tilaajan työsuojelu- ja työturvallisuusohjeistuksia, mikäli muuta ei ole ennakkoon sovittu. Joka tapauksessa otetaan huomioon seuraavat asiat:</p>\n<p>•	Työnantaja varmistaa, että työntekijällä on asiakaskäynnillä tarvittavat työvaatteet ja suojavälineet (kypärä jne.), mikäli tilanne sitä vaatii.</p>\n<p>•	Työntekijä huolehtii asiakkaan kanssa työturvallisuudesta asiakaskäynnin ajan. Työntekijä ei siis ryhdy poikkeustapauksessakaan mihinkään sellaiseen toimeen, mistä voisi aiheutua haittaa itselle tai muille.</p>\n<p>•	Työntekijän tulee noudattaa asiakaskäyneillä voimassa olevia lakeja ja säännöksiä sekä mahdollisia muita erityismääräyksiä (esim. työkohteessa olevat erilliset määräystaulut, opasteet jne.).</p>\n<p>•	Asiakaskäynnillä työntekijän havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminlyöntejä tai muuta huomautettavaa työsuojelu- ja/tai työturvallisuusasioissa, on hän velvoitettu ilmoittamaan/huomauttamaan asiasta viipymättä työn suorittajalle (toinen työntekijä), asiakkaalle ja työnantajalle (toimittaja).<br>\n  </p>\n<p><strong>3.3.3	Etätyöskentely</strong></p>\n<p>Yhtiö Oy:n henkilöstön ja työntekijöiden etätyöskentelyssä noudatetaan tätä työsuojelu- ja työturvallisuusohjetta, mikäli muuta ei ole sovittu. Joka tapauksessa otetaan huomioon seuraavat asiat:</p>\n<p>•	Työnantaja varmistaa, että työntekijällä on etätyössä tarvittavat ja asianmukaiset turvalliset työvälineet. Mikäli työ tehdään suoraan asiakkaalle (tilaaja), vastaa tämä työvälineiden määrittämisestä ja toimittaa niistä tiedot toimittajalle. Edelleen tilaaja vastaa työvälineiden oikean ja turvallisen käytön kouluttamisesta työntekijälle.</p>\n<p>•	Työntekijä huolehtii itse etätyöskentelynsä työturvallisuudesta. Työntekijä ei ryhdy poikkeustapauksessakaan mihinkään sellaiseen toimeen, mistä voisi aiheutua haittaa itselle tai muille. Asiakkaalle (tilaaja) suoraan tehtävässä työssä työntekijä noudattaa myös tilaajan etätyölle asettamia työsuojelu- ja työturvallisuusohjeita.</p>\n<p>•	Työntekijän tulee noudattaa etätyöskentelyssään voimassa olevia lakeja ja säännöksiä sekä mahdollisia muita erityismääräyksiä.</p>\n<p>•	Etätyöskentelyssään työntekijän havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminlyöntejä tai muuta huomautettavaa työsuojelu- ja/tai työturvallisuusasioissa, on hän velvoitettu ilmoittamaan/huomauttamaan asiasta viipymättä työn suorittajalle (toinen työntekijä) ja työnantajalle sekä tilaajalle, mikäli työ tehdään suoraan asiakkaalle.<br>\n  </p>\n<p><strong>3.3.4	Rakennustyömaat (uudisrakennus ja saneeraus)</strong></p>\n<p>Rakennustyömailla noudatetaan työnantajan työsuojeluun ja työturvallisuuteen liittyviä ohjeistuksia ja määräyksiä. Lisäksi:</p>\n<p>•	Työnantajan nimeämä työmaapäällikkö vastaa työn suorittamisen ja valvonnan lisäksi työsuojelusta ja työturvallisuuden noudattamisesta työmaalla.</p>\n<p>•	Työnantajan nimeämän työmaapäällikön tulee toimittaa työntekijälle tämän työssään tarvitsemat työvaatteet (vaadittavat väritykset, tarvittaessa antiflame) ja suojavälineet (kypärä, suojalasit, käsineet, jne.).</p>\n<p>•	Terveydelle haitallisissa purku- ja saneerauskohteissa (esim. asbestinpurkutyömaa) tulee työnantajan tarjota työntekijälle lain ja määräysten mukaiset työssä vaadittavat hengitys- ja henkilökohtaisiset suojavälineet.</p>\n<p>•	Työnantajan tulee selvittää työntekijälle tältä tehtävässä vaadittavasta pohjakoulutuksesta sekä mahdollisesti vaadittavista lisäkoulutuksista ja pätevyyksistä (esim. Työturvallisuuskortti).</p>\n<p>•	Työnantaja vastaa, että työntekijällä on tehtävään vaadittava koulutus ja mahdolliset muut tarvittavat pätevyydet. Työntekijä on velvollinen toimittamaan työnantajalle tiedot pätevyyksistään ja koulutuksistaan.</p>\n<p>•	Työnantajan nimeämä työmaapäällikkö perehdyttää työntekijän työmaan erityspiirteisiin, erityisiin riskeihin ja muihin työsuojeluun ja työturvallisuuteen vaikuttaviin seikkoihin.</p>\n<p>•	Työmaapäällikkö antaa koulutuksen työssä käytettäviin laitteisiin ja välineisiin sekä opastaa niiden turvallisen käytön työssä.</p>\n<p>•	Työntekijän tulee noudattaa työssään voimassa olevia lakeja ja säännöksiä, tilaajan antamia ohjeita ja määräyksiä sekä mahdollisia muita erityismääräyksiä (esim. työkohteessa olevat erilliset määräystaulut, opasteet jne.).</p>\n<p>•	Työntekijän havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminlyöntejä tai muuta huomautettavaa työpaikkansa työsuojelu- ja/tai työturvallisuusasioissa, on hän velvoitettu ilmoittamaan/huomauttamaan asiasta viipymättä työn suorittajalle (toinen työntekijä), työpaikan esimiehelle (työmaapäällikkö) ja työnantajalle.<br>\n  3.3.5	Sähkötyömaat (uudisrakennus ja saneeraus)</p>\n<p>Sähkötyömailla noudatetaan työnantajan työsuojeluun ja työturvallisuuteen liittyviä ohjeistuksia ja määräyksiä. Lisäksi:</p>\n<p>•	Työnantajan nimeämä työmaapäällikkö (tai vastaava) vastaa työn suorittamisen ja valvonnan lisäksi työsuojelusta ja työturvallisuuden noudattamisesta työmaalla, ellei erikseen ole toisin kirjallisesti sovittu.</p>\n<p>•	Työnantaja varmistaa, että työntekijällä on työssään käytössä tarvittavat työvaatteet (esim. vaadittavat väritykset) ja suojavälineet (kypärä, käsineet, jne.) vaatimusten mukaisesti.</p>\n<p>•	Työnantajan tulee selvittää työntekijälle tältä tehtävässä vaadittavasta pohjakoulutuksesta sekä mahdollisesti vaadittavista lisäkoulutuksista ja pätevyyksistä.</p>\n<p>•	Työnantaja vastaa, että työntekijällä on tehtävään vaadittava koulutus ja mahdolliset muut tarvittavat pätevyydet. Työntekijä on velvollinen toimittamaan työnantajalle tiedot pätevyyksistään ja koulutuksistaan.</p>\n<p>•	Työnantajan nimeämä työmaapäällikkö perehdyttää työntekijän työmaan erityspiirteisiin, erityisiin riskeihin ja muihin työsuojeluun ja työturvallisuuteen vaikuttaviin seikkoihin.</p>\n<p>•	Työmaapäällikkö antaa koulutuksen työssä käytettäviin laitteisiin ja välineisiin sekä opastaa niiden turvallisen käytön työssä.</p>\n<p>•	Työntekijän tulee noudattaa työssään voimassa olevia lakeja ja säännöksiä, tilaajan antamia ohjeita ja määräyksiä sekä mahdollisia muita erityismääräyksiä (esim. työkohteessa olevat erilliset määräystaulut, opasteet jne.).</p>\n<p>•	Työntekijän havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminlyöntejä tai muuta huomautettavaa työpaikkansa työsuojelu- ja/tai työturvallisuusasioissa, on hän velvoitettu ilmoittamaan/huomauttamaan asiasta viipymättä työn suorittajalle (toinen työntekijä), työpaikan esimiehelle (työmaapäällikkö) ja työnantajalle.<br>\n  </p>\n<p><strong>3.3.6	Kuitutyöt</strong></p>\n<p>Kuitutöissä noudatetaan työnantajan työsuojeluun ja työturvallisuuteen liittyviä ohjeistuksia ja määräyksiä. Lisäksi:</p>\n<p>•	Työnantajan nimeämä työmaapäällikkö (tai vastaava) vastaa työn suorittamisen ja valvonnan lisäksi työsuojelusta ja työturvallisuuden noudattamisesta työmaalla, ellei erikseen ole toisin kirjallisesti sovittu. </p>\n<p>•	Työnantaja varmistaa, että työntekijällä on työssään käytössä tarvittavat työvaatteet (esim. vaadittavat väritykset, tarvittaessa antiflame) ja suojavälineet (kypärä, käsineet, suojalasit jne.) työn vaatimusten mukaisesti.</p>\n<p>•	Työnantajan tulee selvittää työntekijälle tältä tehtävässä vaadittavasta pohjakoulutuksesta sekä mahdollisesti vaadittavista lisäkoulutuksista ja pätevyyksistä.</p>\n<p>•	Työnantaja vastaa, että työntekijällä on tehtävään vaadittava koulutus ja mahdolliset muut tarvittavat pätevyydet. Työntekijä on velvollinen toimittamaan työnantajalle tiedot pätevyyksistään ja koulutuksistaan.</p>\n<p>•	Työnantajan nimeämä työmaapäällikkö perehdyttää työntekijän työmaan erityspiirteisiin, erityisiin riskeihin ja muihin työsuojeluun ja työturvallisuuteen vaikuttaviin seikkoihin.</p>\n<p>•	Työmaapäällikkö antaa koulutuksen työssä käytettäviin laitteisiin ja välineisiin sekä opastaa niiden turvallisen käytön työssä.</p>\n<p>•	Työntekijän tulee noudattaa työssään voimassa olevia lakeja ja säännöksiä, tilaajan antamia ohjeita ja määräyksiä sekä mahdollisia muita erityismääräyksiä (esim. työkohteessa olevat erilliset määräystaulut, opasteet jne.).</p>\n<p>•	Työntekijän havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminlyöntejä tai muuta huomautettavaa työpaikkansa työsuojelu- ja/tai työturvallisuusasioissa, on hän velvoitettu ilmoittamaan/huomauttamaan asiasta viipymättä työn suorittajalle (toinen työntekijä), työpaikan esimiehelle (työmaapäällikkö) ja työnantajalle.</p>\n<p>•	Työnantaja huolehtii kuitutöissä syntyvälle kuitujätteelle asianmukaiset jäteastiat. Kuitutöissä kuituja katkaistaessa kaapelin jatkamisen ja päättämisen yhteydessä syntyvät kuidunpätkät on kerättävä välittömästi niille varattuun astiaan. Pöydälle, vaatteisiin tai muualle jääneet kuidunpätkät aiheuttavat työturvallisuus- ja terveysriskin, sillä ne voivat tunkeutua ihon alle ja joutua jopa verenkiertoon. Pahimmassa tapauksessa seurauksena voi olla hengenvaara. Kuitujen jäteastia tulee hävittää asianmukaisesti ja esim. sulkea tiiviisti ennen roskiin heittämistä, ettei kuidunpätkistä olisi haittaa myöskään siivoojille tai muille työntekijöille.</p>\n<p>•	Työnantaja huolehtii, että työmaalla kuitujen ja liittimien puhdistuksessa käytettävät kemikaalit, jotka ovat useimmiten palavia, huumaavia ja ärsytysoireita aiheuttavia, eivät aiheuttaisi työntekijöille ylimääräistä terveydellistä haittaa. Kemikaalien aiheuttamat terveysriskit minimoidaan huolehtimalla työtilan tuuletuksesta ja työntekijöiden suojakäsineiden käytöstä työskentelyn aikana. Edelleen myös optisten kaapeleiden rakenneosien mahdolliset ärsytysoireita aiheuttavat elementit (esim. aramidi- tai lasikuituvahvikkeet sekä täyterasvat ja niiden puhdistusaineet) ja niiden muodostamat työturvallisuus- ja terveysriskit minimoidaan edellä kuvatusti huolehtimalla työntekijöiden asianmukaisesta varustamisesta työskentelyssä sekä työtilan riittävästä tuuletuksesta.</p>\n<p>•	Kuitutöissä optisessa tiedonsiirrossa käytettävä valo on näkymätöntä, mutta silmälle vaarallista ja verkkokalvoa vahingoittavaa. Valonlähteet, varsinkin laserkomponentit lähettävät valoa, jonka osumista silmään on ehdottomasti varottava. Kuidun tai optisen liittimen päähän ei saa koskaan katsoa suoraan edestä. Työmaapäällikkö vastaa siitä, että kuitutöissä vapaat kuitujen ja liittimien päät ovat aina asianmukaisesti suljettuja. Edelleen työmaapäällikkö vastaa siitä, että jakamoissa ja muissa optisia laitteita sisältävissä rakenteissa on lasersäteen lähteet merkitty asianmukaisesti käyttäen lasersäteen varoitustarroja.<br>\n  </p>\n<p><strong>3.4	Perehdyttäminen</strong></p>\n<p>Yhtiö Oy:n työntekijät tulee perehdyttää heillä teetettävään työhön sekä työmaan erityisvaatimuksiin ja –piirteisiin aina työntekijän aloittaessa ensimmäistä kertaa työt työmaalla. Perehdyttämisestä vastaa ensisijaisesti työnantajan nimeämä työmaan työmaapäällikkö. Työmaapäällikön tulee huolehtia yhdessä työntekijän kanssa, että työntekijä saa työhönsä tarvittavan perehdytyksen ennen työhön ryhtymistä. Puutteellisesta perehdytyksestä työntekijän tulee ilmoittaa työmaapäällikölle ja työnantajalle.</p>\n<p>Jotta perehdytyksessä tulisi huomioiduksi kaikki tarvittavat seikat työtehtävien ja työmaan erityispiirteistä ja –vaatimuksista sekä työsuojelusta ja työturvallisuudesta, tulee perehdytyksestä täyttää perehdyttämislomake, jossa kaikki perehdytykseen sisällytetyt asiat ovat eriteltyinä. Perehdyttämislomakkeen täyttävät ja allekirjoittavat perehdyttäjä (työmaapäällikkö) ja työntekijä yhdessä.<br>\n  </p>\n<p><strong>3.5	Työkyvyn ylläpito</strong></p>\n<p>Yhtiö Oy:n työntekijöiden työkyvystä huolehtivat ensisijaisesti työntekijät itse. Työntekijällä on velvollisuus ilmoittaa ja/tai huomauttaa työnantajalle havaitsemistaan työkykyyn heikentävästi vaikuttavista tekijöistä työmaalla ja työssä yleensä.<br>\n  Työnantajan edustajat huolehtivat, että työntekijät säilyttävät työkykynsä eivätkä kuormita itseään ylimääräisillä lisätöillä ja/tai ylitöillä.<br>\n  Työnantajan vastuuna on tarkkailla työntekijän työkykyä ja -kuntoa työmaalla ja tarvittaessa huomauttaa työntekijää tapauksissa, joissa työntekijän työkyvyssä ja/tai -kunnossa havaitaan jotain normaalista poikkeavaa.<br>\nTyönantaja vastaa siitä, että työtehtävissä on aina ennakkoon arvioitu riskitekijät ja muut seikat, jotka voivat vaikuttaa työntekijän ja/tai sivullisten työkykyyn, -kuntoon tai terveyteen. Edelleen, työnantaja vastaa, että työmaasta on laadittu tarvittavat turvallisuusasiakirjat, mikäli näin on vaadittu, ja esittää ne tarvittaessa myös työntekijöille.</p>\n<p><strong>3.6	Muut noudatettavat ohjeistukset ja määräykset</strong></p>\n<p>Työnantaja vastaa aina, että työsuojelussa ja työturvallisuudessa noudatetaan aina ajantasaisia ohjeita ja määräyksiä. Muut noudatettavat ohjeistukset ja määräykset tulee saattaa työntekijän tietoon viipymättä niiden astuessa voimaan.<br>\n  Työnantajan nimeämä työmaapäällikkö varmistaa, että työsuojeluun ja työturvallisuuteen liittyvät ohjeistukset on saatettu työmaan työntekijöiden tietoon.<br>\n  Mahdolliset epäselvyydet tai ristiriidat kaikissa noudatettavissa ohjeistuksissa ja määräyksissä tulee selvittää heti niiden ilmettyä työmaapäällikön, työnantajan ja työntekijän välillä.<br>\n  </p>\n<p><strong>3.7	Ohjeistuksen päivittäminen</strong></p>\n<p>Työnantaja vastaa, että kaikkien osapuolien käytettävissä on aina viimeisin päivitetty versio käytössä olevasta työsuojelu- ja työturvallisuusohjeistuksesta.<br>\n  Tätä ohjeistusta päivitetään ja tarkennetaan aina tarvittaessa siten, että se vastaa ajantasaisia määräyksiä.<br>\n  Keskeisimmät päivitysten myötä tähän ohjeistukseen tehtävät muutokset on viipymättä tuotava kaikkien asiaankuuluvien tahojen tietoon.</p><p>{company_name}</p><p>{switch_phonenumber}</p><p>{company_email}\n</p>');
INSERT INTO `erp_agreements` (`aid`, `text`) VALUES
(2, '<p><strong>1. Soveltaminen ja  määritelmät</strong> <br>\n  1.1. Sopimuksen kohteena on toimittajan (Toimittaja) tilaajalle&nbsp;toimittamat rekrytointi-,  henkilöstönvuokraus-, henkilöstökonsultointi- sekä&nbsp;ulkoistuspalvelut. <br></p><p>\n  1.2. Työvoiman vuokrauksella tarkoitetaan  toimintaa, jossa TOIMITTAJA&nbsp;siirtää työntekijöitään asiakkaan käyttöön  vastiketta vastaan siten, että TOIMITTAJA&nbsp;on työntekijän työnantaja ja  työntekijän työnjohto- ja&nbsp;valvontaoikeus sekä ne työnantajalle säädetyt  velvollisuudet, jotka liittyvät työn&nbsp;tekemiseen ja järjestelyihin  siirtyvät asiakkaalle.&nbsp; <br>\n  Työ suoritetaan asiakkaan osoittamissa  tiloissa, asiakkaan työvälineillä ja&nbsp;työmenetelmien mukaisesti. <br>\n  Työ suoritetaan tarjouksessa tai  tilausvahvistuksessa mainitussa paikassa, työkohteen&nbsp;siirtämisestä tulee  sopia osapuolien välillä erikseen. <br></p><p>\n  1.3. Ehdoista voidaan poiketa sopimalla  niistä kirjallisesti toisin. </p>\n<p><strong>2. Sopijapuolten  yleiset velvollisuudet</strong></p><p><strong></strong> <br>\n  2.1. Asiakkaan tulee sopimuskohtaisesti  antaa&nbsp;TOIMITTAJA:lle oikeat ja riittävät tiedot suoritettavista  työtehtävistä,&nbsp;työntekopaikasta, työtehtävän kestosta, työskentelyajoista,  työn erityispiirteistä,&nbsp;soveltamastaan työehtosopimuksesta ja  mahdollisesta paikallisesta sopimuksesta sekä&nbsp;ilmoitettava&nbsp;TOIMITTAJA:lle  näissä tiedoissa tapahtuvista muutoksista&nbsp;välittömästi. Lisäksi&nbsp;TOIMITTAJA:lle  tulee antaa tieto työntekijältä&nbsp;edellytettävästä koulutuksesta,  ammattitaidosta ja&nbsp;kokemuksesta sekä&nbsp;työturvallisuuden kannalta  erityisesti huomioitavista seikoista, kuten  työntekijän&nbsp;terveydentilavaatimuksista. <br></p><p>\n  2.2.&nbsp;TOIMITTAJA:n on huolellisesti  valittava tehtävään esitettävät henkilöt&nbsp;asiakkaan antamien tietojen  perusteella.&nbsp;TOIMITTAJA:n tulee sen&nbsp;käytettävissä  olevat mahdollisuudet huomioon ottaen pyrkiä kohtuudella  selvittämään,&nbsp;että työntekijä vastaa koulutukseltaan, ammattitaidoltaan ja  kokemukseltaan asiakkaan&nbsp;TOIMITTAJA:lle ilmoittamia vaatimuksia tai  vaihtoehtoisesti selvitettävä,&nbsp;miltä osin työntekijä poikkeaa niistä. <br></p><p>\n  2.3.&nbsp;TOIMITTAJA&nbsp;vastaa  työntekijän työnantajana työntekijän&nbsp;henkilöstökuluista, kuten palkasta,  sosiaalikuluista ja lakisääteisistä vakuutuksista.&nbsp;TOIMITTAJA&nbsp;noudattaa  suhteessa työntekijään työlainsäädännön ja&nbsp;viranomaismääräysten lisäksi  kulloinkin sovellettavaksi tulevaa työehtosopimusta.&nbsp; <br></p><p>\n  2.4. Asiakkaan on työnjohto- ja  valvontaoikeutensa perusteella valvottava työntekijän&nbsp;työsuoritusta ja  vastattava työn suorittamiseksi välttämättömän perehdytyksen&nbsp;antamisesta.  Asiakas sitoutuu noudattamaan työntekijän osalta  työlainsäädäntöä,&nbsp;viranomaismääräyksiä ja sovellettavaa  työehtosopimusta.&nbsp; <br>\n  Asiakas sitoutuu kohtelemaan työntekijää  oikeudenmukaisesti ja tasapuolisesti&nbsp;suhteessa asiakkaan omiin  työntekijöihin tasa-arvolain ja yhdenvertaisuuslain&nbsp;mukaisesti. <br></p><p>\n  <strong>3. Työturvallisuus ja  työsuojelu</strong></p><p><strong></strong> <br>\n  3.1.&nbsp;TOIMITTAJA:llä on työnantajana  yleisvastuu työntekijän&nbsp;työsuojelusta.&nbsp;TOIMITTAJA&nbsp;järjestää  työntekijän työterveyshuollon. <br></p><p>\n  3.2. Asiakkaan  tulee ennen työn aloittamista huolehtia siitä, että  työntekijä&nbsp;perehdytetään työhön ja että hänelle annetaan riittävät tiedot  työssä esiintyvistä haitta- ja&nbsp;vaaratekijöistä sekä niiden edellyttämistä  työ-suojelutoimenpiteistä ja vastata siitä,&nbsp;että näitä määräyksiä myös  noudatetaan.&nbsp; <br>\n  Asiakkaan tulee  hankkia ja antaa työntekijän käyttöön tarvittavat henkilönsuojaimet  ja&nbsp;suojavälineet ja vastata siitä, että työntekijä myös käyttää  niitä. Asiakas vastaa  siitä, että työ asiakkaan tiloissa ja laitteilla voidaan  suorittaa&nbsp;turvallisesti ja että työterveyshuoltolain mukaiset  työpaikkatarkastukset on työntekijän&nbsp;työpaikalla tehty. Asiakas toimittaa  pyydettäessä&nbsp;TOIMITTAJA:lle kopion&nbsp;tehdystä työpaikkaselvityksestä,  sekä kopion aina työntekijän&nbsp;perehdyttämislomakkeesta. <br></p><p>\n  3.3. Asiakas voi  sopia työntekijän kanssa ylitöiden tekemisestä lakien,&nbsp;työehtosopimuksen  ja&nbsp;TOIMITTAJA:n antamien ohjeiden asettamissa&nbsp;rajoissa. </p>\n<p><strong>4. Reklamaatiot  ja työnteon estyminen</strong></p><p><strong></strong> <br>\n  4.1. Mikäli  työntekijän ammattitaidossa tai työsuorituksessa ilmenee puutteita  tai&nbsp;työntekijä ei saavu työhön sovittuna ajankohtana, tästä on  välittömästi, ja joka&nbsp;tapauksessa viimeistään 7 päivän kuluessa,  ilmoitettava&nbsp;TOIMITTAJA:lle,&nbsp;jotta&nbsp;TOIMITTAJA&nbsp;voi ryhtyä  korjaaviin toimenpiteisiin. <br></p><p>\n  4.2. Mikäli  työntekijä on sairauden, työsuhteen päättymisen, lakon tai muun  pätevän&nbsp;syyn vuoksi estynyt suorittamasta sovittua työtä,&nbsp;TOIMITTAJA:llä  on&nbsp;sovittaessa oikeus järjestää toinen työntekijä mahdollisimman pian  estyneen tilalle.&nbsp;TOIMITTAJA&nbsp;ei  vastaa tällaisen työntekijän pätevän esteen asiakkaalle&nbsp;mahdollisesti  aiheuttamista vahingoista. <br></p><p>\n  4.3. Mikäli työn  teettäminen estyy asiakkaasta suoraan tai välillisesti johtuvasta&nbsp;syystä,  tästä esteestä on välittömästi ilmoitettava&nbsp;TOIMITTAJA:lle.&nbsp;Asiakkaalla on oikeus esteen jatkuessa keskeyttää  työt kohtuullista ilmoitusaikaa&nbsp;noudattaen.&nbsp; <br></p><p>\n  Kohtuullisen  ilmoitusajan pituus sovitaan erikseen ottaen huomioon  työtehtävän&nbsp;kokonaiskesto. Asiakkaalla on oikeus teettää lyhyen esteen  ajan työntekijällä muuta&nbsp;korvaavaa työtä. </p>\n<p><strong>5. Veloitusperusteet</strong></p><p><strong></strong> <br>\n  5.1. Työ tehdään laskutustyönä, josta  tilaaja sitoutuu maksamaan tuntiveloituksena&nbsp;tarjouksen mukaisen  korvauksen. Jos hintaa ei ole sovittu erikseen, noudatetaan&nbsp;osapuolien  välillä ollutta aikaisempaa hinnoittelua tai toimittajan yleistä hinnoittelua. <br>\n  Suoritukset tilaajalta toimittajalle  tapahtuvat laskua vastaan, jonka maksuaika on 14&nbsp;pv netto tai sopimuksessa  erikseen kirjallisesti sovittu. Laskutus tapahtuu kahden&nbsp;viikon välein.  Lasku toimitetaan sopimuksen ehtojen mukaisesti. Laskuissa on&nbsp;mainittava  sopimusnumero tai muu viite. Laskutus perustuu  tunti-ilmoituskaavakkeisiin&nbsp;tai asiakkaan yhteyshenkilön (työnjohdon)  hyväksyntään.&nbsp; <br>\n  Jos asiakas jättää laskunsa maksamatta  eräpäivään mennessä on TOIMITTAJA:llä oikeus 7 päivää eräpäivän jälkeen poistaa  henkilöstö asiakkaan työmaalta. TOIMITTAJA:llä on kuitenkin oikeus laskuttaa  tältäkin ajalta sopimuksen mukaiset korvaukset jos henkilöstön työsopimukset  aiheuttavat TOIMITTAJA:lle kustannuksia. TOIMITTAJA:n on viipymättä  palauttettava henkilöstö asiakkaan käyttöön näiden sopimusehtojen puitteissa  kun asiakas on maksuvelvoitteensa hoitanut. <br></p><p>\n  5.2. Tunti-ilmoituskaavakkeet  laaditaan ja hyväksytään TOIMITTAJA:n käytössä olevalla sähköisellä  tuntikortilla tai erikseen kirjallisesti sovitulla tavalla. <br></p><p>\n  Työntekijän täyttämä sähköinen  tuntikortti tulee asiakkaan yhteyshenkilön toimesta tarkastaa ja hyväksyä  viimeistään: </p>\n<ul type=\"disc\">\n  <li>kahden       viikon välein maksettavien palkkojen osalta palkanmaksuviikon tiistaihin       klo 23:59 mennessä HRM-järjestelmässä </li>\n  <li>kuukausipalkkojen       osalta seuraavan kuukauden 3. päivänä klo 23:59 mennessä       HRM-järjestelmässä </li>\n</ul>\n<p>Mikäli asiakas  ei käy automaattisista sähköposti-ilmoituksista huolimatta hyväksymässä tälle  HRM-järjestelmässä hyväksyttäväksi lähetettyjä sähköisiä tuntikortteja em.  määräaikoihin mennessä, järjestelmän kautta laaditut sähköiset tuntikortit  katsotaan hyväksytyiksi ja todetaan laskutuskelpoisiksi, jotta suoritettujen  töiden laskutus ja palkanmaksu ei viivästy. HRM-järjestelmässä asiakkaan toimesta  tai määräajan ylityttyä hyväksymätön tuntikortti on sellaisenaan  laskutuskelpoinen.<strong></strong><br>\n  Asiakas voi  tarkastuksessaan havaitsemien virheiden vuoksi myös palauttaa kortin  työntekijälle korjattavaksi. Palautuksen yhteydessä on kirjattava työntekijälle  tiedoksi asiat, jotka ovat kortille virheellisesti kirjattu. Tämän lisäksi  asiakkaan tulee ilmoittaa tuntikortissa olevista virheistä TOIMITTAJA:n  yhteyshenkilölleen. Mahdolliset jälkikäteen tehtävät korjaukset ja hyvitykset  hyvitetään seuraavan palkanlaskennan yhteydessä. <br></p><p>\n  5.2. Työtä  tehdään aina sovellettavan työehtosopimuksen määrittämiä  kokonaisia&nbsp;työpäiviä, ellei muuta ole etukäteen sovittu. Mikäli sopimus  perustuu työntekijän&nbsp;kulloinkin tekemiin työtunteihin,&nbsp;TOIMITTAJA&nbsp;veloittaa  asiakasta&nbsp;työntekijän antamien ja asiakkaan hyväksymien  työsuoriteilmoitusten perusteella. <br></p><p>\n  5.3. Hintaan  lisätään siihen lakiin perustuvat välilliset verot, kuten  arvonlisävero,&nbsp;kulloinkin voimassa olevien säännösten mukaisesti. <br></p><p>\n  5.4. Yleisten  työnantajamaksujen tai muiden niihin rinnastettavien maksujen määrän&nbsp;tai  soveltamisen muuttuessa&nbsp;TOIMITTAJA&nbsp;pidättää oikeuden  tarkistaa&nbsp;hintaa muutoksen voimaantuloajankohdasta lukien muutosta  vastaavasti. Jos&nbsp;sopimuskauden aikana tapahtuu yleisiä alaan kohdistuvia  palkankorotuksia,&nbsp;TOIMITTAJA:llä on oikeus korottaa sopimushintoja  vastaavalla prosenttimäärällä&nbsp;korotuksen voimaantulohetkestä lukien. </p>\n<p><strong>6.  Rekrytointipalkkio</strong></p><p><strong></strong> <br>\n  6.1.&nbsp;TOIMITTAJA:llä  on oikeus periä asiakkaalta rekrytointipalkkio,&nbsp;mikäli henkilö joka  työskentelee siirtyy tai tekee sopimuksen siirtymisestä asiakkaan tai sen  kanssa&nbsp;samaan konserniin kuuluvan tai muun läheisen yhtiön palvelukseen  sopimuksen&nbsp;voimassaoloaikana tai kuuden (6) kuukauden kuluessa sopimuksen  päättymisestä&nbsp;lukien. Rekrytointipalkkio tulee maksaa myös siinä  tapauksessa, että asiakas vuokraa&nbsp;TOIMITTAJA:n rekrytoiman ja välittämän  työntekijän jonkin toisen&nbsp;yrityksen kautta vastaavana aikana. <br></p><p>\n  6.2.  Rekrytointipalkkio on työntekijän kahden (2) kuukauden bruttopalkkaa  vastaava&nbsp;summa (ALV 0%). </p>\n<p><strong>7. Salassapito  ja tietoturvallisuus</strong></p><p><strong></strong> <br>\n  7.1.  Sopijapuolet sitoutuvat pitämään salassa sopimuksen sisällön  sekä&nbsp;sopimussuhteen aikana saamansa luottamukselliset tiedot ja olemaan  käyttämättä&nbsp;tällaista tietoa mihinkään muuhun tarkoitukseen kuin tämän  sopimuksen mukaisten&nbsp;velvollisuuksiensa täyttämiseen.</p><p>\n  7.2. Mikäli  työtehtävät edellyttävät työntekijältä erityisen  salassapitovelvollisuuden&nbsp;täyttämistä tai tietoturvallisuusohjeiden  noudattamista, asiakas ja työntekijä sopivat&nbsp;tästä keskenään, eikä&nbsp;TOIMITTAJA&nbsp;tule  kyseisen sopimuksen osapuoleksi.</p><p>\n  <strong>8.  Vahingonkorvausvastuu</strong></p><p><strong></strong> <br>\n  8.1.&nbsp;TOIMITTAJA&nbsp;vastaa  työntekijän mahdollisesti asiakkaalle&nbsp;aiheuttamasta vahingosta voimassa  olevan oikeuden mukaisesti.&nbsp;TOIMITTAJA&nbsp;ei siten vastaa  työntekijän työssään asiakkaalle aiheuttamasta vahingosta, ellei&nbsp;vahinko  johdu sellaisesta työntekijän ammattitaidottomuudesta, josta&nbsp;TOIMITTAJA&nbsp;tämän  sopimuksen kohdan 2.2. mukaan vastaa. <br></p><p>\n  8.2. Asiakas vastaa työntekijän kolmannelle  osapuolelle aiheuttamasta vahingosta,&nbsp;mikäli vahinko tapahtuu asiakkaan  lukuun työtä tehtäessä. <br></p><p>\n  8.3. Sopijapuolet eivät vastaa oman  suorituksensa virheellisyyden aiheuttamista&nbsp;välillisistä vahingoista,  eikä&nbsp;TOIMITTAJA&nbsp;työntekijän aiheuttamista&nbsp;välillisistä  vahingoista. <br></p><p>\n  8.4. Vahingonkorvausta on vaadittava&nbsp;TOIMITTAJA:ltä  neljän viikon&nbsp;kuluessa siitä, kun vahingonkorvauksen perusteena oleva  tapahtuma tai virhe&nbsp;havaittiin tai se olisi pitänyt havaita, muussa  tapauksessa oikeus mahdolliseen&nbsp;korvaukseen on menetetty. <br></p><p>\n  8.5. Jos asiakas luovuttaa omaa  omaisuuttaan työntekijän haltuun, tulee hänen kuittauttaa luovutettu omaisuus  joko omalla tai TOIMITTAJA:n kuittauslomakkeella. Omaa lomaketta käyttäessä  tulee kuittauslomakkeessa tulla esiin selkeästi työntekijän korvausvastuu  haltuun otetuista tuotteista. Yli 1000 euron arvoisen omaisuuden luovutuksen  kohdalla tulee asiasta sopia erikseen TOIMITTAJA:n yhteyshenkilön kanssa  kirjallisesti. Jos asiakas laiminlyö kuittauksen tai yli 1000 euron arvoisen  omaisuuden kohdalla erikseen sopimisen vastaa asiakas mahdollisista  vahingoista. <br></p><p>\n  <strong>9. Ylivoimainen este  (Force Majeure)</strong></p><p><br>\n  9.1. Kumpikaan sopijapuoli ei vastaa  viivästyksistä ja vahingoista, jotka johtuvat&nbsp;hänen  vaikutusmahdollisuuksiensa ulkopuolella olevasta esteestä, jota sopijapuolen  ei&nbsp;kohtuudella voida edellyttää ottaneen huomioon sopimuksentekohetkellä  ja jonka&nbsp;seurauksia sopijapuoli ei myöskään kohtuudella olisi voinut  välttää tai voittaa. <br></p><p>\n  9.2. Sopijapuolen on viipymättä  ilmoitettava ylivoimaisesta esteestä kirjallisesti&nbsp;toiselle  sopijapuolelle, samoin kuin esteen lakkaamisesta. </p>\n<p><strong>10. Sopimuksen  voimassaolo, päättäminen ja siirtäminen</strong></p><p><strong></strong> <br>\n  10.1. Sopimus tulee voimaan kun asiakas  hyväksyy tarjouksen. TOIMITTAJA lähettää nämä sopimusehdot tarjouksen ja  tilausvahvistuksen liitttenä. Sopimuksen&nbsp;voimassaoloaikaan ja sen  mukaisiin velvoitteisiin ei vaikuta se, milloin työnteko&nbsp;sopimuksen  perusteella tosiasiallisesti aloitetaan, lopetetaan tai  mahdollisesti&nbsp;keskeytetään. <br></p><p>\n  10.2. Sopimus on voimassa määräajan, ellei  toisin ole sovittu. Mikäli määräaikaisen&nbsp;sopimuksen  voimassaoloaikaa halutaan muuttaa, siitä tulee sopia sopijapuolten kesken&nbsp;kirjallisesti. <br>\n  10.3. Toistaiseksi voimassaolevissa  sopimuksissa irtisanomisaika on työntekijän työehtosopimuksen irtisanomisaikaan  lisättynä neljätoista päivää. <br></p><p>\n  10.4. Mikäli asiakas laiminlyö  maksuvelvollisuutensa tai toinen sopijapuoli muutoin&nbsp;olennaisesti rikkoo  sopimuksen yleisiä tai erityisiä ehtoja vastaan, toisella&nbsp;sopijapuolella  on oikeus purkaa sopimus päättymään välittömästi.&nbsp;Sopimusrikkomuksesta on  huomautettava toista sopijapuolta kirjallisesti ennen  sopimuksen&nbsp;purkamista. <br></p><p>\n  10.5. Jos toista sopijapuolta haetaan  konkurssiin tai yrityssaneeraukseen tai asetetaan&nbsp;selvitystilaan, toisella  sopijapuolella on oikeus purkaa sopimus. <br></p><p>\n  10.6. Sopijapuolella ei ole oikeutta siirtää tätä  sopimusta osaksikaan ilman toisen&nbsp;sopijapuolen kirjallista suostumusta. <br></p><p>\n  <strong>1. Oikeuspaikka</strong></p><p><strong></strong> <br>\n  11.1. Sopijapuolet pyrkivät ratkaisemaan  tästä sopimuksesta aiheutuvat erimielisyydet&nbsp;neuvotteluteitse.&nbsp;Mikäli sopijapuolet eivät pääse neuvotteluissa  yksimielisyyteen, riidat ratkaistaan&nbsp;ensimmäisenä oikeusasteena Turun  käräjäoikeudessa. </p>\n<p><strong>12. Ilmoitukset ja Reklamaatiot</strong></p><p><strong></strong> <br>\n  12.1. Sopijapuolten tulee lähettää  sopimukseen liittyvät ilmoitukset ja reklamoinnit sähköpostitse osoitteeseen  reklamaatiot@ratayhtio.fi. </p>\n<p><strong>13. Yhteyshenkilöt</strong></p><p><strong></strong> <br>\n  Kumpikin osapuoli nimeää vähintään yhden  yhteyshenkilön johtamaan ja valvomaan&nbsp;sopimuksen täyttämistä. TOIMITTAJA:n  yhteyshenkilö nimetään TOIMITTAJA:n toimittamissa tarjouksissa ja  tilausvahvistuksissa.</p>\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `erp_emails`
--

CREATE TABLE `erp_emails` (
  `email_id` int(12) NOT NULL,
  `subject` text NOT NULL,
  `bodyhtml` text NOT NULL,
  `bodytext` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `erp_emails`
--

INSERT INTO `erp_emails` (`email_id`, `subject`, `bodyhtml`, `bodytext`) VALUES
(1, 'HRM-ilmoitus: Kooste työsopimusten, pätevyyksien ja koeaikojen päättymisestä', 'Kooste työsopimusten, pätevyyksien ja koeaikojen päättymisestä.<br><br><b>Nämä työsopimukset päätyvät 30-päivän sisällä<br></b>\n{agreements}<br><br>Jos työsuhde ei jatku pyydä henkilöä palauttamaan kuittaamansa varusteet ja ilmoita työsuhteen päättymisestä sähköpostilla <a href=\"mailto:info@jarkeva.fi\">info@jarkeva.fi</a>.<br><br><b>Nämä pätevyydet erääntyvät 30-päivän sisällä<br></b>{qualifications}<br><br>Selvitä työntekijöiden uudelleenkoulutustarve ja päivitä tarvittaessa pätevyys vähintään 7 päivää ennen erääntymistä.<br><br><b>Nämä koeajat erääntyvät 30-päivän sisällä<br></b>{trials}<b><br></b><br>Tarkasta asiakkaalta ja työntekijän työmaalla olevilta esimiehiltä ja \nkolleegoilta töiden sujuminen sekä anna koeaikapalaute työntekijälle.\n\n', 'Kooste työsopimusten, pätevyyksien ja koeaikojen päättymisestä.\n\nNämä työsopimukset päätyvät 30-päivän sisällä\n{agreements}\n\nJos työsuhde ei jatku pyydä henkilöä palauttamaan kuittaamansa varusteet ja ilmoita työsuhteen päättymisestä sähköpostilla info@jarkeva.fi.\n\nNämä pätevyydet erääntyvät 30-päivän sisällä\n{qualifications}\n\nSelvitä työntekijöiden uudelleenkoulutustarve ja päivitä tarvittaessa pätevyys vähintään 7 päivää ennen erääntymistä.\n\nNämä koeajat erääntyvät 30-päivän sisällä\n{trials}\n\nTarkasta asiakkaalta ja työntekijän työmaalla olevilta esimiehiltä ja kolleegoilta töiden sujuminen sekä anna koeaikapalaute työntekijälle. '),
(2, 'HRM-ilmoitus: Sinulla on käsittelemättömiä tuntikortteja', 'Hei, {fullname},<br><br>Sinulla on käsittelemättömiä tuntikortteja. Kirjaudu portaaliin, {erp_link}.', 'Hei {fullname},\n\nSinulla on käsittelemättömiä tuntikortteja. Kirjaudu portaaliin, {erp_link}. '),
(3, ' Sinulla on käsittelemättömiä laskuja', 'Hei, ({username}), {fullname},<br><br>Sinulla on käsittelemättömiä laskuja. Kirjaudu portaaliin, {erp_link}.\n\n', 'Hei, ({username}), {fullname},\n\nSinulla on käsittelemättömiä laskuja. Kirjaudu portaaliin, {erp_link}. '),
(4, 'Sinulla on käsittelemättömiä laskuja joiden eräpäivä on kolmen päivän kuluttua tai lähempänä', 'Hei, ({username}), {fullname},<br><br>Sinulla on käsittelemättömiä laskuja joiden eräpäivä on kolmen päivän kuluttua tai lähempänä. Kirjaudu portaaliin, {erp_link}.\n\n', 'Hei, ({username}), {fullname},\n\nSinulla on käsittelemättömiä laskuja joiden eräpäivä on kolmen päivän kuluttua tai lähempänä. Kirjaudu portaaliin, {erp_link}.'),
(5, 'HRM-ilmoitus: Sinulle on tullut tuntikortti tarkastattevaksi', 'Teille on tullut henkilöltä {fullname} aikajaksolta \n\"{startdate}-{enddate}\" työkohteesta {workplace}\nasiatarkastettavaksi.<br><br>Tarkastattehan tuntikortin viimeistään \nsopimusehtojemme mukaisten määräaikoja. Jos tuntikorttia ei ole \ntarkastettu sopimusehdoissamme määräaikojen mukaisesti, katsotaan se \nhyväksytyksi palkanmaksun ja laskutuksemme mahdollistamiseksi.<br><br>Tuntikortin pääsette tarkastamaan painamalla&nbsp;{erp_link}. <br><br>Terveisin,<br>{company_name}<br>\n{switch_phonenumber}<br>\n{company_email}', 'Teille on tullut henkilöltä {fullname} aikajaksolta ”{startdate}-{enddate}” työkohteesta {workplace} asiatarkastettavaksi.\n\nTarkastattehan tuntikortin viimeistään sopimusehtojemme mukaisten määräaikoja. Jos tuntikorttia ei ole tarkastettu sopimusehdoissamme määräaikojen mukaisesti, katsotaan se hyväksytyksi palkanmaksun ja laskutuksemme mahdollistamiseksi.\n\nTuntikortin pääsette tarkastamaan painamalla - {erp_link}.\n\nTerveisin,\n{company_name}\n{switch_phonenumber}\n{company_email}'),
(6, 'HRM-ilmoitus: Asiakas hyväksyi tuntikortin', 'Hei, {fullname},<br><br>Asiakas {customer_person_company} ({customer_person_name}, {customer_person_email}) hyväksyi henkilön {fullname_employee} tuntikortin aikaväliltä \"{startdate}-{enddate}\" työkohteesta tai työkohteista {workplace}.<br><br>Kirjaudu portaaliin, {erp_link}.<br><br>Terveisin,<br>{company_name}<br>\n{switch_phonenumber}<br>\n{company_email}<br>\n\n', 'Hei {fullname},\n\nKirjaudu portaaliin, {erp_link}.\n\nTerveisin,\n{company_name}\n{switch_phonenumber}\n{company_email}'),
(7, 'HRM-ilmoitus: Asiakas palautti tuntikortin virheellisenä', 'Hei {fullname},<br><br>Asiakas {customer_person_company} ({customer_person_name}, {customer_person_email}) palautti tuntikortin virheellisenäaikaväliltä aikaväliltä \"{startdate}-{enddate}\" työkohteesta tai työkohteista {workplace}. Korjaathan tuntikortin sisällön ja toimitat uuden kortin tarkastettavaksi. Epäselvyyksissä voit ottaa yhteyttä lähiesimieheesi. Kirjaudu portaaliin, {erp_link}.\n\n<br><br><br>', 'Hei {fullname},\n\nAsiakas palautti tuntikortin virheellisenä. Kirjaudu portaaliin, {erp_link}. '),
(8, 'HRM: Pääkäyttäjä hyväksyi tuntikortin', 'Hei {fullname},<br><br>Pääkäyttäjä hyväksyi tuntikortin. Kirjaudu portaaliin, {erp_link}.\n\n', 'Hei {fullname},\n\nPääkäyttäjä hyväksyi tuntikortin. Kirjaudu portaaliin, {erp_link}. '),
(9, 'HRM: Pääkäyttäjä hylkäsi tuntikortin', 'Hei {fullname},<br><br>Pääkäyttäjä hylkäsi tuntikortin. Kirjaudu portaaliin, {erp_link}.\n\n', 'Hei {fullname},\n\nPääkäyttäjä hylkäsi tuntikortin. Kirjaudu portaaliin, {erp_link}.');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_agree`
--

CREATE TABLE `hrm_agree` (
  `agree_id` int(12) NOT NULL,
  `agree_name` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_agree`
--

INSERT INTO `hrm_agree` (`agree_id`, `agree_name`) VALUES
(1, 'Varallaoloon'),
(2, 'Tekemään lisä-, lauantai- sunnuntai-, ilta- yötyötä'),
(3, 'Tekemään ylitöitä'),
(4, 'Tekemään komennustöitä');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_agreements`
--

CREATE TABLE `hrm_agreements` (
  `agreement_id` int(12) NOT NULL,
  `start_date` date NOT NULL,
  `effective_date` date NOT NULL,
  `worktime` varchar(40) NOT NULL DEFAULT '1,2,3,4',
  `type_id` varchar(40) NOT NULL DEFAULT '1',
  `employee_id` int(12) NOT NULL,
  `site_id` int(12) NOT NULL,
  `workplace_id` int(12) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `hours_in_a_day` varchar(60) NOT NULL,
  `reason` text,
  `employee_agrees_worktime` varchar(40) NOT NULL DEFAULT '1',
  `warranty_work_hours` int(12) NOT NULL DEFAULT '14',
  `trial` varchar(500) NOT NULL DEFAULT 'Koeaika on puolet työsuhteen kestosta, maksimissaan 4 kuukautta.',
  `employer` varchar(100) NOT NULL DEFAULT 'MML-Resources Oy, y-tunnus 2098868-5',
  `active` enum('true','false') NOT NULL DEFAULT 'true',
  `additional` text,
  `terms_and_conditions` varchar(40) NOT NULL DEFAULT '1',
  `salary` decimal(12,2) NOT NULL DEFAULT '0.00',
  `salary_unit` varchar(20) NOT NULL DEFAULT 'h',
  `salary_terms_and_conditions` varchar(40) NOT NULL DEFAULT '1',
  `salary_other_what` varchar(255) DEFAULT NULL,
  `salary_payment_period` varchar(40) NOT NULL DEFAULT '1',
  `signature_date` date DEFAULT NULL,
  `signature_location` int(12) DEFAULT NULL,
  `benefits` text,
  `job_title` varchar(255) DEFAULT NULL,
  `tasks` text,
  `from_date` varchar(255) NOT NULL,
  `tes_id` int(12) NOT NULL DEFAULT '0',
  `customer_id` int(12) NOT NULL DEFAULT '0',
  `trial_end_date` date NOT NULL,
  `message_date` date DEFAULT NULL,
  `asuntoetu` float NOT NULL DEFAULT '0',
  `asuntoetu_sahko` float NOT NULL DEFAULT '0',
  `autotallietu` float NOT NULL DEFAULT '0',
  `ravintoetu` float NOT NULL DEFAULT '0',
  `autoetu` float NOT NULL DEFAULT '0',
  `puhelinetu` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_course_agreements`
--

CREATE TABLE `hrm_course_agreements` (
  `course_agreement_id` int(12) NOT NULL,
  `employee_id` int(12) NOT NULL,
  `course_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` date DEFAULT NULL,
  `value` double(12,2) NOT NULL DEFAULT '0.00',
  `agreement_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `additional_information` text COLLATE utf8_unicode_ci NOT NULL,
  `date_completed` date DEFAULT NULL,
  `expirion_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_customers`
--

CREATE TABLE `hrm_customers` (
  `customer_id` int(12) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `VAT-ID` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `customer_zip` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `customer_city` int(12) NOT NULL DEFAULT '0',
  `customer_phone` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `customer_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hrm_customers`
--

INSERT INTO `hrm_customers` (`customer_id`, `customer_name`, `VAT-ID`, `customer_address`, `customer_zip`, `customer_city`, `customer_phone`, `customer_email`) VALUES
(7, 'Järkevä - Ratkaisut', '-', '-', '', 0, '-', 'info@jarkeva.fi'),
(5, 'Alihankinta', '-', 'Ilmarinkatu 36 D 48', '33500', 0, '+358 40 8200 691', 'info@i4ware.fi'),
(6, 'Ratayhtiö Oy', '-', '-', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_dailymoney`
--

CREATE TABLE `hrm_dailymoney` (
  `dailymoney_id` int(12) NOT NULL,
  `year` year(4) NOT NULL,
  `sairaanhoitomaksu` float NOT NULL DEFAULT '0',
  `etuustulot` float NOT NULL DEFAULT '0',
  `paivarahamaksu` float NOT NULL DEFAULT '0',
  `lisarahoitusosuus` float NOT NULL DEFAULT '0',
  `yhteismaara` float NOT NULL DEFAULT '0',
  `sairausvakuutusmaksu` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_dailymoney`
--

INSERT INTO `hrm_dailymoney` (`dailymoney_id`, `year`, `sairaanhoitomaksu`, `etuustulot`, `paivarahamaksu`, `lisarahoitusosuus`, `yhteismaara`, `sairausvakuutusmaksu`) VALUES
(1, 2014, 0, 0, 0, 0, 0, 0),
(2, 2015, 0, 0, 0, 0, 0, 0),
(3, 2016, 0, 0, 0, 0, 0, 0),
(4, 2017, 0, 0, 0, 0, 0, 0),
(5, 2018, 0, 1.53, 1.53, 0.17, 14020, 0.86),
(6, 2019, 0, 0, 0, 0, 0, 0),
(7, 2020, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrm_education_names`
--

CREATE TABLE `hrm_education_names` (
  `education_id` int(12) NOT NULL,
  `education_name` varchar(255) NOT NULL,
  `education_type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_education_names`
--

INSERT INTO `hrm_education_names` (`education_id`, `education_name`, `education_type`) VALUES
(1, 'Ajojärjestelijän ', 'erikoisammattitutkinto'),
(2, 'Ajoneuvonosturinkuljettajan', 'ammattitutkinto'),
(3, 'Ammatilliseen peruskoulutukseen ohjaava ja valmistava koulutus', 'opetussuunnitelma'),
(4, 'Ammattisukeltajan', 'ammattitutkinto'),
(5, 'Arboristin ', 'ammattitutkinto'),
(6, 'Aseseppäkisällin', 'ammattitutkinto'),
(7, 'Aseseppämestarin', 'erikoisammattitutkinto'),
(8, 'Asiakirjahallinnon ja arkistotoimen', 'ammattitutkinto'),
(9, 'Asioimistulkin', 'ammattitutkinto'),
(10, 'Audiovisuaalisen viestinnän', 'ammattitutkinto'),
(11, 'Audiovisuaalisen viestinnän', 'erikoisammattitutkinto'),
(12, 'Audiovisuaalisen viestinnän', 'perustutkinto'),
(13, 'Autoalan', 'perustutkinto'),
(14, 'Autoalan myyjän', 'erikoisammattitutkinto'),
(15, 'Autoalan työnjohdon ', 'erikoisammattitutkinto'),
(16, 'Autokorimekaanikon', 'ammattitutkinto'),
(17, 'Autokorimestarin', 'erikoisammattitutkinto'),
(18, 'Automaalarimestarin', 'erikoisammattitutkinto'),
(19, 'Automaalarin', 'ammattitutkinto'),
(20, 'Automaatioasentajan', 'ammattitutkinto'),
(21, 'Automaatioyliasentajan ', 'erikoisammattitutkinto'),
(22, 'Automekaanikon', 'erikoisammattitutkinto'),
(23, 'Automyyjän', 'ammattitutkinto'),
(24, 'Autosähkömekaanikon', 'ammattitutkinto'),
(25, 'Baarimestarin', 'erikoisammattitutkinto'),
(26, 'Bioenergia-alan ', 'ammattitutkinto'),
(27, 'Boazodoalu', 'fidnodutkkus'),
(28, 'Catering-alan', 'perustutkinto'),
(29, 'Dieettikokin', 'erikoisammattitutkinto'),
(30, 'Digitaalipainajan', 'ammattitutkinto'),
(31, 'Duodjára ', 'fidnodutkkus'),
(32, 'Duodjemeastara', 'earenoamásfidnodutkkus'),
(33, 'Elektroniikka- ja sähköteollisuuden (nyk. Sähköteollisuuden)', 'ammattitutkinto'),
(34, 'Elektroniikka-asentajan ', 'ammattitutkinto'),
(35, 'Elektroniikkayliasentajan', 'erikoisammattitutkinto'),
(36, 'Elintarvikealan', 'perustutkinto'),
(37, 'Elintarvikejalostajan', 'ammattitutkinto'),
(38, 'Elintarviketekniikan', 'erikoisammattitutkinto'),
(39, 'Elintarviketeollisuuden', 'ammattitutkinto'),
(40, 'Eläintenhoitajan', 'ammattitutkinto'),
(41, 'Erä- ja luonto-oppaan', 'ammattitutkinto'),
(42, 'Faktorin', 'erikoisammattitutkinto'),
(43, 'Floristimestarin', 'erikoisammattitutkinto'),
(44, 'Floristin', 'ammattitutkinto'),
(45, 'Golfkenttämestarin', 'erikoisammattitutkinto'),
(46, 'Golfkentänhoitajan', 'ammattitutkinto'),
(47, 'Hammastekniikan ', 'perustutkinto'),
(48, 'Henkilöautomekaanikon', 'ammattitutkinto'),
(49, 'Hevostalouden', 'perustutkinto'),
(50, 'Hevostenvalmentajan', 'ammattitutkinto'),
(51, 'Hierojan', 'ammattitutkinto'),
(52, 'Hierojan', 'erikoisammattitutkinto'),
(53, 'Hissiasentajan', 'ammattitutkinto'),
(54, 'Hitsaajamestarin', 'erikoisammattitutkinto'),
(55, 'Hitsaajan', 'ammattitutkinto'),
(56, 'Hiusalan', 'ammattitutkinto'),
(57, 'Hiusalan', 'erikoisammattitutkinto'),
(58, 'Hiusalan', 'perustutkinto'),
(59, 'Hopeaseppämestarin', 'erikoisammattitutkinto'),
(60, 'Hopeasepän', 'ammattitutkinto'),
(61, 'Hotelli- ja ravintola-alan', 'perustutkinto'),
(62, 'Hotelli-, ravintola- ja catering-alan', 'perustutkinto'),
(63, 'Hotelli-, ravintola- ja suurtalous(nyk. Majoitus- ja ravitsemisalan)esimiehen ', 'erikoisammattitutkinto'),
(64, 'Hotellivirkailijan', 'ammattitutkinto'),
(65, 'Ilmastointiasentajan ', 'ammattitutkinto'),
(66, 'Ilmastointiasentajan ', 'erikoisammattitutkinto'),
(67, 'Ilmastointijärjestelmän puhdistajan', 'ammattitutkinto'),
(68, 'Informaatio- ja kirjastopalvelujen', 'ammattitutkinto'),
(69, 'Isännöinnin', 'ammattitutkinto'),
(70, 'Jalkinealan', 'ammattitutkinto'),
(71, 'Jalkinealan', 'erikoisammattitutkinto'),
(72, 'Jalkinealan', 'perustutkinto'),
(73, 'Jalkojenhoidon', 'ammattitutkinto'),
(74, 'Johtamisen', 'erikoisammattitutkinto'),
(75, 'Jälkikäsittelykoneenhoitajan', 'ammattitutkinto'),
(76, 'Kaivertajamestarin', 'erikoisammattitutkinto'),
(77, 'Kaivertajan ', 'ammattitutkinto'),
(78, 'Kaivosalan', 'perustutkinto'),
(79, 'Kaivosalan ', 'ammattitutkinto'),
(80, 'Kalanjalostajan ', 'ammattitutkinto'),
(81, 'Kalanviljelijän', 'ammattitutkinto'),
(82, 'Kalastusoppaan', 'ammattitutkinto'),
(83, 'Kalatalouden ', 'perustutkinto'),
(84, 'Karjatalouden (nyk. Tuotantoeläinten hoidon ja hyvinvoinnin)', 'ammattitutkinto'),
(85, 'Kaukolämpöasentajan ', 'ammattitutkinto'),
(86, 'Kaukolämpöyliasentajan', 'erikoisammattitutkinto'),
(87, 'Kauneudenhoitoalan', 'erikoisammattitutkinto'),
(88, 'Kauneudenhoitoalan', 'perustutkinto'),
(89, 'Kaupan esimiehen ', 'erikoisammattitutkinto'),
(90, 'Kehitysvamma-alan ', 'ammattitutkinto'),
(91, 'Kehitysvamma-alan ', 'erikoisammattitutkinto'),
(92, 'Kello- ja mikromekaniikan', 'perustutkinto'),
(93, 'Kemiantekniikan', 'perustutkinto'),
(94, 'Kemianteollisuuden', 'ammattitutkinto'),
(95, 'Kemianteollisuuden', 'erikoisammattitutkinto'),
(96, 'Kengityssepän', 'ammattitutkinto'),
(97, 'Keramiikkakisällin', 'ammattitutkinto'),
(98, 'Keramiikkamestarin', 'erikoisammattitutkinto'),
(99, 'Keruutuotetarkastajan (nyk. Luonnontuotealan)', 'ammattitutkinto'),
(100, 'Keruutuotetarkastajan (nyk. Luonnontuotealan)', 'erikoisammattitutkinto'),
(101, 'Kiinteistönhoitajan', 'ammattitutkinto'),
(102, 'Kiinteistönhoitajan', 'erikoisammattitutkinto'),
(103, 'Kiinteistönvälitysalan', 'ammattitutkinto'),
(104, 'Kiinteistöpalvelujen', 'perustutkinto'),
(105, 'Kipsausalan ', 'ammattitutkinto'),
(106, 'Kipsimestarin', 'erikoisammattitutkinto'),
(107, 'Kirjansitojamestarin', 'erikoisammattitutkinto'),
(108, 'Kirjansitojan ', 'ammattitutkinto'),
(109, 'Kiskoliikenteen turvalaiteasentajan', 'ammattitutkinto'),
(110, 'Kivimiehen', 'ammattitutkinto'),
(111, 'Kiviseppäkisällin', 'ammattitutkinto'),
(112, 'Kiviseppämestarin', 'erikoisammattitutkinto'),
(113, 'Koe-eläintenhoitajan', 'erikoisammattitutkinto'),
(114, 'Kondiittorimestarin ', 'erikoisammattitutkinto'),
(115, 'Kondiittorin ', 'ammattitutkinto'),
(116, 'Kone- ja metallialan', 'perustutkinto'),
(117, 'Koneenasentajamestarin', 'erikoisammattitutkinto'),
(118, 'Koneenasentajan', 'ammattitutkinto'),
(119, 'Koneistajamestarin', 'erikoisammattitutkinto'),
(120, 'Koneistajan', 'ammattitutkinto'),
(121, 'Konesitojamestarin', 'erikoisammattitutkinto'),
(122, 'Korroosionestomaalarin', 'ammattitutkinto'),
(123, 'Kosmetologin (nyk. Kauneudenhoitoalan)', 'erikoisammattitutkinto'),
(124, 'Kotitalous- ja kuluttajapalvelujen', 'perustutkinto'),
(125, 'Kotitalouskoneasentajan', 'ammattitutkinto'),
(126, 'Kotitalousopetus (talouskoulu)', 'opetussuunnitelma'),
(127, 'Kotityö- ja puhdistuspalvelujen', 'perustutkinto'),
(128, 'Kotityöpalvelujen', 'ammattitutkinto'),
(129, 'Koululaisten aamu- ja iltapäivätoiminnan ohjaajan ', 'ammattitutkinto'),
(130, 'Koulunkäynnin ja aamu- ja iltapäivätoiminnan ohjauksen', 'ammattitutkinto'),
(131, 'Koulunkäynnin ja aamu- ja iltapäivätoiminnan ohjauksen', 'erikoisammattitutkinto'),
(132, 'Koulunkäyntiavustajan', 'ammattitutkinto'),
(133, 'Koulunkäyntiavustajan', 'erikoisammattitutkinto'),
(134, 'Kultaajakisällin ', 'ammattitutkinto'),
(135, 'Kultaajamestarin ', 'erikoisammattitutkinto'),
(136, 'Kultaseppämestarin', 'erikoisammattitutkinto'),
(137, 'Kultasepän', 'ammattitutkinto'),
(138, 'Kumialan', 'ammattitutkinto'),
(139, 'Kunnossapidon', 'ammattitutkinto'),
(140, 'Kunnossapidon', 'erikoisammattitutkinto'),
(141, 'Kuvallisen ilmaisun', 'perustutkinto'),
(142, 'Kylmäasentajan', 'ammattitutkinto'),
(143, 'Kylmämestarin', 'erikoisammattitutkinto'),
(144, 'Käsi- ja taideteollisuusalan', 'perustutkinto'),
(145, 'Käsityömestarin', 'erikoisammattitutkinto'),
(146, 'Käsityönteknijän', 'ammattitutkinto'),
(147, 'Laboratorioalan', 'perustutkinto'),
(148, 'Laitoshuoltajan', 'ammattitutkinto'),
(149, 'Laivanrakennusalan', 'erikoisammattitutkinto'),
(150, 'Laivanrakentajan', 'ammattitutkinto'),
(151, 'Laivasähkömestarin', 'erikoisammattitutkinto'),
(152, 'Lapsi- ja perhetyön', 'perustutkinto'),
(153, 'Lasikeraamisen alan', 'ammattitutkinto'),
(154, 'Lasinpuhaltajakisällin', 'ammattitutkinto'),
(155, 'Lasinpuhaltajamestarin', 'erikoisammattitutkinto'),
(156, 'Lasten ja nuorten erityisohjaajan', 'ammattitutkinto'),
(157, 'Lastinkäsittelyalan', 'ammattitutkinto'),
(158, 'Lastinkäsittelyalan', 'erikoisammattitutkinto'),
(159, 'Lattiamestarin', 'erikoisammattitutkinto'),
(160, 'Lattianpäällystäjän', 'ammattitutkinto'),
(161, 'Laukku- ja nahka-alan', 'ammattitutkinto'),
(162, 'Laukku- ja nahkamestarin', 'erikoisammattitutkinto'),
(163, 'Leipomoteollisuuden', 'ammattitutkinto'),
(164, 'Leipurimestarin ', 'erikoisammattitutkinto'),
(165, 'Leipurin ', 'ammattitutkinto'),
(166, 'Lennonjohdon ', 'perustutkinto'),
(167, 'Lentoasemapalvelujen', 'ammattitutkinto'),
(168, 'Lentokonetekniikan', 'ammattitutkinto'),
(169, 'Lentokonetekniikan', 'erikoisammattitutkinto'),
(170, 'Lentokoneasennuksen', 'perustutkinto'),
(171, 'Levyalan ', 'ammattitutkinto'),
(172, 'Levymestarin ', 'erikoisammattitutkinto'),
(173, 'Levytekniikan ', 'ammattitutkinto'),
(174, 'Levytyömestarin', 'erikoisammattitutkinto'),
(175, 'Lihanjalostajan', 'ammattitutkinto'),
(176, 'Lihantarkastuksen ', 'ammattitutkinto'),
(177, 'Lihateollisuuden', 'ammattitutkinto'),
(178, 'Liikenne-esimiehen', 'erikoisammattitutkinto'),
(179, 'Liikenneopettajan', 'erikoisammattitutkinto'),
(180, 'Liiketalouden ', 'perustutkinto'),
(181, 'Liikunnan', 'ammattitutkinto'),
(182, 'Liikunnanohjauksen', 'perustutkinto'),
(183, 'Liikuntapaikkamestarin', 'erikoisammattitutkinto'),
(184, 'Liikuntapaikkojen hoitajan', 'ammattitutkinto'),
(185, 'Linja-autonkuljettajan ', 'ammattitutkinto'),
(186, 'Logistiikan', 'perustutkinto'),
(187, 'Lukkoseppämestarin', 'erikoisammattitutkinto'),
(188, 'Lukkosepän ', 'ammattitutkinto'),
(189, 'Luonnonmukaisen tuotannon', 'ammattitutkinto'),
(190, 'Luonnontieteellisen alan konservoinnin', 'ammattitutkinto'),
(191, 'Luonnontuotealan (e. Keruutuotetarkastajan)', 'ammattitutkinto'),
(192, 'Luonnontuotealan (e. Keruutuotetarkastajan)', 'erikoisammattitutkinto'),
(193, 'Luonto- ja ympäristöalan', 'perustutkinto'),
(194, 'Luontokartoittajan', 'erikoisammattitutkinto'),
(195, 'Lämmityslaiteasentajan ', 'ammattitutkinto'),
(196, 'Lääkealan', 'perustutkinto'),
(197, 'Maahanmuuttajien ammatilliseen peruskoulutukseen valmistava koulutus', 'opetussuunnitelma'),
(198, 'Maalarimestarin', 'erikoisammattitutkinto'),
(199, 'Maalarin', 'ammattitutkinto'),
(200, 'Maanmittausalan', 'ammattitutkinto'),
(201, 'Maanmittausalan', 'perustutkinto'),
(202, 'Maarakennusalan', 'ammattitutkinto'),
(203, 'Maarakennusalan', 'erikoisammattitutkinto'),
(204, 'Maaseudun kehittäjän', 'erikoisammattitutkinto'),
(205, 'Maaseudun vesitalouden', 'erikoisammattitutkinto'),
(206, 'Maaseutumatkailun', 'ammattitutkinto'),
(207, 'Maatalousalan', 'perustutkinto'),
(208, 'Maatalouskoneasentajan ', 'ammattitutkinto'),
(209, 'Maidonjalostajan', 'ammattitutkinto'),
(210, 'Majoitus- ja ravitsemisalan (e. Hotelli-, ravintola- ja suurtalous)esimiehen', 'erikoisammattitutkinto'),
(211, 'Mallinrakentajakisällin', 'ammattitutkinto'),
(212, 'Mallinrakentajamestarin', 'erikoisammattitutkinto'),
(213, 'Markkinointiviestinnän ', 'ammattitutkinto'),
(214, 'Markkinointiviestinnän ', 'erikoisammattitutkinto'),
(215, 'Matkailualan', 'perustutkinto'),
(216, 'Matkailun ohjelmapalvelujen', 'ammattitutkinto'),
(217, 'Matkaoppaan', 'ammattitutkinto'),
(218, 'Matkatoimistovirkailijan', 'ammattitutkinto'),
(219, 'Mehiläistarhaajan', 'ammattitutkinto'),
(220, 'Meijeriteollisuuden', 'ammattitutkinto'),
(221, 'Merenkulkualan', 'perustutkinto'),
(222, 'Metallien jalostuksen', 'ammattitutkinto'),
(223, 'Metsäalan', 'perustutkinto'),
(224, 'Metsäkoneasentajan', 'ammattitutkinto'),
(225, 'Metsäkoneenkuljettajan', 'ammattitutkinto'),
(226, 'Metsäkoneenkuljettajan (nyk. Puunkorjuun)', 'erikoisammattitutkinto'),
(227, 'Metsämestarin', 'erikoisammattitutkinto'),
(228, 'Metsätalouden ', 'perustutkinto'),
(229, 'Metsätalousyrittäjän', 'ammattitutkinto'),
(230, 'Mittaajan ja kalibroijan', 'ammattitutkinto'),
(231, 'Muovi- ja kumitekniikan', 'perustutkinto'),
(232, 'Muovimekaanikon', 'ammattitutkinto'),
(233, 'Muovitekniikan', 'erikoisammattitutkinto'),
(234, 'Musiikkialan ', 'perustutkinto'),
(235, 'Myynnin', 'ammattitutkinto'),
(236, 'Nahanvalmistajamestarin', 'erikoisammattitutkinto'),
(237, 'Nahanvalmistajan', 'ammattitutkinto'),
(238, 'Nuohoojamestarin', 'erikoisammattitutkinto'),
(239, 'Nuohoojan', 'ammattitutkinto'),
(240, 'Nuoriso- ja vapaa-ajan ohjauksen', 'perustutkinto'),
(241, 'Näkövammaistaitojen ohjaajan', 'erikoisammattitutkinto'),
(242, 'Obduktiopreparaattorin', 'ammattitutkinto'),
(243, 'Oikeustulkin', 'erikoisammattitutkinto'),
(244, 'Optiikkahiojan', 'ammattitutkinto'),
(245, 'Painajamestarin/rotaatiomestarin', 'erikoisammattitutkinto'),
(246, 'Painajan ', 'ammattitutkinto'),
(247, 'Painopinnanvalmistajan', 'ammattitutkinto'),
(248, 'Painoviestinnän', 'perustutkinto'),
(249, 'Paperiteollisuuden', 'ammattitutkinto'),
(250, 'Paperiteollisuuden', 'erikoisammattitutkinto'),
(251, 'Paperiteollisuuden', 'perustutkinto'),
(252, 'Perhepäivähoitajan', 'ammattitutkinto'),
(253, 'Pesulateknikon', 'erikoisammattitutkinto'),
(254, 'Pienkonemekaanikon', 'ammattitutkinto'),
(255, 'Pintakäsittelyalan', 'perustutkinto'),
(256, 'Pintakäsittelymestarin', 'erikoisammattitutkinto'),
(257, 'Porotalouden ', 'ammattitutkinto'),
(258, 'Prosessiteollisuuden ', 'perustutkinto'),
(259, 'Psykiatrisen hoidon', 'erikoisammattitutkinto'),
(260, 'Puhdistuspalvelujen', 'perustutkinto'),
(261, 'Puhevammaisten tulkin', 'erikoisammattitutkinto'),
(262, 'Puistomestarin', 'erikoisammattitutkinto'),
(263, 'Puistopuutarhurin', 'ammattitutkinto'),
(264, 'Putkiasentajan ', 'ammattitutkinto'),
(265, 'Putkiasentajan ', 'erikoisammattitutkinto'),
(266, 'Puualan', 'perustutkinto'),
(267, 'Puunkorjuun', 'erikoisammattitutkinto'),
(268, 'Puusepänalan', 'ammattitutkinto'),
(269, 'Puusepänalan', 'erikoisammattitutkinto'),
(270, 'Puutarhatalouden', 'perustutkinto'),
(271, 'Puutavaran autokuljetuksen', 'ammattitutkinto'),
(272, 'Päihdetyön', 'ammattitutkinto'),
(273, 'Päivähoitajan', 'ammattitutkinto'),
(274, 'Rahoitus- ja vakuutusalan', 'ammattitutkinto'),
(275, 'Rakennusalan', 'perustutkinto'),
(276, 'Rakennusalan työmaapäällikön', 'erikoisammattitutkinto'),
(277, 'Rakennuspeltiseppämestarin ', 'erikoisammattitutkinto'),
(278, 'Rakennuspeltisepän ', 'ammattitutkinto'),
(279, 'Rakennustuotannon', 'ammattitutkinto'),
(280, 'Rakennustuotealan', 'ammattitutkinto'),
(281, 'Raskaskalustomekaanikon ', 'ammattitutkinto'),
(282, 'Ratsastuksenopettajan', 'ammattitutkinto'),
(283, 'Ratsastuksenopettajan', 'erikoisammattitutkinto'),
(284, 'Rautatiekaluston kunnossapidon', 'ammattitutkinto'),
(285, 'Ravintolakokin', 'ammattitutkinto'),
(286, 'Rengasalan', 'ammattitutkinto'),
(287, 'Restaurointikisällin', 'ammattitutkinto'),
(288, 'Restaurointimestarin', 'erikoisammattitutkinto'),
(289, 'Riistamestarin', 'erikoisammattitutkinto'),
(290, 'Romanikulttuurin ohjaajan', 'ammattitutkinto'),
(291, 'Romanikulttuurin ohjaajan', 'erikoisammattitutkinto'),
(292, 'Rotaatiomestarin', 'erikoisammattitutkinto'),
(293, 'Ruokamestarin', 'erikoisammattitutkinto'),
(294, 'Rytmimusiikkituotannon', 'ammattitutkinto'),
(295, 'Saamenkäsityökisällin', 'ammattitutkinto'),
(296, 'Saamenkäsityömestarin', 'erikoisammattitutkinto'),
(297, 'Saha-alan  ', 'ammattitutkinto'),
(298, 'Sahamestarin', 'erikoisammattitutkinto'),
(299, 'Sairaankuljettajan', 'ammattitutkinto'),
(300, 'Seminologin', 'ammattitutkinto'),
(301, 'Seppäkisällin', 'ammattitutkinto'),
(302, 'Seppämestarin', 'erikoisammattitutkinto'),
(303, 'Sihteerin', 'ammattitutkinto'),
(304, 'Siivousteknikon', 'erikoisammattitutkinto'),
(305, 'Siivoustyönohjaajan', 'ammattitutkinto'),
(306, 'Sirkusalan', 'perustutkinto'),
(307, 'Sisustusalan ', 'ammattitutkinto'),
(308, 'Sisustusalan ', 'erikoisammattitutkinto'),
(309, 'Sivunvalmistajamestarin', 'erikoisammattitutkinto'),
(310, 'Soitinrakentajakisällin ', 'ammattitutkinto'),
(311, 'Soitinrakentajamestarin ', 'erikoisammattitutkinto'),
(312, 'SORA - Opiskeluun soveltumattomuuden ratkaisuja', 'ammattitutkinto'),
(313, 'SORA - Opiskeluun soveltumattomuuden ratkaisuja', 'erikoisammattitutkinto'),
(314, 'Sosiaali- ja terveysalan', 'perustutkinto'),
(315, 'Suntion', 'ammattitutkinto'),
(316, 'Suunnitteluassistentin', 'perustutkinto'),
(317, 'Suunnitteluassistentin ', 'ammattitutkinto'),
(318, 'Suurtalouskokin', 'ammattitutkinto'),
(319, 'Sähkö- ja automaatiotekniikan', 'perustutkinto'),
(320, 'Sähköalan', 'perustutkinto'),
(321, 'Sähköasentajan', 'ammattitutkinto'),
(322, 'Sähkölaitosasentajan', 'ammattitutkinto'),
(323, 'Sähköteollisuuden (e. Elektroniikka- ja sähköteollisuuden)', 'ammattitutkinto'),
(324, 'Sähköverkkoalan ', 'erikoisammattitutkinto'),
(325, 'Sähköverkkoasentajan', 'ammattitutkinto'),
(326, 'Sähköyliasentajan', 'erikoisammattitutkinto'),
(327, 'Taimistomestarin', 'erikoisammattitutkinto'),
(328, 'Tallimestarin', 'erikoisammattitutkinto'),
(329, 'Talonrakennusalan ', 'ammattitutkinto'),
(330, 'Talonrakennusalan ', 'erikoisammattitutkinto'),
(331, 'Talotekniikan', 'perustutkinto'),
(332, 'Taloushallinnon ', 'ammattitutkinto'),
(333, 'Taloushallinnon ', 'erikoisammattitutkinto'),
(334, 'Tanssialan', 'perustutkinto'),
(335, 'Tarhaajamestarin', 'erikoisammattitutkinto'),
(336, 'Tarjoilijan', 'ammattitutkinto'),
(337, 'Teatterialan', 'ammattitutkinto'),
(338, 'Teatterialan', 'erikoisammattitutkinto'),
(339, 'Tekniikan', 'erikoisammattitutkinto'),
(340, 'Teknisen eristäjän ', 'ammattitutkinto'),
(341, 'Teknisen piirtäjän', 'ammattitutkinto'),
(342, 'Tekstiili- ja vaatetusalan', 'perustutkinto'),
(343, 'Tekstiilialan', 'ammattitutkinto'),
(344, 'Tekstiilialan', 'erikoisammattitutkinto'),
(345, 'Tekstiilialan', 'perustutkinto'),
(346, 'Tekstiilihuollon', 'ammattitutkinto'),
(347, 'Teollisen pintakäsittelijän', 'ammattitutkinto'),
(348, 'Teollisuusputkiasentajan', 'ammattitutkinto'),
(349, 'Tieto- ja kirjastopalvelujen', 'ammattitutkinto'),
(350, 'Tieto- ja tietoliikennetekniikan', 'ammattitutkinto'),
(351, 'Tieto- ja tietoliikennetekniikan', 'erikoisammattitutkinto'),
(352, 'Tieto- ja tietoliikennetekniikan ', 'perustutkinto'),
(353, 'Tieto- ja viestintätekniikan', 'ammattitutkinto'),
(354, 'Tieto- ja viestintätekniikan', 'erikoisammattitutkinto'),
(355, 'Tieto- ja viestintätekniikan', 'perustutkinto'),
(356, 'Tietojenkäsittelyn', 'ammattitutkinto'),
(357, 'Tietojenkäsittelyn', 'erikoisammattitutkinto'),
(358, 'Tietojenkäsittelyn', 'perustutkinto'),
(359, 'Tietokoneasentajan', 'ammattitutkinto'),
(360, 'Tietokoneyliasentajan', 'erikoisammattitutkinto'),
(361, 'Tietoliikenneasentajan', 'ammattitutkinto'),
(362, 'Tietoliikenneyliasentajan', 'erikoisammattitutkinto'),
(363, 'Tullialan ', 'ammattitutkinto'),
(364, 'Tuotantoeläinten hoidon ja hyvinvoinnin (e. Karjatalouden)', 'ammattitutkinto'),
(365, 'Tuotekehittäjän ', 'erikoisammattitutkinto'),
(366, 'Turkkurimestarin', 'erikoisammattitutkinto'),
(367, 'Turkkurin', 'ammattitutkinto'),
(368, 'Turvallisuusalan', 'perustutkinto'),
(369, 'Turvallisuusvalvojan', 'erikoisammattitutkinto'),
(370, 'Tuulivoima-asentajan', 'ammattitutkinto'),
(371, 'Työvalmennuksen', 'erikoisammattitutkinto'),
(372, 'Työvälinemestarin', 'erikoisammattitutkinto'),
(373, 'Työvälinevalmistajan', 'ammattitutkinto'),
(374, 'Ulkomaankaupan', 'ammattitutkinto'),
(375, 'Ulkomaankaupan', 'erikoisammattitutkinto'),
(376, 'Vaatetusalan', 'ammattitutkinto'),
(377, 'Vaatetusalan', 'erikoisammattitutkinto'),
(378, 'Vaatetusalan', 'perustutkinto'),
(379, 'Valajamestarin', 'erikoisammattitutkinto'),
(380, 'Valajan', 'ammattitutkinto'),
(381, 'Valmentajan', 'ammattitutkinto'),
(382, 'Valmentajan', 'erikoisammattitutkinto'),
(383, 'Valokuvaajan', 'ammattitutkinto'),
(384, 'Valokuvaajan', 'erikoisammattitutkinto'),
(385, 'Valumallimestarin', 'erikoisammattitutkinto'),
(386, 'Valumallin valmistajan', 'ammattitutkinto'),
(387, 'Vammaisten opiskelijoiden valmentava ja kuntouttava opetus ja ohjaus ammatillisessa peruskoulutuksessa', 'opetussuunnitelma'),
(388, 'Vanhustyön', 'erikoisammattitutkinto'),
(389, 'Varaosamyyjän', 'ammattitutkinto'),
(390, 'Varastoalan', 'ammattitutkinto'),
(391, 'Varastoalan', 'erikoisammattitutkinto'),
(392, 'Vartijan', 'ammattitutkinto'),
(393, 'Veneenrakennuksen', 'perustutkinto'),
(394, 'Veneenrakentajan', 'ammattitutkinto'),
(395, 'Venemestarin', 'erikoisammattitutkinto'),
(396, 'Verhoilijamestarin', 'erikoisammattitutkinto'),
(397, 'Verhoilijan ', 'ammattitutkinto'),
(398, 'Verhoilualan', 'perustutkinto'),
(399, 'Verhoilu- ja sisustusalan', 'perustutkinto'),
(400, 'Vesihuoltoalan', 'ammattitutkinto'),
(401, 'Viestinvälitys- ja logistiikkapalvelujen ', 'ammattitutkinto'),
(402, 'Viestinvälitys- ja logistiikkapalvelujen ', 'erikoisammattitutkinto'),
(403, 'Vihersisustajan', 'ammattitutkinto'),
(404, 'Viinintuotannon', 'ammattitutkinto'),
(405, 'Viittomakielisen ohjauksen', 'perustutkinto'),
(406, 'Viljelijän', 'ammattitutkinto'),
(407, 'Viljelypuutarhurin', 'ammattitutkinto'),
(408, 'Virastomestarin', 'ammattitutkinto'),
(409, 'Voimalaitoksen käyttäjän', 'ammattitutkinto'),
(410, 'Välinehuoltajan', 'ammattitutkinto'),
(411, 'Välinehuoltajan', 'erikoisammattitutkinto'),
(412, 'Yhdistelmäajoneuvonkuljettjan ', 'ammattitutkinto'),
(413, 'Ympäristöalan', 'erikoisammattitutkinto'),
(414, 'Ympäristöhuollon', 'ammattitutkinto'),
(415, 'Yrittäjän', 'ammattitutkinto'),
(416, 'Yrittäjän', 'erikoisammattitutkinto'),
(417, 'Yritysjohtamisen ', 'erikoisammattitutkinto'),
(418, 'Yritysneuvojan', 'erikoisammattitutkinto'),
(419, 'Sähkötyöturvallisuuskoulutus SFS6002', 'Yleisesti hyväksytty'),
(420, 'Ensiapukoulutus EA1', 'Yleisesti hyväksytty'),
(421, 'Ensiapukoulutus EA2', 'Yleisesti hyväksytty'),
(422, 'Työturvallisuuskortti', 'Yleisesti hyväksytty'),
(423, 'Turva-koulutus ratatyöhön', 'Yleisesti hyväksytty'),
(424, 'Tulityökortti', 'Yleisesti hyväksytty'),
(425, 'Vesityökortti', 'Yleisesti hyväksytty'),
(426, 'Henkilönostinkoulutus', 'Yleisesti hyväksytty'),
(427, 'TEVI-Tarkastus', 'Viranomaiskoulutus'),
(428, 'Turvamieskoulutus', 'Viranomaiskoulutus'),
(429, 'Ratatyöstä Vastaavan Koulutus', 'Viranomaiskoulutus'),
(430, 'Tieturvakoulutus 1', 'Viranomaiskoulutus'),
(431, 'Tieturvakoulutus 2', 'Viranomaiskoulutus'),
(432, 'Jännitekatkopätevyys', 'Sisäinen koulutus'),
(433, 'Laiturityöskentelypätevyys', 'Viranomaiskoulutus'),
(434, 'Sähköpätevyys 1', 'Viranomaiskoulutus'),
(435, 'Sähköpätevyys 2', 'Viranomaiskoulutus'),
(436, 'Turvalaite-asentajakoulutus', 'Viranomaiskoulutus'),
(437, 'Trukkikortti', 'Yleisesti hyväksytty'),
(438, 'Työkonekuljettaja', 'Viranomaiskoulutus'),
(446, 'Hätäensiapukurssi', 'Yleisesti hyväksytty'),
(447, 'YTJ-ote', 'Yleisesti hyväksytty'),
(448, 'IRATA Level 3 -pätevyys', 'Yleisesti hyväksytty'),
(449, 'TyEL-vakuutuksen maksutodistus', 'Yleisesti hyväksytty'),
(450, 'Vastuuvakuutustodistus', 'Yleisesti hyväksytty'),
(451, 'Todistus verojen maksamisesta', 'Yleisesti hyväksytty'),
(452, 'Hygieniaosaamistodistus', 'Viranomaiskoulutus'),
(453, 'Tulityökortti, katto- ja vedeneristysala', 'Yleisesti hyväksytty'),
(454, 'Työturvakoulutus, kuljetusala', 'Yleisesti hyväksytty'),
(455, 'TK (Liitu)', 'Viranomaiskoulutus'),
(456, 'Turvavaljaat', 'Sisäinen tarkastus'),
(457, 'Mastotarkastus', 'Yleisesti hyväksytty'),
(458, 'Petzl - Jälleenmyyjän korkeanpaikantyöskentelyn peruskoulutus.', 'Yleisesti hyväksytty');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employees`
--

CREATE TABLE `hrm_employees` (
  `employee_id` int(12) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `sotu` varchar(40) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip` varchar(40) NOT NULL,
  `city` int(12) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `taxnumber` varchar(60) NOT NULL,
  `cv_file` varchar(255) NOT NULL,
  `jobseeker` enum('true','false') NOT NULL,
  `bank_account` varchar(100) NOT NULL,
  `user_id` int(12) NOT NULL DEFAULT '0',
  `BIC` varchar(255) NOT NULL DEFAULT '-',
  `taxation_city` varchar(255) NOT NULL DEFAULT '-',
  `basic_prosent` float NOT NULL DEFAULT '0',
  `extra_prosent` float NOT NULL DEFAULT '0',
  `Yearlysalarylimit` varchar(255) NOT NULL DEFAULT '-',
  `Taxationcountingmethod` enum('A','B') NOT NULL DEFAULT 'A',
  `Taxcard_come_into_effect_date` date DEFAULT NULL,
  `Retrimentmodel` enum('YEL','TYEL alle 53','TYEL yli 53') NOT NULL DEFAULT 'TYEL yli 53',
  `AY_membershippaymentpersent` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_employment_type`
--

CREATE TABLE `hrm_employment_type` (
  `type_id` int(12) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_employment_type`
--

INSERT INTO `hrm_employment_type` (`type_id`, `type_name`) VALUES
(1, 'Määräaikainen'),
(2, 'Osa-aikainen'),
(3, 'Toistaiseksi voimassa oleva');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_qualifications`
--

CREATE TABLE `hrm_qualifications` (
  `qualification_id` bigint(24) NOT NULL,
  `employee_id` int(12) NOT NULL,
  `qualification_name` int(12) NOT NULL,
  `experience_in_years` int(12) NOT NULL,
  `date_completed` date NOT NULL DEFAULT '1970-01-01',
  `active` enum('true','false') NOT NULL DEFAULT 'true',
  `attachment` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_salary`
--

CREATE TABLE `hrm_salary` (
  `salary_id` int(12) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vat_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BIC` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IBAN` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sotu` float NOT NULL,
  `TyEL_nro_vuositili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TyEL_nro_kk_tilitys` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `KuEL_tunnus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `KuEL` float NOT NULL,
  `TyEL` float NOT NULL,
  `tyottomyysvakuutus` float NOT NULL,
  `ryhmahvakuutus` float NOT NULL,
  `tapaturmavakuutus` float NOT NULL,
  `muut_maksut` float NOT NULL,
  `tyontekelake` float NOT NULL,
  `var53v_tyont_el` float NOT NULL,
  `paivarahamaksu` float NOT NULL,
  `paivarahamyritt` float NOT NULL,
  `vastuuvakuutusmaksu` float NOT NULL,
  `paivaraha` float NOT NULL,
  `osapaivaraha` float NOT NULL,
  `kilometrikorvaus` float NOT NULL,
  `tyontekELMtili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tyontekTTVakTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `AyJsmTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Sotu_maksutili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SotuVelkaTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EnnPidValkaTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TyEL_tili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `KVTEL_tili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tyottVakTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tapaVakaTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RyhmaHVakTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Muut_maksut_tili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TyEL_Tasetili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `KVTEL_Tasetili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TyottVakTaseTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TapaVakTaseTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `RyhmaHVakTaseTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MuutTaseTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LuontaisedutTili` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TyELTT` float NOT NULL DEFAULT '0',
  `TyELTT53` float NOT NULL DEFAULT '0',
  `unemploymentTT` float NOT NULL DEFAULT '0',
  `unemploymentTTOver` float NOT NULL DEFAULT '0',
  `su_lisat` float NOT NULL DEFAULT '0',
  `liast8to10` float NOT NULL DEFAULT '0',
  `lasat10to24` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_salary_cards`
--

CREATE TABLE `hrm_salary_cards` (
  `card_id` bigint(12) UNSIGNED NOT NULL,
  `timesheet_id` int(12) NOT NULL DEFAULT '0',
  `employee_id` int(12) NOT NULL DEFAULT '0',
  `sotu` float NOT NULL DEFAULT '0',
  `TyEL` float NOT NULL DEFAULT '0',
  `unemployment` float NOT NULL DEFAULT '0',
  `datepayment` float NOT NULL DEFAULT '0',
  `responsibility` float NOT NULL DEFAULT '0',
  `groupresp` float NOT NULL DEFAULT '0',
  `accident` float NOT NULL DEFAULT '0',
  `tax` float NOT NULL DEFAULT '0',
  `TyELTT` float NOT NULL DEFAULT '0',
  `unemploymentTT` float NOT NULL DEFAULT '0',
  `AY` float NOT NULL DEFAULT '0',
  `NORMI_PAIVA` float NOT NULL DEFAULT '0',
  `la` float NOT NULL DEFAULT '0',
  `su` float NOT NULL DEFAULT '0',
  `lisat_ilta` float NOT NULL DEFAULT '0',
  `lisat_yo` float NOT NULL DEFAULT '0',
  `ylityo_vrk_50` float NOT NULL DEFAULT '0',
  `ylityo_vrk_100` float NOT NULL DEFAULT '0',
  `ylityo_viik_50` float NOT NULL DEFAULT '0',
  `ylityo_viik_100` float NOT NULL DEFAULT '0',
  `ATV` float NOT NULL DEFAULT '0',
  `matka_tunnit` float NOT NULL DEFAULT '0',
  `paivaraha_osa` float NOT NULL DEFAULT '0',
  `paivaraha_koko` float NOT NULL DEFAULT '0',
  `ateria_korvaus` float NOT NULL DEFAULT '0',
  `km_korvaus` float NOT NULL DEFAULT '0',
  `tyokalu_korvaus` float NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `job_relarion_date` date DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `total_salary` float NOT NULL DEFAULT '0',
  `job_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salary_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `asuntoetu` float NOT NULL DEFAULT '0',
  `asuntoetu_sahko` float NOT NULL DEFAULT '0',
  `autotallietu` float NOT NULL DEFAULT '0',
  `ravintoetu` float NOT NULL DEFAULT '0',
  `autoetu` float NOT NULL DEFAULT '0',
  `puhelinetu` float NOT NULL DEFAULT '0',
  `bank_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BIC` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salary_from_start_of_year` float NOT NULL DEFAULT '0',
  `TyEL_start_of_the_year` float NOT NULL DEFAULT '0',
  `unemployement_start_of_the_year` float NOT NULL DEFAULT '0',
  `AY_start_of_the_year` float NOT NULL DEFAULT '0',
  `km_korvaus_start_of_the_year` float NOT NULL DEFAULT '0',
  `fullday_money_start_of_the_year` float NOT NULL DEFAULT '0',
  `halfday_money_start_of_the_year` float NOT NULL DEFAULT '0',
  `km_korvaus_quantity` int(12) NOT NULL DEFAULT '0',
  `paivaraha_koko_quantity` int(12) NOT NULL DEFAULT '0',
  `paivaraha_osa_quantity` int(12) NOT NULL DEFAULT '0',
  `basic_prosent` float NOT NULL DEFAULT '0',
  `extra_prosent` float NOT NULL DEFAULT '0',
  `salary_limit_1` float NOT NULL DEFAULT '0',
  `tax_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'B',
  `benefits_total_start_of_year` float NOT NULL DEFAULT '0',
  `tax_total_start_of_year` float NOT NULL DEFAULT '0',
  `salary_tax_total_start_of_year` float NOT NULL DEFAULT '0',
  `quantity_of_hours` float NOT NULL DEFAULT '0',
  `price_of_hour` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_salary_payment_periods`
--

CREATE TABLE `hrm_salary_payment_periods` (
  `salary_payment_period_id` int(12) NOT NULL,
  `salary_payment_period_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_salary_payment_periods`
--

INSERT INTO `hrm_salary_payment_periods` (`salary_payment_period_id`, `salary_payment_period_name`) VALUES
(1, '14 päviää'),
(2, 'kuukausi'),
(3, 'kahdesti kuukaudessa'),
(4, 'Alkaen');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_salary_terms_and_conditions`
--

CREATE TABLE `hrm_salary_terms_and_conditions` (
  `salary_terms_and_conditions_id` int(12) NOT NULL,
  `salary_terms_and_conditions_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_salary_terms_and_conditions`
--

INSERT INTO `hrm_salary_terms_and_conditions` (`salary_terms_and_conditions_id`, `salary_terms_and_conditions_name`) VALUES
(1, 'Aikaan'),
(2, 'Suoritukseen'),
(3, 'Provisioon'),
(4, 'Muu, mikä');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_taxcards`
--

CREATE TABLE `hrm_taxcards` (
  `taxcard_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_come_to_effective` date DEFAULT NULL,
  `employee_id` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_terms_and_conditions`
--

CREATE TABLE `hrm_terms_and_conditions` (
  `terms_and_conditions_id` int(12) NOT NULL,
  `terms_and_conditions_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_terms_and_conditions`
--

INSERT INTO `hrm_terms_and_conditions` (`terms_and_conditions_id`, `terms_and_conditions_name`) VALUES
(1, 'Työlainsäädäntöä'),
(2, 'Työehtosopimusta');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_tes`
--

CREATE TABLE `hrm_tes` (
  `tes_id` int(12) NOT NULL,
  `tes` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_effective` date NOT NULL,
  `la` float NOT NULL DEFAULT '0',
  `su` float NOT NULL DEFAULT '0',
  `lisat_ilta` float NOT NULL DEFAULT '0',
  `lisat_yo` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_tes`
--

INSERT INTO `hrm_tes` (`tes_id`, `tes`, `date_start`, `date_effective`, `la`, `su`, `lisat_ilta`, `lisat_yo`) VALUES
(1, 'Rakennusalan TES', '2014-08-01', '2014-08-31', 1.5, 2, 1.5, 2),
(3, 'Sähköalan TES', '2014-08-01', '2014-08-31', 1.5, 2, 1.5, 2),
(4, 'Kaupanalan TES', '2014-08-01', '2014-09-30', 1.5, 2, 1.5, 2),
(5, 'IT-alan TES', '2014-09-01', '2014-09-30', 1.5, 2, 1.5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `hrm_timesheets_index`
--

CREATE TABLE `hrm_timesheets_index` (
  `timesheet_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL DEFAULT '1',
  `timesheet_name` varchar(255) NOT NULL,
  `next_user` int(12) NOT NULL DEFAULT '1',
  `status` int(12) NOT NULL DEFAULT '1',
  `memo` text NOT NULL,
  `customer_id` int(12) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `session_id` varchar(255) NOT NULL,
  `km_description` varchar(255) NOT NULL,
  `sent` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_timesheets_status`
--

CREATE TABLE `hrm_timesheets_status` (
  `status_id` int(12) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_timesheets_status`
--

INSERT INTO `hrm_timesheets_status` (`status_id`, `status_name`) VALUES
(1, 'Avoin'),
(2, 'Lähetetty'),
(3, 'Palautunut'),
(4, 'Tarkastettavana'),
(5, 'Palautettu tarkastukseen'),
(6, 'Hyväksytty'),
(7, 'Maksettu');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_timesheet_history`
--

CREATE TABLE `hrm_timesheet_history` (
  `history_id` int(12) NOT NULL,
  `timesheet_id` int(12) NOT NULL,
  `datetime_created` datetime NOT NULL,
  `user_id` int(12) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_timesheet_hours_dates`
--

CREATE TABLE `hrm_timesheet_hours_dates` (
  `action_id` int(12) NOT NULL,
  `order_id` int(12) NOT NULL DEFAULT '0',
  `action_date` date DEFAULT NULL,
  `action_time_start` time NOT NULL DEFAULT '00:00:00',
  `action_time_end` time NOT NULL DEFAULT '00:00:00',
  `NORMI_PAIVA` double(12,2) NOT NULL DEFAULT '0.00',
  `la` double(12,2) NOT NULL DEFAULT '0.00',
  `su` double(12,2) NOT NULL DEFAULT '0.00',
  `lisat_ilta` double(12,2) NOT NULL DEFAULT '0.00',
  `lisat_yo` double(12,2) NOT NULL DEFAULT '0.00',
  `ylityo_vrk_50` double(12,2) NOT NULL DEFAULT '0.00',
  `ylityo_vrk_100` double(12,2) NOT NULL DEFAULT '0.00',
  `ylityo_viik_50` double(12,2) NOT NULL DEFAULT '0.00',
  `ylityo_viik_100` double(12,2) NOT NULL DEFAULT '0.00',
  `ATV` double(12,2) NOT NULL DEFAULT '0.00',
  `matka_tunnit` double(12,2) NOT NULL DEFAULT '0.00',
  `paivaraha_osa` enum('true','false') DEFAULT NULL,
  `paivaraha_koko` enum('true','false') DEFAULT NULL,
  `ateria_korvaus` double(12,2) NOT NULL DEFAULT '0.00',
  `km_korvaus` int(12) NOT NULL DEFAULT '0',
  `tyokalu_korvaus` double(12,2) NOT NULL DEFAULT '0.00',
  `HUOMIOITA` text NOT NULL,
  `ACTION_ENTERED_DATE_TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL DEFAULT '1',
  `timesheet_id` int(12) NOT NULL DEFAULT '1',
  `project_id` varchar(255) NOT NULL,
  `km_description` varchar(255) NOT NULL,
  `memo` text NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `hour_status_id` int(12) NOT NULL DEFAULT '1',
  `timesheet_status` int(12) NOT NULL DEFAULT '1',
  `next_user` int(12) NOT NULL DEFAULT '0',
  `accepted_datetime` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_timesheet_hour_status`
--

CREATE TABLE `hrm_timesheet_hour_status` (
  `hour_status_id` int(12) NOT NULL,
  `hour_staus_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hrm_timesheet_hour_status`
--

INSERT INTO `hrm_timesheet_hour_status` (`hour_status_id`, `hour_staus_name`) VALUES
(1, 'Odottaa hyväksyntää'),
(2, 'Hyväksytty'),
(3, 'Hylätty'),
(4, 'Luotu');

-- --------------------------------------------------------

--
-- Table structure for table `hrm_timesheet_payment_history`
--

CREATE TABLE `hrm_timesheet_payment_history` (
  `payment_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_title`
--

CREATE TABLE `hrm_title` (
  `title_id` int(12) NOT NULL,
  `title_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `experience` int(12) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hrm_title`
--

INSERT INTO `hrm_title` (`title_id`, `title_name`, `experience`) VALUES
(7, 'Kirvesmies', 0),
(6, 'Ohjelmoija', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrm_titles_educations`
--

CREATE TABLE `hrm_titles_educations` (
  `relation_id` int(12) NOT NULL,
  `education_id` int(11) NOT NULL DEFAULT '1',
  `title_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hrm_titles_educations`
--

INSERT INTO `hrm_titles_educations` (`relation_id`, `education_id`, `title_id`) VALUES
(2, 358, 6),
(5, 268, 7);

-- --------------------------------------------------------

--
-- Table structure for table `hrm_workplaces`
--

CREATE TABLE `hrm_workplaces` (
  `workplace_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `workplace_name` varchar(255) NOT NULL,
  `customer_id` int(12) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_phone` varchar(255) NOT NULL,
  `contact_person_email` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `start_date` date DEFAULT NULL,
  `date_completed` date DEFAULT NULL,
  `permanent` enum('true','false') NOT NULL DEFAULT 'false',
  `project_id` varchar(255) NOT NULL,
  `profitcenter_id` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL DEFAULT '-'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_workplaces_employees`
--

CREATE TABLE `hrm_workplaces_employees` (
  `relation_id` int(12) NOT NULL,
  `workplace_id` int(12) NOT NULL,
  `employee_id` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrm_worktime`
--

CREATE TABLE `hrm_worktime` (
  `worktime_id` int(12) NOT NULL,
  `worktime_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrm_worktime`
--

INSERT INTO `hrm_worktime` (`worktime_id`, `worktime_name`) VALUES
(1, 'Varallaoloon'),
(2, 'Tekemään lisä-, lauantai- ja sunnuntai-, ilta- tai yötyötä'),
(3, 'Tekemään ylitöitä'),
(4, 'Tekemään komennustöitä');

-- --------------------------------------------------------

--
-- Table structure for table `maksatus_historia`
--

CREATE TABLE `maksatus_historia` (
  `maksatus_id` int(12) NOT NULL,
  `maksatus_date` datetime NOT NULL,
  `maksatus_user` int(12) NOT NULL,
  `maksatus_file` varchar(255) NOT NULL,
  `maksatus_pdf` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra`
--

CREATE TABLE `ostoreskontra` (
  `ostoreskontra_id` int(12) NOT NULL,
  `toimittaja_id` int(12) DEFAULT NULL,
  `mml_viite` varchar(255) NOT NULL,
  `pankkimaksu_viite` text,
  `laskun_pvm` date NOT NULL DEFAULT '1970-01-01',
  `laskunera_pvm` date NOT NULL DEFAULT '1970-01-01',
  `toimitusehto` text NOT NULL,
  `laskun_summa_veroton` double NOT NULL DEFAULT '0',
  `laskun_summa_verollinen` double NOT NULL DEFAULT '0',
  `summa_debet` double NOT NULL DEFAULT '0',
  `laskun_status` int(12) NOT NULL DEFAULT '1',
  `laskun_nro` text,
  `created_by` int(12) NOT NULL DEFAULT '1',
  `seuraava_kasittelija_id` int(12) NOT NULL DEFAULT '1',
  `old_filename` varchar(255) NOT NULL,
  `veron_osuus` double NOT NULL DEFAULT '0',
  `accept_later_date` varchar(255) NOT NULL DEFAULT '123456',
  `message` varchar(255) DEFAULT NULL,
  `rahti` double(12,2) NOT NULL DEFAULT '0.00',
  `booked_by` int(12) NOT NULL DEFAULT '1',
  `accepting_status` enum('checking','accepting') NOT NULL DEFAULT 'checking'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_asiatarkastajat`
--

CREATE TABLE `ostoreskontra_asiatarkastajat` (
  `relation_id` int(12) NOT NULL,
  `ostoreskontra_id` int(12) NOT NULL DEFAULT '1',
  `user_id` int(12) NOT NULL DEFAULT '1',
  `order_id` int(12) NOT NULL DEFAULT '1',
  `kasitelty` enum('open','accepted','acceptlater','nonaccepted','nonacceptednoinformation') NOT NULL DEFAULT 'open',
  `session_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_historia`
--

CREATE TABLE `ostoreskontra_historia` (
  `historia_id` int(12) NOT NULL,
  `ostoreskontra_id` int(12) DEFAULT NULL,
  `user_id` int(12) NOT NULL DEFAULT '1',
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_hyvaksyjat`
--

CREATE TABLE `ostoreskontra_hyvaksyjat` (
  `relation_id` int(12) NOT NULL,
  `ostoreskontra_id` int(12) NOT NULL DEFAULT '1',
  `user_id` int(12) NOT NULL DEFAULT '1',
  `order_id` int(12) NOT NULL DEFAULT '1',
  `kasitelty` enum('open','accepted','acceptlater','nonaccepted','nonacceptednoinformation') NOT NULL DEFAULT 'open',
  `session_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_kustannuspaikkat`
--

CREATE TABLE `ostoreskontra_kustannuspaikkat` (
  `kustannuspaikka_id` int(12) NOT NULL,
  `kustannuspaikka_nimi` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ostoreskontra_kustannuspaikkat`
--

INSERT INTO `ostoreskontra_kustannuspaikkat` (`kustannuspaikka_id`, `kustannuspaikka_nimi`) VALUES
(1, 'TEST 1'),
(2, 'TEST 2');

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_kustannuspaikka_nro`
--

CREATE TABLE `ostoreskontra_kustannuspaikka_nro` (
  `profitcenter_id` int(12) NOT NULL,
  `profitcenter_nro` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_projektit`
--

CREATE TABLE `ostoreskontra_projektit` (
  `projekti_id` int(12) NOT NULL,
  `projekti_nimi` varchar(255) NOT NULL,
  `nimi_nro` varchar(10) DEFAULT NULL,
  `kustannuspaikka_id` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ostoreskontra_projektit`
--

INSERT INTO `ostoreskontra_projektit` (`projekti_id`, `projekti_nimi`, `nimi_nro`, `kustannuspaikka_id`) VALUES
(1, 'TEST 1', NULL, NULL),
(2, 'TEST 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_status`
--

CREATE TABLE `ostoreskontra_status` (
  `status_id` int(12) NOT NULL,
  `status_nimi` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ostoreskontra_status`
--

INSERT INTO `ostoreskontra_status` (`status_id`, `status_nimi`) VALUES
(1, 'Kirjattu (Asiatarkastatteva)'),
(2, 'Asiatarkastettu (Kunnossa)'),
(3, 'Asiatarkastettu (Lisäselvityksessä)'),
(5, 'Hyväksytty'),
(6, 'Maksettu'),
(7, 'Kirjanpidossa'),
(8, 'Palautunut'),
(9, 'Reklamoitu'),
(10, 'Hyvitetty'),
(11, 'Asiatarkastettu (Väliselvityksessä)'),
(12, 'Aiheeton/Poistettu');

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_summat`
--

CREATE TABLE `ostoreskontra_summat` (
  `summat_id` int(12) NOT NULL,
  `laskun_id` int(12) DEFAULT NULL,
  `kustannuspaikka_id` int(12) NOT NULL DEFAULT '1',
  `projekti_id` int(12) NOT NULL DEFAULT '1',
  `vero_id` int(12) NOT NULL DEFAULT '3',
  `tili_id` int(12) DEFAULT NULL,
  `veroton_summa` decimal(12,2) NOT NULL DEFAULT '0.00',
  `order_id` int(12) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_tilit`
--

CREATE TABLE `ostoreskontra_tilit` (
  `tili_id` int(12) NOT NULL,
  `tili_nimi` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ostoreskontra_tilit`
--

INSERT INTO `ostoreskontra_tilit` (`tili_id`, `tili_nimi`) VALUES
(1021, 'Kehittämismenot'),
(1040, 'Atk-ohjelmien lisenssimaksut 24 %'),
(1041, 'Atk-ohjelmien lisenssimaksut'),
(1160, 'Kalusto ja muu irtain 24 %'),
(1161, 'Kalusto ja muu irtain'),
(1441, 'Muut osakkeet ja osuudet'),
(1501, 'Aineet ja tarvikkeet'),
(1511, 'Keskeneräiset tuotteet'),
(1521, 'Valmiit tuotteet'),
(1531, 'Tavarat'),
(1554, 'Ennakkomaksut vaihto-omaisuudesta'),
(1665, 'Pitkäaikaiset lainasaamiset'),
(1667, 'Pitkäaikaiset maksetut vuokravakuudet'),
(1668, 'Pitkäaikaiset maksetut urakkavakuudet'),
(1691, 'Pitkäaikaiset laskennalliset verosaamiset'),
(1701, 'Myyntisaamiset'),
(1702, 'Myyntisaamiset'),
(1710, 'Myyntisaamiset reskontra välitili'),
(1750, 'Selvittelytili'),
(1760, 'Lainasaamiset työntekijöiltä'),
(1761, 'Muut saamiset'),
(1765, 'Pitkäaikaiset lainasaamiset'),
(1768, 'Lyhytaikaiset maksetut urakkavakuudet'),
(1770, 'Alv-saaminen'),
(1801, 'Siirtosaamiset'),
(1851, 'Laskennalliset verosaamiset'),
(1901, 'Rahat/käteisvarat'),
(1911, 'Liedon Säästöpankki'),
(1912, 'Tampereen Seudun Osuuspankki'),
(2001, 'Osakepääoma'),
(2060, 'Sijoitetun vapaan pääoman rahasto'),
(2061, 'Sijoitetun vapaan pääoman rahasto'),
(2251, 'Edellisten tilikausien voitto/tappio'),
(2265, 'Omista osakkeista maksettu määrä'),
(2371, 'Tilikauden tulos'),
(2621, 'Pitkäaikainen rahoituslaitoslaina 1'),
(2622, 'Pitkäaikainen autorahoituslaina 1'),
(2623, 'Pitkäaikainen autorahoituslaina 2'),
(2624, 'Pitkäaikainen rahoituslaitoslaina 2'),
(2625, 'Pitkäaikainen autorahoituslaina 3'),
(2626, 'Pitkäaikainen autorahoituslaina 4'),
(2725, 'Pitkäaikaiset velat osakkaille'),
(2749, 'Pitkäaikaiset muut velat'),
(2821, 'Pitkäaikaisen rahoituslaitoslainan 1 lyhennyserät'),
(2822, 'Pitkäaikaisen autorahoituslainan 1 lyhennyserät'),
(2823, 'Pitkäaikaisen autorahoituslainan 2 lyhennyserät'),
(2824, 'Pitkäaikaisen rahoituslaitoslainan 2 lyhennyserät'),
(2825, 'Pitkäaikaisen autorahoituslainan 3 lyhennyserät'),
(2871, 'Ostovelat'),
(2880, 'Ostovelat reskontra välitili'),
(2921, 'Ennakonpidätysvelka'),
(2923, 'Sosiaaliturvamaksuvelka'),
(2925, 'Jäsenmaksutilitysvelka 1'),
(2931, 'Arvonlisäverovelka'),
(2933, 'Myynnin alv-velka 24 %'),
(2934, 'Myynnin alv-velka ALV3'),
(2935, 'Ostojen alv-saaminen 24 %'),
(2936, 'Ostojen alv-saaminen 14 %'),
(2937, 'Ostojen alv-saaminen 10 %'),
(2938, 'Muut verotilivelat'),
(2939, 'Rakennuspalveluostojen alv 24 %'),
(2940, 'Rakennuspalveluostojen alv-saaminen ALV3'),
(2941, 'Muut lyhytaikaiset velat'),
(2961, 'Palkkamenot (siirtovelat)'),
(2962, 'Lomapalkkamenot (siirtovelat)'),
(2963, 'Eläkevakuutusmaksumenot (siirtovelat)'),
(2965, 'Työnantajan pakolliset vak.maksumenot (siirtovelat)'),
(2968, 'Tuloverot (siirtovelat)'),
(2979, 'Muut siirtovelat'),
(2981, 'Laskennalliset verovelat'),
(2999, 'Projektien laskennalliset voitot (varaukset)'),
(3000, 'Myynti 24 %'),
(3010, 'Konsultointi 24 %'),
(3020, 'Henkilöstövuokraus 24 %'),
(3188, 'Rakentamispalvelut 0 %, käännetty alv'),
(3464, 'Arvopapereiden myynti'),
(3981, 'Muut tuotot'),
(3994, 'Projektien laskutusvaraukset'),
(3995, 'Pitkäaikaiset urakkavakuudet (sisäinen)'),
(4000, 'Ostot ALV3'),
(4004, 'Ostot'),
(4005, 'Ostot (varaukset)'),
(4020, 'Vaatteet 24 %'),
(4040, 'Pakkaustarvikkeet 24 %'),
(4110, 'Yhteisöhankinnat 24 %'),
(4130, 'Tavaratuonti'),
(4134, 'Ostot tuonti'),
(4137, 'Tuonnin alv-arvojen vastatili'),
(4144, 'Tullit, verot ja muut maksut tullattaessa'),
(4290, 'Ostorahdit 24 %'),
(4294, 'Ostorahdit'),
(4320, 'Tuontihuolinta 24 %'),
(4374, 'Ostojen valuuttakurssierot'),
(4401, 'Varastojen lisäys (+) tai vähennys (-)'),
(4450, 'Alihankinta'),
(4458, 'Rakentamispalveluostot 1, ostaja verovelvollinen 24 %'),
(4460, 'Rakentamispalveluostot (varaukset)'),
(4470, 'Yhteisöpalveluhankinta'),
(4490, 'Muut ulkopuoliset palvelut'),
(5000, 'Työntekijäpalkat'),
(5010, 'Kuukausipalkat'),
(5050, 'Autoedut'),
(5099, 'Palkkavaraukset'),
(5300, 'Loma-ajan sosiaalipalkat'),
(5310, 'Vuosilomakorvaukset'),
(5320, 'Lomarahat'),
(5330, 'Lomapalkkojen jaksotus'),
(5340, 'Sairausajan ja vanhempainvapaan palkat'),
(5390, 'Sosiaalipalkkojen jaksotus'),
(5400, 'Saadut korvaukset palkoista'),
(5420, 'Autoedut'),
(5440, 'Asuntoedut'),
(5480, 'Saadut tapaturmavakuutuskorvaukset'),
(5800, 'Osakkaiden/omaisten palkat'),
(5991, 'Luontoisetujen vastatili'),
(6100, 'YEL-maksut'),
(6130, 'TyEL-maksut'),
(6140, 'Työntekijäin TyEL-maksut'),
(6300, 'Sosiaaliturvamaksut'),
(6400, 'Tapaturmavakuutusmaksut'),
(6410, 'Työttömyysvakuutusmaksut'),
(6420, 'Työntekijöiden työttömyysvakuutusmaksut'),
(6430, 'Ryhmähenkivakuutusmaksut'),
(6500, 'Henkilövakuutusmaksut (vapaaehtoiset)'),
(6800, 'Suunnitelman mukaiset poistot'),
(6850, 'Poisto muista pitkävaikutteisista menoista'),
(6870, 'Poisto koneista ja kalustoista'),
(7000, 'Henkilökunnan koulutus ALV3'),
(7004, 'Henkilökunnan koulutus'),
(7010, 'Sisäiset palaverit ja henkilökuntajuhlat ALV3'),
(7011, 'Sisäiset palaverit ja henkilökuntajuhlat 14 %'),
(7020, 'Virkistys- ja harrastustoiminta 24 %'),
(7024, 'Virkistys- ja harrastustoiminta'),
(7050, 'Työterveyshulto ALV3'),
(7054, 'Työterveyshuolto'),
(7110, 'Kahvitarvikkeet ALV3'),
(7111, 'Kahvitarvikkeet 14 %'),
(7120, 'Työvaatteet ALV3'),
(7124, 'Työvaatteet'),
(7130, 'Suojavälineet 24 %'),
(7170, 'Muut henkilösivukulut'),
(7200, 'Vuokrat ja vastikkeet'),
(7234, 'Toimitilavuokrat'),
(7274, 'Autotalli- ja autopaikkavuokrat'),
(7310, 'Muut vuokrat/vastikkeet 24 %'),
(7314, 'Muut vuokrat/vastikkeet'),
(7360, 'Siivous ja puhtaanapito ALV3'),
(7400, 'Jätehuolto 24 %'),
(7404, 'Jätehuolto'),
(7430, 'Korjaukset 24 %'),
(7444, 'Saadut vakuutuskorvaukset'),
(7460, 'Vartiointi- ja turvallisuuskulut ALV3'),
(7470, 'Muut toimitilakulut 24 %'),
(7520, 'Ajoneuvovuokrat 24 %'),
(7530, 'Ajoneuvojen polttoaine 24 %'),
(7534, 'Ajoneuvojen polttoaine 0 %'),
(7540, 'Ajoneuvojen huolto ja korjaus 24 %'),
(7544, 'Ajoneuvojen huolto ja korjaus 0 %'),
(7570, 'Ajoneuvovakuutukset'),
(7660, 'Atk-laite- ja ohjelmistokulut'),
(7664, 'Atk-ohjelmistot, päivitykset, ylläpito'),
(7680, 'Atk-laitehankinnat (< 3 v. kalusto) 24 %'),
(7684, 'Atk-laitehankinnat (< 3 v. kalusto)'),
(7700, 'Muut atk-laite ja -ohjelmistokulut 24 %'),
(7710, 'Muut kone- ja kalustokulut'),
(7720, 'Kone- ja kalustovuokrat 24 %'),
(7740, 'Kone- ja kalustohankinnat (< 3 v. kalusto) 24 %'),
(7744, 'Kone- ja kalustohankinnat (< 3 v. kalusto)'),
(7750, 'Koneiden ja kaluston pienhankinnat 24 %'),
(7764, 'Maksetut työkalukorvaukset'),
(7770, 'Muut kone- ja kalustokulut 24 %'),
(7800, 'Matkaliput, majoitus ja muut matkakulut'),
(7802, 'Matkaliput 10 %'),
(7804, 'Matkaliput'),
(7812, 'Taksikulut 10 %'),
(7822, 'Hotelli, ym. majoitus 10 %'),
(7824, 'Hotelli ym. majoitus'),
(7831, 'Ruokailut matkalla 14 %'),
(7850, 'Paikoituskulut 24 %'),
(7860, 'Muut matkakulut 24 %'),
(7864, 'Muut matkakulut'),
(7870, 'Matkakustannusten korvaukset'),
(7874, 'Kilometrikorvaukset'),
(7884, 'Päivärahat'),
(7904, 'Yömatkarahat'),
(7914, 'Ateriakorvaukset'),
(7950, 'Edustuskulut'),
(7954, 'Edustustilaisuudet'),
(7964, 'Edustuslahjat'),
(7974, 'Edustusmatkat'),
(8040, 'Muut myyntikulut'),
(8044, 'Muut myyntikulut'),
(8070, 'Ilmoitusmainonta ALV3'),
(8094, 'Internetmainonta'),
(8100, 'Mainosteippaukset 24 %'),
(8120, 'Mainosmateriaali ja -tarvikkeet 24 %'),
(8124, 'Mainosmateriaali ja -tarvikkeet'),
(8140, 'Muut mainoskulut 24 %'),
(8144, 'Muut mainoskulut'),
(8200, 'Myynnin edistäminen'),
(8230, 'Muut myynnin edistämiskulut 24 %'),
(8370, 'Vuokratyövoima 24 %'),
(8379, 'Projektikohtaiset henkilökulut (sis. projektisiirrot)'),
(8380, 'Taloushallintopalvelut 24 %'),
(8390, 'Tilintarkastuspalvelut 24 %'),
(8414, 'Laki- ja konsultointipalvelut'),
(8430, 'Muut hallintopalvelut 24 %'),
(8434, 'Muut hallintopalvelut'),
(8444, 'Viranomaismaksut'),
(8450, 'Tiedonhankinta'),
(8452, 'Kirjat 10 %'),
(8470, 'Tietopalvelut 24 %'),
(8500, 'Puhelinkulut ALV3'),
(8510, 'Matkapuhelinkulut 24 %'),
(8530, 'Datasiirtokulut 24 %'),
(8534, 'Datasiirtokulut'),
(8540, 'Posti- ja lähettikulut 24 %'),
(8544, 'Posti- ja lähettikulut'),
(8560, 'Rahaliikenteen kulut 24 %'),
(8564, 'Rahaliikenteen kulut 0 %'),
(8570, 'Pyöristyserot'),
(8580, 'Vakuutukset ja vahingonkorvaukset'),
(8584, 'Vastuuvakuutukset'),
(8594, 'Esinevakuutukset'),
(8610, 'Maksetut vahingonkorvaukset 24 %'),
(8614, 'Maksetut vahingonkorvaukset'),
(8620, 'Toimistotarvikkeet ALV3'),
(8630, 'Lomakkeet ja painatuskulut 24 %'),
(8640, 'Muut käyttötarvikkeet ALV3'),
(8650, 'Muut hallintokulut'),
(8651, 'Kokous- ja neuvottelukulut 14 %'),
(8654, 'Kokous- ja neuvottelukulut'),
(8680, 'Muut hallintokulut 24 %'),
(8700, 'Myynnin luottotappiot'),
(8770, 'Vähennyskelvottomat muut liikekulut'),
(8774, 'Veron korotukset, vähennyskelvottomat'),
(9161, 'Muut korko- ja rahoitustuotot'),
(9198, 'Projektien voitot/tappiot tilikauden vaihteessa'),
(9199, 'Projektien laskennalliset voitot (varaukset)'),
(9200, 'Muilta'),
(9220, 'Korkotuotot pankkisaamisista'),
(9240, 'Palautettava yhteisökorko/palautuskorko'),
(9260, 'Valuuttakurssivoitot'),
(9400, 'Muille'),
(9460, 'Korkokulut rahoituslaitoslainoista'),
(9490, 'Korkokulut ostoveloista'),
(9550, 'Muut korkokulut'),
(9560, 'Lainojen hoitokulut'),
(9614, 'Perimiskulut'),
(9701, 'Satunnaiset tuotot'),
(9741, 'Satunnaiset kulut'),
(9900, 'Ennakkoverot'),
(9920, 'Veronkorotukset ja korot'),
(9940, 'Tilikauden verojaksotus'),
(9950, 'Veronpalautukset/jäännösverot'),
(9960, 'Muut tuloverot');

-- --------------------------------------------------------

--
-- Table structure for table `ostoreskontra_vero`
--

CREATE TABLE `ostoreskontra_vero` (
  `vero_id` int(12) NOT NULL,
  `veroprosentti` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ostoreskontra_vero`
--

INSERT INTO `ostoreskontra_vero` (`vero_id`, `veroprosentti`) VALUES
(1, '0.10'),
(2, '0.14'),
(3, '0.24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(12) NOT NULL,
  `role_name` varchar(60) NOT NULL,
  `role_inherit` varchar(60) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_inherit`, `order`) VALUES
(1, 'defaultRole', '', 1),
(2, 'employeeRole', 'defaultRole', 2),
(3, 'customerRole', 'employeeRole', 3),
(4, 'accepterRole', 'customerRole', 4),
(5, 'bookkeeperRole', 'accepterRole', 5),
(6, 'adminRole', 'bookkeeperRole', 6);

-- --------------------------------------------------------

--
-- Table structure for table `toimittaja`
--

CREATE TABLE `toimittaja` (
  `toimittaja_id` int(12) NOT NULL,
  `nimi` varchar(80) NOT NULL,
  `y_tunnus` varchar(40) NOT NULL,
  `osoite` text NOT NULL,
  `puhelinnumero` varchar(40) NOT NULL,
  `sahkoposti` varchar(60) NOT NULL,
  `iban` varchar(60) NOT NULL,
  `bic` varchar(60) NOT NULL,
  `muut_maksutiedot` text NOT NULL,
  `maksuehto` int(12) NOT NULL DEFAULT '1',
  `toimitusehto` varchar(40) NOT NULL,
  `kategoria_id` int(12) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `toimittaja_kategoriat`
--

CREATE TABLE `toimittaja_kategoriat` (
  `kategoria_id` int(12) NOT NULL,
  `kategoria_nimi` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toimittaja_kategoriat`
--

INSERT INTO `toimittaja_kategoriat` (`kategoria_id`, `kategoria_nimi`) VALUES
(1, 'Paikoitus'),
(2, 'Sähkö'),
(4, 'Vakuutus'),
(5, 'Koulutus'),
(6, 'Alihankinta'),
(7, 'Puhelin'),
(11, 'Datasiirto'),
(12, 'Työterveys'),
(13, 'Markkinointi'),
(14, 'Viranomaismaksut'),
(15, 'Ajoneuvot'),
(16, 'Majoitus'),
(17, 'Työvaatteet ja -välineet'),
(18, 'Toimisto'),
(19, 'Palvelut'),
(20, 'Sähkötarvikkeet'),
(21, 'Posti'),
(22, 'Pankki -ja rahaliikenne'),
(23, 'Tarjoilu'),
(24, 'Matkustus'),
(25, 'Vartiointipalvelut'),
(26, 'Menotosite'),
(27, 'Huomautus ja perintä'),
(28, 'Käsityökalut'),
(29, 'Tilintarkastus'),
(30, 'IT'),
(31, 'Media'),
(32, 'Vuokralaitteet'),
(33, 'Tietopalvelut'),
(34, 'Siivouspalvelut'),
(35, 'Tietoturvapalvelut'),
(36, 'Junaturvallisuuspalvelut'),
(37, 'Muu hallinto'),
(38, 'Käännöstyö'),
(39, 'Vuokra');

-- --------------------------------------------------------

--
-- Table structure for table `toimittaja_maksuehto`
--

CREATE TABLE `toimittaja_maksuehto` (
  `maksuehto_id` int(12) NOT NULL,
  `maksuehto_paivaa` int(12) NOT NULL DEFAULT '14',
  `maksuehto_tyyppi` varchar(40) NOT NULL DEFAULT 'pv netto'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toimittaja_maksuehto`
--

INSERT INTO `toimittaja_maksuehto` (`maksuehto_id`, `maksuehto_paivaa`, `maksuehto_tyyppi`) VALUES
(1, 0, 'CIA'),
(2, 7, 'pv netto'),
(3, 14, 'pv netto'),
(4, 21, 'pv netto'),
(5, 30, 'pv netto'),
(6, 45, 'pv netto'),
(7, 60, 'pv netto'),
(8, 90, 'pv netto'),
(11, 10, 'pv netto');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(12) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `password_salt` varchar(80) NOT NULL,
  `active` enum('true','false') NOT NULL DEFAULT 'true',
  `role_id` int(12) NOT NULL DEFAULT '1',
  `email` varchar(60) NOT NULL,
  `company` varchar(40) NOT NULL,
  `leader` enum('true','false') NOT NULL DEFAULT 'false',
  `agreement_accepted` enum('true','false') NOT NULL DEFAULT 'false',
  `agreement_accepted_date` datetime DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `hashcode` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `password_salt`, `active`, `role_id`, `email`, `company`, `leader`, `agreement_accepted`, `agreement_accepted_date`, `phone`, `hashcode`) VALUES
(1, 'Will', 'Smith', 'admin@yourdomain.tld', 'ef224aafee22df6209ad1708c17ed607718416f0', '17708b0312cdbc2e8e28a14773be7a856222e4fe', 'true', 6, 'admin@yourdomain.tld', 'Oy Yritys Ltd', 'false', 'true', '2016-09-21 18:33:04', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `crm_delivery_address`
--
ALTER TABLE `crm_delivery_address`
  ADD PRIMARY KEY (`delivery_address_id`);

--
-- Indexes for table `crm_events`
--
ALTER TABLE `crm_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `crm_incoterms`
--
ALTER TABLE `crm_incoterms`
  ADD PRIMARY KEY (`incoterm_id`);

--
-- Indexes for table `crm_invoice`
--
ALTER TABLE `crm_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `crm_invoice_status`
--
ALTER TABLE `crm_invoice_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `crm_languages`
--
ALTER TABLE `crm_languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `crm_lead`
--
ALTER TABLE `crm_lead`
  ADD PRIMARY KEY (`lead_id`);

--
-- Indexes for table `crm_offers`
--
ALTER TABLE `crm_offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `crm_offer_status`
--
ALTER TABLE `crm_offer_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `crm_order_confirmation`
--
ALTER TABLE `crm_order_confirmation`
  ADD PRIMARY KEY (`order confirmation_id`);

--
-- Indexes for table `crm_order_confirmation_status`
--
ALTER TABLE `crm_order_confirmation_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `crm_partners`
--
ALTER TABLE `crm_partners`
  ADD PRIMARY KEY (`accountno`);

--
-- Indexes for table `crm_products`
--
ALTER TABLE `crm_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `crm_products_under_document`
--
ALTER TABLE `crm_products_under_document`
  ADD PRIMARY KEY (`pud_id`);

--
-- Indexes for table `crm_product_categories`
--
ALTER TABLE `crm_product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `crm_product_units`
--
ALTER TABLE `crm_product_units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `crm_purchase_order_status`
--
ALTER TABLE `crm_purchase_order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `crm_purhcase_order`
--
ALTER TABLE `crm_purhcase_order`
  ADD PRIMARY KEY (`purchase_order_id`);

--
-- Indexes for table `crm_sales_pipe_lines`
--
ALTER TABLE `crm_sales_pipe_lines`
  ADD PRIMARY KEY (`pipeline_id`);

--
-- Indexes for table `erp_agreements`
--
ALTER TABLE `erp_agreements`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `erp_emails`
--
ALTER TABLE `erp_emails`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `hrm_agree`
--
ALTER TABLE `hrm_agree`
  ADD PRIMARY KEY (`agree_id`);

--
-- Indexes for table `hrm_agreements`
--
ALTER TABLE `hrm_agreements`
  ADD PRIMARY KEY (`agreement_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `workplace_id` (`workplace_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `hrm_course_agreements`
--
ALTER TABLE `hrm_course_agreements`
  ADD PRIMARY KEY (`course_agreement_id`);

--
-- Indexes for table `hrm_customers`
--
ALTER TABLE `hrm_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `hrm_dailymoney`
--
ALTER TABLE `hrm_dailymoney`
  ADD PRIMARY KEY (`dailymoney_id`),
  ADD UNIQUE KEY `year` (`year`);

--
-- Indexes for table `hrm_education_names`
--
ALTER TABLE `hrm_education_names`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `hrm_employees`
--
ALTER TABLE `hrm_employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `hrm_employment_type`
--
ALTER TABLE `hrm_employment_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `hrm_qualifications`
--
ALTER TABLE `hrm_qualifications`
  ADD PRIMARY KEY (`qualification_id`);

--
-- Indexes for table `hrm_salary`
--
ALTER TABLE `hrm_salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `hrm_salary_cards`
--
ALTER TABLE `hrm_salary_cards`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `card_id` (`card_id`);

--
-- Indexes for table `hrm_salary_payment_periods`
--
ALTER TABLE `hrm_salary_payment_periods`
  ADD PRIMARY KEY (`salary_payment_period_id`);

--
-- Indexes for table `hrm_salary_terms_and_conditions`
--
ALTER TABLE `hrm_salary_terms_and_conditions`
  ADD PRIMARY KEY (`salary_terms_and_conditions_id`);

--
-- Indexes for table `hrm_taxcards`
--
ALTER TABLE `hrm_taxcards`
  ADD PRIMARY KEY (`taxcard_id`);

--
-- Indexes for table `hrm_terms_and_conditions`
--
ALTER TABLE `hrm_terms_and_conditions`
  ADD PRIMARY KEY (`terms_and_conditions_id`);

--
-- Indexes for table `hrm_tes`
--
ALTER TABLE `hrm_tes`
  ADD PRIMARY KEY (`tes_id`);

--
-- Indexes for table `hrm_timesheets_index`
--
ALTER TABLE `hrm_timesheets_index`
  ADD PRIMARY KEY (`timesheet_id`);

--
-- Indexes for table `hrm_timesheets_status`
--
ALTER TABLE `hrm_timesheets_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `hrm_timesheet_history`
--
ALTER TABLE `hrm_timesheet_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `hrm_timesheet_hours_dates`
--
ALTER TABLE `hrm_timesheet_hours_dates`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `action_date` (`action_date`,`timesheet_id`);
ALTER TABLE `hrm_timesheet_hours_dates` ADD FULLTEXT KEY `HUOMIOITA` (`HUOMIOITA`);

--
-- Indexes for table `hrm_timesheet_hour_status`
--
ALTER TABLE `hrm_timesheet_hour_status`
  ADD PRIMARY KEY (`hour_status_id`);

--
-- Indexes for table `hrm_timesheet_payment_history`
--
ALTER TABLE `hrm_timesheet_payment_history`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `hrm_title`
--
ALTER TABLE `hrm_title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `hrm_titles_educations`
--
ALTER TABLE `hrm_titles_educations`
  ADD PRIMARY KEY (`relation_id`),
  ADD KEY `education_id` (`education_id`,`title_id`);

--
-- Indexes for table `hrm_workplaces`
--
ALTER TABLE `hrm_workplaces`
  ADD PRIMARY KEY (`workplace_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `hrm_workplaces_employees`
--
ALTER TABLE `hrm_workplaces_employees`
  ADD PRIMARY KEY (`relation_id`),
  ADD KEY `workplace_id` (`workplace_id`,`employee_id`);

--
-- Indexes for table `hrm_worktime`
--
ALTER TABLE `hrm_worktime`
  ADD PRIMARY KEY (`worktime_id`);

--
-- Indexes for table `maksatus_historia`
--
ALTER TABLE `maksatus_historia`
  ADD PRIMARY KEY (`maksatus_id`);

--
-- Indexes for table `ostoreskontra`
--
ALTER TABLE `ostoreskontra`
  ADD PRIMARY KEY (`ostoreskontra_id`);

--
-- Indexes for table `ostoreskontra_asiatarkastajat`
--
ALTER TABLE `ostoreskontra_asiatarkastajat`
  ADD PRIMARY KEY (`relation_id`),
  ADD KEY `ostoreskontra_id` (`ostoreskontra_id`,`user_id`);

--
-- Indexes for table `ostoreskontra_historia`
--
ALTER TABLE `ostoreskontra_historia`
  ADD PRIMARY KEY (`historia_id`);

--
-- Indexes for table `ostoreskontra_hyvaksyjat`
--
ALTER TABLE `ostoreskontra_hyvaksyjat`
  ADD PRIMARY KEY (`relation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ostoreskontra_kustannuspaikkat`
--
ALTER TABLE `ostoreskontra_kustannuspaikkat`
  ADD PRIMARY KEY (`kustannuspaikka_id`);

--
-- Indexes for table `ostoreskontra_kustannuspaikka_nro`
--
ALTER TABLE `ostoreskontra_kustannuspaikka_nro`
  ADD PRIMARY KEY (`profitcenter_id`);

--
-- Indexes for table `ostoreskontra_projektit`
--
ALTER TABLE `ostoreskontra_projektit`
  ADD PRIMARY KEY (`projekti_id`);

--
-- Indexes for table `ostoreskontra_status`
--
ALTER TABLE `ostoreskontra_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ostoreskontra_summat`
--
ALTER TABLE `ostoreskontra_summat`
  ADD PRIMARY KEY (`summat_id`);

--
-- Indexes for table `ostoreskontra_tilit`
--
ALTER TABLE `ostoreskontra_tilit`
  ADD PRIMARY KEY (`tili_id`);

--
-- Indexes for table `ostoreskontra_vero`
--
ALTER TABLE `ostoreskontra_vero`
  ADD PRIMARY KEY (`vero_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `toimittaja`
--
ALTER TABLE `toimittaja`
  ADD PRIMARY KEY (`toimittaja_id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- Indexes for table `toimittaja_kategoriat`
--
ALTER TABLE `toimittaja_kategoriat`
  ADD PRIMARY KEY (`kategoria_id`);

--
-- Indexes for table `toimittaja_maksuehto`
--
ALTER TABLE `toimittaja_maksuehto`
  ADD PRIMARY KEY (`maksuehto_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `access_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `crm_delivery_address`
--
ALTER TABLE `crm_delivery_address`
  MODIFY `delivery_address_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_events`
--
ALTER TABLE `crm_events`
  MODIFY `event_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_incoterms`
--
ALTER TABLE `crm_incoterms`
  MODIFY `incoterm_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_invoice`
--
ALTER TABLE `crm_invoice`
  MODIFY `invoice_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_invoice_status`
--
ALTER TABLE `crm_invoice_status`
  MODIFY `status_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_languages`
--
ALTER TABLE `crm_languages`
  MODIFY `language_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_lead`
--
ALTER TABLE `crm_lead`
  MODIFY `lead_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_offers`
--
ALTER TABLE `crm_offers`
  MODIFY `offer_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_offer_status`
--
ALTER TABLE `crm_offer_status`
  MODIFY `status_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_order_confirmation`
--
ALTER TABLE `crm_order_confirmation`
  MODIFY `order confirmation_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_order_confirmation_status`
--
ALTER TABLE `crm_order_confirmation_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_partners`
--
ALTER TABLE `crm_partners`
  MODIFY `accountno` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_products`
--
ALTER TABLE `crm_products`
  MODIFY `product_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_products_under_document`
--
ALTER TABLE `crm_products_under_document`
  MODIFY `pud_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_product_categories`
--
ALTER TABLE `crm_product_categories`
  MODIFY `category_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_product_units`
--
ALTER TABLE `crm_product_units`
  MODIFY `unit_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_purchase_order_status`
--
ALTER TABLE `crm_purchase_order_status`
  MODIFY `status_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_purhcase_order`
--
ALTER TABLE `crm_purhcase_order`
  MODIFY `purchase_order_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_sales_pipe_lines`
--
ALTER TABLE `crm_sales_pipe_lines`
  MODIFY `pipeline_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_agreements`
--
ALTER TABLE `erp_agreements`
  MODIFY `aid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `erp_emails`
--
ALTER TABLE `erp_emails`
  MODIFY `email_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hrm_agree`
--
ALTER TABLE `hrm_agree`
  MODIFY `agree_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrm_agreements`
--
ALTER TABLE `hrm_agreements`
  MODIFY `agreement_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_course_agreements`
--
ALTER TABLE `hrm_course_agreements`
  MODIFY `course_agreement_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_customers`
--
ALTER TABLE `hrm_customers`
  MODIFY `customer_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrm_dailymoney`
--
ALTER TABLE `hrm_dailymoney`
  MODIFY `dailymoney_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrm_education_names`
--
ALTER TABLE `hrm_education_names`
  MODIFY `education_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=459;

--
-- AUTO_INCREMENT for table `hrm_employees`
--
ALTER TABLE `hrm_employees`
  MODIFY `employee_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_employment_type`
--
ALTER TABLE `hrm_employment_type`
  MODIFY `type_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hrm_qualifications`
--
ALTER TABLE `hrm_qualifications`
  MODIFY `qualification_id` bigint(24) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_salary`
--
ALTER TABLE `hrm_salary`
  MODIFY `salary_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_salary_cards`
--
ALTER TABLE `hrm_salary_cards`
  MODIFY `card_id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_salary_payment_periods`
--
ALTER TABLE `hrm_salary_payment_periods`
  MODIFY `salary_payment_period_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrm_salary_terms_and_conditions`
--
ALTER TABLE `hrm_salary_terms_and_conditions`
  MODIFY `salary_terms_and_conditions_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrm_taxcards`
--
ALTER TABLE `hrm_taxcards`
  MODIFY `taxcard_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_terms_and_conditions`
--
ALTER TABLE `hrm_terms_and_conditions`
  MODIFY `terms_and_conditions_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hrm_tes`
--
ALTER TABLE `hrm_tes`
  MODIFY `tes_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrm_timesheets_index`
--
ALTER TABLE `hrm_timesheets_index`
  MODIFY `timesheet_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_timesheets_status`
--
ALTER TABLE `hrm_timesheets_status`
  MODIFY `status_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrm_timesheet_history`
--
ALTER TABLE `hrm_timesheet_history`
  MODIFY `history_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_timesheet_hours_dates`
--
ALTER TABLE `hrm_timesheet_hours_dates`
  MODIFY `action_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_timesheet_hour_status`
--
ALTER TABLE `hrm_timesheet_hour_status`
  MODIFY `hour_status_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrm_timesheet_payment_history`
--
ALTER TABLE `hrm_timesheet_payment_history`
  MODIFY `payment_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_title`
--
ALTER TABLE `hrm_title`
  MODIFY `title_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrm_titles_educations`
--
ALTER TABLE `hrm_titles_educations`
  MODIFY `relation_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrm_workplaces`
--
ALTER TABLE `hrm_workplaces`
  MODIFY `workplace_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_workplaces_employees`
--
ALTER TABLE `hrm_workplaces_employees`
  MODIFY `relation_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrm_worktime`
--
ALTER TABLE `hrm_worktime`
  MODIFY `worktime_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `maksatus_historia`
--
ALTER TABLE `maksatus_historia`
  MODIFY `maksatus_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ostoreskontra`
--
ALTER TABLE `ostoreskontra`
  MODIFY `ostoreskontra_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ostoreskontra_asiatarkastajat`
--
ALTER TABLE `ostoreskontra_asiatarkastajat`
  MODIFY `relation_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ostoreskontra_historia`
--
ALTER TABLE `ostoreskontra_historia`
  MODIFY `historia_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ostoreskontra_hyvaksyjat`
--
ALTER TABLE `ostoreskontra_hyvaksyjat`
  MODIFY `relation_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ostoreskontra_kustannuspaikkat`
--
ALTER TABLE `ostoreskontra_kustannuspaikkat`
  MODIFY `kustannuspaikka_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ostoreskontra_kustannuspaikka_nro`
--
ALTER TABLE `ostoreskontra_kustannuspaikka_nro`
  MODIFY `profitcenter_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ostoreskontra_projektit`
--
ALTER TABLE `ostoreskontra_projektit`
  MODIFY `projekti_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ostoreskontra_status`
--
ALTER TABLE `ostoreskontra_status`
  MODIFY `status_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ostoreskontra_summat`
--
ALTER TABLE `ostoreskontra_summat`
  MODIFY `summat_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ostoreskontra_vero`
--
ALTER TABLE `ostoreskontra_vero`
  MODIFY `vero_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `toimittaja`
--
ALTER TABLE `toimittaja`
  MODIFY `toimittaja_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toimittaja_kategoriat`
--
ALTER TABLE `toimittaja_kategoriat`
  MODIFY `kategoria_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `toimittaja_maksuehto`
--
ALTER TABLE `toimittaja_maksuehto`
  MODIFY `maksuehto_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
