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
 * @package    block_eduvidual
 * @copyright  2020 Center for Learning Management (https://www.lernmanagement.at)
 * @author     Robert Schrenk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_eduvidual;

defined('MOODLE_INTERNAL') || die;

class lib_wshelper {
    /**
     * Modifies the output of particular webservice calls.
     * @param classname Classname of the ws.
     * @param methodname The wsfunction-name.
     * @param params The params for this wsfunction.
    **/
    public static function override($classname, $methodname, $params) {
        $func = 'override_' . $classname . '_' . $methodname;
        if (method_exists(__CLASS__, $func)) {
            error_log('Overide function ' . $func . ' called');
            $result = call_user_func_array(array($classname, $methodname), $params);
            return call_user_func('self::' . $func, $result);
        } else {
            error_log('Overide function ' . $func . ' not found');
            return false;
        }
    }
    private static function override_block_exacomp_diggr_get_students_of_cohort($result) {
        error_log(print_r($result, 1));
        return $result;
    }
    private static function override_core_cohort_add_cohort_members($result) {
        error_log(print_r($result, 1));
        return $result;
    }
    private static function override_core_cohort_search_cohorts($result) {
        error_log(print_r($result, 1));
        return $result;
    }
    private static function override_core_enrol_external_get_potential_users($result) {
        $result2 = array();
        foreach ($result AS $item) {
            if (!\block_eduvidual\locallib::is_connected($item['id'])) {
                if (is_siteadmin()) {
                    $item['fullname'] = '! ' . $item['fullname'];
                    $result2[] = $item;
                }
            } else {
                $result2[] = $item;
            }
        }
        return $result2;
    }
    private static function override_core_message_message_search_users($result) {
        error_log(print_r($result, 1));
        return $result;
    }
    private static function override_core_message_search_contacts($result) {
        error_log(print_r($result, 1));
        return $result;
    }
    private static function override_core_search_get_relevant_users($result) {
        error_log(print_r($result, 1));
        return $result;
    }
    private static function override_core_user_get_users($result) {
        error_log(print_r($result, 1));
        return $result;
    }
    private static function override_tool_lp_search_cohorts($result) {
        error_log(print_r($result, 1));
        return $result;
    }
    private static function override_tool_lp_search_users($result) {
        error_log(print_r($result, 1));
        return $result;
    }
}
