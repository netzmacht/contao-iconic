<?php

/**
 * Iconic Contao Integration.
 *
 * @package    contao-iconic
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2017 netzmacht David Molineus. All rights reserved.
 * @filesource
 */

$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = [
    'netzmacht.contao_iconic.listeners.insert_tag',
    'onReplaceInsertTags'
];
