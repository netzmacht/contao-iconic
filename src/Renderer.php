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

namespace Netzmacht\Contao\Iconic;

/**
 * Interface Renderer.
 *
 * @package Netzmacht\Contao\Iconic\Renderer
 */
interface Renderer
{
    /**
     * Render an iconic icon.
     *
     * @param string      $icon       The icon name.
     * @param array       $attributes Icon attributes.
     * @param string|null $mode       Render mode.
     *
     * @return string
     */
    public function render(string $icon, array $attributes = [], ?string $mode = null): string;
}
