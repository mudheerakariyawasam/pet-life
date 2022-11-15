-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2022 at 06:53 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` varchar(15) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(15) NOT NULL,
  `vet_id` varchar(15) NOT NULL,
  `pet_id` varchar(15) NOT NULL,
  `appointment_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batch_id` varchar(15) NOT NULL,
  `medicine_id` varchar(15) NOT NULL,
  `batch_qty` int(10) NOT NULL,
  `batch_price` int(10) NOT NULL,
  `batch_expdate` date NOT NULL,
  `batch_mfddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daycare`
--

CREATE TABLE `daycare` (
  `daycare_id` varchar(15) NOT NULL,
  `daycare_date` date NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `checkin_time` varchar(15) NOT NULL,
  `checkout_time` varchar(15) NOT NULL,
  `pet_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` varchar(15) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `emp_contactno` int(10) NOT NULL,
  `emp_designation` varchar(15) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_nic` varchar(12) NOT NULL,
  `emp_dateassigned` date NOT NULL,
  `emp_pwd` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_qualifications`
--

CREATE TABLE `employee_qualifications` (
  `qualification_id` varchar(15) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `validity period` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `holiday_id` varchar(15) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `approval_stage` varchar(15) NOT NULL,
  `emp_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` varchar(15) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `medicine_brand` varchar(255) NOT NULL,
  `medicine_category` varchar(255) NOT NULL,
  `medicine_usage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meetup`
--

CREATE TABLE `meetup` (
  `meetup_id` varchar(15) NOT NULL,
  `meetup_date` date NOT NULL,
  `meetup_slots` int(10) NOT NULL,
  `employee_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meetup_slot`
--

CREATE TABLE `meetup_slot` (
  `meetup_slot_id` varchar(15) NOT NULL,
  `meetup_id` varchar(15) NOT NULL,
  `pet_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` varchar(15) NOT NULL,
  `owner_id` varchar(15) DEFAULT NULL,
  `emp_id` varchar(15) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_itemdetails`
--

