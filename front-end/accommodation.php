<?php
function accommodations_page_shortcode( $atts ) {
    return accommodations_page_display();
}

add_shortcode( 'hbook2_accommodations', 'accommodations_page_shortcode' );

function accommodations_page_display(){

  global $wpdb;



  $content = '';
  $url = $_SERVER['HTTP_HOST'];
  if(isset($_GET['h'])){
    $id=$_GET['h'];
    $accommodations_list = $wpdb->get_results("SELECT * FROM wp_hb2_accommodations WHERE id='$id'");

    echo "<h2>".$accommodations_list[0]->name."</h2>";
    echo $accommodations_list[0]->text;
  }else{
    $accommodations_list = $wpdb->get_results("SELECT * FROM wp_hb2_accommodations");
    $host = $_SERVER['HTTP_HOST'];

    foreach ($accommodations_list as $value) {
      echo "<h2><a href='$host/hbook-accommodations/?h=".$value->id."'> ".$value->name."</a></h2>";

    }
  }


  return $content;
}
 ?>
