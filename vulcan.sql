DROP SCHEMA  IF EXISTS vulcan;
CREATE DATABASE vulcan;

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '0',
  `nome` varchar(100) NOT NULL,
  `moeda` varchar(100) NOT NULL
);
INSERT INTO `empresa` (`id`, `nivel`, `nome`, `moeda`) VALUES
(1, 0, 'brasil', 'brl'),
(2, 0, 'eua', 'usd');

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
);
INSERT INTO `usuario` (`id`, `idEmpresa`, `usuario`, `senha`) VALUES
(1, 1, 'valdir', '123'),
(2, 2, 'joao', '123');

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `valor` double NOT NULL,
  `cotacao` double NOT NULL,
  `valoruss` double NOT NULL
);
INSERT INTO `venda` (`id`, `idEmpresa`, `cliente`, `data`, `valor`, `cotacao`, `valoruss`) VALUES
(1, 1, 'joaozinho da silva', '2018-06-24', 3.78, 3.78, 1),
(2, 0, 'valdir', '0000-00-00', 358, 3.58, 100),
(3, 0, 'valdir', '2018-06-26', 358, 3.58, 100);