<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_controller extends Root_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";

    }

    public function get_dropdown_classifications_by_cropid()
    {
        $crop_id = $this->input->post('crop_id');
        $html_container_id='#classification_id';
        if($this->input->post('html_container_id'))
        {
            $html_container_id=$this->input->post('html_container_id');
        }
        $data['items']=Query_helper::get_info($this->config->item('table_cc_classifications'),array('id value','name text'),array('crop_id ='.$crop_id,'status ="'.$this->config->item('system_status_active').'"'),0,0,array('ordering ASC'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>$html_container_id,"html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_types_by_classificationid()
    {
        $classification_id = $this->input->post('classification_id');
        $html_container_id='#type_id';
        if($this->input->post('html_container_id'))
        {
            $html_container_id=$this->input->post('html_container_id');
        }
        $data['items']=Query_helper::get_info($this->config->item('table_cc_types'),array('id value','name text'),array('classification_id ='.$classification_id,'status ="'.$this->config->item('system_status_active').'"'),0,0,array('ordering ASC'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>$html_container_id,"html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_skintypes_by_typeid()
    {
        $type_id = $this->input->post('type_id');
        $html_container_id='#skin_type_id';
        if($this->input->post('html_container_id'))
        {
            $html_container_id=$this->input->post('html_container_id');
        }
        $data['items']=Query_helper::get_info($this->config->item('table_cc_skin_types'),array('id value','name text'),array('type_id ='.$type_id,'status ="'.$this->config->item('system_status_active').'"'),0,0,array('ordering ASC'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>$html_container_id,"html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_varieties_by_skintypeid()
    {
        $skin_type_id = $this->input->post('skin_type_id');
        $html_container_id='#variety_id';
        if($this->input->post('html_container_id'))
        {
            $html_container_id=$this->input->post('html_container_id');
        }
        $data['items']=Query_helper::get_info($this->config->item('table_cc_varieties'),array('id value','name text'),array('skin_type_id ='.$skin_type_id,'status ="'.$this->config->item('system_status_active').'"'),0,0,array('ordering ASC'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>$html_container_id,"html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_territories_by_zoneid()
    {
        $zone_id = $this->input->post('zone_id');
        $html_container_id='#territory_id';
        if($this->input->post('html_container_id'))
        {
            $html_container_id=$this->input->post('html_container_id');
        }
        $data['items']=Query_helper::get_info($this->config->item('table_location_territories'),array('id value','name text'),array('zone_id ='.$zone_id,'status ="'.$this->config->item('system_status_active').'"'),0,0,array('ordering ASC'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>$html_container_id,"html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_districts_by_territoryid()
    {
        $territory_id = $this->input->post('territory_id');
        $html_container_id='#district_id';
        if($this->input->post('html_container_id'))
        {
            $html_container_id=$this->input->post('html_container_id');
        }
        $data['items']=Query_helper::get_info($this->config->item('table_location_districts'),array('id value','name text'),array('territory_id ='.$territory_id,'status ="'.$this->config->item('system_status_active').'"'),0,0,array('ordering ASC'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>$html_container_id,"html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_upazilas_by_districtid()
    {
        $district_id = $this->input->post('district_id');
        $html_container_id='#upazila_id';
        if($this->input->post('html_container_id'))
        {
            $html_container_id=$this->input->post('html_container_id');
        }
        $data['items']=Query_helper::get_info($this->config->item('table_location_upazilas'),array('id value','name text'),array('district_id ='.$district_id,'status ="'.$this->config->item('system_status_active').'"'),0,0,array('ordering ASC'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>$html_container_id,"html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_unions_by_upazilaid()
    {
        $upazila_id = $this->input->post('upazila_id');
        $html_container_id='#union_id';
        if($this->input->post('html_container_id'))
        {
            $html_container_id=$this->input->post('html_container_id');
        }
        $data['items']=Query_helper::get_info($this->config->item('table_location_unions'),array('id value','name text'),array('upazila_id ='.$upazila_id,'status ="'.$this->config->item('system_status_active').'"'),0,0,array('ordering ASC'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>$html_container_id,"html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
   /* public function get_dropdown_customers_by_unionid()
    {
        $union_id = $this->input->post('union_id');
        $data['items']=Query_helper::get_info($this->config->item('table_customers'),array('id value','customer_name text'),array('union_id ='.$union_id,'status ="'.$this->config->item('system_status_active').'"'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#customer_id","html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_consignments_by_year()
    {
        $year = $this->input->post('year');
        $data['items']=Query_helper::get_info($this->config->item('table_consignment'),array('id value','consignment_name text'),array('year ='.$year,'status ="'.$this->config->item('system_status_active').'"'));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#consignment_id","html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_containers_by_consignmentid()
    {
        $consignment_id = $this->input->post('consignment_id');
        $data['items']=Query_helper::get_info($this->config->item('table_container'),array('id value','container_name text'),array('consignment_id ='.$consignment_id));
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#container_id","html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_container_nos_by_consignments_year()
    {
        $consignment_id = $this->input->post('consignment_id');
        $container_variety_type = $this->input->post('container_variety_type');
        $this->db->from($this->config->item('table_container_varieties').' cv');
        $this->db->join($this->config->item('table_container').' container','container.id = cv.container_id','INNER');
        $this->db->where('cv.variety_id',$container_variety_type);
        $this->db->where('container.consignment_id',$consignment_id);
        $this->db->where('cv.revision',1);
        $total=$this->db->count_all_results();

        $data['items']=array();
        for($i=1;$i<=$total;$i++)
        {
            $data['items'][]=array('value'=>$i,'text'=>$i);
        }
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#container_no","html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }
    public function get_dropdown_vehicles_by_consignmentid()
    {
        $consignment_id = $this->input->post('consignment_id');
        $records=Query_helper::get_info($this->config->item('table_setup_vehicle_no'),array('no_of_vehicles'),array('consignment_id ='.$consignment_id,'revision =1'),1);
        $data['items']=array();
        if($records)
        {
            for($i=1;$i<=$records['no_of_vehicles'];$i++)
            {
                $data['items'][]=array('value'=>$i,'text'=>$i);
            }
        }
        $ajax['status']=true;
        $ajax['system_content'][]=array("id"=>"#vehicle_no","html"=>$this->load->view("dropdown_with_select",$data,true));

        $this->jsonReturn($ajax);
    }*/
}
