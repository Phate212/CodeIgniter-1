<?php
/* 
 * Generated by CRUDigniter v2.3 Beta 
 * www.crudigniter.com
 */
 
class Artikel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Artikel_model');
    } 
	
		function index(){
			$this->load->view('artikel');
		}

    /*
     * Listing of artikel
     */
    function daftar()
    {
        $data['artikel'] = $this->Artikel_model->get_all_artikel();

        $this->load->view('artikel_list',$data);
    }

    /*
     * Adding a new artikel
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'judul' => $this->input->post('judul'),
				'penulis' => $this->input->post('penulis'),
				'tanggal' => $this->input->post('tanggal'),
				'isi' => $this->input->post('isi'),
            );
            
            $artikel_id = $this->Artikel_model->add_artikel($params);
            redirect('artikel/daftar');
        }
        else
        {
            $this->load->view('artikel/add');
        }
    }  

    /*
     * Editing a artikel
     */
    function edit($id_artikel)
    {   
        // check if the artikel exists before trying to edit it
        $artikel = $this->Artikel_model->get_artikel($id_artikel);
        
        if(isset($artikel['id_artikel']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'judul' => $this->input->post('judul'),
					'penulis' => $this->input->post('penulis'),
					'tanggal' => $this->input->post('tanggal'),
					'isi' => $this->input->post('isi'),
                );

                $this->Artikel_model->update_artikel($id_artikel,$params);            
                redirect('artikel/daftar');
            }
            else
            {   
                $data['artikel'] = $this->Artikel_model->get_artikel($id_artikel);
    
                $this->load->view('artikel/edit',$data);
            }
        }
        else
            show_error('The artikel you are trying to edit does not exist.');
    } 

    /*
     * Deleting artikel
     */
    function remove($id_artikel)
    {
        $artikel = $this->Artikel_model->get_artikel($id_artikel);

        // check if the artikel exists before trying to delete it
        if(isset($artikel['id_artikel']))
        {
            $this->Artikel_model->delete_artikel($id_artikel);
            redirect('artikel/daftar');
        }
        else
            show_error('The artikel you are trying to delete does not exist.');
    }
    
}