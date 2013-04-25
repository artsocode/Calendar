		<!--LOGO START-->
		<div class="cal-logo-container">
			<img class="cal-logo-images" src="../images/logo.png" alt="Календариус">
			<h1 class="cal-logo-title">КАЛЕНДАРИУС</h1>
		</div>
		<!--LOGO END-->		
		<div class="cal-form">
			<!--FORM TRIGGERS START-->
			<div class="cal-controlls">
				<div class="cal-auth-select">
					<div class="cal-auth-select-ico"></div>
				</div>
				<div class="cal-registr-select">
					<div class="cal-registr-select-ico"></div>
				</div>				
			</div>
			<!--FORM TRIGGERS END-->
			<!--AUTHORIZATION AND REGISTRATION WINDOW START-->	
			<div class="cal-form-window">
				<div class="cal-form-lent">	
					<!--AUTHORIZATION FORM START-->	
					<div class="cal-auth-form">
						<h2 class="cal-login-form-head-title"><strong>Авторизация</strong></h2>
						<form action="/login" method="post" accept-charset="utf-8">
							<label class="cal-auth-un-label" for="username">Username or Email</label>
							<input class="cal-auth-un-input" type="text" name="username" value="" placeholder="Type your Username or Email" required>
							<label class="cal-auth-ps-label" for="password">Password</label>
							<input class="cal-auth-ps-input" type="password" name="password" value="" placeholder="And your Password of course" required>
							<input class="cal-auth-submit-btn" type="submit" name="logSub" value="Войти">
						</form>
					</div>
					<!--AUTHORIZATION FORM END-->					
					<!--REGISTRATION FORM START-->
					<div class="cal-registr-form">
						<h2 class="cal-login-form-head-title"><strong>Регистрация</strong></h2>
						<form action="/registr" method="post" accept-charset="utf-8">
							<label class="cal-reg-un-label" for="username">Username</label>
							<input class="cal-reg-un-input" type="text" name="username" value="" placeholder="Hey there, enter your Username" required>
							<label class="cal-reg-em-label" for="email">Email</label>
							<input class="cal-reg-em-input" type="email" name="email" value="" placeholder="Don't forget your Email" required>
							<label class="cal-reg-ps-label" for="password">Password</label>
							<input class="cal-reg-ps-input" type="password" name="password" value="" placeholder="And LOOONGEST and STRONGEST Password" required>
							<input class="cal-reg-submit-btn" type="submit" name="logSub" value="Регистрация">
						</form>
					</div>
					<!--REGISTRATION FORM END-->
				</div>
			</div>
			<!--AUTHORIZATION AND REGISTRATION WINDOW END-->				
		</div>