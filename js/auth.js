$(document).ready(function() { //НАЧАЛО READY

	/*Authorization and Registration form trigger*/

	/*INITIALIZATION START*/

	/*Focus color variable start*/
	var colorObj = {
		    blueColorHex: '#35ABC0',
		    grayColorHex: '#7F7F7F',
		   whiteColorHex: '#FFFFFF',
		softGrayColorHex: '#E5E5E5',
	}
	/*Focus color variable end*/

	/*Main reg & auth form controlls start*/
	var controllsObj = {
		   authParent: $('.cal-auth-select'),
		    regParent: $('.cal-registr-select'),
		         auth: $('.cal-auth-select-ico'),
		      registr: $('.cal-registr-select-ico'),
		         lent: $('.cal-form-lent')
	};
	/*Main reg & auth form controlls end*/

	/*Main reg & auth form input and labels start*/
	var formObj = {
		authUNInput: $('.cal-auth-un-input'),
		authPSInput: $('.cal-auth-ps-input'),
		authUNLabel: $('.cal-auth-un-label'),
		authPSLabel: $('.cal-auth-ps-label'),
		 regUNInput: $('.cal-reg-un-input'),
		 regEMInput: $('.cal-reg-em-input'),
		 regPSInput: $('.cal-reg-ps-input'),
		 regUNLabel: $('.cal-reg-un-label'),
		 regEMLabel: $('.cal-reg-em-label'),
		 regPSLabel: $('.cal-reg-ps-label'),
	}
	/*Main reg & auth form input and labels end*/

	/*Form position*/
	var form = activeBtn();

	/*INITIALIZATION END*/

/*INPUT AND LABELS FOCUS EVENTS START*/
/*AUTHORIZATION EVENTS START*/
	formObj.authUNInput.focus(function() {
		formObj.authUNLabel.css({'color': colorObj.blueColorHex});
	});
	formObj.authUNInput.blur(function() {
		formObj.authUNLabel.css({'color': colorObj.grayColorHex});
	});

	formObj.authPSInput.focus(function() {
		formObj.authPSLabel.css({'color': colorObj.blueColorHex});
	});
	formObj.authPSInput.blur(function() {
		formObj.authPSLabel.css({'color': colorObj.grayColorHex});
	});
/*AUTHORIZATION EVENTS END*/

/*REGISTRATION EVENTS START*/
	formObj.regUNInput.focus(function() {
		formObj.regUNLabel.css({'color': colorObj.blueColorHex});
	});
	formObj.regUNInput.blur(function() {
		formObj.regUNLabel.css({'color': colorObj.grayColorHex});
	});

	formObj.regEMInput.focus(function() {
		formObj.regEMLabel.css({'color': colorObj.blueColorHex});
	});
	formObj.regEMInput.blur(function() {
		formObj.regEMLabel.css({'color': colorObj.grayColorHex});
	});

	formObj.regPSInput.focus(function() {
		formObj.regPSLabel.css({'color': colorObj.blueColorHex});
	});
	formObj.regPSInput.blur(function() {
		formObj.regPSLabel.css({'color': colorObj.grayColorHex});
	});
/*REGISTRATION EVENTS END*/
/*INPUT AND LABELS FOCUS EVENTS END*/

/*FORM SWITCH START*/
/*AUTH CONTROLLS START*/
	controllsObj.authParent.mousemove(function() {		
		if (form) {
			controllsObj.auth.css({'opacity': '1'});
		}
	});
	controllsObj.authParent.mouseleave(function() {
		if (form) {
			controllsObj.auth.css({'opacity': '.6'});
		}
	});
	controllsObj.authParent.click(function() {		
		if (form) {
			controllsObj.lent.css({'right': '0px'});
			controllsObj.registr.css({'opacity': '.6'});
			styleSwitch(controllsObj.regParent, false);
			styleSwitch($(this), true);			
			form = 0;
		}
	});
/*AUTH CONTROLLS END*/

/*REG CONTROLLS START*/
	controllsObj.regParent.mousemove(function() {
		if (!form) {
			controllsObj.registr.css({'opacity': '1'});
		}
	});
	controllsObj.regParent.mouseleave(function() {
		if (!form) {
			controllsObj.registr.css({'opacity': '.6'});
		}
	});
	controllsObj.regParent.click(function() {
		if (!form) {
			controllsObj.lent.css({'right': '260px'});
			controllsObj.auth.css({'opacity': '.6'});
			styleSwitch(controllsObj.authParent, false);
			styleSwitch($(this), true);			
			form = 260;
		}
	});
/*REG CONTROLLS END*/
/*FORM SWITCH END*/


/*VALIDATE FUNCTION START*/
/*Active button check*/
function activeBtn() {
	var right = controllsObj.lent.css('right');
	right = parseInt(right);
	if (right === 260) {
		return true;
	} else {
		return false;
	}
}

(function activeBtnTriger() {
	if (form) {
		controllsObj.registr.css({'opacity': '1'});		
	} else {
		controllsObj.auth.css({'opacity': '1'});
	}
})();

/*Field value check*/
function validateField(btnObj, fieldTypeStr) {
	switch(fieldTypeStr) {
		case 'username': {
			break;
		}
		case 'email': {
			break;
		}
		case 'password': {
			break;
		}
		default: {
			break;
		}
	}
}
/*VALIDATE FUNCTION END*/

/*SET AND DEL STYLE START*/
function styleSwitch(objObj, setBool) {
	if (setBool) {
		objObj.css({'background-color': '#FFFFFF'});
	} else {
		objObj.css({'background-color': '#E5E5E5'});
	}
}
/*SET AND DEL STYLE END*/
});
