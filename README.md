# BvskPluginBoilerplate

## A Boilerplate Plugin for [Shopware 6](https://github.com/shopware/platform) Plugin Development

### Note: Created with Shopware EA1.1@dev `v6.0.0+ea1.1@dev`

## System requirements
* Shopware >= v6.0.0+ea1
* Composer
* PHP >= 7.2
* PHPUnit >= 8.1

## Current Status
This example plugin is not completed and not covers all example cases and is in current development mode.

## Install Plugin
1. Go to your `<shopware-root>/custom/plugins/` directory.
2. Get this Repository, you can clone it or download the master.

#### Clone this Repository
1. Start your terminal
2. Run `git clone git@bitbucket.org:brianvarskonst/bvsk-plugin-boilerplate.git` in your terminal.
3. After the cloning is done run `$ composer install`.
4. It will load all the required dependency in a `vendor/` folder for this package.

#### Download the Master
1. Download the latest version over this [Download Link](https://github.com/brianvarskonst/bvsk-plugin-boilerplate/archive/master.zip)
3. Unzip the master.zip file.
4. Create a new folder in the `<shopware-root>/custom/plugins/` directory `$ mkdir swagPluginName`
    For this example Plugin it: `$ mkdir BvskPluginBoilerplate`
5. Copy and paste it into your created directory of your plugin.
6. Run `$ composer install`

### Install with the Pluginmanager
1. Login in your current Shopware Admin Dashboard 
    `Url: https://localhost/admin#/login`.
2. You can find the Pluginmanager under `Settings > System > Plugins`.
3. Click on the menu icon and choose `install`
4. Click the toggle/switch button and `activate` the plugin

### Install with CLI
1. Go back to your `<shopware-root>` directory with
    ```bash
    $  cd ../.. 
    ```
2. Refresh the Shopware plugins with.
       ```bash
       $ php bin/console plugin:refresh
       ```  
3. Now install the plugin with the following command:
    ```bash
    $ php bin/console plugin:install --activate --clearCache PluginName
    ```
   
### Finish
Now you can start developing your own plugin for Shopware 6.

## Run the unit tests
To run tests, executes commands below:

```bash
$ composer install
$ bash bin/phpunit.sh
```

## Plugin quick start
To be able to introduce extensions into the system, the core comes with an integrated plugin system. 

Plugins are [Symfony Bundles](https://symfony.com/doc/current/bundles.html) which can be activated and deactivated via the [plugin commands](https://docs.shopware.com/en/shopware-platform-dev-en/internals/plugins/plugin-commands).

For start reading and developing: [Shopware 5: Plugin quick start](https://docs.shopware.com/en/shopware-platform-dev-en/internals/plugins/plugin-quick-start)

## Usage
1. Rename the Plugin (Class: `BvskPluginBoilerplate.php` & Namespace: `Bvsk\\PluginBoilerplate`)
2. Remove not needed components or add new components to the plugin.
3. Remove or add the components in the `./src/DependencyInjection/services.xml` file and delete the imported files (for example: `commands.xml`) or create new `xml` files and import it.
4. Have fun to develop your next shopware 6 plugin with this plugin boilerplate.

## Included Components
### Commands
Creating a command for Shopware 6 via a plugin works exactly like you would add a command to Symfony. 
Make sure to have a look at the [Symfony commands guide](https://symfony.com/doc/current/console.html#registering-the-command).

More information:: [Shopware 6: Creating commands via plugin](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/plugin-commands?category=shopware-platform-dev-en/how-to) 

### Components
This example will show you how to handle optional requirements of your plugin, for this example `components`.

More information: [Shopware 6: Optional requirements of a plugin](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/optional-plugin-requirements?category=shopware-platform-dev-en/how-to) 

### Controller
#### ApiController
The API Controller can be used to complete all plugin tasks, like creating products, updating prices and much more. 
For building a storefront or extending it, you can use the SalesChannel-API.

More information:: [Shopware 6: API controller](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/api-controller?category=shopware-platform-dev-en/how-to) 

#### SalesChannelController
This will give you a example on how to setup a custom SalesChannel-API controller with your plugin.

The SalesChannel-API is part of our API family. It allows access to all sales channel operations, such as creating new customers, customer login and logout, various cart operations and a lot more.

It's ideal if you want to build your own storefront. You could create a mobile app based on the Sales Channel API or just embed it into your existing application to have a solid base for payment and transaction handling.

More information: [Shopware 6: SalesChannel-API controller](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/sales-channel-api-controller?category=shopware-platform-dev-en/how-to) 

#### Routes
The `routes.xml` file is necessary to introduce our controllers to Shopware 6. Shopware 6 automatically searches for an `xml / yml / php` file in a `./src/Resources/config/` directory, whose path contains routes. 

In this example Plugin, only `xml` is used.

More information: [Shopware 6: API controller - routes.xml](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/api-controller#loading-the-controllers-via-routes-xml) 

### Configuration
The Shopware plugin system provides you with the option to create a configuration page for your plugin without any knowledge of templating or the Shopware Administration.

All you need to do is creating a `config.xml` file inside of a `./src/Resources/config` directory in your plugin root.

More information:: [Shopware 6: Plugin configuration](https://docs.shopware.com/en/shopware-platform-dev-en/internals/plugins/plugin-config) 

### DataAbstractionLayer/Entity
Quite often, your plugin has to save data into a custom database table. Shopware 6's data abstraction layer fully supports custom entities, so you don't have to take care about the data handling at all.

The DataAbstractionLayer (DAL) centrally handles data retrieval, modification and search through am object oriented interface. The following diagram illustrates the generall architecture of the component.
- Entity: Represents the data of a single row in table in the storage. The Entity may contain related data if you wished to fetch it this way.
- Collection: A collection is the result set of a DAL search. It contains convenience methods and metadata related to the search.
- Definition: Configuration file defining the fields, relations and entity- and collection-classes.

More information:: [Shopware 6: Translating a custom entity](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/custom-entity-translations?category=shopware-platform-dev-en/how-to) 

#### Translation
This will handle how to properly translate your custom entities.

The Data abstraction layer supports internationalization of entities as a core concept and obeys the general rules of the Shopware Core. In order to support this, many fields are translatable and many entities have a language relation. There is some special handling present to support this.

More information:: [Shopware 6: Translating a custom entity](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/custom-entity-translations?category=shopware-platform-dev-en/how-to) 

### DependencyInjection

More information:
- [Symfony: The DependencyInjection Component](https://symfony.com/doc/current/components/dependency_injection.html)
- [Symfony: Service Container](https://symfony.com/doc/current/service_container.html) 
- [Symfony: How to Create Friendly Configuration for a Bundle](https://symfony.com/doc/4.1/bundles/configuration.html#processing-the-configs-array)
- [Symfony: Using the load() Method](https://symfony.com/doc/4.1/bundles/extension.html#using-the-load-method)
- [Shopware 6: Reading the plugin configuration](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/reading-plugin-config) 

### Entity Extension (Struct)
If you're wondering how to extend existing core entities, this example will have you covered. Do not confuse entity extensions with entities' custom fields though, as they serve a different purpose. 

In short: Extensions are technical and not configurable by the admin user just like that. Also they can deal with more complex types than scalar ones. Custom fields are, by default, configurable by the admin user in the administration and they mostly support scalar types, e.g. a text-field, a number field or the likes.

More information: [Shopware 6: Entity extension](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/entity-extension?category=shopware-platform-dev-en/how-to)

### Migrations
Whenever you decide to release a new version of your plugin, including new features, you might have to take care about new database tables or about updating existing ones. This also includes checking, if an update was already applied, mostly done so by including a multitude of version checks into your plugin's update method. As you might notice, this will bloat the update method sooner or later, becoming more and more of a pain to maintain reliably.

More information:: 
- [Shopware 6: Updating your plugin via migrations](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/plugin-migrations?category=shopware-platform-dev-en/how-to) 
- [Shopware 6: Plugin migrations](https://docs.shopware.com/en/shopware-platform-dev-en/internals/plugins/plugin-migrations)

### Scheduled Tasks
Quite often one might want to run any type of code on a regular basis, e.g. to clean up very old entries every once in a while, automatically. 
Formerly known as "Cronjobs", Shopware 6 supports a ScheduledTask for this.

The ScheduledTask and its ScheduledTaskHandler are registered in a plugin's `/DependencyInjection/scheduled-tasks.xml`.

More information:: [Shopware 6: Translating a custom entity](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/custom-entity-translations?category=shopware-platform-dev-en/how-to) 

### Service
Creating custom services for your plugin is as simple as it is in Symfony bundles, since Shopware 6 plugins are basically just extended Symfony bundles.

Note: Make sure to have a look at the [Symfony documentation](https://symfony.com/doc/current/service_container.html#creating-configuring-services-in-the-container), to find out how services are registered in Symfony itself.

More information: [Shopware 6: Creating a service](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/add-service?category=shopware-platform-dev-en/how-to)

#### Decorating a service
Decorating a service with your plugin is as simple as it is in Symfony. Make sure to have a look at the [Symfony guide about decorating services](https://symfony.com/doc/current/service_container/service_decoration.html).

More information:: [Shopware 6: Decorating a service](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/decorating-a-service?category=shopware-platform-dev-en/how-to) 

### Snippet
This example will help you extend an existing language in both the administration and the storefront.

More information: [Shopware 6: Extending snippets](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/extending-snippets?category=shopware-platform-dev-en/how-to)

### Storefront
#### Controller
If you want to call some custom business logic from your template you will need to write your own storefront controller. This HowTo will show you how to achieve this, by writing an controller that clears the cart of the user. You will hook this controller action to a button on the cart overview page.

More information:: [Shopware 6: Translating a custom entity](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/custom-entity-translations?category=shopware-platform-dev-en/how-to) 

#### Page (Data)
Pages or Pagelets are the objects that get handed to the templates and provide all necessary information for the template to render. For more information of the concepts behind Pages and Pagelets look [here](https://docs.shopware.com/en/shopware-platform-dev-en/internals/storefront/composite-data-loading).

More information: [Shopware 6: Add data to a storefront page](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/add-data-to-a-storefront-page) 

### Subscriber
This example will cover what you need to know in order to create a subscriber using your plugin.

During the execution of a Symfony application, lots of event notifications are triggered. Your application can listen to these notifications and respond to them by executing any piece of code.

Symfony triggers several events related to the kernel while processing the HTTP Request. Third-party bundles may also dispatch events, and you can even dispatch custom events from your own code.

Make sure to have a look at the [Symfony event subscriber guide](https://symfony.com/doc/current/event_dispatcher.html#creating-an-event-subscriber).

More information:: [Shopware 6: How to create a subscriber](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/register-subscriber?category=shopware-platform-dev-en/how-to) 

### UnitTests (Automated tests in plugins)
To ensure your plugin's functionality, it's highly recommended to automatically test your source code. For this purpose, you can easily setup a [PHPUnit](https://phpunit.readthedocs.io/en/8.0/writing-tests-for-phpunit.html) testing environment for plugins.

This quick HowTo requires you to have a proper working plugin first.

More information: [Shopware 6: Automated tests in plugins](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/plugin-testing?category=shopware-platform-dev-en/how-to) 

### Views
In this example you will see a very short example on how you can extend a storefront block.

More information:: [Shopware 6: Extending a storefront block](https://docs.shopware.com/en/shopware-platform-dev-en/how-to/extending-storefront-block?category=shopware-platform-dev-en/how-to) 

## Credits
* [Shopware 6 Developer Docs](https://docs.shopware.com/en/shopware-platform-dev-en)
* [Symfony Documentation](https://symfony.com/doc/current/index.html#gsc.tab=0)
* [PHPUnit Manual](https://phpunit.readthedocs.io/en/8.0/index.html)

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.