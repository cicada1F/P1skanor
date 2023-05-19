<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <audio autoplay loop preload="auto" style="display: none;">
    <source src="audb.php" type="audio/mpeg">
  </audio>
  <head>
    <title>Авторизация</title>
    <meta charset="UTF-8">
    <style>
      @import url('css/butons.css');
      @import url('css/cur/cursor.css');
      @import url('css/login/auth_form.css');
      @import url('css/back/background.css');
      @import url('css/text/font.css');
      .button-spacing {
        margin-top: 10px;
      }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        var form = $('<form>').attr({
          action: 'auth.php',
          method: 'post'
        });

        var h1 = $('<h1>').text('Вход');
        form.append(h1);

        var div1 = $('<div>');
        var emailLabel = $('<label>').text('Почта:');
        var emailInput = $('<input>').attr({
          name: 'login',
          placeholder: 'Почта',
          type: 'text',
          size: '15',
          maxlength: '20',
          required: true,
          id: 'email'
        });
        div1.append(emailLabel, emailInput);

        var div2 = $('<div>');
        var passwordLabel = $('<label>').text('Пароль:');
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

        var div3 = $('<div>');
        var loginButton = $('<button>').attr('type', 'submit').text('Войти');
        var restoreButton = $('<button>').attr('type', 'button').click(function() {
          window.location.href = 'restore_form.php';
        }).text('Восстановить пароль');
        var backButton = $('<button>').attr('type', 'button').click(function() {
          history.back();
        }).append('<a>').text('Назад');
        div3.append(loginButton, '<br><br>', restoreButton, '<br><br>', backButton);

        var h2 = $('<h2>').text('Нет аккаунта?');
        div3.append(h2);

        var registerButton = $('<button>').attr('type', 'button').click(function() {
          window.location.href = 'reg_form.php';
        }).append('<a>').text('Зарегайся');
        div3.append(registerButton);

        form.append(div1, div2, div3);

        var nav = $('<ul>').addClass('nav');
        nav.append(form);

        var container = $('<div>').addClass('container');
        var wrapper = $('<div>').attr('id', 'wrapper');
        var section = $('<section>').attr('id', 'content');

        wrapper.append(section);
        section.append(nav);
        container.append(wrapper);
        $('body').append(container);

        <?php if (!empty($_SESSION['login']) || !empty($_SESSION['id'])) { ?>
        var loggedInDiv = $('<div>');
        var loggedInH2 = $('<h2>').text('Underdog! Вы уже залогинены');
        var loggedInH1 = $('<h1>').text('<?php echo $_SESSION['login']; ?>');
        var exitLink = $('<a>').attr('href', '?exit').append('<h2>').text('Выйти');
        var mainPageLink = $('<a>').attr('href', 'main.php').append('<h2>').text('На главную');
        loggedInDiv.append(loggedInH2, loggedInH1, exitLink, mainPageLink);
        nav.append(loggedInDiv);
        <?php } ?>
      });
    </script>
  </head>
  <body>
    <div class="piska"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  </body>
</html>
