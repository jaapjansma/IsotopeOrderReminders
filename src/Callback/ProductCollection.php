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

namespace Krabo\IsotopeOrderRemindersBundle\Callback;

use Contao\DataContainer;
use Contao\Environment;
use Contao\Input;
use Contao\System;
use Symfony\Component\HttpFoundation\Session\Session;

class ProductCollection {

  public function selectButtonsCallback($arrButtons, DataContainer $dc) {
    $arrButtons['kraboIsotopeSendReminder'] = '<button type="submit" name="kraboIsotopeSendReminder" id="kraboIsotopeSendReminder" class="tl_submit">' . $GLOBALS['TL_LANG']['tl_iso_product_collection']['krabo_isotope_send_reminder'][0] . '</button>';
    return $arrButtons;
  }

  public function onLoadCallback(DataContainer $dc) {
    if (Input::post('FORM_SUBMIT') == 'tl_select') {
      if (isset($_POST['kraboIsotopeSendReminder'])) {
        /** @var Session $objSession */
        $objSession = System::getContainer()->get('session');
        $objSession->set('krabo_isotope_send_reminder_return_url', Environment::get('request'));
        $dc->redirect(str_replace('act=select', 'key=krabo_isotope_send_reminder', Environment::get('request')));
      }
    }
  }

}