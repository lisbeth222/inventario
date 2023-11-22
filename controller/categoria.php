<?php 
header("Content-Type: application/json");


require_once("../config/conexion.php");
require_once("../models/Categoria.php");

$categoria = new Categoria();
$body = json_decode(file_get_contents("php://input"), true);

switch($_GET["op"]){
   case "GetAll":
      $datos=$categoria-> get_categoria();
      echo json_encode($datos);
   break;

   case "GetId":
    $datos=$categoria-> get_categoria_x_id($body["producto_id"]);
    echo json_encode($datos);

    break;

    case "Insert":
        $datos=$categoria-> insert_categoria($body["id_ingreso"],$body["id_producto"],$body["cantidad_ingresada"], $body["fecha_ingreso"]);
        echo "insert correcto";
    
        break;
        case "Insert2":
            $datos=$categoria-> insert_categoria2($body["id_venta"],$body["id_producto"],$body["cantidad"], $body["fecha"]);
            echo "insert correcto";
        
            break;


        case "Update":
            $datos=$categoria-> update_categoria($body["id_producto"]);
            echo "Update correcto";
        
            break;

            case "Update2":
                $datos=$categoria-> update_categoria2($body["id_producto"]);
                echo "Update correcto";
                break;

                case "Update3":
                    $datos=$categoria-> update_categoria2($body["id_venta"],$body["cantidad"]);
                    echo "Update correcto";
                    break;

            case "Delete":
                $datos=$categoria-> delete_categoria($body["id_producto"]);
                echo "Delete correcto";
            
                break;
}
?>
