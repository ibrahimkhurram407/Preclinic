-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2020 at 02:34 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `master`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`username`, `password`) VALUES
('admin', 'admin');
-- --------------------------------------------------------

--
-- Table structure for table `appointmenttb`
--

CREATE TABLE `appointmenttb` (
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `doctor` varchar(30) NOT NULL,
  `docFees` int(5) NOT NULL,
  `appdate` date NOT NULL,
  `userStatus` int(5) NOT NULL,
  `doctorStatus` int(5) NOT NULL
);

--
-- Dumping data for table `appointmenttb`
--

INSERT INTO `appointmenttb` (`pid`, `ID`, `fname`, `lname`, `gender`, `email`, `contact`, `doctor`, `docFees`, `appdate`, `userStatus`, `doctorStatus`) VALUES
(1, 1, 'Abdul', 'Rehman', 'Male', 'abdul.rehman@gmail.com', '0301123456', 'aliahmed', 2000, '2023-12-15', 0, 1),
(1, 2, 'Abdul', 'Rehman', 'Male', 'abdul.rehman@gmail.com', '0301123456', 'aliahmed', 2000, '2023-12-20', 1, 0),
(1, 3, 'Abdul', 'Rehman', 'Male', 'abdul.rehman@gmail.com', '0301123456', 'aliahmed', 2000, '2023-12-25', 1, 1),
(2, 4, 'Saima', 'Ali', 'Female', 'saima.ali@gmail.com', '0312123456', 'usmankhan', 2500, '2023-12-18', 0, 1),
(2, 5, 'Saima', 'Ali', 'Female', 'saima.ali@gmail.com', '0312123456', 'usmankhan', 2500, '2023-12-23', 1, 0),
(2, 6, 'Saima', 'Ali', 'Female', 'saima.ali@gmail.com', '0312123456', 'usmankhan', 2500, '2023-12-28', 1, 1),
(3, 7, 'Rizwan', 'Khan', 'Male', 'rizwan.khan@gmail.com', '0323123456', 'sarakhan', 1800, '2023-12-17', 0, 1),
(3, 8, 'Rizwan', 'Khan', 'Male', 'rizwan.khan@gmail.com', '0323123456', 'sarakhan', 1800, '2023-12-22', 1, 0),
(3, 9, 'Rizwan', 'Khan', 'Male', 'rizwan.khan@gmail.com', '0323123456', 'sarakhan', 1800, '2023-12-27', 1, 1),
(4, 10, 'Saba', 'Ahmed', 'Female', 'saba.ahmed@gmail.com', '0334123456', 'farahali', 2200, '2023-12-14', 0, 1),
(4, 11, 'Saba', 'Ahmed', 'Female', 'saba.ahmed@gmail.com', '0334123456', 'farahali', 2200, '2023-12-19', 1, 0),
(4, 12, 'Saba', 'Ahmed', 'Female', 'saba.ahmed@gmail.com', '0334123456', 'farahali', 2200, '2023-12-24', 1, 1),
(5, 13, 'Imran', 'Bashir', 'Male', 'imran.bashir@gmail.com', '0345123456', 'ahmedmalik', 2600, '2023-12-16', 0, 1),
(5, 14, 'Imran', 'Bashir', 'Male', 'imran.bashir@gmail.com', '0345123456', 'ahmedmalik', 2600, '2023-12-21', 1, 0),
(5, 15, 'Imran', 'Bashir', 'Male', 'imran.bashir@gmail.com', '0345123456', 'ahmedmalik', 2600, '2023-12-26', 1, 1),
(6, 16, 'Nida', 'Malik', 'Female', 'nida.malik@gmail.com', '0356123456', 'ayeshakhan', 2400, '2023-12-14', 0, 1),
(6, 17, 'Nida', 'Malik', 'Female', 'nida.malik@gmail.com', '0356123456', 'ayeshakhan', 2400, '2023-12-19', 1, 0),
(6, 18, 'Nida', 'Malik', 'Female', 'nida.malik@gmail.com', '0356123456', 'ayeshakhan', 2400, '2023-12-24', 1, 1),
(7, 19, 'Ali', 'Fatima', 'Male', 'ali.fatima@gmail.com', '0367123456', 'tariqahmed', 2100, '2023-12-16', 0, 1),
(7, 20, 'Ali', 'Fatima', 'Male', 'ali.fatima@gmail.com', '0367123456', 'tariqahmed', 2100, '2023-12-21', 1, 0),
(7, 21, 'Ali', 'Fatima', 'Male', 'ali.fatima@gmail.com', '0367123456', 'tariqahmed', 2100, '2023-12-26', 1, 1),
(8, 22, 'Ayesha', 'Mansoor', 'Female', 'ayesha.mansoor@gmail.com', '0378123456', 'nadiamalik', 2300, '2023-12-14', 0, 1),
(8, 23, 'Ayesha', 'Mansoor', 'Female', 'ayesha.mansoor@gmail.com', '0378123456', 'nadiamalik', 2300, '2023-12-19', 1, 0),
(8, 24, 'Ayesha', 'Mansoor', 'Female', 'ayesha.mansoor@gmail.com', '0378123456', 'nadiamalik', 2300, '2023-12-24', 1, 1),
(9, 25, 'Kamran', 'Yousaf', 'Male', 'kamran.yousaf@gmail.com', '0389123456', 'bilalkhan', 2800, '2023-12-16', 0, 1),
(9, 26, 'Kamran', 'Yousaf', 'Male', 'kamran.yousaf@gmail.com', '0389123456', 'bilalkhan', 2800, '2023-12-21', 1, 0),
(9, 27, 'Kamran', 'Yousaf', 'Male', 'kamran.yousaf@gmail.com', '0389123456', 'bilalkhan', 2800, '2023-12-26', 1, 1),
(10, 28, 'Fariha', 'Saeed', 'Female', 'fariha.saeed@gmail.com', '0399123456', 'rabiaahmed', 1900, '2023-12-14', 0, 1),
(10, 29, 'Fariha', 'Saeed', 'Female', 'fariha.saeed@gmail.com', '0399123456', 'rabiaahmed', 1900, '2023-12-19', 1, 0),
(10, 30, 'Fariha', 'Saeed', 'Female', 'fariha.saeed@gmail.com', '0399123456', 'rabiaahmed', 1900, '2023-12-24', 1, 1);




