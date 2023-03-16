<?php
require_once('config.inc.php');
?>

<section class="contact-holder">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div class="title">Hier finden Sie uns</div>
				<h3>healthPi <br> Medical Center</h3>
				<p>
					Wollzeile 1 <br>
					1010 Wien, Österreich <br>
					Telefon: +43 1 9974207 <br><br>

					Email: <a href="mailto:office@healthPi.at">office@healthPi.at</a><br>
					Web: <a href="http://www.healthpi.at" target="_blank" lang="de">www.healthpi.at</a>
				</p>
				<ul class="social-icons clearfix">
					<li><a href="https://twitter.com/spinemedvienna" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="https://plus.google.com/117706557119252024580" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					<li><a href="https://at.linkedin.com/in/spinemed-vienna-30a36883" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					<li><a href="https://www.facebook.com/spinemed.vienna?fref=ts" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="https://www.youtube.com/user/spinemedvienna" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
				</ul>
			</div>

			<div id="contact-form" class="col-xs-12 col-md-8">
				<div class="title">Kontaktieren Sie uns - <br>
					wir beantworten Ihre Fragen!</div>

				<form action="email.php" method="post" id="contact-form-for-submit" onsubmit="ga('send', 'event', 'Contact Form Events', 'Click', 'CTA');">
					<input type="text" name="name" id="name" placeholder="Name" value="" required>
					<input type="email" name="email" id="email" placeholder="E-mail" value="" required>
					<input type="text" name="betreff" id="betreff" placeholder="Telefonnummer (optional)" value="" required>
					<textarea name="nachricht" id="nachricht" rows="3" placeholder="Nachricht" required></textarea>
                    <input type="submit" class="contact-submit" value="Nachricht senden" title="Nachricht senden">
				</form>
                <script>
                    var $form = $('#contact-form-for-submit');

                    $form.submit(function(event) {
                        event.preventDefault();
                        var name = $('#name').val();
                        var email = $('#email').val();
                        var tel = $('#text').val();
                        var message = $('#nachricht').val();

                        grecaptcha.ready(function() {
                            grecaptcha.execute('6LezR7QiAAAAAG7dqB3Kw4urwjgyfZ62oGWoYKyE', {action: 'send_message'}).then(function(token) {
                                $form.prepend('<input type="hidden" name="token" value="' + token + '">');
                                $form.prepend('<input type="hidden" name="action" value="send_message">');
                                $form.unbind('submit').submit();
                            });
                        });
                    });
                </script>
			</div>
		</div>
	</div>
</section>
