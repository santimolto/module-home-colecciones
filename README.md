# Santi_HomeColecciones

Gestión dinámica del bloque **Colecciones del Home** mediante **System Config** (multistore).

- Ruta de subida de imágenes: `pub/media/santi_home_colecciones/`
- Hasta **3 elementos** configurables por *store view* (habilitar, imagen, alt, etiqueta, URL, orden).
- Sin grids, sencillo y robusto. El primer item suele ocupar 2 columnas (como en tu layout).

## Instalación

1) Añade el repo a tu `composer.json` raíz:
```json
{ "type": "vcs", "url": "https://github.com/santimolto/module-home-colecciones" }
```
y en `require`:
```json
"santi/module-home-colecciones": "dev-main"
```

2) Instala y habilita:
```bash
composer require santi/module-home-colecciones:dev-main
bin/magento module:enable Santi_HomeColecciones
bin/magento setup:upgrade
bin/magento cache:flush
```

## Uso en el PHTML

```php
/** @var \Hyva\Theme\Model\ViewModelRegistry $viewModels */
$vm = $viewModels->require(\Santi\HomeColecciones\ViewModel\Colecciones::class);
$colecciones = $vm->getItems();
```

Si no hay items activos, se mostrará automáticamente el **fallback** (ver `docs/home_colecciones.phtml`).
