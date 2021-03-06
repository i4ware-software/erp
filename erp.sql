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
(1, '<p><strong>KUVAUS JA TAVOITE</strong><br>\n  T??m?? ohjeistus sis??lt???? Henkil??st??ohjeistukset ty??teht??vitt??in sek?? ty??turvallisuusohjeistuksen. Jokaisen ty??ntekij??n tulee perehty?? ohjeeseen huolellisesti sek?? noudattaa ohjeiden m????r??yksi??. Ohjeista poikkeamiseen tulee aina hankkia toimitusjohtajalta lupa.</p>\n<p><strong>1	OHJEISTUS HENKIL??ST??LLE</strong></p>\n<p><strong>KUVAUS</strong></p>\n<p>T??ss?? kohdassa ohjeistetaan asioita, joista jokaisen ty??ntekij??n tulee olla tietoisia ja noudattaa.<br>\n</p>\n<p><strong>TAVOITE</strong></p>\n<p>Yhten??ist???? yhti??n henkil??st??n toimintamallit ja tehostaa toimintaa ty??turvallisuusasioista tinkim??tt??.</p>\n<p>???<br>\n  <strong>1.1	Tuntikortin t??ytt??ohjeistus</strong></p>\n<p>Ty??ntekij??n tulee kirjata tuntikirjaukset kahden viikon v??lein tuntikorttiin. </p>\n<p>Tuntikorttien kierr??tys: <br>\n  1.	Tuntikortti t??ytet????n yll?? mainitun aikav??lein ty??ntekij??n toimesta. Ty??ntekij??n tulee kirjata palkkavaatimuksensa tuntikorttiin ty??lains????d??nn??n, ty??ehtosopimuksen ja paikallisten sopimuksien mukaisesti. Ty??ntekij??n tulee toimittaa tuntikortti heti palkanlaskujakson p????tytty??.<br>\n  a.	M????rittele tuntikortin t??ytt??mispaikka t??h??n. Suosittelemme s??hk??ist?? j??rjestelm????.<br>\n  2.	Tuntikortin hyv??ksyy ty??ntekij??n esimies allekirjoittamalla tuntikortin erikseen sovittuun m????r??aikaan menness?? (m????rittele kierron m????r??aika). Esimiehen tulee tarkastaa tuntikortin sis??ll??n paikkansapit??vyys. Esimies toimittaa tuntikortin palkanlaskentaan heti hyv??ksynn??n j??lkeen.<br>\n  a.	M????rittele tuntikortin hyv??ksynt??tapa t??h??n. Suosittelemme s??hk??ist?? j??rjestelm????.<br>\n  3.	Palkanlaskenta laskee ja maksattaa palkat yhti??n palkkakierron mukaisesti, sek?? toimittaa palkanlaskun yhteydess?? palkkanauhan.<br>\n  a.	M????rittele palkkakierto t??h??n.<br>\n  b.	Jos tunteja laskutetaan asiakkaalta. M????rittele laskutus t??h??n.<br>\n  c.	M????rittele palkkanauhan toimitustapa t??h??n<br>\n  4.	Ty??ntekij?? tarkastaa palkkanauhasta palkan oikeellisuuden. Mahdollisissa virheiss?? ty??ntekij?? ottaa yhteytt?? palkanlaskentaan palkanlaskennan ja mahdollisen laskutuksen korjaamiseksi.<br>\n  a.	M????rittele palkanlaskennan yhteystiedot t??h??n</p>\n<p><strong>1.2	Ylity??t</strong></p>\n<p>Ylit??ist?? tulee aina sopia etuk??teen ty??maan ty??njohdon kanssa. Ty??ntekij??n toimiessa henkil??st??vuokrauksen ehdoilla asiakkaan ty??njohdon alaisuudessa, asiakas voi sopia ylit??it?? lain m????r????miss?? rajoissa.<br>\n  Yhti??n omissa t??iss?? esimies sopii ylit??ist?? henkil??st??n kanssa tapauskohtaisesti. Toimihenkil??iden ohjeessa kohdassa 2.3 k??sitell????n ylit??iden teett??mist?? tarkemmin.<br>\n  </p>\n<p><strong>1.3	Ty??terveyshuolto</strong></p>\n<p>Yhti?? Oy:n ty??ntekij??iden ty??terveydenhuolto on j??rjestetty yhteisty??ss?? ???M????rittele ty??terveyspalveluiden tuottaja??? kanssa. <br>\n  Ajanvarauksen voi hoitaa s??hk??isesti ???m????rittele ajanvarauskanavat t??h??n???.<br>\n</p>\n<p><strong>1.4	Ty??tapaturmavakuutus</strong></p>\n<p>Yhti?? Oy:n ty??ntekij??iden lakis????teinen ty??tapaturmavakuutus on M????rittele vakuutusyhti?? t??h??n:ss?? vakuutusnumerolla M????rittele vakuutusnumero t??h??n.<br>\n</p>\n<p><strong>1.5	Sairasloma</strong></p>\n<p>Aikaisella l????k??rik??ynnill?? voimme ennaltaehk??ist?? pitkittyneit?? sairaslomia ja t??st?? syyst?? sairaslomista tulee esitt???? ty??nantajalle aina l????k??rintodistus. <br>\n</p>\n<p><strong>1.5.1	Ty??ntekij??n pitk?? sairasloma:</strong></p>\n<p>Ty??ntekij??n jouduttua pitk??lle sairaslomalle, maksaa yhti?? palkkaa alan ty??ehtosopimuksen mukaisen m????r??ajan. <br>\n  Oman voimassaolevan ty??ehtosopimuksen l??yd??t osoitteesta: http://www.finlex.fi/fi/viranomaiset/tyoehto/<br>\n  Jos ty??ehtosopimuksessa ei ole erikseen m????ritelty palkanmaksuaikaa maksetaan sairausajan palkkaa lain mukaan sairastumisp??iv??lt?? (jos se ty??ss?? oltaessa olisi ollut ty??ntekij??n ty??p??iv??) ja sit?? seuraaviin yhdeks????n arkip??iv????n (ei lasketa mukaan pyh??p??ivi??) sis??ltyvilt?? ty??p??ivilt??. Jos ty??suhde on ty??kyvytt??myyden alkamishetkell?? kest??nyt v??hint????n yhden kuukauden, ty??ntekij??lle maksetaan edell?? mainitulta ajanjaksolta t??ysi palkka. Jos ty??suhde on kest??nyt alle kuukauden, maksetaan samalta ajanjaksolta puolet palkasta. Jos ty??ntekij??ll?? ei ole ty??vuoroluetteloon merkittyj?? ty??vuoroja, lasketaan sairausajan palkka toteutuneen, keskim????r??isen ty??ajan mukaan. <br>\nPalkanmaksun keskeytetty?? maksaa kela sairausp??iv??rahaa. Sairausp??iv??rahasta saa lis??tietoa osoitteesta: http://www. kela.fi/tyokyvyton-yli-10-paivaa_sairauspaivaraha</p>\n<p><strong>1.6	Tapaturmat ja vaaratilanteet</strong></p>\n<p>Ty??turvallisuus on kaikkien asia.</p>\n<p>Yhti??n Oy:n ty??ntekij??iden tulee tehd?? ty??maalla sattuneesta vaaratilanteesta sek?? tapaturmasta ilmoitus ty??suojelup????llik??lle. <br>\n  ???	Jokaisesta vaaratilanteesta tehdyst?? ilmoituksesta ty??ntekij??lle kirjataan 20 euron kertakorvaus seuraavaan palkkakiertoon<br>\n  o	Vaaratilanne on tapahtuma, joka olisi voinut johtaa henkil??- tai materiaalivahinkoihin<br>\n  o	Ilmoitus teht??v?? s??hk??postitse osoitteeseen m????rittele s??hk??postiosoite t??h??n.<br>\n  o	Ilmoituksen tulee sis??lt???? tiedot vaaratilanteesta sek?? kehitysehdotuksen vaaratilanteen v??ltt??miseksi<br>\n  ???	Tapaturmailmoitukselle on oma lomake<br>\n  o	Tapaturman ei tarvitse olla sairaalahoitoa vaativa, jotta siit?? tuli tehd?? ilmoitus</p>\n<p>S??hk??tapaturmista v??lit??n ilmoitus s??hk??ty??njohtajalle ja ty??tapaturmista v??lit??n ilmoitus ty??suojelup????llik??lle. </p>\n<p>Jokainen ilmoitus edesauttaa turvallisemman ty??ymp??rist??n kehitt??misess?? ja ehk??isee mahdollisia ty??tapaturmia. Tavoitteena on poistaa kaikki vaaratilanteet ja tapaturmat ty??maalta.</p>\n<p>Lis??ohjeita:<br>\n  M????rittele yhteystiedot t??h??n<br>\n</p>\n<p><strong>1.6.1	Tapaturmalomakkeen t??ytt??ohjeistus</strong></p>\n<p>Tee tapaturmailmoitus huolellisesti. Huolella ja oikein t??ytetty tapaturmailmoituslomake helpottaa asian nopeaa k??sittely?? sek?? auttaa ehk??isem????n mahdollisia tulevia tapaturmia. </p>\n<p>Jos tapaturmaan liittyy monta henkil????, jokainen heist?? t??ytt???? oman lomakkeen ja esitt???? n??kemyksens?? tapaturmasta.</p>\n<p>Lomakkeen kohdat: </p>\n<p>???	Tapahtuma / Tilanne: Mit?? on sattunut (esim. tapaturma, ruhjevamma, liev?? loukkaantuminen???)<br>\n  ???	Vahingoittuneen nimi: Kuka vahingoittui tapaturmassa <br>\n  ???	P??iv??ys: Milloin tapaturma sattui<br>\n  ???	Tapahtumapaikka / Osasto: Tarkka selvitys miss?? tapaturma tapahtui<br>\n  ???	Mit?? tapahtui: Yksityiskohtainen oman n??k??kulman selostus tapahtuneesta (vahingoittunut, vahingon aiheuttaja, silminn??kij?????) <br>\n  ???	Miksi tapaturma sattui: Henkil??kohtainen analyysi mitk?? asiat vaikuttivat siihen, ett?? tapaturma syntyi (esim. h??iri??tekij??t, v????r??t varusteet, kommunikointi, perehdytyksen vajeellisuus???) <br>\n  ???	Miten vastaava tapahtuma/tilanne voitaisiin jatkossa est????: Analyysi miten ty??ntekij?? voi itse vaikuttaa, ettei tapahtuma toistu sek?? arvio siit??, ett?? miten ty??nantaja ja tapaturman toiset osapuolet voivat edesauttaa tapaturman v??ltt??misess?? tulevaisuudessa<br>\n  ???	Sovitut toimenpiteet: Mit?? asian korjaamiseksi on tehty ja ketk?? ovat osallisina toimenpiteisiin <br>\n  ???	Aikataulu: Milloin sovitut asiat ovat tehtyin??<br>\n  ???	Vastuuhenkil??: Nimet????n vastuuhenkil??, joka pit???? huolta, ett?? sovitut toimenpiteet tulevat tehdyksi (vastuuhenkil?? ty??maalla, ty??suojelup????llikk?????)<br>\n  ???	Jakelu: Raportin vastaanottaja t??ytt????<br>\n  ???	K??sitelty: Raportin vastaanottaja t??ytt???? ja kommentoi raporttia ilmoittajalle<br>\n  <br>\n  <strong>1.7	Ty??nkuittauslomakkeen t??ytt??ohjeistus</strong></p>\n<p>Ty??nkuittauslomake t??ytet????n vain tuntit??iss?? ja lis??t??iss??. Jos et ole ennen k??ytt??nyt ty??nkuittauslomaketta ole yhteydess?? toimitusjohtajaan ohjeistuksen ja toimitapojen l??pik??ymist?? varten.</p>\n<p>T??yt?? v??hint????n seuraavat kohdat: </p>\n<p>o	Asiakkaan nimi: Asiakkaan nimi<br>\n  o	Laskutusosoite: Asiakkaan antama laskutusosoite<br>\n  o	Ty??ntekij??: Oma nimi<br>\n  o	Viite/Merkki: Projektinumero<br>\n  o	Tuntihinta: T??m?? pit???? t??ytt????, jos ty??maa tehd????n tuntilaskutuksena<br>\n  o	PVM: P??iv??m????r??(t) jolloin ty??skennelty<br>\n  o	Alkoi klo: Kellonaika jolloin ty?? alkoi<br>\n  o	Loppui klo: Kellonaika jolloin ty?? p????ttyi<br>\n  o	Tehty ty??: Mit?? ty??maalla tehty kyseisen?? p??iv??n??<br>\n  o	KP: Kustannuspaikka (projektinumeron kaksi ensimm??ist?? numeroa)<br>\n  o	Alanro: Projektinumeron loppuosa<br>\n  o	Tunnit: Montako tuntia ty??skenneltiin ty??maalla kyseisen?? p??iv??n??<br>\n  o	50%: Ylity??tunnit jotka ylitt??v??t 0-2 tuntia normaality??ajan, sovittava ty??maap????llik??n kanssa<br>\n  o	100%: Ylity??tunnit jotka ylitt??v??t yli 2 tuntia normaality??ajan, sovittava ty??maap????llik??n kanssa<br>\n  o	Muut lis??t: Kilometrikorvaukset, p??iv??rahat jne. (jos oikeutettu kyseenomaisiin lisiin)<br>\n  o	Materiaalit: K??ytetyt materiaalit ja m????r??t<br>\n  o	Tuotenimike: Tarkka tuotteen nimike ja kokotieto<br>\n  o	Kpl: Tuotteen metri-, neli??- tai kappalem????r??<br>\n  o	A-hinta: Tuotteen metri-, neli??- tai kappalehinta<br>\n  <br>\n  <strong>1.8	Sosiaalisen median ???ohjeistus</strong></p>\n<p>Internet ja sosiaalinen media (Facebook, Twitter, Google+, Instagram jne.) ovat julkisia paikkoja, jonne p??ivitt??ess?? tietoja pit???? ottaa huomioon markkinoinnin ja tietosuojan n??k??kulmat. Sosiaaliseen mediaan tehtyj?? p??ivityksi?? kannattaa verrata esimerkiksi lehtijulkaisuun ??? mit?? et kirjoittaisi lehteen, ??l?? kirjoita my??sk????n sosiaalisen mediaan tai internetiin. <br>\n  Yhti??n linjauksen mukaan seuraavia asioita ei tule internetiss?? julkaista: <br>\n  ??l?? hauku tai arvostele ty??nantajaa<br>\n  ???	Jos asiat eiv??t ole kunnossa, ota ensisijaisesti yhteytt?? esimieheesi ja keskustele h??nen kanssaan asiasta. Jos asia ei t??ll?? ratkea, ole yhteydess?? toimitusjohtajaan.</p>\n<p>??l?? hauku tai arvostele kollegoitasi, esimiehi??si tai alaisia<br>\n  ???	Ty??paikan asiat selvitet????n aina sis??isesti. Julkinen arvostelu ei ratkaise ongelmaa vaan todenn??k??isesti pahentaa sit??. N??iss?? erotuomarina toimii l??hin esimiehesi tai toimitusjohtaja, ei sosiaalinen media.</p>\n<p>??l?? hauku tai arvostele asiakkaita<br>\n  ???	Asiakkaan haukkumista n??kee paljonkin sosiaalisessa mediassa, asiakas on kuitenkin lopulta se, joka palkkasi maksaa. Ottaisitko itse t??ihin tekij??n, joka arvostelee sinua julkisesti?</p>\n<p>??l?? hauku tai arvostele kilpailijoita<br>\n  ???	Kilpailijoiden mustamaalaaminen yleens?? aiheuttaa vastareaktion ja kilpailija helposti alkaa arvostella my??s meid??n yhti??t??mme.<br>\n  ???	Parhaimmassa tapauksessa julkisen imagon puhdistamiseen menee omalta ty??yhteis??lt??si suuri ty??m????r??, mutta pahimmassa tapauksessa t??h??n joudutaan palkkaamaan ammattilaisia. Yhti??ll??mme ei ole yksinkertaisesti varaa l??hte?? taistelemaan kilpailijoiden kanssa maineesta median kautta. Maine tehd????n ty??ll??, ei muita arvostelemalla.<br>\n  ???	Kilpailijan ty??ntekij??t ovat my??s alan ammattilaisia, jotka voivat joskus olla meille voimavara. L??htisitk?? sin?? t??ihin yhti????n, jonka henkil??st?? on sinua arvostellut julkisesti? </p>\n<p>Yksinkertaisesti sosiaalisessa mediassa tai internetiss?? t??ist?? kertoessa keskityt????n omaan toimintaan ja kehutaan oman yhti??n toimintaa. T??ll??in sosiaalisessa mediassa ja internetiss?? voidaan saada aikaan positiivinen mielikuva yhti??st?? ja n??in ollen saada lis???? menestyst?? aikaiseksi. </p>\n<p>Yksinkertainen s????nt?? sosiaalisessa mediassa ja internetiss?? on: ??l?? hauku tai arvostele ket????n. <br>\n  T??ihin liittyen t??m?? on yhti??n virallinen ohjeistus ja n??in ollen kaikkien on sit?? noudatettava. Ohjeistuksella ei haluta rajoittaa yksil??n sananvapautta tai vapautta ilmaista itse????n, vaan saada jokainen harkitsemaan ty??h??ns?? liittyvien tietojen julkaisemisen mahdolliset seuraukset ennen tietojen julkaisemista.<br>\n  </p>\n<p><strong>1.9	Lomat</strong></p>\n<p>Lomat yhti??ss?? my??nt???? aina esimies kirjallisesti. Ty??ntekij?? toimittaa v??hint????n kuukautta ennen haluamaansa loma-ajankohtaa kirjallisen anomuksen esimiehelleen. <br>\n  Lomien t??sm??llisell?? sopimisella pyrit????n tasa-arvoistamaan henkil??st??n lomia ja takaamaan riitt??v?? suunnitteluaika yhti??n henkil??st??hallinnossa.<br>\n  Asiakkailla ei ole edes henkil??st??vuokrauksena teht??viss?? t??iss?? oikeutta my??nt???? yhti??mme henkil??st??lle lomia. Asiakkaan kanssa sovitut lomat katsotaan luvattomiksi poissaoloiksi.<br>\n  Jos loma-ajankohta on kiiretapauksen johdosta alle kuukauden sis??ll??, on t??st?? sovittava erikseen soittamalla henkil??st??johtajale.???<br>\n</p>\n<p><strong>2	OHJEISTUS TOIMIHENKIL??ILLE</strong></p>\n<p><strong>KUVAUS</strong></p>\n<p>T??ss?? kohdassa ohjeistetaan asioita, joista yhti??n toimihenkil??st??n tulee olla tietoisia ja noudattaa.<br>\n</p>\n<p><strong>TAVOITE</strong></p>\n<p>Yhten??ist???? yhti??n henkil??st??n toimihenkil??iden toimintamallit ja tehostaa toimintaa ty??turvallisuusasioista tinkim??tt??.<br>\n  <br>\n  <strong>2.1	P??tevyydet</strong></p>\n<p>Henkil??st??n p??tevyyksien tulee aina vastata alalla olevien lakien, m????r??ysten ja k??yt??ss?? olevien standardien mukaisuutta.<br>\n  Toimihenkil??iden tulee selvitt???? ty??n vaatimat p??tevyydet ja varmistaa, ett?? k??ytett??v?? henkil??st?? t??ytt???? p??tevyysvaatimukset.<br>\n  </p>\n<p><strong>2.2	Palkankorotukset ja bonuspalkkiot</strong></p>\n<p>Henkil??st??n palkankorotus- ja bonuspalkkioprosessi on seuraava<br>\n  1.	Toimihenkil?? esitt???? palkankorotusta tai bonuspalkkiota toimitusjohtajalle<br>\n  a.	Kirjallisesti s??hk??postitse<br>\n  i.	Sis??lt???? perustelut palkankorotukselle tai bonuspalkkiolle<br>\n  2.	Toimitusjohtaja hyv??ksyy/hylk???? palkankorotuksen tai bonuspalkkion <br>\na.	Hyv??ksymisen j??lkeen toimitusjohtaja ilmoittaa palkankorotuksesta tai bonuspalkkiosta palkanlaskentaan</p>\n<p>Palkankorotuksen perusteet<br>\n  ???	TES-palkkaluokat<br>\n  ???	Henkil??kohtainen palkanosuus<br>\n  ???	Yhti??n taloudelliset toimintaedellytykset ja kilpailukyky palkankorotuksen j??lkeen<br>\n  o	Yhti?? ei halua irtisanoa henkil??st??????n taloudellisiin ja tuotannollisiin syihin vedoten palkankorotuksen j??lkeen<br>\n  o	Palkat tulee olla linjassa ty??teht??vien mukaan<br>\n  ???	Yhden henkil??n palkankorotus voidaan katsoa koko henkil??st???? koskevaksi<br>\n  </p>\n<p><strong>2.3	Ylity??t</strong></p>\n<p>Ylit??iden teett??mist?? tulisi v??ltt???? seuraavista syist?? <br>\n  ???	Ylity??t synnytt??v??t aina prosentuaalisesti enemm??n kustannuksia kuin sen aikana tehty ty?? nostattaa prosentuaalisesti tuotantoa<br>\n  o	Kilpailukyky heikkenee ???<br>\n  ???	Ylity??t tehd????n usein samojen henkil??iden toimesta<br>\n  o	Kyseisten henkil??iden fyysinen rasitus ja henkinen stressi kasvavat<br>\n  ???	Ylit??it?? teett??m??ll?? yhti?? ei kykene kasvattamaan osaajam????r????ns??<br>\n  ???	Ylit??iden teett??minen on rajoitettu lains????d??nn??ss??<br>\n  o	Ylity??t tulee kohdistaa aina ????rimm??iseen tarpeeseen<br>\n???	Yhti??ll?? t??ytyy olla aina mahdollisuus teett???? ylit??it??, kun todellinen tarve syntyy</p>\n<p>Yhti??ss?? on k??yt??ss?? valvontamekanismi ylit??iden teett??misen suhteen<br>\n  ???	Mahdollistaa henkil??st??tarpeiden kartoittamisen<br>\n  ???	Yhti?? kehittyy projektien kiireavun oikeaoppisessa k??yt??ss??<br>\n  ???	Tarjoaa yhti??n johdolle tietoa ylit??iden k??yt??st??<br>\n  o	Mahdollistaa paremman resurssisuunnittelun</p>\n<p>Valvontamekanismiin kuuluu ylit??iden tekemisen lupapyynt?? seuraavien rajojen ylittyess??:<br>\n  ???	Projektip????llik??iden tekem??n ylity??n osalta<br>\n  o	5 viikoittaisen ylity??tunnin ylitt??misest?? lupa toimitusjohtajalta<br>\n  ???	Ty??maap????llik??n tekem??n ylity??n osalta<br>\n  o	5 viikoittaisen ylity??tunnin ylitt??misest?? lupa projektip????llik??lt?? <br>\n  ???	Asentajan tekem??n ylity??n osalta<br>\n  o	5 viikoittaisen ylity??tunnin ylitt??misest?? lupa ty??maap????llik??lt?? ???<br>\n  ???	Kenen tahansa henkil??n<br>\n  o	yli 10 viikoittaisen ylity??tunnin ylitt??misest?? lupa toimitusjohtajalta<br>\n  </p>\n<p><strong>2.4	Ty??kalujen hallinta</strong></p>\n<p>Ty??maalla olevat ty??kalut tulee aina palauttaa yhti??n l??himp????n toimipisteeseen v??litt??m??sti k??ytt??tarpeen p????ttymisen j??lkeen.<br>\n???	Ty??kalut tulee palauttaa yhti??n l??himp????n toimipisteeseen my??s siin?? tapauksessa, jos ty??kaluja ei k??ytet?? ty??maalla kuukauden mittaisella ajanjaksolla</p>\n<p>Jos samaa ty??kalua samanaikaisesti tarvitaan kahdella eri ty??maalla, ty??kalun k??yt??st?? yhteisty??ss?? sopivat ty??maiden toimihenkil??t.<br>\n  </p>\n<p><strong>2.5	Luottop????t??kset</strong></p>\n<p>Asiakkaasta tulee ottaa aina luottop????t??s<br>\n  ???	Luottop????t??ksen antaa talousjohtaja<br>\n  ???	Luottop????t??ksen rajoja tulee noudattaa<br>\n  ???	Toimihenkil??n ylitt??ess?? rajat, tai j??tt??ess?? luottop????t??ksen ottamatta vastaan, vastaa kyseinen henkil?? henkil??kohtaisesti aiheutuneista vahingoista<br>\n</p>\n<p><strong>2.6	Urakkalaskenta</strong></p>\n<p>Urakat lasketaan yhteisty??ss?? <br>\n???	Tarjousp????llikk?? ja projektip????llik??t k??ytt??v??t henkil??st???? apuna urakkalaskennassa</p>\n<p>Lopullisen tarkistuksen ja tarjouksen tekee tarjousp????llikk??.<br>\n  </p>\n<p><strong>2.6.1	Tarjoamatta j??tetyt urakat</strong></p>\n<p>Jos projektip????llik??n/ty??maap????llik??n mielest?? yhti??ll?? ei ole edellytyksi?? toteuttaa tarjouspyynn??n hanketta, tulee tarjoamatta j??tt??misest?? informoida aina toimitusjohtajaa<br>\n  ???	Asia tulee esitt???? tarjousp????llik??lle s??hk??postitse<br>\no	S??hk??postin sis??lt?? k??sitell????n keskustelemalla</p>\n<p><strong>2.6.2	H??vityt urakat</strong></p>\n<p>H??vityist?? urakoista tulee aina tehd?? ilmoitus s??hk??postitse tarjousp????llik??lle. S??hk??postin tulee sis??lt???? v??hint????n seuraavat tiedot:<br>\n  ???	Urakan sis??lt??<br>\n  ???	Urakan voittanut yhti??<br>\n  ???	Urakan voittaneen yhti??n tarjoussumma <br>\n  ???	Syyt urakan h??vi??miselle<br>\n  ???	Tarjouspyynt??materiaali liitteen??</p>\n<p>Yhti??ss?? halutaan k??sitell?? urakan h??vi??misen syyt, jotta toimintaa pystyt????n kehitt??m????n seuraavaa tarjouslaskentaa varten.<br>\n</p>\n<p><strong>2.6.3	Urakkapalkkausmalli ty??ntekij??ille</strong></p>\n<p>Ty??ntekij??iden kanssa urakkapalkkauksesta sovittaessa k??ytet????n aina urakkapalkkaussopimuspohjaa<br>\n  ???	Toimihenkil??t voivat k??ytt???? urakkapalkkaussopimuspohjaa omissa projekteissaan<br>\n  o	Projektip????llikk?? laatii sopimukset ty??ntekij??iden kanssa<br>\n  o	Ty??maan ty??maap????llikk?? esitt???? halutessaan toiveen urakkapalkkausmallista projektip????llik??lle</p>\n<p>Urakka sidotaan aina ty??vaiheeseen, johon sis??llytet????n urakan ty??tunnit.<br>\n  Urakan valmistuttua nopeammin kuin urakkaan oli ty??ntekij??lle laskettu tunteja, voi ty??ntekij??:<br>\n  1.	pit???? vapaata, jolloin tunnit maksetaan urakan mukaisesti tai<br>\n  2.	jatkaa t??it??, jolloin h??nelle maksetaan urakan osuus yksinkertaisina tunteina</p>\n<p>Jos urakan tunnit tulevat t??yteen, mutta ty?? ei ole valmis, ty??ntekij??n palkka maksetaan normaalisti ty??ehtosopimuksen mukaisesti<br>\n  ???	Ty??ntekij??ll?? on aina ty??tunteihin perustuva takuupalkka</p>\n<p>Urakkamallit tulee perustua laskennassa k??ytettyihin ty??tunteihin. Laskennan ty??tuntim????r???? ei saa urakassa ylitt???? ilman toimitusjohtajan lupaa<br>\n  ???	Seurannan avulla havaitaan mahdolliset virhelaskelmat<br>\n  o	Yhti??n urakkalaskenta kehittyy<br>\n???	Estet????n liian suurien urakkatuntim????rien kirjaaminen</p>\n<p>LAATU on t??rke?? osa urakkamallin toimivuutta. Urakkapalkkausmalli ei saa miss????n nimess?? aiheuttaa laatuongelmia. Urakka on valmis vasta, kun ty??nlaatu vastaa asetettuja kriteerej??. Ty??maap????llikk?? tarkastaa sek?? hyv??ksyy tehdyn ty??n laadun urakan valmistuttua<br>\n  ???	Ty??ntekij??iden tulee olla tietoisia ja ymm??rt???? laatuun liittyv??t vaatimukset ennen ty??n aloittamista<br>\n  ???	Jos laatuongelmia ilmenee, urakkapalkkausmallista luovutaan<br>\n  </p>\n<p><strong>2.7	Projektit</strong></p>\n<p>Projektiprosessi<br>\n  ???	Kysely<br>\n  o	Verkkolomake<br>\n  o	S??hk??posti<br>\n  o	Puhelin<br>\n  ???	Vaihde ohjaa tarvittaessa kyselyn projektip????llik??lle<br>\n  ???	Yhteydenotto ja katselmus<br>\n  o	Projektip????llikk?? ottaa yhteyden asiakkaaseen ja sopii katselmusajankohdan<br>\n  ???	Tarjous<br>\n  o	Ennen tarjouksen l??hett??mist?? projektip????llikk?? ottaa luottop????t??ksen yhti??n toimitusjohtajalta<br>\n  o	Projektip????llikk?? laskee tarjouksen ja tarjoaa kohteen t??it?? kirjallisesti yhti??n k??ytt??m??n ohjelman kautta<br>\n  ???	Tilaus ja tilausvahvistus<br>\n  o	Projektip????llikk?? ottaa tilauksen vastaan<br>\n  ???	Projektip????llikk?? aikatauluttaa urakan ja hyv??ksytt???? aikataulutetun urakan toimitusjohtajalla<br>\n  ???	Hyv??ksytty projekti vahvistetaan tilaajalle kirjallisesti yhti??n k??ytt??m??n j??rjestelm??n kautta<br>\n  o	Projektip????llikk?? t??ytt???? projektilomakkeen ja avaa projektinumeron<br>\n  ???	Projektinumeroa k??ytett??v?? kaikissa projektiin liittyviss?? asiakirjoissa<br>\n  ???	Ty??nhoito<br>\n  o	Projektip????llikk?? ja ty??maap????llikk??(t) vastaavat ty??maasta ohjeistuksen mukaisesti<br>\n  ???	Ty??j??ljen oltava aina laadukasta<br>\n  o	My??h??stymisist?? v??lit??n raportointi s??hk??postitse osoitteeseen m????rittele s??hk??posti<br>\n  o	Poikkeuksista ja reklamaatioista v??lit??n raportointi s??hk??postitse osoitteeseen m????rittele s??hk??posti<br>\n  ???	Valmistuminen ja laskutus<br>\n  o	Projektip????llikk?? laskuttaa asiakasta yhti??n k??ytt??m??n j??rjestelm??n kautta maksupostien mukaisesti<br>\n  o	Projektip????llikk?? ilmoittaa projektin valmistumisesta toimitusjohtajalle<br>\no	Projektip????llikk?? arkistoi dokumentit</p>\n<p><strong>2.7.1	Projektinumerointi</strong></p>\n<p>Projektinumeroa tulee k??ytt???? kaikissa projektiin liittyviss?? asiakirjoissa. Projektinumeroinnin avulla toteutetaan seurantaa, joka mahdollistaa kannattavan liiketoiminnan<br>\n  ???	Mitk?? ovat projektin todelliset syntyneet kustannukset ja tulot<br>\n  o	Projektilaskenta kehittyy<br>\n  ???	Tunnistetaan mahdolliset virheet, joita tehty projektilaskennassa<br>\n  o	Liiketoiminnan sek?? ty??llist??misen jatkuminen mahdollistetaan<br>\n  ???	Yhti??lle mahdollistetaan kasvun edellytykset my??s taloudellisesti</p>\n<p>Projektinumero koostuu kahdesta osasta ja kuusi merkki?? pitk??<br>\n  ???	Kaksinumeroinen alkuosa<br>\n  o	Esimerkiksi kustannuspaikka 2 Urakat on projektinumeroinnin alkuosa 02<br>\n  ???	Nelimerkkinen loppuosa<br>\n  o	Yksi aakkonen: P = Projektit<br>\n  o	Kolme itse m????ritelty?? numeroa: 001<br>\n  ???	ESIMERKIKSI: 02P001</p>\n<p>Ilman asianmukaisesti projektinumeroinnilla merkittyj?? asiakirjoja joudutaan selvitt??m????n j??lkeenp??in<br>\n  ???	Synnytt???? yhti??ss?? ylim????r??isi?? kustannuksia<br>\n  o	Paine hintojen nostamiseen kasvaa<br>\n  ???	Mahdollinen asiakkaiden menett??minen<br>\n  ???	Liiketoiminnan jatkumisen vaarantuminen</p>\n<p><strong>2.7.2	Pienprojektit</strong></p>\n<p>Pienprojekti on alle 3000 euron projekti<br>\n???	Suuremmista hankkeista tulee avata oma projektinumero projektilomakkeella</p>\n<p>Pienprojektien ty??t alkavat siit?? hetkest??, kun ty??kohteeseen l??hdet????n<br>\n  o	Kertokaa asiakkaalle puhelimitse v??hint????n seuraavat asiat selke??sti<br>\n  ???	hinnoittelu<br>\n  ???	milloin ty??maalle l??hdet????n<br>\n  ???	milloin ty??maalle saavutaan<br>\n  ???	laskutettava ty??aika alkaa ty??ntekij??n l??htiess?? toimipisteest??<br>\n  ???	laskutettava ty??aika p????ttyy ty??ntekij??n palattua toimipisteeseen</p>\n<p>Projektip????llikk??/ty??maap????llikk?? luo laskut ty??nkuittauslomakkeen perusteella<br>\n  o	Ohjeistakaa henkil??st?? t??ytt??m????n ty??nkuittauslomakkeet oikein<br>\n  ???	Sis??lt??en mm. Y-tunnuksen tai henkil??tunnuksen<br>\n  ???	Lomakkeeseen merkataan kenen ja mit?? tuotteita ty??maalla on k??ytetty<br>\n  o	Pienty??n perustuntilaskutus on aina v??hint????n 52 euroa / tunti + alv 24 %<br>\n  ???	Ylity??t ja kulukorvaukset ty??aikalain ja noudatettavan ty??ehtosopimuksen mukaan.<br>\n  ???	Ylity?? 50% kerroin 1,5<br>\n  ???	Ylity?? 100% kerroin 2,0<br>\n  ???	Ylity?? 200% kerroin 3,0<br>\n  ???	Ylity?? 300% kerroin 4,0<br>\n  ???	Muut lis??t laskutetaan kertoimella 1,75<br>\n  ???	Muut kulut, p??iv??rahat, matkakulut ja majoitus laskutetaan kertoimella 1,05<br>\n  o	Laskutus v??hint????n kerran viikossa.<br>\n  o	Tuotehinnat tukkurihinnaston mukaan, ei alennuksia ilman toimitusjohtajan lupaa.<br>\n  o	Projektip????llikk??/ty??maap????llikk?? arkistoi ty??nkuittauslomakkeen yhti??n k??yt??ss?? olevaan j??rjestelm????n<br>\n</p>\n<p><strong>2.7.3	Ohje projektin sis??isest?? kommunikaatiosta</strong></p>\n<p>Kaikki projektin toimihenkil??t pidet????n ajan tasalla projektin etenemisest?? p??ivitt??m??ll?? projektikansiota<br>\n  ???	Projektikansio on yhti??n k??yt??ss?? olevassa arkistointi j??rjestelm??ss??<br>\n???	Arkistoon tulee tallentaa kaikki projektin tietomateriaali </p>\n<p>Kaikki projektiin liittyv??t s??hk??postikeskustelut tulee toimittaa kopiona jokaiselle projektin toimihenkil??lle<br>\n  ???	S??hk??posti osoitetaan henkil??lle, jota kyseinen s??hk??posti koskee<br>\n  ???	S??hk??posti l??hetet????n kopiona kaikille muille projektin toimihenkil??ille<br>\n  2.7.4	Projektilaskennan materiaalin kilpailutus</p>\n<p>Projektien (yli 3000 euroa) materiaalit projektip????llikk??/ty??maap????llikk?? kilpailuttaa projektilaskennan yhteydess??.<br>\n  Materiaalin kilpailutuksen prosessi:<br>\n  ???	Projektip????llikk??/ty??maap????llikk?? massoittaa urakkamateriaalit<br>\n  ???	Projektip????llikk??/ty??maap????llikk?? kilpailuttaa materiaalit l??hett??m??ll?? tarjouspyynn??n v??hint????n kolmelle eri toimittajalle<br>\n  o	Tiedot yhdess?? s??hk??postissa<br>\n  o	Tarjouspyynn??n l??hetys mahdollisimman nopeasti<br>\n  o	Tarjouspyynn??n tulee sis??lt???? viimeinen tarjouksen j??tt??misp??iv??m????r?? toimittajien tiedoksi<br>\n  ???	Projektip????llikk??/ty??maap????llikk?? t??ytt???? tarjousten halvimmat hinnat projektilaskennan materiaalitaulukkoon<br>\n  o	Projektip????llikk??/ty??maap????llikk?? tarkastaa materiaalilistan ja hinnat<br>\n  ???	Toimitusjohtaja laskee viimeisen katteen ja tarjoushinnan sek?? antaa kirjallisen luvan tehd?? tarjous asiakkaalle kirjallisesti yhti??n j??rjestelm??n kautta</p>\n<p><strong>2.7.5	Projektin hankintojen kilpailutus</strong></p>\n<p>Hankinnat kilpailutetaan uudestaan projektin saamisen j??lkeen<br>\n???	V??hint????n kolmen toimittajan kesken</p>\n<p>Tarjous vastaanotetaan aina kirjallisesti. Tarjouksesta tulee v??hint????n ilmet?? seuraavat asiat<br>\n  ???	hinta<br>\n  ???	toimitusehto<br>\n  ???	toimitusaika</p>\n<p>Tarpeet tulee m????ritell?? mahdollisimman selke??sti kirjalliseen tarjouspyynt????n<br>\n  ???	Vastaanotetut tarjoukset ovat vertailukelpoisia kesken????n</p>\n<p>Tarjouspyynt????n tulee kirjata tarjouksen viimeinen palautusp??iv??<br>\n  ???	Aikarajan j??lkeen tulleita tarjouksia ei en???? hyv??ksyt??<br>\n  o	Poikkeuksena eritt??in painava syy<br>\n  ???	P????miehet oppivat t??sm??llisyyteen<br>\n  o	Yhti?? kykenee j??rjest??m????n omat ty??ns?? helpommin</p>\n<p>Jos tarjouksessa viitataan yleisiin toimitusehtoihin, tulee n??m?? olla my??s kirjallisesti toimitettuna tarjouksen yhteydess??.<br>\n  Suullisia tai vajavaisia tarjouksia ei oteta huomioon.</p>\n<p>Kaikki tarjouspyynt????n liittyv??t lis??kysymykset tulee vastaanottaa s??hk??postitse <br>\n  ???	Kirjoitettu vastaus l??hetet????n aina s??hk??postitse kaikille toimittajille, joille tarjouspyynt?? on l??hetetty<br>\n  o	S??hk??posti sis??lt???? kysymyksen sek?? vastauksen<br>\n  ???	Eri toimittajien kanssa puhelimitse keskustellut asiat pyydet????n my??s s??hk??postitse<br>\n  o	Kirjallinen todistus sovituista asioista<br>\n  o	Kysymykset ja vastaukset jaetaan my??s muille tarjouspyynn??n vastaanottaneille toimijoille<br>\n</p>\n<p><strong>2.8	Ostot</strong></p>\n<p>Ostot suoritetaan projektip????llik??n/ty??maap????llik??n toimesta aina yhti??n k??yt??ss?? olevan j??rjestelm??n kautta (ostotilaus)<br>\n  ???	Poikkeus materiaalien osalta: vanhoilta sopimustoimittajilta voidaan hakea pienempi?? tilauksia jo valmiiksi sovituin hinnoin 300 euroon asti<br>\n  o	Pienprojektit tai ty??maalla esiintyneen nopean tarpeen takia<br>\n  ???	My??s alihankintaty??st?? tulee tehd?? aina ja poikkeuksetta ostotilaus <br>\n  o	Tilausehdoissamme k??sittelemme ty??nj??lke??, ty??maavastuita jne.<br>\n  ???	Kyseiset asiat ovat t??rkeit?? asioita alihankkijoiden kanssa toimiessa, varsinkin jos ongelmia ty??maalla alkaa ilmet??<br>\n  ???	Urakkat??ist?? teht??v?? erikseen ostotilaus alihankkijalle<br>\n  o	Selke??sti m????riteltyn?? teht??v??t ty??t ja urakan sis??lt??</p>\n<p>Tilaaminen ilman hintatietoa ei ole miss????n tapauksessa hyv??ksytt??v????. Tuotteesta ja ehdoista tulee aina olla kirjallinen ostotilaus yhti??n k??yt??ss?? olevan j??rjestelm??n kautta.<br>\n  Ainoastaan ty??maan projektip????llikk??/ty??maap????llikk?? voi tilata tuotteita tai palveluita ty??maalle<br>\n  ???	Muun henkil??st??n tekem??t tilaukset tullaan katsomaan tilaajan henkil??kohtaiseksi tilaukseksi <br>\n  2.8.1	Toimittajien tilinavaukset </p>\n<p>Toimittajille tulee aina avata tili t??m??n kohdan mukaisin rajoituksin.<br>\n  Maksuehdon tulee olla v??hin????n 30 p??iv???? netto<br>\n  ???	Tavoitteena keskiarvo 45 p??iv???? netto<br>\n  o	Maksuehtoneuvottelut aloitetaan asiakkaan kanssa 90 p??iv??n maksuehdosta<br>\n  ???	Yhti??n kassavarat paranevat ja yhti??n kasvulla on paremmat taloudelliset edellytykset<br>\n  ???	Maksuehdon alituksesta tulee aina pyyt???? lupa toimitusjohtajalta</p>\n<p>Konkreettisen tilinavauksen tekee ostop????llikk?? toimihenkil??n pyynn??st??.<br>\n</p>\n<p><strong>2.8.2	Tarjoukset</strong></p>\n<p>Tarjouksen teko-oikeus on erikseen nimetyill?? henkil??ill??.<br>\n  Tarjoukseen tulee vastata viiden (5) p??iv??n sis??ll?? tarjouspyynn??n vastaanottamisesta tai v??hint????n vuorokautta ennen tarjouksen j??tt??ajankohtaa ja varmistaa ett?? asiakas on vastaanottanut tarjouksen ajoissa. <br>\n  Tarjous tulee tehd?? ohjeistetun tarjousprosessin mukaisesti. Tarjous tulee j??tt???? asiakkaalle kirjallisena yhti??n k??yt??ss?? olevan j??rjestelm??n kautta<br>\n  ???	Tarjouksia ei voi tehd?? suullisesti yhti??n nimiss??<br>\n  o	Suullisista tarjouksista vastaa aina tarjouksen tekij?? henkil??kohtaisesti<br>\n  <br>\n  Urakkatarjoukset hyv??ksytet????n aina tarjousp????llik??ll?? ennen tarjouksen l??hett??mist??.<br>\n  </p>\n<p><strong>2.9	Tilausvahvistukset</strong></p>\n<p>Tilausvahvistuksien teko-oikeus on erikseen nimetyill?? henkil??ill??.<br>\n  Tilausvahvistuksia tehdess?? tulee aina noudattaa ohjeistettua prosessia. Yhti??n tekemist?? t??ist?? on teht??v?? aina kirjallinen tilausvahvistus yhti??n k??yt??ss?? olevan j??rjestelm??n kautta<br>\n  ???	Kirjallinen tilausvahvistus v??hent???? huomattavasti reklamaatioita<br>\n  ???	Suullisista tilausvahvistuksista vastaan aina tilausvahvistuksen tekij?? henkil??kohtaisesti<br>\n  <br>\n  Tilausvahvistukseen tulee kirjata mahdollisimman tarkasti v??hint????n seuraavat asiat<br>\n  ???	Ty??n sis??lt??<br>\n  ???	Urakan rajat<br>\n  o	Urakoita koskevia tilausvahvistukset hyv??ksytet????n aina ennen l??hett??mist?? toimitusjohtajalla<br>\n2.10	Laskutus</p>\n<p>Laskutus heti kun mahdollista, kuitenkin v??hint????n kerran viikossa tai projektien laskutuspostien mukaisesti<br>\n  ???	Tavoitteena mahdollisimman nopea laskutus, joka mahdollistaa yhti??n kasvun taloudelliset edellytykset<br>\n  ???	Lis??ty??t laskutetaan viikoittain.</p>\n<p>2.10.1	Laskujen asiatarkastus</p>\n<p>Toimihenkil??t vastaavat laskun asiatarkastuksesta. Laskusta tulee tarkistaa v??hint????n seuraavat asiat:<br>\n  ???	Yhti??n tarkastus<br>\n  o	Lasku tullut oikeaan yhti????n<br>\n  o	Nimi ja Y-tunnus oltava oikein<br>\n  ???	Viitteen tarkastus<br>\n  o	Oikea projektinumero<br>\n  ???	Yhteyshenkil??n tarkastus<br>\n  o	Oikea yhteyshenkil??<br>\n  ???	Maksuehdon tarkastus<br>\n  o	Oikea maksuehto???<br>\n  ???	Hinnat sovitut<br>\n  o	Ty??st?? ja materiaalista on tehty ostotilaus<br>\n  ???	Ty??n sis??lt?? kirjattu selke??sti<br>\n  o	Kuka tehnyt<br>\n  o	Koska tehty<br>\n  o	Mit?? tehty<br>\n  o	Kuka tarkastanut ja miten<br>\n  ???	Liitteen?? kopio ty??ntekij??n tuntikortista</p>\n<p>Alihankkijoiden ty?? tarkastetaan ja hyv??ksyt????n erikseen ennen laskutuslupaa ty??kohteessa tilauksen tehneen henkil??n toimesta.<br>\n  2.10.2	Reklamaatiot</p>\n<p>Reklamaatiot kirjallisesti s??hk??postitse osoitteeseen m????rittele s??hk??posti t??h??n<br>\n  ???	S??hk??posti sis??lt???? v??hint????n:<br>\n  o	Reklamaation tekij??n yhteystiedot<br>\n  o	Kuvauksen reklamaatiosta<br>\n  ???	Toimitusjohtaja hoitaa reklamaatiot s??hk??postitse tehdyn ilmoituksen j??lkeen</p>\n<p>Asiakkaita tulee kannustaa reklamaatioiden tekemiseen<br>\n  ???	Reklamaatioiden avulla yhti?? pystyy kehitt??m????n toimintaansa</p>\n<p>Henkil??st??n tulisi informoida kaikki saamansa asiakaspalaute yhti??n toimitusjohtajalle<br>\n  ???	Asiakkaiden kanssa toimiessa heid??n tarpeiden tunnistaminen sek?? niiden t??ytt??minen ovat kannattavan liiketoiminnan yksi oleellisimmista tekij??ist?????<br>\n  </p>\n<p><strong>3	TY??SUOJELU- JA TY??TURVALLISUUSOHJE</strong></p>\n<p><strong>KUVAUS</strong></p>\n<p>Yhti?? Oy:n ty??ntekij??t ty??skentelev??t erityyppisiss?? teht??viss?? ja erilaisilla ty??paikoilla. Ty??nantajana Yhti?? Oy vastaa aina ty??ntekij??idens?? ty??suojelusta ja ty??turvallisuudesta. T??m?? ohje on tarkoitettu antamaan pohjan turvalliselle ty??skentelylle.</p>\n<p>Tarvittaessa ty??suojeluohjetta voidaan t??ydent???? ty??ntekij??n ty??sopimuksen yhteydess?? niill?? erityisseikoilla, jotka eiv??t esim. ty??kohteen ohjeistuksista tai t??st?? ty??suojeluohjeesta suoraan ilmene.</p>\n<p><strong>TAVOITE</strong></p>\n<p>T??m??n ohjeen tarkoitus on antaa perusteet kaiken tyyppisen ty??n turvalliselle suorittamiselle. Ty??ntekij?? perehtyy t??h??n ohjeeseen ja ty??nantajan osoittamiin muihin ty??suojelua ja ty??turvallisuutta koskeviin erityisohjeisiin. Ty??ntekij?? sitoutuu noudattamaan niiss?? annettuja ohjeita ja velvoitteita.<br>\n  <br>\n  <strong>3.1	Vastuu ty??suojelusta ja ty??turvallisuudesta</strong></p>\n<p>Ty??nantajana Yhti?? Oy vastaa aina ty??suojelusta ja ty??turvallisuudesta sek?? siit??, ett?? ty??suojelussa ja ty??turvallisuudessa noudatetaan ajantasaisia m????r??yksi??.</p>\n<p>Ty??nantaja on nimennyt ty??suojelup????llik??n, joka tulee olla ty??kohteen ty??ntekij??iden ja yhteyshenkil??iden tiedossa.</p>\n<p>Ty??nantaja vastaa, ett?? voimassa olevat ja p??ivitetyt ty??suojelu- ja ty??turvallisuusohjeet ovat kaikkien helposti saatavilla.</p>\n<p>Ty??nantajan nime??m?? ty??maap????llikk?? perehdytt???? ty??ntekij??n kulloinkin kyseess?? olevan ty??maan ty??teht??viin ja erityispiirteisiin. Ty??ntekij?? on velvoitettu huomauttamaan ty??maap????llikk???? ja ty??nantajaa, mik??li perehdytyst?? ei anneta tai sit?? ei anneta riitt??v??sti.</p>\n<p>Kumpikin osapuoli, ty??ntekij?? ja ty??nantaja, sitoutuvat noudattamaan aina voimassa olevia lakeja (ty??turvallisuuslaki, ty??suojelun valvontalaki, ty??terveyslaki jne.), s????nn??ksi?? ja ty??suojeluohjeita.</p>\n<p>Ty??nantajana Yhti?? Oy vastaa aina ty??ntekij??idens?? ty??suojelusta ja ty??turvallisuudesta. Ty??suojelu- ja ty??turvallisuusohjeen tarkoitus on antaa pohjan turvalliselle ty??skentelylle. ty??skentelylle. Ty??suojelu- ja ty??turvallisuusohjeen tarkoitus on antaa perusteet kaiken tyyppisen ty??n turvalliselle suorittamiselle. Ty??ntekij?? perehtyy ty??suojelu- ja ty??turvallisuusohjeeseen ja ty??nantajan osoittamiin muihin ty??suojelua ja ty??turvallisuutta koskeviin erityisohjeisiin. Ty??ntekij?? sitoutuu noudattamaan niiss?? annettuja ohjeita ja velvoitteita.<br>\n  <br>\n  <strong>3.1.1	Yhti?? Oy:n ty??suojelup????llikk?? ja s??hk??t??iden johtaja</strong></p>\n<p>YHTI?? OY:n<br>\n  (Y-tunnus m????rittele y-tunnus)</p>\n<p>Ty??suojelup????llikk?? on<br>\n  Nime?? ty??suojelup????llikk??</p>\n<p>M????rittele s??hk??posti<br>\n  M????rittele puhelinnumero</p>\n<p>Yhti?? OY<br>\n  M????rittele osoite<br>\n  M????rittele postinumero ja -toimipaikka</p>\n<p>S??hk??t??iden johtaja on<br>\n  Nime?? s??hk??t??iden johtaja<br>\n  M????rittele s??hk??posti<br>\n  M????rittele puhelinnumero</p>\n<p><strong>3.2	Ty??ntekij??n ilmoittamis- ja huomauttamisvelvoite</strong></p>\n<p>Ty??ntekij??n havaitessa tai kokiessa puutteita, laiminly??ntej?? tai muuta huomautettavaa ty??maansa ty??suojelu- ja/tai ty??turvallisuusasioissa, on h??n velvoitettu ilmoittamaan/huomauttamaan asiasta viipym??tt?? ty??maan ty??maap????llik??lle ja ty??nantajalle.<br>\n  Ty??ntekij??n havaitessa ty??maansa muiden ty??ntekij??iden kokevan tai havaitsevan puutteita, laiminly??ntej?? tai muuta huomautettavaa ty??maansa ty??suojelu- ja/tai ty??turvallisuusasioissa, on h??n velvoitettu ilmoittamaan/huomauttamaan asiasta viipym??tt?? ty??n suorittajalle (toinen ty??ntekij??), ty??maan ty??maap????llik??lle ja ty??nantajalle.<br>\n  </p>\n<p><strong>3.3	Ty??suojelu ja ty??turvallisuus ty??paikalla yleisesti</strong></p>\n<p>Erilaisissa ty??teht??viss?? vaaditaan ty??ntekij??lt?? erityyppisi?? ominaisuuksia ty??n turvalliselle suorittamiselle. N??m?? ominaisuudet voivat olla fyysisi?? tai psyykkisi??, kuitenkin sellaisia asioita, jotka tuodaan ilmi ty??ntekij??lle jo ty??haastatteluvaiheessa. Edelleen tietyiss?? ty??teht??viss?? vaaditaan ty??ntekij??ll?? olevan tietty pohjakoulutus ja tarvittavat voimassa olevat lis??koulutukset ja p??tevyydet.</p>\n<p>Ty??nantajalla on velvollisuus selvitt???? ty??ntekij??lle tietoon ty??ntekij??lt?? vaadittavat koulutukset ja p??tevyydet. Ty??ntekij??n tulee osoittaa omaavansa ty??ss?? vaadittavat koulutukset ja p??tevyydet esitt??m??ll?? ty??nantajalle tarvittavat todistukset tai muut dokumentit.</p>\n<p>T??ss?? ohjeistuksessa on eritelty koulutukset ja p??tevyydet Yhti?? Oy:n ty??ntekij??iden keskeisimmille ty??paikkatyypeille. Mik??li tietty?? ty??paikkaa/ty??teht??v???? ei t??st?? ohjeistuksesta suoraan l??ydy, tulee ty??nantajan selvitt???? ty??ntekij??lle ty??ss?? sovellettavat ty??suojelu- ja ty??turvallisuusohjeet. <br>\n  </p>\n<p><strong>3.3.1	Yhti?? Oy:n toimitilat</strong></p>\n<p>Yhti?? Oy:n henkil??st??n toimitiloissa ty??skentelevien henkil??iden ty??suojelussa ja ty??turvallisuudessa noudatetaan toimistoty??h??n liittyvi?? seuraavia ohjeistuksia:</p>\n<p>???	Jokainen huolehtii omasta henkil??kohtaisesta ty??n turvallisesta suorittamisesta ilman, ett?? ty??st?? aiheutuu vaaratilanteita itselle tai muille ty??ntekij??ille.</p>\n<p>???	Ty??nantaja huolehtii jokaiselle ty??ntekij??lle ergonomisesti hyvin valitut ja suunnitellut ty??pisteet ja -v??lineet, joilla ty??teht??v??t voidaan suorittaa ilman ylim????r??isi?? fyysisi?? rasitteita.</p>\n<p>???	Jokainen ty??ntekij?? vastaa omasta hygieniastaan niin, ettei siit?? aiheudu ongelmia itselle ja muille. Ty??nantaja vastaa toimitilan s????nn??llisest?? siistimisest?? ja siit??, ett?? toimitilan wc-tiloissa on riitt??v??t v??lineet henkil??kohtaisen hygienian yll??pit??miseksi.</p>\n<p>???	Ty??nantaja ei tarjoa ty??ntekij??lle ty??vaatteita. Ty??ntekij???? velvoitetaan pukeutumaan siististi toimistoty??n edellytt??m??ll?? tavalla ja siten, ett?? vaatetuksesta ei l??ydy sellaisia seikkoja, jotka voisivat heikent???? ty??turvallisuutta toimitiloissa (esim. irtonaisia, herk??sti takertuvia osia yms.).</p>\n<p>???	Toimitilassa jokainen ty??ntekij?? tiet????, mist?? l??yt???? ensisammutus- ja ensiapuv??lineet ja miten niit?? k??ytet????n onnettomuuden sattuessa. Edelleen ty??ntekij??t tuntevat toimitilan kaikki varaulosk??ynnit.</p>\n<p>???	Ty??ss????n ty??ntekij??n tulee noudattaa voimassa olevia lakeja ja s????nn??ksi??.</p>\n<p>???	Ty??ntekij??n havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminly??ntej?? tai muuta huomautettavaa ty??suojelu- ja/tai ty??turvallisuusasioissa, on h??n velvoitettu ilmoittamaan/huomauttamaan asiasta viipym??tt?? ty??n suorittajalle (toinen ty??ntekij??) ja ty??nantajalle.<br>\n  </p>\n<p><strong>3.3.2	Yhti?? Oy:n asiakask??ynnit</strong></p>\n<p>Yhti?? Oy:n henkil??st??n asiakask??ynneill?? noudatetaan asiakkaan/tilaajan ty??suojelu- ja ty??turvallisuusohjeistuksia, mik??li muuta ei ole ennakkoon sovittu. Joka tapauksessa otetaan huomioon seuraavat asiat:</p>\n<p>???	Ty??nantaja varmistaa, ett?? ty??ntekij??ll?? on asiakask??ynnill?? tarvittavat ty??vaatteet ja suojav??lineet (kyp??r?? jne.), mik??li tilanne sit?? vaatii.</p>\n<p>???	Ty??ntekij?? huolehtii asiakkaan kanssa ty??turvallisuudesta asiakask??ynnin ajan. Ty??ntekij?? ei siis ryhdy poikkeustapauksessakaan mihink????n sellaiseen toimeen, mist?? voisi aiheutua haittaa itselle tai muille.</p>\n<p>???	Ty??ntekij??n tulee noudattaa asiakask??yneill?? voimassa olevia lakeja ja s????nn??ksi?? sek?? mahdollisia muita erityism????r??yksi?? (esim. ty??kohteessa olevat erilliset m????r??ystaulut, opasteet jne.).</p>\n<p>???	Asiakask??ynnill?? ty??ntekij??n havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminly??ntej?? tai muuta huomautettavaa ty??suojelu- ja/tai ty??turvallisuusasioissa, on h??n velvoitettu ilmoittamaan/huomauttamaan asiasta viipym??tt?? ty??n suorittajalle (toinen ty??ntekij??), asiakkaalle ja ty??nantajalle (toimittaja).<br>\n  </p>\n<p><strong>3.3.3	Et??ty??skentely</strong></p>\n<p>Yhti?? Oy:n henkil??st??n ja ty??ntekij??iden et??ty??skentelyss?? noudatetaan t??t?? ty??suojelu- ja ty??turvallisuusohjetta, mik??li muuta ei ole sovittu. Joka tapauksessa otetaan huomioon seuraavat asiat:</p>\n<p>???	Ty??nantaja varmistaa, ett?? ty??ntekij??ll?? on et??ty??ss?? tarvittavat ja asianmukaiset turvalliset ty??v??lineet. Mik??li ty?? tehd????n suoraan asiakkaalle (tilaaja), vastaa t??m?? ty??v??lineiden m????ritt??misest?? ja toimittaa niist?? tiedot toimittajalle. Edelleen tilaaja vastaa ty??v??lineiden oikean ja turvallisen k??yt??n kouluttamisesta ty??ntekij??lle.</p>\n<p>???	Ty??ntekij?? huolehtii itse et??ty??skentelyns?? ty??turvallisuudesta. Ty??ntekij?? ei ryhdy poikkeustapauksessakaan mihink????n sellaiseen toimeen, mist?? voisi aiheutua haittaa itselle tai muille. Asiakkaalle (tilaaja) suoraan teht??v??ss?? ty??ss?? ty??ntekij?? noudattaa my??s tilaajan et??ty??lle asettamia ty??suojelu- ja ty??turvallisuusohjeita.</p>\n<p>???	Ty??ntekij??n tulee noudattaa et??ty??skentelyss????n voimassa olevia lakeja ja s????nn??ksi?? sek?? mahdollisia muita erityism????r??yksi??.</p>\n<p>???	Et??ty??skentelyss????n ty??ntekij??n havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminly??ntej?? tai muuta huomautettavaa ty??suojelu- ja/tai ty??turvallisuusasioissa, on h??n velvoitettu ilmoittamaan/huomauttamaan asiasta viipym??tt?? ty??n suorittajalle (toinen ty??ntekij??) ja ty??nantajalle sek?? tilaajalle, mik??li ty?? tehd????n suoraan asiakkaalle.<br>\n  </p>\n<p><strong>3.3.4	Rakennusty??maat (uudisrakennus ja saneeraus)</strong></p>\n<p>Rakennusty??mailla noudatetaan ty??nantajan ty??suojeluun ja ty??turvallisuuteen liittyvi?? ohjeistuksia ja m????r??yksi??. Lis??ksi:</p>\n<p>???	Ty??nantajan nime??m?? ty??maap????llikk?? vastaa ty??n suorittamisen ja valvonnan lis??ksi ty??suojelusta ja ty??turvallisuuden noudattamisesta ty??maalla.</p>\n<p>???	Ty??nantajan nime??m??n ty??maap????llik??n tulee toimittaa ty??ntekij??lle t??m??n ty??ss????n tarvitsemat ty??vaatteet (vaadittavat v??ritykset, tarvittaessa antiflame) ja suojav??lineet (kyp??r??, suojalasit, k??sineet, jne.).</p>\n<p>???	Terveydelle haitallisissa purku- ja saneerauskohteissa (esim. asbestinpurkuty??maa) tulee ty??nantajan tarjota ty??ntekij??lle lain ja m????r??ysten mukaiset ty??ss?? vaadittavat hengitys- ja henkil??kohtaisiset suojav??lineet.</p>\n<p>???	Ty??nantajan tulee selvitt???? ty??ntekij??lle t??lt?? teht??v??ss?? vaadittavasta pohjakoulutuksesta sek?? mahdollisesti vaadittavista lis??koulutuksista ja p??tevyyksist?? (esim. Ty??turvallisuuskortti).</p>\n<p>???	Ty??nantaja vastaa, ett?? ty??ntekij??ll?? on teht??v????n vaadittava koulutus ja mahdolliset muut tarvittavat p??tevyydet. Ty??ntekij?? on velvollinen toimittamaan ty??nantajalle tiedot p??tevyyksist????n ja koulutuksistaan.</p>\n<p>???	Ty??nantajan nime??m?? ty??maap????llikk?? perehdytt???? ty??ntekij??n ty??maan erityspiirteisiin, erityisiin riskeihin ja muihin ty??suojeluun ja ty??turvallisuuteen vaikuttaviin seikkoihin.</p>\n<p>???	Ty??maap????llikk?? antaa koulutuksen ty??ss?? k??ytett??viin laitteisiin ja v??lineisiin sek?? opastaa niiden turvallisen k??yt??n ty??ss??.</p>\n<p>???	Ty??ntekij??n tulee noudattaa ty??ss????n voimassa olevia lakeja ja s????nn??ksi??, tilaajan antamia ohjeita ja m????r??yksi?? sek?? mahdollisia muita erityism????r??yksi?? (esim. ty??kohteessa olevat erilliset m????r??ystaulut, opasteet jne.).</p>\n<p>???	Ty??ntekij??n havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminly??ntej?? tai muuta huomautettavaa ty??paikkansa ty??suojelu- ja/tai ty??turvallisuusasioissa, on h??n velvoitettu ilmoittamaan/huomauttamaan asiasta viipym??tt?? ty??n suorittajalle (toinen ty??ntekij??), ty??paikan esimiehelle (ty??maap????llikk??) ja ty??nantajalle.<br>\n  3.3.5	S??hk??ty??maat (uudisrakennus ja saneeraus)</p>\n<p>S??hk??ty??mailla noudatetaan ty??nantajan ty??suojeluun ja ty??turvallisuuteen liittyvi?? ohjeistuksia ja m????r??yksi??. Lis??ksi:</p>\n<p>???	Ty??nantajan nime??m?? ty??maap????llikk?? (tai vastaava) vastaa ty??n suorittamisen ja valvonnan lis??ksi ty??suojelusta ja ty??turvallisuuden noudattamisesta ty??maalla, ellei erikseen ole toisin kirjallisesti sovittu.</p>\n<p>???	Ty??nantaja varmistaa, ett?? ty??ntekij??ll?? on ty??ss????n k??yt??ss?? tarvittavat ty??vaatteet (esim. vaadittavat v??ritykset) ja suojav??lineet (kyp??r??, k??sineet, jne.) vaatimusten mukaisesti.</p>\n<p>???	Ty??nantajan tulee selvitt???? ty??ntekij??lle t??lt?? teht??v??ss?? vaadittavasta pohjakoulutuksesta sek?? mahdollisesti vaadittavista lis??koulutuksista ja p??tevyyksist??.</p>\n<p>???	Ty??nantaja vastaa, ett?? ty??ntekij??ll?? on teht??v????n vaadittava koulutus ja mahdolliset muut tarvittavat p??tevyydet. Ty??ntekij?? on velvollinen toimittamaan ty??nantajalle tiedot p??tevyyksist????n ja koulutuksistaan.</p>\n<p>???	Ty??nantajan nime??m?? ty??maap????llikk?? perehdytt???? ty??ntekij??n ty??maan erityspiirteisiin, erityisiin riskeihin ja muihin ty??suojeluun ja ty??turvallisuuteen vaikuttaviin seikkoihin.</p>\n<p>???	Ty??maap????llikk?? antaa koulutuksen ty??ss?? k??ytett??viin laitteisiin ja v??lineisiin sek?? opastaa niiden turvallisen k??yt??n ty??ss??.</p>\n<p>???	Ty??ntekij??n tulee noudattaa ty??ss????n voimassa olevia lakeja ja s????nn??ksi??, tilaajan antamia ohjeita ja m????r??yksi?? sek?? mahdollisia muita erityism????r??yksi?? (esim. ty??kohteessa olevat erilliset m????r??ystaulut, opasteet jne.).</p>\n<p>???	Ty??ntekij??n havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminly??ntej?? tai muuta huomautettavaa ty??paikkansa ty??suojelu- ja/tai ty??turvallisuusasioissa, on h??n velvoitettu ilmoittamaan/huomauttamaan asiasta viipym??tt?? ty??n suorittajalle (toinen ty??ntekij??), ty??paikan esimiehelle (ty??maap????llikk??) ja ty??nantajalle.<br>\n  </p>\n<p><strong>3.3.6	Kuituty??t</strong></p>\n<p>Kuitut??iss?? noudatetaan ty??nantajan ty??suojeluun ja ty??turvallisuuteen liittyvi?? ohjeistuksia ja m????r??yksi??. Lis??ksi:</p>\n<p>???	Ty??nantajan nime??m?? ty??maap????llikk?? (tai vastaava) vastaa ty??n suorittamisen ja valvonnan lis??ksi ty??suojelusta ja ty??turvallisuuden noudattamisesta ty??maalla, ellei erikseen ole toisin kirjallisesti sovittu. </p>\n<p>???	Ty??nantaja varmistaa, ett?? ty??ntekij??ll?? on ty??ss????n k??yt??ss?? tarvittavat ty??vaatteet (esim. vaadittavat v??ritykset, tarvittaessa antiflame) ja suojav??lineet (kyp??r??, k??sineet, suojalasit jne.) ty??n vaatimusten mukaisesti.</p>\n<p>???	Ty??nantajan tulee selvitt???? ty??ntekij??lle t??lt?? teht??v??ss?? vaadittavasta pohjakoulutuksesta sek?? mahdollisesti vaadittavista lis??koulutuksista ja p??tevyyksist??.</p>\n<p>???	Ty??nantaja vastaa, ett?? ty??ntekij??ll?? on teht??v????n vaadittava koulutus ja mahdolliset muut tarvittavat p??tevyydet. Ty??ntekij?? on velvollinen toimittamaan ty??nantajalle tiedot p??tevyyksist????n ja koulutuksistaan.</p>\n<p>???	Ty??nantajan nime??m?? ty??maap????llikk?? perehdytt???? ty??ntekij??n ty??maan erityspiirteisiin, erityisiin riskeihin ja muihin ty??suojeluun ja ty??turvallisuuteen vaikuttaviin seikkoihin.</p>\n<p>???	Ty??maap????llikk?? antaa koulutuksen ty??ss?? k??ytett??viin laitteisiin ja v??lineisiin sek?? opastaa niiden turvallisen k??yt??n ty??ss??.</p>\n<p>???	Ty??ntekij??n tulee noudattaa ty??ss????n voimassa olevia lakeja ja s????nn??ksi??, tilaajan antamia ohjeita ja m????r??yksi?? sek?? mahdollisia muita erityism????r??yksi?? (esim. ty??kohteessa olevat erilliset m????r??ystaulut, opasteet jne.).</p>\n<p>???	Ty??ntekij??n havaitessa, kokiessa itse tai havaitessa muiden kokevan tai havaitsevan puutteita, laiminly??ntej?? tai muuta huomautettavaa ty??paikkansa ty??suojelu- ja/tai ty??turvallisuusasioissa, on h??n velvoitettu ilmoittamaan/huomauttamaan asiasta viipym??tt?? ty??n suorittajalle (toinen ty??ntekij??), ty??paikan esimiehelle (ty??maap????llikk??) ja ty??nantajalle.</p>\n<p>???	Ty??nantaja huolehtii kuitut??iss?? syntyv??lle kuituj??tteelle asianmukaiset j??teastiat. Kuitut??iss?? kuituja katkaistaessa kaapelin jatkamisen ja p????tt??misen yhteydess?? syntyv??t kuidunp??tk??t on ker??tt??v?? v??litt??m??sti niille varattuun astiaan. P??yd??lle, vaatteisiin tai muualle j????neet kuidunp??tk??t aiheuttavat ty??turvallisuus- ja terveysriskin, sill?? ne voivat tunkeutua ihon alle ja joutua jopa verenkiertoon. Pahimmassa tapauksessa seurauksena voi olla hengenvaara. Kuitujen j??teastia tulee h??vitt???? asianmukaisesti ja esim. sulkea tiiviisti ennen roskiin heitt??mist??, ettei kuidunp??tkist?? olisi haittaa my??sk????n siivoojille tai muille ty??ntekij??ille.</p>\n<p>???	Ty??nantaja huolehtii, ett?? ty??maalla kuitujen ja liittimien puhdistuksessa k??ytett??v??t kemikaalit, jotka ovat useimmiten palavia, huumaavia ja ??rsytysoireita aiheuttavia, eiv??t aiheuttaisi ty??ntekij??ille ylim????r??ist?? terveydellist?? haittaa. Kemikaalien aiheuttamat terveysriskit minimoidaan huolehtimalla ty??tilan tuuletuksesta ja ty??ntekij??iden suojak??sineiden k??yt??st?? ty??skentelyn aikana. Edelleen my??s optisten kaapeleiden rakenneosien mahdolliset ??rsytysoireita aiheuttavat elementit (esim. aramidi- tai lasikuituvahvikkeet sek?? t??yterasvat ja niiden puhdistusaineet) ja niiden muodostamat ty??turvallisuus- ja terveysriskit minimoidaan edell?? kuvatusti huolehtimalla ty??ntekij??iden asianmukaisesta varustamisesta ty??skentelyss?? sek?? ty??tilan riitt??v??st?? tuuletuksesta.</p>\n<p>???	Kuitut??iss?? optisessa tiedonsiirrossa k??ytett??v?? valo on n??kym??t??nt??, mutta silm??lle vaarallista ja verkkokalvoa vahingoittavaa. Valonl??hteet, varsinkin laserkomponentit l??hett??v??t valoa, jonka osumista silm????n on ehdottomasti varottava. Kuidun tai optisen liittimen p????h??n ei saa koskaan katsoa suoraan edest??. Ty??maap????llikk?? vastaa siit??, ett?? kuitut??iss?? vapaat kuitujen ja liittimien p????t ovat aina asianmukaisesti suljettuja. Edelleen ty??maap????llikk?? vastaa siit??, ett?? jakamoissa ja muissa optisia laitteita sis??lt??viss?? rakenteissa on lasers??teen l??hteet merkitty asianmukaisesti k??ytt??en lasers??teen varoitustarroja.<br>\n  </p>\n<p><strong>3.4	Perehdytt??minen</strong></p>\n<p>Yhti?? Oy:n ty??ntekij??t tulee perehdytt???? heill?? teetett??v????n ty??h??n sek?? ty??maan erityisvaatimuksiin ja ???piirteisiin aina ty??ntekij??n aloittaessa ensimm??ist?? kertaa ty??t ty??maalla. Perehdytt??misest?? vastaa ensisijaisesti ty??nantajan nime??m?? ty??maan ty??maap????llikk??. Ty??maap????llik??n tulee huolehtia yhdess?? ty??ntekij??n kanssa, ett?? ty??ntekij?? saa ty??h??ns?? tarvittavan perehdytyksen ennen ty??h??n ryhtymist??. Puutteellisesta perehdytyksest?? ty??ntekij??n tulee ilmoittaa ty??maap????llik??lle ja ty??nantajalle.</p>\n<p>Jotta perehdytyksess?? tulisi huomioiduksi kaikki tarvittavat seikat ty??teht??vien ja ty??maan erityispiirteist?? ja ???vaatimuksista sek?? ty??suojelusta ja ty??turvallisuudesta, tulee perehdytyksest?? t??ytt???? perehdytt??mislomake, jossa kaikki perehdytykseen sis??llytetyt asiat ovat eriteltyin??. Perehdytt??mislomakkeen t??ytt??v??t ja allekirjoittavat perehdytt??j?? (ty??maap????llikk??) ja ty??ntekij?? yhdess??.<br>\n  </p>\n<p><strong>3.5	Ty??kyvyn yll??pito</strong></p>\n<p>Yhti?? Oy:n ty??ntekij??iden ty??kyvyst?? huolehtivat ensisijaisesti ty??ntekij??t itse. Ty??ntekij??ll?? on velvollisuus ilmoittaa ja/tai huomauttaa ty??nantajalle havaitsemistaan ty??kykyyn heikent??v??sti vaikuttavista tekij??ist?? ty??maalla ja ty??ss?? yleens??.<br>\n  Ty??nantajan edustajat huolehtivat, ett?? ty??ntekij??t s??ilytt??v??t ty??kykyns?? eiv??tk?? kuormita itse????n ylim????r??isill?? lis??t??ill?? ja/tai ylit??ill??.<br>\n  Ty??nantajan vastuuna on tarkkailla ty??ntekij??n ty??kyky?? ja -kuntoa ty??maalla ja tarvittaessa huomauttaa ty??ntekij???? tapauksissa, joissa ty??ntekij??n ty??kyvyss?? ja/tai -kunnossa havaitaan jotain normaalista poikkeavaa.<br>\nTy??nantaja vastaa siit??, ett?? ty??teht??viss?? on aina ennakkoon arvioitu riskitekij??t ja muut seikat, jotka voivat vaikuttaa ty??ntekij??n ja/tai sivullisten ty??kykyyn, -kuntoon tai terveyteen. Edelleen, ty??nantaja vastaa, ett?? ty??maasta on laadittu tarvittavat turvallisuusasiakirjat, mik??li n??in on vaadittu, ja esitt???? ne tarvittaessa my??s ty??ntekij??ille.</p>\n<p><strong>3.6	Muut noudatettavat ohjeistukset ja m????r??ykset</strong></p>\n<p>Ty??nantaja vastaa aina, ett?? ty??suojelussa ja ty??turvallisuudessa noudatetaan aina ajantasaisia ohjeita ja m????r??yksi??. Muut noudatettavat ohjeistukset ja m????r??ykset tulee saattaa ty??ntekij??n tietoon viipym??tt?? niiden astuessa voimaan.<br>\n  Ty??nantajan nime??m?? ty??maap????llikk?? varmistaa, ett?? ty??suojeluun ja ty??turvallisuuteen liittyv??t ohjeistukset on saatettu ty??maan ty??ntekij??iden tietoon.<br>\n  Mahdolliset ep??selvyydet tai ristiriidat kaikissa noudatettavissa ohjeistuksissa ja m????r??yksiss?? tulee selvitt???? heti niiden ilmetty?? ty??maap????llik??n, ty??nantajan ja ty??ntekij??n v??lill??.<br>\n  </p>\n<p><strong>3.7	Ohjeistuksen p??ivitt??minen</strong></p>\n<p>Ty??nantaja vastaa, ett?? kaikkien osapuolien k??ytett??viss?? on aina viimeisin p??ivitetty versio k??yt??ss?? olevasta ty??suojelu- ja ty??turvallisuusohjeistuksesta.<br>\n  T??t?? ohjeistusta p??ivitet????n ja tarkennetaan aina tarvittaessa siten, ett?? se vastaa ajantasaisia m????r??yksi??.<br>\n  Keskeisimm??t p??ivitysten my??t?? t??h??n ohjeistukseen teht??v??t muutokset on viipym??tt?? tuotava kaikkien asiaankuuluvien tahojen tietoon.</p><p>{company_name}</p><p>{switch_phonenumber}</p><p>{company_email}\n</p>');
INSERT INTO `erp_agreements` (`aid`, `text`) VALUES
(2, '<p><strong>1. Soveltaminen ja  m????ritelm??t</strong> <br>\n  1.1. Sopimuksen kohteena on toimittajan (Toimittaja) tilaajalle&nbsp;toimittamat rekrytointi-,  henkil??st??nvuokraus-, henkil??st??konsultointi- sek??&nbsp;ulkoistuspalvelut. <br></p><p>\n  1.2. Ty??voiman vuokrauksella tarkoitetaan  toimintaa, jossa TOIMITTAJA&nbsp;siirt???? ty??ntekij??it????n asiakkaan k??ytt????n  vastiketta vastaan siten, ett?? TOIMITTAJA&nbsp;on ty??ntekij??n ty??nantaja ja  ty??ntekij??n ty??njohto- ja&nbsp;valvontaoikeus sek?? ne ty??nantajalle s????detyt  velvollisuudet, jotka liittyv??t ty??n&nbsp;tekemiseen ja j??rjestelyihin  siirtyv??t asiakkaalle.&nbsp; <br>\n  Ty?? suoritetaan asiakkaan osoittamissa  tiloissa, asiakkaan ty??v??lineill?? ja&nbsp;ty??menetelmien mukaisesti. <br>\n  Ty?? suoritetaan tarjouksessa tai  tilausvahvistuksessa mainitussa paikassa, ty??kohteen&nbsp;siirt??misest?? tulee  sopia osapuolien v??lill?? erikseen. <br></p><p>\n  1.3. Ehdoista voidaan poiketa sopimalla  niist?? kirjallisesti toisin. </p>\n<p><strong>2. Sopijapuolten  yleiset velvollisuudet</strong></p><p><strong></strong> <br>\n  2.1. Asiakkaan tulee sopimuskohtaisesti  antaa&nbsp;TOIMITTAJA:lle oikeat ja riitt??v??t tiedot suoritettavista  ty??teht??vist??,&nbsp;ty??ntekopaikasta, ty??teht??v??n kestosta, ty??skentelyajoista,  ty??n erityispiirteist??,&nbsp;soveltamastaan ty??ehtosopimuksesta ja  mahdollisesta paikallisesta sopimuksesta sek??&nbsp;ilmoitettava&nbsp;TOIMITTAJA:lle  n??iss?? tiedoissa tapahtuvista muutoksista&nbsp;v??litt??m??sti. Lis??ksi&nbsp;TOIMITTAJA:lle  tulee antaa tieto ty??ntekij??lt??&nbsp;edellytett??v??st?? koulutuksesta,  ammattitaidosta ja&nbsp;kokemuksesta sek??&nbsp;ty??turvallisuuden kannalta  erityisesti huomioitavista seikoista, kuten  ty??ntekij??n&nbsp;terveydentilavaatimuksista. <br></p><p>\n  2.2.&nbsp;TOIMITTAJA:n on huolellisesti  valittava teht??v????n esitett??v??t henkil??t&nbsp;asiakkaan antamien tietojen  perusteella.&nbsp;TOIMITTAJA:n tulee sen&nbsp;k??ytett??viss??  olevat mahdollisuudet huomioon ottaen pyrki?? kohtuudella  selvitt??m????n,&nbsp;ett?? ty??ntekij?? vastaa koulutukseltaan, ammattitaidoltaan ja  kokemukseltaan asiakkaan&nbsp;TOIMITTAJA:lle ilmoittamia vaatimuksia tai  vaihtoehtoisesti selvitett??v??,&nbsp;milt?? osin ty??ntekij?? poikkeaa niist??. <br></p><p>\n  2.3.&nbsp;TOIMITTAJA&nbsp;vastaa  ty??ntekij??n ty??nantajana ty??ntekij??n&nbsp;henkil??st??kuluista, kuten palkasta,  sosiaalikuluista ja lakis????teisist?? vakuutuksista.&nbsp;TOIMITTAJA&nbsp;noudattaa  suhteessa ty??ntekij????n ty??lains????d??nn??n ja&nbsp;viranomaism????r??ysten lis??ksi  kulloinkin sovellettavaksi tulevaa ty??ehtosopimusta.&nbsp; <br></p><p>\n  2.4. Asiakkaan on ty??njohto- ja  valvontaoikeutensa perusteella valvottava ty??ntekij??n&nbsp;ty??suoritusta ja  vastattava ty??n suorittamiseksi v??ltt??m??tt??m??n perehdytyksen&nbsp;antamisesta.  Asiakas sitoutuu noudattamaan ty??ntekij??n osalta  ty??lains????d??nt????,&nbsp;viranomaism????r??yksi?? ja sovellettavaa  ty??ehtosopimusta.&nbsp; <br>\n  Asiakas sitoutuu kohtelemaan ty??ntekij????  oikeudenmukaisesti ja tasapuolisesti&nbsp;suhteessa asiakkaan omiin  ty??ntekij??ihin tasa-arvolain ja yhdenvertaisuuslain&nbsp;mukaisesti. <br></p><p>\n  <strong>3. Ty??turvallisuus ja  ty??suojelu</strong></p><p><strong></strong> <br>\n  3.1.&nbsp;TOIMITTAJA:ll?? on ty??nantajana  yleisvastuu ty??ntekij??n&nbsp;ty??suojelusta.&nbsp;TOIMITTAJA&nbsp;j??rjest????  ty??ntekij??n ty??terveyshuollon. <br></p><p>\n  3.2. Asiakkaan  tulee ennen ty??n aloittamista huolehtia siit??, ett??  ty??ntekij??&nbsp;perehdytet????n ty??h??n ja ett?? h??nelle annetaan riitt??v??t tiedot  ty??ss?? esiintyvist?? haitta- ja&nbsp;vaaratekij??ist?? sek?? niiden edellytt??mist??  ty??-suojelutoimenpiteist?? ja vastata siit??,&nbsp;ett?? n??it?? m????r??yksi?? my??s  noudatetaan.&nbsp; <br>\n  Asiakkaan tulee  hankkia ja antaa ty??ntekij??n k??ytt????n tarvittavat henkil??nsuojaimet  ja&nbsp;suojav??lineet ja vastata siit??, ett?? ty??ntekij?? my??s k??ytt????  niit??. Asiakas vastaa  siit??, ett?? ty?? asiakkaan tiloissa ja laitteilla voidaan  suorittaa&nbsp;turvallisesti ja ett?? ty??terveyshuoltolain mukaiset  ty??paikkatarkastukset on ty??ntekij??n&nbsp;ty??paikalla tehty. Asiakas toimittaa  pyydett??ess??&nbsp;TOIMITTAJA:lle kopion&nbsp;tehdyst?? ty??paikkaselvityksest??,  sek?? kopion aina ty??ntekij??n&nbsp;perehdytt??mislomakkeesta. <br></p><p>\n  3.3. Asiakas voi  sopia ty??ntekij??n kanssa ylit??iden tekemisest?? lakien,&nbsp;ty??ehtosopimuksen  ja&nbsp;TOIMITTAJA:n antamien ohjeiden asettamissa&nbsp;rajoissa. </p>\n<p><strong>4. Reklamaatiot  ja ty??nteon estyminen</strong></p><p><strong></strong> <br>\n  4.1. Mik??li  ty??ntekij??n ammattitaidossa tai ty??suorituksessa ilmenee puutteita  tai&nbsp;ty??ntekij?? ei saavu ty??h??n sovittuna ajankohtana, t??st?? on  v??litt??m??sti, ja joka&nbsp;tapauksessa viimeist????n 7 p??iv??n kuluessa,  ilmoitettava&nbsp;TOIMITTAJA:lle,&nbsp;jotta&nbsp;TOIMITTAJA&nbsp;voi ryhty??  korjaaviin toimenpiteisiin. <br></p><p>\n  4.2. Mik??li  ty??ntekij?? on sairauden, ty??suhteen p????ttymisen, lakon tai muun  p??tev??n&nbsp;syyn vuoksi estynyt suorittamasta sovittua ty??t??,&nbsp;TOIMITTAJA:ll??  on&nbsp;sovittaessa oikeus j??rjest???? toinen ty??ntekij?? mahdollisimman pian  estyneen tilalle.&nbsp;TOIMITTAJA&nbsp;ei  vastaa t??llaisen ty??ntekij??n p??tev??n esteen asiakkaalle&nbsp;mahdollisesti  aiheuttamista vahingoista. <br></p><p>\n  4.3. Mik??li ty??n  teett??minen estyy asiakkaasta suoraan tai v??lillisesti johtuvasta&nbsp;syyst??,  t??st?? esteest?? on v??litt??m??sti ilmoitettava&nbsp;TOIMITTAJA:lle.&nbsp;Asiakkaalla on oikeus esteen jatkuessa keskeytt????  ty??t kohtuullista ilmoitusaikaa&nbsp;noudattaen.&nbsp; <br></p><p>\n  Kohtuullisen  ilmoitusajan pituus sovitaan erikseen ottaen huomioon  ty??teht??v??n&nbsp;kokonaiskesto. Asiakkaalla on oikeus teett???? lyhyen esteen  ajan ty??ntekij??ll?? muuta&nbsp;korvaavaa ty??t??. </p>\n<p><strong>5. Veloitusperusteet</strong></p><p><strong></strong> <br>\n  5.1. Ty?? tehd????n laskutusty??n??, josta  tilaaja sitoutuu maksamaan tuntiveloituksena&nbsp;tarjouksen mukaisen  korvauksen. Jos hintaa ei ole sovittu erikseen, noudatetaan&nbsp;osapuolien  v??lill?? ollutta aikaisempaa hinnoittelua tai toimittajan yleist?? hinnoittelua. <br>\n  Suoritukset tilaajalta toimittajalle  tapahtuvat laskua vastaan, jonka maksuaika on 14&nbsp;pv netto tai sopimuksessa  erikseen kirjallisesti sovittu. Laskutus tapahtuu kahden&nbsp;viikon v??lein.  Lasku toimitetaan sopimuksen ehtojen mukaisesti. Laskuissa on&nbsp;mainittava  sopimusnumero tai muu viite. Laskutus perustuu  tunti-ilmoituskaavakkeisiin&nbsp;tai asiakkaan yhteyshenkil??n (ty??njohdon)  hyv??ksynt????n.&nbsp; <br>\n  Jos asiakas j??tt???? laskunsa maksamatta  er??p??iv????n menness?? on TOIMITTAJA:ll?? oikeus 7 p??iv???? er??p??iv??n j??lkeen poistaa  henkil??st?? asiakkaan ty??maalta. TOIMITTAJA:ll?? on kuitenkin oikeus laskuttaa  t??lt??kin ajalta sopimuksen mukaiset korvaukset jos henkil??st??n ty??sopimukset  aiheuttavat TOIMITTAJA:lle kustannuksia. TOIMITTAJA:n on viipym??tt??  palauttettava henkil??st?? asiakkaan k??ytt????n n??iden sopimusehtojen puitteissa  kun asiakas on maksuvelvoitteensa hoitanut. <br></p><p>\n  5.2. Tunti-ilmoituskaavakkeet  laaditaan ja hyv??ksyt????n TOIMITTAJA:n k??yt??ss?? olevalla s??hk??isell??  tuntikortilla tai erikseen kirjallisesti sovitulla tavalla. <br></p><p>\n  Ty??ntekij??n t??ytt??m?? s??hk??inen  tuntikortti tulee asiakkaan yhteyshenkil??n toimesta tarkastaa ja hyv??ksy??  viimeist????n: </p>\n<ul type=\"disc\">\n  <li>kahden       viikon v??lein maksettavien palkkojen osalta palkanmaksuviikon tiistaihin       klo 23:59 menness?? HRM-j??rjestelm??ss?? </li>\n  <li>kuukausipalkkojen       osalta seuraavan kuukauden 3. p??iv??n?? klo 23:59 menness??       HRM-j??rjestelm??ss?? </li>\n</ul>\n<p>Mik??li asiakas  ei k??y automaattisista s??hk??posti-ilmoituksista huolimatta hyv??ksym??ss?? t??lle  HRM-j??rjestelm??ss?? hyv??ksytt??v??ksi l??hetettyj?? s??hk??isi?? tuntikortteja em.  m????r??aikoihin menness??, j??rjestelm??n kautta laaditut s??hk??iset tuntikortit  katsotaan hyv??ksytyiksi ja todetaan laskutuskelpoisiksi, jotta suoritettujen  t??iden laskutus ja palkanmaksu ei viiv??sty. HRM-j??rjestelm??ss?? asiakkaan toimesta  tai m????r??ajan ylitytty?? hyv??ksym??t??n tuntikortti on sellaisenaan  laskutuskelpoinen.<strong></strong><br>\n  Asiakas voi  tarkastuksessaan havaitsemien virheiden vuoksi my??s palauttaa kortin  ty??ntekij??lle korjattavaksi. Palautuksen yhteydess?? on kirjattava ty??ntekij??lle  tiedoksi asiat, jotka ovat kortille virheellisesti kirjattu. T??m??n lis??ksi  asiakkaan tulee ilmoittaa tuntikortissa olevista virheist?? TOIMITTAJA:n  yhteyshenkil??lleen. Mahdolliset j??lkik??teen teht??v??t korjaukset ja hyvitykset  hyvitet????n seuraavan palkanlaskennan yhteydess??. <br></p><p>\n  5.2. Ty??t??  tehd????n aina sovellettavan ty??ehtosopimuksen m????ritt??mi??  kokonaisia&nbsp;ty??p??ivi??, ellei muuta ole etuk??teen sovittu. Mik??li sopimus  perustuu ty??ntekij??n&nbsp;kulloinkin tekemiin ty??tunteihin,&nbsp;TOIMITTAJA&nbsp;veloittaa  asiakasta&nbsp;ty??ntekij??n antamien ja asiakkaan hyv??ksymien  ty??suoriteilmoitusten perusteella. <br></p><p>\n  5.3. Hintaan  lis??t????n siihen lakiin perustuvat v??lilliset verot, kuten  arvonlis??vero,&nbsp;kulloinkin voimassa olevien s????nn??sten mukaisesti. <br></p><p>\n  5.4. Yleisten  ty??nantajamaksujen tai muiden niihin rinnastettavien maksujen m????r??n&nbsp;tai  soveltamisen muuttuessa&nbsp;TOIMITTAJA&nbsp;pid??tt???? oikeuden  tarkistaa&nbsp;hintaa muutoksen voimaantuloajankohdasta lukien muutosta  vastaavasti. Jos&nbsp;sopimuskauden aikana tapahtuu yleisi?? alaan kohdistuvia  palkankorotuksia,&nbsp;TOIMITTAJA:ll?? on oikeus korottaa sopimushintoja  vastaavalla prosenttim????r??ll??&nbsp;korotuksen voimaantulohetkest?? lukien. </p>\n<p><strong>6.  Rekrytointipalkkio</strong></p><p><strong></strong> <br>\n  6.1.&nbsp;TOIMITTAJA:ll??  on oikeus peri?? asiakkaalta rekrytointipalkkio,&nbsp;mik??li henkil?? joka  ty??skentelee siirtyy tai tekee sopimuksen siirtymisest?? asiakkaan tai sen  kanssa&nbsp;samaan konserniin kuuluvan tai muun l??heisen yhti??n palvelukseen  sopimuksen&nbsp;voimassaoloaikana tai kuuden (6) kuukauden kuluessa sopimuksen  p????ttymisest??&nbsp;lukien. Rekrytointipalkkio tulee maksaa my??s siin??  tapauksessa, ett?? asiakas vuokraa&nbsp;TOIMITTAJA:n rekrytoiman ja v??litt??m??n  ty??ntekij??n jonkin toisen&nbsp;yrityksen kautta vastaavana aikana. <br></p><p>\n  6.2.  Rekrytointipalkkio on ty??ntekij??n kahden (2) kuukauden bruttopalkkaa  vastaava&nbsp;summa (ALV 0%). </p>\n<p><strong>7. Salassapito  ja tietoturvallisuus</strong></p><p><strong></strong> <br>\n  7.1.  Sopijapuolet sitoutuvat pit??m????n salassa sopimuksen sis??ll??n  sek??&nbsp;sopimussuhteen aikana saamansa luottamukselliset tiedot ja olemaan  k??ytt??m??tt??&nbsp;t??llaista tietoa mihink????n muuhun tarkoitukseen kuin t??m??n  sopimuksen mukaisten&nbsp;velvollisuuksiensa t??ytt??miseen.</p><p>\n  7.2. Mik??li  ty??teht??v??t edellytt??v??t ty??ntekij??lt?? erityisen  salassapitovelvollisuuden&nbsp;t??ytt??mist?? tai tietoturvallisuusohjeiden  noudattamista, asiakas ja ty??ntekij?? sopivat&nbsp;t??st?? kesken????n, eik??&nbsp;TOIMITTAJA&nbsp;tule  kyseisen sopimuksen osapuoleksi.</p><p>\n  <strong>8.  Vahingonkorvausvastuu</strong></p><p><strong></strong> <br>\n  8.1.&nbsp;TOIMITTAJA&nbsp;vastaa  ty??ntekij??n mahdollisesti asiakkaalle&nbsp;aiheuttamasta vahingosta voimassa  olevan oikeuden mukaisesti.&nbsp;TOIMITTAJA&nbsp;ei siten vastaa  ty??ntekij??n ty??ss????n asiakkaalle aiheuttamasta vahingosta, ellei&nbsp;vahinko  johdu sellaisesta ty??ntekij??n ammattitaidottomuudesta, josta&nbsp;TOIMITTAJA&nbsp;t??m??n  sopimuksen kohdan 2.2. mukaan vastaa. <br></p><p>\n  8.2. Asiakas vastaa ty??ntekij??n kolmannelle  osapuolelle aiheuttamasta vahingosta,&nbsp;mik??li vahinko tapahtuu asiakkaan  lukuun ty??t?? teht??ess??. <br></p><p>\n  8.3. Sopijapuolet eiv??t vastaa oman  suorituksensa virheellisyyden aiheuttamista&nbsp;v??lillisist?? vahingoista,  eik??&nbsp;TOIMITTAJA&nbsp;ty??ntekij??n aiheuttamista&nbsp;v??lillisist??  vahingoista. <br></p><p>\n  8.4. Vahingonkorvausta on vaadittava&nbsp;TOIMITTAJA:lt??  nelj??n viikon&nbsp;kuluessa siit??, kun vahingonkorvauksen perusteena oleva  tapahtuma tai virhe&nbsp;havaittiin tai se olisi pit??nyt havaita, muussa  tapauksessa oikeus mahdolliseen&nbsp;korvaukseen on menetetty. <br></p><p>\n  8.5. Jos asiakas luovuttaa omaa  omaisuuttaan ty??ntekij??n haltuun, tulee h??nen kuittauttaa luovutettu omaisuus  joko omalla tai TOIMITTAJA:n kuittauslomakkeella. Omaa lomaketta k??ytt??ess??  tulee kuittauslomakkeessa tulla esiin selke??sti ty??ntekij??n korvausvastuu  haltuun otetuista tuotteista. Yli 1000 euron arvoisen omaisuuden luovutuksen  kohdalla tulee asiasta sopia erikseen TOIMITTAJA:n yhteyshenkil??n kanssa  kirjallisesti. Jos asiakas laiminly?? kuittauksen tai yli 1000 euron arvoisen  omaisuuden kohdalla erikseen sopimisen vastaa asiakas mahdollisista  vahingoista. <br></p><p>\n  <strong>9. Ylivoimainen este  (Force Majeure)</strong></p><p><br>\n  9.1. Kumpikaan sopijapuoli ei vastaa  viiv??styksist?? ja vahingoista, jotka johtuvat&nbsp;h??nen  vaikutusmahdollisuuksiensa ulkopuolella olevasta esteest??, jota sopijapuolen  ei&nbsp;kohtuudella voida edellytt???? ottaneen huomioon sopimuksentekohetkell??  ja jonka&nbsp;seurauksia sopijapuoli ei my??sk????n kohtuudella olisi voinut  v??ltt???? tai voittaa. <br></p><p>\n  9.2. Sopijapuolen on viipym??tt??  ilmoitettava ylivoimaisesta esteest?? kirjallisesti&nbsp;toiselle  sopijapuolelle, samoin kuin esteen lakkaamisesta. </p>\n<p><strong>10. Sopimuksen  voimassaolo, p????tt??minen ja siirt??minen</strong></p><p><strong></strong> <br>\n  10.1. Sopimus tulee voimaan kun asiakas  hyv??ksyy tarjouksen. TOIMITTAJA l??hett???? n??m?? sopimusehdot tarjouksen ja  tilausvahvistuksen liittten??. Sopimuksen&nbsp;voimassaoloaikaan ja sen  mukaisiin velvoitteisiin ei vaikuta se, milloin ty??nteko&nbsp;sopimuksen  perusteella tosiasiallisesti aloitetaan, lopetetaan tai  mahdollisesti&nbsp;keskeytet????n. <br></p><p>\n  10.2. Sopimus on voimassa m????r??ajan, ellei  toisin ole sovittu. Mik??li m????r??aikaisen&nbsp;sopimuksen  voimassaoloaikaa halutaan muuttaa, siit?? tulee sopia sopijapuolten kesken&nbsp;kirjallisesti. <br>\n  10.3. Toistaiseksi voimassaolevissa  sopimuksissa irtisanomisaika on ty??ntekij??n ty??ehtosopimuksen irtisanomisaikaan  lis??ttyn?? nelj??toista p??iv????. <br></p><p>\n  10.4. Mik??li asiakas laiminly??  maksuvelvollisuutensa tai toinen sopijapuoli muutoin&nbsp;olennaisesti rikkoo  sopimuksen yleisi?? tai erityisi?? ehtoja vastaan, toisella&nbsp;sopijapuolella  on oikeus purkaa sopimus p????ttym????n v??litt??m??sti.&nbsp;Sopimusrikkomuksesta on  huomautettava toista sopijapuolta kirjallisesti ennen  sopimuksen&nbsp;purkamista. <br></p><p>\n  10.5. Jos toista sopijapuolta haetaan  konkurssiin tai yrityssaneeraukseen tai asetetaan&nbsp;selvitystilaan, toisella  sopijapuolella on oikeus purkaa sopimus. <br></p><p>\n  10.6. Sopijapuolella ei ole oikeutta siirt???? t??t??  sopimusta osaksikaan ilman toisen&nbsp;sopijapuolen kirjallista suostumusta. <br></p><p>\n  <strong>1. Oikeuspaikka</strong></p><p><strong></strong> <br>\n  11.1. Sopijapuolet pyrkiv??t ratkaisemaan  t??st?? sopimuksesta aiheutuvat erimielisyydet&nbsp;neuvotteluteitse.&nbsp;Mik??li sopijapuolet eiv??t p????se neuvotteluissa  yksimielisyyteen, riidat ratkaistaan&nbsp;ensimm??isen?? oikeusasteena Turun  k??r??j??oikeudessa. </p>\n<p><strong>12. Ilmoitukset ja Reklamaatiot</strong></p><p><strong></strong> <br>\n  12.1. Sopijapuolten tulee l??hett????  sopimukseen liittyv??t ilmoitukset ja reklamoinnit s??hk??postitse osoitteeseen  reklamaatiot@ratayhtio.fi. </p>\n<p><strong>13. Yhteyshenkil??t</strong></p><p><strong></strong> <br>\n  Kumpikin osapuoli nime???? v??hint????n yhden  yhteyshenkil??n johtamaan ja valvomaan&nbsp;sopimuksen t??ytt??mist??. TOIMITTAJA:n  yhteyshenkil?? nimet????n TOIMITTAJA:n toimittamissa tarjouksissa ja  tilausvahvistuksissa.</p>\n<p>&nbsp;</p>');

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
(1, 'HRM-ilmoitus: Kooste ty??sopimusten, p??tevyyksien ja koeaikojen p????ttymisest??', 'Kooste ty??sopimusten, p??tevyyksien ja koeaikojen p????ttymisest??.<br><br><b>N??m?? ty??sopimukset p????tyv??t 30-p??iv??n sis??ll??<br></b>\n{agreements}<br><br>Jos ty??suhde ei jatku pyyd?? henkil???? palauttamaan kuittaamansa varusteet ja ilmoita ty??suhteen p????ttymisest?? s??hk??postilla <a href=\"mailto:info@jarkeva.fi\">info@jarkeva.fi</a>.<br><br><b>N??m?? p??tevyydet er????ntyv??t 30-p??iv??n sis??ll??<br></b>{qualifications}<br><br>Selvit?? ty??ntekij??iden uudelleenkoulutustarve ja p??ivit?? tarvittaessa p??tevyys v??hint????n 7 p??iv???? ennen er????ntymist??.<br><br><b>N??m?? koeajat er????ntyv??t 30-p??iv??n sis??ll??<br></b>{trials}<b><br></b><br>Tarkasta asiakkaalta ja ty??ntekij??n ty??maalla olevilta esimiehilt?? ja \nkolleegoilta t??iden sujuminen sek?? anna koeaikapalaute ty??ntekij??lle.\n\n', 'Kooste ty??sopimusten, p??tevyyksien ja koeaikojen p????ttymisest??.\n\nN??m?? ty??sopimukset p????tyv??t 30-p??iv??n sis??ll??\n{agreements}\n\nJos ty??suhde ei jatku pyyd?? henkil???? palauttamaan kuittaamansa varusteet ja ilmoita ty??suhteen p????ttymisest?? s??hk??postilla info@jarkeva.fi.\n\nN??m?? p??tevyydet er????ntyv??t 30-p??iv??n sis??ll??\n{qualifications}\n\nSelvit?? ty??ntekij??iden uudelleenkoulutustarve ja p??ivit?? tarvittaessa p??tevyys v??hint????n 7 p??iv???? ennen er????ntymist??.\n\nN??m?? koeajat er????ntyv??t 30-p??iv??n sis??ll??\n{trials}\n\nTarkasta asiakkaalta ja ty??ntekij??n ty??maalla olevilta esimiehilt?? ja kolleegoilta t??iden sujuminen sek?? anna koeaikapalaute ty??ntekij??lle. '),
(2, 'HRM-ilmoitus: Sinulla on k??sittelem??tt??mi?? tuntikortteja', 'Hei, {fullname},<br><br>Sinulla on k??sittelem??tt??mi?? tuntikortteja. Kirjaudu portaaliin, {erp_link}.', 'Hei {fullname},\n\nSinulla on k??sittelem??tt??mi?? tuntikortteja. Kirjaudu portaaliin, {erp_link}. '),
(3, ' Sinulla on k??sittelem??tt??mi?? laskuja', 'Hei, ({username}), {fullname},<br><br>Sinulla on k??sittelem??tt??mi?? laskuja. Kirjaudu portaaliin, {erp_link}.\n\n', 'Hei, ({username}), {fullname},\n\nSinulla on k??sittelem??tt??mi?? laskuja. Kirjaudu portaaliin, {erp_link}. '),
(4, 'Sinulla on k??sittelem??tt??mi?? laskuja joiden er??p??iv?? on kolmen p??iv??n kuluttua tai l??hemp??n??', 'Hei, ({username}), {fullname},<br><br>Sinulla on k??sittelem??tt??mi?? laskuja joiden er??p??iv?? on kolmen p??iv??n kuluttua tai l??hemp??n??. Kirjaudu portaaliin, {erp_link}.\n\n', 'Hei, ({username}), {fullname},\n\nSinulla on k??sittelem??tt??mi?? laskuja joiden er??p??iv?? on kolmen p??iv??n kuluttua tai l??hemp??n??. Kirjaudu portaaliin, {erp_link}.'),
(5, 'HRM-ilmoitus: Sinulle on tullut tuntikortti tarkastattevaksi', 'Teille on tullut henkil??lt?? {fullname} aikajaksolta \n\"{startdate}-{enddate}\" ty??kohteesta {workplace}\nasiatarkastettavaksi.<br><br>Tarkastattehan tuntikortin viimeist????n \nsopimusehtojemme mukaisten m????r??aikoja. Jos tuntikorttia ei ole \ntarkastettu sopimusehdoissamme m????r??aikojen mukaisesti, katsotaan se \nhyv??ksytyksi palkanmaksun ja laskutuksemme mahdollistamiseksi.<br><br>Tuntikortin p????sette tarkastamaan painamalla&nbsp;{erp_link}. <br><br>Terveisin,<br>{company_name}<br>\n{switch_phonenumber}<br>\n{company_email}', 'Teille on tullut henkil??lt?? {fullname} aikajaksolta ???{startdate}-{enddate}??? ty??kohteesta {workplace} asiatarkastettavaksi.\n\nTarkastattehan tuntikortin viimeist????n sopimusehtojemme mukaisten m????r??aikoja. Jos tuntikorttia ei ole tarkastettu sopimusehdoissamme m????r??aikojen mukaisesti, katsotaan se hyv??ksytyksi palkanmaksun ja laskutuksemme mahdollistamiseksi.\n\nTuntikortin p????sette tarkastamaan painamalla - {erp_link}.\n\nTerveisin,\n{company_name}\n{switch_phonenumber}\n{company_email}'),
(6, 'HRM-ilmoitus: Asiakas hyv??ksyi tuntikortin', 'Hei, {fullname},<br><br>Asiakas {customer_person_company} ({customer_person_name}, {customer_person_email}) hyv??ksyi henkil??n {fullname_employee} tuntikortin aikav??lilt?? \"{startdate}-{enddate}\" ty??kohteesta tai ty??kohteista {workplace}.<br><br>Kirjaudu portaaliin, {erp_link}.<br><br>Terveisin,<br>{company_name}<br>\n{switch_phonenumber}<br>\n{company_email}<br>\n\n', 'Hei {fullname},\n\nKirjaudu portaaliin, {erp_link}.\n\nTerveisin,\n{company_name}\n{switch_phonenumber}\n{company_email}'),
(7, 'HRM-ilmoitus: Asiakas palautti tuntikortin virheellisen??', 'Hei {fullname},<br><br>Asiakas {customer_person_company} ({customer_person_name}, {customer_person_email}) palautti tuntikortin virheellisen??aikav??lilt?? aikav??lilt?? \"{startdate}-{enddate}\" ty??kohteesta tai ty??kohteista {workplace}. Korjaathan tuntikortin sis??ll??n ja toimitat uuden kortin tarkastettavaksi. Ep??selvyyksiss?? voit ottaa yhteytt?? l??hiesimieheesi. Kirjaudu portaaliin, {erp_link}.\n\n<br><br><br>', 'Hei {fullname},\n\nAsiakas palautti tuntikortin virheellisen??. Kirjaudu portaaliin, {erp_link}. '),
(8, 'HRM: P????k??ytt??j?? hyv??ksyi tuntikortin', 'Hei {fullname},<br><br>P????k??ytt??j?? hyv??ksyi tuntikortin. Kirjaudu portaaliin, {erp_link}.\n\n', 'Hei {fullname},\n\nP????k??ytt??j?? hyv??ksyi tuntikortin. Kirjaudu portaaliin, {erp_link}. '),
(9, 'HRM: P????k??ytt??j?? hylk??si tuntikortin', 'Hei {fullname},<br><br>P????k??ytt??j?? hylk??si tuntikortin. Kirjaudu portaaliin, {erp_link}.\n\n', 'Hei {fullname},\n\nP????k??ytt??j?? hylk??si tuntikortin. Kirjaudu portaaliin, {erp_link}.');

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
(2, 'Tekem????n lis??-, lauantai- sunnuntai-, ilta- y??ty??t??'),
(3, 'Tekem????n ylit??it??'),
(4, 'Tekem????n komennust??it??');

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
  `trial` varchar(500) NOT NULL DEFAULT 'Koeaika on puolet ty??suhteen kestosta, maksimissaan 4 kuukautta.',
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
(7, 'J??rkev?? - Ratkaisut', '-', '-', '', 0, '-', 'info@jarkeva.fi'),
(5, 'Alihankinta', '-', 'Ilmarinkatu 36 D 48', '33500', 0, '+358 40 8200 691', 'info@i4ware.fi'),
(6, 'Ratayhti?? Oy', '-', '-', '', 0, '', '');

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
(1, 'Ajoj??rjestelij??n ', 'erikoisammattitutkinto'),
(2, 'Ajoneuvonosturinkuljettajan', 'ammattitutkinto'),
(3, 'Ammatilliseen peruskoulutukseen ohjaava ja valmistava koulutus', 'opetussuunnitelma'),
(4, 'Ammattisukeltajan', 'ammattitutkinto'),
(5, 'Arboristin ', 'ammattitutkinto'),
(6, 'Asesepp??kis??llin', 'ammattitutkinto'),
(7, 'Asesepp??mestarin', 'erikoisammattitutkinto'),
(8, 'Asiakirjahallinnon ja arkistotoimen', 'ammattitutkinto'),
(9, 'Asioimistulkin', 'ammattitutkinto'),
(10, 'Audiovisuaalisen viestinn??n', 'ammattitutkinto'),
(11, 'Audiovisuaalisen viestinn??n', 'erikoisammattitutkinto'),
(12, 'Audiovisuaalisen viestinn??n', 'perustutkinto'),
(13, 'Autoalan', 'perustutkinto'),
(14, 'Autoalan myyj??n', 'erikoisammattitutkinto'),
(15, 'Autoalan ty??njohdon ', 'erikoisammattitutkinto'),
(16, 'Autokorimekaanikon', 'ammattitutkinto'),
(17, 'Autokorimestarin', 'erikoisammattitutkinto'),
(18, 'Automaalarimestarin', 'erikoisammattitutkinto'),
(19, 'Automaalarin', 'ammattitutkinto'),
(20, 'Automaatioasentajan', 'ammattitutkinto'),
(21, 'Automaatioyliasentajan ', 'erikoisammattitutkinto'),
(22, 'Automekaanikon', 'erikoisammattitutkinto'),
(23, 'Automyyj??n', 'ammattitutkinto'),
(24, 'Autos??hk??mekaanikon', 'ammattitutkinto'),
(25, 'Baarimestarin', 'erikoisammattitutkinto'),
(26, 'Bioenergia-alan ', 'ammattitutkinto'),
(27, 'Boazodoalu', 'fidnodutkkus'),
(28, 'Catering-alan', 'perustutkinto'),
(29, 'Dieettikokin', 'erikoisammattitutkinto'),
(30, 'Digitaalipainajan', 'ammattitutkinto'),
(31, 'Duodj??ra ', 'fidnodutkkus'),
(32, 'Duodjemeastara', 'earenoam??sfidnodutkkus'),
(33, 'Elektroniikka- ja s??hk??teollisuuden (nyk. S??hk??teollisuuden)', 'ammattitutkinto'),
(34, 'Elektroniikka-asentajan ', 'ammattitutkinto'),
(35, 'Elektroniikkayliasentajan', 'erikoisammattitutkinto'),
(36, 'Elintarvikealan', 'perustutkinto'),
(37, 'Elintarvikejalostajan', 'ammattitutkinto'),
(38, 'Elintarviketekniikan', 'erikoisammattitutkinto'),
(39, 'Elintarviketeollisuuden', 'ammattitutkinto'),
(40, 'El??intenhoitajan', 'ammattitutkinto'),
(41, 'Er??- ja luonto-oppaan', 'ammattitutkinto'),
(42, 'Faktorin', 'erikoisammattitutkinto'),
(43, 'Floristimestarin', 'erikoisammattitutkinto'),
(44, 'Floristin', 'ammattitutkinto'),
(45, 'Golfkentt??mestarin', 'erikoisammattitutkinto'),
(46, 'Golfkent??nhoitajan', 'ammattitutkinto'),
(47, 'Hammastekniikan ', 'perustutkinto'),
(48, 'Henkil??automekaanikon', 'ammattitutkinto'),
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
(59, 'Hopeasepp??mestarin', 'erikoisammattitutkinto'),
(60, 'Hopeasep??n', 'ammattitutkinto'),
(61, 'Hotelli- ja ravintola-alan', 'perustutkinto'),
(62, 'Hotelli-, ravintola- ja catering-alan', 'perustutkinto'),
(63, 'Hotelli-, ravintola- ja suurtalous(nyk. Majoitus- ja ravitsemisalan)esimiehen ', 'erikoisammattitutkinto'),
(64, 'Hotellivirkailijan', 'ammattitutkinto'),
(65, 'Ilmastointiasentajan ', 'ammattitutkinto'),
(66, 'Ilmastointiasentajan ', 'erikoisammattitutkinto'),
(67, 'Ilmastointij??rjestelm??n puhdistajan', 'ammattitutkinto'),
(68, 'Informaatio- ja kirjastopalvelujen', 'ammattitutkinto'),
(69, 'Is??nn??innin', 'ammattitutkinto'),
(70, 'Jalkinealan', 'ammattitutkinto'),
(71, 'Jalkinealan', 'erikoisammattitutkinto'),
(72, 'Jalkinealan', 'perustutkinto'),
(73, 'Jalkojenhoidon', 'ammattitutkinto'),
(74, 'Johtamisen', 'erikoisammattitutkinto'),
(75, 'J??lkik??sittelykoneenhoitajan', 'ammattitutkinto'),
(76, 'Kaivertajamestarin', 'erikoisammattitutkinto'),
(77, 'Kaivertajan ', 'ammattitutkinto'),
(78, 'Kaivosalan', 'perustutkinto'),
(79, 'Kaivosalan ', 'ammattitutkinto'),
(80, 'Kalanjalostajan ', 'ammattitutkinto'),
(81, 'Kalanviljelij??n', 'ammattitutkinto'),
(82, 'Kalastusoppaan', 'ammattitutkinto'),
(83, 'Kalatalouden ', 'perustutkinto'),
(84, 'Karjatalouden (nyk. Tuotantoel??inten hoidon ja hyvinvoinnin)', 'ammattitutkinto'),
(85, 'Kaukol??mp??asentajan ', 'ammattitutkinto'),
(86, 'Kaukol??mp??yliasentajan', 'erikoisammattitutkinto'),
(87, 'Kauneudenhoitoalan', 'erikoisammattitutkinto'),
(88, 'Kauneudenhoitoalan', 'perustutkinto'),
(89, 'Kaupan esimiehen ', 'erikoisammattitutkinto'),
(90, 'Kehitysvamma-alan ', 'ammattitutkinto'),
(91, 'Kehitysvamma-alan ', 'erikoisammattitutkinto'),
(92, 'Kello- ja mikromekaniikan', 'perustutkinto'),
(93, 'Kemiantekniikan', 'perustutkinto'),
(94, 'Kemianteollisuuden', 'ammattitutkinto'),
(95, 'Kemianteollisuuden', 'erikoisammattitutkinto'),
(96, 'Kengityssep??n', 'ammattitutkinto'),
(97, 'Keramiikkakis??llin', 'ammattitutkinto'),
(98, 'Keramiikkamestarin', 'erikoisammattitutkinto'),
(99, 'Keruutuotetarkastajan (nyk. Luonnontuotealan)', 'ammattitutkinto'),
(100, 'Keruutuotetarkastajan (nyk. Luonnontuotealan)', 'erikoisammattitutkinto'),
(101, 'Kiinteist??nhoitajan', 'ammattitutkinto'),
(102, 'Kiinteist??nhoitajan', 'erikoisammattitutkinto'),
(103, 'Kiinteist??nv??litysalan', 'ammattitutkinto'),
(104, 'Kiinteist??palvelujen', 'perustutkinto'),
(105, 'Kipsausalan ', 'ammattitutkinto'),
(106, 'Kipsimestarin', 'erikoisammattitutkinto'),
(107, 'Kirjansitojamestarin', 'erikoisammattitutkinto'),
(108, 'Kirjansitojan ', 'ammattitutkinto'),
(109, 'Kiskoliikenteen turvalaiteasentajan', 'ammattitutkinto'),
(110, 'Kivimiehen', 'ammattitutkinto'),
(111, 'Kivisepp??kis??llin', 'ammattitutkinto'),
(112, 'Kivisepp??mestarin', 'erikoisammattitutkinto'),
(113, 'Koe-el??intenhoitajan', 'erikoisammattitutkinto'),
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
(127, 'Kotity??- ja puhdistuspalvelujen', 'perustutkinto'),
(128, 'Kotity??palvelujen', 'ammattitutkinto'),
(129, 'Koululaisten aamu- ja iltap??iv??toiminnan ohjaajan ', 'ammattitutkinto'),
(130, 'Koulunk??ynnin ja aamu- ja iltap??iv??toiminnan ohjauksen', 'ammattitutkinto'),
(131, 'Koulunk??ynnin ja aamu- ja iltap??iv??toiminnan ohjauksen', 'erikoisammattitutkinto'),
(132, 'Koulunk??yntiavustajan', 'ammattitutkinto'),
(133, 'Koulunk??yntiavustajan', 'erikoisammattitutkinto'),
(134, 'Kultaajakis??llin ', 'ammattitutkinto'),
(135, 'Kultaajamestarin ', 'erikoisammattitutkinto'),
(136, 'Kultasepp??mestarin', 'erikoisammattitutkinto'),
(137, 'Kultasep??n', 'ammattitutkinto'),
(138, 'Kumialan', 'ammattitutkinto'),
(139, 'Kunnossapidon', 'ammattitutkinto'),
(140, 'Kunnossapidon', 'erikoisammattitutkinto'),
(141, 'Kuvallisen ilmaisun', 'perustutkinto'),
(142, 'Kylm??asentajan', 'ammattitutkinto'),
(143, 'Kylm??mestarin', 'erikoisammattitutkinto'),
(144, 'K??si- ja taideteollisuusalan', 'perustutkinto'),
(145, 'K??sity??mestarin', 'erikoisammattitutkinto'),
(146, 'K??sity??nteknij??n', 'ammattitutkinto'),
(147, 'Laboratorioalan', 'perustutkinto'),
(148, 'Laitoshuoltajan', 'ammattitutkinto'),
(149, 'Laivanrakennusalan', 'erikoisammattitutkinto'),
(150, 'Laivanrakentajan', 'ammattitutkinto'),
(151, 'Laivas??hk??mestarin', 'erikoisammattitutkinto'),
(152, 'Lapsi- ja perhety??n', 'perustutkinto'),
(153, 'Lasikeraamisen alan', 'ammattitutkinto'),
(154, 'Lasinpuhaltajakis??llin', 'ammattitutkinto'),
(155, 'Lasinpuhaltajamestarin', 'erikoisammattitutkinto'),
(156, 'Lasten ja nuorten erityisohjaajan', 'ammattitutkinto'),
(157, 'Lastink??sittelyalan', 'ammattitutkinto'),
(158, 'Lastink??sittelyalan', 'erikoisammattitutkinto'),
(159, 'Lattiamestarin', 'erikoisammattitutkinto'),
(160, 'Lattianp????llyst??j??n', 'ammattitutkinto'),
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
(174, 'Levyty??mestarin', 'erikoisammattitutkinto'),
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
(187, 'Lukkosepp??mestarin', 'erikoisammattitutkinto'),
(188, 'Lukkosep??n ', 'ammattitutkinto'),
(189, 'Luonnonmukaisen tuotannon', 'ammattitutkinto'),
(190, 'Luonnontieteellisen alan konservoinnin', 'ammattitutkinto'),
(191, 'Luonnontuotealan (e. Keruutuotetarkastajan)', 'ammattitutkinto'),
(192, 'Luonnontuotealan (e. Keruutuotetarkastajan)', 'erikoisammattitutkinto'),
(193, 'Luonto- ja ymp??rist??alan', 'perustutkinto'),
(194, 'Luontokartoittajan', 'erikoisammattitutkinto'),
(195, 'L??mmityslaiteasentajan ', 'ammattitutkinto'),
(196, 'L????kealan', 'perustutkinto'),
(197, 'Maahanmuuttajien ammatilliseen peruskoulutukseen valmistava koulutus', 'opetussuunnitelma'),
(198, 'Maalarimestarin', 'erikoisammattitutkinto'),
(199, 'Maalarin', 'ammattitutkinto'),
(200, 'Maanmittausalan', 'ammattitutkinto'),
(201, 'Maanmittausalan', 'perustutkinto'),
(202, 'Maarakennusalan', 'ammattitutkinto'),
(203, 'Maarakennusalan', 'erikoisammattitutkinto'),
(204, 'Maaseudun kehitt??j??n', 'erikoisammattitutkinto'),
(205, 'Maaseudun vesitalouden', 'erikoisammattitutkinto'),
(206, 'Maaseutumatkailun', 'ammattitutkinto'),
(207, 'Maatalousalan', 'perustutkinto'),
(208, 'Maatalouskoneasentajan ', 'ammattitutkinto'),
(209, 'Maidonjalostajan', 'ammattitutkinto'),
(210, 'Majoitus- ja ravitsemisalan (e. Hotelli-, ravintola- ja suurtalous)esimiehen', 'erikoisammattitutkinto'),
(211, 'Mallinrakentajakis??llin', 'ammattitutkinto'),
(212, 'Mallinrakentajamestarin', 'erikoisammattitutkinto'),
(213, 'Markkinointiviestinn??n ', 'ammattitutkinto'),
(214, 'Markkinointiviestinn??n ', 'erikoisammattitutkinto'),
(215, 'Matkailualan', 'perustutkinto'),
(216, 'Matkailun ohjelmapalvelujen', 'ammattitutkinto'),
(217, 'Matkaoppaan', 'ammattitutkinto'),
(218, 'Matkatoimistovirkailijan', 'ammattitutkinto'),
(219, 'Mehil??istarhaajan', 'ammattitutkinto'),
(220, 'Meijeriteollisuuden', 'ammattitutkinto'),
(221, 'Merenkulkualan', 'perustutkinto'),
(222, 'Metallien jalostuksen', 'ammattitutkinto'),
(223, 'Mets??alan', 'perustutkinto'),
(224, 'Mets??koneasentajan', 'ammattitutkinto'),
(225, 'Mets??koneenkuljettajan', 'ammattitutkinto'),
(226, 'Mets??koneenkuljettajan (nyk. Puunkorjuun)', 'erikoisammattitutkinto'),
(227, 'Mets??mestarin', 'erikoisammattitutkinto'),
(228, 'Mets??talouden ', 'perustutkinto'),
(229, 'Mets??talousyritt??j??n', 'ammattitutkinto'),
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
(241, 'N??k??vammaistaitojen ohjaajan', 'erikoisammattitutkinto'),
(242, 'Obduktiopreparaattorin', 'ammattitutkinto'),
(243, 'Oikeustulkin', 'erikoisammattitutkinto'),
(244, 'Optiikkahiojan', 'ammattitutkinto'),
(245, 'Painajamestarin/rotaatiomestarin', 'erikoisammattitutkinto'),
(246, 'Painajan ', 'ammattitutkinto'),
(247, 'Painopinnanvalmistajan', 'ammattitutkinto'),
(248, 'Painoviestinn??n', 'perustutkinto'),
(249, 'Paperiteollisuuden', 'ammattitutkinto'),
(250, 'Paperiteollisuuden', 'erikoisammattitutkinto'),
(251, 'Paperiteollisuuden', 'perustutkinto'),
(252, 'Perhep??iv??hoitajan', 'ammattitutkinto'),
(253, 'Pesulateknikon', 'erikoisammattitutkinto'),
(254, 'Pienkonemekaanikon', 'ammattitutkinto'),
(255, 'Pintak??sittelyalan', 'perustutkinto'),
(256, 'Pintak??sittelymestarin', 'erikoisammattitutkinto'),
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
(268, 'Puusep??nalan', 'ammattitutkinto'),
(269, 'Puusep??nalan', 'erikoisammattitutkinto'),
(270, 'Puutarhatalouden', 'perustutkinto'),
(271, 'Puutavaran autokuljetuksen', 'ammattitutkinto'),
(272, 'P??ihdety??n', 'ammattitutkinto'),
(273, 'P??iv??hoitajan', 'ammattitutkinto'),
(274, 'Rahoitus- ja vakuutusalan', 'ammattitutkinto'),
(275, 'Rakennusalan', 'perustutkinto'),
(276, 'Rakennusalan ty??maap????llik??n', 'erikoisammattitutkinto'),
(277, 'Rakennuspeltisepp??mestarin ', 'erikoisammattitutkinto'),
(278, 'Rakennuspeltisep??n ', 'ammattitutkinto'),
(279, 'Rakennustuotannon', 'ammattitutkinto'),
(280, 'Rakennustuotealan', 'ammattitutkinto'),
(281, 'Raskaskalustomekaanikon ', 'ammattitutkinto'),
(282, 'Ratsastuksenopettajan', 'ammattitutkinto'),
(283, 'Ratsastuksenopettajan', 'erikoisammattitutkinto'),
(284, 'Rautatiekaluston kunnossapidon', 'ammattitutkinto'),
(285, 'Ravintolakokin', 'ammattitutkinto'),
(286, 'Rengasalan', 'ammattitutkinto'),
(287, 'Restaurointikis??llin', 'ammattitutkinto'),
(288, 'Restaurointimestarin', 'erikoisammattitutkinto'),
(289, 'Riistamestarin', 'erikoisammattitutkinto'),
(290, 'Romanikulttuurin ohjaajan', 'ammattitutkinto'),
(291, 'Romanikulttuurin ohjaajan', 'erikoisammattitutkinto'),
(292, 'Rotaatiomestarin', 'erikoisammattitutkinto'),
(293, 'Ruokamestarin', 'erikoisammattitutkinto'),
(294, 'Rytmimusiikkituotannon', 'ammattitutkinto'),
(295, 'Saamenk??sity??kis??llin', 'ammattitutkinto'),
(296, 'Saamenk??sity??mestarin', 'erikoisammattitutkinto'),
(297, 'Saha-alan  ', 'ammattitutkinto'),
(298, 'Sahamestarin', 'erikoisammattitutkinto'),
(299, 'Sairaankuljettajan', 'ammattitutkinto'),
(300, 'Seminologin', 'ammattitutkinto'),
(301, 'Sepp??kis??llin', 'ammattitutkinto'),
(302, 'Sepp??mestarin', 'erikoisammattitutkinto'),
(303, 'Sihteerin', 'ammattitutkinto'),
(304, 'Siivousteknikon', 'erikoisammattitutkinto'),
(305, 'Siivousty??nohjaajan', 'ammattitutkinto'),
(306, 'Sirkusalan', 'perustutkinto'),
(307, 'Sisustusalan ', 'ammattitutkinto'),
(308, 'Sisustusalan ', 'erikoisammattitutkinto'),
(309, 'Sivunvalmistajamestarin', 'erikoisammattitutkinto'),
(310, 'Soitinrakentajakis??llin ', 'ammattitutkinto'),
(311, 'Soitinrakentajamestarin ', 'erikoisammattitutkinto'),
(312, 'SORA - Opiskeluun soveltumattomuuden ratkaisuja', 'ammattitutkinto'),
(313, 'SORA - Opiskeluun soveltumattomuuden ratkaisuja', 'erikoisammattitutkinto'),
(314, 'Sosiaali- ja terveysalan', 'perustutkinto'),
(315, 'Suntion', 'ammattitutkinto'),
(316, 'Suunnitteluassistentin', 'perustutkinto'),
(317, 'Suunnitteluassistentin ', 'ammattitutkinto'),
(318, 'Suurtalouskokin', 'ammattitutkinto'),
(319, 'S??hk??- ja automaatiotekniikan', 'perustutkinto'),
(320, 'S??hk??alan', 'perustutkinto'),
(321, 'S??hk??asentajan', 'ammattitutkinto'),
(322, 'S??hk??laitosasentajan', 'ammattitutkinto'),
(323, 'S??hk??teollisuuden (e. Elektroniikka- ja s??hk??teollisuuden)', 'ammattitutkinto'),
(324, 'S??hk??verkkoalan ', 'erikoisammattitutkinto'),
(325, 'S??hk??verkkoasentajan', 'ammattitutkinto'),
(326, 'S??hk??yliasentajan', 'erikoisammattitutkinto'),
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
(340, 'Teknisen erist??j??n ', 'ammattitutkinto'),
(341, 'Teknisen piirt??j??n', 'ammattitutkinto'),
(342, 'Tekstiili- ja vaatetusalan', 'perustutkinto'),
(343, 'Tekstiilialan', 'ammattitutkinto'),
(344, 'Tekstiilialan', 'erikoisammattitutkinto'),
(345, 'Tekstiilialan', 'perustutkinto'),
(346, 'Tekstiilihuollon', 'ammattitutkinto'),
(347, 'Teollisen pintak??sittelij??n', 'ammattitutkinto'),
(348, 'Teollisuusputkiasentajan', 'ammattitutkinto'),
(349, 'Tieto- ja kirjastopalvelujen', 'ammattitutkinto'),
(350, 'Tieto- ja tietoliikennetekniikan', 'ammattitutkinto'),
(351, 'Tieto- ja tietoliikennetekniikan', 'erikoisammattitutkinto'),
(352, 'Tieto- ja tietoliikennetekniikan ', 'perustutkinto'),
(353, 'Tieto- ja viestint??tekniikan', 'ammattitutkinto'),
(354, 'Tieto- ja viestint??tekniikan', 'erikoisammattitutkinto'),
(355, 'Tieto- ja viestint??tekniikan', 'perustutkinto'),
(356, 'Tietojenk??sittelyn', 'ammattitutkinto'),
(357, 'Tietojenk??sittelyn', 'erikoisammattitutkinto'),
(358, 'Tietojenk??sittelyn', 'perustutkinto'),
(359, 'Tietokoneasentajan', 'ammattitutkinto'),
(360, 'Tietokoneyliasentajan', 'erikoisammattitutkinto'),
(361, 'Tietoliikenneasentajan', 'ammattitutkinto'),
(362, 'Tietoliikenneyliasentajan', 'erikoisammattitutkinto'),
(363, 'Tullialan ', 'ammattitutkinto'),
(364, 'Tuotantoel??inten hoidon ja hyvinvoinnin (e. Karjatalouden)', 'ammattitutkinto'),
(365, 'Tuotekehitt??j??n ', 'erikoisammattitutkinto'),
(366, 'Turkkurimestarin', 'erikoisammattitutkinto'),
(367, 'Turkkurin', 'ammattitutkinto'),
(368, 'Turvallisuusalan', 'perustutkinto'),
(369, 'Turvallisuusvalvojan', 'erikoisammattitutkinto'),
(370, 'Tuulivoima-asentajan', 'ammattitutkinto'),
(371, 'Ty??valmennuksen', 'erikoisammattitutkinto'),
(372, 'Ty??v??linemestarin', 'erikoisammattitutkinto'),
(373, 'Ty??v??linevalmistajan', 'ammattitutkinto'),
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
(388, 'Vanhusty??n', 'erikoisammattitutkinto'),
(389, 'Varaosamyyj??n', 'ammattitutkinto'),
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
(401, 'Viestinv??litys- ja logistiikkapalvelujen ', 'ammattitutkinto'),
(402, 'Viestinv??litys- ja logistiikkapalvelujen ', 'erikoisammattitutkinto'),
(403, 'Vihersisustajan', 'ammattitutkinto'),
(404, 'Viinintuotannon', 'ammattitutkinto'),
(405, 'Viittomakielisen ohjauksen', 'perustutkinto'),
(406, 'Viljelij??n', 'ammattitutkinto'),
(407, 'Viljelypuutarhurin', 'ammattitutkinto'),
(408, 'Virastomestarin', 'ammattitutkinto'),
(409, 'Voimalaitoksen k??ytt??j??n', 'ammattitutkinto'),
(410, 'V??linehuoltajan', 'ammattitutkinto'),
(411, 'V??linehuoltajan', 'erikoisammattitutkinto'),
(412, 'Yhdistelm??ajoneuvonkuljettjan ', 'ammattitutkinto'),
(413, 'Ymp??rist??alan', 'erikoisammattitutkinto'),
(414, 'Ymp??rist??huollon', 'ammattitutkinto'),
(415, 'Yritt??j??n', 'ammattitutkinto'),
(416, 'Yritt??j??n', 'erikoisammattitutkinto'),
(417, 'Yritysjohtamisen ', 'erikoisammattitutkinto'),
(418, 'Yritysneuvojan', 'erikoisammattitutkinto'),
(419, 'S??hk??ty??turvallisuuskoulutus SFS6002', 'Yleisesti hyv??ksytty'),
(420, 'Ensiapukoulutus EA1', 'Yleisesti hyv??ksytty'),
(421, 'Ensiapukoulutus EA2', 'Yleisesti hyv??ksytty'),
(422, 'Ty??turvallisuuskortti', 'Yleisesti hyv??ksytty'),
(423, 'Turva-koulutus rataty??h??n', 'Yleisesti hyv??ksytty'),
(424, 'Tulity??kortti', 'Yleisesti hyv??ksytty'),
(425, 'Vesity??kortti', 'Yleisesti hyv??ksytty'),
(426, 'Henkil??nostinkoulutus', 'Yleisesti hyv??ksytty'),
(427, 'TEVI-Tarkastus', 'Viranomaiskoulutus'),
(428, 'Turvamieskoulutus', 'Viranomaiskoulutus'),
(429, 'Rataty??st?? Vastaavan Koulutus', 'Viranomaiskoulutus'),
(430, 'Tieturvakoulutus 1', 'Viranomaiskoulutus'),
(431, 'Tieturvakoulutus 2', 'Viranomaiskoulutus'),
(432, 'J??nnitekatkop??tevyys', 'Sis??inen koulutus'),
(433, 'Laiturity??skentelyp??tevyys', 'Viranomaiskoulutus'),
(434, 'S??hk??p??tevyys 1', 'Viranomaiskoulutus'),
(435, 'S??hk??p??tevyys 2', 'Viranomaiskoulutus'),
(436, 'Turvalaite-asentajakoulutus', 'Viranomaiskoulutus'),
(437, 'Trukkikortti', 'Yleisesti hyv??ksytty'),
(438, 'Ty??konekuljettaja', 'Viranomaiskoulutus'),
(446, 'H??t??ensiapukurssi', 'Yleisesti hyv??ksytty'),
(447, 'YTJ-ote', 'Yleisesti hyv??ksytty'),
(448, 'IRATA Level 3 -p??tevyys', 'Yleisesti hyv??ksytty'),
(449, 'TyEL-vakuutuksen maksutodistus', 'Yleisesti hyv??ksytty'),
(450, 'Vastuuvakuutustodistus', 'Yleisesti hyv??ksytty'),
(451, 'Todistus verojen maksamisesta', 'Yleisesti hyv??ksytty'),
(452, 'Hygieniaosaamistodistus', 'Viranomaiskoulutus'),
(453, 'Tulity??kortti, katto- ja vedeneristysala', 'Yleisesti hyv??ksytty'),
(454, 'Ty??turvakoulutus, kuljetusala', 'Yleisesti hyv??ksytty'),
(455, 'TK (Liitu)', 'Viranomaiskoulutus'),
(456, 'Turvavaljaat', 'Sis??inen tarkastus'),
(457, 'Mastotarkastus', 'Yleisesti hyv??ksytty'),
(458, 'Petzl - J??lleenmyyj??n korkeanpaikanty??skentelyn peruskoulutus.', 'Yleisesti hyv??ksytty');

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
(1, 'M????r??aikainen'),
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
(1, '14 p??vi????'),
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
(4, 'Muu, mik??');

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
(1, 'Ty??lains????d??nt????'),
(2, 'Ty??ehtosopimusta');

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
(3, 'S??hk??alan TES', '2014-08-01', '2014-08-31', 1.5, 2, 1.5, 2),
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
(2, 'L??hetetty'),
(3, 'Palautunut'),
(4, 'Tarkastettavana'),
(5, 'Palautettu tarkastukseen'),
(6, 'Hyv??ksytty'),
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
(1, 'Odottaa hyv??ksynt????'),
(2, 'Hyv??ksytty'),
(3, 'Hyl??tty'),
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
(2, 'Tekema??a??n lisa??-, lauantai- ja sunnuntai-, ilta- tai yo??tyo??ta??'),
(3, 'Tekema??a??n ylito??ita??'),
(4, 'Tekema??a??n komennusto??ita??');

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
(3, 'Asiatarkastettu (Lis??selvityksess??)'),
(5, 'Hyv??ksytty'),
(6, 'Maksettu'),
(7, 'Kirjanpidossa'),
(8, 'Palautunut'),
(9, 'Reklamoitu'),
(10, 'Hyvitetty'),
(11, 'Asiatarkastettu (V??liselvityksess??)'),
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
(1021, 'Kehitt??mismenot'),
(1040, 'Atk-ohjelmien lisenssimaksut 24 %'),
(1041, 'Atk-ohjelmien lisenssimaksut'),
(1160, 'Kalusto ja muu irtain 24 %'),
(1161, 'Kalusto ja muu irtain'),
(1441, 'Muut osakkeet ja osuudet'),
(1501, 'Aineet ja tarvikkeet'),
(1511, 'Keskener??iset tuotteet'),
(1521, 'Valmiit tuotteet'),
(1531, 'Tavarat'),
(1554, 'Ennakkomaksut vaihto-omaisuudesta'),
(1665, 'Pitk??aikaiset lainasaamiset'),
(1667, 'Pitk??aikaiset maksetut vuokravakuudet'),
(1668, 'Pitk??aikaiset maksetut urakkavakuudet'),
(1691, 'Pitk??aikaiset laskennalliset verosaamiset'),
(1701, 'Myyntisaamiset'),
(1702, 'Myyntisaamiset'),
(1710, 'Myyntisaamiset reskontra v??litili'),
(1750, 'Selvittelytili'),
(1760, 'Lainasaamiset ty??ntekij??ilt??'),
(1761, 'Muut saamiset'),
(1765, 'Pitk??aikaiset lainasaamiset'),
(1768, 'Lyhytaikaiset maksetut urakkavakuudet'),
(1770, 'Alv-saaminen'),
(1801, 'Siirtosaamiset'),
(1851, 'Laskennalliset verosaamiset'),
(1901, 'Rahat/k??teisvarat'),
(1911, 'Liedon S????st??pankki'),
(1912, 'Tampereen Seudun Osuuspankki'),
(2001, 'Osakep????oma'),
(2060, 'Sijoitetun vapaan p????oman rahasto'),
(2061, 'Sijoitetun vapaan p????oman rahasto'),
(2251, 'Edellisten tilikausien voitto/tappio'),
(2265, 'Omista osakkeista maksettu m????r??'),
(2371, 'Tilikauden tulos'),
(2621, 'Pitk??aikainen rahoituslaitoslaina 1'),
(2622, 'Pitk??aikainen autorahoituslaina 1'),
(2623, 'Pitk??aikainen autorahoituslaina 2'),
(2624, 'Pitk??aikainen rahoituslaitoslaina 2'),
(2625, 'Pitk??aikainen autorahoituslaina 3'),
(2626, 'Pitk??aikainen autorahoituslaina 4'),
(2725, 'Pitk??aikaiset velat osakkaille'),
(2749, 'Pitk??aikaiset muut velat'),
(2821, 'Pitk??aikaisen rahoituslaitoslainan 1 lyhennyser??t'),
(2822, 'Pitk??aikaisen autorahoituslainan 1 lyhennyser??t'),
(2823, 'Pitk??aikaisen autorahoituslainan 2 lyhennyser??t'),
(2824, 'Pitk??aikaisen rahoituslaitoslainan 2 lyhennyser??t'),
(2825, 'Pitk??aikaisen autorahoituslainan 3 lyhennyser??t'),
(2871, 'Ostovelat'),
(2880, 'Ostovelat reskontra v??litili'),
(2921, 'Ennakonpid??tysvelka'),
(2923, 'Sosiaaliturvamaksuvelka'),
(2925, 'J??senmaksutilitysvelka 1'),
(2931, 'Arvonlis??verovelka'),
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
(2963, 'El??kevakuutusmaksumenot (siirtovelat)'),
(2965, 'Ty??nantajan pakolliset vak.maksumenot (siirtovelat)'),
(2968, 'Tuloverot (siirtovelat)'),
(2979, 'Muut siirtovelat'),
(2981, 'Laskennalliset verovelat'),
(2999, 'Projektien laskennalliset voitot (varaukset)'),
(3000, 'Myynti 24 %'),
(3010, 'Konsultointi 24 %'),
(3020, 'Henkil??st??vuokraus 24 %'),
(3188, 'Rakentamispalvelut 0 %, k????nnetty alv'),
(3464, 'Arvopapereiden myynti'),
(3981, 'Muut tuotot'),
(3994, 'Projektien laskutusvaraukset'),
(3995, 'Pitk??aikaiset urakkavakuudet (sis??inen)'),
(4000, 'Ostot ALV3'),
(4004, 'Ostot'),
(4005, 'Ostot (varaukset)'),
(4020, 'Vaatteet 24 %'),
(4040, 'Pakkaustarvikkeet 24 %'),
(4110, 'Yhteis??hankinnat 24 %'),
(4130, 'Tavaratuonti'),
(4134, 'Ostot tuonti'),
(4137, 'Tuonnin alv-arvojen vastatili'),
(4144, 'Tullit, verot ja muut maksut tullattaessa'),
(4290, 'Ostorahdit 24 %'),
(4294, 'Ostorahdit'),
(4320, 'Tuontihuolinta 24 %'),
(4374, 'Ostojen valuuttakurssierot'),
(4401, 'Varastojen lis??ys (+) tai v??hennys (-)'),
(4450, 'Alihankinta'),
(4458, 'Rakentamispalveluostot 1, ostaja verovelvollinen 24 %'),
(4460, 'Rakentamispalveluostot (varaukset)'),
(4470, 'Yhteis??palveluhankinta'),
(4490, 'Muut ulkopuoliset palvelut'),
(5000, 'Ty??ntekij??palkat'),
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
(6140, 'Ty??ntekij??in TyEL-maksut'),
(6300, 'Sosiaaliturvamaksut'),
(6400, 'Tapaturmavakuutusmaksut'),
(6410, 'Ty??tt??myysvakuutusmaksut'),
(6420, 'Ty??ntekij??iden ty??tt??myysvakuutusmaksut'),
(6430, 'Ryhm??henkivakuutusmaksut'),
(6500, 'Henkil??vakuutusmaksut (vapaaehtoiset)'),
(6800, 'Suunnitelman mukaiset poistot'),
(6850, 'Poisto muista pitk??vaikutteisista menoista'),
(6870, 'Poisto koneista ja kalustoista'),
(7000, 'Henkil??kunnan koulutus ALV3'),
(7004, 'Henkil??kunnan koulutus'),
(7010, 'Sis??iset palaverit ja henkil??kuntajuhlat ALV3'),
(7011, 'Sis??iset palaverit ja henkil??kuntajuhlat 14 %'),
(7020, 'Virkistys- ja harrastustoiminta 24 %'),
(7024, 'Virkistys- ja harrastustoiminta'),
(7050, 'Ty??terveyshulto ALV3'),
(7054, 'Ty??terveyshuolto'),
(7110, 'Kahvitarvikkeet ALV3'),
(7111, 'Kahvitarvikkeet 14 %'),
(7120, 'Ty??vaatteet ALV3'),
(7124, 'Ty??vaatteet'),
(7130, 'Suojav??lineet 24 %'),
(7170, 'Muut henkil??sivukulut'),
(7200, 'Vuokrat ja vastikkeet'),
(7234, 'Toimitilavuokrat'),
(7274, 'Autotalli- ja autopaikkavuokrat'),
(7310, 'Muut vuokrat/vastikkeet 24 %'),
(7314, 'Muut vuokrat/vastikkeet'),
(7360, 'Siivous ja puhtaanapito ALV3'),
(7400, 'J??tehuolto 24 %'),
(7404, 'J??tehuolto'),
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
(7664, 'Atk-ohjelmistot, p??ivitykset, yll??pito'),
(7680, 'Atk-laitehankinnat (< 3 v. kalusto) 24 %'),
(7684, 'Atk-laitehankinnat (< 3 v. kalusto)'),
(7700, 'Muut atk-laite ja -ohjelmistokulut 24 %'),
(7710, 'Muut kone- ja kalustokulut'),
(7720, 'Kone- ja kalustovuokrat 24 %'),
(7740, 'Kone- ja kalustohankinnat (< 3 v. kalusto) 24 %'),
(7744, 'Kone- ja kalustohankinnat (< 3 v. kalusto)'),
(7750, 'Koneiden ja kaluston pienhankinnat 24 %'),
(7764, 'Maksetut ty??kalukorvaukset'),
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
(7884, 'P??iv??rahat'),
(7904, 'Y??matkarahat'),
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
(8200, 'Myynnin edist??minen'),
(8230, 'Muut myynnin edist??miskulut 24 %'),
(8370, 'Vuokraty??voima 24 %'),
(8379, 'Projektikohtaiset henkil??kulut (sis. projektisiirrot)'),
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
(8540, 'Posti- ja l??hettikulut 24 %'),
(8544, 'Posti- ja l??hettikulut'),
(8560, 'Rahaliikenteen kulut 24 %'),
(8564, 'Rahaliikenteen kulut 0 %'),
(8570, 'Py??ristyserot'),
(8580, 'Vakuutukset ja vahingonkorvaukset'),
(8584, 'Vastuuvakuutukset'),
(8594, 'Esinevakuutukset'),
(8610, 'Maksetut vahingonkorvaukset 24 %'),
(8614, 'Maksetut vahingonkorvaukset'),
(8620, 'Toimistotarvikkeet ALV3'),
(8630, 'Lomakkeet ja painatuskulut 24 %'),
(8640, 'Muut k??ytt??tarvikkeet ALV3'),
(8650, 'Muut hallintokulut'),
(8651, 'Kokous- ja neuvottelukulut 14 %'),
(8654, 'Kokous- ja neuvottelukulut'),
(8680, 'Muut hallintokulut 24 %'),
(8700, 'Myynnin luottotappiot'),
(8770, 'V??hennyskelvottomat muut liikekulut'),
(8774, 'Veron korotukset, v??hennyskelvottomat'),
(9161, 'Muut korko- ja rahoitustuotot'),
(9198, 'Projektien voitot/tappiot tilikauden vaihteessa'),
(9199, 'Projektien laskennalliset voitot (varaukset)'),
(9200, 'Muilta'),
(9220, 'Korkotuotot pankkisaamisista'),
(9240, 'Palautettava yhteis??korko/palautuskorko'),
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
(9950, 'Veronpalautukset/j????nn??sverot'),
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
(2, 'S??hk??'),
(4, 'Vakuutus'),
(5, 'Koulutus'),
(6, 'Alihankinta'),
(7, 'Puhelin'),
(11, 'Datasiirto'),
(12, 'Ty??terveys'),
(13, 'Markkinointi'),
(14, 'Viranomaismaksut'),
(15, 'Ajoneuvot'),
(16, 'Majoitus'),
(17, 'Ty??vaatteet ja -v??lineet'),
(18, 'Toimisto'),
(19, 'Palvelut'),
(20, 'S??hk??tarvikkeet'),
(21, 'Posti'),
(22, 'Pankki -ja rahaliikenne'),
(23, 'Tarjoilu'),
(24, 'Matkustus'),
(25, 'Vartiointipalvelut'),
(26, 'Menotosite'),
(27, 'Huomautus ja perint??'),
(28, 'K??sity??kalut'),
(29, 'Tilintarkastus'),
(30, 'IT'),
(31, 'Media'),
(32, 'Vuokralaitteet'),
(33, 'Tietopalvelut'),
(34, 'Siivouspalvelut'),
(35, 'Tietoturvapalvelut'),
(36, 'Junaturvallisuuspalvelut'),
(37, 'Muu hallinto'),
(38, 'K????nn??sty??'),
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
