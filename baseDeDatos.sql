create database sastreria;
use sastreria;

create table persona
(
id integer not null auto_increment,
nombre varchar(40)not null,
apellido varchar(40)not null,
ci integer unique not null,
primary key (id)
);

create table rol
(
id integer not null auto_increment,
nombre varchar(30) unique not null,
descripcion varchar(100) not null,
primary key (id)
);

create table funcionalidad
(
id integer not null auto_increment,
nombre varchar(40) unique not null,
descripcion varchar(120),
primary key(id)
);

create table permiso_rol
(
id_rol integer not null,
id_funcionalidad integer not null,
primary key (id_rol, id_funcionalidad),
foreign key (id_funcionalidad) references funcionalidad(id)
	on update cascade on delete cascade,
foreign key (id_rol) references rol(id)
	on update cascade on delete cascade
);

create table usuario
(
id integer not null unique,
username varchar(30) unique not null,
email varchar(50) unique not null,
password varchar(60) not null,
activo bool not null default 0,
id_rol integer not null,
primary key (id),
foreign key (id) references persona(id)
	on update cascade on delete cascade,
foreign key (id_rol) references rol(id)
	on update cascade on delete cascade
);

create table almacen
(
id integer not null auto_increment,
nombre varchar(30) unique not null,
ubicacion varchar(100) not null,
primary key (id)
);

create table nota_ingreso
(
id integer not null auto_increment,
fecha datetime not null,
monto_total float default 0.0 check (monto_total>=0),
id_usuario integer not null,
id_almacen integer not null,
primary key (id),
foreign key (id_usuario) references usuario(id)
	on update cascade on delete cascade,
foreign key (id_almacen) references almacen(id)
	on update cascade on delete cascade
);

create table nota_salida
(
id integer not null auto_increment,
fecha datetime not null,
descripcion varchar(100) not null,
id_usuario integer not null,
id_almacen integer not null,
primary key (id),
foreign key (id_usuario) references usuario(id)
	on update cascade on delete cascade,
foreign key (id_almacen) references almacen(id)
	on update cascade on delete cascade
);

create table medida_material
(
id integer not null auto_increment,
tipo_medida varchar(20) not null,
activo bool not null default 0,
primary key (id)
);

create table material
(
id integer not null auto_increment,
nombre varchar(30) unique not null,
id_medida integer not null,
foreign key (id_medida) references medida_material(id)
	on update cascade on delete cascade,
primary key (id)
);



create table inventario
(
cantidad integer not null check (cantidad >= 0),
id_material integer not null,
id_almacen integer not null,
primary key (id_material,id_almacen),
foreign key (id_material) references material(id)
	on update cascade on delete cascade,
foreign key (id_almacen) references almacen(id)
	on update cascade on delete cascade
);

create table detalle_nota_ingreso
(
id integer not null auto_increment,
cantidad integer not null check (cantidad > 0),
precio float not null default 0.0 check (precio >= 0),
id_nota integer not null,
id_material integer not null,
primary key (id,id_nota),
foreign key (id_nota) references nota_ingreso(id)
	on update cascade on delete cascade,
foreign key (id_material) references material(id)
	on update cascade on delete cascade
);

create table detalle_nota_salida
(
id integer not null auto_increment,
cantidad integer not null check (cantidad > 0),
id_nota integer not null,
id_material integer not null,
primary key (id,id_nota),
foreign key (id_nota) references nota_salida(id)
	on update cascade on delete cascade,
foreign key (id_material) references material(id)
	on update cascade on delete cascade
);

create table bitacora
(
id integer not null auto_increment,
fechahora datetime not null,
id_usuario integer not null,
id_funcionalidad integer not null,
primary key (id),
foreign key (id_usuario) references usuario(id)
	on update cascade on delete cascade,
foreign key (id_funcionalidad) references funcionalidad(id)
	on update cascade on delete cascade
);

