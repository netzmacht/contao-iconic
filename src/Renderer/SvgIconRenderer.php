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
use Netzmacht\Html\Element\StandaloneElement;
use Netzmacht\Html\Factory;

/**
 * Class IconRenderer.
 *
 * @package Netzmacht\Contao\Iconic\Renderer
 */
class SvgIconRenderer implements Renderer
{
    /**
     * Html element factory.
     *
     * @var Factory
     */
    private $elementFactory;

    /**
     * Svg path.
     *
     * @var string
     */
    private $svgPath;

    /**
     * InsertTagListener constructor.
     *
     * @param Factory $elementFactory Html element factory.
     * @param string  $svgPath        SVG path.
     */
    public function __construct(Factory $elementFactory, string $svgPath)
    {
        $this->elementFactory = $elementFactory;
        $this->svgPath        = $svgPath;
    }

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function render(string $icon, array $attributes = [], ?string $mode = null): string
    {
        $GLOBALS['TL_HEAD'][] = sprintf(
            '<link rel="preload" href="%s" as="image">',
            $this->svgPath . '/' . $icon . '.svg'
        );

        /** @var StandaloneElement $element */
        $element = $this->elementFactory->create('img');
        $element
            ->setAttribute('data-src', $this->svgPath . '/' . $icon . '.svg')
            ->addClass('iconic');

        foreach ($attributes as $key => $value) {
            switch ($key) {
                case 'alt':
                    $element->setAttribute($key, $value);
                    break;

                case 'i':
                case 'iclass':
                    $values = array_map(
                        function ($value) {
                            return 'iconic-' . $value;
                        },
                        explode(' ', $value)
                    );

                    $element->addClasses($values);
                    break;

                case 'class':
                    $element->addClasses(explode(' ', $value));
                    break;

                default:
                    $element->setAttribute('data-' . $key, $value);
            }
        }

        return (string) $element;
    }
}
