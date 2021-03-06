<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  *  @Description: This utility class conveniently generate the boiler plate templates
  *  			   for the views, if 'multiple' type it creates the relevant directory
  *       @Params: 
  *
  *  	 @returns: 
  */



class Stuff_template_generator extends CI_Model {

	   /**
	    *  @Description: A way to loop through all the entries that are multiples
	    *                so that they can be passed into the twig template builder
	    *       @Params: none
	    *
	    *  	 @returns: An array of multiples
	    */
	  public function get_all_sections()
	  {
	  	$this->db->select('section.name,entry.id,entry.sectionid');
	  	$this->db->from('section');
	  	$this->db->join('entry', 'section.id = entry.sectionid', 'left');
	  	$this->db->where('entry.type', 'Multiple');

	  	

	  	$query = $this->db->get();
	  	
	  	//display($entryid,$sectionid)

	  	$arr = array();
	  	$counter = 0;
	  	foreach ($query->result() as $row) 
	  	{
	  		
	  		$url = $this->get_route($row->id,$row->sectionid);
	  		
	  		$section_name = $row->name;

	  		$a['url'] =  $url;
	  		$a['title'] = $this->get_title($row->id,$row->sectionid);
	  		$arr[$section_name][$counter] = $a;
	  		$counter++;
	  	}
	  	return $arr;

	  }

	   /**
	    *  @Description: swap the controller for the url friendly route
	    *       @Params: params
	    *
	    *  	 @returns: returns
	    */
	  public function get_route($entryid,$sectionid)
	  {
	  	$string = "admin/test_twig/display/$entryid/$sectionid";

	  	$this->db->select('route');
	  	$this->db->from('routes');
	  	$this->db->where('controller', $string);
	  	$this->db->limit(1);

	  	$query = $this->db->get();
	  	
	  	$route = "";
	  	foreach ($query->result() as $row) 
	  	{
	  		$route =  $row->route;
	  	}
	  	
	  	return $route;

	  }

	   /**
	    *  @Description: grabs the multiple title
	    *       @Params: entryid, sectionid
	    *
	    *  	 @returns: string title
	    */
	  public function get_title($entryid,$sectionid)
	  {
	  	$string = "admin/test_twig/display/$entryid/$sectionid";

	  	$this->db->select('route');
	  	$this->db->from('routes');
	  	$this->db->where('controller', $string);
	  	$this->db->limit(1);

	  	$query = $this->db->get();
	  	
	  	$route = "";
	  	foreach ($query->result() as $row) 
	  	{
	  		$route =  $row->route;
	  	}
	  	
	  	$tmp = explode("/", $route);
	  	return $tmp[1];
	  	


	  }
	


	  /**
	   *  @Description: generic function to dump all assets to twig view
	   *       @Params:  entryid
	   *
	   *  	 @returns: array of all assets
	   */
	 public function get_all_assets($entryid)
	 {

	 	//entry = array(assetnamehandle(url,width)))
	 	$this->db->select('*');
	 	$this->db->from('assetfields');
	 	$this->db->where('entryid', $entryid);
	 	

	 	$query = $this->db->get();
	 	
	 	$arr = array();
	 	$counter = 0;
	 	$query = $query->result_array();

	 	$arr_assets = array();
		 foreach ($query as $key ) 
		 {
		 	$arr[$counter] =  $key;
		 	$b = $key;

		 	$arr_z = array();
		 	
		 	$ass_name = "";
		 	foreach ($b as $ke =>$r) 
		 	{		
		 		$arr_z[$ke] = $r;
		 		if($ke === 'fieldname')
		 		{
		 			$ass_name = $r;
		 		}
		 	}
		 	$arr_assets[$ass_name][$counter] = $arr_z;
		 	$counter++;
		 }

		 return $arr_assets;
	 }





	 



	 /**
	  *  @Description: description PRIVATE method for security
	  *       @Params: $sectionid, $entryid
	  *
	  *  	 @returns: yes or no
	  */

