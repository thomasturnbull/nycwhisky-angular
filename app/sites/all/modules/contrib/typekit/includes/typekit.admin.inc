<?php
// $Id: typekit.admin.inc,v 1.2 2009/10/01 22:36:32 zzolo Exp $

/**
 * @file
 * This file holds the functions for the typekit Admin settings.
 *
 * @ingroup typekit
 */

/**
 * Menu callback; displays the typekit module settings page.
 *
 * @see system_settings_form()
 */
function typekit_admin_settings() {
  $form = array();
  $php_access = user_access('use PHP for block visibility');
  $code = htmlspecialchars('<script type="text/javascript" src="http://use.typekit.com/XXXXXXX.js">');
  $key_description = t('
    This is the key for your site, and TypeKit will not work without it.  This can be found in the embed code that you get for each kit.
    <br /><code>
      !code
    </code>
  ', array('!code' => $code));
  $visibility_desc = t("Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are %blog for the blog page and %blog-wildcard for every personal blog. %front is the front page.", array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>'));
  $visibility_options = array(
    0 => t('Show on every page except the listed pages.'),
    1 => t('Show on only the listed pages.'),
  );

  // Check if use has access to do PHP stuff
  if ($php_access) {
    $visibility_options[3] = t('Show if the following PHP code returns <code>TRUE</code> (PHP-mode, experts only).');
    $visibility_desc .= ' ' . t('If the PHP-mode is chosen, enter PHP code between %php. Note that executing incorrect PHP-code can break your Drupal site.', array('%php' => '<?php ?>'));
  }

  // Enable
  $form['typekit_enable'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable'),
    '#description' => t('Enables TypeKit on your site.  On by default'),
    '#default_value' => variable_get('typekit_enable', TRUE),
  );

  // Key
  $form['typekit_key'] = array(
    '#type' => 'textfield',
    '#title' => t('TypeKit Key'),
    '#description' => $key_description,
    '#default_value' => variable_get('typekit_key', ''),
  );

  // Visibility settings
  $form['typekit_visibility'] = array(
    '#type' => 'fieldset',
    '#title' => t('Visibility'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['typekit_visibility']['typekit_visibility_settings']['custom'] = array(
    '#type' => 'radios',
    '#title' => t('Custom visibility settings'),
    '#options' => $visibility_options,
    '#description' => t('Allows TypeKist to show only on certain pages.'),
    '#default_value' => variable_get('typekit_visibility_settings', 0),
  );
  $form['typekit_visibility']['typekit_visibility_pages'] = array(
    '#type' => 'textarea',
    '#title' => t('Pages'),
    '#default_value' => variable_get('typekit_visibility_pages', ''),
    '#description' => $visibility_desc,
  );

  // Make a system setting form and return
  return system_settings_form($form);
}
