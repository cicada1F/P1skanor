var message = document.createElement("div");
message.id = "message";
message.textContent = "Для обновления пароля необходимо ввести вашу текущую почту в поле (Введите почту), если вы хотите обновить почту то в поле (Введите почту) вводите новую почту и в поля паролей надо вводить текущий пароль";
document.getElementById("message-container").appendChild(message);

function showMessage() {
  message.style.display = "flex";
  message.style.animation = "slide-in 5s ease-out forwards";
}

function hideMessage() {
  document.getElementById("message-container").style.animation = "hide-message 5s ease-out forwards";
  
}

showMessage();
setTimeout(hideMessage, 20000);