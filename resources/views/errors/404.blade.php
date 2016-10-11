<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Страница не найдена</title>
  <style>
    #fof{display:block; position:relative; width:960px; height:578px; background:url("/img/404.png") top left no-repeat; border-bottom:2px solid #000000; line-height:1.6em; text-align:center;}
    #fof .positioned{display:block; position:absolute; top:300px; right:0; width:448px; height:250px;}
    #fof .hgroup{margin-bottom:50px;}
    #fof .hgroup h1{}
    #fof .hgroup h2{}
    #fof img{margin-bottom:25px;}
    #fof p{display:block; margin:0 0 25px 0; padding:0; font-size:16px;}
    #fof #respond input{width:200px; padding:5px; border:1px solid #CCCCCC;}
    #fof #respond #submit{width:auto;}
  </style>
</head>
<body>
  <div class="wrapper row2">
    <div id="container" class="clear">
      <section id="fof" class="clear">
        <div class="positioned">
          <div class="hgroup">
            <h1>404 Ошибка</h1>
            <h2>DOH! Страница не найдена :(</h2>
          </div>
          <p>Запрашиваемая страницы не существует на сервере&hellip;</p>
          <div id="respond">
            <form action="{{ route('post.search') }}">
              <fieldset>
                <legend>Site Search</legend>
                <input type="text" name="search" placeholder="Search here">
                <input type="submit" id="submit" value="Search">
              </fieldset>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
</html>