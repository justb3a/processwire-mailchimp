<?php namespace ProcessWire;

/**
 * Class MailChimpConfig
 */
class MailChimpConfig extends ModuleConfig {

  /**
   * array Default config values
   */
  public function getDefaults() {
    return array(
      'apiKey' => '',
      'apiListId' => '',
      'status' => 'pending',
      'emailField' => 'email',
      'firstnameField' => '',
      'lastnameField' => '',
    );
  }

  /**
   * Retrieves the list of config input fields
   * Implementation of the ConfigurableModule interface
   *
   * @return InputfieldWrapper
   */
  public function getInputfields() {
    $inputfields = parent::getInputfields();

    // field api key
    $field = $this->modules->get('InputfieldText');
    $field->name = 'apiKey';
    $field->label = __('MailChimp api key');
    $field->description = __('Click on your account name and select **Profile**. Then select **Extras**, a dropdown will appear, choose **API keys**. Here you\'ll find your API keys listed below, if there isn\'t one, click **Create A Key**.');
    $field->columnWidth = 50;
    $field->required = 1;
    $inputfields->add($field);

    // field api list
    $field = $this->modules->get('InputfieldText');
    $field->name = 'apiListId';
    $field->label = __('Mailchimp list ID for new subscribers');
    $field->description = __('Click on **Lists**. Choose the desired list or create a new one. Then click on **Settings**, a dropdown will appear, select **List name and defaults**. Copy the **List ID** listed there (top right-hand side).');
    $field->columnWidth = 50;
    $field->required = 1;
    $inputfields->add($field);

     // field subscribtion status
    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'status';
    $field->label = __('Subscriber Status');
    $field->description = __('Use **subscribed** to add an address right away. Use **pending** to send a confirmation email.');
    $field->addOption('pending', $this->_('pending'));
    $field->addOption('subscribed', $this->_('subscribed'));
    $field->required = 1;
    $field->columnWidth = 50;
    $inputfields->add($field);

    // field email
    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'emailField';
    $field->label = __('Select email field');
    $field->description = __('Select email field (choose from existing ones) which should be attached to the form.');
    $field->notes = __('The field settings are used for ProcessWire`s way of form processing e.g. validation.');
    $field->required = true;
    $field->columnWidth = 50;
    foreach ($this->fields as $f) {
      if ($f->flags & Field::flagPermanent || !$f->type instanceof FieldtypeEmail) continue;
      $field->addOption($f->name, $f->name);
    }
    $inputfields->add($field);

    // field firstname
    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'firstnameField';
    $field->label = __('Select firstname field');
    $field->description = __('Select firstname field (choose from existing ones) which should be attached to the form.');
    $field->notes = __('Optional: leave this field blank to skip firstname. The field settings are used for ProcessWire`s way of form processing e.g. validation.');
    $field->columnWidth = 50;
    foreach ($this->fields as $f) {
      if ($f->flags & Field::flagPermanent || !$f->type instanceof FieldtypeText) continue;
      $field->addOption($f->name, $f->name);
    }
    $inputfields->add($field);

    // field lastname
    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'lastnameField';
    $field->label = __('Select lastname field');
    $field->description = __('Select lastname field (choose from existing ones) which should be attached to the form.');
    $field->notes = __('Optional: leave this field blank to skip lastname.The field settings are used for ProcessWire`s way of form processing e.g. validation.');
    $field->columnWidth = 50;
    foreach ($this->fields as $f) {
      if ($f->flags & Field::flagPermanent || !$f->type instanceof FieldtypeText) continue;
      $field->addOption($f->name, $f->name);
    }
    $inputfields->add($field);

    return $inputfields;
  }
}
