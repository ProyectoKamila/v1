<?php

class Modelo_Universal extends CI_Model {

    public $modificar = false;
    public $datos = null;

    public function __construct() {
        $this->load->database();
    }

    public function insert($tabla, $insertar, $campoprimary = NULL, $or = null) {
        if ($campoprimary <> null) {
            $validar = $this->check($tabla, $campoprimary, null, $or);
            if ($validar == 0) {
                $this->db->insert($tabla, $insertar);
                $insertado = true;
                return $this->db->insert_id();
            } else {
                $insertado = false;
                return $insertado;
            }
        } else {
            $this->db->insert($tabla, $insertar);
            $insertado = $this->db->insert_id();
            return $insertado;
        }
    }

    public function update($tabla, $cambiar, $condicion) {
        $this->db->update($tabla, $cambiar, $condicion);
        return $this->db->affected_rows();
    }

    public function check($tabla, $verificar, $limite = null, $desde = null, $or = null) {
        if ($limite <> null && $desde <> null) {
            if ($or == null) {
                $this->datos = $this->db->get_where($tabla, $verificar, $limite, $desde);
            } else {
                $this->datos = $this->db->where_or($tabla, $verificar, $limite, $desde);
            }
        } else {
            if ($or == null) {
                $this->datos = $this->db->get_where($tabla, $verificar);
            } else {
                $this->datos = $this->db->where_or($tabla, $verificar);
            }
            return ($this->datos->num_rows());
        }
    }
    
    public function query($query = null) {
       $this->data = $this->db->query($query);
//            $consulta = $consulta->result_array;
       $query = $this->data->result_array();

       return $query;
   }

    public function select($tabla, $campos = null, $condicion = null, $limite = null, $desde = 0, $a_ordenar = null, $orden = null, $a_ordenar2 = null, $orden2 = null, $disct = null) {
        if ($disct <> null) {
            $this->db->distinct();
        }
        if ($orden <> null && $a_ordenar <> null) {
            $this->db->order_by($a_ordenar, $orden);
        }
        if ($orden2 <> null && $a_ordenar2 <> null) {
            $this->db->order_by($a_ordenar2, $orden2);
        }
        if ($campos <> null) {
            $this->db->select($campos);
        }
        if ($condicion <> null) {
            if ($limite <> null && $desde <> null) {
                $resultado = $this->datos = $this->db->get_where($tabla, $condicion, $limite, $desde)->result_array();
            } else {
                if ($limite <> null && $desde == null) {
                    $this->db->limit($limite);
                }
                $resultado = $this->db->get_where($tabla, $condicion)->result_array();
            }
        } else {
            if ($limite <> null) {
                $this->db->limit($limite);
                $resultado = $this->db->get($tabla)->result_array();
                ;
            } else {
                $resultado = $this->db->get($tabla)->result_array();
                ;
            }
        }
        return $resultado;
    }

    public function selectjoin($tabla, $tabla2, $condicion2, $campos = null, $tabla3 = null, $condicion3 = null, $tabla4 = null, $condicion4 = null, $a_ordenar = null, $orden = null, $a_ordenar2 = null, $orden2 = null, $distinct = null,$limite=null,$desde=0) {
        if ($distinct <> null) {
            $this->db->distinct();
        }
 if ($limite <> null && $desde <> null) {
            $this->db->limit($limite, $desde);
        }

        if ($orden <> null && $a_ordenar <> null) {
            $this->db->order_by($a_ordenar, $orden);
        }
        if ($orden2 <> null && $a_ordenar2 <> null) {
            $this->db->order_by($a_ordenar2, $orden2);
        }

        if ($campos <> null) {
            $this->db->select($campos);
        }
        $this->db->from($tabla);
        $this->db->join($tabla2, $condicion2);
        if ($tabla3 <> null && $condicion3 <> null) {
            $this->db->join($tabla3, $condicion3);
        }
        if ($tabla4 <> null && $condicion4 <> null) {
            $this->db->join($tabla4, $condicion4);
        }
        
        $query = $this->db->get()->result_array();

        return $query;
    }
    
        public function selectjoincount($tabla, $tabla2, $condicion2, $tabla3 = null, $condicion3 = null, $tabla4 = null, $condicion4 = null, $a_ordenar = null, $orden = null, $a_ordenar2 = null, $orden2 = null, $distinct = null) {
        if ($distinct <> null) {
            $this->db->distinct();
        }


        if ($orden <> null && $a_ordenar <> null) {
            $this->db->order_by($a_ordenar, $orden);
        }
        if ($orden2 <> null && $a_ordenar2 <> null) {
            $this->db->order_by($a_ordenar2, $orden2);
        }


        $this->db->from($tabla);
        $this->db->join($tabla2, $condicion2);
        if ($tabla3 <> null && $condicion3 <> null) {
            $this->db->join($tabla3, $condicion3);
        }
        if ($tabla4 <> null && $condicion4 <> null) {
            $this->db->join($tabla4, $condicion4);
        }

        $query = $this->db->count_all_results();

        return $query;
    }

    public function delete($tablas, $condicion) {
        $validar = $this->check($tablas, $condicion);
        if ($validar) {
            $this->db->where($condicion);
            $this->db->delete($tablas);
            $validar = true;
        } else {
            $validar = false;
        }
        return $validar;
    }

    public function count($tabla, $condicion) {
        $this->db->where($condicion);
        $this->db->from($tabla);
        return $this->db->count_all_results();
    }

}

?>
