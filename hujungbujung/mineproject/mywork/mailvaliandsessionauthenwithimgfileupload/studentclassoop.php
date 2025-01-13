<?php
        class Student{
            private $name;
            private $id;
            private $batch;

           public function __construct($_name,$_id,$_batch) {
                $this->name = $_name;
                $this->id = $_id;
                $this->batch = $_batch;
                //echo $_name;
            }
            function information(){
                file_put_contents("datastore.txt",$this->calldata(),FILE_APPEND);
            }
            function calldata(){
                return $this->name.";".$this->id.";".$this->batch.PHP_EOL;
            }
            public static function showdata(){
                $students=file("datastore.txt");

                echo "<table borfer='1'>
                            <tr>
                                <th>Name</th>
                                <th>ID</th>
                                <th>batch</th>
                            </tr>";
                            foreach($students as $student){
                                list($name,$id,$batch)=explode(";",trim($student));
                                echo "<tr>
                                            <th>$name</th>
                                            <th>$id</th>
                                            <th>$batch</th>
                                </tr>";
                            }
            }
        }
?>