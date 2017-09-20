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

namespace Netzmacht\Contao\Iconic\Listener;

use Netzmacht\Html\Element\StandaloneElement;

/**
 * Class InsertTagListener.
 *
 * @package Netzmacht\Contao\Iconic\Listener
 */
class InsertTagListener
{
    /**
     * Handle replace insert tag hook.
     *
     * @param string $tag Insert tag.
     *
     * @return bool|string
     */
    public function onReplaceInsertTags(string $tag)
    {
        if (strpos($tag, 'iconic::') !== 0) {
            return false;
        }

        $parts              = explode('?', substr($tag, 8), 2);
        list($icon, $query) = array_pad($parts, 2, '');
        parse_str($query, $attributes);

        $element = new StandaloneElement('img');
        $element
            ->setAttribute('data-src', $icon . '.svg')
            ->setAttribute('class', 'iconic');

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
