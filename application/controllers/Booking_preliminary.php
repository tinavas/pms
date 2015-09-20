<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_preliminary extends Root_Controller
{
    private  $message;
    public $permissions;
    public $controller_url;
    public $parent_module_id=0;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->permissions=User_helper::get_permission('Booking_preliminary');
        if(isset($this->permissions['task_id'])&&($this->permissions['task_id']>0))
        {
            $this->parent_module_id=System_helper::get_parent_id_of_task($this->permissions['task_id']);
        }
        $this->controller_url='booking_preliminary';
        $this->load->model("booking_preliminary_model");
    }

    public function index($action="search",$id=0)
    {
        if($action=="search")
        {
            $this->system_search();
        }
        elseif($action=="edit")
        {
            $this->system_edit($id);
        }
        elseif($action=="save")
        {
            $this->system_save();
        }
        else
        {
            $this->system_search();
        }
    }
    public function system_search()
    {
        if(isset($this->permissions['view'])&&($this->permissions['view']==1))
        {
            $data['title']="Preliminary Booking";
            $data['zones']=Query_helper::get_info($this->config->item('table_zones'),array('id','zone_name'),array('status ="'.$this->config->item('system_status_active').'"'));
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("booking_preliminary/search",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=site_url($this->controller_url.'/index/search');
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    public function system_edit($id=0)
    {
        if(isset($this->permissions['edit'])&&($this->permissions['edit']==1))
        {
            if(($this->input->post('customer_id')))
            {
                $customer_id=$this->input->post('customer_id');
            }
            else
            {
                $customer_id=$id;
            }
            /*$data['variety']=Query_helper::get_info($this->config->item('table_varieties'),'*',array('id ='.$variety_id),1);

            $data['title']="Change Variety price(".$data['variety']['variety_name'].')';*/
            $ajax['status']=true;
            $data['title']='New Booking';
            $data['booking']['id']=0;
            $data['booking']['customer_id']=$customer_id;
            $data['booking']['status']=$this->config->item('system_status_active');

            $data['booked_varieties']=array();

            $data['varieties']=$this->booking_preliminary_model->get_all_varieties();

            $ajax['system_content'][]=array("id"=>"#detail_container","html"=>$this->load->view("booking_preliminary/edit",$data,true));

            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }


            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    public function system_save()
    {
        $user=User_helper::get_user();
        $id = $this->input->post("id");

        if(!(isset($this->permissions['add'])&&($this->permissions['add']==1)))
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
            die();

        }

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $data = $this->input->post('variety');
            $time=time();

            {
                $data['modified_by']=$user->id;
                $data['modification_date']=$time;
                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_varieties'),$data,array("id = ".$id));
                $data_history=$this->input->post('variety');
                $data_history['created_by'] = $user->user_id;
                $data_history['creation_date'] = $time;
                $data_history['variety_id']=$id;
                Query_helper::add($this->config->item('table_variety_price_history'),$data_history);
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {

                    $this->message=$this->lang->line("MSG_SAVED_SUCCESS");
                    $this->system_edit($id);
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_SAVED_FAIL");
                    $this->jsonReturn($ajax);

                }
            }

        }
    }
    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('variety[unit_price]',$this->lang->line('LABEL_UNIT_PRICE'),'required|numeric');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
}