create table cliente
(
id integer unique not null,
direccion varchar(30)not null,
primary key (id),
foreign key (id) references persona(id)
	on update cascade on delete cascade
);

create table telefono
(
numero integer unique not null,
tipo bool not null, -- 0=personal  1=referencia
id_cliente integer not null,
primary key (numero),
foreign key (id_cliente) references cliente(id)
	on update cascade on delete cascade
);

create table pedido
(
id integer not null auto_increment,
fecha_recepcion datetime not null,
estado_avance decimal (3,2) default 0.00 not null check (estado_avance >= 0 and estado_avance <= 1), -- estado en % del avance total del pedido
id_usuario integer not null,
id_cliente integer not null,
tipo bool not null, -- 0=personal   1=grupal
primary key (id),
foreign key (id_usuario) references usuario(id)
	on update cascade on delete cascade,
foreign key (id_cliente) references cliente(id)
	on update cascade on delete cascade
);

create table fecha_pago
(
id integer not null auto_increment,
fecha datetime not null,
descripcion varchar(100),
id_pedido integer not null, -- t=terminado  c=creado  p=proceso
primary key (id,id_pedido),
foreign key (id_pedido) references pedido(id)
	on update cascade on delete cascade
);

create table medida
(
id integer not null auto_increment,
nombre varchar(30) unique not null,
eliminado bool not null default 0,
primary key (id)
);

create table vestimenta
(
id integer not null auto_increment,
nombre varchar(30) unique not null,
genero bool not null, -- 0=mujer   1=hombre
activo bool not null default 0,
primary key (id)
);

create table medida_necesaria
(
id_vestimenta integer not null,
id_medida integer not null,
primary key (id_vestimenta, id_medida),
foreign key (id_vestimenta) references vestimenta(id)
    on update cascade on delete cascade,
foreign key (id_medida) references medida(id)
    on update cascade on delete cascade
);

create table unidad_vestimenta
(
id integer not null auto_increment,
estado bool not null default 0, -- 0=no hecho    1=terminado
id_pedido integer not null,
id_vestimenta integer not null,
id_cliente integer not null,
primary key (id),
foreign key (id_pedido) references pedido(id)
    on update cascade on delete cascade,
foreign key (id_vestimenta) references vestimenta(id)
    on update cascade on delete cascade,
foreign key (id_cliente) references cliente(id)
    on update cascade on delete cascade
);

create table detalle_pedido
(
id integer not null auto_increment,
cantidad integer not null,
id_pedido integer not null,
id_vestimenta integer not null,
primary key (id,id_pedido),
foreign key (id_pedido) references pedido(id)
    on update cascade on delete cascade,
foreign key (id_vestimenta) references vestimenta(id)
    on update cascade on delete cascade
);

create table medida_vestimenta
(
id integer not null auto_increment,
valor decimal(5,2) not null,
id_unidad_vestimenta integer not null,
id_medida integer not null,
primary key(id,id_unidad_vestimenta),
foreign key(id_unidad_vestimenta) references unidad_vestimenta(id)
    on update cascade on delete cascade,
foreign key(id_medida) references medida(id)
    on update cascade on delete cascade
);

create table cambio
(
id integer not null auto_increment,
fecha datetime not null,
nuevo_valor decimal(5,2) not null,
id_medida_vestimenta integer not null,
primary key(id),
foreign key(id_medida_vestimenta) references medida_vestimenta(id)
    on update cascade on delete cascade
);

-- DROP database SASTRERIA;

-- Triggers and stored procedures

-- triggers para notas de ingreso
delimiter $$
create trigger tr_ai_detalle_nota_ingreso after insert on detalle_nota_ingreso
for each row
begin
call actualizar_monto_total_nota_ingreso(new.id);
call sumar_cantidad_inventario(new.id, 0);
end $$
 
create trigger tr_bu_detalle_nota_ingreso before update on detalle_nota_ingreso
for each row
begin
call restar_cantidad_inventario(old.id, 0);
end $$

