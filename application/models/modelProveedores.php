<?php 

class modelProveedores extends CI_Model {
    
    public function get_all() {
        $query = $this->db->query("SELECT * FROM proveedores;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    public function insert_aportacion($id_prov, $kg, $variedad, $localidad, $eco){
        $query = $this->db->query("INSERT INTO aportacion (id, id_proveedor, kilos , id_variedad, id_localidad, eco) VALUES (null, '$id_prov', '$kg', '$variedad', '$localidad', $eco);"); 
        return $this->db->affected_rows();
    }

    public function get_variedades() {
        $query = $this->db->query("SELECT * FROM variedad;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            } 
        return  array_column($data, 'variedad');
    }

    public function get_localidades() {
        $query = $this->db->query("SELECT * FROM localidad;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return  array_column($data, 'localidad');
    }

    public function validar_dni($dni) {
        $valid = 0; //bien, no existe.
        $query = $this->db->query("SELECT id FROM proveedores where dni = '$dni';"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        if (count($data) > 0){
            $valid = 1; //mal, existe.
        }

        var_dump($data);
        return $valid;
    }


    public function insert($nombre, $apellido1, $apellido2, $dni, $telf){
        $query = $this->db->query("INSERT INTO proveedores (id, nombre, apellido1, apellido2, dni, telf) VALUES (null,'$nombre', '$apellido1', '$apellido2', '$dni', '$telf');"); 
        return $this->db->affected_rows();
    }



    public function delete($id){
        $query = $this->db->query("DELETE FROM proveedores WHERE id = '$id'"); 
        return $this->db->affected_rows();
    }

    public function update($id,$nombre, $apellido1, $apellido2, $dni, $telf){
        $status = 0;
        $this->db->trans_start();
        $query = $this->db->query("DELETE FROM proveedores WHERE id = '$id'"); 
        $query = $this->db->query("INSERT INTO proveedores (id, nombre, apellido1, apellido2, dni, telf) VALUES (null,'$nombre', '$apellido1', '$apellido2', '$dni', $telf);"); 
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $status = 1;
        }
        return $status;
    }
}
