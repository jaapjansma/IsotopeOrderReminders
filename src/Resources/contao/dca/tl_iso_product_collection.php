<?php
/**
 * Copyright (C) 2022  Jaap Jansma (jaap.jansma@civicoop.org)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Krabo\IsotopeOrderRemindersBundle\Callback\ProductCollection;

$GLOBALS['TL_DCA']['tl_iso_product_collection']['config']['onload_callback'][] =[ProductCollection::class, 'onLoadCallback'];
$GLOBALS['TL_DCA']['tl_iso_product_collection']['select']['buttons_callback'][] = [ProductCollection::class, 'selectButtonsCallback'];

$GLOBALS['TL_DCA']['tl_iso_product_collection']['fields']['first_reminder_send'] = [
  'inputType' => 'checkbox',
  'eval' => ['tl_class' => 'w50 clr'],
  'sql' => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => ''],
  'filter' => true,
];

$GLOBALS['TL_DCA']['tl_iso_product_collection']['fields']['date_first_reminder'] = [
  'exclude'               => true,
  'inputType'             => 'text',
  'eval'                  => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
  'sql'                   => 'int(10) NULL',
];

$GLOBALS['TL_DCA']['tl_iso_product_collection']['fields']['follow_up_reminder_send'] = [
  'inputType' => 'checkbox',
  'eval' => ['tl_class' => 'w50 clr'],
  'sql' => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => ''],
  'filter' => true,
];

$GLOBALS['TL_DCA']['tl_iso_product_collection']['fields']['date_follow_up_reminder'] = [
  'exclude'               => true,
  'inputType'             => 'text',
  'eval'                  => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
  'sql'                   => 'int(10) NULL',
];

PaletteManipulator::create()
  ->addField('first_reminder_send', 'date_shipped', PaletteManipulator::POSITION_AFTER)
  ->addField('date_first_reminder', 'first_reminder_send', PaletteManipulator::POSITION_AFTER)
  ->addField('follow_up_reminder_send', 'date_first_reminder', PaletteManipulator::POSITION_AFTER)
  ->addField('date_follow_up_reminder', 'follow_up_reminder_send', PaletteManipulator::POSITION_AFTER)
  ->applyToPalette('default', 'tl_iso_product_collection');