<?php
function hotels_page_shortcode( $atts ) {
    return hotels_page_display();
}

add_shortcode( 'hbook2_hotels', 'hotels_page_shortcode' );

function hotels_page_display(){

  global $wpdb;



  $content = '';
  $url = $_SERVER['HTTP_HOST'];
  if(isset($_GET['h'])){
    $id=$_GET['h'];
    $hotels_list = $wpdb->get_results("SELECT * FROM wp_hb2_hotels WHERE id='$id'");
    if (!isset($hotels_list[0]))
    {echo "404"; break;}
    echo "<h2>".$hotels_list[0]->name."</h2>";
    
  }else{
    $hotels_list = $wpdb->get_results("SELECT * FROM wp_hb2_hotels");
    foreach ($hotels_list as $value) {

      $content.= <<< END

      <div style="width:100%; padding:5px 0;">
        {$value->id}. <a href="{$url}/hotels/?h={$value->id}" style="cursor:pointer;">{$value->name}</a> >
        {$value->country} > {$value->region} > {$value->town} > {$value->adress} > {$value->stars};
      </div>
END;
    }
  }


  return $content;
}
 ?>
