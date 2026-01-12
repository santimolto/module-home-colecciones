# Santi_HomeSeoText

Módulo Magento 2 para añadir un bloque de texto SEO al final de la Home con **Ver más / Ver menos**.

## Importante

Este módulo **NO incluye ACL** (a propósito) para evitar los problemas que ya has visto.
En `system.xml` se usa directamente:
`<resource>Magento_Config::config</resource>`

## Instalación (Composer dev-main)

```bash
composer config repositories.homeseotext vcs https://github.com/santimolto/HomeSeoText
composer require santi/module-home-seo-text:dev-main
bin/magento module:enable Santi_HomeSeoText
bin/magento setup:upgrade
bin/magento cache:flush
```

## Configuración

**Tiendas > Configuración > Santi Extensions > Home SEO Text**

## Ubicación

Se añade automáticamente al final de la Home (`cms_index_index`).
