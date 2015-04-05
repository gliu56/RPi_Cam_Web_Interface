Web based interface for controlling the Raspberry Pi Camera, includes motion detection, time lapse, and image and video recording.

All information on this project can be found here: http://www.raspberrypi.org/forums/viewtopic.php?f=43&t=63276

The wiki page can be found here:

http://elinux.org/RPi-Cam-Web-Interface

Modifications by RJ Tidey to preview page
Instead of a list of the captured filenames they are parsed into a table
making it a little clearer and allowing more rapid delete of individual files.
Images recorded are displayed as thumbnails.

Videos recorded after motion detection can also have a thumbnail of their first
capture frame generated by motion.

To do this requires a couple of config lines in motion.conf to be edited.
output_normal first.

target_dir /var/www/media

jpeg_filename vthumb_%Y%m%d_%H%M%S

These allow motion to put a thumbnail into the media folder when triggered.
The new preview.php associates these with the corresponding recording.

Thumbnails are also generated for manually recorded images
and videos using ffmpeg. It can give a delay when going into the list if new material needs
to be thumbnailed, but after that it is faster.

Each row has an explicit preview and delete button and select checkboxes.
Select all, Select None and Delete selected, and Get Zip functions added.

Preview and thumbnail sizes can be changed per browser (cookies).

Tech changed from GET to POST and download moved into preview.php

20th Feb 2015
Change style of preview to a group of thumbnails.
Styling of preview improved and preview.css added to css folder

21st Feb 2015
Add video/image indicator back into file captures

23rd Feb 2015
Initial version to allow setting motion.conf from web interface

24th Feb 2015
Added a thumbnail orphan check in preview.phpto make sure there are no spurious thumbnails left over.
Motion.php detects and warns if motion not running.
Added Backup and restore buttons. These save to a server side json file.

25th Feb 2015
Installer script sync'd to master
Bug in motion settings restore corrected

1st March 2015
Fixed broken download

2nd March 2015
Added Schedule.php which provides a web page to set automation settings and a daemon to execute them.
To use the motion commands for start and end need to be 0 and 1 sent to schedule FIFOIN (/var/www/FIFO1)
Schedule will then send its configured commands to FIFOOUT (/var/www/FIFO)
Schedule needs to be started once on its settings page or can be arranged to autostart by adding a php schedule.php
command to boot.

4th March 2015
Updated main index page to give access to schedule functions

5th March 2015
Raspimjpeg now has new lapse_path setting for time lapse captures
Raspimjpeg now generates all thumbnails for motion triggered and manual recordings.
The motion image thumbnail is turned off.

6th March 2015
Thumbnail orphan check in preview was deleting all thumbnails. Now updated to
account for new thumbnail method.
raspimjpeg now supports a user config file to allow persisting settings from web page
experimental version of cmd_pipe.php to persist the values from web.
Previous one is still there called cmd_pipeOld.php. If any problems then restore this
back to cmd_pipe.php

7th March 2015
raspimjpeg now clears out any commands left in Pipe during start up
config files are reloaded if stopped and started via web interface
System area has an extra button to reset user settings and revert to 'factory' defaults

