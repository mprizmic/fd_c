<?php

namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

class PlanillaSedesYAnexos extends PlanillaDeCalculo {

    protected function cargaDatos($datos) {

        $encabezado[] = '#';
        $encabezado[] = 'Nombre';
        $encabezado[] = 'CUE';
        $encabezado[] = 'Domicilio';
        $encabezado[] = 'Barrio';
        $encabezado[] = 'Email';
        $encabezado[] = 'URL';
        $encabezado[] = 'TE';

        $posicion = $this->phpExcelObject->getActiveSheet(0);

        foreach ($encabezado as $key => $value) {
            //empiezo a poner datos en la columna A
            $posicion->setCellValue( chr($key + 65) . $this->fila_inicio_datos, $value);
        }

        $fila = $this->fila_inicio_datos + 1;
        
        /// $datos tiene objetos establecimiento_edificio
        foreach ($datos as $ee) {
            
            //variables intermedias
            $e = $ee->getEstablecimientos();
            $ed = $ee->getEdificios();
            $d = $ed->getDomicilioPrincipal()->__toString();
            
            $posicion->setCellValue('A' . $fila, $fila - $this->fila_inicio_datos );
            $posicion->setCellValue('B' . $fila, $e->getNombre()
                    . ' - ' . $ee->getNombre()
            );
            $posicion->setCellValue('C' . $fila, $e->getCue() . '/' . $ee->getCueAnexo());
            $posicion->setCellValue('D' . $fila, $d);
            $posicion->setCellValue('E' . $fila, $ed->getBarrio()->__toString());
            $posicion->setCellValue('F' . $fila, $ee->getEmail1());
            $posicion->setCellValue('G' . $fila, $e->getUrl());
            $posicion->setCellValue('H' . $fila, $ee->getTe1());
            $fila += 1;
        };
    }

}