create trigger tr_au_detalle_nota_ingreso after update on detalle_nota_ingreso
for each row
begin
call actualizar_monto_total_nota_ingreso(new.id);
call sumar_cantidad_inventario(new.id, 0);
end $$

create trigger tr_bd_detalle_nota_ingreso before delete on detalle_nota_ingreso
for each row
begin
call actualizar_monto_total_nota_ingreso(old.id);
call restar_cantidad_inventario(old.id, 0);
end $$

-- Triggers para las notas de salida
create trigger tr_ai_detalle_nota_salida after insert on detalle_nota_salida
for each row
begin
call restar_cantidad_inventario(new.id, 1);
end $$

create trigger tr_bu_detalle_nota_salida before update on detalle_nota_salida
for each row
begin
call sumar_cantidad_inventario(old.id, 1);
end $$

create trigger tr_au_detalle_nota_salida after update on detalle_nota_salida
for each row
begin
call restar_cantidad_inventario(new.id, 1);
end $$

create trigger tr_bd_detalle_nota_salida before delete on detalle_nota_salida
for each row
begin
call sumar_cantidad_inventario(old.id, 1);
end $$

-- Procedimientos almacenados
create procedure actualizar_monto_total_nota_ingreso (in id_detalle_nota int)
begin
	update nota_ingreso set monto_total = (select sum(cantidad * precio) from detalle_nota_ingreso 
											where id_nota = (select id_nota from detalle_nota_ingreso where id = id_detalle_nota))
	where id = (select id_nota from detalle_nota_ingreso where id = id_detalle_nota);
end $$

create procedure sumar_cantidad_inventario (in id_detalle_nota int, in bandera int)
begin
    if (bandera = 0) then
		update inventario set cantidad = cantidad + (select cantidad from detalle_nota_ingreso where id = id_detalle_nota)
		where id_material = (select id_material from detalle_nota_ingreso where id = id_detalle_nota limit 1) and id_almacen = (select id_almacen from nota_ingreso 
						where id = (select id_nota from detalle_nota_ingreso where id = id_detalle_nota) limit 1);
	else
		update inventario set cantidad = cantidad + (select cantidad from detalle_nota_salida where id = id_detalle_nota)
		where id_material = (select id_material from detalle_nota_salida where id = id_detalle_nota limit 1) and id_almacen = (select id_almacen from nota_salida
						where id = (select id_nota from detalle_nota_salida where id = id_detalle_nota) limit 1);
	end if;
end $$

create procedure restar_cantidad_inventario (in id_detalle_nota int, in bandera int)
begin
	if (bandera = 0) then
		update inventario set cantidad = cantidad - (select cantidad from detalle_nota_ingreso where id = id_detalle_nota)
		where id_material = (select id_material from detalle_nota_ingreso where id = id_detalle_nota limit 1) and id_almacen = (select id_almacen from nota_ingreso 
						where id = (select id_nota from detalle_nota_ingreso where id = id_detalle_nota) limit 1);
	else
		update inventario set cantidad = cantidad - (select cantidad from detalle_nota_salida where id = id_detalle_nota)
		where id_material = (select id_material from detalle_nota_salida where id = id_detalle_nota limit 1) and id_almacen = (select id_almacen from nota_salida 
						where id = (select id_nota from detalle_nota_salida where id = id_detalle_nota) limit 1);
    end if;
end $$

delimiter ;

-- data population

insert into persona values(null,'Cristhian','camacho',1234567);
insert into persona values(null,'Ruddy G','Quispe Huanca',8461543);
insert into persona values(null,'Maria','Hernades',846185);

insert into rol values(null,'Administrador general', 'usuario con el máximo control del sistema');
insert into rol values(null,'Administrador', 'administra las funcionalidades de servicio e inventario');
insert into rol values(null,'Atención al cliente', 'tiene acceso a funcionalidades básicas de atención al cliente');

