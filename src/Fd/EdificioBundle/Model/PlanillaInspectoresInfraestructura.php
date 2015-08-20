<?php

namespace Fd\EdificioBundle\Model;

use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

class PlanillaInspectoresInfraestructura extends PlanillaDeCalculo {

    protected function cargaDatos($datos) {

        $encabezado['A'] = 'Establecimiento';
        $encabezado['B'] = 'Nombre';
        $encabezado['C'] = 'TE';
        $encabezado['D'] = 'Email';

        $posicion = $this->phpExcelObject->getActiveSheet(0);

        foreach ($encabezado as $key => $value) {
            $posicion->setCellValue($key . $this->fila_inicio_datos, $value);
        }

        $fila = $this->fila_inicio_datos + 1;
        foreach ($datos as $dato) {
            $posicion->setCellValue('A' . $fila, $dato['apodo']
                    . '/' . $dato['anexo']
                    . ' - ' . $dato['calle']
                    . ' ' . $dato['altura']
            );
            $posicion->setCellValue('B' . $fila, $dato['apellido'] . ', ' . $dato['nombre']);
            $posicion->setCellValue('C' . $fila, $dato['te']);
            $posicion->setCellValue('D' . $fila, $dato['email']);
            $fila += 1;
        };
    }

}
