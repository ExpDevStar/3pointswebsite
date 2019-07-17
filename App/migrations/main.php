<?php 

include_once('../../connection.php');

// Create Table if not exists

try{
    $existChk       = $pdo->getResult('SELECT 1 FROM questions LIMIT 1');
} catch(Exception $e){
    $pdo->run('CREATE TABLE `questions` ( `id` INT NOT NULL AUTO_INCREMENT, `title` VARCHAR(244), `points` INT, PRIMARY KEY (`id`) )');
    $pdo->insert("INSERT INTO `questions` (`title`, points) VALUES ('Is the resident Actively receiving Parenteral IV Feeding: Level High? (i.e. TPN)', 7)");
    $pdo->insert("INSERT INTO `questions` (`title`, points) VALUES ('Is the resident Actively receiving Intravenous Medication Post -Admit Code?', 5)");
    $pdo->insert("INSERT INTO `questions` (`title`, points) VALUES ('Is the resident Actively on a Ventilator or Respirator Post-Admit Code?', 4)");
    $pdo->insert("INSERT INTO `questions` (`title`, points) VALUES ('Is the resident Actively receiving Parenteral IV Feeding: Level Low? (i.e. IV Fluids)', 3)");
}

try{
    $existChk       = $pdo->getResult('SELECT 1 FROM patient_answers LIMIT 1');
} catch(Exception $e){
    $pdo->run('CREATE TABLE `threepts_com_virtual`.`patient_answers` ( `id` INT NOT NULL AUTO_INCREMENT, `medicalrecord` text,`question_id` INT, `answer` VARCHAR(50), `points` INT, PRIMARY KEY (`id`) )');
}

try{
    $existChk       = $pdo->getResult('SELECT 1 FROM patient_icd_codes LIMIT 1');
} catch(Exception $e){
    $pdo->run('CREATE TABLE `patient_icd_codes` ( `id` INT NOT NULL AUTO_INCREMENT, `medicalrecord` text, `icd_code` VARCHAR(10), PRIMARY KEY (`id`) )');
}

echo 'Done';