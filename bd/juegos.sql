use login;

create table t_juegos (id_juego int auto_increment,
    nombre varchar(150),
    anio varchar(150),
    precio int(5),
    empresa varchar(150),
    primary_key(id_juego));
ALTER TABLE t_juegos CONVERT TO CHARACTER SET utf8;


DROP procedure IF EXISTS `sp_mostrar_datos`;

DELIMITER $$
USE `login`$$
CREATE PROCEDURE `sp_mostrar_datos` ()
BEGIN
	select id_juego,
			nombre,
			anio,
			precio,
			empresa from t_juegos;
END$$

DELIMITER ;

DROP procedure IF EXISTS `sp_insertar_datos`;

DELIMITER $$
USE `login`$$
CREATE PROCEDURE `sp_insertar_datos` (in nombreI varchar(50),
in anioI varchar(50),
in precioI int(5),
in empresaI varchar(50))
BEGIN
	INSERT INTO t_juegos (nombre,
anio,
precio,
empresa) VALUES (nombreI, anioI, precioI, empresaI);
END$$

DELIMITER ;

DROP procedure IF EXISTS `sp_actualizar_datos`;

DELIMITER $$
USE `login`$$
CREATE PROCEDURE `sp_actualizar_datos` (in nombreU varchar(50),
in anioU varchar(50),
in precioU int(5),
in empresaU varchar(50), in idJuegoU int)
BEGIN
	UPDATE t_juegos set nombre = nombreU,
anio = anioU,
precio = precioU,
empresa = empresaU
WHERE id_juego=idJuegoU;
END$$

DELIMITER ;


DELIMITER $$
USE `login`$$
CREATE PROCEDURE `sp_eliminar_datos`(in idJuegoD int)
BEGIN
	delete from t_juegos where id_juego=idJuegoD;
END
END$$

DELIMITER ;

DROP procedure IF EXISTS `sp_obtener_regJuego`;

DELIMITER $$
USE `login`$$
CREATE PROCEDURE `sp_obtener_regJuego` (in idJuegoO int)
BEGIN
	select * from t_juegos 
    WHERE id_juego=idJuegoO;
END$$

DELIMITER ;



CREATE OR REPLACE function f_nation(p_codn number)
return varchar
as
	v_capital nation.capital%type;
BEGIN
	select capital into v_capital
	from nation where code = p_codn;
	return v_capital;
end;
/


DECLARE
	v_capi varchar(40);

BEGIN
	v_capi := f_nation(52);
	DBMS_OUTPUT.PUT_LINE(v_capi);
END;
/

