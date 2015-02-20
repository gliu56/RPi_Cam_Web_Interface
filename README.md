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
Change style of preview to a group of thumbnails

