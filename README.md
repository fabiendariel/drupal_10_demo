Demo site on Drupal 10 to learn how to develop backend tools
with :
- Custom subtheme base on Boostrap Barrio subtheme system
- Custom Homepage design
- Custom "Contact Layout" Form Module to produce a customizable form to interact with 
visitors and report submissions in the administration area
- "Custom blocks" module to generate specific Header and Footer via Twig templates


And contrib module pre-install to test:
- Admin Toolbar
- Backup & Migrate
- Ckeditor5 Icon (so I can use FontAwesome icons)
- SVG image
- Config Pages (not use for the moment)
- Devel
- DropZoneJs (I'm looking to implement multi-files drop possibilities)
- Examples

Database backup is available in the private directory.

You can access administration panel with login "admin" and password "12345"

Custom report for the contact form submissions can be found in "Reports" > "List of Contact submissions"

To configure which content type will offer the option to add the layout contact form you have to go in the "Configuration" menu 
> "Content authoring"
> "Contact Layout List Settings"

After that you will have an option in the content editor 
> "Contact Layout Collection" 
> and check "Collect Contact Layout Form submissions for this node."
