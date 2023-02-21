<?php

namespace Drupal\student_details\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;
/**
 * Defines the Student Details entity.
 *
 * @ingroup student_details
 *
 * @ContentEntityType(
 *   id = "student_details",
 *   label = @Translation("Student"),
 *   base_table = "student_details",
 *   entity_keys = {
 *     "id" = "roll_no",
 *     "name" = "name",
 *     "class" = "class",
 *     "contact_no" = "contact_no"
 *   },
 * )
 */
class StudentDetails extends ContentEntityBase implements ContentEntityInterface {

    public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
  
        // Standard field Roll number, used as primary key.
         $fields['roll_no'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('Roll Number'))
            ->setDescription(t('Student Roll number'))
            ->setReadOnly(TRUE);

        // Student Name
        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Student Name'))
            ->setDescription(t('Student Name'))
            ->setSettings(array(
            'default_value' => '',
            'max_length' => 100,
            'text_processing' => 0,
            ))
            ->setDisplayOptions('view', array(
            'label' => 'above',
            'type' => 'string',
            ))
            ->setDisplayOptions('form', array(
            'type' => 'string_textfield',
            ))
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        // Class
        $fields['class'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Class'))
            ->setDescription(t('Class of the student'))
            ->setSettings(array(
            'default_value' => '',
            'max_length' => 20,
            'text_processing' => 1,
            ))
            ->setDisplayOptions('view', array(
            'label' => 'above',
            'type' => 'string',
            ))
            ->setDisplayOptions('form', array(
            'type' => 'string_textfield',
            ))
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        // Contact Number
        $fields['contact_no'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Contact Number'))
            ->setDescription(t('Student contact number'))
            ->setSettings(array(
            'default_value' => '',
            'max_length' => 20,
            'text_processing' => 2,
            ))
            ->setDisplayOptions('view', array(
            'label' => 'above',
            'type' => 'string',
            ))
            ->setDisplayOptions('form', array(
            'type' => 'string_textfield',
            ))
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

   
        return $fields;
    }
  }