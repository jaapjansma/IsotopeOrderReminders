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

use Krabo\IsotopeOrderRemindersBundle\Backend\SendReminder;

$GLOBALS['BE_MOD']['isotope']['iso_orders']['krabo_isotope_send_reminder'] = [SendReminder::class, 'sendReminder'];

/**
 * Notification Center notification types
 */
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['recipients'] = array('recipient_email', 'form_*', 'billing_address_email', 'shipping_address_email');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['attachment_tokens'] = array('form_*', 'document');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_text'] = array(
  'uniqid',
  'order_status',
  'order_status_id',
  'recipient_email',
  'order_id',
  'order_items',
  'order_products',
  'order_subtotal',
  'order_total',
  'document_number',
  'cart_html',
  'cart_text',
  'document',
  'bank_name',
  'bank_account',
  'bank_code',
  'tax_number',
  'collection_*', // All the collection fields
  'billing_address', // Formatted billing address
  'billing_address_*', // All the billing address model fields
  'shipping_address', // Formatted shipping address
  'shipping_address_*', // All the shipping address model fields
  'form_*', // All the order condition form fields
  'payment_id', // Payment method ID
  'payment_label', // Payment method label
  'payment_note', // Payment method note
  'payment_*',
  'shipping_id', // Shipping method ID
  'shipping_label', // Shipping method label
  'shipping_note', // Shipping method note
  'shipping_*',
  'config_*', // Store configuration model fields
  'member_*', // Member model fields
);
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_subject'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_text'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_html'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_text'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_replyTo'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['recipients'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_recipient_cc'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['recipients'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_recipient_bcc'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['recipients'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['file_name'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_text'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['file_content'] = &$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['isotope']['krabo_isotope_order_reminder']['email_text'];