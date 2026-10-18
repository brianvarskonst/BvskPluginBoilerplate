---
name: rename-plugin
description: Turns this boilerplate into your own Shopware plugin by renaming vendor, namespace, plugin class, composer package, tables and routes. Use when the task is to create, start or scaffold a new plugin from this repository, or to rename BvskPluginBoilerplate.
---

# Rename the boilerplate

Ask for anything that is missing, do not guess it:

| Name | Example | Used for |
|---|---|---|
| `V` (vendor, PascalCase) | `Acme` | namespace, plugin class |
| `N` (plugin, PascalCase) | `Tracking` | namespace, plugin class |
| `v` (vendor, lowercase) | `acme` | table prefix, task name |
| `n` (plugin, lowercase) | `tracking` | tables, routes, command, template folder |
| composer package | `acme/acme-tracking` | `composer.json` |
| author, license holder | | `composer.json`, `LICENSE` |

The plugin class is `V` + `N` (`AcmeTracking`), the namespace is `V\N`.

## 1. Replace the names

Run it from the repository root. The order matters, the longest name goes first.

```bash
V=Acme; N=Tracking; v=acme; n=tracking
sed -i \
  -e "s/Bvsk\\\\\\\\PluginBoilerplate/$V\\\\\\\\$N/g" \
  -e "s/Bvsk\\\\PluginBoilerplate/$V\\\\$N/g" \
  -e "s/BvskPluginBoilerplate/$V$N/g" \
  -e "s/PluginBoilerplate/$N/g" \
  -e "s/BvskCustomEntity/${V}CustomEntity/g" \
  -e "s/bvskCustomEntity/${v}CustomEntity/g" \
  -e "s/bvsk_/${v}_/g" \
  -e "s/vendor_prefix/$v/g" \
  -e "s/boilerplate/$n/g" \
  $(grep -rlIE 'Bvsk|bvsk|PluginBoilerplate|boilerplate|vendor_prefix' src tests bin phpunit.xml.dist composer.json)

git mv src/BvskPluginBoilerplate.php "src/$V$N.php"
git mv src/Resources/views/boilerplate "src/Resources/views/$n"
for file in src/Migration/*PluginBoilerplate*; do git mv "$file" "${file//PluginBoilerplate/$N}"; done
```

## 2. By hand

- `composer.json`: `name`, `description`, `keywords`, `authors`, `support`, `extra.label`, `extra.description`, `extra.manufacturerLink`, `extra.supportLink`, `extra.copyright`. Set `version` to `1.0.0`. The replacement above also touched `name` and `keywords`, check them.
- `LICENSE`: the copyright holder is the owner of this boilerplate, put your own. Do not run the replacement over it.
- `phpunit.xml.dist`: the name of the test suite.
- `README.md`: write it for your plugin and drop what does not apply. Start both changelogs again at `1.0.0`.
- Delete the components the plugin does not need, together with their `src/DependencyInjection/*.xml` import in `services.xml`, their line in `routes.xml`, their migration and their table constant. Keep a migration only when its table is used.
- `AGENTS.md`: replace the names and describe your plugin. Remove this skill, it only applies to the boilerplate.

## 3. Check

```bash
grep -rniE 'bvsk|boilerplate|vendor_prefix' . --exclude-dir=.git --exclude-dir=vendor
```

Nothing may be left, except what you chose to keep on purpose. Then run the `verify-plugin` skill. The plugin has to install, uninstall and install again, and `dal:validate` must not list it.

The migrations stay valid when a plugin is renamed: their class names change, their timestamps do not.
