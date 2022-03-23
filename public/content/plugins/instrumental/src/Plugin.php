<?php

namespace Instrumental;

use Instrumental\CustomPostType\TeacherProfile;
use Instrumental\CustomPostType\StudentProfile;

use Instrumental\CustomTaxonomy\Instrument;
use Instrumental\CustomTaxonomy\Certificate;
use Instrumental\CustomTaxonomy\MusicStyle;

use Instrumental\Models\LessonModel;



class Plugin
{
    /*===================CPT===================*/
    /**
     * @var [TeacherProfileCPT]
     */
    protected $teacherProfileCPT;

    /**
     * @var [StudentProfileCPT]
     */
    protected $studentProfileCPT;

    /*=================TAXONOMY=================*/

    /** 
     * @var [InstrumentTaxonomy]
     */
    protected $instrumentTaxonomy;

    /**
     * @var [CertificateTaxonomy]
     */
    protected $certificateTaxonomy;

    /**
     * @var [MusicStyleTaxonomy]
     */
    protected $musicStyleTaxonomy;

    /*===================UTILE===================*/

    /**
     * Propriété gérant les traitements concernant les rôles
     *
     * @var RoleManager
     */
    protected $roleManager;

    /**
     * @var CustomFields
     */
    protected $customFields;

    /**
     * @var UserRegistration
     */
    protected $userRegistration;

    /**
     * Configuration du router wordpress
     *
     * @var WordpressRouter
     */
    protected $wordpressRouter;

    /*===================MODEL===================*/

    protected $lessonModel;

    /*============================================
       ============================================*/
    public function __construct()
    {
        add_action(
            'init',
            [$this, 'initialize']
        );
    }

    public function initialize()
    {
        /*===================CPT===================*/
        $this->teacherProfileCPT = new TeacherProfile();
        $this->studentProfileCPT = new StudentProfile();

        /*=================TAXONOMY=================*/
        $this->instrumentTaxonomy = new Instrument();
        $this->certificateTaxonomy = new Certificate();
        $this->musicStyleTaxonomy = new MusicStyle();
        
        /*===================UTILE===================*/
        $this->roleManager = new RoleManager();
        $this->userRegistration = new UserRegistration();
        $this->customFields = new CustomFields();
        $this->wordpressRouter = new WordpressRouter();

        /*===================MODEL===================*/
        $this->lessonModel = new LessonModel();
        
      
    }

    public function activate()
    {
        // à l'activation du plugin, nous initialisons ce dernier
        $this->initialize();

        // nous donnons tous les droits à l'administrateur sur les cpt studentProfile et teacherProfile
        // le role "administrator" est un role par défaut de wordpress
        $this->roleManager->giveAllCapabilitiesOnCPT('teacher', 'administrator');
        $this->roleManager->giveAllCapabilitiesOnCPT('student', 'administrator');

        $this->roleManager->createTeacherRole();
        $this->roleManager->createStudentRole();

        $this->lessonModel->createTable();
        
    }

    public function deactivate()
    {
    }
}
