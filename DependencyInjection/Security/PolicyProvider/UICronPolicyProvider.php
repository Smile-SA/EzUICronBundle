<?php

namespace Smile\EzUICronBundle\DependencyInjection\Security\PolicyProvider;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Security\PolicyProvider\YamlPolicyProvider;

/**
 * Class UICronPolicyProvider
 *
 * @package Smile\EzUICronBundle\DependencyInjection\Security\PolicyProvider
 */
class UICronPolicyProvider extends YamlPolicyProvider
{
    /** @var string $path bundle path */
    protected $path;

    /**
     * UIPackagePolicyProvider constructor.
     *
     * @param string $path bundle path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * prepend policies to eZ Platform policy configuration
     *
     * @return array list of policies.yml
     */
    public function getFiles()
    {
        return [$this->path . '/Resources/config/policies.yml'];
    }
}
