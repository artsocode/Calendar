$(document).ready(function() { //НАЧАЛО READY

	/*Authorization and Registration form trigger*/

	/*INITIALIZATION START*/

	/*Focus color variable start*/
	var colorObj = {
		    blueColorHex: '#35ABC0',
		    grayColorHex: '#7F7F7F',
		   whiteColorHex: '#FFFFFF',
		softGrayColorHex: '#E5E5E5'
	};
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
		   authForm: $('.cal-auth-from'), 
		authUNInput: $('.cal-auth-un-input'),
		authPSInput: $('.cal-auth-ps-input'),
		authUNLabel: $('.cal-auth-un-label'),
		authPSLabel: $('.cal-auth-ps-label'),
		 authSubmit: $('.cal-auth-submit-btn'),
			regForm: $('.cal-reg-from'),
		 regUNInput: $('.cal-reg-un-input'),
		 regEMInput: $('.cal-reg-em-input'),
		 regPSInput: $('.cal-reg-ps-input'),
		 regUNLabel: $('.cal-reg-un-label'),
		 regEMLabel: $('.cal-reg-em-label'),
		 regPSLabel: $('.cal-reg-ps-label'),
		  regSubmit: $('.cal-reg-submit-btn')
	};
	/*Main reg & auth form input and labels end*/

	/*Form position*/
	var form = activeBtn();

	/*INITIALIZATION END*/

/*AUTHORIZATION START*/
formObj.authForm.submit(function() {
	var username = validateField(formObj.authUNInput.val(), 'username');
	var password = validateField(formObj.authPSInput.val(), 'password');
	if (username == true) {
		if (password == true) {
			return true;
		} else {
			alert(password);
			return false;
		}
	} else {
		alert(username);
		return false;
	}
	return false;
});
/*AUTHORIZATION END*/

/*REGISTRATION START*/
formObj.regForm.submit(function() {
	var username = validateField(formObj.regUNInput.val(), 'username');
	var password = validateField(formObj.regPSInput.val(), 'password');
	var email = validateField(formObj.regEMInput.val(), 'email');
	if (username == true) {
		if (email == true) {
			if (password == true) {
				return true;
			} else {
				alert(password);
				return false;
			}
		} else {
			alert(email);
			return false;
		}
	} else {
		alert(username);
		return false;
	}
	return false;
});
/*REGISTRATION END*/

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
			lockForm('reg', 'lock');
			lockForm('auth', 'unlock');
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
			lockForm('reg', 'unlock');
			lockForm('auth', 'lock');
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
function validateField(validObj, validType) {
	switch(validType) {
		case 'username': {
			if (validObj != 'null' && validObj != '' && validObj != 0) {
				if (validObj.length >= 50) {
					return 'Username должен быть короче 50 символов';
				} else {
					return true;
				}
			} else {
				return 'Поле пусто';
			}
		}
		case 'email': {
			if (validObj != 'null' && validObj != '' && validObj != 0) {
				var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    			var isEmail = pattern.test(validObj);
				if (isEmail) {
					return true;
				} else {
					return 'Не верный email';
				}
			} else {
				return 'Поле пусто'
			}
			
			break;
		}
		case 'password': {
			if (validObj != 'null' && validObj != '' && validObj != 0) {
				if (validObj.length >= 255) {
					return 'Password должен быть короче 255 символов';
				} else {
					return true;
				}
			} else {
				return 'Поле пусто';
			}
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

/*LOCK AND UNLOCK MINE FORM START*/
function lockForm(formStr, actionStr) {
	if (formStr == 'auth') {
		switch(actionStr) {
			case 'lock': {
				formObj.authUNInput.prop('disabled', true);
				formObj.authPSInput.prop('disabled', true);
				formObj.authSubmit.prop('disabled', true);
				return true;
			}
			case 'unlock': {
				formObj.authUNInput.prop('disabled', false);
				formObj.authPSInput.prop('disabled', false);
				formObj.authSubmit.prop('disabled', false);
				return true;
			}
			default: {
				return false;
			}
		}
	} else if (formStr == 'reg') {
		switch(actionStr) {
			case 'lock': {
				formObj.regUNInput.prop('disabled', true);
				formObj.regEMInput.prop('disabled', true);
				formObj.regPSInput.prop('disabled', true);
				formObj.regSubmit.prop('disabled', true);
				return true;
			}
			case 'unlock': {
				formObj.regUNInput.prop('disabled', false);
				formObj.regEMInput.prop('disabled', false);
				formObj.regPSInput.prop('disabled', false);
				formObj.regSubmit.prop('disabled', false);
				return true;
			}
			default: {
				return false;
			}
		}
	}
}
/*LOCK AND UNLOCK MINE FORM END*/

});
