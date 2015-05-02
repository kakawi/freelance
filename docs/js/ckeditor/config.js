/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.uiColor = '#CCD9FF';
	config.shiftEnterMode = CKEDITOR.ENTER_BR;
	config.forcePasteAsPlainText = true;
    config.extraPlugins = 'syntaxhighlight';
    config.filebrowserBrowseUrl = '/js/filemanager/browser/default/browser.html?Connector=/js/filemanager/connectors/php/connector.php';
    config.filebrowserImageBrowseUrl = '/js/filemanager/browser/default/browser.html?Type=Image&Connector=/js/filemanager/connectors/php/connector.php';
    //config.toolbar_Full.push(['Code']);
};
