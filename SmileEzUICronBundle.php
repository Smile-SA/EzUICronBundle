<?php

namespace Smile\EzUICronBundle;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\EzPublishCoreExtension;
use Smile\EzUICronBundle\DependencyInjection\Security\PolicyProvider\UICronPolicyProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SmileEzUICronBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        /** @var EzPublishCoreExtension $eZExtension */
        $eZExtension = $container->getExtension('ezpublish');
        $eZExtension->addPolicyProvider(new UICronPolicyProvider($this->getPath()));
    }
}
