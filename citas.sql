CREATE DATABASE citas;
USE citas;

CREATE TABLE Consultorios(
    ConNumero int(3) not null,
    ConNombre varchar (50) not null,
    primary key (ConNumero)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Medicos(
    MedIdentificacion char(10) not null,
    MedNombres varchar(50) not null,
    MedApellidos varchar(50) not null,
    MedEstado enum ('Activo','Inactivo') not null DEFAULT 'Activo',
    primary key (MedIdentificacion)
)ENGINE=InnoDB DEFAULT CHARSET=latin1; 

CREATE TABLE Pacientes(
    PacIdentificacion char(10) not null,
    PacNombres varchar(50) not null,
    PacApellidos varchar(50) not null,
    PacFechaNacimiento date not null,
    PacSexo enum ('M','F') not null,
    PacEstado enum ('Activo','Inactivo') not null DEFAULT 'Activo',
    primary key (PacIdentificacion)
)ENGINE=InnoDB DEFAULT CHARSET=latin1; 

CREATE TABLE citas(
    CitNumero int(11) not null AUTO_INCREMENT,
    CitFecha date not null,
    CitHora varchar (10) not null,
    CitPaciente char(10) not null,
    CitMedico char(10) not null,
    CitConsultorio int(3) not null,
    CitEstado enum ('Asignada','Cumplida','Solicitada','Cancelada') not null DEFAULT'Asignada',
    primary key (`CitNumero`),key CitPaciente(`CitPaciente`), key `CitMedico`(`CitMedico`),key `CitConsultorio`(`CitConsultorio`),
    CONSTRAINT `citas_ibfk_1` FOREIGN KEY(CitPaciente) REFERENCES Pacientes(PacIdentificacion),
    CONSTRAINT `citas_ibfk_2`FOREIGN KEY (CitMedico) REFERENCES Medicos (MedIdentificacion),
    CONSTRAINT `citas_ibfk_3` FOREIGN KEY (CitConsultorio) REFERENCES Consultorios(ConNumero)
)ENGINE=InnoDB DEFAULT CHARSET=latin1; 

INSERT INTO Medicos (MedIdentificacion, MedNombres, MedApellidos, MedEstado) VALUES
    ('M1', 'Juan', 'Pérez', 'Activo'),
    ('M2', 'María', 'González', 'Activo'),
    ('M3', 'Carlos', 'Rodríguez', 'Inactivo');