insert into funcionalidad values(null,'adm.usuario','Permite controlar los aspectos relacionados con los usuarios.');
insert into funcionalidad values(null,'adm.servicio','Permite controlar los aspectos relacionados con los servicios.');
insert into funcionalidad values(null,'adm.inventario','Permite controlar los aspectos relacionados con el inventario.');

insert into funcionalidad values(null,'usuario.ver','permite visualizar los usuarios registrados en el sistema');
insert into funcionalidad values(null,'usuario.crear','permite registrar nuevos usuarios en el sistema');
insert into funcionalidad values(null,'usuario.modificar','permite modificar los usuarios registrados en el sistema');
insert into funcionalidad values(null,'usuario.inhabilitar','permite inhabilitar usuarios registrados en el sistema');
insert into funcionalidad values(null,'usuario.habilitar','permite habilitar usuarios registrados en el sistema');

insert into funcionalidad values(null,'rol.ver','permite ver los roles registrados en el sistema');
insert into funcionalidad values(null,'rol.crear','permite crear nuevos roles en el sistema');
insert into funcionalidad values(null,'rol.modificar','permite modificar los roles registrados en el sistema');
insert into funcionalidad values(null,'rol.eliminar','permite eliminar los roles registrados en el sistema');

insert into funcionalidad values(null,'funcionalidad.ver','permite ver las funcionalidades registradas en el sistema');
insert into funcionalidad values(null,'funcionalidad.crear','permite crear nuevas funcionalidades en el sistema');
insert into funcionalidad values(null,'funcionalidad.modificar','permite modificar las funcionalidades registradas en el sistema');
insert into funcionalidad values(null,'funcionalidad.eliminar','permite eliminar las funcionalidades registradas en el sistema');

insert into funcionalidad values(null,'cliente.ver','permite ver los clientes registrados en el sistema');
insert into funcionalidad values(null,'cliente.crear','permite crear nuevos clientes en el sistema');
insert into funcionalidad values(null,'cliente.modificar','permite modificar los clientes registrados en el sistema');
insert into funcionalidad values(null,'cliente.eliminar','permite eliminar los clientes registrados en el sistema');

insert into funcionalidad values(null,'pedido.ver','permite ver todo los pedidos y sus estados');
insert into funcionalidad values(null,'pedido.crear','permite crear nuevos pedidos');
insert into funcionalidad values(null,'pedido.modificar','permite modificar los pedidos creados');
insert into funcionalidad values(null,'pedido.eliminar','permite eliminar un pedido');
-- --------------------------------------------------------------------------------------------
insert into funcionalidad values(null,'vestimenta.ver','permite ver las vestimentas disponibles');
insert into funcionalidad values(null,'vestimenta.crear','permite añadir una nueva vestimenta');
insert into funcionalidad values(null,'vestimenta.modificar','permite modificar los datos de una vestimenta');
insert into funcionalidad values(null,'vestimenta.eliminar','permite eliminar una vestimenta');

insert into permiso_rol values(1,1);
insert into permiso_rol values(1,2);
insert into permiso_rol values(1,3);
insert into permiso_rol values(1,4);
insert into permiso_rol values(1,5);
insert into permiso_rol values(1,6);
insert into permiso_rol values(1,7);
insert into permiso_rol values(1,8);
insert into permiso_rol values(1,9);
insert into permiso_rol values(1,10);
insert into permiso_rol values(1,11);
insert into permiso_rol values(1,12);
insert into permiso_rol values(1,13);
insert into permiso_rol values(1,14);
insert into permiso_rol values(1,15);
insert into permiso_rol values(1,16);
insert into permiso_rol values(1,17);
insert into permiso_rol values(1,18);
insert into permiso_rol values(1,19);
insert into permiso_rol values(1,20);
insert into permiso_rol values(1,21);
insert into permiso_rol values(1,22);
insert into permiso_rol values(1,23);
insert into permiso_rol values(1,24);
insert into permiso_rol values(1,25);
insert into permiso_rol values(1,26);
insert into permiso_rol values(1,27);
insert into permiso_rol values(1,28);

