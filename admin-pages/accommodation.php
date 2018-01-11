<?php

global $wpdb;
if(isset($_POST['Add'])) {

  $fees=0;
  if(isset($_POST['fees1'])) $fees=1;
  if(isset($_POST['fees2'])) $fees=2;
  if(isset($_POST['fees3'])) $fees=3;
  
  $mm=$wpdb->insert(
    'wp_hb2_accommodations',
    array( 'name' => $_POST['name'], 'text' => $_POST['text'], 'search_text' => $_POST['search_text'],
            'hotel' => $_POST['hotel'], 'normal_occupancy' => $_POST['normal_occupancy'],
            'max_occupancy' => $_POST['max_occupancy'], 'starting_price' => $_POST['starting_price'],
            'percent_hotel' => $_POST['percent_hotel'], 'percent_client' => $_POST['percent_client'],
            'fees' => $fees
    )
  );
}


if(isset($_POST['Edit'])) {
  $wpdb->update( 'wp_hb2_accommodations',
    array( 'name' => $_POST['name'], 'text' => $_POST['text'], 'hotel' => $_POST['hotel']),
    array( 'id' => $_GET['id'] )
  );
}


$hotels_list = $wpdb->get_results("SELECT id , name FROM wp_hb2_hotels ORDER BY id");

