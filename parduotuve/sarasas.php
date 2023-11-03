<?php
// operacija3.php  Parodoma registruotų vartotojų lentelė

session_start();

?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Operacija 3</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <table class="center" ><tr><td>
        	<div style="text-align: center;color:black">
        		<br><br>
                <h1>Naudotojų valdymo posistemė</h1>
            </div><br>
        </td></tr><tr><td> 
 <?php
		include("include/valdymomeniu.php"); //įterpiamas meniu pagal vartotojo rolę
 		$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		$sql = "SELECT * "
           . "FROM " . TBL_USERS . " ORDER BY tipas ASC,el_pastas";
		$result = mysqli_query($db, $sql);
		if (!$result || (mysqli_num_rows($result) < 1))  
		{
            echo "Klaida skaitant lentelę users"; 
            exit;
        }
 ?> 
        <div class="container">
            <h2>Visi registruoti naudotojai</h2>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>E-paštas</th>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>Gimimo data</th>
                        <th>Tel. Nr.</th>
                        <th>Tipas</th>
                        <th>Adresas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)) 
                        {	 
                            $email=$row['el_pastas'];
                            $user= $row['vardas']; 
                            $pavarde= $row['pavarde'];
                            $data=$row['gimimo_data'];
                            $tel=$row['tel_nr']; 
                            $level=$row['tipas']; 
                            $adresas= $row['fk_Adresasid'];
                            echo "<tr><td>".$email. "</td>";
                            echo "<td>".$user. "</td>"; 
                            echo "<td>".$pavarde. "</td>"; 
                            echo "<td>".$data. "</td>"; 
                            echo "<td>".$tel. "</td><td>"; 
                            if ($level == UZBLOKUOTAS) {
                                echo "Užblokuotas";
                            }
                            else {
                                foreach($user_roles as $x=>$x_value) {
                                    if ($x_value == $level) echo $x;
                                }
                            } 
                            
                            
                            $index = $row['fk_Adresasid'];
                            $sql2 = "SELECT * " . " FROM " . TBL_ADRESS . " WHERE id='$index'";
                            $result2 = mysqli_query($db, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $pastas = $row2['pasto_kodas'];
                            $vieta = $row2['gyvenamoji_vieta'];
                            
                            echo "</td><td>" .$pastas. ", " .$vieta."</td></tr>"; 

                        }
                     ?>
                </tbody>
            </table>
        </div>
		</table>
            
    </body>
</html>
