# ProcessWire MailChimp

Add subscriptions to MailChimp lists.

## Usage

- install module
- fill in module settings
- **MailChimp api key**
  - Click on your account name and select **Profile**. Then select **Extras**, a dropdown will appear, choose **API keys**. Here you\'ll find your API keys listed below, if there isn\'t one, click **Create A Key**.
- **Mailchimp list ID for new subscribers**
  - Click on **Lists**. Choose the desired list or create a new one. Then click on **Settings**, a dropdown will appear, select **List name and defaults**. Copy the **List ID** listed there (top right-hand side).
- **Subscriber Status**
  - Use **subscribed** to add an address right away. Use **pending** to send a confirmation email.
- **Select email field**
  - Select email field (choose from existing ones) which should be attached to the form. The field settings are used for ProcessWires way of form processing e.g. validation.
- **Select firstname field**
  - Select firstname field (choose from existing ones) which should be attached to the form. Optional: leave this field blank to skip firstname.
- **Select lastname field**
  - Select lastname field (choose from existing ones) which should be attached to the form. Optional: leave this field blank to skip lastname. 

```php
echo $modules->get('MailChimp')->render();
```

## Troubleshooting

Have a look at your log files (ProcessWire Admin > Setup > Logs).

## Hooks

### Add fields (e.g. interests)

Hookable method called before the form is rendered.  
Adds possibility to add custom fields.

*@param InputfieldForm $form*

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