if ($_GET['act']=='add') {
?>
    <a href="admin.php?page=hbook2_accommodation"> <<<назад </a>
    <form class="hb_form_accomm_add" action="<?php the_permalink(); ?>" method="post">
    Название<input type="text" name="name" value="" /> <br />
    Отель<select class="" name="hotel">

      <?php
      foreach ($hotels_list as $value) {
        echo "<option value='{$value->name}'>{$value->name}</option>";
      }
       ?>

    </select><br />
    B&B <input type="checkbox" name="fees1" value="1">
    HB <input type="checkbox" name="fees2" value="1">
    FB <input type="checkbox" name="fees3" value="1"><br />
    Процент комиссии от отеля,% <input type="text" name="percent_hotel" value=""><br />
    Процент комиссии дял клиента <input type="text" name="percent_client" value=""><br />
    Normal occupancy <input type="text" name="normal_occupancy" value="" ><br />
    Max occupancy <input type="text" name="max_occupancy" value=""><br />
    Min occupancy <input type="text" name="min_occupancy" value=""><br />
    Описание <?php wp_editor( '', 'wpeditor', array('textarea_name' => 'text') ); ?>
    Описание для поиска <input type="text" name="search_text" value=""><br />
    Starting price <input type="text" name="starting_price" value=""><br />

    <input type="submit" name="Add" value="Add" />
  </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript">
    $('input[type="checkbox"]').on('change', function() {
     $('input[type="checkbox"]').not(this).prop('checked', false);
    });
  </script>


<?php
} else if ($_GET['act']=='edit'){
  $db_id=$_GET['id'];
  $accommodation_list = $wpdb->get_results("SELECT * FROM wp_hb2_accommodations WHERE id='$db_id' ");

  ?>

        <a href="admin.php?page=hbook2_accommodation"> <<<назад </a>

        <form class="hb_form_accomm_add" action="<?php the_permalink(); ?>" method="post">
          Название<input type="text" name="name" value="<?php echo $accommodation_list[0]->name; ?>" /> <br />
          Отель<select class="" name="hotel">
            <?php
            foreach ($hotels_list as $value) {
              if ($accommodation_list[0]->hotel==$value->name)
                $r='selected ';
              else $r='';
              echo "<option {$r} value='{$value->name}'>{$value->name}</option>";
            }
             ?>

          </select> <br />
          Описание <?php wp_editor( $accommodation_list[0]->text, 'wpeditor', array('textarea_name' => 'text') ); ?>

          <input type="submit" name="Edit" value="Edit" />

        </form>



  <?php

} else {
if ($_GET['act']=='del'){
  $id = $_GET['id'];
  $wpdb->query("DELETE FROM wp_hb2_accommodations WHERE id = '$id' ");
}
$accommodation_list = $wpdb->get_results("SELECT * FROM wp_hb2_accommodations ORDER BY id");

?>


<h1><?php esc_html_e( 'Accommodations', 'hbook-admin' ); ?></h1>

<form id="posts-filter" method="get">


<div class="alignleft actions bulkactions">
  <a href="admin.php?page=hbook2_accommodation&act=add" class="button">Добавить новую</a>
  <select id="country" name="">
    <option value="Италия">Италия</option>
  </select>
  <select id="region" name="">
    <option value="0">Выберите регион</option>
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

  <select id="hotel" name="">
    <option value="0">Выберите отель</option>
    <?php
      foreach ($hotels_list as $value) {
        echo "<option value='{$value->name}'>{$value->name}</option>";
      }
     ?>
  </select>

  <select id="stars" name="">
    <option value="0">Выберите кол-во звезд</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  <!--
  <label for="bulk-action-selector-top" class="screen-reader-text">Выберите массовое действие</label>
  <select name="action" id="bulk-action-selector-top">
    <option value="-1">Действия</option>
    <option value="trash">Удалить</option>
  </select>
-->
</div>





<table class="list-table" style="width:100%;">
  <thead>
  <tr>
    <th>
      <input id="cb-select-all-1" type="checkbox">
    </th>
    <th>
        <span>Заголовок</span>
    </th>
    <th>
        <span>Отель</span>
    </th>
    <th>
        <span>Страна</span>
    </th>
    <th>
        <span>Регион</span>
    </th>
    <th>
        <span>Адрес</span>
    </th>
    <th>
        <span>Звезды</span>
    </th>
  </tr>
  </thead>

  <tbody>
<?php foreach ($accommodation_list as $value) {

$hotels_list = $wpdb->get_results("SELECT * FROM wp_hb2_hotels WHERE name='$value->hotel'");
?>
    <tr id="post-25" style="text-align:center">
      <td>
        <input id="<?php echo $value->id ?>" type="checkbox" name="db_id" value="<?php echo $value->id ?>">
      </td>

      <td>
        <strong><a class="row-title" href="" > <?php echo $value->name ?> </a></strong>
        <div class="row-actions">
          <span class="edit"><a href="admin.php?page=hbook2_accommodation&act=edit&id=<?php echo $value->id ?>">Изменить</a> | </span>
          <span class="trash"><a href="admin.php?page=hbook2_accommodation&act=del&id=<?php echo $value->id ?>" class="submitdelete">Удалить</a> | </span>
          <span class="view"><a href="http://calc.idea-relax.it/hbook-accommodations/?h=<?php echo $value->id; ?>" rel="permalink" aria-label="Посмотреть «Mioni Pezzato [standart room]»">Перейти</a></span>
        </div>
      </td>
      <td>
        <?php echo $value->hotel ?>
      </td>
      <td>
        <?php echo $hotels_list[0]->country ?>
      </td>
      <td>
        <?php echo $hotels_list[0]->region ?>
      </td>
      <td>
        <?php echo $hotels_list[0]->adress ?>
      </td>
      <td>
        <?php echo $hotels_list[0]->stars ?>
      </td>
      <!--<td class="date column-date" data-colname="Дата">
        <abbr title="21.07.2017 19:02:54">??.07.2017</abbr>
      </td> -->
    </tr>
<?php } ?>
  </tbody>


</table>


</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" language="javascript">
    $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {
        var country = $('#country').val();
        var region = $('#region').val();
        var hotel = $('#hotel').val();
        var adress = $('#adress').val();
        var stars = $('#stars').val();
        var region_t4 = data[4] || 0;
        var hotel_t2 = data[2] || 0;
        var stars_t6 = data[6] || 0;

        if ( ( region==region_t4 || region=="0")
            && ( hotel==hotel_t2 || hotel=="0" )
            && ( stars == stars_t6 || stars=="0")
          )
        {
            return true;
        }
        return false;
    }
  );
  $(document).ready( function () {
      var table = $('.list-table').DataTable();

      $('#country, #region, #hotel,#stars').change( function() {
          table.draw();
      } );
  } );

</script>

<?php }

?>
