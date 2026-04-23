# Estudiantes: 
# Andrea Melissa Torres Batres y Alejandra María Baires Campos 

# Tienda en línea Walmart El Salvador 🛒🇸🇻

### Credenciales de acceso
---
```
Usuario: admin
Contraseña: 123
```
 ---

# ¿Cómo manejan la conexión a la BD y qué pasa si algunos de los datos son incorrectos? Justifiquen la manera de validación de la conexión.
La conexión a la base de datos se realiza mediante el archivo `conexion.php`, el cual se incluye en los diferentes archivos del sistema utilizando:
include 'conexion.php'; Esto permite reutilizar la conexión en procesos como el inicio de sesión, el registro de productos y la visualización del catálogo.
Durante el inicio de sesión, el sistema consulta la tabla `usuarios` para verificar las credenciales. Si son correctas, se crea una sesión con `$_SESSION` y se redirige al usuario. En caso contrario, se muestra un mensaje de error.
También se validan datos antes de insertarlos, por ejemplo, se verifica que el nombre no esté vacío y que el precio sea mayor a cero.





# ¿Cuál es la diferencia entre $_GET y $_POST en PHP? ¿Cuándo es más apropiado usar cada uno? Da un ejemplo real de tu proyecto.
En el sistema se utilizan ambos métodos:

En PHP, **$_GET y $_POST** son métodos utilizados para enviar datos desde el cliente (navegador) al servidor, pero se diferencian en la forma en que transmiten la información y en su uso. El método $_GET envía los datos a través de la URL, lo que significa que la información es visible en la barra de direcciones del navegador. Este método tiene una capacidad limitada de caracteres y no es recomendable para enviar datos sensibles. Es más apropiado usarlo cuando se realizan consultas simples o acciones de navegación, como obtener un identificador o ejecutar una acción rápida.

Por otro lado, $_POST envía los datos de manera oculta dentro de la petición HTTP, por lo que no se muestran en la URL. Permite enviar una mayor cantidad de información y es más seguro para manejar datos sensibles. Se utiliza principalmente en formularios donde se requiere insertar, actualizar o validar información.
**En el proyecto desarrollado, $_POST se utiliza en el inicio de sesión y en el registro de productos**. Por ejemplo, cuando el usuario ingresa su usuario y contraseña en el formulario de login, estos datos se envían mediante $_POST para ser validados en la base de datos. En cambio, $_GET se utiliza para acciones simples como cerrar sesión, donde se envía un parámetro en la URL (por ejemplo: index.php?logout=true) que el sistema interpreta para destruir la sesión activa.

---
Por lo tanto, $_POST es más adecuado para el envío de datos sensibles o formularios, mientras que $_GET se utiliza para acciones simples y consultas visibles en la URL.




# Tu app va a usarse en una empresa de la zona oriental. ¿Qué riesgos de seguridad identificas en una app web con BD que maneja datos de los usuarios? ¿Cómo los mitigarían?
El sistema presenta varios riesgos de seguridad que deben considerarse, especialmente al manejar datos de usuarios en una empresa:

- Inyección SQL: ocurre cuando se insertan datos directamente en las consultas sin validación, permitiendo que un atacante manipule la base de datos.
- Contraseñas sin encriptar: almacenar contraseñas en texto plano representa un alto riesgo en caso de filtración.
- Validación limitada de datos: permite el ingreso de información incorrecta o maliciosa.
- Accesos no autorizados: si no se controla correctamente la autenticación, cualquier usuario podría acceder a funciones restringidas.

Para mitigar estos riesgos, se proponen las siguientes soluciones:

- Utilizar consultas preparadas para evitar la inyección SQL.
- Encriptar las contraseñas utilizando funciones como `password_hash()` y verificarlas con `password_verify()`.
- Validar y sanitizar todos los datos ingresados por el usuario.
- Implementar control de acceso mediante sesiones para restringir el acceso a usuarios autenticados.
- Utilizar contraseñas seguras, combinando letras mayúsculas, minúsculas, números y caracteres especiales.

De esta manera, se mejora significativamente la seguridad del sistema y se protege la información de los usuarios.


# En el mismo readme realizar un diccionario de datos con las tablas con el siguiente formato:

### Nombre tabla: usuarios

| Columna | Tipo de dato | Límite de caracteres | ¿Es nulo? | Descripción                                      |
|---------|-------------|----------------------|----------|--------------------------------------------------|
| id      | INT         | 11                   | No       | Identificador único del usuario (AUTO_INCREMENT) |
| usuario | VARCHAR     | 50                   | No       | Nombre de usuario para iniciar sesión            |
| clave   | VARCHAR     | 100                  | No       | Contraseña del usuario                           |
| rol     | VARCHAR     | 20                   | No       | Rol del usuario (Administrador o Vendedor)       |
| correo  | VARCHAR     | 100                  | Sí       | Correo electrónico (puede ser nulo)              |

---

### Nombre tabla: productos

| Columna    | Tipo de dato | Límite de caracteres | ¿Es nulo? | Descripción                                           |
|------------|-------------|----------------------|----------|-------------------------------------------------------|
| id         | INT         | 11                   | No       | Identificador único del producto (AUTO_INCREMENT)      |
| nombre     | VARCHAR     | 100                  | No       | Nombre del producto                                   |
| precio     | DECIMAL     | 10,2                 | No       | Precio del producto                                   |
| categoria  | VARCHAR     | 50                   | No       | Categoría del producto                                |
| disponible | TINYINT     | 1                    | No       | Estado del producto (1 = disponible, 0 = no)          |



---
Este README describe el funcionamiento del sistema y la estructura de la base de datos utilizada. Así mismo Tienda en línea Walmart en su BD cuenta con dos tablas principales (`usuarios` y `productos`), cada una con más de cuatro campos. Además, se cumple con el requisito de incluir al menos un campo que permita valores nulos, siendo este el campo `correo` en la tabla `usuarios`.