insert into permiso_rol values(3,2);
insert into permiso_rol values(3,3);
insert into permiso_rol values(3,21);
insert into permiso_rol values(3,22);
insert into permiso_rol values(3,23);
insert into permiso_rol values(3,24);

insert into permiso_rol values(2,1);
insert into permiso_rol values(2,2);
insert into permiso_rol values(2,3);
insert into permiso_rol values(2,4);
insert into permiso_rol values(2,9);
insert into permiso_rol values(2,13);
insert into permiso_rol values(2,17);
insert into permiso_rol values(2,18);
insert into permiso_rol values(2,19);
insert into permiso_rol values(2,20);
insert into permiso_rol values(2,21);
insert into permiso_rol values(2,22);
insert into permiso_rol values(2,23);
insert into permiso_rol values(2,24);
insert into permiso_rol values(2,25);
insert into permiso_rol values(2,26);
insert into permiso_rol values(2,27);
insert into permiso_rol values(2,28);

-- password generica = "password"
insert into usuario values(1,'cristhian.12','cris@g.com',"$2y$10$xfCjPsLbzzkr/1/SdKkXguQklMdzijidvbbxMUrJsSiaeb1S5IiYC", 0 ,1);
insert into usuario values(2,'gonzaloqh','ruddygonzqh@gmail.com', "$2y$10$xfCjPsLbzzkr/1/SdKkXguQklMdzijidvbbxMUrJsSiaeb1S5IiYC", 0,1);

insert into almacen values(null,'tienda 1','av. ballivian puesto/105');

insert into nota_ingreso values(null,now(),0.0,1,1);
insert into nota_ingreso values(null,now(),0.0,1,1);

-- id, fecha, descripcion, id_usuario, id_almacen 
insert into nota_salida values(null,now(), "Descripcion de prueba", 1, 1);

insert into medida_material values(null,'metros',0);
insert into medida_material values(null,'unidades',0);
insert into medida_material values(null, 'cm',0);

insert into material values(null,'Tela optima',1);
insert into material values(null,'Tela roja',1);
insert into material values(null,'Tela casimir',1);
insert into material values(null,'Botones',2);
insert into material values(null,'Cierres',2);

insert into inventario values(0,1,1);
insert into inventario values(0,2,1);
insert into inventario values(0,3,1);
insert into inventario values(0,4,1);
insert into inventario values(0,5,1);

-- id, cantidad, precio, id_nota, id_material
insert into detalle_nota_ingreso values(null, 5, 10, 1, 1);
insert into detalle_nota_ingreso values(null, 2, 10, 2, 2);

-- id, cantidad, id_nota, id_material
insert into detalle_nota_salida values(null, 1, 1, 2);

insert into cliente values(3,'av/lujan');
insert into telefono values(70015434,0,3);

insert into pedido values(null,now(),0,2,3,0);

insert into fecha_pago values(null,now(),'primer pago',1);

--									mujer
insert into vestimenta values(1,'saco mujer',0,0);
insert into vestimenta values(2,'camisa mujer',0,0);
insert into vestimenta values(3,'pantalón mujer',0,0);
insert into vestimenta values(4,'chaleco mujer',0,0);
insert into vestimenta values(5,'polera mujer',0,0);
insert into vestimenta values(6,'falda',0,0);

--									hombre 

insert into vestimenta values(7,'saco hombre',1,0);
insert into vestimenta values(8,'camisa hombre',1,0);
insert into vestimenta values(9,'pantalón hombre',1,0);
insert into vestimenta values(10,'chaleco hombre',1,0);
insert into vestimenta values(11,'polera hombre',1,0);



