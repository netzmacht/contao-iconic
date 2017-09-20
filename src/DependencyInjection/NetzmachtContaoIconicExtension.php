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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class NetzmachtContaoIconicExtension.
 *
 * @package Netzmacht\Contao\Iconic\DependencyInjection
 */
class NetzmachtContaoIconicExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $container->setParameter('netzmacht.contao_iconic.default_mode', $config['default_mode']);
        $container->setParameter('netzmacht.contao_iconic.svg_path', $config['svg_path']);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');
        $loader->load('listeners.yml');
    }
}
