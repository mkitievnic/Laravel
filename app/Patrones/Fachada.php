<?php


namespace App\Patrones;


class Fachada
{
    public static $cantPreguntas = 10;

    public static function getRoles()
    {
        return [
            Rol::Administrador => Rol::Administrador,
            Rol::Inicial => Rol::Inicial,
            Rol::Medio => Rol::Medio,
            Rol::Avanzado => Rol::Avanzado,
        ];
    }

    public static function getEstadoEventos()
    {
        return [
            EstadoEvento::Pendiente => EstadoEvento::Pendiente,
            EstadoEvento::EnEjecucion => EstadoEvento::EnEjecucion,
            EstadoEvento::Finalizado => EstadoEvento::Finalizado,
            EstadoEvento::Cancelado => EstadoEvento::Cancelado,
        ];
    }

    public static function getDepartamets()
    {
        return [null => 'Seleccione'] + [
                'OR' => 'OR',
                'CH' => 'CH',
                'LP' => 'LP',
                'CB' => 'CB',
                'PT' => 'PT',
                'TJ' => 'TJ',
                'SC' => 'SC',
                'BE' => 'BE',
                'PD' => 'PD'
            ];
    }


    public static function setDateTime($soloFecha)
    {
        $hora = date('H:i:s');
        $fecha = $soloFecha . ' ' . $hora;
        return \DateTime::createFromFormat('d/m/Y H:i:s', $fecha);
    }

    public static function setDate($fecha)
    {
        $fecha = $fecha . ' 00:00:00';
        return \DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
    }

    public static function setDateDate($fechaCompleta)
    {
        $fecha = $fechaCompleta;
        return \DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
    }

    public static function getDateTimeServer()
    {
        $soloFecha = date('d/m/Y');
        $hora = date('H:i:s');
        $fecha = $soloFecha . ' ' . $hora;
        return \DateTime::createFromFormat('d/m/Y H:i:s', $fecha);
    }

    public static function getDateServer()
    {
        $soloFecha = date('d/m/Y') . '00:00:00';
        return \DateTime::createFromFormat('d/m/Y H:i:s', $soloFecha);
    }

    public static function getDateLiteral($fecha)
    {
        Date::setLocale('es');
        $fecha = \DateTime::createFromFormat('m/d/Y', $fecha);
        $date = new Date($fecha);
        return $date->format('j \d\e F \d\e Y');
    }

    public static function getDateTime()
    {
        return date('d/m/Y H:i:s');
    }

    public static function getDate()
    {
        return date('d/m/Y');
    }

    public static function getTipoInstructor()
    {
        return [
            'Proveedor' => 'Proveedor',
            'Propio' => 'Propio',
        ];
    }

    public static function getEmpleadosDisponibles($evento_id){
        $participantesEvento = \App\Models\Participante::whereEventoId($evento_id)->pluck('empleado_id');
        $empleados =  \App\Models\Empleado::whereNotIn('id', $participantesEvento)->get()->pluck('informacion','id');
        return $empleados;
    }
}
