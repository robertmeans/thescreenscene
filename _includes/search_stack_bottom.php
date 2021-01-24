<?php
switch ($layout_context) {
	case 'home-private' 	:	require '_includes/search_stack_bottom_member.php'; 	break;
	case 'homepage' 	:	require '_includes/search_stack_bottom_member.php'; 	break;
	case 'delete_project' 	:	require '_includes/search_stack_bottom_member.php'; 	break;
	case 'edit_order' 		:	require '_includes/search_stack_bottom_member.php'; 	break;
	case 'edit_searches' 	:	require '_includes/search_stack_bottom_member.php'; 	break;
	case 'edit_content' 	:	require '_includes/search_stack_bottom_member.php'; 	break;
	case 'projects' 		:	require '_includes/search_stack_bottom_member.php'; 	break;
	case 'project-view' 	:	require '_includes/search_stack_bottom_member.php'; 	break;
	case 'home-public' 		:	require '_includes/search_stack_bottom_static.php'; 	break;
	default 				:	require '_includes/search_stack_bottom_static.php'; 	break;
}
?>