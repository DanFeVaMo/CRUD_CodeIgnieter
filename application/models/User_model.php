<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    

    public function save($data) {

        $this -> db -> query("ALTER TABLE usuario AUTO_INCREMENT 1");
        $this -> db -> insert('usuario', $data);

    }
    

    public function getUsuarios() {
        $this -> db -> select('*');
        $this -> db -> from('usuario');
        $results = $this ->db -> get();
        return $results -> result();
    }

    public function getUsuario($id) {
        $this -> db -> select('u.id,u.nombre,u.correo');
        $this -> db -> from('usuario u');
        $this -> db -> where("u.id",$id);
        $results = $this ->db -> get();
        return $results -> row();
    }

    public function update($data,$id) {

        $this -> db -> where("usuario.id",$id);
        $this -> db -> update('usuario', $data);

    }

    public function delete($id) {
        $this -> db -> where("usuario.id",$id);
        $this -> db -> delete('usuario');
    }
}
