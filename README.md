# taskManagement
 Gestor de tareas

Este es un proyecto de gestión de tareas con un formulario que . Permite crear, editar y ver tareas, Para este proyecto se utilizo sqlite como gestor de bases de datos, por temas de portabilidad

## Requisitos previos

Para ejecutar este proyecto necesitas tener instalados los siguientes programas:

- PHP (versión 8.2 o superior)
- Composer (para gestionar dependencias de PHP)
- Node.js (si necesitas ejecutar tareas de frontend como compilación de recursos)

## Instalación

1. Clona el repositorio en tu máquina local

2. Ingresa al directorio del proyecto.

3. Instala composer:
   
   ```composer install```

5. Crea un archivo .env copiando el archivo .env.example.

6. Ejecuta las migraciones para crear las tablas de la base de datos:

   ```php artisan migrate```

7. Instala las dependencias de frontend

   ```npm install```

8. Compila los recursos

   ```npm run dev```

## Ejecuta el proyecto

    php artisan migrate

   

