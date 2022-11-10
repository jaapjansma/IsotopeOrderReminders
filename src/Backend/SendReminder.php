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

namespace Krabo\IsotopeOrderRemindersBundle\Backend;

use Contao\BackendTemplate;
use Contao\DataContainer;
use Contao\Input;
use Contao\System;
use Isotope\Model\ProductCollection\Order;
use NotificationCenter\Model\Notification;
use Symfony\Component\HttpFoundation\Session\Session;

class SendReminder extends \Backend {

  public function sendReminder(DataContainer $dc): string {
    /** @var Session $objSession */
    $objSession = System::getContainer()->get('session');
    // Get current IDs from session
    $session = $objSession->all();
    $ids = $session['CURRENT']['IDS'];

    if (Input::post('FORM_SUBMIT') == 'krabo_isotope_reminder')
    {
      $objNotification = Notification::findByPk(Input::post('notification'));
      if ($objNotification && count($ids)) {
        foreach($ids as $id) {
          $objOrder = Order::findByPk($id);
          $tokens = $objOrder->getNotificationTokens($objNotification->id);
          $objNotification->send($tokens, $objOrder->language);
        }

        if (Input::post('reminder_type') == '1') {
          $checkField = 'first_reminder_send';
          $dateField = 'date_first_reminder';
        } else {
          $checkField = 'follow_up_reminder_send';
          $dateField = 'date_follow_up_reminder';
        }
        $sql = "UPDATE `tl_iso_product_collection` SET `".$checkField."` = '1', `".$dateField."` = '".time()."' WHERE `id` IN (".implode(",", $ids).")";
        $this->Database->execute($sql);
      }
      $dc->redirect($objSession->get('krabo_isotope_send_reminder_return_url'));
    }

    $options = [];
    if (($notifications = Notification::findBy('type', 'krabo_isotope_order_reminder', ['order' => 'title'])) !== null) {
      $options = $notifications->fetchEach('title');
    }
    $this->Template = new BackendTemplate('be_krabo_isotope_send_reminder');
    $this->Template->notifications = $options;
    return $this->Template->parse();
  }

}