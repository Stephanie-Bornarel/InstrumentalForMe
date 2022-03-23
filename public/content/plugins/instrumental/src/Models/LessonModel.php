<?php

namespace Instrumental\Models;

class LessonModel extends CoreModel
{

    public function getTableName()
    {
        $tablePrefix = $this->wpdb->prefix;
        $tableName = $tablePrefix . 'lessons';
        return $tableName;
    }

   

    public function createTable()
    {
         $tableName = $this->getTableName();

        $sql =" 
            CREATE TABLE `' . $tableName . '` (
                lesson_id int(8) unsigned NOT NULL AUTO_INCREMENT,
                teacher_id int(8) unsigned NOT NULL,
                student_id int(8) unsigned NOT NULL,
                status int(8) unsigned NOT NULL,
                appointment datetime NOT NULL,
                created_at datetime NOT NULL,
                updated_at datetime NULL,
                instrument varchar(100) NOT NULL,
          );
        ";


        // inclusion des fonctions nécessaire pour modifier la bdd
        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

        // Création d'une nouvelle table
        dbDelta($sql);

        $primaryKeySQL = 'ALTER TABLE `' . $tableName . '` ADD PRIMARY KEY `lesson_id_teacher_id_student_id` (`lesson_id`, `teacher_id`, `student_id`)';
        $this->wpdb->query($primaryKeySQL);
      
    }
    

    public function dropTable()
    {
        $tableName = $this->getTableName();

        $sql = 'DROP TABLE `' . $tableName . '`';
        $this->wpdb->query($sql);
    }


    public function insert($userStudentId, $userTeacherId, $date, $instrument)
    {
        $data = [
           
            'student_id' => $userStudentId,
            'teacher_id' => $userTeacherId,
            'appointment' => $date,
            'created_at' => date('Y-m-d H:i:s'),
            'instrument' => $instrument,
        ];

        return $this->wpdb->insert(
            $this->getTableName(),
            $data
        );
    }
        // IMPORTANT il faut utiliser des requêtes préparées dès qu'il y a des partie variables dans la requêtes. Sinon vous créez des failles de sécurité
        // %d dans la requête signifie qu'il y aura un nombre injecté à cet endroit
        // DOC E11 WPDB query spécification des types de paramètre attendu https://www.php.net/sprintf (%d == nombre; %s == string)

    public function getLessonById($lessonId)
    {
        $tableName = $this->getTableName();

        $sql = "
            SELECT * FROM `" . $tableName . "`
            WHERE
               lesson_id  = %d
        ";

        $preparedStatement = $this->wpdb->prepare(
            $sql,
            [
                $lessonId
            ]
        );
        $rows = $this->wpdb->get_results($preparedStatement);

        return $rows;
    }

    public function updateStatus($lessonId, $status)
    {
        $conditions = [
            'lesson_id' => $lessonId,
        ];

        $data = [
            'status' => $status,
        ];

        $this->wpdb->update(
            $this->getTableName(),
            $data,
            $conditions
        );
    }

    public function getLessonsByUserId($userId, $role)
    {
        if ($role == 'teacher') {
            $selectField = 'teacher_id';
        } else {
            $selectField = 'student_id';
        }


        $sql = "
            SELECT * FROM `" . $this->getTableName() . "`
            WHERE
                $selectField = %d
        ";

        $preparedStatement = $this->wpdb->prepare(
            $sql,
            [
                $userId
            ]
        );
        $lessons = $this->wpdb->get_results($preparedStatement);

        foreach ($lessons as $index => $lesson) {
            // chargement du teacher
            $teacher = get_user_by('ID', $lesson->teacher_id);
            $lesson->teacher = $teacher;

            // chargement du student
            $student = get_user_by('ID', $lesson->student_id);
            $lesson->student = $student;

            // chargement de l'instrument
            $instrument = get_term_by('ID', $lesson->instrument, 'instrument');
            $lesson->instrument = $instrument;
        }
        return $lessons;
    }

    public function getLessonsByTeacherId($teacherId)
    {
        return $this->getLessonsByUserId($teacherId, 'teacher');
    }

    public function getLessonsByStudentId($studentId)
    {
        return $this->getLessonsByUserId($studentId, 'student');
    }

    public function delete($lessonId, $teacherId, $studentId)
    {
        $conditions = [
            'lesson_id' => $lessonId,
            'teacher_id' => $teacherId,
            'student_id' => $studentId,
        ];

        $this->wpdb->delete(
            $this->getTableName(),
            $conditions
        );
    }
}
