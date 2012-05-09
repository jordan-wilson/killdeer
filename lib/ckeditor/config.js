/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	config.resize_enabled = false;
	config.toolbarCanCollapse = false;
	config.removePlugins = 'elementspath,save'
	
	config.toolbar_Pages = [
		['Maximize','Source'],
		['Bold','Italic','Underline'],
		['NumberedList','BulletedList'],
		['Link','Unlink','Anchor'],
		['Image','Table','HorizontalRule','Blockquote'],
		['Format']
	];
};
