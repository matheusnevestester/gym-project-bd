<?php


namespace Components\Database;
    /**
     * Classe de abstração facilitadora para o uso do MySql.
     * 
     * @author André Gaspar <and_lrg@hotmail.com>
     */
    class MySql extends MySqlConnector{

        public static $DESC = "DESC";
        /**
         * Função responsável por realizar a montagem do select na respectiva 
         * tabela, aplicando os filtros passados. 
         *
         * @param string $table
         * @param array $fields
         * @param array $where -> Key e Value
         * @return Generator
         */
        public function select($table, $fields=null, $where=null, $orderBy=null, $limit=null){

            if ($fields){
                $fields = implode(", ", $fields);
            }else{
                $fields = "*";
            }
            
            $query = 'SELECT ' . $fields . ' FROM ' . $table;
            
            $where_string = '';

            if (is_array($where)){
                $where_string .= $this->prepareWhereString($where);
                $query .= $where_string;
            }else if (is_string($where)){
                $where_string = ' WHERE ' . $where;
                $query .= $where_string;
            }

            if ($orderBy){
                $query .= $orderBy;
            }
            if ($limit){
                $query .= ' LIMIT '. $limit;
            }

            return $this->executeRawSql($query);
        }

        /**
         * Função responsável por executar a query SQL
         * 
         * @param string query
         */
        public function executeRawSql($query){
            $return = [];
            $result = $this->conn->query($query) or die($this->conn->error);;

            while($row = mysqli_fetch_assoc($result)) {
                $return[] = $row;
            }

            return $return;
        }

        /**
         * Função responsável por realizar os Inserts no banco
         * 
         * @param string $table
         * @param array $values -> Key e Value
         */
        public function insert($table, $values){
            
            $names = implode(', ', array_keys($values));
            
            $values = implode(', ', array_map(
                function($item){
                    if (gettype($item) == 'string'){
                        return "'". $item ."'";
                    }else{
                        return $item;
                    }
                }, array_values($values)));

            $into_string = ' (' . $names . ') ';
            $values_string = 'VALUES (' . $values . ');'; 

            $query = 'INSERT INTO ' . $table . $into_string . $values_string;

            if(!$result = $this->conn->query($query)){
                return('There was an error running the query [' . $this->conn->error . ']');
            }

            return true;
        }

        public function update($table, $values, $id){

            $array_values = [];

            if (is_array($values)) {
                foreach ($values as $column => $value) {
                    $array_values[] = $column . " = '" . $value . "'";
                }
            }

            $values = implode(", ", $array_values);

            $query = "UPDATE " . $table . " SET ". $values . " WHERE id = ". $id;

            if(!$result = $this->conn->query($query)){
                return('There was an error running the query [' . $this->conn->error . ']');
            }

            return true;
        }

        /**
         * Função responsável por realizar os Inserts no banco
         * 
         * @param string $table
         * @param array $values -> Key e Value
         */
        public function delete($table, $where){

            if (!is_array($where)){
                return Null;
            }
            $where_string = $this->prepareWhereString($where);

            $query = 'DELETE FROM ' . $table . $where_string;

            return $this->conn->query($query) === TRUE;
        }

        private function prepareWhereString($where){
            return ' WHERE ' . implode(' AND ', array_map(
                function($key, $value) {
                    return $key . "='" . $value . "'";
                }, array_keys($where), array_values($where)));
        }

        public static function gte($key, $val){
            return $key . " <= " . $val . " ";
        }

        public static function orderBy($val, $type=null){
            return " ORDER BY ". $val . " " . $type . " ";
        }


    }
?>