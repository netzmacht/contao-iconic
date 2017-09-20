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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * @package Netzmacht\Contao\Iconic\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node        = $treeBuilder->root('netzmacht_contao_iconic');

        $node->children()
            ->scalarNode('default_mode')
                ->info('Default render mode. At the moment only svg is supported.')
                ->defaultValue('svg')
            ->end()
            ->scalarNode('svg_path')
                ->info('Path there the svg files exist.')
                ->defaultValue('files/theme/svg')
            ->end();

        return $treeBuilder;
    }
}
