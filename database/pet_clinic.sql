-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2023 at 06:46 PM
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

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `medicine_id`, `batch_qty`, `batch_price`, `batch_expdate`, `batch_mfddate`) VALUES
('B001', 'M003', 45, 5000, '2020-05-20', '2024-05-20');

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
  `emp_pwd` varchar(15) NOT NULL,
  `emp_initsalary` int(11) DEFAULT NULL,
  `emp_currsalary` int(11) DEFAULT NULL,
  `emp_holtaken` int(11) DEFAULT NULL,
  `emp_dateassigned` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_address`, `emp_contactno`, `emp_designation`, `emp_email`, `emp_nic`, `emp_pwd`, `emp_initsalary`, `emp_currsalary`, `emp_holtaken`, `emp_dateassigned`) VALUES
('E001', 'Mudheera', 'Galle', 770377558, 'Store manager', 'mudheera@gmail.com', '200068700193', 'Mudheera@123', NULL, NULL, NULL, '2023-02-04'),
('E002', 'erho', 'ihni', 2147483647, 'gbuu', 'buu@uuvb.com', '20079300650', 'uER@12', NULL, NULL, NULL, '2023-02-04'),
('E003', 'Uthpalani', 'Jayasinghe', 763361822, 'Pet owner', 'hbiweri@gmail.com', '200079300637', 'Kakka1234@', NULL, NULL, NULL, '2023-02-04'),
('E004', 'Sandun Chathuranga', 'Alpitiya', 771234561, 'Admin', 'admin@gmail.com', '9846531222', 'admin@123', 75000, 80000, 3, '2023-02-04'),
('E005', 'Senuri Dilshara', 'Colombo Dote', 777894564, 'Veterinarian', 'vet@gmail.com', '200068700456', 'vet@123', 50000, 60000, 3, '2023-02-04');

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
-- Table structure for table `lab_investigations`
--

CREATE TABLE `lab_investigations` (
  `lab_id` varchar(15) NOT NULL,
  `lab_name` varchar(15) NOT NULL,
  `lab_price` int(11) NOT NULL
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

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `medicine_name`, `medicine_brand`, `medicine_category`, `medicine_usage`) VALUES
('M001', 'dsdfa', 'asdfsadf', 'Pet Food', 'asdfadsfsadfasdfasdfasdf'),
('M002', 'dsdfa', 'asdfsadf', 'Pet Food', 'asdfadsfsadfasdfasdfasdf'),
('M003', 'Domperidon', 'Meenty', 'Pet Food', 'Swelling'),
('M004', 'acepromazine', 'Silverstone', 'Pet Food', 'sedative, tranquilizer, and antiemetic.');

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
-- Table structure for table `payment_treatment`
--

CREATE TABLE `payment_treatment` (
  `id` int(11) NOT NULL,
  `treatment_id` varchar(15) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `payment_method` varchar(15) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`pet_id`, `pet_name`, `pet_gender`, `pet_dob`, `pet_type`, `pet_breed`, `owner_id`) VALUES
('P001', 'Blacky', 'Male', '2007-02-10', 'Dog', 'None', 'O001');

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

--
-- Dumping data for table `pet_item`
--

INSERT INTO `pet_item` (`item_id`, `item_name`, `item_brand`, `item_qty`, `item_price`, `item_category`) VALUES
('I001', 'Whiskers-500g', 'Carly', 35, 2500, 'Pet Food'),
('I002', 'Whsikers - 250g', 'Carly', 35, 2000, 'Pet Food'),
('I003', 'Pedigree - 500g', 'Confortee', 40, 3000, 'Pet Food'),
('I004', 'Sleeping Bed - Cats', 'Marble', 10, 1500, 'Sleeping Items'),
('I005', 'Cat Collars - small', 'Marble Store', 12, 850, 'Collars'),
('I006', 'Whiskers-500g', 'Carly', 40, 1550, 'Other'),
('I007', 'Sleeping Bed - Cats', 'Marble', 35, 2000, 'Sleeping Items'),
('I008', 'Sleeping Bed - Cats', 'Marble', 25, 2500, 'Sleeping Items');

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

--
-- Dumping data for table `pet_owner`
--

INSERT INTO `pet_owner` (`owner_id`, `owner_fname`, `owner_lname`, `owner_email`, `owner_contactno`, `owner_address`, `owner_nic`, `owner_pwd`) VALUES
('O001', 'Mudheera', 123, 'mudheera@gmail.com', 770377558, 'Galle', '`20006870193', 'Mudheera@123');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `treatment_id` varchar(15) NOT NULL,
  `medicine_name` varchar(15) NOT NULL,
  `qty` int(11) NOT NULL
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
  `followup_date` date DEFAULT NULL,
  `special_comments` varchar(255) DEFAULT NULL,
  `treatment_bill` int(15) NOT NULL,
  `treatment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatment_id`, `vet_id`, `assistant_id`, `pet_id`, `followup_date`, `special_comments`, `treatment_bill`, `treatment_date`) VALUES
