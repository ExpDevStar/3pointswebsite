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
    $existChk       = $pdo->getResult('SELECT 1 FROM users_hospitals LIMIT 1');
} catch(Exception $e){
    $pdo->run('CREATE TABLE `users_hospitals` (`id` int(11) NOT NULL,`user_id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1');
	$pdo->run('ALTER TABLE `users_hospitals` ADD PRIMARY KEY (`id`)');
	$pdo->run('ALTER TABLE `users_hospitals` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1');
}

echo 'Done';