<?php 

namespace Drupal\student_details\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class StudentScoreForm extends FormBase {

    public function  getFormId() {
        return 'student_score';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['student_score'] = array(
            '#type' => 'managed_file',
            '#title' => t('Upload Student Score'),
            '#upload_location' => 'public://student_score',
            '#description' => t('Upload student score in csv format.'),
            '#upload_validators' => [
                'file_validate_extensions' =>array ('csv')
            ]
        );

        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this -> t('Submit'),
        );

        return $form;    
    }
    public function validateForm(&$form, FormStateInterface $form_state) {

    }
    public function submitForm(&$form, FormStateInterface $form_state) {

        $file = $form_state->getValue('student_score');
        if ($file) {
            $file = File::load(reset($file));
        }

        $destination = "sites/default/files/student_score/".$file->getFilename();

        $file = fopen($destination, "r");

        while (($student_score = fgetcsv($file)) !== false) {
            \Drupal::database()->insert('student_score')
                ->fields(array(
                    'subject' => $student_score[0],
                    'roll_no' => $student_score[1],
                    'score' => $student_score[2]
                ))
                ->execute();
        }

        fclose($file);

        \Drupal::messenger()->addMessage('Student score uploaded');
    }
}