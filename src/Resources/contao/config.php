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

$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = [
    'netzmacht.contao_iconic.listeners.insert_tag',
    'onReplaceInsertTags'
];
