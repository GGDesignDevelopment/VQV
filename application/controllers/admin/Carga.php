<?php

class Carga extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
//        function sheetData($sheet, $catid) {
//            $x = 1;
//            while ($x <= $sheet['numRows']) {
//                $producto = array();
//                $producto['prodnombre'] = $sheet['cells'][$x][1];
//                $producto['proddes'] = $sheet['cells'][$x][2];
//                $producto['catid'] = $catid;
//                $producto['produnidad'] = $sheet['cells'][$x][3];
//                $producto['prodpresentacion'] = $sheet['cells'][$x][4]; 
//                $producto['prodprecio'] = $sheet['cells'][$x][5]; 
//                $IdProducto = $this->producto_m->save($producto, null);
//                $x++;
//            }
//        }

        include 'excel_reader.php';     // include the class
        $excel = new PhpExcelReader;
        $excel->read('temp\cargainicial.xls');
        $nr_sheets = count($excel->sheets);       // gets the number of worksheets

        for ($i = 0; $i < $nr_sheets; $i++) {
            $categoria = array();
            $categoria['catdescripcion'] = $excel->boundsheets[$i]['name'];
            $IdCategoria = $this->categoria_m->save($categoria, null);
            $sheet = $excel->sheets[$i];
            $lastrow = $sheet['cells'][1][1];

            $x = 2;
            while ($x <= $lastrow) {
                $producto = array();
                $producto['prodnombre'] = $sheet['cells'][$x][1];
                $producto['proddes'] = $sheet['cells'][$x][2];
                $producto['catid'] = $IdCategoria;
                $producto['produnidad'] = $sheet['cells'][$x][3];
                $producto['prodpresentacion'] = $sheet['cells'][$x][4];
                $producto['prodprecio'] = $sheet['cells'][$x][5];
                $IdProducto = $this->producto_m->save($producto, null);
                $x++;
            }
        }

        // echo $excel_data;      // outputs HTML tables with excel file data    
    }

}
