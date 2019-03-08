<?php
/**
 * Classic Editor
 *
 * Plugin Name: Demo-customfield plugin

 */
//CUSTOM POST TYPE
add_action('init','khoavu_hotel_post_type');

//globals variable



function khoavu_hotel_post_type()
{
    $post_type = 'hotel';
    $domain = 'khoavu';
    $args = [
        'labels' => [
            'name' => __( 'Hotel', $domain ),
            'singular_name' => __( 'Hotel', $domain )
        ],
        'public' => true
    ];

    register_post_type( $post_type , $args );
}

add_action('init','resort_post_type');

function resort_post_type()
{
    $post_type = 'resort';
    $domain = 'kv';
    $args = [
        'labels' => [
            'name' => __( 'Resort', $domain ),
            'singular_name' => __( 'Resort', $domain )
        ],
        'public' => true
    ];

    register_post_type( $post_type , $args );
}






//CUSTOM META BOX

// function hotel_meta_box(){
// 	add_meta_box('thong-tin-phong','Thông tin phòng','room_out_put','post');
// }

// add_action('add_meta_box','hotel_meta_box');

// function room_out_put(){
// 	echo 'Đây là thông tin trong room output: ';
// }



function adding_custom_meta_boxes( $post ) {
    add_meta_box( 
        'my-meta-box',
        __( 'Thông tin phòng' ),
        'render_my_meta_box',
        'resort',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'adding_custom_meta_boxes' );



function render_my_meta_box($post_id){
	$get_sophong=get_post_meta($post_id->ID,'so_phong',true);
	$get_tienphong=get_post_meta($post_id->ID,'tien_phong',true);
	$get_tang=get_post_meta($post_id->ID,'tang',true);
	$get_loaiphong=get_post_meta($post_id->ID,'loaiphong',true);
	
	$get_pets = get_post_meta($post_id->ID,'pets_json',true);
	$get_json_decode_pets = json_decode($get_pets);
	$count = count($get_json_decode_pets);
	//print_r($get_json_decode_pets);



	


//Input
	echo '<h1>Số phòng</h1>';
	echo '<input type="text" name="so_phong" value='.$get_sophong.'>';
	echo '<h1>Tiền phòng</h1>';
	echo '<input type="text" name="tien_phong" value='.$get_tienphong.'>';
	echo '<h1>Tầng</h1>';
	echo '<input type="text" name="tang" value='.$get_tang.'>';

//Selected box loại phòng
	echo '<h1>Loại phòng</h1>';
	echo '<select name="loaiphong">';
			$arr=array('vip'=>'VIP','medium'=>'MEDIUM','low'=>'LOW');
			foreach($arr as $key=>$val){
				if($val==$get_loaiphong){
					echo '<option selected name="'.$key.'">'.$val.'</option>';	
				}else
				echo '<option name="'.$key.'">'.$val.'</option>';
			}
	echo '</select>';



	$arr_checkbox=array('Chó','Mèo','Chim');
	for($i=0;$i<count($arr_checkbox);$i++)
	{	
		if(in_array($arr_checkbox[$i] , $get_json_decode_pets)){
			echo '<h1><input type="checkbox" name="pets[]" value="'.$arr_checkbox[$i].'" checked>'.$arr_checkbox[$i].'</h1>';
		}
		else{
			echo '<h1><input type="checkbox" name="pets[]" value="'.$arr_checkbox[$i].'">'.$arr_checkbox[$i].'</h1>';
		}
	}
	

//Check box chó mèo

	// if(!empty($get_pets_0) && !empty($get_pets_1)){
	// 	echo '<h1><input type="checkbox" name="pets[]" value="dog" checked>Chó</h1><h1><input type="checkbox" name="pets[]" value="cat" checked>Mèo</h1>';		
	// }
	// else if(!empty($get_pets_0)){
	// 	if($get_pets_0=="dog"){
	// 		echo '<h1><input type="checkbox" name="pets[]" value="dog" checked>Chó</h1><h1><input type="checkbox" name="pets[]" value="cat">Mèo</h1>';
	// 	}else
	// 		echo '<h1><input type="checkbox" name="pets[]" value="dog">Chó</h1><h1><input type="checkbox" name="pets[]" value="cat" checked>Mèo</h1>';
	// }
	// else{
	// 	echo '<h1><input type="checkbox" name="pets[]" value="dog">Chó</h1><h1><input type="checkbox" name="pets[]" value="cat">Mèo</h1>';
	// }
	// for($i=0;$i<$count,&i++){
	// 	if(){

	// 	}
	// }







	echo '<h1>Đơn Đôi</h1>';
	echo '<form action=""><input type="radio" name="type_room" value"one">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="type_room" value"two"></form>';
	echo '<h1>Màu phòng</h1>';
	echo '<input type="color">'; 
	echo '<h1>Ngày đặt phòng</h1>';
	echo '<input type="date">';
	echo '<h1>Ngày trả phòng</h1>';
	echo '<input type="datetime-local">';
	echo '<h1>Email người nhận phòng</h1>';
	echo '<input type="email">';
	echo '<h1>Thông tin đính kèm</h1>';
	echo '<input type="file">';
	echo '<h1>Tháng thuê</h1>';
	echo '<input type="month">';
	echo '<h1>Tình trạng mới của phòng</h1>';
	echo '<input type="range">';
	echo '<h1>SĐT</h1><input type="tel">';




	






}

function save_meta_posts($post_id){
	$save_sophong=sanitize_text_field( $_POST['so_phong'] );
	$save_tienphong=sanitize_text_field( $_POST['tien_phong'] );
	$save_tang=sanitize_text_field( $_POST['tang'] );
	$save_loaiphong = sanitize_text_field( $_POST['loaiphong'] );
	
	$save_pets = $_POST['pets'];
	//$empty = "";
	// $N = count($save_pets);
	
	$save_json_pets = json_encode($save_pets,JSON_UNESCAPED_UNICODE);
	
	//print_r($save_json_pets);


	update_post_meta( $post_id, 'so_phong',$save_sophong );
	update_post_meta( $post_id, 'tien_phong',$save_tienphong );
	update_post_meta( $post_id, 'tang',$save_tang );
	update_post_meta( $post_id, 'loaiphong',$save_loaiphong );
	update_post_meta($post_id, 'pets_json',$save_json_pets);
	
	// if($N != 0 ){
	// 	for($i=0 ; $i<$N ; $i++){
	// 		if($N == 1){
	// 			update_post_meta( $post_id,'pets_'.$i,$save_pets[$i]);
	// 			update_post_meta( $post_id,'pets_'.($i+1),$empty);
	// 		}else{
	// 			update_post_meta( $post_id,'pets_'.$i,$save_pets[$i]);}
	// 	};
	// }else{
	// 	for($i=0;$i<=$N;$i++){
	// 		update_post_meta( $post_id,'pets_'.$i,$empty);
	// 		update_post_meta( $post_id,'pets_'.($i+1),$empty);}
	// }

	
	
	
}

add_action( 'save_post', 'save_meta_posts' );


?>
<!---->
<!--<div class="change_language">-->
<!--	<a id="JP" href="" style="color: #BB9D82">JP</a>-->
<!--	<a id="ENG" href="" style="color: #BB9D82">ENG</a>-->
<!--</div>-->