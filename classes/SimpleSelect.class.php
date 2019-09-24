<?php



class SimpleSelect
{
    private $query;
    private $result;
    private $error;

    function __construct($query){
        $this->query = $query;
    }

    public function getQuery(){
        return $this->query;
    }
    
    public function getError(){
        return $this->error;
    }

    public function setQuery(string $var)
    {
        $this->query = $var;
    }

    public function getResult(){
        return $this->result;
    }
    
    public function sendQ(){
        try {

            $q = $db->query($this->query);
            $this->result = fetchAll($q);
            return true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
}
