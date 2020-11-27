<?php


namespace Drupal\neptune_sync\Form;


use Drupal\Core\Form\FormStateInterface;
use Drupal\neptune_sync\Graph\GraphGenerator;
use Drupal\neptune_sync\Utility\Helper;

class CoopGraphForm extends \Drupal\Core\Form\FormBase
{

    public function getFormId(){
        return 'coop_graph_form';
    }


    public function buildForm(array $form, FormStateInterface $form_state){

        $form['bodies'] = [
            '#type' => 'webform_entity_checkboxes',
            '#title' => $this->t('Select government bodies cooperative intersect'),
            '#options_display' => 'three_columns',
            '#multiple' => TRUE,
            '#target_type' => 'node',
            '#selection_handler' => 'views',
            '#selection_settings' => [
                'view' => [
                    'view_name' => 'connected_bodies',
                    'display_name' => 'entity_reference_1',
                    'arguments' => [
                    ],
                ],
            ],
        ];

        $form['actions'] = [
            '#type' => 'actions',
            '#tree' => TRUE,
        ];
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => 'Run query',
            '#button_type' => 'primary',
        ];

        return $form;
    }

    /**
     * @todo this could use some work in a future sprint
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function validateForm(array &$form, FormStateInterface $form_state){
        parent::validateForm($form, $form_state); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritDoc
     */
    public function submitForm(array &$form, FormStateInterface $form_state){

        $filters = $form_state->getValues();
        Helper::log("form values = ", false, $filters);
        $form_state->setRedirect('neptune_sync.displayCoopGraphIntersect', [], ['query' => [
            'bodies' => $filters['bodies'],
        ]]);

    }
}