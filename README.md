# Signage

Each device has it's own url, which is /signage/pusher/app?screenid=_{nid}_ 
where _{nid}_ is the node id of the device's node. Eg; `/signage/pusher/app?screenid=4`
This is where the javascript app code is loaded from.

The app code will then load the screen configuration from /signage/pusher/_{nid}_ where _{nid}_ is the node id of the device's node.
Eg; `/signage/pusher/4`



 ![](https://github.com/dennisinteractive/signage/blob/master/img/signage_flow.png)
