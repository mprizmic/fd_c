<?php

namespace Fd\EdificioBundle\Event;

final class EdificioEvents {
    /**
     * El evento edificio.nuevo es lanzado cada vez que se crea un edificio
     * en el sistema.
     *
     * El escucha del evento recibe una instancia de
     * Fd\EdificioBundle\Event\EdificioNuevoEvent.
     *
     * @var string
     */
    const EDIFICIO_NUEVO = 'edificio.nuevo';
}
