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

declare(strict_types=1);

namespace Netzmacht\Contao\Iconic;

use Netzmacht\Contao\Iconic\DependencyInjection\RendererCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class NetzmachtContaoIconicBundle.
 *
 * @package Netzmacht\Contao\Iconic
 */
class NetzmachtContaoIconicBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RendererCompilerPass());
    }
}
