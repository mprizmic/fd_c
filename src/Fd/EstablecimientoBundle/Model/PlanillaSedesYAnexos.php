<?php

namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

class PlanillaSedesYAnexos extends PlanillaDeCalculo {

    protected function cargaDatos($datos) {

        $columna = 'A';
//        $columna += 1;
        $encabezado['A'] = '#';
        $encabezado['B'] = 'Nombre';
        $encabezado['C'] = 'Domicilio';
        $encabezado['D'] = 'Barrio';
        $encabezado['E'] = 'Email';
        $encabezado['F'] = 'URL';
        $encabezado['G'] = 'TE';

        $posicion = $this->phpExcelObject->getActiveSheet(0);

        foreach ($encabezado as $key => $value) {
            $posicion->setCellValue($key . $this->fila_inicio_datos, $value);
        }

        $fila = $this->fila_inicio_datos + 1;
        
        /// $datos tiene objetos establecimiento_edificio
        foreach ($datos as $ee) {
            
            //variables intermedias
            $e = $ee->getEstablecimientos();
            $ed = $ee->getEdificios();
            $d = $ed->getDomicilioPrincipal()->__toString();
            
            $posicion->setCellValue('B' . $fila, $e->getNombre()
                    . '/' . $ee->getCueAnexo()
                    . ' - ' . $ee->getNombre()
            );
            $posicion->setCellValue('C' . $fila, $d);
            $posicion->setCellValue('D' . $fila, $ed->getBarrio()->__toString());
            $posicion->setCellValue('E' . $fila, $ee->getEmail1());
            $posicion->setCellValue('F' . $fila, $e->getUrl());
            $posicion->setCellValue('G' . $fila, $ee->getTe1());
            $fila += 1;
        };
    }

}
