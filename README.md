# WARNING: This repository is no longer maintained :warning:

> This repository will not be updated. The repository will be kept available in read-only mode.

# ProcessWire MailChimp

Add subscriptions to MailChimp lists.

## Usage

1. install module
2. fill in module settings

- **MailChimp api key**
  - Click on your account name and select **Account**. *(Step 1 and 2)*
  - Then select **Extras**, a dropdown will appear, choose **API keys**. *(Step 3)* 
  - Here you\'ll find your API keys listed below, if there isn\'t one, click **Create A Key**. *(Step 4)*
  - `@see`:
  ![Add API Key](https://github.com/justb3a/processwire-mailchimp/blob/master/screens/apikey.png)
- **Mailchimp list ID for new subscribers**
  - Click on **Lists**. *(Step 1)*
  - Choose the desired list or create a new one. 
  - Then click on **Settings**, a dropdown will appear, select **List name and defaults**. *(Step 2)*
  - Copy the **List ID** listed there (top right-hand side). *(Step 3)*
  - `@see`:
  ![Copy List ID](https://github.com/justb3a/processwire-mailchimp/blob/master/screens/listid.png)
- **Subscriber Status**
  - Use **subscribed** to add an address right away. 
  - Use **pending** to send a confirmation email.
- **Select email field**
  - Select email field (choose from existing ones) which should be attached to the form. 
  - The field settings are used for ProcessWires way of form processing e.g. validation.
- **Select firstname field**
  - Select firstname field (choose from existing ones) which should be attached to the form. 
  - *Optional:* leave this field blank to skip firstname.
- **Select lastname field**
  - Select lastname field (choose from existing ones) which should be attached to the form. 
  - *Optional:* leave this field blank to skip lastname. 
  
3. call module

```php
echo $modules->get('MailChimp')->render();
```
![Render Example](https://github.com/justb3a/processwire-mailchimp/blob/master/screens/fanpost.png)

## Troubleshooting

Have a look at your log files (ProcessWire Admin > Setup > Logs).

## Hooks

### Add fields (e.g. interests)

Hookable method called before the form is rendered.  
Adds possibility to add custom fields.

Example:

```php
$this->addHookAfter('MailChimp::addFields', $this, 'hookAddFields');

public function hookAddFields(HookEvent $event) {
  $form = $event->arguments(0);
  if (!$form->get('interests')) {
    $select = $this->modules->get('InputfieldSelect');
    $select->name = 'interests';
    $select->addOption('A', $this->_('Option A'));
    $select->addOption('B', $this->_('Option B'));
    $form->append($select);
  }
}
```

### Modify data

Hookable method called before the form is processed.  
Adds possibility to modify data before subscribing.

Find the full list of fields available in the List [Member Schema](https://api.mailchimp.com/schema/3.0/Lists/Members/Instance.json).

Example:

```php
$this->addHookAfter('MailChimp::modifyData', $this, 'hookModifyData');

public function hookModifyData(HookEvent $event) {
  $data = $event->arguments(0);
  $data['interests'] = ['2s3a384h' => true];
  $event->return = $data;
}
```
