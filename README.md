# Estudiantes: 
# Andrea Melissa Torres Batres y Alejandra María Baires Campos 

# Tienda en línea Walmart


# ¿Cómo manejan la conexión a la BD y qué pasa si algunos de los datos son incorrectos? Justifiquen la manera de validación de la conexión.
La conexión a la base de datos se realiza mediante el archivo `conexion.php`, el cual se incluye en los diferentes archivos del sistema utilizando:
include 'conexion.php'; Esto permite reutilizar la conexión en procesos como el inicio de sesión, el registro de productos y la visualización del catálogo.
Durante el inicio de sesión, el sistema consulta la tabla `usuarios` para verificar las credenciales. Si son correctas, se crea una sesión con `$_SESSION` y se redirige al usuario. En caso contrario, se muestra un mensaje de error.
También se validan datos antes de insertarlos, por ejemplo, se verifica que el nombre no esté vacío y que el precio sea mayor a cero.





# ¿Cuál es la diferencia entre $_GET y $_POST en PHP? ¿Cuándo es más apropiado usar cada uno? Da un ejemplo real de tu proyecto.
En el sistema se utilizan ambos métodos:

- **$_POST**
  Se usa para enviar datos desde formularios como login y registro de productos. No muestra la información en la URL.

- **$_GET**
  Se usa para acciones simples como cerrar sesión. Los datos son visibles en la URL.

  > Por lo tanto, $_POST se usa para datos sensibles y $_GET para acciones simples.




# Tu app va a usarse en una empresa de la zona oriental. ¿Qué riesgos de seguridad identificas en una app web con BD que maneja datos de los usuarios? ¿Cómo los mitigarían?
El sistema presenta algunos riesgos:

- Inyección SQL
- Contraseñas sin encriptar
- Validación limitada de datos

Para mejorar la seguridad lo solucionaria con estas recomendaciones:

- Usar consultas preparadas
- Encriptar contraseñas con `password_hash()`
- Validar y sanitizar los datos
- Controlar el acceso mediante sesiones


# En el mismo readme realizar un diccionario de datos con las tablas con el siguiente formato:

### Tabla: usuarios

| Columna  | Tipo de dato | Descripción                        |
|----------|-------------|------------------------------------|
| id       | INT         | Identificador único del usuario    |
| usuario  | VARCHAR(50) | Nombre de usuario                  |
| clave    | VARCHAR(100)| Contraseña del usuario             |
| rol      | VARCHAR(20) | Tipo de usuario en el sistema      |
| correo   | VARCHAR(100)| Correo electrónico                 |

---

### Tabla: productos

| Columna     | Tipo de dato   | Descripción                        |
|-------------|----------------|------------------------------------|
| id          | INT            | Identificador del producto         |
| nombre      | VARCHAR(100)   | Nombre del producto                |
| precio      | DECIMAL(10,2)  | Precio del producto                |
| categoria   | VARCHAR(50)    | Categoría del producto             |
| disponible  | TINYINT(1)     | Estado (1 = disponible, 0 = no)    |

---

Este README describe el funcionamiento del sistema y la estructura de la base de datos utilizada.
