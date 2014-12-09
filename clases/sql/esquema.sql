create database bdphp default character set utf8 collate utf8_unicode_ci;
grant all on bdphp.* to userphp@localhost identified by 'clavephp';
flush privileges;

use bdphp;

CREATE TABLE IF NOT EXISTS casa_provincia (
    idProvincia int(11) NOT NULL primary key auto_increment,
    nombreProvincia varchar(30) NOT NULL 
) ENGINE=InnoDB collate utf8_unicode_ci;;

CREATE TABLE IF NOT EXISTS casa_inmueble (
    id int(11) NOT NULL primary key auto_increment,
    precio decimal(20,2) NOT NULL,
    habitaciones int(11) NULL,
    banos int(11) NULL,
    metros int(11) NOT NULL,
    provincia int(11) NOT NULL,
    direccion varchar(60) NOT NULL,
    ciudad varchar(40) NOT NULL,
    estado enum('A estrenar', 'Reformado', 'En buen estado', 'A reformar') NOT NULL DEFAULT 'En buen estado',
    tipo enum('Piso', 'Chalet', 'Duplex', 'Unifamiliar', 'Estudio', 'Local', 'Trastero', 'Garaje') NOT NULL DEFAULT 'Piso',
    descripcion varchar(500) NOT NULL,
    horaContacto enum('10:00 - 14:00', '14:00 - 17:00', '17:00 - 21:00') NOT NULL DEFAULT '17:00 - 21:00',
    telefono int(11) NULL,
    email varchar(40) NOT NULL,
    isalquiler tinyint(1) NOT NULL DEFAULT 0,
    isactivo tinyint(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (provincia) REFERENCES casa_provincia (idProvincia)    
) ENGINE=InnoDB collate utf8_unicode_ci;   

CREATE TABLE IF NOT EXISTS casa_root (
    nombre varchar(30) NOT NULL,
    clave varchar(40) NOT NULL 
) ENGINE=InnoDB collate utf8_unicode_ci;

insert into casa_root values('root', sha1('toor'));

insert into casa_provincia (nombreProvincia) values('Álava');
insert into casa_provincia (nombreProvincia) values('Albacete');
insert into casa_provincia (nombreProvincia) values('Alicante');
insert into casa_provincia (nombreProvincia) values('Almería');
insert into casa_provincia (nombreProvincia) values('Asturias');
insert into casa_provincia (nombreProvincia) values('Ávila');
insert into casa_provincia (nombreProvincia) values('Badajoz');
insert into casa_provincia (nombreProvincia) values('Barcelona');
insert into casa_provincia (nombreProvincia) values('Burgos');
insert into casa_provincia (nombreProvincia) values('Cáceres');
insert into casa_provincia (nombreProvincia) values('Cádiz');
insert into casa_provincia (nombreProvincia) values('Cantabria');
insert into casa_provincia (nombreProvincia) values('Castellón');
insert into casa_provincia (nombreProvincia) values('Ciudad Real');
insert into casa_provincia (nombreProvincia) values('Córdoba');
insert into casa_provincia (nombreProvincia) values('La Coruña');
insert into casa_provincia (nombreProvincia) values('Cuenca');
insert into casa_provincia (nombreProvincia) values('Gerona');
insert into casa_provincia (nombreProvincia) values('Granada');
insert into casa_provincia (nombreProvincia) values('Guadalajara');
insert into casa_provincia (nombreProvincia) values('Guipúzcoa');
insert into casa_provincia (nombreProvincia) values('Huelva');
insert into casa_provincia (nombreProvincia) values('Huesca');
insert into casa_provincia (nombreProvincia) values('Islas Baleares');
insert into casa_provincia (nombreProvincia) values('Jaén');
insert into casa_provincia (nombreProvincia) values('León');
insert into casa_provincia (nombreProvincia) values('Lérida');
insert into casa_provincia (nombreProvincia) values('Lugo');
insert into casa_provincia (nombreProvincia) values('Madrid');
insert into casa_provincia (nombreProvincia) values('Málaga');
insert into casa_provincia (nombreProvincia) values('Murcia');
insert into casa_provincia (nombreProvincia) values('Navarra');
insert into casa_provincia (nombreProvincia) values('Orense');
insert into casa_provincia (nombreProvincia) values('Palencia');
insert into casa_provincia (nombreProvincia) values('Las Palmas');
insert into casa_provincia (nombreProvincia) values('Pontevedra');
insert into casa_provincia (nombreProvincia) values('La Rioja');
insert into casa_provincia (nombreProvincia) values('Salamanca');
insert into casa_provincia (nombreProvincia) values('Santa Cruz de Tenerife');
insert into casa_provincia (nombreProvincia) values('Segovia');
insert into casa_provincia (nombreProvincia) values('Sevilla');
insert into casa_provincia (nombreProvincia) values('Soria');
insert into casa_provincia (nombreProvincia) values('Tarragona');
insert into casa_provincia (nombreProvincia) values('Teruel');
insert into casa_provincia (nombreProvincia) values('Toledo');
insert into casa_provincia (nombreProvincia) values('Valencia');
insert into casa_provincia (nombreProvincia) values('Valladolid');
insert into casa_provincia (nombreProvincia) values('Vizcaya');
insert into casa_provincia (nombreProvincia) values('Zamora ');
insert into casa_provincia (nombreProvincia) values('Zaragoza');
insert into casa_provincia (nombreProvincia) values('Ceuta');
insert into casa_provincia (nombreProvincia) values('Melilla');