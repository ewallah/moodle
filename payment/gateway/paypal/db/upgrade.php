<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * paygw_paypal upgrade script.
 *
 * @package    paygw_paypal
 * @copyright  2020 Renaat Debleu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Function to upgrade payment paypal gateway.
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_paygw_paypal_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2021052501) {
        $table = new xmldb_table('paygw_paypal');
        $oldkey = new xmldb_key('paymentid', XMLDB_KEY_FOREIGN, ['paymentid'], 'payment', ['id']);
        if ($dbman->find_key_name($table, $oldkey)) {
            $dbman->drop_key($table, $oldkey);
            $newkey = new xmldb_key('paymentid', XMLDB_KEY_FOREIGN, ['paymentid'], 'payments', ['id']);
            $dbman->add_key($table, $newkey);
        }
        upgrade_plugin_savepoint(true, 2021052501, 'paygw', 'paypal');
    }
}