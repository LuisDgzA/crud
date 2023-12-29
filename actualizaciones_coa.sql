CREATE TABLE proveedor_analisis(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    proveedor_id int(11) NOT NULL,
    analisis_id int(11),
    minimo int(11),
    maximo int(11)
);

ALTER TABLE `proveedor_analisis` ADD CONSTRAINT `fk_proveedor_analisis` FOREIGN KEY (`analisis_id`) REFERENCES `analisis`(`id_analisis`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
ALTER TABLE `proveedor_analisis` ADD CONSTRAINT `fk_proveedor_id` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 

CREATE TABLE proveedor_resultado(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    proveedor_analisis_id int(11) NOT NULL,
    lote varchar(100),
    resultado int(11),
    estatus varchar(100),
	comentarios varchar(100)
);

ALTER TABLE `proveedor_resultado` ADD CONSTRAINT `fk_proveedor_analisis_resultado` FOREIGN KEY (`proveedor_analisis_id`) REFERENCES `proveedor_analisis`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