-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `contact`, `message`) VALUES
('Ayesha Mansoor', 'ayesha.mansoor@gmail.com', '03891234567', 'Do you have any promotions or discounts on medical services currently?'),
('Kamran Yousaf', 'kamran.yousaf@gmail.com', '03991234567', 'I have a suggestion for improving the medical services. Are you open to feedback?'),
('Fariha Saeed', 'fariha.saeed@gmail.com', '03001234568', 'Just wanted to say your medical staff is fantastic! They were very helpful during my recent visit.'),
('Saima Ali', 'saima.ali@gmail.com', '03121234567', 'Hello! I am interested in your hospitals services. Can you share details about the facilities and healthcare professionals available?'),
('Abdul Rehman', 'abdul.rehman@gmail.com', '03011234567', 'I have a question about your medical services. Can you please provide more information about available treatments and specialists?');

-- --------------------------------------------------------

--
-- Table structure for table `doctb`
--

CREATE TABLE `doctb` (
  `id` int PRIMARY Key  AUTO_INCREMENT NOT NULL,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `spec` varchar(50) NOT NULL,
  `docFees` int(10) NOT NULL
);

--
-- Dumping data for table `doctb`
--
INSERT INTO `doctb` (`username`, `password`, `email`, `city`, `spec`, `docFees`) VALUES
('aliahmed', 'Ali123', 'ali@gmail.com', 'Lahore', 'Cardiologist', 2000),
('usmankhan', 'Usman123', 'usman@gmail.com', 'Karachi', 'Orthopedic Surgeon', 2500),
('sarakhan', 'Sara123', 'sara@gmail.com', 'Islamabad', 'Dermatologist', 1800),
('farahali', 'Farah123', 'farah@gmail.com', 'Gujranwala', 'Pediatrician', 2200),
('ahmedmalik', 'Ahmed123', 'ahmed@gmail.com', 'Karachi', 'Neurologist', 2600),
('ayeshakhan', 'Ayesha123', 'ayesha@gmail.com', 'Multan', 'Gynecologist', 2400),
('tariqahmed', 'Tariq123', 'tariq@gmail.com', 'Lahore', 'Cardiologist', 2100),
('nadiamalik', 'Nadia123', 'nadia@gmail.com', 'Karachi', 'ENT Specialist', 2300),
('bilalkhan', 'Bilal123', 'bilal@gmail.com', 'Peshawar', 'Psychiatrist', 2800),
('rabiaahmed', 'Rabia123', 'rabia@gmail.com', 'Quetta', 'Dentist', 1900);

-- --------------------------------------------------------

--
-- Table structure for table `availabilitytb`
--

