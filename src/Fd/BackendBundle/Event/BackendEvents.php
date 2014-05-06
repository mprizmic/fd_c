<?php

namespace Fd\BackendBundle\Event;

final class BackendEvents {
    /**
     * El evento unidad_educativa.nueva es lanzado cada vez que se crea una unidad educativa
     * en el sistema.
     *
     * El escucha del evento recibe una instancia de
     * Fd\BackendBundle\Event\UnidadEducativaNuevaEvent.
     *
     * @var string
     */
    const UNIDAD_EDUCATIVA_NUEVA = 'unidad_educativa.nueva';
    const UNIDAD_EDUCATIVA_BAJA = 'unidad_educativa.baja';
}
