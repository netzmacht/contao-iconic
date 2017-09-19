<?php

/**
 * Iconic Contao Integration.
 *
 * @package    contao-iconic
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017 netzmacht David Molineus. All rights reserved.
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
    public function onReplaceInsertTag(string $tag)
    {
        if (strpos($tag, 'iconic::') !== 0) {
            return false;

        }

        $parts = explode('?', substr($tag, 8), 2);
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

                case 'iclass':
                    $element->addClass('iconic-' . $value);
                    break;

                case 'class':
                    $element->addClass($value);
                    break;

                default:
                    $element->setAttribute('data-' . $key, $value);
            }
        }

        return (string) $element;
    }
}