8th March 2015
Changed thumbnail naming scheme to make it independent of main naming which may be made
more flexible in the future.
(.[vit]capnumber.th.jpg is appended on the end of the captured file.
Preview now uses modifed file date to extract date rather than filename.
Tme lapse files are now labelled as 't' rather than previous l to make it clearer.
raspimjpeg now includes thumbnail generation for time lapse. These show up as
one icon in preview and indicate the number of images in the capture (in size row).
Deleting a time lapse capture deletes all files associated with it.

March 9th 2015
Naming scheme switched to using different letters for date fields and image counts
which may be put in any order. Default config file changed to this. Any existing config
file must be updated to use new scheme.
Version bumped to 4.4.1R Now includes annotation in new naming scheme.
Added gmt offset into schedule settings and display current sunrise/sunset
Allow gmt offset to be specified by a timezone string

March 10th 2015
Schedule now gets current time as local time for comparison purposes. Rasberry
should have its time zone set up properly. Current time is shown on schedule page.
raspimjpeg now does a directory scan at start up to set video and image indexes itself
The command line switches to set these from the start up script are removed and the
start command in the installer script simplified. This also makes it start quicker.
Default on camera settings page updated to new naming scheme.
Fixed preview download and get zip which were doing thumbnails rather than real captures
When time lapses are downloaded from preview it is a zip containing all lapse files
When a get zip is done then any time lapse selected get all files for each lapse. 
Updated schedule defaults to prevent problems if motion started manually as well.

March 11th 2015
Fix for raspimjpeg so it properly handles motion triggered time lapse recordings.
pipan and pilight controls added to index.php and pipan.php / pipan.js added
These only appear if pipan_on and/or pilight_on files exist in www
Schedule now has a command help table
Apply more styling to schedule and motion settings

March 13th 2015
Raspimjpeg built against new libraries, no change in function but might affect
annotation instability
Schedule was only changing day periods on the hour not at minute intervals as intended. Fixed

March 14th 2015
{Added MergeRecording_Gap to schedule settings to merge motion triggered recordings close
to each other by less than the gap between stop and next start.}
Schedule change reverted as motion gap achieves the same thing.
Path to logs and config file made explicit paths.
rc.local seemed to be causing some boot cycles not to start raspimjpeg probably
starting up too fast. Old slower version put back whilst this is checked.

March 15th 2015
Added a style override selector under system settings
Provided a basic night style (day is still default)
Corrected type in default annotation

March 16th 2015
Style selector now has separate OK buttton to apply change

March 18th 2015
raspimjpeg and preview changed to support multi-level folders
under /var/www/media where constants and naming variables can be used to
create folders. All thumbnails are still shown together in preview but link
through to wherever the file is. Do not use '@' in folder or filenames.
Empty subfolders are deleted.
Schedule now has an all day override and doesn't need to be started and stopped after saving

March 19th 2015
Installer now has entries starting up scheduler on boot up
Added support for v3 annotation

March 20th 2015
Preview fix for zips and downloads
Flatten downloads with @ rather than let browser do it
Default annotation fix
Different strategy for permissions on subfolders
Parameters on pipe commands no longer fixed width and position
Experimental timelapse to video conversion in preview (slow)

March 21st 2015
Preset fix. Browser may need shift refresh to clear javascript cache
Install script now has an update command which will just update raspimjpeg and the web
folder. No config files are changed.
Boxing mode added to select whether off/inline/background

March 22nd 2015
Time lapse conversion runs in background and has editable command.

March 24th 2015
Added cookie based Simple / Full display mode
Raspimjpeg more tolerant to some errors

March 25th 2015
Camera settings shows current values

March 26th 2015
TIme lapse interval setting is now held like all other variables in
raspimjpeg and uconfig. Time lapse start and stop now just send 0/1
Fix for loading incorrect value into video fps etc
raspimjpeg now rescans for highest video and image number if it is
stopped and restarted from the web interface.

March 27th 2015
Centralised some common php routines into config.php
When changing camera settings back to a default value the item is
removed from uconfig
Layout changes to schedule page
Added user command and file purge in scheduler
Max_Capture 0 disables the time-out on motion captures.

March 28th 2015
RPi cam can be started in debug mode where debug messages are output
Call script debug instead of start debug to terminal
Call script with debugF writes to a file raspiDebug.txt in www folder
(FIle is only closed and updated when script stop is called.

March 29th
Scheduler reworked to support 3 period calculations (Sun based, All Day, Fixed Times)
Fixed Times supports 6 fixed times per day
Scheduler command table rotated to fit better.

April 3rd 2015
raspimjpeg restructured to make config much easier to maintain
raspimjpeg now persists to uconfig rather than cmd_pipe.
This means commands from other than the web also persist to uconfig
Correction to handle negative values correctly

April 4th 2015
raspimjpeg can now log to a file specified in config, Config file
has this defaulted to same as scheduler so they show in that log.
Download log button added.
Installer script debugF option removed as now redundant.
Schedule page only shows the rows applicable to the day mode selected.

April 5th 2015
Day mode on scheduler now shows the relevant rows when clicked
Schedule columns relabelled
Image capture allowed in all states except timelapse
Increased php timeout on preview for zipping and converting


