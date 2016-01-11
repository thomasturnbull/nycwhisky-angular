Moderate bypass adds some functionality to the popular modr8 module. It solves the problem of requiring moderation for some roles and not others. A common moderation use case is to require pre-moderation for certain roles and no moderation at all for other roles.

Moderate bypass works by exposing a permission for each moderated content type, allowing you to select which roles may bypass moderation for each content type. In addition it also provides two configuration options:

A. Set bypassed node types to be published by default

B. Remove moderate checkbox for bypassed node types

Option A is useful since in order to implement pre-moderation with modr8 you must set published to 0 in the content type's workflow settings. We will commonly want to allow users with bypass permission to publish nodes immediately so this option will override the default workflow settings.

Option B is used to remove the checkbox which is added to the node add form by modr8 module for users with bypass permission.
