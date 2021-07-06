<?php

add_action('admin_menu', 'my_admin_menu');
 
function my_admin_menu() {
	add_menu_page('Manage Members', 'Members', 1, 'manage_members.php', 'manage_members_function', 'dashicons-admin-users', '5');

	function manage_members_function() {	
?>
		
		<div class="wrap">
			<div class="m_head">
				<h2><?= get_admin_page_title() ?></h2>
				<ul class="m_head-nav">
					<li><a href="/wp-admin/admin.php?page=manage_members.php">Все пользователи</a></li>
					<li><a href="#">Заявки на регистрацию</a></li>
				</ul>
			</div>
 <?php 

 $count_args  = array(
    'role'      => 'Subscriber',
    'fields'    => 'all_with_meta',
    'number'    => 999999      
);
$user_count_query = new WP_User_Query($count_args);
$user_count = $user_count_query->get_results();

// count the number of users found in the query
$total_users = $user_count ? count($user_count) : 1;

// grab the current page number and set to 1 if no page number is set
$page = isset($_GET['p']) ? $_GET['p'] : 1;

// how many users to show per page
$users_per_page = 10;

// calculate the total number of pages.
$total_pages = 1;
$offset = $users_per_page * ($page - 1);
$total_pages = ceil($total_users / $users_per_page);


// main user query
$args  = array(
    // search only for Authors role
    'role'      => 'Subscriber',
    // order results by display_name
    'orderby'   => 'display_name',
    // return all fields
    'fields'    => 'all_with_meta',
    'number'    => $users_per_page,
    'offset'    => $offset // skip the number of users that we have per page  
);

// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);

// Get the results
$authors = $wp_user_query->get_results();

// check to see if we have users
if (!empty($authors))
{
    echo '<div class="m_ulist">';
    // loop trough each author
    foreach ($authors as $author)
    {
        $author_info = get_userdata($author->ID);
        $user_id = $author->ID; ?>

        <div class="m_ulist-item" id="m_ulist-item-<?= $user_id ?>">
			<input type="checkbox" class="m_ulist-item--check" name="ulist" id="ulist_<?= $user_id ?>">
			<label for="ulist_<?= $user_id ?>" class="m_ulist-item--username"><span><?= $author_info->user_login; ?></span></label>
			<span class="m_ulist-item--email"><?= $author_info->user_email; ?></span>
			<a href="?page=manage_members.php&?manage_user=<?= $user_id ?>">edit</a>
		</div>

    <?php 
    }
    echo '</div>';
} else {
    echo 'No authors found';
}

// grab the current query parameters
$query_string = $_SERVER['QUERY_STRING'];

// The $base variable stores the complete URL to our page, including the current page arg

// if in the admin, your base should be the admin URL + your page
$base = admin_url('/admin.php') . '?' . remove_query_arg('p', $query_string) . '%_%';

// if on the front end, your base is the current page
//$base = get_permalink( get_the_ID() ) . '?' . remove_query_arg('p', $query_string) . '%_%';
echo '<ul class="pagination">';
echo paginate_links( array(
    'base' => $base, // the base URL, including query arg
    'format' => '&p=%#%', // this defines the query parameter that will be used, in this case "p"
    'prev_text' => __('&laquo;'), // text for previous page
    'next_text' => __('&raquo;'), // text for next page
    'total' => $total_pages, // the total number of pages we have
    'current' => $page, // the current page
    'end_size' => 1,
    'mid_size' => 5,
));
echo '</ul>';
?>

		</div>

		<?php
	}
}

?>

<style>

.pagination {
	display: flex;
	flex-direction: row;
}

.pagination .page-numbers {
	display: flex;
	justify-content: center;
	align-items: center;
	width: 30px;
	height: 25px;
	margin-right: 3px;
	background: #fff;
	border: 1px solid #ebebeb;
	border-radius: 4px;
	font-size: 12px;
	color: #333;
	text-decoration: none;
	box-shadow: 2px 2px 7px rgba(0,0,0,0.05);
}

.pagination .page-numbers.current {
	box-shadow: 2px 2px 7px rgba(0,0,0,0.0);
	background: #f4f4f4;
	font-weight: 600;
}

.m_head {
	margin: -17px 0 0 -22px;
	background: #fff;
	width: 100%;
	padding: 18px 20px 10px;
	box-shadow: 0px 10px 15px rgba(0,0,0,0.04);
}
	
.m_head-nav {
	display: flex;
	flex-direction: row;
}

.m_head-nav li {
	padding: 7px;
}

.m_head-nav li:first-child {
	padding-left: 0px;
}

.m_head-nav li:last-child {
	padding-right: 0px;
}

.m_head-nav li a {
	padding: 8px 15px;
	background: #df1e26;
	color: #fff;
	text-decoration: none;
	border-radius: 4px;
	font-size: 12px;
	font-weight: 300;
	box-shadow: 2px 4px 5px rgba(0, 0, 0, 0.11);
	transition: .2s;
}

.m_head-nav li a:hover {
	background: #ec1922;
	box-shadow: 2px 4px 7px rgba(0, 0, 0, 0.15);
}

.m_ulist {
	display: flex;
	flex-direction: column;
	padding: 25px 0;
}

.m_ulist-item {
	margin-bottom: 10px;
	padding: 0 15px;
	height: 42px;
	background: #fff;
	border-radius: 4px;
	box-shadow: 2px 2px 8px rgba(0,0,0,0.05);
	display: flex;
	align-items: center;
	transition: .2s;
}

.m_ulist-item:hover {
	box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
}

.m_ulist-item:last-child {
	margin-bottom: 0;
}

.m_ulist-item--check {
	margin: 0 !important;
}

.m_ulist-item--username {
	width: 100px;
	overflow: hidden;
	padding-left: 10px;
	font-size: 12px;
	font-weight: 600;
	white-space: nowrap;
	position: relative;
}

.m_ulist-item--username:after {
	content: '';
}

.m_ulist-item--email {
	padding-left: 15px;
}

</style>