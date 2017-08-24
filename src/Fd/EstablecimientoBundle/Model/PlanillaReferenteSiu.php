<?php

namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

class PlanillaReferenteSiu extends PlanillaDeCalculo {
    
//    $datos es un array de objetos establecimiento_edificio que luego se transforma en datos de cada reglon de la pagina de salida

    protected function cargaDatos($datos, $em) {

        $encabezado[] = '#';
        $encabezado[] = 'Establecimiento';
        $encabezado[] = 'Referente';

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
            $anexo = !$ee->isSede() ? ' - ' . $ee->getNombre() : '';
            
            $columna = 'A';
            $posicion->setCellValue($columna . $fila, $fila - $this->fila_inicio_datos );
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $e->getNombre() . $anexo );
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $ee->getReferenteSiu());                                      
                        
            $fila += 1;
        };
    }

}