	public function create_template($sectionid,$entryid)
	{

		//first check if type is Single or Multiple
		if($this->is_multiple($sectionid))
		{
			//generate directory

			//TODO check if directory exists overwrite etc


			$folder = $this->get_section_name($sectionid);
			mkdir("./application/views/custom/$folder");

			//write index.html in director TODO!!!!!





			//write  _entry.html

			$content = $this->get_field_handles($sectionid);

			$string =
"{% extends \"_layout.html\" %}

{% block content %}

{# You put our content in here #}
	$content

{% endblock %}";

			$string2 =
"{% extends \"_layout.html\" %}

{% block content %}

{# You put our content in here #}
	{% for entry in multiples.$folder %}
		<a href=\"{{entry.url}}\">{{entry.title}}</a>
		<br/>

	{% endfor %}

{% endblock %}";



			
			if ( ! write_file("./application/views/custom/$folder/_entry.html", $string))
			{
			    echo 'Unable to write the file, check you have right permissions';
			}
			else
			{
			    //echo 'File written!';
			}

			if ( ! write_file("./application/views/custom/$folder/index.html", $string2))
			{
			    echo 'Unable to write the file, check you have right permissions';
			}
			else
			{
			    //echo 'File written!';
			}



		}
		else
		{
			//is Single therefore
			//generate html in custom view directory
			$content = $this->get_field_handles($sectionid);

			$string =
"{% extends \"_layout.html\" %}

	{% block content %}

	{# You put our content in here #}
		$content

	{% endblock %}";


			//$data = 'Some file data';
			$file = $this->get_section_name($sectionid);
			if ( ! write_file("./application/views/custom/$file.html", $string))
			{
			    echo 'Unable to write the file, check you have right permissions';
			}
			else
			{
			    //echo 'File written!';
			}
		}
	}



	 /**
	  *  @Description: get all the field handles for sectionid
	  *       @Params: sectionid
	  *
	  *  	 @returns: string of all field handles eg {{entry.fieldHandle}} ...
	  */
	public function get_field_handles($sectionid)
	{
		//special case for assets,checkboxes and grid TODO!!!

		

		$this->db->select('*');
		$this->db->from('section_layout');
		$this->db->join('fields', 'section_layout.fieldid = fields.id', 'left');
		$this->db->where('section_layout.sectionid', $sectionid);

		$query = $this->db->get();
		
		$string = "";
		foreach ($query->result() as $row) 
		{
			//special case for uploads
			if($row->type === "file-upload")
			{
				$string = $string . 
				 '{% for a in assets.'.$row->name. ' %}
	    	<img src="{{a.url}}" alt="" width="600px;"/>
	    {% endfor %}' ."\n\t";
			}
			else
			{
				$string = $string . "{{entry." .$row->name ."}}" . "\n\t\t";	
			}

			
		}
		return $string;
	}


	 /**
	  *  @Description: returns the section name
	  *       @Params: sectionid
	  *
	  *  	 @returns: string (section_name)
	  */
	public function get_section_name($sectionid)
	{
		$this->db->select('name');
		$this->db->from('section');
		$this->db->where('id', $sectionid);
		$this->db->limit(1);

		$query = $this->db->get();
		
		$section_name = "";
		foreach ($query->result() as $row) 
		{
			$section_name = $row->name;
		}
		return $section_name;
	}


	 /**
	  *  @Description: detects if section type is Multiple or Single
	  *       @Params: sectionid
	  *
	  *  	 @returns: True or False
	  */
	public function is_multiple($sectionid)
	{
		$this->db->select('sectiontype');
		$this->db->from('section');
		$this->db->where('id', $sectionid);
		$this->db->limit(1);

		$query = $this->db->get();
		
		$type = "";
		foreach ($query->result() as $row) 
		{
			$type =  $row->sectiontype;
		}

		if($type === "Multiple")
		{
			return True;
		}
		else
		{
			return False;
		}	
	}

}

/* End of file Stuff_template_generator.php */
/* Location: ./application/models/Stuff_template_generator.php */