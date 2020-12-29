<?php 

function is_logged_in()
{
	$ci = get_instance();

	if(!$ci->session->userdata('username')) {
		redirect('administrador/auth');
	} else {
		$role_id = $ci->session->userdata('role_id');
		$base_url = current_url();
		$url = str_replace(base_url(), "", $base_url);

		$queryMenu = $ci->db->get_where('submenu', [
		 	'url' => $url
		])->row_array();

		$menu_id = $queryMenu['menu_id'];
		$userAccess = $ci->db->get_where('user_access_menu', [
		 	'role_id' => $role_id,
		 	'menu_id' => $menu_id
		]);

		if($userAccess->num_rows() < 1) {
		 	redirect('administrador/auth/blocked');
		}
	}
}

function is_admin()
{
	$ci = get_instance();
	if($ci->session->userdata('role_id') != 1) {
		redirect('administrador/user');
	}
}

function is_user()
{
	$ci = get_instance();
	if($ci->session->userdata('role_id') != 3) {
		redirect('administrador/user');
	}
}

function is_auth()
{
	$ci = get_instance();
	if(!$ci->session->userdata('username')) {
		redirect('administrador');
	}
}

function check_access($role_id, $menu_id) 
{
	$ci = get_instance();

	$ci->db->where('role_id', $role_id);
	$ci->db->where('menu_id', $menu_id);
	$result = $ci->db->get('user_access_menu');

	if($result->num_rows() > 0) :
		return 'checked="checked"';
	endif;
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agt',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	);
	$pecahkan = explode('-', $tanggal);
 
	return substr($pecahkan[2], 0, 2) . ' ' . $bulan[(int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
 
function random($panjang_karakter)   
{   
	$karakter = '1234567890';

	$string = '';   
	for($i = 0; $i < $panjang_karakter; $i++) {   
		$pos = rand(0, strlen($karakter)-1);   
		$string .= $pos;   
	}   

	return $string;   
}   


?>