CREATE TABLE `order_itemdetails` (
  `id` int(11) NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `item_id` varchar(15) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_medicinedetails`
--

CREATE TABLE `order_medicinedetails` (
  `id` int(11) NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `batch_id` varchar(15) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_paymentdetails`
--

CREATE TABLE `order_paymentdetails` (
  `payment_id` int(15) NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_references`
--

CREATE TABLE `payment_references` (
  `ref_id` int(11) NOT NULL,
  `treatment_type` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `pet_id` varchar(15) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_gender` varchar(15) NOT NULL,
  `pet_dob` date NOT NULL,
  `pet_type` varchar(15) NOT NULL,
  `pet_breed` varchar(15) NOT NULL,
  `owner_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pet_item`
--

CREATE TABLE `pet_item` (
  `item_id` varchar(15) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_brand` varchar(255) NOT NULL,
  `item_qty` int(15) NOT NULL,
  `item_price` int(15) NOT NULL,
  `item_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pet_owner`
--

CREATE TABLE `pet_owner` (
  `owner_id` varchar(15) NOT NULL,
  `owner_fname` varchar(255) NOT NULL,
  `owner_lname` int(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `owner_contactno` int(10) NOT NULL,
  `owner_address` varchar(255) NOT NULL,
  `owner_nic` varchar(12) NOT NULL,
  `owner_pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatment_id` varchar(15) NOT NULL,
  `vet_id` varchar(15) NOT NULL,
  `assistant_id` varchar(15) DEFAULT NULL,
  `pet_id` varchar(15) DEFAULT NULL,
  `treatment_type` varchar(255) NOT NULL,
  `clinical_symptoms` varchar(255) NOT NULL,
  `lab_investigations` varchar(255) DEFAULT NULL,
  `differential_diagnosis` varchar(255) DEFAULT NULL,
  `definitive_diagnosis` varchar(255) DEFAULT NULL,
  `followup_date` date DEFAULT NULL,
  `special_comments` varchar(255) DEFAULT NULL,
  `treatment_bill` int(15) NOT NULL,
  `treatment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `treat_medicine`
--

CREATE TABLE `treat_medicine` (
  `treatment_id` varchar(15) NOT NULL,
  `batch_id` varchar(15) NOT NULL,
  `qty` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `daycare`
--
ALTER TABLE `daycare`
  ADD PRIMARY KEY (`daycare_id`),
  ADD KEY `pet_id` (`pet_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_nic` (`emp_nic`);

--
-- Indexes for table `employee_qualifications`
--
ALTER TABLE `employee_qualifications`
  ADD PRIMARY KEY (`qualification_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`holiday_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `meetup`
--
ALTER TABLE `meetup`
  ADD PRIMARY KEY (`meetup_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `meetup_slot`
--
ALTER TABLE `meetup_slot`
  ADD PRIMARY KEY (`meetup_slot_id`),
  ADD KEY `meetup_id` (`meetup_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `order_itemdetails`
--
ALTER TABLE `order_itemdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `order_medicinedetails`
--
ALTER TABLE `order_medicinedetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `order_paymentdetails`
--
ALTER TABLE `order_paymentdetails`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `payment_references`
--
ALTER TABLE `payment_references`
  ADD PRIMARY KEY (`ref_id`),
  ADD UNIQUE KEY `treatment_type` (`treatment_type`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `pet_item`
--
ALTER TABLE `pet_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `pet_owner`
--
ALTER TABLE `pet_owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `owner_nic` (`owner_nic`),
  ADD UNIQUE KEY `owner_email` (`owner_email`),
  ADD UNIQUE KEY `owner_contactno` (`owner_contactno`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatment_id`),
  ADD KEY `assistant_id` (`assistant_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `treat_medicine`
--
ALTER TABLE `treat_medicine`
  ADD PRIMARY KEY (`treatment_id`,`batch_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_itemdetails`
--
ALTER TABLE `order_itemdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_medicinedetails`
--
ALTER TABLE `order_medicinedetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`);

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`);

--
-- Constraints for table `daycare`
--
ALTER TABLE `daycare`
  ADD CONSTRAINT `daycare_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`),
  ADD CONSTRAINT `daycare_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `employee_qualifications`
--
ALTER TABLE `employee_qualifications`
  ADD CONSTRAINT `employee_qualifications_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `holiday`
--
ALTER TABLE `holiday`
  ADD CONSTRAINT `holiday_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `meetup`
--
ALTER TABLE `meetup`
  ADD CONSTRAINT `meetup_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `meetup_slot`
--
ALTER TABLE `meetup_slot`
  ADD CONSTRAINT `meetup_slot_ibfk_1` FOREIGN KEY (`meetup_id`) REFERENCES `meetup` (`meetup_id`),
  ADD CONSTRAINT `meetup_slot_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `pet_owner` (`owner_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `order_itemdetails`
--
ALTER TABLE `order_itemdetails`
  ADD CONSTRAINT `order_itemdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`order_id`),
  ADD CONSTRAINT `order_itemdetails_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `pet_item` (`item_id`);

--
-- Constraints for table `order_medicinedetails`
--
ALTER TABLE `order_medicinedetails`
  ADD CONSTRAINT `order_medicinedetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`order_id`),
  ADD CONSTRAINT `order_medicinedetails_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`);

--
-- Constraints for table `order_paymentdetails`
--
ALTER TABLE `order_paymentdetails`
  ADD CONSTRAINT `order_paymentdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_details` (`order_id`),
  ADD CONSTRAINT `order_paymentdetails_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `pet_owner` (`owner_id`);

--
-- Constraints for table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`assistant_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `treatment_ibfk_2` FOREIGN KEY (`vet_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `treatment_ibfk_3` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`);

--
-- Constraints for table `treat_medicine`
--
ALTER TABLE `treat_medicine`
  ADD CONSTRAINT `treat_medicine_ibfk_1` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`),
  ADD CONSTRAINT `treat_medicine_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
