create database actividades;

use actividades;
/****************************************CREACION DE LA TABLA DE USUARIOS***********************************************/
create table usuarios (
idUsuario integer auto_increment primary key, email varchar(100) not null unique, nombreUsuario varchar(150) not null unique,
passwordUser varchar(100) not null unique, foto varchar(500)  
);

/********************************************crear el index con el email para realizar las busquedas mas rapido************************************/
create unique index emailUserIndex on usuarios(email);

/*El usuario dependiente es el usurio que tiene un usuario padre o  que los puede controlar, creacion de tabla usuario dependiente**************/

create table usuarioDependiente (						
idUsuario integer, idUsuarioDep integer, primary key(idUsuario, idUsuarioDep), foreign key(idUsuario) references usuarios (idUsuario) 
on delete cascade on update cascade, foreign key(idUsuarioDep) references usuarios (idUsuario) on delete cascade on update cascade
);

/*********************************************************CREACION DE TABLA TAREA****************************************************************/

create table tarea (
idTarea integer auto_increment, idUsuario integer, nombreTarea varchar(100) not null unique, valorPuntos bigint not null, fechaHora datetime not null, 
primary key(idTarea, idUsuario), foreign key(idUsuario) references usuarios (idUsuario) on delete cascade on update cascade
);

/*********************************************************CREACION DE INDEX CON EL NOMBRE DE LA TAREA*********************************************/

create unique index tareandexNombre on tarea(nombreTarea);

/********************************************************************CREACION DE TABLA TAREAREALIZADA*******************************************/

create table tareaRealizada (
idTarea integer, idUsuario integer, primary key(idTarea, idUsuarioDep), avancePuntos bigint, foreign key(idTarea) references tarea (idTarea)
on delete cascade on update cascade, foreign key(idUsuario) references usuarios(idUsuario) on delete cascade on update cascade 
);
/******************************************************CREACION DE LA TABLA DE RECOMPENSA***********************************************************/

create table recompensa (
idRecompensa integer auto_increment primary key, nombreRecompensa varchar(100) not null unique, puntosCuesta bigint not null, 
fechaHora datetime not null, foto varchar(500));

/***************************************************CREACION DE INDEX NOMBRE RECOMPENSA****************************************************************/

create unique index indexRecompensa on recompensa(nombreRecompensa);

/************************************************ CREACION DE TABLA DE RECOMPENSAUSUARIO******************************************************************/

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
insert into tarea (nombreTarea, valorPuntos, fechaHora, idUsuario) values("tarea1", 525689, '2011-12-18 13:17:17', 1), 
("tarea2", 1000, '2021-05-01 08:55:29', 1), ("tarea3", 385, '1998-10-12 17:01:37', 1), ("tarea4", 97, '2015-09-30 21:17:17', 2), ("tarea5", 12, '2001-03-03 11:11:11', 3);
commit;

start transaction;
insert into tareaRealizada values (1, 1, 1), (2, 3, 2), (4, 5, 3);
commit;

start transaction;
insert into recompensa (nombreRecompensa, puntosCuesta, fechaHora, foto) values ("exito", 1000, "2022-05-03 22:17:05", "../static/images/rewards/premio.png"), ("exito2", 2000, "2022-07-23 23:23:23", "../static/images/rewards/premio.png"), 
("exito3", 3000, "2022-12-12 22:22:22", "../static/images/rewards/premio.png"), ("exito4", 4000, "2012-12-12 10:10:10", "../static/images/rewards/premio.png"), ("exito5", 5000, "2010-10-10 07:07:07", "../static/images/rewards/premio.png");
commit;

start transaction;
insert into recompensaUsuario values (1, 1), (2, 2), (3, 3);
commit;

/*CONSULTAS PARA USAR EN FUNCIONES ESPECIFICAS PHP*/


/*MOSTRAR DATOS PANTALLA USERS*/

/*CON ESTA CONSULTA DESPLEGAMOS EL EMAIL DEL USUARIO, EL NOMBRE DEL USUARIO Y LA FOTO DEL USUARIO
CON ELLO DESPLEGAMOS LAS TAREAS QUE TIENE ASIGNADAS COMO EL NOMBRE DE LA TAREA, EL VALOR QUE TIENE EN PUNTOS LA TAREA, LA FECHA EN QUE SE REGISTRO LA TAREA
Y POR ULTIMO DESPLEGAMOS LOS PUNTOS QUE EL USUARIO LLEVA CUMPLIDOS PARA LOGRAR LA RECOMPENSA DE DICHA TAREA
SE UTILIZA LA BUSQUEDA CON EL EMAIL DEL USUARIO YA QUE TIENE UN INDEX Y LO HACE MAS RAPIDO
*******************************************************SIRVE PARA LA PANTALLA DE USUARIOS************************************************************************/

