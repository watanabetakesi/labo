var browserVer = navigator.appVersion.charAt(0);
var browserName = navigator.appName.charAt(0);
var patternSet = 'default';

function chkBrowser(path){
//document.write(navigator.appVersion + '<br>');
//document.write(navigator.appName + '<br>');
//document.write(navigator.userAgent + '<br>');

	if(navigator.userAgent.indexOf('Win')){
		if(browserName == 'N'){
			if(browserVer > 4){
				patternSet = 'win_basic';
			}
		}
		else{
			patternSet = 'win_basic';
		}
	}
	document.write('<link rel="stylesheet" type="text/css" href="'+ path +'css/' + patternSet + '.css" />');
}


