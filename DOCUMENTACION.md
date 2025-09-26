# 📋 DOCUMENTACIÓN COMPLETA - CRM LARAVEL

## 🎯 DESCRIPCIÓN DEL PROYECTO

Este es un sistema CRM (Customer Relationship Management) desarrollado en Laravel 11 que permite gestionar clientes, incidencias y facturas de manera integral.

## 🚀 CARACTERÍSTICAS PRINCIPALES

- ✅ **Gestión de Clientes**: CRUD completo para administrar base de clientes
- ✅ **Sistema de Incidencias**: Tickets de soporte y seguimiento de problemas
- ✅ **Facturación**: Gestión completa de facturas y estados de pago
- ✅ **Autenticación**: Sistema de login/registro con Laravel Breeze
- ✅ **Dashboard**: Panel principal con acceso rápido a todas las funciones
- ✅ **Responsive**: Diseño adaptativo con Tailwind CSS
- ✅ **Dark Mode**: Soporte para tema oscuro/claro

## 🗂️ ESTRUCTURA DEL PROYECTO

```
crm-laravel/
├── app/
│   ├── Http/Controllers/          # Controladores del sistema
│   │   ├── ClienteController.php      # Gestión de clientes
│   │   ├── IncidenciaController.php   # Gestión de incidencias  
│   │   ├── FacturaController.php      # Gestión de facturas
│   │   └── ProfileController.php     # Gestión de perfiles
│   └── Models/                    # Modelos Eloquent
│       ├── Cliente.php               # Modelo de cliente
│       ├── Incidencia.php           # Modelo de incidencia
│       ├── Factura.php              # Modelo de factura
│       └── User.php                 # Modelo de usuario
├── database/
│   ├── migrations/                # Migraciones de base de datos
│   │   ├── create_clientes_table.php
│   │   ├── create_incidencias_table.php
│   │   └── create_facturas_table.php
│   └── seeders/                   # Semillas de datos
├── resources/views/               # Vistas Blade
│   ├── dashboard.blade.php           # Dashboard principal
│   ├── layouts/
│   │   ├── app.blade.php            # Layout principal
│   │   └── navigation.blade.php     # Navegación
│   ├── clientes/                    # Vistas de clientes
│   ├── incidencias/                 # Vistas de incidencias
│   └── facturas/                    # Vistas de facturas
└── routes/
    ├── web.php                    # Rutas web principales
    └── auth.php                   # Rutas de autenticación
```

## 🌐 RUTAS PRINCIPALES

### 🏠 Páginas Generales
- `GET /` - Página de bienvenida
- `GET /dashboard` - Dashboard principal (requiere autenticación)

### 👥 Gestión de Clientes
- `GET /clientes` - Listado de clientes
- `GET /clientes/create` - Formulario nuevo cliente
- `POST /clientes` - Guardar nuevo cliente
- `GET /clientes/{id}` - Ver detalles del cliente
- `GET /clientes/{id}/edit` - Formulario editar cliente
- `PUT /clientes/{id}` - Actualizar cliente
- `DELETE /clientes/{id}` - Eliminar cliente

### 📋 Gestión de Incidencias
- `GET /incidencias` - Listado de incidencias
- `GET /incidencias/create` - Formulario nueva incidencia
- `POST /incidencias` - Guardar nueva incidencia
- `GET /incidencias/{id}` - Ver detalles de incidencia
- `GET /incidencias/{id}/edit` - Formulario editar incidencia
- `PUT /incidencias/{id}` - Actualizar incidencia
- `DELETE /incidencias/{id}` - Eliminar incidencia

### 💰 Gestión de Facturas
- `GET /facturas` - Listado de facturas
- `GET /facturas/create` - Formulario nueva factura
- `POST /facturas` - Guardar nueva factura
- `GET /facturas/{id}` - Ver detalles de factura
- `GET /facturas/{id}/edit` - Formulario editar factura
- `PUT /facturas/{id}` - Actualizar factura
- `DELETE /facturas/{id}` - Eliminar factura

## 💾 ESTRUCTURA DE BASE DE DATOS

