-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01-Dez-2016 às 12:03
-- Versão do servidor: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE IF NOT EXISTS `alunos` (
  `email` varchar(50) NOT NULL,
  `cod_disc` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`email`, `cod_disc`) VALUES
('antonioSP@hotmail.com', '1'),
('paulo_jorge@gmail.com', '1'),
('fernandaSJ32@hotmail.com', '13'),
('ronan.dutra@ufv.br', '132');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividades`
--

CREATE TABLE IF NOT EXISTS `atividades` (
  `cod_ativ` int(8) NOT NULL,
  `cod_disc` varchar(8) NOT NULL,
  `tipo` int(1) NOT NULL,
  `local` varchar(30) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `descricao` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12315 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atividades`
--

INSERT INTO `atividades` (`cod_ativ`, `cod_disc`, `tipo`, `local`, `data`, `hora`, `descricao`) VALUES
(12314, '1', 2, '1', '2017-01-11', '12:12:00', '12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `cod_disc` varchar(8) NOT NULL,
  `cod_prof` int(8) NOT NULL,
  `cod_esc` varchar(8) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`cod_disc`, `cod_prof`, `cod_esc`, `nome`) VALUES
('027', 13, '38265075', 'dfdgf'),
('1', 4, '38265075', 'Projetos 2'),
('13', 4, '38265075', 'er'),
('132', 13, '38265075', 'asd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE IF NOT EXISTS `escola` (
  `cod` varchar(8) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cnpj` varchar(15) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`cod`, `nome`, `cnpj`, `cidade`, `endereco`, `estado`, `email`, `usuario`, `senha`) VALUES
('38265075', 'Cedaf - UFV', '123', '123', '123', 'ac', '1@gmail.com', '3', 'xxC9TW3tQXUUk'),
('70987854', 'des', '', '123', '12312', 'ac', '1@asas', 'asas', 'xxtwWXrzpiaC.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `cod` int(8) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`cod`, `nome`, `sobrenome`, `email`, `usuario`, `senha`) VALUES
(4, 'Carlos', 'Magno Fonseca', 'carlao@gmail.com', '4', 'xxdvDnTqpIWq2'),
(8, 'JosÃ©', 'Teixeira Filho', 'jose@gmail.com', '5', 'xxdvDnTqpIWq2'),
(9, 'Fernando', 'Pinto Borges', 'FpintoB@hotmail.com', '6', 'xxdvDnTqpIWq2'),
(10, 'Luiz', 'Kennedy Barroso', 'LKBarroso@hotmail.com', '10', 'xxdvDnTqpIWq2'),
(13, 'Ronan', 'MendonÃ§a', 'ronan.dutra@ufv.br', 'ronan', 'xxC9TW3tQXUUk');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores_cadastrados`
--

CREATE TABLE IF NOT EXISTS `professores_cadastrados` (
  `cod_prof` int(8) NOT NULL,
  `cod_escola` varchar(8) NOT NULL,
  `situacao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professores_cadastrados`
--

INSERT INTO `professores_cadastrados` (`cod_prof`, `cod_escola`, `situacao`) VALUES
(4, '70987854', 1),
(4, '38265075', 1),
(8, '38265075', 0),
(9, '38265075', 1),
(10, '38265075', 1),
(13, '38265075', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD KEY `cod_disc` (`cod_disc`);

--
-- Indexes for table `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`cod_ativ`),
  ADD KEY `cod_disc` (`cod_disc`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`cod_disc`),
  ADD KEY `cod_esc` (`cod_esc`),
  ADD KEY `cod_prof` (`cod_prof`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `professores_cadastrados`
--
ALTER TABLE `professores_cadastrados`
  ADD KEY `cod_prof` (`cod_prof`),
  ADD KEY `cod_escola` (`cod_escola`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atividades`
--
ALTER TABLE `atividades`
  MODIFY `cod_ativ` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12315;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `cod` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`cod_disc`) REFERENCES `disciplina` (`cod_disc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `atividades`
--
ALTER TABLE `atividades`
  ADD CONSTRAINT `atividades_ibfk_1` FOREIGN KEY (`cod_disc`) REFERENCES `disciplina` (`cod_disc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`cod_esc`) REFERENCES `escola` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professor` FOREIGN KEY (`cod_prof`) REFERENCES `professor` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `professores_cadastrados`
--
ALTER TABLE `professores_cadastrados`
  ADD CONSTRAINT `prof` FOREIGN KEY (`cod_prof`) REFERENCES `professor` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `professores_cadastrados_ibfk_1` FOREIGN KEY (`cod_escola`) REFERENCES `escola` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