('T001', 'E002', 'E003', 'P001', '2022-11-30', 'gasdkljfhadsj', 1200, '0000-00-00 00:00:00'),
('T002', 'E002', 'E003', 'P001', '2022-11-30', 'gasdkljfhadsj', 1200, '2022-11-22 18:30:00'),
('T003', 'E002', 'E003', 'P001', '2022-11-30', 'gasdkljfhadsj', 1500, '2022-11-22 18:30:00'),
('T004', 'E002', 'E003', 'P001', '2022-11-30', 'gasdkljfhadsj', 1200, '2022-11-22 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_lab`
--

CREATE TABLE `treatment_lab` (
  `id` int(11) NOT NULL,
  `treatment_id` varchar(15) NOT NULL,
  `lab_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_medicine`
--

CREATE TABLE `treatment_medicine` (
  `id` int(11) NOT NULL,
  `treatment_id` varchar(15) NOT NULL,
  `batch_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_type`
--

CREATE TABLE `treatment_type` (
  `id` int(11) NOT NULL,
  `treatment_id` varchar(15) DEFAULT NULL,
  `treatment_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treatment_type`
--

INSERT INTO `treatment_type` (`id`, `treatment_id`, `treatment_type`) VALUES
(3, 'T003', 'surgery'),
(4, 'T003', 'vaccination'),
(5, 'T003', 'dental'),
(6, 'T003', 'treatment'),
(7, 'T003', 'surgery'),
(8, 'T003', 'treatment');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_vaccine`
--

CREATE TABLE `treatment_vaccine` (
  `id` int(11) NOT NULL,
  `treatment_id` varchar(10) NOT NULL,
  `batch_id` varchar(15) NOT NULL
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
-- Indexes for table `lab_investigations`
--
ALTER TABLE `lab_investigations`
  ADD PRIMARY KEY (`lab_id`);

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
-- Indexes for table `payment_treatment`
--
ALTER TABLE `payment_treatment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `treatment_id` (`treatment_id`);

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
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `FOREIGN EY` (`treatment_id`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatment_id`),
  ADD KEY `assistant_id` (`assistant_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `treatment_lab`
--
ALTER TABLE `treatment_lab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treatment_id` (`treatment_id`),
  ADD KEY `lab_id` (`lab_id`);

--
-- Indexes for table `treatment_medicine`
--
ALTER TABLE `treatment_medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treatment_id` (`treatment_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `treatment_type`
--
ALTER TABLE `treatment_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treatment_id` (`treatment_id`);

--
-- Indexes for table `treatment_vaccine`
--
ALTER TABLE `treatment_vaccine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treatment_id` (`treatment_id`);

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
-- AUTO_INCREMENT for table `payment_treatment`
--
ALTER TABLE `payment_treatment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment_lab`
--
ALTER TABLE `treatment_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment_medicine`
--
ALTER TABLE `treatment_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment_type`
--
ALTER TABLE `treatment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `treatment_vaccine`
--
ALTER TABLE `treatment_vaccine`
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
-- Constraints for table `payment_treatment`
--
ALTER TABLE `payment_treatment`
  ADD CONSTRAINT `payment_treatment_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `payment_treatment_ibfk_2` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `pet_owner` (`owner_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `FOREIGN EY` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`assistant_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `treatment_ibfk_2` FOREIGN KEY (`vet_id`) REFERENCES `employee` (`emp_id`),
  ADD CONSTRAINT `treatment_ibfk_3` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`);

--
-- Constraints for table `treatment_lab`
--
ALTER TABLE `treatment_lab`
  ADD CONSTRAINT `treatment_lab_ibfk_1` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`),
  ADD CONSTRAINT `treatment_lab_ibfk_2` FOREIGN KEY (`lab_id`) REFERENCES `lab_investigations` (`lab_id`);

--
-- Constraints for table `treatment_medicine`
--
ALTER TABLE `treatment_medicine`
  ADD CONSTRAINT `treatment_medicine_ibfk_1` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`),
  ADD CONSTRAINT `treatment_medicine_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`);

--
-- Constraints for table `treatment_type`
--
ALTER TABLE `treatment_type`
  ADD CONSTRAINT `treatment_type_ibfk_1` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`);

--
-- Constraints for table `treatment_vaccine`
--
ALTER TABLE `treatment_vaccine`
  ADD CONSTRAINT `treatment_vaccine_ibfk_1` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
