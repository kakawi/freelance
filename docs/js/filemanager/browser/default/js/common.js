// Automatically detect the correct document.domain (#1919).
(function()	{
	var d = document.domain;

	while ( true )	{
		// Test if we can access a parent property.
		try	{
			var test = window.top.opener.document.domain;
			break;
		}
		catch( e )	{}

		// Remove a domain part: www.mytest.example.com => mytest.example.com => example.com ...
		d = d.replace( /.*?(?:\.|$)/, '' );

		if ( d.length == 0 )
			break;		// It was not able to detect the domain.

		try	{
			document.domain = d;
		}
		catch (e)	{
			break;
		}
	}
})();

function AddSelectOption( selectElement, optionText, optionValue, optionSelected )	{
	var oOption = document.createElement("OPTION");

	oOption.text		= optionText;
	oOption.value		= optionValue;
	oOption.selected	= optionSelected;

	selectElement.options.add(oOption);

	return oOption;
}

var oConnector	= window.parent.oConnector;
var oStore		= window.parent.oStore;
//var bThumbMode = oConnector.ResourceType=='Image' && Config.ThumbList;

function StringBuilder( value )	{
    this._Strings = new Array( value || '' );
}

StringBuilder.prototype.Append = function( value )	{
    if ( value )
        this._Strings.push( value );
}

StringBuilder.prototype.ToString = function()	{	
    return this._Strings.join( '' );
}

function GetIconName (fileName) 	{
	var ext = fileName.substr( fileName.lastIndexOf('.') + 1 ).toLowerCase();
	var icon;
	if (ext){
		switch (ext) {
			case 'txt': case 'text': 																icon='file_text';	break;
			case 'doc': case 'docx': case 'rtf':													icon='file_word';	break;
			case 'xls': case 'xlsx': 																icon='file_excel';	break;
			case 'ppt': case 'pptx':																icon='file_pp';		break;
			case 'pdf': case 'djvu': case 'djv': 													icon='file_pdf';	break;
			case 'odt': case 'ods': case 'odp': case 'odg': case 'odc': case 'odb':					icon='file_oo';		break;
			case 'jpg': case 'jpeg': case 'png': case 'gif': case 'bmp': case 'tif': case 'psd':	icon='file_pic';	break;
			case 'mp3': case 'wav': case 'ogg':														icon='file_audio';	break;
			case 'avi': case 'mkv': case 'wmv': case 'flv': case 'mp4': case 'mpg': case 'mpeg':	icon='file_video';	break;
			case 'exe': case 'dll': case 'sys': case 'bin': 										icon='file_app';	break;
			case 'htm': case 'xml': case 'html': 													icon='file_html';	break;
			case 'php': case 'asp': case 'css': case 'js': 											icon='file_script';	break;
 			case 'eps': case 'svg': case 'ai': case 'cdr': case 'emf': case 'vsd': 					icon='file_vector';	break;
 			case 'swf': case 'swt': case 'fla': 													icon='file_flash';	break;
			case 'zip': case 'rar': case '7z': case 'tgz': case 'gz': case 'tar': 					icon='file_arch';	break;
			default: icon='default'; break
		};
		return icon;
	}
	else
		return 'default';
}
