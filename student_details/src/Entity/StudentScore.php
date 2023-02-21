<?php

namespace Drupal\student_details\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;
/**
 * Defines the Student Score entity.
 *
 * @ingroup student_score
 *
 * @ContentEntityType(
 *   id = "student_score",
 *   label = @Translation("Score"),
 *   base_table = "student_score",
 *   entity_keys = {
 *     "subject" = "subject",
 *     "id" = "roll_no",
 *     "score" = "score"
 *   },
 * )
 */
class StudentScore extends ContentEntityBase implements ContentEntityInterface {

    public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

        // Student Name
        $fields['subject'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Subject Name'))
            ->setDescription(t('Subject Name'))
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

        // Roll number
        $fields['roll_no'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('Roll Number'))
            ->setDescription(t('Student Roll number'))
            ->setReadOnly(TRUE);

        // Score
        $fields['score'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('Score'))
            ->setDescription(t('Student score'))
            ->setReadOnly(TRUE);

        return $fields;
    }
  }