<?php


namespace Drupal\neptune_sync\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\neptune_sync\Utility\Helper;

class DataSyncForm extends FormBase
{
    public function getFormId(){
        return 'data_sync_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state){

        $form['wipe_data'] = [
            '#type' => 'checkboxes',
            '#title' => $this->t('Wipe data'),
            '#options' => [
                'bodies' => $this->t('Bodies'),
                'legislation' => $this->t('Legislations'),
                'portfolios' => $this->t('Portfolios'),
                'cooperative_relationships' => $this->t('Cooperative Relationships'),
                'all' => $this->t('All'),
            ],
            //'#default_value' => 'all',
        ];
        $form['sync_node_creation'] = [
            '#type' => 'checkboxes',
            '#title' => $this->t('Sync node creation'),
            '#description' => $this->t('This creates nodes only, in a blank state. Sync data is needed to fill out data.'),
            '#options' => [
                'bodies' => $this->t('Bodies'),
                'legislation' => $this->t('Legislations'),
                'portfolios' => $this->t('Portfolios'),
                'all' => $this->t('All'),
            ],
            //'#default_value' => 'All',
        ];
        $form['sync_neptune_data'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Sync Neptune data'),
            '#description' => $this->t('Sync Node fields for all existing bodies to Neptune.'),
            '#default_value' => TRUE,
        ];
        $form['actions'] = [
            '#type' => 'actions',
            '#tree' => TRUE,
        ];
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => 'Sync Data',
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
        /*$form_state->setRedirect('neptune_sync.displayCoopGraphIntersect', [], ['query' => [
            'bodies' => $filters['bodies'],
        ]]);*/

    }
}