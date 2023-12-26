CREATE TABLE proveedor_analisis(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    proveedor_id int(11) NOT NULL,
    analisis_id int(11),
    minimo int(11),
    maximo int(11)
);

ALTER TABLE `proveedor_analisis` ADD CONSTRAINT `fk_proveedor_analisis` FOREIGN KEY (`analisis_id`) REFERENCES `analisis`(`id_analisis`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
ALTER TABLE `proveedor_analisis` ADD CONSTRAINT `fk_proveedor_id` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
