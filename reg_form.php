<!DOCTYPE html>
<html>
<head>
	<title>Регистрация</title>
	<meta charset="UTF-8">
	<style>
		@import url('css/butons.css');
		@import url('css/registration/reg_form.css');
		@import url('css/back/background.css');
		@import url('css/text/font.css');
		@import url('css/cur/cursor.css');
	</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			// Создание аудио элемента
			var audio = document.createElement('audio');
			audio.autoplay = true;
			audio.loop = true;
			audio.preload = 'auto';
			audio.style.display = 'none';

			var source = document.createElement('source');
			source.src = 'redb.php';
			source.type = 'audio/mpeg';

			audio.appendChild(source);
			document.body.appendChild(audio);

			// Создание элементов формы регистрации
			var form = $('<form>').attr({
				action: 'reg.php',
				method: 'post'
			});

			var h1 = $('<h1>').text('Регистрация');
			form.append(h1);

			var div1 = $('<div>');

			var emailLabel = $('<label>').text('Ваша почта:');
			var emailInput = $('<input>').attr({
				name: 'login',
				placeholder: 'Почта',
				type: 'email',
				size: '20',
				maxlength: '100',
				required: true,
				id: 'login'
			});
			div1.append(emailLabel, emailInput);

			var div2 = $('<div>');

			var passwordLabel = $('<label>').text('Придумайте пароль:');
			var passwordInput = $('<input>').attr({
				name: 'password',
				placeholder: 'Пароль',
				type: 'password',
				size: '15',
				maxlength: '15',
				required: true,
				id: 'password'
			});
			div2.append(passwordLabel, passwordInput);

			var registrationButtonDiv = $('<div>');
			var registrationButton = $('<button>').append('<a>').text('Регистрация');
			registrationButtonDiv.append(registrationButton);
			form.append(div1, div2, registrationButtonDiv);

			var backButtonDiv = $('<div>');
			var backButton = $('<button>').attr('type', 'button').click(function() {
				history.back();
			}).append('<a>').text('Назад');
			backButtonDiv.append('<br>', backButton);
			form.append(backButtonDiv);

			// Добавление формы в соответствующий элемент
			var nav = $('<ul>').addClass('nav');
			nav.append(form);

			// Добавление элементов на страницу
			var container = $('<div>').addClass('container');
			var section = $('<section>').attr('id', 'content');
			var wrapper = $('<div>').attr('id', 'wrapper');

			wrapper.append(nav);
			section.append(wrapper);
			container.append(section);
			$('body').append(container);
		});
	</script>
</head>
<body>
	<div class="piska"></div>
</body>
</html>
