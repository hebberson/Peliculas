<?php
class DB{
    private $Host = "localhost";
    private $User = "root";
    private $Password = "";
    private $BasedeDatos = "pelicules";
    
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->Host, $this->User, $this->Password, $this->BasedeDatos);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    public function getRows($tabla,$condiciones = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$condiciones)?$condiciones['select']:'*';
        $sql .= ' FROM '.$tabla;
        if(array_key_exists("where",$condiciones)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($condiciones['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("search",$condiciones)){
            $sql .= (strpos($sql, 'WHERE') !== false)?'':' WHERE ';
            $i = 0;
            foreach($condiciones['search'] as $key => $value){
                $pre = ($i > 0)?' OR ':'';
                $sql .= $pre.$key." LIKE '%".$value."%'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$condiciones)){
            $sql .= ' ORDER BY '.$condiciones['order_by']; 
        }
        
        if(array_key_exists("start",$condiciones) && array_key_exists("limit",$condiciones)){
            $sql .= ' LIMIT '.$condiciones['start'].','.$condiciones['limit']; 
        }elseif(!array_key_exists("start",$condiciones) && array_key_exists("limit",$condiciones)){
            $sql .= ' LIMIT '.$condiciones['limit']; 
        }
        
        $resultado = $this->db->query($sql);
        
        if(array_key_exists("return_type",$condiciones) && $condiciones['return_type'] != 'all'){
            switch($condiciones['return_type']){
                case 'count':
                    $data = $resultado->num_rows;
                    break;
                case 'single':
                    $data = $result->fetch_assoc();
                    break;
                default:
                    $data = '';
            }
        }else{
            if($resultado->num_rows > 0){
                while($row = $resultado->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }
        return !empty($data)?$data:false;
    }
}

?>