select u.idUsuario ,u.email, u.nombreUsuario, u.foto, tR.avancePuntos, t.idTarea, t.nombreTarea, t.valorPuntos, t.fechaHora from 
(usuarios u inner join tareaRealizada tR on u.idUsuario = tR.idUsuario) inner join tarea t on t.idTarea = tR.idTarea
where u.email = "example1@example.com";

/*PANTALLA DE TASK*/

/*ORDENA LAS TAREAS POR NOMBRE DE MAYOR A MENOR*/
select * from tarea order by nombreTarea desc;
/*ORDENA LAS TAREAS POR NOMBRE DE MENOR A MAYOR*/
select * from tarea order by nombreTarea asc;

/*ORDENA LAS TAREAS POR valor de puntos DE MAYOR A MENOR*/
select * from tarea order by valorPuntos desc;
/*ORDENA LAS TAREAS POR valor de puntos DE MENOR A MAYOR*/
select * from tarea order by valorPuntos asc;

/*ORDENA LAS TAREAS POR fecha hora creacion DE MAYOR A MENOR*/
select * from tarea order by date(fechaHora) desc, time(fechaHora) desc;
/*ORDENA LAS TAREAS POR fecha hora creacion DE MENOR A MAYOR*/
select * from tarea order by date(fechaHora) asc, time(fechaHora) asc;


/*MOSTRAR TAREAS CON LOS USUARIOS ASIGNADOS A ESA TAREA*/

/*CON ESTA CONSULTA DESPLEGAMOS EL EMAIL DEL USUARIO, EL NOMBRE DEL USUARIO Y LA FOTO DEL USUARIO
CON ELLO DESPLEGAMOS LAS TAREAS QUE TIENE ASIGNADAS COMO EL NOMBRE DE LA TAREA, EL VALOR QUE TIENE EN PUNTOS LA TAREA, LA FECHA EN QUE SE REGISTRO LA TAREA
Y POR ULTIMO DESPLEGAMOS LOS PUNTOS QUE EL USUARIO LLEVA CUMPLIDOS PARA LOGRAR LA RECOMPENSA DE DICHA TAREA
SE UTILIZA LA BUSQUEDA CON EL EMAIL DEL USUARIO YA QUE TIENE UN INDEX Y LO HACE MAS RAPIDO
*******************************************************SIRVE PARA LA PANTALLA DE TAREAS************************************************************************/

select u.idUsuario, u.email, u.nombreUsuario, u.foto, tR.avancePuntos, t.idTarea, t.nombreTarea, t.valorPuntos, t.fechaHora from 
(usuarios u inner join tareaRealizada tR on u.idUsuario = tR.idUsuario) inner join tarea t on t.idTarea = tR.idTarea
where u.email = "example1@example.com";

/***********************************************************PANTALLA DE RECOMPENSAS**********************************************************************************/

/*SE HACE LA RELACION DE RECOMPENSAS CON LOS USUARIOS MEDIANTE EL NOMBRE DE LA RECOMPENSA QUE ES MAS RAPIDO POR EL INDEX*/

select r.idRecompensa, r.nombreRecompensa, r.puntosCuesta, r.fechaHora, r.foto, u.idUsuario, u.email, u.nombreUsuario, u.foto from 
(recompensa r inner join recompensaUsuario rU on r.idRecompensa = rU.idRecompensa) inner join usuarios u on u.idUsuario = rU.idUsuario
where r.nombreRecompensa = "exito";

/*SE HACE EL ORDEN POR MEDIO DE EL NOMBRE DE LA RECOMPENSA DE MAYOR A MENOR*/
select * from recompensa order by nombreRecompensa desc;
/*SE HACE EL ORDEN POR MEDIO DE EL NOMBRE DE LA RECOMPENSA DE MENOR A MAYOR*/
select * from recompensa order by nombreRecompensa asc;
/*SE HACE EL ORDEN POR MEDIO DE LOS PUNTOS QUE CUESTA LA RECOMPENSA DE MAYOR A MENOR*/
select * from recompensa order by puntosCuesta desc;
/*SE HACE EL ORDEN POR MEDIO DE LOS PUNTOS QUE CUESTA LA RECOMPENSA DE MENOR A MAYOR*/
select * from recompensa order by puntosCuesta asc;
/*SE HACE EL ORDEN por medio de la fechaHOra en  RECOMPENSA DE MAYOR A MENOR*/
select * from recompensa order by date(fechaHora) desc, time(fechaHora) desc;
/*SE HACE EL ORDEN por medio de la fechaHOra en  RECOMPENSA DE MENOR A MAYOR*/
select * from recompensa order by date(fechaHora) asc, time(fechaHora) asc;
