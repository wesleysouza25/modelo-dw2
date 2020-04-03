create table estado(
	estadoid serial not null primary key,
	sigla varchar(2),
	descricao varchar(100)
);

create table cidade(
	cidadeid serial not null,
	nome varchar(100),
	estadoid integer,
	codibge varchar(15),
	
	constraint pkcidade primary key (cidadeid),
	constraint fk_estado foreign key(estadoid) references estado (estadoid)
);

create table pessoa(
	idpessoa serial not null,
	nome varchar(100),
	endereco varchar(100),
	telefone varchar(15),
	estadoid integer,
	cidadeid integer,
	datanasc date,
	
	constraint pkpessoa primary key (idpessoa),
	constraint fk_estado foreign key(estadoid) references estado (estadoid),
        CONSTRAINT fk_pessoa_cidade FOREIGN KEY (cidadeid) REFERENCES cidade (cidadeid)
);

create table unidade(
	unidadeid serial not null primary key,
	descricao varchar(100)
);
create table marca(
	marcaid serial not null primary key,
	descricao varchar(20)
);

create table produto(
	produtoid serial not null primary key,
	descricao varchar(100),
	custo numeric(10,2),
	venda numeric(10,2),
	unidadeid integer,
	marcaid integer,

	constraint fk_produto_marca foreign key (marcaid) references marca(marcaid),
        constraint prod_unidade foreign key (unidadeid) references unidade(unidadeid)
);

create table usuarios(
	idusuario serial not null,
	login varchar(10),
	senha varchar(8),
        nome varchar(100),
	
	constraint pk_usuario primary key (idusuario)
);

insert into usuarios(login, senha, nome) values ('admin', 'admin','Seu nome');

create table vendedor(
 vendedorid serial primary key not null,
 nome varchar(100),
 endereco character varying(100),
  telefone character varying(15),
  estadoid integer,
  datanasc date,
  cidadeid integer,
  usuarioid integer,
 funcao varchar(100),

 constraint fk_cidade foreign key (cidadeid) references cidade(cidadeid),
 constraint fk_estado foreign key (estadoid) references estado(estadoid),
 constraint fk_usuario foreign key (usuarioid) references usuarios(idusuario)
 );

CREATE TABLE public.pedido
(
  pedidoid serial NOT NULL,
  datapedido date,
  idpessoa integer,
  total numeric(10,2),
  vendedorid integer,
  CONSTRAINT pk_pedido PRIMARY KEY (pedidoid),
  CONSTRAINT fk_pedido_pessoa FOREIGN KEY (idpessoa)
      REFERENCES pessoa (idpessoa),
  CONSTRAINT fk_vend_pedido FOREIGN KEY (vendedorid)
      REFERENCES vendedor (vendedorid)
);

CREATE TABLE public.item
(
  itemid serial NOT NULL,
  produtoid integer,
  pedidoid integer,
  quantidade integer,
  valor numeric(10,2),
  CONSTRAINT pk_item PRIMARY KEY (itemid),
  CONSTRAINT fk_item_produto FOREIGN KEY (produtoid)
      REFERENCES public.produto (produtoid),
CONSTRAINT fk_item_pedido FOREIGN KEY (pedidoid)
      REFERENCES public.pedido (pedidoid)
);
