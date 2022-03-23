<?php

namespace Instrumental;

class RoleManager
{
    public function __construct()

    {
    }

    public function deleteTeacherRole()
    {
        remove_role('teacher');
    }

    public function deleteStudentRole()
    {
        remove_role('student');
    }

    public function createTeacherRole()
    {
        add_role(
            'teacher',    // Role Identity
            'Teacher',   // Description of the role
            // Capabilities for teacher
            [
                'delete_others_teacher-profile' => false,
                'delete_private_teacher-profile' => false,
                'delete_teacher-profile' => false,
                'delete_published_teacher-profile' => true,
                'edit_others_teacher-profile' => false,
                'edit_private_teacher-profile' => false,
                'edit_teacher-profile' => false,
                'edit_published_teacher-profile' => true,
                'publish_teacher-profile' => true,
                'read_private_teacher-profile' => true,
            ]
        );
    }

    public function createStudentRole()
    {
        add_role(
            'student',    // idenfiant du rôle
            'Student',   // Libéllé du rôle

            // Capabilities for student
            [
                'delete_student-profile' => false,
                'delete_others_student-profile' => false,
                'delete_private_student-profile' => false,
                'delete_published_student-profile' => true,
                'edit_student-profile' => false,
                'edit_others_student-profile' => false,
                'edit_private_student-profile' => false,
                'edit_published_student-profile' => true,
                'publish_student-profile' => true,
                'read_private_student-profile' => false,
            ]
        );
    }

    // cette méthode va nous permettre de donner tous les droits sur un type de post custom à un role
    public function giveAllCapabilitiesOnCPT($cptName, $role)
    {
        // récupération du rôle passé en paramètre
        // DOC get_role https://developer.wordpress.org/reference/functions/get_role/
        $role = get_role($role);

        // on ajoute chacune des capabilties au rôle choisi
        $capabilities = [
            'delete_' . $cptName . 's',
            'delete_others_' . $cptName . 's',
            'delete_private_' . $cptName . 's',
            'delete_published_' . $cptName . 's',
            'edit_' . $cptName . 's',
            'edit_others_' . $cptName . 's',
            'edit_private_' . $cptName . 's',
            'edit_published_' . $cptName . 's',
            'publish_' . $cptName . 's',
            'read_private_' . $cptName . 's',
        ];

        foreach ($capabilities as $capability) {
            $role->add_cap($capability);
        }
    }
}
