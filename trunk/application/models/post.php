<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class post extends CI_Model {

	function beritaterkini($id='100000000000000000000000')
	{
		
		$query="select wp_posts.ID, wp_posts.post_date, wp_posts.post_title as title, wp_posts.post_content as content, wp_posts.guid, '' as tax, 0 as count
		from wp_posts	
		where wp_posts.post_status='publish' and wp_posts.post_type='post' and wp_posts.ID<".$id."
		order by wp_posts.ID desc
		limit 10";
		
		$post = $this -> db -> query($query);
		return $post -> result_array();
	}


	function selectPost() {
		$query = "select wp_posts.ID, wp_posts.post_date, wp_posts.post_content, wp_posts.post_title, wp_posts.guid, wp_terms.name, CONVERT(wp_postmeta.meta_value,UNSIGNED INTEGER) as count
		from wp_posts
		join wp_term_relationships on wp_posts.ID = wp_term_relationships.object_id
		join wp_term_taxonomy on wp_term_relationships.term_taxonomy_id= wp_term_taxonomy.term_taxonomy_id
		join wp_terms on wp_term_taxonomy.term_id=wp_terms.term_id
		join wp_postmeta on wp_posts.ID=wp_postmeta.post_id
		where wp_posts.post_status='publish' and wp_postmeta.meta_key='wpb_post_views_count' and wp_posts.post_type='post' and WEEKOFYEAR(NOW())=WEEKOFYEAR(wp_posts.post_date)
		GROUP BY wp_posts.ID
		order by  wp_posts.post_date desc
		limit 10";
		$post = $this -> db -> query($query);
		return $post -> result_array();
	}
	
	function selectPostMore($lastId=0) {
		$query = "select wp_posts.ID, wp_posts.post_date, wp_posts.post_content, wp_posts.post_title, wp_posts.guid, wp_terms.name, CONVERT(wp_postmeta.meta_value,UNSIGNED INTEGER) as count
		from wp_posts
		join wp_term_relationships on wp_posts.ID = wp_term_relationships.object_id
		join wp_term_taxonomy on wp_term_relationships.term_taxonomy_id= wp_term_taxonomy.term_taxonomy_id
		join wp_terms on wp_term_taxonomy.term_id=wp_terms.term_id
		join wp_postmeta on wp_posts.ID=wp_postmeta.post_id
		where wp_posts.post_status='publish' and wp_postmeta.meta_key='wpb_post_views_count' and wp_posts.post_type='post' and WEEKOFYEAR(NOW())=WEEKOFYEAR(wp_posts.post_date)
		GROUP BY wp_posts.ID
		order by  wp_posts.post_date desc
		limit 10";
		$post = $this -> db -> query($query);
		return $post -> result_array();
	}
	
	

	function populartag() {
		$query = '
		select wp_terms.term_id, wp_terms.slug, wp_term_taxonomy.count from wp_terms
		join wp_term_taxonomy on wp_terms.term_id= wp_term_taxonomy.term_id
		where wp_term_taxonomy.taxonomy="post_tag"
		order BY wp_term_taxonomy.count desc
		limit 10';

		$post = $this -> db -> query($query);
		return $post -> result_array();

	}

	function postbyidtag($id_tag = 21) {
		$query = "
		select wp_posts.ID, wp_posts.post_date, wp_posts.post_content, wp_posts.post_title, wp_posts.guid, wp_terms.name
		from wp_posts
		join wp_term_relationships on wp_posts.ID = wp_term_relationships.object_id
		join wp_term_taxonomy on wp_term_relationships.term_taxonomy_id= wp_term_taxonomy.term_taxonomy_id
		join wp_terms on wp_term_taxonomy.term_id=wp_terms.term_id
		where wp_posts.post_status='publish' and wp_terms.term_id=" . $id_tag . "	
		GROUP BY wp_posts.id
		order by wp_posts.post_date desc 
		limit 10";

		$post = $this -> db -> query($query);
		return $post -> result_array();

	}
	
	function popularpost() {
		$query = "
		select wp_posts.ID, wp_posts.post_date, wp_posts.post_content, wp_posts.post_title, wp_posts.guid, wp_terms.name, CONVERT(wp_postmeta.meta_value,UNSIGNED INTEGER) as count
		from wp_posts
		join wp_term_relationships on wp_posts.ID = wp_term_relationships.object_id
		join wp_term_taxonomy on wp_term_relationships.term_taxonomy_id= wp_term_taxonomy.term_taxonomy_id
		join wp_terms on wp_term_taxonomy.term_id=wp_terms.term_id
		join wp_postmeta on wp_posts.ID=wp_postmeta.post_id
		where wp_posts.post_status='publish' and wp_postmeta.meta_key='wpb_post_views_count' and wp_posts.post_type='post' and WEEKOFYEAR(NOW())=WEEKOFYEAR(wp_posts.post_date)
		GROUP BY wp_posts.ID
		order by meta_value desc
		limit 10";

		$post = $this -> db -> query($query);
		return $post -> result_array();

	}
	
	
	function getimagebyidpost($id=0) {
		$query = "
			select guid from wp_posts
	where wp_posts.post_parent=".$id." and wp_posts.post_mime_type='image/jpeg'";

		$post = $this -> db -> query($query);
		$rowcount = $post->num_rows();
		$result= $post -> result_array();
		if($rowcount>0)
		{
			return $result[0]['guid'];
		}else return '';
		
	}
	
	

}
?>
