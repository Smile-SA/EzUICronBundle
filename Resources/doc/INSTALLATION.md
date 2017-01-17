# Installation

## Get the bundle using composer

Add SmileEzUICronBundle by running this command from the terminal at the root of
your symfony project:

```bash
composer require smile/ez-uicron-bundle
```

## Add routing

Add to your global configuration app/config/routing.yml

```yaml
smileezcron_platform:
    resource: '@SmileEzUICronBundle/Resources/config/routing.yml'
```

## Enable the bundle

To start using the bundle, register the bundle in your application's kernel class:

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Smile\CronBundle\SmileCronBundle(),
        new Smile\EzUICronBundle\SmileEzUICronBundle(),
        // ...
    );
}
```

## Add doctrine ORM support

in yout ezplatform.yml, add

```yaml
doctrine:
    orm:
        auto_mapping: true
```

## Update your SQL schema

```
php app/console doctrine:schema:update --force
```

## Define global cron job

in your crontab, add

```cmd
* * * * * cd <your_project_root> && php app/console smileez:crons:run
```

where <your_project_root> is your Symfony root.
