<?php

namespace Smile\EzUICronBundle\DependencyInjection;

use EzSystems\PlatformUIBundle\DependencyInjection\PlatformUIExtension;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SmileEzUICronExtension extends Extension implements PrependExtensionInterface, PlatformUIExtension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * Prepend settings
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('assetic', array('bundles' => array('SmileEzUICronBundle')));

        $this->prependYui($container);
        $this->prependCss($container);
    }

    /**
     * Prepend ezplatform yui interface plugin
     *
     * @param ContainerBuilder $container
     */
    private function prependYui(ContainerBuilder $container)
    {
        $container->setParameter(
            'smile_ez_uicron.public_dir',
            'bundles/smileezuicron'
        );
        $yuiConfigFile = __DIR__ . '/../Resources/config/yui.yml';
        $config = Yaml::parse(file_get_contents($yuiConfigFile));
        $container->prependExtensionConfig('ez_platformui', $config);
        $container->addResource(new FileResource($yuiConfigFile));
    }

    /**
     * Prepend ezplatform css interface plugin
     *
     * @param ContainerBuilder $container
     */
    private function prependCss(ContainerBuilder $container)
    {
        $container->setParameter(
            'smile_ez_uicron.css_dir',
            'bundles/smileezuicron/css'
        );
        $cssConfigFile = __DIR__ . '/../Resources/config/css.yml';
        $config = Yaml::parse(file_get_contents($cssConfigFile));
        $container->prependExtensionConfig('ez_platformui', $config);
        $container->addResource(new FileResource($cssConfigFile));
    }

    /**
     * Returns the translation domains used by the extension.
     * @return array An array of extensions
     */
    public function getTranslationDomains()
    {
        return [
            'smileezcron'
        ];
    }
}