insert into medida values(1,'cintura',0);
insert into medida values(2,'largo espalda',0);
insert into medida values(3,'pecho',0);
insert into medida values(4,'talla',0);
insert into medida values(5,'largo',0);
insert into medida values(6,'hombro',0);
insert into medida values(7,'largo manga',0);
insert into medida values(8,'ancho pie',0);
insert into medida values(9,'ancho brazo',0);
insert into medida values(10,'cadera',0);
insert into medida values(11,'ancho pierna',0);
insert into medida values(12,'largo falda',0);
insert into medida values(13,'bota pie',0);
insert into medida values(14,'cuello',0); 

-- hombre
-- saco hombre pecho, espalda,  cuello,  largo,  hombro,  largo manga
insert into medida_necesaria values(7, 3); -- pecho
insert into medida_necesaria values(7, 2); -- espalda
insert into medida_necesaria values(7, 5); -- largo
insert into medida_necesaria values(7, 6); -- hombro
insert into medida_necesaria values(7, 14); -- cuello
insert into medida_necesaria values(7, 7); -- largo manga
-- camisa hombre pecho, largo, hombro, ancho brazo, largo manga, cuello
insert into medida_necesaria values(8, 3); -- pecho
insert into medida_necesaria values(8, 5); -- largo
insert into medida_necesaria values(8, 6); -- hombro
insert into medida_necesaria values(8, 9); -- ancho brazo
insert into medida_necesaria values(8, 7); -- largo manga
insert into medida_necesaria values(8, 14); -- cuello
-- pantalon hombre cintura, cadera, bota pie
insert into medida_necesaria values(9, 1); -- cintura
insert into medida_necesaria values(9, 10); -- cadera
insert into medida_necesaria values(9, 13); -- bota pie
-- chaleco hombre pecho talla largo
insert into medida_necesaria values(10, 3); -- pecho
insert into medida_necesaria values(10, 4); -- talla
insert into medida_necesaria values(10, 5); -- largo

-- polera hombre
insert into medida_necesaria values(11, 4); -- talla


-- mujer
-- saco mujer
insert into medida_necesaria values(1, 3); -- pecho
insert into medida_necesaria values(1, 1); -- cintura
insert into medida_necesaria values(1, 4); -- talla
insert into medida_necesaria values(1, 5); -- largo
insert into medida_necesaria values(1, 6); -- hombro
insert into medida_necesaria values(1, 7); -- largo manga
insert into medida_necesaria values(1, 8); -- ancho pie
-- camisa mujer pecho, cintura, talla, largo, hombro, ancho brazo, cuello
insert into medida_necesaria values(2, 3); -- pecho
insert into medida_necesaria values(2, 1); -- cintura
insert into medida_necesaria values(2, 4); -- talla
insert into medida_necesaria values(2, 5); -- largo
insert into medida_necesaria values(2, 6); -- hombro
insert into medida_necesaria values(2, 9); -- ancho brazo
insert into medida_necesaria values(2, 14); -- cuello
-- pantalon: cintura, cadera, largo, ancho pierna, bota pie
insert into medida_necesaria values(3,1);
insert into medida_necesaria values(3,10);
insert into medida_necesaria values(3,5);
insert into medida_necesaria values(3,11);
insert into medida_necesaria values(3,13);
-- falda: cintura, cadera, largo falda
insert into medida_necesaria values(6,1);
insert into medida_necesaria values(6,10);
insert into medida_necesaria values(6,12);
-- chaleco: pecho, cintura, talla
insert into medida_necesaria values(4,3);
insert into medida_necesaria values(4,1);
insert into medida_necesaria values(4,4);
-- polera: talla
insert into medida_necesaria values(5,4);

-- SELECT VESTIMENTA.NOMBRE, MEDIDA.NOMBRE, ID_MEDIDA FROM VESTIMENTA,MEDIDA, MEDIDA_NECESARIA WHERE ID_VESTIMENTA=VESTIMENTA.ID AND MEDIDA.ID=ID_MEDIDA AND GENERO=1 AND VESTIMENTA.nombre='CAMISA';

