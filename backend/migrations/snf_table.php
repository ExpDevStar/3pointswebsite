<?php
require_once __DIR__ . "/../../connection.php";
$tableExits = $pdo->getResult("SHOW tables like 'snfs'");
if (count($tableExits) == 0) {
    //It means table is not created already Create Table and structure
    $createTableQuery = "CREATE TABLE snfs (
        id int NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        PRIMARY KEY (id)
    )";
    $res = $db->query($createTableQuery);
    // $autoIncrement = "ALTER TABLE `snfs` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT";
    // $re
    if ($res === TRUE) {
        //If table created successfully
        echo "Table Created Successfully, Creating relations...<br>";
        //Alter users table
        $alterUserTable = "ALTER TABLE users ADD snf_id int";
        $res = $db->query($alterUserTable);
        if ($res === TRUE) {
            echo "Added snf_id in user table, creating Relationship...<br>";
            $alterUserTable = "ALTER TABLE users ADD CONSTRAINT fk_user_snf_id FOREIGN KEY(snf_id) REFERENCES snfs(id)";
            try {
                $res = $db->query($alterUserTable);
                if ($res === TRUE) {
                    echo "Added Foreign key constraint to user table Adding constraint to patients table...<br>";
                } else {
                    echo "Error Adding Foreign Key constraint to user table...<br>";
                }
            } catch (Exception $e) {
                echo "Exception: " . $e;
            }
        }
        $alterPatientTable = "ALTER TABLE patients ADD snf_id int";
        $patentUpdate = $db->query($alterPatientTable);
        echo "Added snf_id in patients table, creating Relationship...<br>";
        $alterPatientTable = "ALTER TABLE patients ADD CONSTRAINT fk_patient_snf_id FOREIGN KEY(snf_id) REFERENCES snfs(id)";
        try {
            $patentUpdate = $db->query($alterPatientTable);
            if ($patentUpdate === TRUE) {
                echo "Added Foreign key constraint to patients table starting data entry...<br>";
            } else {
                echo "Error Adding Foreign Key constraint to patients table...<br>";
            }
        } catch (Exception $e) {
            echo "Exception: " . $e;
        }
    } else {
        echo "Error in creating Snf table Aborting";
        exit;
    }
}
echo "Tables and structure created, Starting data entry for user table...<br>";
//Getting result from users 
$query = "SELECT * from users";
$users = $pdo->getResult($query);
foreach ($users as $key => $value) {
    if($value['snf_id'] == null) {
        $snfQuery = "SELECT * FROM snfs WHERE name = '".$value['Hospital']."'";
        $snf = $pdo->getResult($snfQuery);
        if(count($snf) > 0) {
            //hospital name exist update user with snf_id
            $snf_id = $snf[0]['id'];
            $update_query = "UPDATE users SET snf_id = $snf_id WHERE id= ".$value['id']."";
            try {
               $updated = $db->query($update_query);
            } catch (Exception $e) {
                echo "Exception: ".$e;
            }
        }
        else 
        {
            //New Record
            $insert_query = "INSERT into snfs (name) VALUES ('".$value['Hospital']. "')";
            try {
                $db->query($insert_query);
                $id = $db->insert_id;
                $update_user_query = "UPDATE users set snf_id = $id WHERE id = " .$value['id']."";
                $db->query($update_user_query);
            } catch (Exception $e) {
                echo "Exception: ".$e;
            }
        }
    }
}
echo "Data entry in users table finish starting Data entry for patient table";
//Getting result from patients
$query = "SELECT * from patients";
$patients = $pdo->getResult($query);
foreach ($patients as $key => $value) {
    if($value['snf_id'] == null) {
        $snfQuery = "SELECT * FROM snfs WHERE name = '".$value['hospital']."'";
        $snf = $pdo->getResult($snfQuery);
        if(count($snf) > 0) {
            //hospital name exist update user with snf_id
            $snf_id = $snf[0]['id'];
            $update_query = "UPDATE patients SET snf_id = $snf_id WHERE id= ".$value['id']."";
            try {
               $updated = $db->query($update_query);
            } catch (Exception $e) {
                echo "Exception: ".$e;
            }
        }
        else 
        {
            //New Record
            $insert_query = "INSERT into snfs (name) VALUES ('".$value['hospital']. "')";
            try {
                $db->query($insert_query);
                $id = $db->insert_id;
                $update_user_query = "UPDATE patients set snf_id = $id WHERE id = " .$value['id']."";
                $db->query($update_user_query);
            } catch (Exception $e) {
                echo "Exception: ".$e;
            }
        }
    }
}
echo "Data entry job finished";
