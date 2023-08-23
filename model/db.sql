-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2023 at 02:41 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `nominas`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_empleados` (IN `num_empleado` INT(11))  BEGIN 
		DELETE FROM empleados 
		WHERE numero = num_empleado;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_empleados` (IN `num_emp` INT(11))  BEGIN
    IF num_emp > 0 THEN
        SELECT * FROM empleados WHERE numero = num_emp;
    ELSE
        SELECT * FROM empleados LIMIT 100;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `set_empleados` (IN `num_empleado` INT(11), IN `nom_empleado` VARCHAR(200), IN `rol_empleado` VARCHAR(100), OUT `LID` INT)  BEGIN 
		INSERT INTO empleados (numero,nombre,rol) VALUES (num_empleado,nom_empleado,rol_empleado);
        SET LID = LAST_INSERT_ID();
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_empleados` (IN `num_empleado` INT(11), IN `nom_empleado` VARCHAR(200), IN `rol_empleado` VARCHAR(100))  BEGIN 
		UPDATE empleados
        SET 
        nombre = nom_empleado,
        rol = rol_empleado
		WHERE numero = num_empleado;
	END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id`, `numero`, `nombre`, `rol`) VALUES
(1, 65456, 'Marco', 'Chofer'),
(2, 98789, 'Pedro', 'Cargador'),
(3, 876, 'Jose', 'Auxiliar'),
(4, 9798, 'Lizbeth', 'Cargador'),
(5, 32342, 'Ana', 'Cargador'),
(6, 453, 'Pablo', 'Chofer'),
(7, 987, 'Alberto', 'Auxiliar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
