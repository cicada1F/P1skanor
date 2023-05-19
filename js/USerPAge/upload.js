function compressImage(file, callback) {
  var reader = new FileReader();
  reader.onload = function(e) {
    var img = document.createElement('img');
    img.onload = function() {
      var canvas = document.createElement('canvas');
      var ctx = canvas.getContext('2d');

      // Задайте максимальные ширину и высоту для сжатого изображения
      var maxWidth = 800;
      var maxHeight = 600;

      var width = img.width;
      var height = img.height;

      // Вычислите новые размеры изображения с сохранением пропорций
      if (width > height) {
        if (width > maxWidth) {
          height *= maxWidth / width;
          width = maxWidth;
        }
      } else {
        if (height > maxHeight) {
          width *= maxHeight / height;
          height = maxHeight;
        }
      }

      // Установите размер холста для сжатого изображения
      canvas.width = width;
      canvas.height = height;

      // Сжатие изображения на холсте
      ctx.drawImage(img, 0, 0, width, height);

      // Получите сжатое изображение в формате JPEG с качеством 75
      var compressedImageData = canvas.toDataURL('image/jpeg', 0.75);

      // Вызовите обратный вызов с сжатыми данными изображения
      callback(compressedImageData);
    }
    img.src = e.target.result;
  }
  reader.readAsDataURL(file);
}

// Обработка загрузки новой аватарки
document.getElementById('avatar').addEventListener('change', function(e) {
  var file = e.target.files[0];
  if (file) {
    compressImage(file, function(compressedImageData) {
      // Отправьте сжатые данные изображения на сервер
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'upload.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Обработка ответа сервера после успешной загрузки
          console.log(xhr.responseText);
        }
      }
      xhr.send('compressedImageData=' + encodeURIComponent(compressedImageData));
    });
  }
});