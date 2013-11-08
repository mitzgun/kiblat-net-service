<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class post extends CI_Model {

    function selectPost(){
        $query = "
 SELECT
        p1.*,
        wm2.meta_value
    FROM 
        wp_posts p1
    LEFT JOIN 
        wp_postmeta wm1
        ON (
            wm1.post_id = p1.id 
            AND wm1.meta_value IS NOT NULL
            AND wm1.meta_key = '_thumbnail_id'              
        )
    LEFT JOIN 
        wp_postmeta wm2
        ON (
            wm1.meta_value = wm2.post_id
            AND wm2.meta_key = '_wp_attached_file'
            AND wm2.meta_value IS NOT NULL  
        )
    WHERE
        p1.post_status='publish'
        AND p1.post_type='post'
    ORDER BY 
        p1.post_date DESC LIMIT 1";
        $post = $this->db->query($query);
        return $post->result_array();
    }
	
	function populartag()
	{
		$query = '
		select wp_terms.term_id, wp_terms.slug, wp_term_taxonomy.count from wp_terms
		join wp_term_taxonomy on wp_terms.term_id= wp_term_taxonomy.term_id
		where wp_term_taxonomy.taxonomy="post_tag"
		order BY wp_term_taxonomy.count desc
		limit 10';
		
		$post = $this->db->query($query);
        return $post->result_array();
		
	}
	
	function postbyidtag($id_tag=21)
	{
		$query = '
		select wp_posts.ID, wp_posts.post_date, wp_posts.post_content, wp_posts.post_title, wp_posts.guid from wp_posts
		join wp_term_relationships on wp_posts.ID = wp_term_relationships.object_id
		join wp_term_taxonomy on wp_term_relationships.term_taxonomy_id= wp_term_taxonomy.term_taxonomy_id
		join wp_terms on wp_term_taxonomy.term_id=wp_terms.term_id
		where wp_terms.term_id='.$id_tag.' limit 10';
		
		$post = $this->db->query($query);
        return $post->result_array();
		
	}


}

?>
