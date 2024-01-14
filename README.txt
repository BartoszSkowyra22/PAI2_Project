1. To use the application, you need to configure the database (an example mySQL database is added to this file in point 5)

2. Login details for created accounts
    USER ACCOUNT:
    Login: user
    Password: Qwerty1

    ADMIN ACCOUNT:
    Login: admin
    Password: Qwerty1!

3.You must configure access data to your database in the following places
- model/database.php - lines: 2-4
- addUser.php - line 14
- index.php - line 10
- processLogin.php - line 6


4. If you do not use a ready-made database, you must create a mySQL database and then the following tables:
    - users
    - logged_in_users
    - tasks
    - fields

You can use the following SQL code to create tables:

*users:

CREATE TABLE IF NOT EXISTS `users` ( `id` int(11) NOT NULL AUTO_INCREMENT, `userName` varchar(100) NOT NULL, `fullName` varchar(255) NOT NULL, `email` varchar(100) NOT NULL, `passwd` varchar(255) NOT NULL, `status` int(1) NOT NULL,
`date` datetime NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `userName` (`userName`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


*logged_in_users:

CREATE TABLE IF NOT EXISTS `logged_in_users` ( `sessionId` varchar(100) NOT NULL,
`userId` int(11) NOT NULL,
`lastUpdate` datetime NOT NULL,
PRIMARY KEY (`sessionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


*tasks
- sql code will be posted later

*fields
- sql code will be posted later



5. DDL To create Database



-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 14, 2024 at 02:26 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `courseID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`courseID`, `name`) VALUES
(83, 'Studia'),
(84, 'Dom'),
(85, 'Praca'),
(86, 'Inne');

-- --------------------------------------------------------

--
-- Table structure for table `logged_in_users`
--

CREATE TABLE `logged_in_users` (
  `sessionId` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `courseId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `description`, `courseId`) VALUES
(20, 'Nauczyć się na egzamin - SWIFT', 83),
(21, 'Nauczyć się na egzamin - C++', 83),
(22, 'Wyrzucić śmieci', 84),
(23, 'Wykonać stronę internetową', 85),
(24, 'Przeczytać książkę', 86),
(25, 'Umyć okna', 84);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `fullName`, `email`, `passwd`, `status`, `date`) VALUES
(1, 'admin', 'admin', 'admin@school.com', '$2y$10$qEwH1UmSUPDFdL8XDiSd2uzDShLMrFDbPoqAD0hN9fNDPF2sObvNm', 2, '2023-12-20 11:53:17'),
(2, 'user', 'user', 'user@school.com', '$2y$10$3axYMZnt7Kt10wdSkOWgmOXEPWON0BAdhupMlf9SxoyBQPndridP.', 1, '2023-12-20 11:53:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `logged_in_users`
--
ALTER TABLE `logged_in_users`
  ADD PRIMARY KEY (`sessionId`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `courseId` FOREIGN KEY (`courseId`) REFERENCES `fields` (`courseID`);


