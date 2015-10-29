select nombreProducto as producto, descripcionMateria as Insumo, cantidadMateriaPorProducto, unidadDeMedida, precioBase as precioUnitario, precioBase*cantidadMateriaPorProducto as valorTotal_por_Insummo from productos 
join materiaprimaporproducto on idProductos = ProductosIdProductos
join materiaprima on idMateriaPrima_materiaPrima = idMateriaPrima