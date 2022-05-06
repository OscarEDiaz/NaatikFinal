create table naatik_tipoContrato(
    contratoID int not null,
    contrato varchar(30),
    primary key(contratoID)
);

create table naatik_tipoInternet(
    internetID int not null,
    primary key(internetID),
    internet varchar(30) not null
);

create table naatik_tipoPago(
    pagoID int not null,
    pago varchar(30) not null,
    primary key(pagoID)
);

create table naatik_clientes(
    idCliente varchar(30) not null,
    genero tinyint not null,
    esJubilado tinyint not null,
    tienePareja tinyint not null,
    tieneDependientes tinyint not null,
    mesesComoCliente int not null,
    tieneServTelefono tinyint not null,
    tieneMulLineas tinyint not null,
    internetID int not null,
    foreign key(internetID) references naatik_tipoInternet(internetID),
    seguridadEnLinea tinyint not null,
    backupEnLinea tinyint not null,
    proteccionDispositivo tinyint not null,
    soporteTecnico tinyint not null,
    streamingTV tinyint not null,
    streamingPeliculas tinyint not null,
    contratoID int not null,
    foreign key(contratoID) references naatik_tipoContrato(contratoID),
    facturaElectronica tinyint not null,
    pagoID int not null,
    foreign key(pagoID) references naatik_tipoPago(pagoID),
    cargoMensual decimal(8, 2) not null,
    cargosTotales decimal(8,2) not null,
    abandono decimal(5, 2) not null,
    primary key(idCliente)
);

insert into naatik_tipoContrato values
    (1, "Mes a mes"),
    (2, "Un año"),
    (3, "Dos años");

insert into naatik_tipoPago values
    (1, "Tarjeta de crédito"),
    (2, "Transferencia bancaria"),
    (3, "Cheque electrónico"),
    (4, "Cheque por correo");
    
insert into naatik_tipoInternet values
(0, "No"),
(1, "DSL"),
(2, "Fibra óptica");