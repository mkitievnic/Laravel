#php artisan infyom:scaffold Empleado            --fromTable --tableName=empleado              --skip=migration,test,api_controller,api_routes
#php artisan infyom:scaffold User                --fromTable --tableName=usuario              --skip=migration,model,test,api_controller,api_routes

#php artisan infyom:scaffold Sector                --fromTable --tableName=sector              --skip=migration,test,api_controller,api_routes
#php artisan infyom:scaffold Funcion                --fromTable --tableName=funcion              --skip=migration,test,api_controller,api_routes
#php artisan infyom:scaffold Curso                --fromTable --tableName=curso              --skip=migration,test,api_controller,api_routes
#php artisan infyom:scaffold Instructor                --fromTable --tableName=instructor              --skip=migration,test,api_controller,api_routes
#php artisan infyom:scaffold CursoFuncion                --fromTable --tableName=curso_funcion              --skip=migration,test,api_controller,api_routes,views,view
#php artisan infyom:scaffold Material                --fromTable --tableName=material              --skip=migration,test,api_controller,api_routes

# php artisan infyom:scaffold DiaFranco                --fromTable --tableName=dia_franco              --skip=migration,test,api_controller,api_routes
# php artisan infyom:scaffold Proveedor                --fromTable --tableName=proveedor              --skip=migration,test,api_controller,api_routes
# php artisan infyom:scaffold Evento                --fromTable --tableName=evento              --skip=migration,test,api_controller,api_routes
#php artisan infyom:scaffold Participante                --fromTable --tableName=participante              --skip=migration,test,api_controller,api_routes
#php artisan infyom:scaffold Pregunta                --fromTable --tableName=pregunta              --skip=migration,test,api_controller,api_routes
#php artisan infyom:scaffold Opcion                --fromTable --tableName=opcion              --skip=migration,test,api_controller,api_routes,views,view
#php artisan infyom:scaffold Examen                --fromTable --tableName=examen              --skip=migration,test,api_controller,api_routes
php artisan infyom:scaffold PreguntaFrecuente                --fromTable --tableName=pregunta_frecuente              --skip=migration,test,api_controller,api_routes
