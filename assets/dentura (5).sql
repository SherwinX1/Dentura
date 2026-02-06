-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 11:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentura`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `username`, `password`) VALUES
(6, 'Shabdul Al Asad', 'ozide', '$2y$10$u.SAXN95MLhR4iOnceCITORffWOEGaaIYjvzxt1LSBj4NR4CLhYPK'),
(9, 'Trinidad', 'tri', '$2y$10$Yol21dZilDWGuD3xFqWg3OFTxBaMB4sL5B5ks5Q77eZblQ8i5Knbi'),
(11, 'test', 'test', '$2y$10$omke5hwBW98qiYVSMhz5P.OhyfE0uYxPQD0Xuih/pOdGpZJQ907g.');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `number` varchar(250) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `branch` varchar(250) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `uid`, `name`, `email`, `number`, `reason`, `branch`, `date`, `time`, `status`) VALUES
(8, 0, 'Esteban Suleiman', 'sherwinlopez171@gmail.com', '09065575361', 'Braces', 'Dagupan, Pangasinan', '2024-10-09', '12:00', 'Accepted'),
(10, 0, 'Sherwin Soler Lopez', 'sherwinsoler6@gmail.com', '09065575361', 'Braces', 'Dagupan, Pangasinan', '2024-10-09', '09:26', 'Rejected'),
(11, 0, 'Sherwin Soler Lopez', 'sherwinsoler6@gmail.com', '09065575361', 'Braces', 'Dagupan, Pangasinan', '2024-10-09', '15:00', 'Accepted'),
(12, 0, 'Sherwin Soler', 'sherwinsoler6@gmail.com', '09065575361', 'Braces', 'Dagupan, Pangasinan', '2024-10-09', '15:00', 'Rejected'),
(14, 0, 'Crodie Bellenic', 'cahdou23k@gmail.com', '09458016215', 'Veneers', 'Dagupan, Pangasinan', '2024-10-23', '19:30', 'Rejected'),
(15, 0, 'asdf', 'asd@gmail.com', '12312312312', 'Braces', 'Dagupan, Pangasinan', '3123-12-02', '07:30', 'Rejected'),
(17, 1, 'asdf', 'test@gmail.com', '12312312312', 'Braces', 'Dagupan, Pangasinan', '23213-12-31', '07:30', 'Rejected'),
(18, 2, 'test bot', 'testing@gmail.com', '09458016215', 'False Teeth', 'Dagupan, Pangasinan', '2024-10-26', '07:30', 'Rejected'),
(19, 3, 'test botz', 'test1@gmail.com', '09458016215', 'Cleaning', 'Dagupan, Pangasinan', '2024-11-06', '08:30', 'Accepted'),
(20, 1, 'Chad Cabo', 'cahdou23k@gmail.com', '09458016215', 'Cleaning', 'Dagupan, Pangasinan', '2024-11-23', '16:00', 'Rejected'),
(21, 1, 'Chad Cabo', 'cahdou23k@gmail.com', '09458016215', 'False Teeth', 'Dagupan, Pangasinan', '2024-10-28', '07:30', 'Pending'),
(47, 1, 'Example Name', 'test123@gmail.com', '09458016215', 'Cleaning', 'Dagupan, Pangasinan', '2024-10-28', '07:30', 'Pending'),
(48, 1, 'Cory Boa', 'cory123@gmail.com', '09458016215', 'Cleaning', 'Dagupan, Pangasinan', '2024-10-27', '07:30', 'Pending'),
(49, 6, 'test bot', 'tets@gmail.com', 'test', 'Braces', 'Dagupan, Pangasinan', '2024-10-29', '07:30', 'Accepted'),
(50, 6, 'Chad Cabo', 'admin@gmail.com', '09458016215', 'Braces', 'Dagupan, Pangasinan', '2024-10-30', '07:30', 'Accepted'),
(51, 6, 'Chad Cabo', 'qwe@gmail.com', '09458016215', 'Braces', 'Dagupan, Pangasinan', '2024-10-29', '07:30', 'Pending'),
(52, 6, 'Charles Dervin Cabo', 'cahdou23k@gmail.com', '09458016215', 'Cleaning', 'Dagupan, Pangasinan', '2024-10-29', '07:30', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `location` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `location`, `link`) VALUES
(3, 'Dagupan, Pangasinan', 'https://maps.app.goo.gl/jb6dm9NnkHoTNFDH7');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dentists`
--

