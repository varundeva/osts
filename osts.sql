-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 03:16 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osts`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`varundeva`@`localhost` PROCEDURE `report1` ()  SELECT count(DISTINCT users.user_id) as Users,
		COUNT(DISTINCT staff.staff_id) as Staff,
        COUNT(DISTINCT tickets.ticket_id) as Tickets,
        COUNT(DISTINCT message.msg_id)as Msg
        from users,staff,tickets,message$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_pass`) VALUES
(1, 'varundev23@gmail.com', '3dea15ac8c8e3b300929b7adc9b3605a');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_desc`) VALUES
(1, 'Sales', 'handles sales queries'),
(2, 'Technical', 'handles technical queries'),
(3, 'Test', 'Test Description');

-- --------------------------------------------------------

--
-- Table structure for table `maillist`
--

CREATE TABLE `maillist` (
  `ml_id` int(11) NOT NULL,
  `ml_name` varchar(255) NOT NULL,
  `ml_email` varchar(255) NOT NULL,
  `ml_opted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maillist`
--

INSERT INTO `maillist` (`ml_id`, `ml_name`, `ml_email`, `ml_opted`) VALUES
(1, 'FreeSV', 'getsv365@gmail.com', 0),
(2, 'FreeSV', 'getsv365@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `msg_content` varchar(6000) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `replied_by` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `msg_content`, `ticket_id`, `user_id`, `staff_id`, `department_id`, `replied_by`, `timestamp`) VALUES
(1, 'xxxxxxxxxxxxxxxxxxx', 5, 1, 1, 2, 'STAFF REPLY', '2019-11-11 17:34:58'),
(2, 'hiiii test', 2, 1, 1, 2, 'STAFF REPLY', '2019-11-11 17:42:27'),
(3, 'Test Test', 2, 1, 1, 2, 'STAFF REPLY', '2019-11-11 17:42:48'),
(4, 'Testing Replyyyyyyy', 3, 1, 1, 1, 'STAFF REPLY', '2019-11-11 17:49:48'),
(5, 'testing from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from stafftesting from staff', 5, 1, 1, 2, 'STAFF REPLY', '2019-11-11 18:12:10'),
(6, 'sdgAIDG;;SGus;dg/sgbvdkfjvksdniuy', 5, 1, 1, 2, 'STAFF REPLY', '2019-11-11 18:16:48'),
(7, 'hi yeasc;sdovbsov v;syidvbsdgv;ysv esBOuvbve', 2, 1, 1, 2, 'STAFF REPLY', '2019-11-11 18:55:50'),
(8, 'replied to ticket', 6, 1, 1, 1, 'STAFF REPLY', '2019-11-12 03:46:37'),
(9, 'test', 6, 1, 1, 1, 'USER REPLY', '2019-11-12 03:51:57'),
(10, 'not empty', 6, 1, 1, 1, 'USER REPLY', '2019-11-14 03:46:03'),
(11, 'saa,scbvaucsvakcsva;yidcvadhc', 2, 1, 1, 2, 'USER REPLY', '2019-11-14 03:48:30'),
(12, 'sssssss', 6, 1, 1, 1, 'USER REPLY', '2019-11-14 03:56:41'),
(13, 'sabc;aubscba', 7, 1, 1, 1, 'STAFF REPLY', '2019-11-14 05:00:12'),
(14, 'testing repl-y from staff', 9, 2, 1, 1, 'STAFF REPLY', '2019-11-15 12:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_phone` varchar(255) NOT NULL,
  `staff_email` varchar(255) NOT NULL,
  `staff_pass` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_phone`, `staff_email`, `staff_pass`, `department_id`) VALUES
(1, 'Varun Deva', '9008444205', 'varundev23@gmail.com', '3dea15ac8c8e3b300929b7adc9b3605a', 2),
(2, 'NewLook Spa and Salon', '9663619729', 'newlookspa13@gmail.com', '3dea15ac8c8e3b300929b7adc9b3605a', 1),
(3, 'Varun Deva', '9008444205', 'varund@gmail.com', '3dea15ac8c8e3b300929b7adc9b3605a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_title` varchar(255) NOT NULL,
  `ticket_desc` varchar(1000) NOT NULL,
  `ticket_status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_title`, `ticket_desc`, `ticket_status`, `user_id`, `department_id`, `timestamp`) VALUES
(1, 'Twesting', 'asclvaisudvaidy;v', 'CREATED', 1, 2, '2019-11-14 06:48:22'),
(2, 'ticket 1', 'sdgFgDFbhzdfhbdfbdf', 'CLOSED', 1, 2, '2019-11-14 06:37:46'),
(3, 'ticket 2', 'ascaskvcakcvakdvckadhv cdcascasc', 'CREATED', 1, 1, '2019-11-14 06:48:26'),
(4, 'Testing 1 Ticket Title', 'Testing Ticket Desc\r\nTesting Ticket Desc\r\nTesting Ticket Desc\r\nTesting Ticket Desc', 'USER REPLY', 1, 2, '2019-11-14 06:48:44'),
(5, 'server down from now', 'Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down Server down', 'CREATED', 1, 2, '2019-11-14 06:48:30'),
(6, 'testing testing testing testing', 'testing testing testing testing testing testing testing testing testing testing', 'CLOSED', 1, 1, '2019-11-14 04:33:27'),
(7, 'Twesting', 'ssssssssssssssss', 'CLOSED', 1, 1, '2019-11-15 12:27:40'),
(8, 'sssssssssssssssssssssssssss', 'ssssssssssssssssssssssssss', 'CLOSED', 1, 1, '2019-11-14 06:46:21'),
(9, 'sla.gdvu;sv Testingascb;as as', 'askcv;asicvsidv;osudvcksavdcyvsdoc\r\nasdcia;sdvcsyvkvhvskdvisvbdcbsdcb\r\nasdclvsdvsiyDcviys;dvci;svcivsdcv', 'CLOSED', 2, 1, '2019-11-15 12:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_dob` varchar(255) DEFAULT NULL,
  `user_mailopt` tinyint(1) NOT NULL DEFAULT 0,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_phone`, `user_dob`, `user_mailopt`, `user_pass`) VALUES
(1, 'Varun Ganesh D', 'varundev23@gmail.com', '8277529481', '1998-04-24', 1, '3dea15ac8c8e3b300929b7adc9b3605a'),
(2, 'Varun Deva', 'varun@gmail.com', '09008444205', '', 0, '3dea15ac8c8e3b300929b7adc9b3605a'),
(3, 'FreeSV', 'getsv365@gmail.com', '9008444205', '1998-04-23', 1, '3dea15ac8c8e3b300929b7adc9b3605a');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `mailcopy` AFTER UPDATE ON `users` FOR EACH ROW INSERT INTO maillist VALUES(null,NEW.user_name,NEW.user_email,NEW.user_mailopt)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `maillist`
--
ALTER TABLE `maillist`
  ADD PRIMARY KEY (`ml_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `department` (`department_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maillist`
--
ALTER TABLE `maillist`
  MODIFY `ml_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`),
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `message_ibfk_4` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
