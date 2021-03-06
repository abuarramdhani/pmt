<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model Project
 * @by		: doni(doni.enginer@gmail.com)
 * @date	: Mei 2019
 **/
 
 class Project_model extends CI_Model
 {
	var $t_table 	= 'projects';

	/**
	 * Constructor
	 * @param	-
	 * @return 	-
	 **/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Data Investasi
	 * @param	id, page, limit, search
	 * @return 	array
	 **/
	public function data_($type = '', $user_id = '')
	{
		$this->db->from($this->t_table);
		$this->db->select($this->t_table .'.*, region.region_code, user.name as project_manager, u2.name as osm, u3.name as general_manager, u4.name as pmg');
		$this->db->join('region', 'region.id='. $this->t_table .'.region_id', 'left');
		$this->db->join('user', 'user.id='. $this->t_table .'.project_manager_id', 'left');
		$this->db->join('user u2', 'u2.id='. $this->t_table .'.osm_id', 'left');
		$this->db->join('user u3', 'u3.id='. $this->t_table .'.gm_id', 'left');
		$this->db->join('user u4', 'u4.id='. $this->t_table .'.pmg_id', 'left');

		if($type == 'pm')
		{
			$this->db->where('project_manager_id', $user_id);
		}

		if(isset($_GET['osm_id']) and !empty($_GET['osm_id']))
		{
			$this->db->where('projects.osm_id', $_GET['osm_id']);
		}
		if(isset($_GET['project_manager_id']) and !empty($_GET['project_manager_id']))
		{
			$this->db->where('projects.project_manager_id', $_GET['project_manager_id']);
		}
		if(isset($_GET['region_id']) and !empty($_GET['region_id']))
		{
			$this->db->where('projects.region_id', $_GET['region_id']);
		}

		if(isset($_GET['name']) and !empty($_GET['name']))
		{
			$this->db->group_start()
					->like('projects.project_code', $_GET['name'])
					->or_like('projects.name', $_GET['name'])
					->or_like('projects.project_type', $_GET['name'])
					->group_end();
		}

		$this->db->order_by('id', 'DESC');
		$i = $this->db->get();	
		
		return $i->result_array();
	}

	/**
	 * Get Manager Project
	 */
	public function get_manager_by_project($project_id)
	{
		$this->db->from($this->t_table.' p');
		$this->db->select('p.*, region.region_code, user.name as project_manager, user.phone, user.email');
		$this->db->join('region', 'region.id=p.region_id', 'left');
		$this->db->join('user', 'user.id=p.project_manager_id', 'left');
		$this->db->where('p.id', $project_id);

		$i = $this->db->get();
		
		return $i->row_array();
	}

	/**
	 * Get Manager Project
	 */
	public function get_osm_by_project($project_id)
	{
		$this->db->from($this->t_table);
		$this->db->select($this->t_table .'.*, region.region_code, user.name as project_manager, user.phone, user.email');
		$this->db->join('region', 'region.id='. $this->t_table .'.region_id', 'left');
		$this->db->join('user', 'user.id='. $this->t_table .'.osm_id', 'left');
		$this->db->where($this->t_table .'.id', $project_id);

		$i = $this->db->get();
		
		return $i->row_array();
	}

	/**
	 * Total
	 * @param 	search 
	 * @return 	count table
	 **/
	public function total($search = 0)
    {
    	if(!empty($search)):
			$this->db->like('uraian', $search);
		endif;
        $i = $this->db->get($this->t_table);
        return $i->num_rows();
    }

    /**
	 * insert
	 * @param 	data array , table
	 * @return 	
	 **/
    public function insert($table, $data = array())
    {
    	$i = $this->db->insert($table, $data);
    	$no = 0;
    	if($i):
    		echo $no++;
    	endif;
    }

    public function get_by_id($id)
    {
    	$this->db->from($this->t_table);
		$this->db->select($this->t_table .'.*, region.region_code, user.name as project_manager, u2.name as osm, u3.name as general_manager, u4.name as pmg');
		$this->db->join('region', 'region.id='. $this->t_table .'.region_id', 'left');
		$this->db->join('user', 'user.id='. $this->t_table .'.project_manager_id', 'left');
		$this->db->join('user u2', 'u2.id='. $this->t_table .'.osm_id', 'left');
		$this->db->join('user u3', 'u3.id='. $this->t_table .'.gm_id', 'left');
		$this->db->join('user u4', 'u4.id='. $this->t_table .'.pmg_id', 'left');

		$this->db->where([$this->t_table .'.id' => $id]);

		$data = $this->db->get();
    	
    	return $data->row_array();
    }
}