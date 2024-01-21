-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2022 at 08:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pfil`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `Higher_Qualification` varchar(50) DEFAULT NULL,
  `marital` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `ifsc_code` varchar(100) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `dateofbirth` varchar(50) DEFAULT NULL,
  `signature_path` varchar(1000) NOT NULL,
  `adharcard_path` varchar(50) NOT NULL,
  `PANcard_path` varchar(50) NOT NULL,
  `image_path` varchar(50) NOT NULL,
  `otp` int(4) NOT NULL,
  `loan_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `Higher_Qualification`, `marital`, `password`, `gender`, `bank_name`, `account_number`, `ifsc_code`, `Address`, `email`, `contact_number`, `dateofbirth`, `signature_path`, `adharcard_path`, `PANcard_path`, `image_path`, `otp`, `loan_status`) VALUES
(14, 'amit  kumar', '10th', 'unmarried', 'amit@123', 'male', 'coop bank', '060834001100319', 'UTIB0SFGH01', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'attriamit830@gmail.com', '08264036493', '04-04-2002', 'docs/staff/signature/14.jpg', 'docs/staff/signature/14.jpg', 'docs/staff/signature/14.jpg', 'docs/staff/signature/14.jpg', 0, 1),
(15, 'nitish  goyal', '10th', 'unmarried', 'nitish@123', 'male', 'pnb bank', '1280000101113152', 'PUNB012800', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'attriamit830@gmail.com', '08264036493', '04-04-2002', '', '', '', '', 6786, 0),
(16, 'rishab', '10th', 'unmarried', 'rishab@123', 'male', 'fdvzx', '4535', '354', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'attriamit830@gmail.com', '08264036493', '04-04-2002', '', '', '', '', 0, 0),
(17, 'abc', '12th', 'unmarried', 'abc123', 'others', 'bfd', '35', 'rt4', 'xyz', 'attriamit830@gmail.com', '123', '098', '', '', '', '', 0, 0),
(18, 'def', 'graduation', 'married', 'def@123', 'female', '', '', '', 'qwert', 'attriamit830@gmail.com', '08264036493', '04-04-2002', '', '', '', '', 0, 0),
(19, 'ghi', 'postgraduation', 'unmarried', 'ghi@123', 'female', 'dfg', '345', '354', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'attriamit830@gmail.com', '08264036493', '098', '', '', '', '', 0, 0),
(20, 'GURCHARAN SINGH', 'postgraduation', 'married', '123', 'male', 'srg', 'xfb', '5t', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'attriamit830@gmail.com', '08264036493', '000000', 'docs/staff/signature/20.png', '', '', '', 0, 0),
(21, 'amit123', 'graduation', 'unmarried', '979789789', 'male', '', '', '', '908900', '890908', '09809', '098', 'docs/staff/signature/21.php', 'docs/staff/Addhar/21.php', 'docs/staff/PAN/21.php', 'docs/staff/imageclient/21.jpg', 0, 0),
(22, '98797', '10th', 'married', '897', 'others', '', '', '', '0890', '908', '080', '8', 'docs/staff/signature/22.pdf', 'docs/staff/Addhar/22.pdf', 'docs/staff/PAN/22.pdf', 'docs/staff/imageclient/21.jpg', 0, 0),
(23, 'amit', '10th', 'married', '1234', 'male', '', '', '', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'attriamit830@gmail.com', '08264036493', '04-04-2002', '', '', '', '', 0, 0),
(24, 'abda', '10th', 'married', 'hgffb', 'others', '', '', '', 'agfeurb', 'bhv', 'fb8WEBF', 'BYEBR', '', '', '', 'docs/staff/image/24.jpg', 0, 0),
(25, 'amit', '10th', 'married', '1234', 'male', '', '', '', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'hfbhd', '08264036493', '908', '', '', '', 'docs/staff/image/25.jpg', 0, 0),
(26, 'amit', '10th', 'married', '1234', 'male', '', '', '', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'attriamit830@gmail.com', '08264036493', '04-04-2002', '', '', '', 'docs/staff/image/26.jpg', 0, 0),
(27, 'amit', '10th', 'married', '1234', 'male', '', '', '', 'Village Ghanour, po massewal , tehsil Anandpur sah', 'attriamit830@gmail.com', '08264036493', '04-04-2002', '', '', '', '', 0, 0),
(28, 'test1', '12th', 'married', '123', 'male', 'haku nama tata', '6912345', '2333333333', 'fvnfsdbvnlz', 'nitishgoyal124@gmail.com ', 'vxnkb', 'fbdkkx', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(20) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `marital` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `checkbox` varchar(50) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `message` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`id`, `employee_name`, `gender`, `marital`, `password`, `checkbox`, `image`, `message`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '-9-9', 'male', 'married', '-09', 'spic', '', '0808'),
(3, '-9-9', 'male', 'married', '', 'spic', '', '0808'),
(4, '-9-9', 'male', 'married', '', 'spic', '', '0808'),
(5, '-9-9', 'male', 'married', '', 'spic', 'newemployee (2).php', '0808');

