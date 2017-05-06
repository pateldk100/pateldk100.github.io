function sanitizeForbiddenHTMLTextChars(in_s)
{
	var out_s = in_s.toString();//We are sometimes called to sanitize non-strings...like document.location

	out_s = out_s.split("<").join("&lt;");
	out_s = out_s.split(">").join("&gt;");
	out_s = out_s.split("'").join("&apos;");
	out_s = out_s.split('"').join("&quot;");
	
	return out_s;
}

function removeExtraURLParams(in_s)
{
	var inp = in_s.toString();
	var indexOfAmp = in_s.indexOf("&");
	
	var outp = inp;
	if(indexOfAmp!=-1)
		outp = inp.substring(0, indexOfAmp);
	
	return outp;
}

function showFlash(swf, w, h, loop)
{
	var isMSIE = navigator.appName.indexOf("Microsoft") != -1;
	var s = '';
	var protocol = 'http';//safe default
	var url = document.location.toString();
	indexOfColon = url.indexOf(":");
	if(indexOfColon>0)	
		protocol = url.substring(0, indexOfColon);
	if(protocol!='http' || protocol!='https')
		protocol='https';
	var location = document.location;
	location = (location==unescape(location))?escape(location):location;

	s += '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="' + protocol + '://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,65,0" width="'+w+'" height="'+h+'" id="SlideContent" align="" VIEWASTEXT>'
	s += '<param name="movie" value="'+sanitizeForbiddenHTMLTextChars(swf)+'" />'
	s += '<param name="menu" value="false" />'
	s += '<param name="quality" value="best" />'
	s += '<param name="loop" value="'+loop+'" />'
	s += '<param name="FlashVars" value="initialURL='+
			removeExtraURLParams(sanitizeForbiddenHTMLTextChars(location))+
			'&isMSIE='+isMSIE+'&useBSM=false" />'
	s += '<param name="allowScriptAccess" value="sameDomain"/>'
	s += '<embed src="'+sanitizeForbiddenHTMLTextChars(swf)+'" FlashVars="initialURL='+
			removeExtraURLParams(sanitizeForbiddenHTMLTextChars(location))+
			'&isMSIE='+isMSIE+'&useBSM=false" menu="false" quality="best" width="'+w+'" height="'+h+'" loop="'+loop+'" name="SlideContent" align="" type="application/x-shockwave-flash" pluginspage="' + protocol + '://www.macromedia.com/go/getflashplayer" swLiveConnect="true" allowScriptAccess="sameDomain"></embed>'
	s += '</object>'
	// in theory, we should always embed in a table, but in practice, IE6 malfunctions
	// when width & height = 100%, but in that case, we don't really need the table anyway.
	if ((w.toString().indexOf('%') == -1) && (h.toString().indexOf('%') == -1))
	{
		s = '<table border=0 width="100%" height="100%"><tr valign="middle"><td align="center">' +
			s +
			'</td></tr></table>';
	}
	document.write(s);
}
