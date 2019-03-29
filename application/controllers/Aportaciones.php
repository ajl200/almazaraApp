<?php 

include_once('Security.php');

class Aportaciones extends Security {

    public function index(){
        $data["viewName"] = "admin_aportaciones";

        if ($this->session->flashdata('data') != null){
            $a = $this->session->flashdata('data');
            $data['msg'] = $a['msg'];
        }
        $this->load->view('template', $data);
    }

    public function insert () {
        $id_prov = $this->input->get_post('prov_id'); 
        $kg = $this->input->get_post('ins_aportacion_kg'); 
        $variedad = $this->input->get_post('ins_variedad'); 
        $localidad = $this->input->get_post('ins_localidad'); 
        $eco = $this->input->get_post('cb_eco'); 
        if ($eco == null){
            $eco = 0;
        }

        $r = $this->modelProveedores->insert_aportacion($id_prov, $kg, $variedad, $localidad, $eco);
        if ($r == 0) {
            //error
            $data["msg"] = "1";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        } else {
            //bien
            $data["msg"] = "0";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        }
    }

    public function update () {
        $id = $this->input->get_post('upd_id');
        $nombre = $this->input->get_post('upd_nombre');
        $apellido1 = $this->input->get_post('upd_apellido1');
        $apellido2 = $this->input->get_post('upd_apellido2');
        $dni = $this->input->get_post('upd_dni');
        $telf = $this->input->get_post('upd_telefono');
        
        $r = $this->modelProveedores->update($id,$nombre, $apellido1, $apellido2, $dni, $telf);

        if ($r == 0) {
            //error
            $data["msg"] = "1";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        } else {
            //bien
            $data["msg"] = "0";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        }
    }

    public function delete ($id) {
        $r = $this->modelProveedores->delete($id);
        if ($r == 0) {
            //error
            $data["msg"] = "1";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        } else {
            //bien
            $data["msg"] = "0";
            $this->session->set_flashdata('data',$data);
            redirect('Proveedores/index');
        }
    }

    
}