-- --------------------------------------------------------

--
-- Table structure for table `emp1`
--

CREATE TABLE `emp1` (
  `id` int(11) NOT NULL,
  `employee_Name` varchar(50) DEFAULT NULL,
  `Higher_Qualification` varchar(50) DEFAULT NULL,
  `marital` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `resume_path` varchar(300) DEFAULT NULL,
  `Address` varchar(300) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `dateofbirth` varchar(50) DEFAULT NULL,
  `image_path` varchar(1000) NOT NULL,
  `otp` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp1`
--

INSERT INTO `emp1` (`id`, `employee_Name`, `Higher_Qualification`, `marital`, `password`, `gender`, `resume_path`, `Address`, `email`, `contact_number`, `dateofbirth`, `image_path`, `otp`) VALUES
(15, 'amit', '10th', 'married', 'c3BpYzEyMw==', 'others', NULL, '897', 'amit@gmail.com', '897', '987', '', 1556),
(16, '977987', '10th', 'married', '', 'others', 'upload\resume16.jpg', '987', '', '987', '978', '', 0),
(17, '987', '10th', 'married', '987', 'others', 'upload\resume17.jpg', '987', '987', '987', '987', '', 0),
(18, '90800', '10th', 'married', '098', 'others', 'uploadimage18.heic', '098', '098', '098', '098', '', 0),
(19, 'kjasdhh', '10th', 'married', 'kjh', 'others', 'uploadimage19.jpg', 'khkjh', 'kjh', 'kjh', 'kjh', '', 0),
(20, '098008', '10th', 'married', '080', 'others', 'upload\resume20.docx', '80', '88080', '808', '08008', 'uploadimage20.heic', 0),
(21, '8987979', '10th', 'married', '897', 'others', 'upload/resume/21.php', '987', '987', '987978', '987', 'upload/image/21.heic', 0),
(22, '9080', '10th', 'married', '098', 'others', 'upload/resume/22.heic', '908098', '098', '098', '098', 'upload/image/22.jpg', 0),
(23, 'sehfu', '10th', 'married', 'hdsfbf', 'others', 'upload/resume/23.jpg', 'jdfj', 'jddn', 'hdbfjd', 'jfjd', 'upload/image/23.heic', 0),
(24, 'hwruash', '10th', 'married', 'fhdj', 'others', '', 'hfhbd', 'ffnd', 'nfdj', 'jnfdj', '', 0),
(25, '', '10th', 'married', '', 'others', NULL, '', '', '', '', '', 0),
(26, '  vsv ', '10th', 'married', ' nf en', 'others', '', 'fjeefn', 'jnf', ' jfnj', 'njrf', '', 0),
(27, 'bhsfe', '10th', 'married', 'njc', 'others', '', 'Village Ghanour, po massewal , tehsil Anandpur sahib pin code 140115', 'bj', '08264036493', '2344', '', 0),
(28, 'amit', '10th', 'married', '1234', 'others', '', 'asdfg', '12334', '08264036493', 'hjnvx', '', 0),
(29, '123', '10th', 'married', 'sf', 'others', '', 'bfesj', 'jncj', 'njnsd', 'njnmnc', '', 0),
(30, 'qwer', '10th', 'married', 'jksnfs', 'others', '', 'jsfnsj', ' jmn csdm', 'n jmncd', ' jmd', '', 0),
(31, '', '10th', 'married', '', 'others', NULL, '', '', '', '', '', 0),
(32, 'amit', '10th', 'married', '1234', 'others', 'docs/staff/resume/32.heic', '12345', 'njdnd', ' nmsnc s', ' sc sd', 'docs/staff/image/32.heic', 0),
(33, 'amit', '10th', 'married', '1234', 'others', 'docs/staff/resume/33.heic', '1234', 'n cjszsn', 'njmcn dsj', 'njmnc', 'docs/staff/image/33.jpg', 0),
(34, 'Amit sharma', '10th', 'married', 'amit@123', 'male', 'docs/staff/resume/34.pdf', 'Village Ghanour, po massewal , tehsil Anandpur sahib pin code 140115', 'attriamit830@gmail.com', '08264036493', '04-04-2002', 'docs/staff/image/34.jpg', 0),
(35, 'AMIT', '10th', 'married', '1234', 'others', NULL, 'HJSN', 'JDSC ', ' NJMD', 'NJMF', '', 0),
(36, 'AMIT', '10th', 'married', '1234', 'others', 'docs/staff/resume/36.jpg', 'HJSN', 'JDSC ', ' NJMD', 'NJMF', 'docs/staff/image/36.jpg', 0),
(37, '', '10th', 'married', '', 'others', '', '', '', '', '', '', 0),
(38, '123', '10th', 'married', '1234', 'others', 'docs/staff/resume/38.heic', 'Village Ghanour, po massewal , tehsil Anandpur sahib pin code 140115', 'asd', '08264036493', 'asd', 'docs/staff/image/38.jpg', 0),
(39, 'amit', '10th', 'married', '1234', 'male', 'docs/staff/resume/39.pptx', 'Village Ghanour, po massewal , tehsil Anandpur sahib pin code 140115', 'attriamit830@gmail.com', '08264036493', '04-04-2002', 'docs/staff/image/39.heic', 0),
(40, 'amit', '10th', 'married', '1234', 'male', 'docs/staff/resume/40.xlsx', 'Village Ghanour, po massewal , tehsil Anandpur sahib pin code 140115', 'attriamit830@gmail.com', '08264036493', '04-04-2002', 'docs/staff/image/40.jpg', 0),
(41, 'spic', 'graduation', 'unmarried', 'c3BpYzEyMw==', 'others', NULL, '998', '098', '908', '098', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groupmember`
--

CREATE TABLE `groupmember` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `member_type` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `otp` int(11) DEFAULT NULL,
  `other` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupmember`
--

INSERT INTO `groupmember` (`id`, `group_id`, `member_id`, `member_type`, `status`, `otp`, `other`) VALUES
(55, 32, 15, 'member', 2, 4067, 'ABC'),
(56, 32, 14, 'member', 2, NULL, 'asdsa');

-- --------------------------------------------------------

--
-- Table structure for table `loangroup`
--

CREATE TABLE `loangroup` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `Loan_Amount` int(11) NOT NULL,
  `Time_Duration` varchar(500) NOT NULL,
  `loan_status` int(11) DEFAULT 0,
  `number_of_members` int(11) DEFAULT NULL,
  `info` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `other` varchar(1000) NOT NULL,
  `Read_Status` int(11) NOT NULL DEFAULT 2,
  `stage2_info` varchar(500) NOT NULL,
  `stage3_info` varchar(500) NOT NULL,
  `path1` varchar(500) NOT NULL,
  `path2` varchar(500) NOT NULL,
  `path3` varchar(500) NOT NULL,
  `path4` varchar(500) NOT NULL,
  `path5` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loangroup`
--

INSERT INTO `loangroup` (`id`, `admin_id`, `group_name`, `Loan_Amount`, `Time_Duration`, `loan_status`, `number_of_members`, `info`, `status`, `other`, `Read_Status`, `stage2_info`, `stage3_info`, `path1`, `path2`, `path3`, `path4`, `path5`) VALUES
(32, 15, 'TEST1', 100000, '18', 0, 3, 'FMVSF:b', 1, '', 0, '', 'REASON', 'docs/client_docs/doc1/32.png', 'docs/client_docs/doc2/32.png', 'docs/client_docs/doc3/32.jpg', 'docs/client_docs/doc4/32.jpg', 'docs/client_docs/doc5/32.png'),
(33, 16, 'abc', 100000, '18', 0, 5, 'xcvs', 1, '', 2, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `member_action_detail`
--

CREATE TABLE `member_action_detail` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `date_and_time` varchar(100) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_action_detail`
--

INSERT INTO `member_action_detail` (`id`, `group_id`, `member_id`, `info`, `date_and_time`) VALUES
(8, 32, 15, 'ABC', '2022-08-04 16:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `request_for_undo`
--

CREATE TABLE `request_for_undo` (
  `id` int(11) NOT NULL,
  `group_id` varchar(100) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `admin_id` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_for_undo`
--

INSERT INTO `request_for_undo` (`id`, `group_id`, `message`, `admin_id`, `status`) VALUES
(4, '32', 'UNDO REQUEST MESSAGE', '16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_groupmember`
--

CREATE TABLE `temp_groupmember` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `member_type` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `otp` int(11) DEFAULT NULL,
  `other` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp1`
--
ALTER TABLE `emp1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupmember`
--
ALTER TABLE `groupmember`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loangroup`
--
ALTER TABLE `loangroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_action_detail`
--
ALTER TABLE `member_action_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_for_undo`
--
ALTER TABLE `request_for_undo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_groupmember`
--
ALTER TABLE `temp_groupmember`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emp1`
--
ALTER TABLE `emp1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `groupmember`
--
ALTER TABLE `groupmember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `loangroup`
--
ALTER TABLE `loangroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `member_action_detail`
--
ALTER TABLE `member_action_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `request_for_undo`
--
ALTER TABLE `request_for_undo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `temp_groupmember`
--
ALTER TABLE `temp_groupmember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