### Tabla: `clientes`
```sql
id              BIGINT AUTO_INCREMENT PRIMARY KEY
nombre          VARCHAR(255) NOT NULL
email           VARCHAR(255) UNIQUE NOT NULL  
telefono        VARCHAR(20) NULL
direccion       VARCHAR(500) NULL
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### Tabla: `incidencias`
```sql
id              BIGINT AUTO_INCREMENT PRIMARY KEY
cliente_id      BIGINT FOREIGN KEY REFERENCES clientes(id)
titulo          VARCHAR(255) NOT NULL
descripcion     TEXT NOT NULL
estado          ENUM('abierta', 'en_proceso', 'resuelta', 'cerrada')
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

### Tabla: `facturas`
```sql
id              BIGINT AUTO_INCREMENT PRIMARY KEY
cliente_id      BIGINT FOREIGN KEY REFERENCES clientes(id)
fecha           DATE NOT NULL
total           DECIMAL(10,2) NOT NULL
estado          ENUM('pendiente', 'pagada', 'vencida', 'cancelada')
created_at      TIMESTAMP
updated_at      TIMESTAMP
```

## 🔗 RELACIONES ENTRE MODELOS

### Cliente (1:N) → Incidencias
- Un cliente puede tener múltiples incidencias
- Acceso: `$cliente->incidencias`

### Cliente (1:N) → Facturas  
- Un cliente puede tener múltiples facturas
- Acceso: `$cliente->facturas`

### Incidencia (N:1) → Cliente
- Cada incidencia pertenece a un cliente
- Acceso: `$incidencia->cliente`

### Factura (N:1) → Cliente
- Cada factura pertenece a un cliente
- Acceso: `$factura->cliente`

## 🛠️ INSTALACIÓN Y CONFIGURACIÓN

### Prerrequisitos
- PHP 8.2+
- Composer
- Node.js y NPM
- Laravel 11
- Laragon (recomendado para desarrollo)

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone [url-del-repo] crm-laravel
   cd crm-laravel
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   npm install
   ```

3. **Configurar entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar base de datos en .env**
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

5. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Compilar assets**
   ```bash
   npm run dev
   ```

7. **Servir la aplicación**
   ```bash
   php artisan serve
   ```

## 🔐 CREDENCIALES DE PRUEBA

### Usuario Principal
- **Email:** `test@example.com`
- **Password:** `password`

### Usuario Administrador
- **Email:** `admin@crm.com`
- **Password:** `admin123`

## 🌍 URLS DE ACCESO

### Con Laravel Artisan
- **Base:** `http://127.0.0.1:8000`
- **Dashboard:** `http://127.0.0.1:8000/dashboard`

### Con Laragon
- **Base:** `http://crm-laravel.test`
- **Dashboard:** `http://crm-laravel.test/dashboard`

## 📱 CARACTERÍSTICAS DE LA INTERFAZ

### Dashboard Principal
- Cards visuales para cada módulo
- Acciones rápidas para crear registros
- Navegación intuitiva
- Responsive design

### Navegación
- Menú superior con enlaces principales
- Dropdown de usuario con perfil y logout
- Menú hamburguesa para móviles
- Indicador de sección activa

### Formularios
- Validación en tiempo real
- Mensajes de error claros
- Campos responsivos
- Botones de acción diferenciados

## 🎨 TECNOLOGÍAS UTILIZADAS

- **Backend:** Laravel 11
- **Frontend:** Blade Templates + Alpine.js
- **CSS:** Tailwind CSS
- **Base de Datos:** SQLite
- **Autenticación:** Laravel Breeze
- **Icons:** Heroicons SVG

## 📄 LICENCIA

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

## 👤 DESARROLLADOR

Desarrollado como sistema CRM educativo para aprender Laravel y gestión de relaciones con clientes.

---

## 📚 PRÓXIMAS FUNCIONALIDADES

Para continuar el desarrollo, se pueden implementar:

- [ ] Búsqueda y filtros avanzados
- [ ] Exportación de datos (PDF, Excel)
- [ ] Sistema de notificaciones
- [ ] Seguimiento de actividades
- [ ] Reportes y dashboards estadísticos
- [ ] API REST para integraciones
- [ ] Sistema de roles y permisos
- [ ] Backup automático
- [ ] Chat en tiempo real
- [ ] Integración con email marketing

---

**¡El sistema está listo para usar! 🚀**