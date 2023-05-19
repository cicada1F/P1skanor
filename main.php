<?php
   session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:xlink="http://www.w3.org/1999/xlink">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main_php/styles.css">
  <link rel="stylesheet" href="css/text/font.css">
  <link rel="stylesheet" href="css/back/background.css">
  <title>P1skanor</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <div class="piska"></div>
  <div id="header">
      <h1>P1skanor</h1>
    <ul class="nav"> 
<?php
  // подключение меню
  require_once 'menu.php';
?> 
</ul>
  </div>
  <div id="container">
    <span class="tl"></span><span class="tr"></span>
    <div class="post"></div>
    <div class="flair1" role="presentation"></div>
    <div class="flair2" role="presentation"></div>
    <div class="flair3" role="presentation"></div>
    <div class="flair4" role="presentation"></div>
    <div class="flair5" role="presentation"></div>
    <div class="extra6" role="presentation"></div>
    <span class="bl"></span><span class="br"></span>
  </div>

  <!-- надо закончить скрипт чтоб работал норм -->
  <!-- src="js/DOM.js" -->
  <script>
    // Create banner
    const banner = `
    <div class="banner">
      <ul>
        <li><a href="active.php">П.Т.У.</a></li>
        <li><a href="otziv.php">Отзывы</a></li>
        <li><a href="help.php">Поддержка</a></li>
      </ul>
    </div>
    `;

    // Add banner to the header
    const header = document.getElementById("header");
    header.insertAdjacentHTML("afterend", banner);

    // Create topics
    const topicsArray = [];

    const topicTitle = document.createElement("h4");
    topicTitle.innerText = "";

    const topics = document.createElement("ul");

    topicsArray.forEach((topic) => {
      const topicItem = document.createElement("li");
      topicItem.innerText = topic;
      topics.appendChild(topicItem);
    });

    const root = document.querySelector(":root");
    root.style.setProperty("--num-of-topics", topicsArray.length);

    // Add topics to the container
    const container = document.getElementById("container");
    container.appendChild(topicTitle);
    container.appendChild(topics);

    // Create post
    const post = document.createElement("div");
    post.setAttribute("class", "post");

    // Create cards
    const cardsData = [{
      cardNum: 1,
      title: "Сервис-агрегатор П.Т.У.*",
      body: [
        "Преимущества нашего сервиса: Мы представляем на нашей площадке поставщиков телекоммуникационных услуг (П.Т.У.), которые прошли проверку и обладают сертификацией. Мы гарантируем высокое качество услуг, предоставляемых нашими поставщиками, чтобы обеспечить максимальное удовлетворение потребностей наших клиентов."
      ]
    }, {
      cardNum: 2,
      title: "Правила пользования Сайтом",
      list: [{
        text: "Список всех правил",
        link: "rules.php"
      }],
      body: [
        "Добро пожаловать на Сайт P1SKANOR — интернет-ресурс, предоставляющий Вам доступ к Базе данных* по получению телекоммуникационных услуг. Лицензиар (далее — Администрация) предоставляет Вам как Лицензиату (далее — Пользователю) Программ для ЭВМ и Базы данных данного Сайта доступ к самостоятельному использованию предоставленных Сайтов и их функционала на условиях, являющихся предметом настоящих Правил пользования Сайтом P1SKANOR. В этой связи, Вам необходимо внимательно ознакомиться с условиями настоящих Правил, которые рассматриваются Администрацией Сайта как публичная оферта в соответствии со ст. 437 Гражданского кодекса Российской Федерации."
      ]
    }, {
      cardNum: 3,
      title: "Выбирая нас вы получаете ряд преимуществ:",
      body: [
        "Надежные поставщики: Мы тщательно отбираем и проверяем поставщиков услуг, чтобы обеспечить их надежность и соответствие высоким стандартам качества. Вы сможете выбрать наиболее подходящие именно для ваших потребностей и предпочтений."
      ]
    }, {
      cardNum: 4,
      title: "Можно почитать все отзывы",
      body: [
        "Добро пожаловать на наш сайт, где вы можете ознакомиться с отзывами наших клиентов! У нас собраны разнообразные отзывы, охватывающие различные услуги поставщиков. Чтение отзывов может помочь вам получить полезную информацию о наших услугах и узнать мнения людей. Мы ценим ваше время и стремимся предоставить вам максимально полезную информацию. Мы приглашаем вас прочитать все отзывы, чтобы получить более полное представление о нашей компании. Надеемся, что вы найдете ответы на свои вопросы и убедитесь в нашей надежности и профессионализме. Благодарим вас за выбор нашего сайта и надеемся на долгосрочное партнерство!"
      ]
    }
  ];

  const createCards = () => {
    cardsData.forEach((item) => {
      const card = document.createElement("div");
      card.classList.add("card", `card-${item.cardNum}`);

      const h2 = document.createElement("h2");
      h2.innerText = item.title;
      card.appendChild(h2);

      if (item.list) {
        const ul = document.createElement("ul");

        item.list.forEach((listItem) => {
          const li = document.createElement("li");
          const a = document.createElement("a");
          a.href = listItem.link;
          a.target = "blank";
          a.innerText = listItem.text;
          li.appendChild(a);
          ul.appendChild(li);
        });

        card.appendChild(ul);
      }

      item.body.forEach((bodyText) => {
        const p = document.createElement("p");
        p.innerText = bodyText;
        card.appendChild(p);
      });

      post.appendChild(card);
    });
  };

  createCards();

  // Add post to the container
  container.appendChild(post);
</script>
</body>
</html>
