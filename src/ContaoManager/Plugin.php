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

namespace Netzmacht\Contao\Iconic\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Netzmacht\Contao\Iconic\NetzmachtContaoIconicBundle;
use Netzmacht\Html\Infrastructure\SymfonyBundle\NetzmachtHtmlBundle;

/**
 * Class Plugin.
 *
 * @package Netzmacht\Contao\Iconic\ContaoManager
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(NetzmachtContaoIconicBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, NetzmachtHtmlBundle::class])
        ];
    }
}
