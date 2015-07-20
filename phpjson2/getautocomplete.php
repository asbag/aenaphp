 <?php
 mysql_connect("localhost","root","java_innova4b");
 mysql_select_db("autocomplete");
 

if (!isset($_GET["term"]) || $_GET["term"]) {
	$term = "";
} else {
	$term=$_GET["term"];
}

 $select = "SELECT * FROM student where name like '%".$term."%' order by name ";

 $query=mysql_query($select);
 $json=array();
 
    while($student=mysql_fetch_array($query)){
    	    $json[]=array(
                    'value'=> $student["name"],
                    'label'=>$student["name"]." - ".$student["id"]
                        );
    }

 echo json_encode($json);
 
?>
