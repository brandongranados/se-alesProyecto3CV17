create database actividades;

use actividades;

create table usuarios (
idUsuario integer auto_increment primary key, email varchar(100) not null unique, nombreUsuario varchar(150) not null unique,
passwordUser varchar(100) not null unique, foto longblob, index(email)  
);

create unique index emailUserIndex on usuarios(email);

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