CREATE TABLE `dentists` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `photo` varchar(5000) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `ig_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dentists`
--

INSERT INTO `dentists` (`id`, `name`, `position`, `photo`, `fb_link`, `ig_link`) VALUES
(11, 'Chad Cabo', 'General Dentist', 'uploads/pfp-photoaidcom-cropped.jpg', 'https://www.facebook.com/charlesdervinc', 'https://www.instagram.com/derb0206/'),
(12, 'Sherwin Lopez', 'Dental Hygienist', 'uploads/wawin.jpg', 'https://www.facebook.com/sherwin.lopez.946', 'https://www.instagram.com/serweynn/'),
(13, 'Nielson John Cubillas', 'Pediatric Dentist', 'uploads/kuyanielz.jpg', 'https://www.facebook.com/uielsou', 'https://www.instagram.com/uiel.sou/');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `cost` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `description`, `cost`, `created_at`, `updated_at`, `image`) VALUES
(15, 'Dentures', 'Dentures are custom-made, removable replacements for missing teeth and surrounding tissue. They offer a comfortable, natural-looking solution to restore your smile and improve oral function, enabling you to eat and speak with confidence. Available in both full and partial options, dentures are crafted to fit comfortably and securely, tailored specifically to match your mouth\'s unique shape.', '1500', '2024-10-22 14:59:10', '2024-10-27 20:20:09', 'uploads/dentures.jpg'),
(17, 'Braces', 'Braces are orthodontic devices designed to straighten teeth, correct bite issues, and enhance dental alignment. Whether metal or clear, braces gradually move your teeth into the ideal position, improving your smile\'s aesthetics and functionality. They are a long-term investment in your oral health, helping you achieve a beautifully aligned smile with lasting benefits.', '2500', '2024-10-22 15:03:40', '2024-10-27 20:20:48', 'uploads/braces.jpg'),
(18, 'Cleaning', 'A professional dental cleaning is a deep-cleaning procedure to remove plaque, tartar, and stains that regular brushing can\'t reach. This preventive care service not only brightens your smile but also reduces the risk of cavities, gum disease, and other oral health issues. Our dental hygienist will leave your teeth feeling fresh, polished, and healthy, ensuring your best oral hygiene.', '800', '2024-10-22 15:08:35', '2024-10-27 20:20:57', 'uploads/cleaning.jpg'),
(19, 'Consultation', 'Our dental consultation provides a thorough examination of your oral health. During the session, our experienced dentist will assess your teeth, gums, and overall oral hygiene, discuss any issues, and recommend the best treatment options. This personalized appointment is a great opportunity to ask questions, voice concerns, and create a tailored plan for maintaining or improving your dental health.', '500', '2024-10-27 18:30:10', '2024-10-27 20:20:37', 'uploads/smile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'test@gmail.com', '$2y$10$uWUnBySWxvjYjTZ78tmwL.w3nXac7L2TTfsNRpiZ2Ctt.fOxygK9G', '2024-10-22 12:23:06', '2024-10-22 12:23:06'),
(2, 'test', 'bots', 'testing@gmail.com', '$2y$10$ygc/R51lawz.y.u2cGcC9e5Cs4JN99D2T8a5aKSZ2r35FPeGjTa0W', '2024-10-22 15:04:17', '2024-10-22 15:04:17'),
(3, 'test', 'botz', 'test1@gmail.com', '$2y$10$Z6w1fxq2jOdGve2EOzXsYuQPU6Pg/B3P5LZOiOk3gN2PgS.aejCHW', '2024-10-22 15:09:19', '2024-10-22 15:09:19'),
(6, 'Charles Dervin', 'Cabo', 'cahdou23k@gmail.com', '$2y$10$DwGTNdo36JHpA9c9pCWVX.1gciozfL4QQOzQU2VwMo2PVcov2IiWa', '2024-10-27 14:23:47', '2024-10-27 14:23:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dentists`
--
ALTER TABLE `dentists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dentists`
--
ALTER TABLE `dentists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
