<?php
function dbConnect(array $options){
    try{
    $con = new mysqli($options['host'],$options['username'],$options['password'],$options['dbname']);
    return $con;
    }catch(Exception $err){
       echo $err->getMessage();
    }
}

function genUserTable( $rows){
    $table = "<table border=1 width=40% align=center>
        <tr>
            <th>Host</th>
            <th>User</th>
        </tr>";
   while($row = $rows->fetch_assoc()){
        $table .= "<tr>
            <td>{$row['Host']}</td>
            <td>{$row['User']}</td>
        </tr>";
    }
    $table.= "</table>";
    return $table;
}

$db = dbConnect([
    'host'=>'localhost',
    'username'=>'root',
    'password'=>'',
    'dbname'=>'mysql'
]);

if ($db->connect_errno):
print("Could not connect to database: {$db->connect_errno}");
else:
$result = $db->query('select User,Host from user');
$userTable = genUserTable($result);

echo $userTable;
$result->free_result();
endif;

?>
