# Interleaved Sidebars

Adding sidebars in WordPress to other sidebars with the function **interleaved_sidebars( $sidebar_indexes, $additional_sidebar_indexes, $insert_situation )**.
 
This is a perfect helper if you are bored to add the same sidebar widgets several times.
 
###Example
 
 ``` php
 <?php
 
 require_once( 'interleaved-sidebars.php');
 
 // Adding 'home' sidebar to sidebars 'page', 'post' and 'category before sidebars
 interleave_sidebars( array( 'home' ), array( 'page', 'post', 'category' ), 'before' ).
 
 ?>
 ```