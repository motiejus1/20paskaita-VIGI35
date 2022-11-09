<?php


class DatabaseManager {

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';

    private $database = 'sujungimai';

    protected $conn; 


    //php/html - utf8 nuskaito
    // PDO - latin (lotyniskai)
    //duomenu utf8mb - saugo ir nuskaito

    public function __construct() {
    
        try { 
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->database", 
                $this->user, 
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            
        } catch (PDOException $e) {
           
            echo "Klaida: " . $e->getMessage();
        }
    }

//     SELECT 
//     kategorijos.pavadinimas,
//     produktai.id, 
//     produktai.pavadinimas,
//     produktai.aprasymas,
//     produktai.kaina
   
// FROM produktai
// LEFT JOIN kategorijos
// ON produktai.kategorijos_id = kategorijos.id

//metodas kuris tiesiogiai paleidzia uzklausa

// raw - gryna/sviesia
//query - uzklausa
    public function rawQuery($sql){
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            // lentele - kintamojo tipas(blob)
            //php blob kintamojo neturi
            // objektus arba masyvus(asociatyvus masyvas)
            // blob -> masyvas asociatyvus
            // stulepliu pavadinimai -> asociatyvaus masyvo indeksais
            // pavadinimas -> pavadinimas
            // aprasymas -> aprasymas
            // kaina -> kaina
            //  pavadinimas -> pavadinimas - prarandam




        } catch (PDOException $e) {
            echo "Klaida: " . $e->getMessage();
        } 
    }

    public function select($table) {
        $sql = "SELECT * FROM `$table`";
        try {

            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //kad rodytu klaidas
            $stmt = $this->conn->prepare($sql);
            //vykdyti uzklausa
            $stmt->execute();

            //rezultato pasidejimas

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); // lenteles pasirnkti duomenys yra paverciami i asociatyvu masyva
            $result = $stmt->fetchAll();

            return $result; //visas kompanijas kaip asociatyvu masyva

        } catch (PDOException $e) {
            echo "Klaida: " . $e->getMessage();
        }
    }

    public function insert($table, $cols, $values) {    

        $cols = implode(',', $cols); // pavadinimas,aprasymas
        
        for ($i=0; $i < count($values); $i++) { 
            $values[$i] = "'".$values[$i]."'";
        }
        
        $values = implode(',', $values); // pavadinimas',aprasymas'

        

        //lentele gali tureti skirtingus stuleplius, skirtingas ivedamas reiksmes
        $sql = "INSERT INTO `$table`($cols) VALUES ($values)";

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //exec komanda naudojama kai uzklausa negrazina rezulatu
            $this->conn->exec($sql);

            echo "irasas   sekmingai pridetas";
        }
        catch(PDOException $e) {
            echo "Klaida: " . $e->getMessage();
        }
    }

    public function delete($table, $col, $id) {
        

        $sql = "DELETE FROM `$table` WHERE $col='$id'";
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec($sql);
        }
        catch(PDOException $e) {
            echo "Klaida: " . $e->getMessage();
        }

    }
    public function update($table, $id, $data) {
        //$data - array

        $cols = array_keys($data); // ["vardas", "pavarde", "miestas", "kompanijosID"]
        $values = array_values($data); // ["test", "test", "Kaunas", 5]

        $dataString = [];

        for($i = 0; $i < count($data); $i++) {
            $dataString[] = $cols[$i] . "='" . $values[$i]. "'";
        }
        //implode - masyva pavercia i stringa pagal zenkla

        $sql = "UPDATE `$table` SET $dataString WHERE id='$id'";
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec($sql);
        }
        catch(PDOException $e) {
            echo "Klaida: " . $e->getMessage();
        }

    }

    public function __destruct() {
        // 3. Atsijungimas nuo duomenu bazes
        $this->conn = null; //prisijungimas = null,
        //echo "  Atsijungta nuo duomenu bazes";
    }
}




