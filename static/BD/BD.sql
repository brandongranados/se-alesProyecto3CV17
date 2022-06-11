create database actividades;

use actividades;

create table usuarios (
idUsuario integer auto_increment primary key, email varchar(100) not null unique, nombreUsuario varchar(150) not null unique,
passwordUser varchar(100) not null unique, foto longblob, index(email)  
);
create unique index emailUserIndex on usuarios(email);
/*El usuario dependiente es el usurio que tiene un usuario padre o  que los puede controlar*/
create table usuarioDependiente (						
idUsuario integer, idUsuarioDep integer, primary key(idUsuario, idUsuarioDep), foreign key(idUsuario) references usuarios (idUsuario) 
on delete cascade on update cascade, foreign key(idUsuarioDep) references usuarios (idUsuario) on delete cascade on update cascade
);
create table tarea (
idTarea integer auto_increment primary key, nombreTarea varchar(100) not null unique, valorPuntos bigint not null, fechaHora datetime not null
);
create unique index tareandexNombre on tarea(nombreTarea);
create table tareaRealizada (
idTarea integer, idUsuario integer, primary key(idTarea, idUsuario), avancePuntos bigint, foreign key(idTarea) references tarea (idTarea)
on delete cascade on update cascade, foreign key(idUsuario) references usuarios(idUsuario) on delete cascade on update cascade 
);
create table recompensa (
idRecompensa integer auto_increment primary key, nombreRecompensa varchar(100) not null unique, puntosCuesta bigint not null, foto longblob
);
create unique index indexRecompensa on recompensa(nombreRecompensa);
create table recompensaUsuario (
idRecompensa integer, idUsuario integer, primary key(idRecompensa, idUsuario), foreign key(idRecompensa) references recompensa(idRecompensa)
on delete cascade on update cascade, foreign key(idUsuario) references usuarios(idUsuario) on delete cascade on update cascade
);

/*CONSULTAS DE SQL PARA INSERTAR DATOS DE PRUEBAS*//*SINTAXIS A SEGUIR PARA INSERTAR DEDE PHP*/

start transaction;
insert into usuarios (email, nombreUsuario, passwordUser, foto) values
("example1@example.com", "prueba1", "12345", null), ("example2@example.com", "prueba2", "123456", null), ("example3@example.com", "prueba3", "1234567", null),
("example4@example.com", "prueba4", "12345678", null), ("example5@example.com", "prueba5", "123456789", null);
commit;

start transaction;
insert into usuarioDependiente values (1, 2), (1, 5), (3, 4);
commit;

start transaction;
insert into tarea (nombreTarea, valorPuntos, fechaHora) values("tarea1", 525689, '2011-12-18 13:17:17'), 
("tarea2", 1000, '2021-05-01 08:55:29'), ("tarea3", 385, '1998-10-12 17:01:37'), ("tarea4", 97, '2015-09-30 21:17:17'), ("tarea5", 12, '2001-03-03 11:11:11');
commit;

start transaction;
insert into tareaRealizada values (1, 1, 10), (2, 2, 100), (3, 3, 10);
commit;

start transaction;
insert into recompensa (nombreRecompensa, puntosCuesta, foto) values ("exito", 1000, null), ("exito2", 2000, null), ("exito3", 3000, null), ("exito4", 4000, null),
("exito5", 5000, null);
commit;

start transaction;
insert into recompensaUsuario values (1, 1), (2, 2), (3, 3);
commit;

/*Consultas de select de prueba*/

select * from usuarios;
select * from usuarioDependiente;
select * from tarea;
select * from tareaRealizada;
select * from recompensa;
select * from recompensaUsuario;

/*CONSULTAS PARA USAR EN FUNCIONES ESPECIFICAS PHP*/
/*MOSTRAR DATOS PANTALLA USERS*/

/*CON ESTA CONSULTA DESPLEGAMOS EL EMAIL DEL USUARIO, EL NOMBRE DEL USUARIO Y LA FOTO DEL USUARIO
CON ELLO DESPLEGAMOS LAS TAREAS QUE TIENE ASIGNADAS COMO EL NOMBRE DE LA TAREA, EL VALOR QUE TIENE EN PUNTOS LA TAREA, LA FECHA EN QUE SE REGISTRO LA TAREA
Y POR ULTIMO DESPLEGAMOS LOS PUNTOS QUE EL USUARIO LLEVA CUMPLIDOS PARA LOGRAR LA RECOMPENSA DE DICHA TAREA
SE UTILIZA LA BUSQUEDA CON EL EMAIL DEL USUARIO YA QUE TIENE UN INDEX Y LO HACE MAS RAPIDO*/

select u.email, u.nombreUsuario, u.foto, tR.avancePuntos, t.nombreTarea, t.valorPuntos, t.fechaHora from 
(usuarios u inner join tareaRealizada tR on u.idUsuario = tR.idUsuario) inner join tarea t on t.idTarea = tR.idTarea
where u.email = "example1@example.com";

/*AÑADIR USUARIOS QUE DEPENDEN DE OTRO*/

create table usuarioDependiente (						
idUsuario integer, idUsuarioDep integer, primary key(idUsuario, idUsuarioDep), foreign key(idUsuario) references usuarios (idUsuario) 
on delete cascade on update cascade, foreign key(idUsuarioDep) references usuarios (idUsuario) on delete cascade on update cascade
);