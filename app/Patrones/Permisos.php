<?php

namespace App\Patrones;

class Permisos
{
    public static function getColorEstado($estado){
        if($estado === EstadoEvento::Pendiente)
            return "label label-default";
        if($estado === EstadoEvento::EnEjecucion)
            return "label label-success";
        if($estado === EstadoEvento::Cancelado)
            return "label label-danger";
        if($estado === EstadoEvento::Finalizado)
            return "label label-info";
    }

    public static function esAdministrador()
    {
        $niveles = [Rol::Administrador];
        return auth()->user()->hasNiveles($niveles);
    }

    public static function esAvanzado()
    {
        $niveles = [Rol::Administrador, Rol::Avanzado];
        return auth()->user()->hasNiveles($niveles);
    }

    public static function esMedio()
    {
        $niveles = [Rol::Administrador, Rol::Avanzado, Rol::Medio];
        return auth()->user()->hasNiveles($niveles);
    }

    public static function esInicial()
    {
        $niveles = [Rol::Administrador, Rol::Avanzado, Rol::Medio, Rol::Inicial];
        return auth()->user()->hasNiveles($niveles);
    }

    //rutas
    public static function nivelAdministrador()
    {
        return sprintf("niveles:%s", Rol::Administrador);
    }

    public static function nivelAvanzado()
    {
        return sprintf("niveles:%s,%s", Rol::Administrador, Rol::Avanzado);
    }

    public static function nivelMedio()
    {
        return sprintf("niveles:%s,%s,%s", Rol::Administrador, Rol::Avanzado, Rol::Medio);
    }

    public static function nivelInicial()
    {
        return sprintf("niveles:%s,%s,%s,%s", Rol::Administrador, Rol::Avanzado, Rol::Medio, Rol::Inicial);
    }
}
