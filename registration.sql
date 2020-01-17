-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 20 Ara 2019, 18:00:28
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `registration`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_teacher` varchar(50) NOT NULL,
  `course_credit` int(3) NOT NULL,
  `course_status` enum('0','1','2') NOT NULL DEFAULT '2',
  `course_description` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `courses`
--

INSERT INTO `courses` (`course_id`, `course_code`, `course_name`, `course_teacher`, `course_credit`, `course_status`, `course_description`) VALUES
(2, 'PHYS101', 'PHYSICS-1', 'Stephen Hawking', 4, '1', 'Physical quantities and units. Vector calculus. Kinematics of motion. Newton`s laws of motion and their applications. Work-energy theorem. Impulse and momentum. Rotational kinematics and dynamics. Static equilibrium.'),
(3, 'MATH163', 'Discrete Mathemaics', 'Assoc.Dr. Alan Turing', 3, '1', 'Set theory, functions and relations; introduction to set theory, functions and relations, inductive proofs and recursive definitions. Combinatorics; basic counting rules, permutations, combinations, allocation problems, selection problems, the pigeonhole principle, the principle of inclusion and exclusion. Generating functions; ordinary generating functions and their applications. Recurrence relations; homogeneous recurrence relations, inhomogeneous recurrence relations, recurrence relations and generating functions, analysis of algorithms. Propositional calculus and boolean algebra; basic boolean functions, digital logic gates, minterm and maxterm expansions, the basic theorems of boolean algebra, simplifying boolean function with karnaugh maps. Graphs and trees; adjacency matrices, incidence matrices, eulerian graphs, hamiltonian graphs, colored graphs, planar graphs, spanning trees, minimal spanning trees, Prim\'s algorithm, shortest path problems, Dijkstra\'s algorithms .'),
(4, 'MATH151', 'Calculus-1', 'Cahit Arf', 4, '1', 'Limits and continuity. Derivatives. Rules of differentiation. Higher order derivatives. Chain rule. Related rates. Rolle\'s and the mean value theorem. Critical Points. Asymptotes. Curve sketching. Integrals. Fundamental Theorem. Techniques of integration. Definite integrals. Application to geometry and science. Indeterminate forms. L\'Hospital\'s Rule. Improper integrals. Infinite series. Geometric series. Power series. Taylor series and binomial series.'),
(8, 'ENGL181', 'Academic English - I', 'Prof. Dr. Elitizm Bey', 3, '1', 'ENGL 181 is a first-semester freshman academic English course. It is designed to help students improve the level of their English to B1+ level, as specified in the Common European Framework of Reference for Languages. The course connects critical thinking with language skills and incorporates learning technologies such as IQ Online. The purpose of the course is to consolidate students’ knowledge and awareness of academic discourse, language structures, and lexis. The main focus will be on the development of productive (writing and speaking) and receptive (reading) skills in academic settings.'),
(9, 'CMSE100', 'Introduction to Profession', 'Bill Gates', 3, '0', 'Introduction to Profession'),
(10, 'CMPE112', 'Programming Fundamentals', 'Prof. Dr. Hakan Altuncay', 4, '2', 'An overview of C programming language, Sequential structure Data types and classes of data, arithmetic operators and expressions, assignment statements, type conversions, simple I/O functions (printf, scanf, fprintf, fscanf, gets, puts, fgets, fputs). Selective structure Relational operators, logical operators, conditional expression operator, conditional statements (if, switch). Repetitive structures While, do-while, for loops, loop interruptions (goto, break, continue), Null statement, comma operator. Functions Function definition and function call, external variables, storage classes, recursion. Arrays Array declaration, array initialization, arrays as function arguments. Pointers Basics of pointers, functions and pointers, arrays and pointers, strings and pointers, library functions for processing strings, pointer arrays. Structures Basics of structures, structures and functions, arrays of structures. (Pre-requisite: CMPE 101)'),
(11, 'ENGL182', 'Communication in English - II', 'Ekin Ayik', 0, '2', 'ENGL182 is a second-semester freshman academic English course. It is designed to help students improve the level of their English to B2 level, as specified in the Common European Framework of Reference for Languages (CEFR). The course connects critical thinking with language skills and incorporates learning technologies such as IQ Online. The purpose of the course is to consolidate students’ knowledge and awareness of academic discourse, language structures, and lexis. The main focus will be on the development of productive (writing and speaking) and receptive (reading) skills in academic settings.'),
(12, 'CMPE101', 'Foundations of Computer Engineering', 'Prof. Dr. Yakup Solmaz', 4, '2', 'Design of computer algorithms with pseudo-code to solve problems, analyze engineering related problems using computer. Basic elements of a high level computer programming language: Data types, constants and variables, arithmetic and logical operators and expressions. Fundamental components of Python programming language: Storing and manipulating user-input data, design and use of selection structures, design and use of repetition structures, lists and other data structures, functions, modular designs, dictionaries and sets, file input/output.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `coursestatus`
--

CREATE TABLE `coursestatus` (
  `course_id` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `course_status` enum('0','1','2') NOT NULL,
  `course_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `coursestatus`
--

INSERT INTO `coursestatus` (`course_id`, `user_id`, `course_status`, `course_code`) VALUES
(3, 1, '1', 'CMPE101'),
(4, 1, '1', 'PHYS101'),
(5, 1, '1', 'MATH163'),
(6, 1, '1', 'MATH151'),
(7, 1, '1', 'ENGL181'),
(8, 1, '0', 'CMSE100'),
(9, 1, '2', 'CMPE112'),
(10, 1, '2', 'ENGL182'),
(11, 7, '1', 'CMPE101'),
(12, 7, '0', 'PHYS101'),
(13, 7, '0', 'MATH163'),
(14, 7, '1', 'MATH151'),
(15, 7, '2', 'ENGL181'),
(16, 7, '1', 'CMSE100'),
(17, 7, '1', 'CMPE112'),
(18, 7, '1', 'ENGL182');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deskey`
--

CREATE TABLE `deskey` (
  `id` int(11) NOT NULL,
  `deskey` varchar(50) NOT NULL,
  `iv` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `deskey`
--

INSERT INTO `deskey` (`id`, `deskey`, `iv`) VALUES
(1, 'yakup', 'iv123456');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `selectedcourses`
--

CREATE TABLE `selectedcourses` (
  `course_id` int(7) NOT NULL,
  `user_id` varchar(150) NOT NULL,
  `course_confirm` enum('0','1') NOT NULL DEFAULT '0',
  `course_name` varchar(150) NOT NULL,
  `course_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `selectedcourses`
--

INSERT INTO `selectedcourses` (`course_id`, `user_id`, `course_confirm`, `course_name`, `course_code`) VALUES
(10, '7', '1', 'Foundations Of Computer Engineering', 'CMPE101'),
(11, '7', '1', 'PHYSICS-1', 'PHYS101'),
(12, '7', '1', 'Academic English - I', 'ENGL181'),
(13, '7', '1', 'Communication in English - II', 'ENGL182'),
(14, '7', '1', 'Discrete Mathemaics', 'MATH163'),
(15, '7', '1', 'Programming Fundamentals', 'CMPE112'),
(16, '7', '1', 'Introduction to Profession', 'CMSE100'),
(20, '1', '1', 'Communication in English - II', 'ENGL182'),
(21, '1', '1', 'Introduction to Profession', 'CMSE100'),
(22, '1', '1', 'PHYSICS-1', 'PHYS101'),
(23, '1', '1', 'Calculus-1', 'MATH151'),
(24, '1', '1', 'Discrete Mathemaics', 'MATH163');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_mail` varchar(250) NOT NULL,
  `user_password` varchar(1000) NOT NULL,
  `user_duty` enum('0','1','2','3','4','5') NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_surname` varchar(150) NOT NULL,
  `user_birthdate` varchar(150) NOT NULL,
  `user_sex` varchar(50) NOT NULL,
  `user_tc` int(11) NOT NULL,
  `student_number` int(11) NOT NULL,
  `user_department` varchar(100) NOT NULL,
  `student_semester` int(5) NOT NULL,
  `student_gpa` float NOT NULL,
  `student_advisor` varchar(150) NOT NULL,
  `user_role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_mail`, `user_password`, `user_duty`, `user_name`, `user_surname`, `user_birthdate`, `user_sex`, `user_tc`, `student_number`, `user_department`, `student_semester`, `student_gpa`, `student_advisor`, `user_role`) VALUES
(1, 'student@tbu.edu.tr', 'za4mLD8SJ6h86yLqMqvFcg==', '0', 'NXl5QlJI9vRfo0BJX+Husw==', '33GUq68pEuY=', '07-03-1998', 'male', 0, 16000096, 'Software Engineering', 5, 2.34, 'Alexander Chefrenov', 'Student'),
(2, 'advisor@tbu.edu.tr', '5EjTNz/ZJGv4fnc3OKSq5Q==', '1', 'GmRBjB91DYk=', 'qGM8UBscYiI=', '05-10-1970', 'male', 0, 0, 'Software Engineering', 0, 0, '', 'Advisor'),
(3, 'vicechair@tbu.edu.tr', 'ovVJeRxIVOw1Uo6YyVo3sg==', '2', 'YXZgu5TbJTE=', 'H10+uwBqT64=', '05-10-1970', 'male', 0, 0, 'Software engineering', 0, 0, '', 'Vicechair'),
(4, 'dean@tbu.edu.tr', '6Em80bfgwgn5grKYsQ+9cQ==', '3', 'GttES+rcsgY=', 'qPFBEE++xGo=', '05-10-1970', 'male', 0, 0, 'Software Engineering', 0, 0, '', 'Dean'),
(5, 'rector@tbu.edu.tr', 'Z5pQOaUVNM/Mk1i8Xb0OQg==', '4', 'SjYdmLDuAII=', '7T4xnsGcoSc=', '05-10-1970', 'male', 0, 0, 'Software Engineering', 0, 0, '', 'Rector'),
(6, 'admin@tbu.edu.tr', '9g4dTFfrT8o3OIAY4AA+Iw==', '5', 'LWkigQoMRpA=', 'LWkigQoMRpA=', '05-10-1970', 'male', 0, 0, 'Software Engineering', 0, 0, '', 'Admin'),
(7, 'student2@tbu.edu.tr', 'vkJnkNpmqpKYDZ6247TMkA==', '0', 'HscckpI/fbdzkuy2ruB2Ew==', '5EGEyqzIHk8=', '05-10-1995', 'male', 0, 16006158, 'Software Engineering', 8, 3.15, 'Alexander Chefrenov', 'Student'),
(8, 'advisor2@tbu.edu.tr', '5EjTNz/ZJGv4fnc3OKSq5Q==', '1', 'SeG6ADR2m39sQ6ek0eX7Kw==', 'Gwq454XWcfeIbh4gUtyX6A==', '05-10-1970', 'male', 0, 0, 'Software Engineering', 0, 0, '', 'Advisor'),
(9, 'student3@tbu.edu.tr', 'MdeEm1aGDCboqEv1EmLWbw==', '0', 'Y2wCaUWBfn4=', 'cC1k8h5I+zs=', '05-10-1995', 'male', 0, 16002547, 'Sports Science', 2, 4, '', 'Student'),
(10, 'student4@tbu.edu.tr', 'E0NVEQ4jqQRiERIqab1cZw==', '0', 'wGeGO+dFnb4=', 'KEFZlxZg+Lc=', '05-10-1995', 'male', 0, 16008515, 'Software Engineering', 3, 1.5, 'Alexander Chefrenov', 'Student');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Tablo için indeksler `coursestatus`
--
ALTER TABLE `coursestatus`
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Tablo için indeksler `deskey`
--
ALTER TABLE `deskey`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `selectedcourses`
--
ALTER TABLE `selectedcourses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Tablo için AUTO_INCREMENT değeri `coursestatus`
--
ALTER TABLE `coursestatus`
  MODIFY `course_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `deskey`
--
ALTER TABLE `deskey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `selectedcourses`
--
ALTER TABLE `selectedcourses`
  MODIFY `course_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
