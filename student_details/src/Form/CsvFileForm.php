<?php 

namespace Drupal\student_details\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class CsvFileForm extends FormBase {

    public function  getFormId() {
        return 'student_data';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['student_data'] = array(
            '#type' => 'managed_file',
            '#title' => t('Upload Student Data'),
            '#upload_location' => 'public://student_data',
            '#description' => t('Upload student data in csv format.'),
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

        $file = $form_state->getValue('student_data');
        if ($file) {
            $file = File::load(reset($file));
        }

        $destination = "sites/default/files/student_data/".$file->getFilename();

        $file = fopen($destination, "r");

        while (($student_data = fgetcsv($file)) !== false) {
            \Drupal::database()->insert('student_details')
                ->fields(array(
                    'roll_no' => $student_data[0],
                    'name' => $student_data[1],
                    'class' => $student_data[2],
                    'contact_no' => $student_data[3]
                ))
                ->execute();
        }

        fclose($file);

        \Drupal::messenger()->addMessage('Student data uploaded');

    }
}