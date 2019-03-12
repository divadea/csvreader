<?php
/**
 * Created in PhpStorm withGithub and Heroku.
 * User: divadea
 * Date: 3/11/2019
 *
 */

main::start('example.csv');

class main {

    static public function start ($filename) {

        $records = csv::getRecords($filename);

        $table = html::generateTable($records);

     #   $record = recordFactory::create();
       # print ('<table>');
        print("<h1>My contacts</h1>>");
        print($table);
       # print('</table>');

    }
}


class html{

    /*public  function generateRow($record,$count) {

        $array = $record->returnArray();
        $values = array_values($array);
        #print_r($values);
        $table1 = '<tr><th scope = "row">';
        $table1 .= (string)$count;
        $table1 .= '</th>';

        foreach($values as $s) {
            $table1 .= '<td>';
            $table1 .= $s;
            $table1 .= '</td>';

        }

        return $table1;

    }*/
    #$table1 ='';

    public static function generateTable($records) {


        $count = 1;
        $table1 = '';
        $table1 .= "<html><head> <!-- Latest compiled and minified CSS -->
        <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\">
        <!-- jQuery library -->
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
        <!-- Latest compiled JavaScript -->
        <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\"></script> </head><body><table class='table table-striped'>";


        foreach ($records as $record) {


            $array = $record->returnArray();
            $fields = array_keys($array);
            $values = array_values($array);


            if ($count == 1) {

                $table1 .= '<thead class="thead-dark"><tr>';
                $table1 .= '<th scope = "col"></th>';
                foreach ($fields as $s) {
                    $table1 .= '<th scope = "col">';
                    $table1 .= $s;
                    $table1 .= '</th>';
                }
                #print_r($fields);
                $table1 .= '</tr></thead>';
                $table1 .= '<tbody>';
            }
                $table1 .= '<tr><th scope = "row">';
                $table1 .= (string)$count;
                $table1 .= '</th>';

                foreach($values as $s){
                    $table1 .= '<td>';
                    $table1 .= $s;
                    $table1 .= '</td>';
                }
                $table1 .= '</tr>';

               # print_r($values);
            /*}else{

                #$table1 .= $this-> generateRow($record, $count);
                $array = $record->returnArray();
                $values = array_values($array);
                #print_r($values);
                $table1 .= '<tr><th scope = "row">';
                $table1 .= (string)$count;
                $table1 .= '</th>';

                foreach($values as $s){
                    $table1 .= '<td>';
                    $table1 .= $s;
                    $table1 .= '</td>';
                }
                $table1 .= '</tr>';


            }*/

            $count++;

        }

        $table1 .= '</tbody></table>';

       /* $table = '';
        $table .=  '<table class ="table">
                    <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>';
        $table .= '</table>';*/
        return $table1;
    }
}

class csv {

    static public function getRecords($filename) {

        $file = fopen($filename,"r");

        $fieldNames = array();

        $count = 0;


        while(! feof($file))
        {
            $record = fgetcsv($file);

            if($count == 0){

                $fieldNames = $record;
            }else {
                $records[] = recordFactory::create($fieldNames, $record);
            }

            $count++;
        }

        fclose($file);
        return $records;

    }

}


class record {

    public function __construct(Array $fieldNames = null, Array $values = null)
    {
       # print_r($values);
        #print_r($fieldNames);
        $record = array_combine($fieldNames,$values);

        foreach ($record as $property => $value) {

            $this->createProperty($property, $value);

        }
        #print_r($record);

       # print_r($this);
    }


    public function returnArray() {
        $array = (array)$this;
        #print_r($this);
        return $array;
    }
    public function createProperty($colname = 'firstname', $value = 'jun' ) {

        $this->{$colname} = $value;
    }


}


class recordFactory {

    static public function create(Array $fieldNames = null,  Array $values = null) {

       $record = new record($fieldNames, $values);
        #print_r($fieldNames);
       # print_r($record);
        return $record;
    }

}















