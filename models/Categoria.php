<?php
class Categoria extends Conectar{
    public function get_categoria(){
        $conectar=parent::conexion();
        parent::set_names();
        $sql="SELECT * from producto ";
        $sql=$conectar ->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    
        public function get_categoria_x_id($producto_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * from producto";
            $sql=$conectar ->prepare($sql);
            $sql->bindValue(1, $producto_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_categoria($id_ingreso, $id_producto, $cantidad_ingresada, $fecha_ingreso){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO ingreso (id_ingreso,id_producto, cantidad_ingresada, fecha_ingreso)
            VALUES (?,?, ?, ?)";
            $sql=$conectar ->prepare($sql);
            $sql->bindValue(1,  $id_ingreso);
            $sql->bindValue(2, $id_producto);
            $sql->bindValue(3,  $cantidad_ingresada);
            $sql->bindValue(4,  $fecha_ingreso);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_categoria2($id_venta, $id_producto, $cantidad, $fecha){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO venta (id_venta,id_producto, cantidad,fecha)
            VALUES (?, ?, ?, ?)";
            $sql=$conectar ->prepare($sql);
            $sql->bindValue(1,  $id_venta);
            $sql->bindValue(2, $id_producto);
            $sql->bindValue(3,  $cantidad);
            $sql->bindValue(4,  $fecha);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_categoria($id_producto){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE producto AS p
                    JOIN (
                        SELECT id_producto, SUM(cantidad_ingresada) AS total_ingresado
                        FROM ingreso
                        WHERE id_producto = ? 
                        GROUP BY id_producto
                    ) i ON p.id_producto = i.id_producto
                    SET p.Cantidad_existente = p.Cantidad_existente + i.total_ingresado";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,  $id_producto);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function update_categoria2($id_producto){
            $conectar=parent::conexion();
            parent::set_names();
            $sql= "UPDATE producto p
            JOIN (
                SELECT id_producto, SUM(cantidad) AS total_vendido
                FROM venta
                WHERE id_producto = ?
                GROUP BY id_producto
            ) v ON p.id_producto = v.id_producto
            SET p.Cantidad_existente = p.Cantidad_existente - IFNULL(v.total_vendido, 0);
            ";
            $sql=$conectar ->prepare($sql);
            $sql->bindValue(1,  $id_producto);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_categoria3($id_venta, $cantidad){
            $conectar=parent::conexion();
            parent::set_names();
            $sql= "UPDATE venta SET cantidad = ? WHERE venta.id_venta = ?;
            ";
            $sql=$conectar ->prepare($sql);
            $sql->bindValue(1,  $id_venta);
            $sql->bindValue(2,  $cantidad);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }


        

        public function delete_categoria($producto_id, ){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="DELETE FROM productos WHERE producto_id= ?";
            $sql=$conectar ->prepare($sql);
            $sql->bindValue(1, $producto_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
}

?>