insert into unidad_vestimenta values(null,0,1,1,3);

insert into detalle_pedido values(null,1,1,1);

insert into medida_vestimenta values(null,40,1,1);
insert into medida_vestimenta values(null,50,1,2);

insert into cambio values(null,now(),48,2);
-- -----------------------------------------------------------------------------------------------------------------------------------
--							id    nombre   apellido   ci
insert into persona values(null,'laura','profesora',84617885);
insert into persona values(null,'a','alumno',84663185);
insert into persona values(null,'b','alumno',8468185);
insert into persona values(null,'c','alumno',8464185);
insert into persona values(null,'d','alumno',8461285);
--   					cliente   ubicacion
insert into cliente values(4,'av. virgen de lujan');
insert into cliente values(5,'av. virgen de lujan');
insert into cliente values(6,'av. virgen de lujan');
insert into cliente values(7,'av. virgen de lujan');
insert into cliente values(8,'av. virgen de lujan');

--							numero    priv/  cliente
insert into telefono values(70225411,0,    4);

--						  id     fecha  estado  trbajador   cliente  tp/peronsal, grpal
insert into pedido values(null,   now(),0      ,2,         4 ,     1);

-- 							id      fecha 	    descrip   id-pedid
insert into fecha_pago values(null,'2023-05-08','primer pago',2);
insert into fecha_pago values(null,'2023-05-10','segundo pago',2);
insert into fecha_pago values(null,'2023-05-15','tercer pago',2);
insert into fecha_pago values(null,'2023-05-20','pago final ',2);

-- INSERT INTO UNIDAD_VESTIMENTA VALUES(NULL,0,1,1,3);
--                                    ID  ESTADO  IDPEDI  IDVEST  IDCLIEN

-- CLIENTE B MUJER
insert into unidad_vestimenta values(null,0,       2,       1,       6); -- saco m
insert into unidad_vestimenta values(null,0,       2,       2,       6); -- camisa m

-- cliente c hombre
insert into unidad_vestimenta values(null,0,       2,       7,       7); -- saco h
insert into unidad_vestimenta values(null,0,       2,       8,       7); -- camisa h

--                                   id  cant   idpedi   idvestim
-- insert into detalle_pedido values(null, 1,      1,       1);

insert into detalle_pedido values(null,   1,      2,       1);
insert into detalle_pedido values(null,   1,      2,       2);
insert into detalle_pedido values(null,   1,      2,       7);
insert into detalle_pedido values(null,   1,      2,       8);

--                                   id    medida   id-uni-vest    idmedida
-- pecho, cintura, talla, largo, hombro, largo manga, ancho pie
-- saco alumna a 
insert into medida_vestimenta values(null,   50,        2,            3); 
insert into medida_vestimenta values(null,   44,        2,            5); 
insert into medida_vestimenta values(null,   42,        2,            4); 
-- camisa alumna a  pecho, cintura, talla, largo, hombro, ancho brazo, cuello
insert into medida_vestimenta values(null,   44,        3,            4); 
insert into medida_vestimenta values(null,   46,        3,            6); 
insert into medida_vestimenta values(null,   42,        3,            3); 

-- saco alumno b  pecho, espalda,  cuello,  largo,  hombro,  largo manga
insert into medida_vestimenta values(null,   50,        4,            3); 
insert into medida_vestimenta values(null,   44,        4,            5); 
insert into medida_vestimenta values(null,   42,        4,            4); 
-- camisa alumno b  pecho, cintura, talla, largo, hombro, ancho brazo, cuello
insert into medida_vestimenta values(null,   50,        5,            4); 
insert into medida_vestimenta values(null,   44,        5,            6); 
insert into medida_vestimenta values(null,   42,        5,            3); 

insert into cambio values(null,now(),48,2);