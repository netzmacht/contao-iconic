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

namespace Netzmacht\Contao\Iconic\Renderer;

use Netzmacht\Contao\Iconic\Renderer;

/**
 * Class MultipleModeRenderer.
 *
 * @package Netzmacht\Contao\Iconic\Renderer
 */
final class MultipleModeRenderer implements Renderer
{
    /**
     * Icon renderer.
     *
     * @var Renderer[]
     */
    private $renderer;

    /**
     * Default mode.
     *
     * @var string
     */
    private $defaultMode;

    /**
     * MultipleModeRenderer constructor.
     *
     * @param Renderer[] $renderer    Icon renderer.
     * @param string     $defaultMode Default renderer mode.
     */
    public function __construct(array $renderer, string $defaultMode)
    {
        $this->renderer    = $renderer;
        $this->defaultMode = $defaultMode;
    }

    /**
     * {@inheritdoc}
     */
    public function render(string $icon, array $attributes = [], ?string $mode = null): string
    {
        $mode = $mode ?: $this->defaultMode;
        $this->guardRenderModeIsSupported($mode);

        return $this->renderer[$mode]->render($icon, $attributes, $mode);
    }

    /**
     * Guard that renderer mode is supported.
     *
     * @param string $mode Render mode.
     *
     * @return void
     *
     * @throws \RuntimeException When renderer mode is not supported.
     */
    private function guardRenderModeIsSupported(string $mode): void
    {
        if (!isset($this->renderer[$mode])) {
            throw new \RuntimeException(sprintf('Renderer mode "%s" is not supported.', $mode));
        }
    }
}
