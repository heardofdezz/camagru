<?php
    class Model{

        public $table;

        public function __construct()
        {
            $this->table=get_called_class()."s";
            var_dump($this->table);
        }
        public function read($fields=null)
        {
            if($fields==null){ $fields = "*"; }
            $sql = "SELECT $fields FROM " .$this->table."WHERE id=".$this->id;
            $req = mysql_query($sql) or die(mysql_error()."<br /> =>".mysql_query());
            $data = mysql_fetch_assco($req);
            foreach($data as $k=>$v)
            {
                $this->$k = $v;
            }
        }

        public function save($data)
        {
            /// UPDATE AND SAVE INCOMING DATA
            if(isset($data["id"]) && !empty($data["id"]))
            {
                $sql = "UPDATE ".$this->table." SET ";
                foreach($data as $k=>$v)
                {
                    $sql .= "$k='$v',";
                }
                $sql = substr($sql,0,-1);
                $sql .= "WHERE id=".$data["id"];
                echo $sql; /// ERROS MANAGING.
            }
            else
            {
                /// INSERT IN TO DB IF DATA ID DOESNT EXIST NEW DATA IN TO INSERT
                $sql = "INSERT INTO ".$this->table."(";
                unset($data["id"]); /// CAREFULL ON THIS ON!!
                foreach($data as $k=>$v)
                {
                    $sql .= "$k='$v',";
                }
                $sql = substr($sql,0,-1);
                $sql .= ") VALUES (";
                foreach ($data as $k=>$v)
                {
                   $sql .= "'$v,'"; 
                }
                $sql = substr($sql,0,-1);
                $sql .= ")";
                //echo $sql; /// ERROS MANAGING.
            }
            mysql_query($sql) or die(mysql_error()."<br/> => ".mysql_query());
            if(!isset($data["id"]) || !empty($data["id"]))
            {
                $this->id=mysql_insert_id();
            }
            else
            {
                $this->id=$data["id"];
            }
        }
        // SEARCH IN DB ITEM AND DIPLAYS/ASSOCIATION
        public function find($data=array())
        {
            $conditions = "1=1";
            $fields = "*";
            $limit = "";
            $order = "id DESC";
            if(isset($data["conditions"])){$conditions=$data["conditions"];}
            if(isset($data["fields"])){$conditions=$data["fields"];}
            if(isset($data["limit"])){$conditions=$data["limit"];}
            if(isset($data["order"])){$order=$data["order"];}
            $sql = "SELECT $fields FROM ".$this->table." WHERE $conditions ORDER BY $order $limit";
            $req = mysql_query($sql) or die(mysql_error()."<br /> =>".mysql_query());

            $d = array();
            while ($data = mysql_fetch_assoc($req))
            {
                $d[] = $data;
            }
            return $d;
        }
        public function delete($id)
        {
                if($id==null) {$id = $this->id;}
                $sql = "DELETE FROM ".$this->table."WHERE id = $id";
                $req = mysql_query($sql) or die(mysql_error()."<br /> =>".mysql_query());
        }
        static function load($name)
        {
            require("$name.php");
            return($name);
        }
    }
?>