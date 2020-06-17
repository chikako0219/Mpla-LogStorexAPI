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

namespace src\transformer\events\mod_sharedpanel;

defined('MOODLE_INTERNAL') || die();

use src\transformer\utils as utils;


//change "servicename" to your servicename
function card_created_servicename(array $config, \stdClass $event)
{

    $event_other = unserialize($event->other);

    $repo = $config['repo'];

    $user = $repo->read_record_by_id('user', $event_other['moodleuserid']);
    $course = $repo->read_record_by_id('course', $event->courseid);
    $lang = utils\get_course_lang($course);

    return [[
        'actor' => utils\get_user($config, $user),
        'verb' => [
            'id' => 'http://id.tincanapi.com/verb/viewed',
            'display' => [
		//change "tweeted" to your activity such as "posted" or "sent"
		$lang => 'tweeted'
            ],
        ],
        'object' => utils\get_activity\course_module(
            $config,
            $course,
            $event->contextinstanceid,
            'http://adlnet.gov/expapi/activities/link'
        ),
        'result' => [
            'response' => "text",
            'completion' => true,
            'extensions' => [
                'http://learninglocker.net/xapi/cmi/sharedpanel/moodleuserid' => $event_other['moodleuserid'],
                'http://learninglocker.net/xapi/cmi/sharedpanel/source' => $event_other['source'],
                'http://learninglocker.net/xapi/cmi/sharedpanel/username' => $event_other['username'],
                'http://learninglocker.net/xapi/cmi/sharedpanel/timeposted' => Date(DATE_ATOM, $event_other['timeposted']),
                'http://learninglocker.net/xapi/cmi/sharedpanel/content' => $event_other['content'],
            ],
        ],

        'timestamp' => Date(DATE_ATOM, $event_other['timeposted']),

        'context' => [
            'platform' => $config['source_name'],
            'language' => $lang,
            'extensions' => utils\extensions\base($config, $event, $course),
            'contextActivities' => [
                'grouping' => [
                    utils\get_activity\site($config),
                    utils\get_activity\course($config, $course),
                ],
                'category' => [
                    utils\get_activity\source($config),
                ]
            ]
        ]
    ]];
}
