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

use Contao\StringUtil;
use Netzmacht\Contao\Iconic\Renderer;

/**
 * Class InsertTagListener.
 *
 * @package Netzmacht\Contao\Iconic\Listener
 */
class InsertTagListener
{
    /**
     * Icon renderer.
     *
     * @var Renderer
     */
    private $renderer;

    /**
     * InsertTagListener constructor.
     *
     * @param Renderer $renderer Icon renderer.
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

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

        $parts = explode('::', $tag);
        $mode  = ($parts[2] ?? null);
        $parts = explode('?', $parts[1], 2);

        list($icon, $query) = array_pad($parts, 2, '');

        $query = str_replace('+', '&', $query);
        $query = StringUtil::decodeEntities($query);
        parse_str($query, $attributes);

        return $this->renderer->render($icon, $attributes, $mode);
    }
}
