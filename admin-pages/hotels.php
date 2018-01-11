<?php

global $wpdb;



if(isset($_POST['Add'])) {
  $mm=$wpdb->insert(
    'wp_hb2_hotels',
    array( 'name' => $_POST['name'], 'country' => $_POST['country'], 'region' => $_POST['region'], 'town'=> $_POST['town'], 'adress'=> $_POST['adress'], 'stars'=>$_POST['stars']  ),
    array( '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
  );
}



if(isset($_POST['update'])) {
  $wpdb->update( 'wp_hb2_hotels',
    array( 'description' => $_POST['text']),
    array( 'id' => $_POST['db_id'] )
  );
}



if(isset($_POST['Edit'])) {
  print_r($_POST);
  $wpdb->update( 'wp_hb2_hotels',
    array( 'name' => $_POST['name'], 'region' => $_POST['region'], 'town' => $_POST['town'], 'adress' => $_POST['adress'], 'stars' => $_POST['stars'] ),
    array( 'id' => $_POST['db_id'] )
  );
}

$hotels_list = $wpdb->get_results("SELECT * FROM wp_hb2_hotels ORDER BY id LIMIT 10");
if(isset($_POST['Find'])) {
  $filt = "WHERE";
  $t = false;

  if($_POST['name']!="") {
    $filt.= " name = '".$_POST['name']."'";
    $t = true;
  }

  if($_POST['town']!="") {
    if($t) { $filt .= " AND "; }
    $filt.= "town = '".$_POST['town']."'";
    $t = true;
  }

  if($_POST['adress']!="") {
    if($t) { $filt .= " AND "; }
    $filt.= " adress = '".$_POST['adress']."'";
    $t = true;
  }

  if($_POST['stars']!="") {
    if($t) { $filt .= " AND "; }
    $filt.= " stars = '".$_POST['stars']."'";
  }

  if ($filt != "WHERE")
  $hotels_list = $wpdb->get_results("SELECT * FROM wp_hb2_hotels ".$filt." ORDER BY id LIMIT 10 ");
}

?>
<h1><?php esc_html_e( 'Меню добавления отелей', 'hbook-admin' ); ?></h1>



<div class="hbook_hotel_overlay" style="position:fixed; top:0; left:0; width:100%; height:100%;z-index:51;background:#000;opacity:0.2;display:none;">

</div>

<div class="hbook_hotel_this_edit_block" style="display:none;">
  <form  class="hbook_hotel_this_edit_form" name="hbook_hotel_this_edit_form" action="<?php the_permalink(); ?>" method="post">

    <label>Название отеля</label>
    <input type="text" name="name" value="" placeholder="Название" />
    <br />

    <label>Страна</label>
    <select name="country">
      <option disabled>Выберите страну</option>
      <option selected value="Италия">Италия</option>
    </select>
    <br />

    <label>Регион</label>
    <select name="region">
      <option disabled>Выберите регион</option>
      <option value="Абруцци">Абруцци</option>
      <option value="Валле-д’Аоста">Валле-д’Аоста</option>
      <option value="Апулия">Апулия</option>
      <option value="Базиликата">Базиликата</option>
      <option value="Калабрия">Калабрия</option>
      <option value="Кампания">Кампания</option>
      <option value="Эмилия-Романья">Эмилия-Романья</option>
      <option value="Фриули-Венеция-Джулия">Фриули-Венеция-Джулия</option>
      <option value="Лацио">Лацио</option>
      <option value="Лигурия">Лигурия</option>
      <option value="Ломбардия">Ломбардия</option>
      <option value="Марке">Марке</option>
      <option value="Молизе">Молизе</option>
      <option value="Пьемонт">Пьемонт</option>
      <option value="Сардиния">Сардиния</option>
      <option value="Сицилия">Сицилия</option>
      <option value="Трентино-Альто-Адидже">Трентино-Альто-Адидже</option>
      <option value="Тоскана">Тоскана</option>
      <option value="Умбрия">Умбрия</option>
      <option value="Венеция">Венеция</option>
    </select>
    <br />

    <label>Город</label>
    <input type="text" name="town" value="" placeholder="Город" />
    <br />

    <label>Адрес</label>
    <input type="text" name="adress" value="" placeholder="Адрес" />
    <br />

    <label>Кол-во звезд</label>
    <select name="stars">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <br />
    <input type="hidden" id="yy" name="" value="">
    <input type="submit" name="Edit" value="Edit" />
  </form>
</div>

<a class="hbook_hotel_add_href" style="cursor:pointer;">Добавить отель</a>
<form action="" name="hbook_hotel_add_form" class="hbook_hotel_add_form" style="display:none" action="<?php the_permalink(); ?>" method="post">
  <label>Название отеля</label>
  <input type="text" name="name" value="" placeholder="Название" />
  <br />

  <label>Страна</label>
  <select name="country">
    <option disabled>Выберите страну</option>
    <option selected value="Италия">Италия</option>
  </select>
  <br />

  <label>Регион</label>
  <select name="region">
    <option disabled>Выберите регион</option>
    <option value="Абруцци">Абруцци</option>
    <option value="Валле-д’Аоста">Валле-д’Аоста</option>
    <option value="Апулия">Апулия</option>
    <option value="Базиликата">Базиликата</option>
    <option value="Калабрия">Калабрия</option>
    <option value="Кампания">Кампания</option>
    <option value="Эмилия-Романья">Эмилия-Романья</option>
    <option value="Фриули-Венеция-Джулия">Фриули-Венеция-Джулия</option>
    <option value="Лацио">Лацио</option>
    <option value="Лигурия">Лигурия</option>
    <option value="Ломбардия">Ломбардия</option>
    <option value="Марке">Марке</option>
    <option value="Молизе">Молизе</option>
    <option value="Пьемонт">Пьемонт</option>
    <option value="Сардиния">Сардиния</option>
    <option value="Сицилия">Сицилия</option>
    <option value="Трентино-Альто-Адидже">Трентино-Альто-Адидже</option>
    <option value="Тоскана">Тоскана</option>
    <option value="Умбрия">Умбрия</option>
    <option value="Венеция">Венеция</option>
  </select>
  <br />

  <label>Город</label>
  <input type="text" name="town" value="" placeholder="Город" />
  <br />

  <label>Адрес</label>
  <input type="text" name="adress" value="" placeholder="Адрес" />
  <br />

  <label>Кол-во звезд</label>
  <select name="stars">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
  <br />

  <input type="submit" name="Add" value="Add" />
</form>



<br /> <br />
<a class="hbook_hotel_filter_href" style="cursor:pointer;" >Фильтр</a>
<form  class="hbook_hotel_filter_form" name="hbook_hotel_filter_form" style="display:none;" action="<?php the_permalink(); ?>" method="post">

  <label>Название отеля</label>
  <input type="text" name="name" value="" placeholder="Название" />
  <br />

  <label>Страна</label>
  <select name="country">
    <option disabled>Выберите страну</option>
    <option selected value="Италия">Италия</option>
  </select>
  <br />

  <label>Регион</label>
  <select name="region">
    <option disabled>Выберите регион</option>
    <option value="Италия северная">Италия северная</option>
    <option value="Италия южная">Италия южная</option>
  </select>
  <br />

  <label>Город</label>
  <input type="text" name="town" value="" placeholder="Город" />
  <br />

  <label>Адрес</label>
  <input type="text" name="adress" value="" placeholder="Адрес" />
  <br />

  <label>Кол-во звезд</label>
  <select name="stars">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
  <br />

  <input type="submit" name="Find" value="Find" />
</form>

<h3>Список отлей</h3>
<?php

foreach ($hotels_list as $value) {
echo '<div style="width:100%; padding:5px 0;">'.$value->id.'. <a href="http://calc.idea-relax.it/hotels/?h='.$value->id.'">'.$value->name.'</a> > '.$value->country.' > '.$value->region.' > '.$value->town.' > '.$value->adress.' > '.$value->stars;
?>
<a style="cursor:pointer; float:right; margin: 0 15px;" class="hbook_hotel_this_addcont_href">Добавить/смотреть описание и фото</a>
<a id="<?php echo $value->id; ?>" style="cursor:pointer; float:right; margin: 0 15px;" class="hbook_hotel_this_edit_href">Редактировать</a>
<div class="hbook_hotel_this_edit_block" style="display:none;">
<form  class="hbook_hotel_this_edit_form" name="hbook_hotel_this_edit_form" action="<?php the_permalink(); ?>" method="post">

  <label>Название отеля</label>
  <input type="text" name="name" value="<?php echo $value->name; ?>" placeholder="Название" />
  <br />

  <label>Страна</label>
  <select name="country">
    <option disabled>Выберите страну</option>
    <option selected value="Италия">Италия</option>
  </select>
  <br />

  <label>Регион</label>
  <select name="region">
    <option disabled>Выберите регион</option>
    <option <?php if($value->region=='Абруцци'){echo 'selected '; } ?>value="Абруцци">Абруцци</option>
    <option <?php if($value->region=='Валле-д’Аоста'){echo 'selected '; } ?>value="Валле-д’Аоста">Валле-д’Аоста</option>
    <option <?php if($value->region=='Апулия'){echo 'selected '; } ?>value="Апулия">Апулия</option>
    <option <?php if($value->region=='Базиликата'){echo 'selected '; } ?>value="Базиликата">Базиликата</option>
    <option <?php if($value->region=='Калабрия'){echo 'selected '; } ?>value="Калабрия">Калабрия</option>
    <option <?php if($value->region=='Кампания'){echo 'selected '; } ?>value="Кампания">Кампания</option>
    <option <?php if($value->region=='Эмилия-Романья'){echo 'selected '; } ?>value="Эмилия-Романья">Эмилия-Романья</option>
    <option <?php if($value->region=='Фриули-Венеция-Джулия'){echo 'selected '; } ?>value="Фриули-Венеция-Джулия">Фриули-Венеция-Джулия</option>
    <option <?php if($value->region=='Лацио'){echo 'selected '; } ?>value="Лацио">Лацио</option>
    <option <?php if($value->region=='Лигурия'){echo 'selected '; } ?>value="Лигурия">Лигурия</option>
    <option <?php if($value->region=='Ломбардия'){echo 'selected '; } ?>value="Ломбардия">Ломбардия</option>
    <option <?php if($value->region=='Марке'){echo 'selected '; } ?>value="Марке">Марке</option>
    <option <?php if($value->region=='Молизе'){echo 'selected '; } ?>value="Молизе">Молизе</option>
    <option <?php if($value->region=='Пьемонт'){echo 'selected '; } ?>value="Пьемонт">Пьемонт</option>
    <option <?php if($value->region=='Сардиния'){echo 'selected '; } ?>value="Сардиния">Сардиния</option>
    <option <?php if($value->region=='Сицилия'){echo 'selected '; } ?>value="Сицилия">Сицилия</option>
    <option <?php if($value->region=='Трентино-Альто-Адидже'){echo 'selected '; } ?>value="Трентино-Альто-Адидже">Трентино-Альто-Адидже</option>
    <option <?php if($value->region=='Тоскана'){echo 'selected '; } ?>value="Тоскана">Тоскана</option>
    <option <?php if($value->region=='Умбрия'){echo 'selected '; } ?>value="Умбрия">Умбрия</option>
    <option <?php if($value->region=='Венеция'){echo 'selected '; } ?>value="Венеция">Венеция</option>
  </select>
  <br />

  <label>Город</label>
  <input type="text" name="town" value="<?php echo $value->town; ?>" placeholder="Город" />
  <br />

  <label>Адрес</label>
  <input type="text" name="adress" value="<?php echo $value->adress; ?>" placeholder="Адрес" />
  <br />

  <label>Кол-во звезд</label>
  <select name="stars">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>

  <br />
  <input type="hidden" id="yy" name="db_id" value="<?php echo $value->id; ?>">

  <input type="submit" name="Edit" value="Edit" />
</form>
</div>

<div style="position:absolute; margin: 15px 15px; width:90%; height:600px;text-align:center; z-index:52;background:#fff; border: 1px solid #000;display:none;" class="hbook_hotel_filtres_addcont_block">
<div style="position:absolute; top:10px; right:15px; font-size:20px;cursor:pointer;" class="hbook_hotel_filtres_addcont_block_close_href">
  x
</div>
<form method="post" style="margin: 25px; width:90%; height:90%;" action="<?php the_permalink(); ?>">
  <?php wp_editor( $value->description, 'wpeditor', array('textarea_name' => 'text') ); ?>
  <input type="hidden" id="yy" name="db_id" value="<?php echo $value->id; ?>">
  <input type="submit" name="update" value="Обновить" />
</form>
</div>
</div>
<?php

}

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript" language="javascript">

$(".hbook_hotel_add_href").click(function () {
  $(".hbook_hotel_add_form").slideToggle();
});

$(".hbook_hotel_filter_href").click(function () {
  $(".hbook_hotel_filter_form").slideToggle();
});

$(".hbook_hotel_this_addcont_href").click(function () {
  $(this).parent().find(".hbook_hotel_filtres_addcont_block").show(100);
  $(".hbook_hotel_overlay").show();
});

$(".hbook_hotel_filtres_addcont_block_close_href").click(function () {
  $(".hbook_hotel_filtres_addcont_block").hide(100);
  $(".hbook_hotel_overlay").hide();
});

$(".hbook_hotel_overlay").click(function () {
  $(".hbook_hotel_filtres_addcont_block").hide(100);
  $(".hbook_hotel_overlay").hide();
});

$(".hbook_hotel_this_edit_href").click(function () {
  $(".hbook_hotel_this_edit_block").hide();
  $(this).next().show();
});

</script>