CREATE TABLE `availabilitytb` (
  `id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `doctor_id` int NOT NULL,
  `date` DATE,
  FOREIGN KEY (`doctor_id`) REFERENCES `doctb` (`id`)
);


--
-- Dumping data for table `availabilitytb`
--

INSERT INTO `availabilitytb` (`doctor_id`, `date`) VALUES
(1, '2024-01-01'),
(2, '2024-01-02'),
(3, '2024-01-03'),
(4, '2024-01-04'),
(5, '2024-01-05'),
(6, '2024-01-06'),
(7, '2024-01-07'),
(8, '2024-01-08'),
(9, '2024-01-09'),
(10, '2024-01-10');

--
-- Table structure for table `patreg`
--

CREATE TABLE `patreg` (
  `pid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL UNIQUE, -- Add UNIQUE constraint for email
  `contact` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL,
  UNIQUE KEY `unique_email` (`email`) -- Optional: Naming the unique constraint
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `patreg`
--

INSERT INTO `patreg` (`pid`, `fname`, `lname`, `gender`, `email`, `contact`, `address`, `password`, `cpassword`) VALUES
(1, 'Abdul', 'Rehman', 'Male', 'abdul.rehman@gmail.com', '03011234567', '456 Garden Road, Karachi', 'abdul123', 'abdul123'),
(2, 'Saima', 'Ali', 'Female', 'saima.ali@gmail.com', '03121234567', '789 Lakeview Street, Islamabad', 'saima123', 'saima123'),
(3, 'Rizwan', 'Khan', 'Male', 'rizwan.khan@gmail.com', '03231234567', '123 Hilltop Avenue, Lahore', 'rizwan123', 'rizwan123'),
(4, 'Saba', 'Ahmed', 'Female', 'saba.ahmed@gmail.com', '03341234567', '234 Skyline Boulevard, Multan', 'saba123', 'saba123'),
(5, 'Imran', 'Bashir', 'Male', 'imran.bashir@gmail.com', '03451234567', '567 Park Lane, Rawalpindi', 'imran123', 'imran123'),
(6, 'Nida', 'Malik', 'Female', 'nida.malik@gmail.com', '03561234567', '890 Crescent Road, Faisalabad', 'nida123', 'nida123'),
(7, 'Ali', 'Fatima', 'Male', 'ali.fatima@gmail.com', '03671234567', '345 Avenue, Peshawar', 'ali123', 'ali123'),
(8, 'Ayesha', 'Mansoor', 'Female', 'ayesha.mansoor@gmail.com', '03781234567', '678 Street, Quetta', 'ayesha123', 'ayesha123'),
(9, 'Kamran', 'Yousaf', 'Male', 'kamran.yousaf@gmail.com', '03891234567', '789 Hilltop Road, Sialkot', 'kamran123', 'kamran123'),
(10, 'Fariha', 'Saeed', 'Female', 'fariha.saeed@gmail.com', '03991234567', '890 Park Street, Gujranwala', 'fariha123', 'fariha123');


-- --------------------------------------------------------

--
-- Table structure for table `prestb`
--

CREATE TABLE `prestb` (
  `doctor` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `appdate` date NOT NULL,
  `disease` varchar(250) NOT NULL,
  `allergy` varchar(250) NOT NULL,
  `prescription` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prestb`
--

INSERT INTO `prestb` (`doctor`, `pid`, `ID`, `fname`, `lname`, `appdate`, `disease`, `allergy`, `prescription`) VALUES
('aliahmed', 1, 1, 'Abdul', 'Rehman', '2023-12-27', 'Fever', 'None', 'Take Ibuprofen and get plenty of rest'),
('usmankhan', 2, 2, 'Saima', 'Ali', '2023-12-27', 'Headache', 'Aspirin allergy', 'Avoid aspirin, take Acetaminophen for headache'),
('sarakhan', 3, 3, 'Rizwan', 'Khan', '2023-12-27', 'Stomachache', 'None', 'Take antacids and avoid spicy food'),
('farahali', 4, 4, 'Saba', 'Ahmed', '2023-12-27', 'Sprained ankle', 'None', 'Rest, ice, compression, and elevation (RICE)'),
('ahmedmalik', 5, 5, 'Imran', 'Bashir', '2023-12-27', 'Migraine', 'None', 'Prescribe Sumatriptan for migraine relief'),
('ayeshakhan', 6, 6, 'Nida', 'Malik', '2023-12-27', 'Allergies', 'Pollen', 'Prescribe Loratadine for allergy relief'),
('tariqahmed', 7, 7, 'Ali', 'Fatima', '2023-12-27', 'High Blood Pressure', 'None', 'Prescribe Lisinopril for blood pressure'),
('nadiamalik', 8, 8, 'Ayesha', 'Mansoor', '2023-12-27', 'Gastritis', 'None', 'Prescribe Omeprazole for gastritis relief'),
('bilalkhan', 9, 9, 'Kamran', 'Yousaf', '2023-12-27', 'Kidney Stones', 'None', 'Recommend increased water intake and pain management'),
('rabiaahmed', 10, 10, 'Fariha', 'Saeed', '2023-12-27', 'Diabetes', 'None', 'Prescribe Metformin for diabetes management');


--
-- Indexes for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patreg`
--
ALTER TABLE `patreg`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `patreg`
--
ALTER TABLE `patreg`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `availabilitytb`
DROP FOREIGN KEY `availabilitytb_ibfk_1`;

COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;