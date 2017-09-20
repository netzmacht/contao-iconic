<?php

/**
 * Iconic Contao Integration.
 *
 * @package    contao-iconic
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017 netzmacht David Molineus. All rights reserved.
 * @license    LGPL 3.0 http://www.gnu.de/documents/lgpl-3.0.de.html
 * @filesource
 */

namespace Netzmacht\Contao\Iconic\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RendererCompilerPass.
 *
 * @package Netzmacht\Contao\Iconic\DependencyInjection
 */
class RendererCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     *
     * @throws InvalidConfigurationException When mode attribute is missing for a tagged iconic renderer service.
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('netzmacht.contao_iconic.renderer')) {
            return;
        }

        $definition       = $container->findDefinition('netzmacht.contao_iconic.renderer');
        $taggedServiceIds = $container->findTaggedServiceIds('contao_iconic.renderer');
        $services         = (array) $definition->getArgument(0);

        foreach ($taggedServiceIds as $serviceId => $tags) {
            foreach ($tags as $attributes) {
                if (!isset($attributes['mode'])) {
                    throw new InvalidConfigurationException(
                        'Mode attribute is missing for tagged iconic renderer service "%s"',
                        $serviceId
                    );
                }

                $services[$attributes['mode']] = new Reference($serviceId);
            }
        }

        $definition->replaceArgument(0, $services);
    }
}
