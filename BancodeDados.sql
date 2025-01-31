create database phpTINT;

use phpTINT;

create table cliente(
	codigo int not null primary key,
    nome varchar(120) not null,
	telefone varchar(13) not null,
	endereco varchar(150) not null,
	total decimal(10,2) not null
)Engine = innoDB;

create table Funcionario(
	codigo int not null primary key,
    nome varchar(120) not null,
	telefone varchar(13) not null,
	endereco varchar(150) not null,
	salario decimal(10,2) not null
)Engine = innoDB;

select * from cliente;
select * from funcionario;

create table usuario(
	codigo int not null primary key auto_increment,
    usuario varchar(120) not null,
    senha varchar(120) not null
)engine = innoDB;
INSERT INTO `usuario` (`codigo`,`usuario`,`senha`) VALUES (1,'Jhon','Jhon');
INSERT INTO `usuario` (`codigo`,`usuario`,`senha`) VALUES (2,'Allan','Allan');