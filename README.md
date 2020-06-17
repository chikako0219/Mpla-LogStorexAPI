# Mpla-LogStorexAPI

Before installing this plugin, please install following plugins.

Moodle Plugin Directory: logstore xAPI
https://moodle.org/plugins/logstore_xapi

Github: Mpla-LogStorexAPI
https://github.com/chikako0219/Mpla-SharedPanel

In this Plugin, you can export learning activity records on various commercial services such as Twitter, LINE, Email, Evernote to LRS as xAPI Statement.


# How to install
## Download Shared Panel
You can download this plugin from github.
We highly recommend to download from "Release" tag.

### Download from Release tag (Recommend)
Download latest Shared Panel from  `Source code (zip)`. 
https://github.com/chikako0219/Mpla-LogStorexAPI/releases

### Download from git master branch (For developer)

``` shell
$ git clone https://github.com/chikako0219/Mpla-LogstorexAPI.git /path/to/moodle/admin/tool/log/store/xapi/src/transformer/events/mod_sharedpanel/

```

### Unzip and deploy to Moodle
In this case, filename is `sharedpanel.zip`. Please rewrite filename.

```
$ unzip sharedpanel.zip /path/to/moodle/mod/sharedpanel
```

## Run install wizard

Login to Moodle as admin and run installation. Or, you can install with cli.

``` shell
$ php /path/to/moodle/admin/cli/upgrade.php
```

## add following codes

``` shell
        '\mod_sharedpanel\event\course_module_viewed' => 'mod_sharedpanel\course_module_viewed',
        '\mod_sharedpanel\event\card_created_moodle' => 'mod_sharedpanel\card_created_moodle',
        '\mod_sharedpanel\event\card_created_twitter' => 'mod_sharedpanel\card_created_twitter',
        '\mod_sharedpanel\event\card_created_facebook' => 'mod_sharedpanel\card_created_facebook',
        '\mod_sharedpanel\event\card_created_facebook' => 'mod_sharedpanel\card_created_facebook',
        '\mod_sharedpanel\event\card_created_line' => 'mod_sharedpanel\card_created_line',
        '\mod_sharedpanel\event\card_created_email' => 'mod_sharedpanel\card_created_email',
        '\mod_sharedpanel\event\card_created_evernote' => 'mod_sharedpanel\card_created_evernote',
```

# How to add new commercial services

| work sequence | create or add code| template or file name | directory | Details |
|:---:|:---:|:---|:---|:---|
| 1 | create | card_created_servicename.php | xapi/src/transformer/events/mod_sharedpanel | Define contents to export as a xAPI statement. |
| 2 | add code | get_event_function_map.php | xapi/src/transformer | Add the code to call the newly created 1. |

# Author
Chikako Nagaoka & KITA Toshihiro

*Some codes in email.php include codes by ming (http://qiita.com/ming/items/ce7b8f394cc9b12a2b49)

# License
GNU GPL v3
