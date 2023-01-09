SET FOREIGN_KEY_CHECKS=0;
INSERT INTO `acceso` (`id`, `nombre_acceso`) VALUES (NULL, 'editar_productos');
INSERT INTO `acceso` (`id`, `nombre_acceso`) VALUES (NULL, 'editar_usuarios');
INSERT INTO `acceso` (`id`, `nombre_acceso`) VALUES (NULL, 'comprar');
INSERT INTO `acceso` (`id`, `nombre_acceso`) VALUES (NULL, 'reportes');
INSERT INTO `acceso` (`id`, `nombre_acceso`) VALUES (NULL, 'ejecutar_orden');
INSERT INTO `rol` (`id`, `nombre_rol`) VALUES (NULL, 'administrador');
INSERT INTO `rol` (`id`, `nombre_rol`) VALUES (NULL, 'vendedor');
INSERT INTO `rol` (`id`, `nombre_rol`) VALUES (NULL, 'cliente');
##ROL ADMIN
INSERT INTO `rol_has_acceso` (`rol_id`, `acceso_id`) VALUES (1, 1);
INSERT INTO `rol_has_acceso` (`rol_id`, `acceso_id`) VALUES (1, 2);
INSERT INTO `rol_has_acceso` (`rol_id`, `acceso_id`) VALUES (1, 3);
INSERT INTO `rol_has_acceso` (`rol_id`, `acceso_id`) VALUES (1, 4);
INSERT INTO `rol_has_acceso` (`rol_id`, `acceso_id`) VALUES (1, 5);
##ROL CLIENTE
INSERT INTO `rol_has_acceso` (`rol_id`, `acceso_id`) VALUES (3, 3);
##ROL VENDEDOR
INSERT INTO `rol_has_acceso` (`rol_id`, `acceso_id`) VALUES (2, 4);
INSERT INTO `rol_has_acceso` (`rol_id`, `acceso_id`) VALUES (2, 5);