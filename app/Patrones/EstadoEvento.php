<?php


namespace App\Patrones;


abstract class EstadoEvento
{
    const Pendiente = 'Pendiente';
    const EnEjecucion = 'En Ejecución';
    const Finalizado = 'Finalizado';
    const Cancelado = 'Cancelado';
}
