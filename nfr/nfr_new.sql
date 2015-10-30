-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 29, 2015 at 01:05 PM
-- Server version: 5.5.42
-- PHP Version: 5.5.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `nfr_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `gear_history`
--

CREATE TABLE `gear_history` (
  `id` int(10) unsigned NOT NULL,
  `station_gear_id` int(11) NOT NULL,
  `failure_date` date NOT NULL,
  `failure_type` varchar(60) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gear_history`
--

INSERT INTO `gear_history` (`id`, `station_gear_id`, `failure_date`, `failure_type`, `last_update`) VALUES
(5, 1, '2015-09-22', 'Test', '2015-09-22 09:38:43'),
(6, 3, '2015-09-29', 'dd', '2015-09-22 09:44:45'),
(7, 1, '2015-09-23', 'test1', '2015-09-22 09:52:34'),
(8, 1, '2015-09-30', 'test34', '2015-09-22 10:05:19'),
(9, 1, '2015-09-25', 'hgh', '2015-09-25 09:42:39'),
(10, 1, '2015-09-29', '', '2015-09-29 08:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_district_master`
--

CREATE TABLE `nfr_district_master` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `dist_hq` varchar(80) DEFAULT NULL,
  `zone` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_district_master`
--

INSERT INTO `nfr_district_master` (`id`, `name`, `dist_hq`, `zone`) VALUES
(1, 'Bagsa', 'Mushalpur', ''),
(2, 'Barpeta', 'Barpeta', ''),
(3, 'Bongaigaon', 'Bongaigaon', ''),
(4, 'Cachar', 'Silchar', ''),
(5, 'Chirang', 'Kajalgaon', ''),
(6, 'Darrang', 'Mangaldai', ''),
(7, 'Dhemaji', 'Dhemaji', ''),
(8, 'Dhubri', 'Dhubri', ''),
(9, 'Dibrugarh', 'Dibrugarh', ''),
(10, 'Goalpara', 'Goalpara', ''),
(11, 'Golaghat', 'Golaghat', ''),
(12, 'Hailakandi', 'Hailakandi', ''),
(13, 'Jorhat', 'Jorhat', ''),
(14, 'Kamrup', 'Dispur', ''),
(15, 'Kamrup (M)', 'Dispur', ''),
(16, 'Karbi Anglong', 'Diphu', ''),
(17, 'Karimganj', 'Karimganj', ''),
(18, 'Kokrajhar', 'Kokrajhar', ''),
(19, 'Lakhimpur', 'Lakhimpur', ''),
(20, 'Marigaon', 'Marigaon', ''),
(21, 'Nagaon', 'Nagaon', ''),
(22, 'Nalbari', 'Nalbari', ''),
(23, 'Dima Hasao', 'Haflong', ''),
(24, 'Sivasagar', 'Sivasagar', ''),
(25, 'Sonitpur', 'Tezpur', ''),
(26, 'Tinsukia', 'Tinsukia', ''),
(27, 'Udalguri', 'Udalguri', '');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_gear_type_master`
--

CREATE TABLE `nfr_gear_type_master` (
  `id` int(11) NOT NULL,
  `code` varchar(40) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_gear_type_master`
--

INSERT INTO `nfr_gear_type_master` (`id`, `code`, `name`) VALUES
(1, 'PT', 'ELECTRICAL OPERATED POINTS'),
(2, 'ED', 'ELECTRICAL DETECTOR'),
(3, 'TC', 'TRACK CIRCUITS - DC / AC / AFTC'),
(4, 'S', 'COLOUR LIGHT SIGNALS'),
(7, 'PL', 'OPERATING & INDICATION PANELS'),
(8, 'CF', 'SM''S SLIDE & CONTROL FRAME'),
(9, 'EKT', 'ELECTRIC KEY TRANSMITTERS'),
(12, 'R', 'RELAYS'),
(13, 'PS', 'POWER SUPPLY'),
(14, 'F', 'FUSES'),
(15, 'DG', 'DG SETS'),
(16, 'LB', 'APPARATUS CASES / LOCATION BOXES / CABLES'),
(17, 'E', 'EARTHING'),
(18, 'AXC', 'AXLE COUNTERS'),
(19, 'TBI', 'TOKEN BLOCK INSTRUMENT - SINGLE LINE NEAL''S'),
(21, 'TLBI', 'TOKENLESS BLOCK INSTRUMENT - SINGLE LINE (PUSH BUTTON TYPE)'),
(22, 'BPAC', 'BLOCK AXLE COUNTER SYSTEMS (BPAC)'),
(24, 'ELB', 'POWER OPERATED INTERLOCKED LC GATES'),
(25, 'MLB', 'MECHANICALLY OPERATED INTERLOCKED LC GATES'),
(26, 'MPT', 'MECHANICAL POINTS');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_jp_crossing_inspection_ledger`
--

CREATE TABLE `nfr_jp_crossing_inspection_ledger` (
  `id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `role` enum('SS','IC') NOT NULL,
  `date_of_inspection` date NOT NULL,
  `due_date_of_inspection` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nfr_jp_crossing_inspection_ledger`
--

INSERT INTO `nfr_jp_crossing_inspection_ledger` (`id`, `station_id`, `role`, `date_of_inspection`, `due_date_of_inspection`, `user_id`, `last_update`) VALUES
(1, 2, 'SS', '2015-09-01', '2015-09-24', 1, '2015-09-24 15:57:23'),
(2, 2, 'IC', '2015-09-16', '2015-10-15', 1, '2015-09-24 15:57:36'),
(3, 2, 'IC', '2015-09-24', '2015-09-24', 1, '2015-09-24 17:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_maintenance_schedule_ledger`
--

CREATE TABLE `nfr_maintenance_schedule_ledger` (
  `id` int(11) NOT NULL,
  `station_gear_id` int(11) NOT NULL,
  `schedule_code_id` int(11) NOT NULL,
  `maintenance_date` date NOT NULL,
  `next_maintenance_date` date NOT NULL,
  `role` enum('SS','IC') NOT NULL,
  `maintenance_by` varchar(40) NOT NULL,
  `discontinuation_status` enum('Yes','No') CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nfr_maintenance_schedule_ledger`
--

INSERT INTO `nfr_maintenance_schedule_ledger` (`id`, `station_gear_id`, `schedule_code_id`, `maintenance_date`, `next_maintenance_date`, `role`, `maintenance_by`, `discontinuation_status`, `user_id`, `last_update`) VALUES
(2, 3, 7, '2015-03-01', '2015-03-01', 'SS', 'SSS', 'Yes', 1, '2015-09-23 14:06:15'),
(3, 4, 8, '2015-03-01', '2015-03-01', 'SS', 'dfgg', 'Yes', 1, '2015-09-24 14:51:57'),
(4, 3, 7, '2015-03-01', '2015-03-01', 'SS', 'tes', 'Yes', 1, '2015-09-27 06:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_maintenance_schedule_ledger_1`
--

CREATE TABLE `nfr_maintenance_schedule_ledger_1` (
  `id` int(11) NOT NULL,
  `station_gear_id` int(11) NOT NULL,
  `schedule_code_id` int(11) NOT NULL,
  `maintenance_date` date NOT NULL,
  `actual_maintenance_date` date NOT NULL,
  `role_id` int(11) NOT NULL,
  `maintenance_by` int(11) NOT NULL DEFAULT '0',
  `remarks` varchar(40) CHARACTER SET utf8 NOT NULL,
  `status` enum('done','pending') CHARACTER SET utf8 NOT NULL,
  `progress` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nfr_maintenance_schedule_ledger_1`
--

INSERT INTO `nfr_maintenance_schedule_ledger_1` (`id`, `station_gear_id`, `schedule_code_id`, `maintenance_date`, `actual_maintenance_date`, `role_id`, `maintenance_by`, `remarks`, `status`, `progress`, `user_id`, `last_update`) VALUES
(1, 1, 6, '2016-08-24', '0000-00-00', 2, 0, '', 'pending', 0, 1, '2015-09-04 10:08:48'),
(2, 2, 7, '2015-09-14', '2015-09-16', 1, 2, 'test', 'done', 100, 1, '2015-09-04 10:12:26'),
(3, 2, 7, '2015-11-30', '0000-00-00', 2, 0, '', 'pending', 0, 1, '2015-09-04 10:12:40'),
(4, 3, 8, '2015-10-01', '0000-00-00', 1, 0, '', 'pending', 0, 1, '2015-09-16 09:22:06'),
(5, 2, 7, '2015-09-30', '0000-00-00', 1, 0, '', 'pending', 0, 1, '2015-09-16 09:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_reset_password`
--

CREATE TABLE `nfr_reset_password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `expiry_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nfr_role_master`
--

CREATE TABLE `nfr_role_master` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_role_master`
--

INSERT INTO `nfr_role_master` (`id`, `name`) VALUES
(1, 'SECTIONAL SUPERVISER'),
(2, 'INCHARGE SSE/SE'),
(3, 'SR DSTE TSK'),
(4, 'ADSTE W TSK'),
(5, 'ADSTE MXN'),
(6, 'DSTE TSK');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_schedule_code_master`
--

CREATE TABLE `nfr_schedule_code_master` (
  `id` int(11) NOT NULL,
  `code` varchar(80) NOT NULL,
  `gear_type_id` int(80) NOT NULL,
  `periodicity_level_1` int(11) NOT NULL,
  `periodicity_level_2` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_schedule_code_master`
--

INSERT INTO `nfr_schedule_code_master` (`id`, `code`, `gear_type_id`, `periodicity_level_1`, `periodicity_level_2`, `remarks`, `last_updated`) VALUES
(1, 'P1', 1, 14, 90, 'Checking â€“ \nâ€¢	The machine for tightness and free from rust, dirt. Cleaning, graphite / oiling of slide chairs. (19.119)\nâ€¢	Checking and oiling of Point Gear Assembly, slides, rollers & pins with medium grade axle oil IS 1628. Avoid overflowing. (19.120)\nâ€¢	The setting of switch for having required amount of spring action. (19.127.3)\n\nObstruction test - of points with 5 mm test piece to ensure point can not be locked, detection contacts should not assume the position indicating point closure & friction clutch should slip. (19.127.1)\n', '2014-06-25 16:21:47'),
(2, 'P2', 1, 30, 90, 'Checking â€“\r\nâ€¢	The contacts for proper adjustment & free from pitting. (19.124) \r\nâ€¢	And ensuring all the bridge contacts make & break at the same time.  (19.42) (19.148)\r\nâ€¢	Wires are neatly dressed, intact and clear of all moving parts do not get trapped in the lid when closed. (19.122)\r\nâ€¢	Tightening of all nuts, check nuts & bolts, lock nuts holding the detector slides & lock slides with lugs. (19.126.1)\r\nâ€¢	The pins of Switch Extension piece / â€˜Pâ€™ bracket for any rib formation or excessive wear and split pins are open. (19.127.5)  \r\nâ€¢	All moving parts including locking dogs and notch slides etc. shall be checked for chamfering or undue wear, worn out to be replaced promptly. (19.126.2)  \r\nâ€¢	Out of correspondence when wiring / cable changed. \r\nâ€¢	Visual checks of Points insulation, packing & ballasting. (19.29.4) (19.148)\r\n', '2014-06-25 16:22:56'),
(3, 'P3', 1, 90, 182, 'â€¢	Measurements of operating values (voltage & current) of point machines, with and without obstruction for normal and reverse operation. Current required to operate the machine in either direction shall be 1.5 to 2 times of its normal operation and friction clutch shall slip within this range.  Replace machine when difference between normal operating current and current under obstruction is less than 0.5 A.  (Current meter to be provided in control panel to measure currents for these tests). (19.128) (19.127.6) (19.127.4)\r\nâ€¢	Current in either direction should be approx. same and check for unbalance. (19.127.2)\r\nChecking â€“\r\nâ€¢	Feed disconnection time under obstruction is not less than 10 Seconds. (19.128)\r\nâ€¢	Smoothness & cleaning of Commutator, carbon brushes and their pressure, free movement in holder. (19.121) \r\nâ€¢	Greasing / Oiling of point machine and Checking of all grease nipples in position. (19.29.2)\r\n', '2014-06-25 16:24:40'),
(4, 'P4', 1, 0, 90, 'Joint check with SE/SSE (P-Way), of points & crossing for condition of tongue rails, stock rails, leveling, squaring, creeping, packing, clearance of ballast & other P-Way fittings and drainage prior to monsoon etc. Measurement of LH, RH switch opening, as per SEM Para 12.40. (19.125) (19.127.8)\r\nSectional JE/SE/SSE & In-charge SSE/SE to carry out every alternate inspection\r\n', '2014-06-25 16:25:14'),
(5, 'P5', 1, 0, 182, '( Quarterly for wooden layout)\r\n\r\nâ€¢	Obstruction test with crank handle for normal & reverse to check that with fictitious locking, detector contacts just make with 1.6 mm obstruction and break with 3.25 mm obstruction.  (19.36) \r\nâ€¢	Conducting the same test with proper locking. (19.38)\r\nâ€¢	Conduct obstruction test with 5 mm test piece, after adjustment from Panel operation.\r\nâ€¢	Visual check of brass strips provided between detector slides, without removing them. \r\nâ€¢	Checking of NX Switch and its wards, connections and its effectiveness during power operation points.\r\nâ€¢	Checking insulation of switch brackets, gauge tie plate, stretcher bars.  \r\nâ€¢	Tail cable testing by 500 V Megger & keeping the record.\r\nâ€¢	Verification of cable and machine wiring connections at all ends. (19.123)\r\nChecking of point motor insulation, wire insulation and continuity test. (by 100 V Megger). (19.127.7) (19.148)\r\n', '2014-06-25 16:26:58'),
(6, 'P6', 1, 0, 365, 'â€¢	Tail cable testing by 500 V Megger & keeping the record.\r\nâ€¢	Verification of cable and machine wiring connections at all ends. (19.123)\r\nChecking of point motor insulation, wire insulation and continuity test. (by 100 V Megger). (19.127.7) (19.148)\r\n', '2014-06-25 16:27:42'),
(7, 'ED1', 2, 14, 90, 'â€¢	Checking â€“ Slides are having free movement. (19.44)\r\nâ€¢	Oiling the slides & rollers with the axle oil.Grade Medium to IS: 1628.  (19.131) (19.148)\r\n\r\nâ€¢	Obstruction Testing and adjusting - for Normal & Reverse setting of point by obstruction test to ensure with 1.6 mm test piece detector contacts just make, with 3.25 mm test piece by fictitious locking contacts just break and with 5 mm test piece point is not locked and detector contacts not make. (19.134) (19.148)', '2014-06-25 16:28:20'),
(8, 'ED2', 2, 30, 90, 'Checking and adjusting â€“ (19.42) (19.148)\r\nâ€¢	The contacts to Make or break at same time. \r\nâ€¢	The cross protection contact makes only after concerned detection contact open.\r\nâ€¢	Normal detection opens then only normal shunt contact wherever wired,  to close and vice-versa.\r\nâ€¢	Shunt contacts are not used in RE area.  \r\nChecking â€“\r\nâ€¢	Sleepers are packed well. (19.133) (19.148)\r\nâ€¢	Tightening of all nuts and screws & nuts on lugs. Wires are neat, tidy and clear of moving parts . (19.132) (19.148)\r\n', '2014-06-25 16:28:39'),
(9, 'ED3', 2, 0, 365, 'Tail Cable Testing with 500 V Merger and  noting if this reading changes when adjacent track circuit feed is shorted or disconnected. (17.21.4) (17.24)   \r\nâ€¢	Checking of track bonds and feed set.  Checking of effectiveness of transverse and longitudinal bonds, staggering of polarity. (17.21.1)\r\n', '2014-06-25 16:29:00'),
(10, 'T1', 3, 14, 90, 'Checking â€“ Outside track bonds, impedance bonds, bond wires and clips, jumper, power feed, relay and cable connections -   \r\nâ€¢	For firmness, insulation condition of jumper connections / Track lead connections, replacing if insulation worn out or connections corroded and properly securing them. (17.26) (17.27) (17.21.1)\r\nâ€¢	 Replacing corroded bonds. (17.26.2 & 3)\r\nâ€¢	Visual check & cleaning of insulated block joints. (17.21.5)\r\nâ€¢	Traction bonds / jumpers do not cause any short circuits with track circuit rails / connections. \r\nâ€¢	Engineering fittings â€“ Track condition, availability of liners & Pad.\r\n', '2014-06-25 16:29:27'),
(11, 'T2', 3, 30, 90, 'â€¢	Cleaning junction boxes, bootlegs and tuning Units.\r\nâ€¢	 Specific gravity and voltage of battery. (17.33)\r\n', '2014-06-25 16:29:50'),
(12, 'T3', 3, 90, 182, 'â€¢	Testing of block joints and detecting faulty joints by taking the voltage readings across track relay terminals', '2014-06-25 16:30:08'),
(13, 'T4', 3, 182, 365, 'â€¢	Overhauling and maintenance of insulated block joints. (17.23)\r\nâ€¢	Checking - for good insulation condition of Tongue rails, Gauge tie plate, Stretcher bar and point rodding. (17.25)\r\n\r\nJoint check of track circuited portion with P-way supervisors for â€“ (17.30)         \r\nThe condition of rail and insulation at the rail joints, tightness of fish plate bolts, packing of sleepers in the vicinity of IBJ/GJ, ballast & sleepers, abnormal collection of brake dust, rusting of the rail, drainage and position of P-way fittings likely to cause short circuits like spike, pendrol clips and bearing plates.\r\nâ€¢	Condition of ballast, 50 mm ballast clearance from bottom of the rail flange and availability of anti creep, â€˜Jâ€™ clips at GJ / IBJ, minimum 97 % GFN Liners and Pads for track circuits with PSC sleepers. (17.28)  (17.23 - h)\r\nâ€¢	Carrying out jointly or by Engineering the maintenance work found necessary after joint inspection. (17.30)  \r\nâ€¢	Wherever needed Zigzag welding work on rusty rails, to be carried out. (17.37)\r\nâ€¢	Adequate precautions to be taken after track renewal (20.2.5.1)   \r\n\r\nJoint check with traction supervisors for availability of two cross bonds / jumpers in good condition for return rails in single rail track circuits in AC electrified territory and rail bonds effectiveness in DC electrified.\r\n\r\nâ€¢	Adequate precautions to be taken after track renewal (20.2.5.1)   \r\n\r\nJoint check with traction supervisors for availability of two cross bonds / jumpers in good condition for return rails in single rail track circuits in AC electrified territory and rail bonds effectiveness in DC electrified\r\n', '2014-06-25 16:32:04'),
(14, 'T5', 3, 0, 182, 'â€¢	Checking train shunt resistance at relay, feed end and other parallel portion of TC. (17.31)\r\nâ€¢	Measurement, testing of Track Circuit & Impedance Bond and AFTC parameters (Voltages & current, AFTC Power Supply, TX Voltages, RX current & Gain and train shunt resistance at relay, feed end and other parallel portion of TC) & maintenance of records as per prescribed Track Circuit card / Performa for each type of track circuits.  (17.32.1)\r\nâ€¢	Taking suitable remedial action for abnormal readings / variations.  .  (17.32.1)\r\nâ€¢	Checking that excitation with respect to rated pick up voltage, of DC track circuits is minimum 125% and not more than 250% for self type relays, 300% for plug-in type relays and of AC track circuits is minimum 130% and not more than 200%, in case of AFTC gain setting\r\nkept in the dynamic range / as prescribed for different AFTC. .  (17.15.4) (17.18.4)\r\nâ€¢	TSR also to be tested whenever track circuit adjusted or AFTC gain setting is changed. .  (17.31.1)\r\nâ€¢	Coating by insulating varnish / epoxy over GJ / IBJ. .  (17.23 - i)\r\n', '2014-06-25 16:32:28'),
(15, 'T6', 3, 0, 365, 'â€¢	Interchange coil terminals R1 & R2 on Shelf-type Track Relays.  (17.21.7)\r\nâ€¢	Checking & Replacing Track Relays if due for overhauling (Periodicity of overhauling 10 yrs.). (17.22.5)  \r\nâ€¢	Tail cable testing with 500 V Megger. \r\n', '2014-06-25 16:33:41'),
(16, 'T7', 3, 0, 730, 'â€¢	Conducting visual inspection of track relays to check movements of armature and contact carriage, wiping of contacts, arcing of contacts, if any; pitting or charring of contacts, dust on contacts, electroplating, corrosion, rusting of components, cracks or breakages in components, presence of fungus, if any; charring of cover near contacts (for plug â€“ In â€“ relays), correctness of label and presence of seal. .  (17.22.3)\r\nâ€¢	Replacing defective relays found with any of these defects.  (17.22.4)\r\n', '2014-06-25 16:35:03'),
(17, 'S1', 4, 14, 90, 'â€¢	Cleaning of outer lenses, signal units from outside ', '2014-06-25 16:38:42'),
(18, 'S2', 4, 30, 90, 'â€¢	Replacing with pre-tested bulb (AT 10.5 Volts for 3 hours for each filament) if main filament fused or as per the periodicity for ON aspect. (19.109.2, 3, 4)\r\nâ€¢	Whenever lamp is replaced, checking â€“ \r\n-	Cleaning of inner lenses and housing (19.108.2)\r\n-	Tightness of all adjusting nuts. (19.110.3)\r\n-	MECR functioning.\r\n-	Contact pressure on lamp holder contacts and Bulbs are seated properly. (19.110.1)\r\n-	Measurement of signal lamp voltages (to be > 90% of rated). (19.148)\r\n', '2014-06-25 16:43:25'),
(19, 'S3', 4, 90, 182, 'Checking â€“ \r\nâ€¢	Visual check of insulation of wires & cables.\r\nâ€¢	The condition of gasket to ensure rainwater does not have access to the interior of lamp unit. (19.108.2).\r\nâ€¢	Focusing of signals units and all its aspects. (19.110.2)\r\nâ€¢	Condition of signal post\r\n\r\n', '2014-06-25 16:48:03'),
(20, 'S4', 4, 0, 365, 'â€¢	Check infringement of Signal & all its fitting with respect to schedule of dimensions (infringement to be removed, if found). \r\nâ€¢	Effectiveness of screen earthing.\r\nâ€¢	For automatic signals (20.2.3) â€“\r\n-	Test track circuit control on signal and aspect control by signal in advance. \r\n-	Automatic cutting in of the next restrictive aspect when the lamp of one aspect burns out.\r\n-	On single line checking direction of traffic and conflicting signals are not cleared.\r\nâ€¢	Tail cable insulation testing with 500 V Megger.\r\n', '2014-06-25 16:48:43'),
(21, 'S5', 4, 0, 0, 'â€¢	Measurement of No load current of signal transformers of all aspects. (shall not be > 15 mA).\r\nâ€¢	Check of earth insulation with 100 V Megger of signal transformer\r\nConducting - Negative test â€“ Near 45 degrees & near 90 degrees before hold off device engages, cut off feed .', '2014-06-25 16:49:14'),
(22, 'SM1', 5, 14, 90, '', '2014-06-25 16:50:05'),
(23, 'SM2', 5, 30, 90, '', '2014-06-25 16:50:20'),
(24, 'SM3', 5, 90, 182, '', '2014-06-25 16:51:18'),
(25, 'SR1', 6, 14, 90, '', '2014-06-25 16:51:41'),
(26, 'SR2', 6, 30, 90, '', '2014-06-25 16:51:59'),
(27, 'SR3', 6, 182, 365, '', '2014-06-25 16:52:27'),
(28, 'SR4', 6, 0, 365, '', '2014-06-25 16:52:40'),
(29, 'PL1', 7, 30, 90, 'Physical checking & cleaning of Panel, Panel Buttons, Lamps etc', '2014-06-25 16:53:05'),
(30, 'PL2', 7, 0, 90, 'Testing of all Panel counters, SMâ€™s Key and emergency crossover operation', '2014-06-25 16:53:18'),
(31, 'PL3', 7, 0, 1095, 'Functional testing for all circuits as per selection table and conflicting movements. (13.40.2.1-ii)', '2014-06-25 16:54:14'),
(32, 'CF1', 0, 30, 90, '', '2014-06-25 16:54:42'),
(33, 'CF2', 0, 0, 365, '', '2014-06-25 16:55:37'),
(34, 'CF3', 0, 0, 0, '', '2014-06-25 16:56:19'),
(35, 'H1', 9, 30, 90, 'â€¢	Cleaning, lubricating & checking free working of all moving parts.  (19.144.1) (19.148)\r\nâ€¢	Checking â€“ \r\n-	Galvo functions properly. (19.144.1)\r\n-	Good adjustment of all contact springs and cleaning. (19.144.1) (19.148)\r\n-	Seals are intact. (19.148)\r\n-	Respective keys turn freely in transmitter. (19.144.2)\r\n-	Cover is secured. (19.144.2)\r\n-	Wiring is in good condition & properly protected. (19.144.4)\r\n-	It is not possible to extract the key transmitter once inserted and locked, unless the control from the other end is received. (19.145-b)\r\n-	It is not possible to release the key by jerks or any other irregular means. (19.145-c)\r\n\r\n ', '2014-06-25 16:56:43'),
(36, 'H2', 9, 90, 182, 'Checking â€“\r\nâ€¢	The contacts break & make in proper sequence while transmitting the key. (19.144.5)\r\nâ€¢	Effectiveness of the force lock arrangement. (19.145-a\r\n', '2014-06-25 16:57:02'),
(37, 'H3', 9, 0, 365, 'Yearly Checking â€“ \r\nâ€¢	Insulation resistance of current carrying components (19.145.d) \r\nâ€¢	That the key of one transmitter/key lock does fit in any other key transmitter / key lock at that station except its counter part. (19.144.3) (19.148)\r\n', '2014-06-25 16:57:20'),
(38, 'L1', 10, 30, 90, '', '2014-06-25 16:58:17'),
(39, 'L2', 10, 90, 182, '', '2014-06-25 16:58:35'),
(40, 'AL1', 11, 30, 90, '', '2014-06-25 16:58:59'),
(41, 'AL2', 11, 0, 365, '', '2014-06-25 16:59:20'),
(42, 'R1', 12, 30, 90, 'â€¢	Checking & cleaning of dust on relays. (19.136) (19.148)\r\nâ€¢	Checking â€“\r\n- Effectiveness of anti-tilting arrangement on self-type relays. (19.137)\r\n - In case of panel using Solid State flasher, its indication on panel is in working condition.\r\n\r\nâ€¢	Whenever needed â€“ If high contact resistance is observed than cleaning / replacing of contacts of metal-to-metal relays & replacing of contacts of metal to carbon relays. (19.138) (19.148)\r\n', '2014-06-25 16:59:59'),
(43, 'R2', 12, 0, 365, 'â€¢	Accuracy of time delay circuit.  (19.148)\r\nâ€¢	Overhauling is not more than 10-12 years old for track relays and 15 years for self-type line relays. (19.141) (19.148)\r\nâ€¢	Seals of relays are intact effective and not tempered. (19.64.2)\r\nâ€¢	Crank Handle Relay - Checking the effectiveness of locking, checking dry solder, checking contacts.\r\nâ€¢	Maintaining relay register. (19.148)\r\n', '2014-06-25 17:00:19'),
(44, 'R3', 12, 0, 0, 'â€¢	Visual inspection of relays. (19.139.1) (19.148)\r\nâ€¢	The relay to be checked for defects in respect of â€“ movement of armature and contact carriage, wiping of contacts, arcing of contacts, pitting or charring of contacts, dust accumulation on contacts, electro-plating, corrosion / rusting of components, crack or breakage in components, presence of fungus and ants inside the relay casing, charring of cover near contacts in the case of plug-in-type relays, corrosion of label, absence of tempering of seal, any other abnormal condition. (19.140)\r\n', '2014-06-25 17:00:30'),
(45, 'PS1', 13, 30, 90, 'Visual checks of power supply equipment, their front panel, fuses and charging of batteries.\r\nâ€¢	Changing the power supply equipment to standby. (16.11.2) \r\nâ€¢	Testing of Diesel Generator and Auto Push Button start. (16.12.7)\r\nSecondary cell - \r\nâ€¢	Cleaning & checking voltage and specific gravity of secondary batteries and adjustment of charging current so that its voltage and specific gravity are within specified limits and keeping the record on the battery History card. (16.10.8)\r\nâ€¢	Electrolyte & maintaining at correct level. (16.10.6)\r\nâ€¢	Voltage of individual cell shall is not below 1.85V (16.10.8)\r\nâ€¢	Checking â€“Terminals & connectors and cleaning, coating with pure Vaseline or petroleum jelly or non acidic insulation spray compound, to prevent corrosion. (16.10.5)\r\n', '2014-06-25 17:01:03'),
(46, 'PS2', 13, 90, 182, 'â€¢	Primary cell â€“  Each cell to be tested individually with a load of 10 Ohms resistance and if the voltage of cell falls below 0.85V, then the cell to be discarded. (Voltmeter sensibility shall not be less than 1000 Ohms per volt.) (16.9.1)\r\nâ€¢	Checking Tightness of battery & load connections. (16.11.4)\r\nâ€¢	Taking readings of voltages of all supplies and taking remedial action in case abnormal variation is observed. (16.11.5) \r\nâ€¢	Testing of change over of power supplies from AT(s) to local & Generator. Checking of AVR functioning. (16.11.1)\r\nâ€¢	Measurement currents & voltages of all power supplies.\r\n', '2014-06-25 17:01:20'),
(47, 'PS3', 13, 0, 365, 'â€¢	Checking and cleaning of power supply equipment, checking of power wiring connections, Programme switch terminals, contactors, elmex terminals and wiring inside power panel etc. (16.11.2, 16.11.3)\r\nâ€¢	Meggering of insulation of transformer of power supply equipment.  (16.11.6)\r\nâ€¢	Measurement of earth leakage currents of all power supplies\r\n', '2014-06-25 17:01:32'),
(48, 'F1', 14, 90, 182, 'â€¢	Checking that all fuses provided are of ND type / â€˜Dâ€™ type / â€˜Gâ€™ types as per requirement. (19.87.1)\r\nâ€¢	Visual inspection of fuse blown off indications & replacing with proper fuses if blown off. \r\nWhile commissioning or fuse Blown  - (19.87)\r\nâ€¢	Measuring & recording of normal load current of all circuits. \r\nâ€¢	Checking that fuse capacity is not less than 2.5 times the current and 1.25 times if two fuses are provided in parallel.  \r\nâ€¢	Measure the circuit current when fuse is blown & investigating if found more than initial value.\r\n', '2014-06-25 17:28:39'),
(49, 'F2', 14, 0, 0, 'Replacement of all types of fuses at all locations including of all relay circuits, signal lighting, power equipment and in locations.', '2014-06-25 17:29:02'),
(50, 'DG1', 15, 30, 90, 'Checking -\r\nâ€¢	Lubricating oil and maintain level (16.12.2)\r\nâ€¢	Leakage of fuel oil, lubricating oil and radiator water. (16.12.5)\r\nâ€¢	Radiator hose & fuel oil hose for leakage, replace in time and grease lubricate fan shaft. (16.12.6)\r\nâ€¢	Flexible coupling between the engine and the alternator for elongated holes and replace in time. (16.12.8)\r\nRunning DG set for 5-10 minutes on load to verify its proper working. (16.12.9)\r\n', '2014-06-25 17:29:21'),
(51, 'DG2', 15, 0, 365, 'â€¢	Cleaning of fuel tank. (16.12.1)\r\nâ€¢	Replace worn out fan shaft. (16.12.6)\r\nâ€¢	Maintain no load and on load voltages of alternator within limit and adjust Governor for steady output. (16.12.9)\r\nâ€¢	Check for 1000 Hours of run and promptly arrange for Overhauling of DG set (To be arranged through manufacturer or authorized one) (16.12.4)\r\n', '2014-06-25 17:29:42'),
(52, 'A1', 16, 30, 90, 'Cleaning and visual check of insulations and equipments installed in location boxes', '2014-06-25 17:30:02'),
(53, 'A2', 16, 0, 365, 'Verification of termination details of Apparatus cases and location boxes and cross protection arrangements on shelf type track repeater relays. \r\nWire count on terminals of the Shelf type relays and recorded. It should be done, whenever relay(s) is/are replaced.\r\n', '2014-06-25 17:30:40'),
(54, 'A3', 16, 0, 0, 'Meggering of cable by DSMG/Sectional JE/SE/SSE/ Incharge SSE/SE/JE as per the following schedule â€“\r\nâ€¢	Meggering of all main cables in dry weather for earth resistance and continuity test in Apparatus cases / location Boxes / Relay rooms / Huts, with 500 V Megger and keeping their records as per Performa. A comparison of the test results between two successive tests should be done and cause should be investigated and immediate steps taken if sudden fall in insulation is observed. The following schedule of periodicity to be followed for cable testing:- \r\nâ€¢	Initial -All conductors after laying then after 1st monsoon of the year- \r\nâ€¢	1st Year â€“ All conductors. Point Cable every year.\r\nâ€¢	2nd Year â€“ Nil \r\nâ€¢	3rd Year  - Nil\r\nâ€¢	4th Year  - Nil\r\nâ€¢	5th Year â€“ All conductors.\r\nâ€¢	6th Year - Spare conductors.\r\nâ€¢	7th Year - All conductors.\r\nâ€¢	8th Year - Spare conductors.\r\nâ€¢	9th Year - All conductors.\r\nâ€¢	10th Year onwards â€“Spare conductors Every Year and   \r\n-	All conductors â€“Alternate Year if insulation is more than 10 M Ohm/KM.\r\n-	Every Year if insulation is less than 10 M Ohm/KM.\r\nNote â€“ The conductors of the cables passes appreciable electrostatic capacity and may accumulate electrostatic charge. The cable conductors should be shorted or earthed to completely discharge any accumulated charge before and after connecting/disconnecting the insulation tester while commencing and after completion of the test, respectively. (15.23.1 Annexure 12). \r\n', '2014-06-25 17:32:32'),
(55, 'E1', 17, 30, 90, 'Checking that- \r\nâ€¢	All earth connections of block earth, Axle Counter, MUX and other equipment earth are intact. (19.105) (18.41.10) (18.57)\r\nâ€¢	Earth wire lead is not corroded and is well protected. (19.93.1)\r\nâ€¢	Nut connecting earth wires to electrode are not corroded. (19.93.1)\r\nâ€¢	Any other earth or system earth of electrical is not less than 20 meters away from the equipment earth. (19.100)\r\n', '2014-06-25 17:32:56'),
(56, 'E2', 17, 0, 365, 'Checking that â€“ \r\nâ€¢	Separate earth exists for each block. (18.6.1) (19.89)\r\nâ€¢	Different earthing conductors are insulated from each other and not less than 3 meter distanced. (19.91)  \r\nâ€¢	Measuring the value of earth resistance of the earthing provided for signaling circuit, improving earth resistance if found > 10 ohms by taking step including as indicated in SEM Para 19.92. (19.90) (18.57)\r\nâ€¢	Keeping records of the earth resistance measurement and painting its value on earth enclosures / nearest wall.\r\n', '2014-06-25 17:33:06'),
(57, 'AX1', 18, 30, 90, 'Outdoor Equipment â€“\r\nâ€¢	Checking of staggering of track devices and their fittings and connections. (1.1)\r\nâ€¢	Observing packing conditions of supporting sleepers and ensuring fittings do not vibrate under train and getting packed if required.  (1.4)\r\nâ€¢	Checking battery level, specific gravity & voltage and charging equipment.  (1.8)\r\nâ€¢	Checking & keeping track circuits, its connection, rail joints in good condition. (1.11)\r\n\r\nChecking and recording battery voltage, electrotype level, specific gravity, charging equipment & current. (2.7) (2.6)\r\n', '2014-06-25 17:33:40'),
(58, 'AX2', 18, 90, 182, 'Outdoor Equipment â€“\r\n\r\nâ€¢	Checking & tightening of all connections & screw couplers on the oscillator / receiver amplifier unit and wiring. (1.2,5,6)\r\nâ€¢	Checking & tightening Transmitter, Receiver housing, fittings & clamps.  (3.2,3)\r\nâ€¢	Ensuring TX / RX are at minimum 20 meters from nearest block joint.  (17.43.7)\r\nâ€¢	Measurement of Amplifier output voltage of all channels & keeping within limit.  (1.7)\r\nâ€¢	Measurement of charging current and keeping within limit.  Outdoor and indoor (1.9) (2.8)\r\nâ€¢	Checking oscillator output voltage, output level of receiver amplified (0.7â€“1.0 V) and indication lamps in resetting box lights in correct sequence.    (3.4 to 3.7)\r\n\r\nEvaluator Maintenance â€“\r\nâ€¢	Checking & tightening screw couplers. (2.1)\r\nâ€¢	Ensuring Reset switch is sealed & resetting entries tallies with counter. (2.11,12)\r\nâ€¢	Checking that indication lamps lights in correct sequence.  (2.3)\r\nâ€¢	Measurement and Recording of â€“\r\n-	All incoming channels & keeping within limit. (2.2)\r\n-	Evaluator Maintenance â€“\r\n\r\n- Coil voltages on EUR & SUPR in pick and   drop condition (shall not be ï€¾ 0.5V in drop condition). (2.5,2.6)\r\n     -  DC-DC converter output voltages. (2.9)\r\n\r\n', '2014-06-25 17:33:51'),
(59, 'AX3', 18, 0, 365, 'Evaluator Maintenance  and Checkingâ€“ (4)\r\nâ€¢	Verifying the counting with actual axles of a train. (2.4)\r\nâ€¢	5KHZ input signal of each channel for no interference & modulation. (4.2)\r\nâ€¢	Checking oscillator frequency & its sinusoidal wave shape. \r\nâ€¢	Safe working of Axle Counter with dummy wheel. (4.3)\r\nâ€¢	Working of trolley protection circuit. (4.4)\r\nâ€¢	With train in section EUR / SUPR are de-energized & voltages on relay terminals is less than 0.5 V(4.5)\r\nâ€¢	Switching ON / OFF of battery chargers does not register counts in evaluator. (4.6)\r\n', '2014-06-25 17:34:13'),
(60, 'B1 SINGLE LINE', 19, 30, 90, 'Checking for \r\nâ€¢	Locking & sealing. (18.41.1) (18.57)\r\nâ€¢	Proper working of SMâ€™s lock up key. (18.57)\r\nâ€¢	Full deflection of Needle indicator. (18.41.2) (18.57)\r\nâ€¢	Proper condition of electrical and mechanical locks and not liable to be forced. (18.41.1)(18.57)\r\nâ€¢	Checking & tightening of all terminal screws, lock nuts and locking screws, and split pins opened.  (18.41.8)(18.57)\r\nâ€¢	No burr on tokens and free movement of token indicator. (18.57) \r\nâ€¢	Token are not damaged / deformed. (18.33.1)\r\nâ€¢	Cleaning Rack & pinion teeth, oiling it and Token Pin with medium grade IS â€“ 1628 axle oil. (18.57) (18.48)\r\nâ€¢	The Block & Telephone batteries for cleanliness and voltages recorded in the card. (18.41.9) (18.57)\r\nâ€¢	The telephone and telephone chord.  (18.41.11) (18.57)\r\n', '2014-06-25 17:34:46'),
(61, 'B2 SINGLE LINE', 19, 30, 182, 'Checking for\r\nâ€¢	Effectiveness of lightening and power protection devices. (18.41.10)\r\nâ€¢	  The force drop arrangement of TCF & TGT locks. (18.57)\r\nâ€¢	Free movement of locks rocker arms     (Locks shall be 1 mm above the rack) and square-ness of   lock edge. (18.49) (18.57)\r\nâ€¢	The safety catch is in position and free to move about its fulcrum pin. (18.47) (18.57)\r\nâ€¢	Tightness of spigot. (18.57)\r\nâ€¢	Intactness of tablet releaser actuating link screws. (18.57)\r\nâ€¢	All wiring and the polarity of instruments. (18.57)  \r\nâ€¢	The contact surface and spring properly adjusted & their tensions. If pitted, cleaning them with chamois leather. (18.41.3,4) (18.57) \r\nâ€¢	Polarized relay returns to its normal position when no current is flowing. (18.41.5) (18.57)\r\n\r\nMeasuring the line current. (18.57)\r\n', '2014-06-25 17:35:03'),
(62, 'B3 SINGLE LINE', 19, 182, 365, 'Checking that â€“\r\nâ€¢	Checking that instrument is not due for overhauling (10 years periodicity) and maintaining Register of Block Instruments containing information â€“ the type of instrument, its serial number, location, and name of manufacturer, date of installation, date of last overhaul.  (18.31) (18.42) (18.57)\r\nâ€¢	Tones of bells are distinct when two or more instruments are provided. (18.57)\r\nâ€¢	Instrument is in level. (18.57)\r\n\r\nCarrying census of working tokens and keeping records in register of Block Instrument & Signal History Book.  (18.57)\r\n', '2014-06-25 17:35:25'),
(63, 'B4 SINGLE LINE', 19, 0, 365, 'Checking that â€“ \r\nâ€¢	Locking of pawl and notches in the rack are correctly shaped and square ended and width is 9.5 mm. (18.51, 53)\r\nâ€¢	Token receiver can receive only the token of the correct configuration. (18.57)\r\nâ€¢	Effectiveness of â€˜No Tokenâ€™ lock and handle does not turn to TGT when token indicator shows Red. (18.48)\r\nâ€¢	The condition of Block Instruments and are free from mechanical damage, corrosion, etc. (18.57)\r\n', '2014-06-25 17:35:35'),
(64, 'B1 DOUBLE LINE', 20, 30, 90, '', '2014-06-26 07:51:31'),
(65, 'B2 DOUBLE LINE', 20, 90, 182, '', '2014-06-26 07:51:55'),
(66, 'B3 DOUBLE LINE', 20, 182, 365, '', '2014-06-26 07:54:22'),
(67, 'B4 DOUBLE LINE', 20, 0, 365, '', '2014-06-26 07:55:05'),
(68, 'B1 SINGLE LINE (PUSH BUTTON TYPE)', 21, 30, 90, 'Checking for â€“\r\nâ€¢	Locking & sealing of all relays and counter. (18.41.1) (18.57)\r\nâ€¢	Tightness of all nuts / bolts.  (18.41.8)\r\nâ€¢	The Block & Telephone batteries for cleanliness and voltages recorded in the card. (18.41.9)\r\nâ€¢	The telephone and telephone chord. (18.41.11) (18.57)  \r\n', '2014-06-26 07:56:04'),
(69, 'B2 SINGLE LINE (PUSH BUTTON TYPE)', 21, 90, 182, 'â€¢	Effectiveness of lightening and power protection devices. (18.41.10)\r\nâ€¢	Checking for Push Buttons, Indicators, relays, bell & buzzer. (18.57)\r\nâ€¢	Measuring the line current\r\n', '2014-06-26 07:58:26'),
(70, 'B3 SINGLE LINE (PUSH BUTTON TYPE)', 21, 182, 365, 'Maintaining Register of Block Instruments containing information â€“ the type of instrument, its serial number, location, and name of manufacturer, date of installation, date of manufacture.  (18.31) \r\nâ€¢	Tones of bells are distinct when two or more instruments are provided. (18.57)\r\nâ€¢	Instrument is in level. (18.57)\r\n', '2014-06-26 07:58:59'),
(71, 'B4 SINGLE LINE (PUSH BUTTON TYPE)', 21, 0, 365, 'Checking that â€“ \r\nâ€¢	LSS is replaced to ON by the entry of a train into the block section and the same is maintained in the ON position until the train has cleared the block section and the instruments are brought back to the â€œLine Closedâ€ condition and fresh â€œLine Clearâ€ is obtained. (18.27)\r\nâ€¢	The Last Stop Signal at the sending station cannot be taken â€˜OFFâ€™ until the receiving station instrument is set to â€œTrain Coming Fromâ€ condition and the sending station instrument is set to â€œTrain Going Toâ€ condition. (18.25)\r\nâ€¢	Insulations between each individual insulated circuit and earth (shall not be < 10 M Ohm). (18.57)\r\nâ€¢	The condition of Block Instruments and are free from mechanical damage, corrosion, etc. (18.57)\r\n\r\nâ€¢	The Line Clear can be granted only when reception signals and the Last Stop Signal are proved at â€˜ONâ€™. (18.26)\r\nâ€¢	The opposing Last Stop Signals of the block section cannot be taken â€˜OFFâ€™ at one and the same time. (18.28)\r\nâ€¢	The circuit for proving the arrival of a train is directional. (18.29)\r\nâ€¢	Shunting key is released in Line Closed or TGT position. (18.30) (18.57)\r\n', '2014-06-26 07:59:16'),
(72, 'B1 (BPAC)', 22, 30, 90, 'Check â€“ \r\nâ€¢	All coupler connections, cable termination connection and MUX rack cable connections. \r\nâ€¢	Wires and button contacts on SMâ€™s Panel and SMDP Box connections.  \r\nâ€¢	Keeping record of each resetting, analyzing and taking corrective action.\r\n', '2014-06-26 10:05:25'),
(73, 'B2 (BPAC)', 22, 90, 182, 'Measurement of voltage levels of DC / DC converter and channels at MUX, keeping records and taking corrective action for proper adjustment and keeping within limits.', '2014-06-26 10:05:45'),
(74, 'B1 SINGLE LINE (HANDLE TYPE)', 23, 30, 90, '', '2014-06-26 10:06:15'),
(75, 'B2 SINGLE LINE (HANDLE TYPE)', 23, 90, 182, '', '2014-06-26 10:06:39'),
(76, 'B3 SINGLE LINE (HANDLE TYPE)', 23, 182, 365, '', '2014-06-26 10:07:00'),
(77, 'B4 SINGLE LINE (HANDLE TYPE)', 23, 0, 365, '', '2014-06-26 10:07:18'),
(78, 'LC1 POWER OPERATED', 24, 30, 90, 'â€¢	Checking â€“\r\n- The proper working of telephone. (14.3.7)\r\n     -  Machines are kept in good condition free from dust, rust & dirt. (14.3.2.1)\r\n     - The gearbox is filled with lubricating oil to its level. (14.3.10)\r\nâ€¢	Lubrication of all moving parts, gears and gate locks. (14.3.2.2 &9)\r\nâ€¢	Checking of audiovisual & approach warning. (14.3.2.10) (14.3.3) (14.3.10)\r\nâ€¢	Checking and cleaning of traffic lights, warning bell, boom light and operating panel.\r\nâ€¢	Visibility obstruction for road traffic. (14.2.1)\r\nâ€¢	Checking & cleaning of armature, contacts, proper adjustment of contacts. (14.3.10)\r\n', '2014-06-26 10:08:49'),
(79, 'LC2 POWER OPERATED', 24, 90, 182, 'Checking â€“\r\nâ€¢	Motor Carbons, tensions of carbon spring. (14.3.2.4)\r\nâ€¢	The adjustment of shock absorber. (14.3.10)\r\nâ€¢	The friction clutch declutches when the boom is fully raised or lowered. (14.3.2.5)\r\nâ€¢	Parallel operation and opening of gate. (14.3.1.6)\r\nâ€¢	Gate locks are properly fixed. (14.3.10)\r\nâ€¢	The integrity of interlocking & locking of gate boom. (14.3.10)\r\nâ€¢	The time of operation, voltage and operating current. (14.3.2.7)\r\nâ€¢	Motor peak & normal load while opening / closing. \r\nâ€¢	Checking of NX switch / Crank handle operation. (14.3.2.7 & 8)\r\nâ€¢	Machine foundation bolts, gearbox-fixing bolts, pulleys of motor & gearbox, clutch assembly.\r\nâ€¢	Balancing of weight bolts & booms bolts. \r\nâ€¢	Screws of ebonite cams of contacts. \r\nâ€¢	Whether the moon crank is butting against the shaft when boom is fully lowered.  (Also check whenever boom is replaced or mechanical adjustment done.)\r\n\r\n', '2014-06-26 10:09:08'),
(80, 'LC3 POWER OPERATED', 24, 182, 365, 'Checking the â€“\r\nâ€¢	Boom is perpendicular to road. (14.2.7)\r\nâ€¢	Alignment of boom stop with boom. (14.2.8)\r\nâ€¢	Clearance of boom from road (0.8 â€“ 1m). (14.2.9)\r\nâ€¢	Boom opening (80-85 degree). (14.2.10)\r\nâ€¢	Proper condition of red light at the center of boom. (14.2.41) \r\nâ€¢	Yellow reflector strips on all booms on outer road facing sides. (14.2.13).\r\n', '2014-06-26 10:09:38'),
(81, 'LC4 POWER OPERATED', 24, 0, 365, 'Checking the â€“\r\nâ€¢	Proper functioning and interlocking of Emergency Key Chain interlocking if provided.\r\nâ€¢	Approach locking and back locking. (14.3.3)\r\nâ€¢	Availability of gate working instructions in vernacular language & gate working diagram. (14.1.6)\r\nâ€¢	Annual testing of tail cable insulation & motor insulation. \r\nâ€¢	Cleaning of relays and contractor relays.\r\n\r\nMaintaining the Register of level crossing gate & recording details of section, class, location, number, type of gate, communication, interlocking arrangement, Type of boom interlocking, Emergency Key chain Working, approach warning, Road lights, Hooter, TWAD. (14.3.9)  \r\n', '2014-06-26 10:09:49'),
(82, 'LC1 MECHANICALLY OPERATED', 25, 30, 90, 'Checking the-\r\nâ€¢	Proper working of telephone. (14.3.7)\r\nâ€¢	Visual checking, oiling, greasing & graphing of gate mechanism, all moving parts and gate locks. (14.3.1.1  2 & 11)\r\nâ€¢	Wire / rodding, Transmission, road signal & its cleaning. (14.3.1.3) (14.3.10)\r\nâ€¢	Warning bell, audiovisual & approach warning. (14.3.1.12)\r\nâ€¢	The integrity of boom locking and â€˜Eâ€™ type lock locking the winch and its handle. (14.3.1.8 &10)\r\nâ€¢	Road Signal / bell. (14.2.30) \r\nâ€¢	Visibility obstruction for road traffic. (14.2.1)\r\n', '2014-06-26 10:11:07'),
(83, 'LC2 MECHANICALLY OPERATED', 25, 90, 182, 'â€¢	Proper adjustment of wire sags and tension, Counter weight adjustment. (14.3.1.7)\r\nâ€¢	Checking that â€“ \r\n-	Parallel operation and opening of gate. (14.3.1.6) \r\n-	Gate locks are properly fixed. (14.3.1.11)\r\n-	Proper working of â€Eâ€ type locks. (14.3.1.11)I\r\n-	Integrity of Interlocking, gate lock, key is not  \r\n  extracted in closed condition of gate. (14.2.36)\r\n', '2014-06-26 10:11:17'),
(84, 'LC3 MECHANICALLY OPERATED', 25, 182, 365, 'Cleaning of all pipes and ducts to prevent obstruction by accumulation of dirt. (14.3.1.3). Checking -\r\nâ€¢	Boom is perpendicular to road. (14.2.7)\r\nâ€¢	Alignment of boom stop with boom. (14.2.8)\r\nâ€¢	Clearance of boom from road (0.8 â€“ 1m). (14.2.9)\r\nâ€¢	Boom opening (80-85 degree). (14.2.10)\r\nâ€¢	Proper condition of red disc with reflector, or reflective strip at the center of boom. (14.2.12)\r\nâ€¢	Yellow reflector strips on all booms on outer road facing sides. (14.2.13)\r\n', '2014-06-26 10:11:29'),
(85, 'LC4 MECHANICALLY OPERATED', 25, 0, 365, 'Checking the â€“\r\nâ€¢	Proper working of Emergency Key Chain interlocking if provided. Approach locking, and back locking.\r\nâ€¢	Availability of gate working instructions in vernacular language & gate working diagram. (14.3.3) (14.1.6)\r\nMaintaining the Register of level crossing gate & recording details of section, class, location, number, type of gate, communication interlocking arrangement, Type of boom interlocking, Emergency Key chain Working, approach warning, Road lights, Hooter, TWAD. (14.3.9)\r\n', '2014-06-26 10:11:42'),
(86, 'MP1', 26, 14, 90, 'Cleaning and lubricating of moving parts.  Also checking point chairs are cleaned regularly by Permanent way staff. (12.165, 12.166.1)\r\nChecking â€“ \r\nâ€¢	The switches are housed properly against stock rail and checking spring on the switches is equally in the normal & reverse positions. (12.164.1)\r\nâ€¢	Tightness of Bolts & Nuts and arrange for tightening / replacing missing bolts and nuts of Flexible stretchers facing point lock & bar. Slack / Loose / crack fittings to be replaced. (12.164.3, 12.167)\r\nâ€¢	The points for obstruction test with 5 mm test piece & it shall not be possible for the lever working facing point to be latched & point get locked. (12.46).     \r\nDetector â€“\r\nâ€¢	Lubricating the detector slides thoroughly.  Checking the cross slides for any undue play.  Also checking the detectors are fixed rigidly. (12.172)\r\nâ€¢	Checking for obstruction test. â€“ Para 12.175\r\nChecking lock bar â€“ \r\nâ€¢	Lock bars are straight, true both horizontally & vertically and examining the driving pieces for looseness and lost motion. (12.170.1)\r\nâ€¢	The lock bar clips and stops for tightness and lubricating the bearing of clips. (12.170.2)\r\nChecking â€“ \r\nâ€¢	Lock Bar - lock bar lie 38mm below the top of the rail and flush with top of the rail, when lever is in mid stroke position. (12.171)\r\n', '2014-06-26 10:17:31'),
(87, 'MP2', 26, 90, 182, 'squaring and packing condition of sleepers under gauge tie plate and slide chair-fixing bolts. (12.163.2, 12.164.3)\r\nâ€¢	Visual checking regarding the condition of switches, sleepers, and gauge tie plate and condition of insulation of insulated rod joint. (12.163.1, 12.164.3, 12.161)   \r\nâ€¢	Detector \r\nâ€¢	Signal wires to the detectors are in alignment & check when the signal is returned to â€˜ONâ€™ all signals slides are traveling back to their stops. (12.66.3) \r\nâ€¢	 Detector slides are square and not eased beyond standard size. Notches in point slides are properly adjusted. (12.173)\r\nâ€¢	Cleaning and graphite of detector shoe and angle slides. (12.174)\r\nâ€¢	  Detector (DW)\r\nâ€¢	Detectors shall be so adjusted that that the notches in wheels are clear of the point slides and the clearance between the notches in the wheels and the point slides shall not be less than 50 mm and not more than 100 mm when the transmission is normal. (12.131.2)\r\nâ€¢	Protecting covers of all mechanisms and detectors shall be kept in good condition and securely fixed. (12.132)\r\n', '2014-06-26 10:17:54'),
(88, 'MP3', 26, 0, 90, 'Joint check with SE/SSE (P-Way), of points & crossing for condition of tongue rails, stock rails, leveling, squaring, creeping, packing, clearance of ballast & other P-Way fittings and drainage prior to monsoon etc. Measurement of LH, RH switch opening, as per SEM Para 12.40. (19.125) (19.127.8)\r\nSectional JE/SE/SSE & In-charge SSE/SE to carry out every alternate inspection.\r\n', '2014-06-26 10:18:18'),
(89, 'MP4', 26, 0, 365, 'â€¢	Cleaning, Overhauling of all lock bar clips, stops & guides and replacing wherever necessary. (12.170.3)\r\nâ€¢	Checking â€“ No two similar wards exist for conflicting trains movements for hand plunger lock, lever lock.\r\n', '2014-06-26 10:18:37'),
(90, 'MS1', 27, 14, 90, '', '2014-06-26 10:19:09'),
(91, 'MS2', 27, 90, 182, '', '2014-06-26 10:19:32'),
(92, 'MS3', 27, 182, 365, '', '2014-06-26 10:19:47'),
(93, 'MS4', 27, 0, 365, '', '2014-06-26 10:20:12'),
(94, 'C1', 28, 14, 90, '', '2014-06-26 10:20:34'),
(95, 'C2', 28, 90, 182, '', '2014-06-26 10:20:48'),
(96, 'C3', 28, 182, 365, '', '2014-06-26 10:21:00'),
(97, 'C4', 28, 0, 365, '', '2014-06-26 10:21:11'),
(98, 'C5', 28, 0, 1095, '', '2014-06-26 10:21:26'),
(99, 'MT1', 29, 14, 90, '', '2014-06-26 10:21:45'),
(100, 'MT2', 29, 90, 182, '', '2014-06-26 10:21:59'),
(101, 'MT3', 29, 182, 365, '', '2014-06-26 10:22:13'),
(102, 'MT4', 29, 0, 365, '', '2014-06-26 10:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_station_gear_master`
--

CREATE TABLE `nfr_station_gear_master` (
  `id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `gear_type_id` int(11) NOT NULL,
  `gear_no` varchar(60) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_station_gear_master`
--

INSERT INTO `nfr_station_gear_master` (`id`, `station_id`, `gear_type_id`, `gear_no`, `last_update`) VALUES
(1, 2, 1, 'PT003', '2015-09-04 10:08:09'),
(3, 2, 2, 'ED001', '2015-09-16 09:19:09'),
(4, 2, 2, 'ED002', '2015-09-23 12:44:28'),
(5, 2, 3, 'TC4511', '2015-09-23 12:47:05'),
(6, 3, 1, 'PT4551', '2015-09-23 12:47:21'),
(7, 2, 4, 'S3433A', '2015-09-23 13:01:21'),
(8, 3, 1, 'PT5644', '2015-09-23 13:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_station_master`
--

CREATE TABLE `nfr_station_master` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `code` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_station_master`
--

INSERT INTO `nfr_station_master` (`id`, `district_id`, `name`, `code`) VALUES
(2, 9, 'Dibrugarh', 'DBRG'),
(3, 9, 'Chalkhowa', 'CKW'),
(4, 26, 'Tinsukia', 'TSK(w)'),
(5, 9, 'Panitola', 'PNT'),
(6, 26, '', 'NTSK'),
(7, 26, '', 'TSK(E)'),
(8, 26, '', 'SPGN'),
(9, 26, '', 'CGF'),
(10, 26, '', 'DJG'),
(11, 26, '', 'NHK'),
(12, 26, '', 'NAM'),
(13, 26, '', 'BFD'),
(14, 9, '', 'SPK'),
(15, 9, '', 'MJN'),
(16, 9, '', 'TII'),
(17, 9, '', 'DBY'),
(18, 9, '', 'MRG'),
(19, 21, '', 'LLO'),
(20, 9, '', 'CHB'),
(21, 9, '', 'DKM'),
(22, 9, '', 'LHL'),
(23, 9, '', 'CKW'),
(24, 9, '', 'DBRG(N)'),
(25, 9, '', 'DBRT'),
(26, 9, '', 'FKG'),
(27, 9, '', 'KXL'),
(28, 9, '', 'TTB'),
(29, 9, '', 'MXN(W)'),
(30, 9, '', 'MXN(E)'),
(31, 9, '', 'NCH'),
(32, 9, '', 'SLX'),
(33, 9, '', 'AGI'),
(34, 9, '', 'NMT'),
(35, 9, '', 'SLGR'),
(36, 9, '', 'LXA'),
(37, 9, '', 'SFR'),
(38, 9, '', 'BOJ'),
(39, 9, '', 'CMA'),
(40, 9, '', 'JTTN'),
(41, 9, '', 'BLMR'),
(42, 9, '', 'BBGN'),
(43, 9, '', 'NMGY'),
(44, 9, '', 'NMGS'),
(45, 9, '', 'GLGT'),
(46, 9, '', 'DMGN'),
(47, 9, '', 'KOWN'),
(48, 9, '', 'MRHT'),
(49, 9, '', 'SRTN');

-- --------------------------------------------------------

--
-- Table structure for table `nfr_user_master`
--

CREATE TABLE `nfr_user_master` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `mobile` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `designation` varchar(80) NOT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user',
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nfr_user_master`
--

INSERT INTO `nfr_user_master` (`id`, `name`, `email`, `mobile`, `password`, `designation`, `user_type`, `role_id`, `status`, `created`, `last_update`) VALUES
(1, 'Glomindz', 'support@glomindz.com', '9854087006', '88f2dccb02b2a20615211e5492f85204', 'Developer', 'admin', 3, 1, '2014-06-19', '2014-06-19 11:24:08'),
(2, 'Kallol Pratim Saikia', 'kallol.saikia@glomindz.com', '9706913741', '88f2dccb02b2a20615211e5492f85204', 'Sub Admin', 'user', 1, 1, '0000-00-00', '2015-09-06 13:41:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gear_history`
--
ALTER TABLE `gear_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_district_master`
--
ALTER TABLE `nfr_district_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_gear_type_master`
--
ALTER TABLE `nfr_gear_type_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_jp_crossing_inspection_ledger`
--
ALTER TABLE `nfr_jp_crossing_inspection_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_maintenance_schedule_ledger`
--
ALTER TABLE `nfr_maintenance_schedule_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_maintenance_schedule_ledger_1`
--
ALTER TABLE `nfr_maintenance_schedule_ledger_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_reset_password`
--
ALTER TABLE `nfr_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_role_master`
--
ALTER TABLE `nfr_role_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_schedule_code_master`
--
ALTER TABLE `nfr_schedule_code_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `nfr_station_gear_master`
--
ALTER TABLE `nfr_station_gear_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_station_master`
--
ALTER TABLE `nfr_station_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfr_user_master`
--
ALTER TABLE `nfr_user_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gear_history`
--
ALTER TABLE `gear_history`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `nfr_gear_type_master`
--
ALTER TABLE `nfr_gear_type_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `nfr_jp_crossing_inspection_ledger`
--
ALTER TABLE `nfr_jp_crossing_inspection_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nfr_maintenance_schedule_ledger`
--
ALTER TABLE `nfr_maintenance_schedule_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nfr_maintenance_schedule_ledger_1`
--
ALTER TABLE `nfr_maintenance_schedule_ledger_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nfr_reset_password`
--
ALTER TABLE `nfr_reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nfr_role_master`
--
ALTER TABLE `nfr_role_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nfr_schedule_code_master`
--
ALTER TABLE `nfr_schedule_code_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `nfr_station_gear_master`
--
ALTER TABLE `nfr_station_gear_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `nfr_station_master`
--
ALTER TABLE `nfr_station_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `nfr_user_master`
--
ALTER TABLE `nfr_user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
