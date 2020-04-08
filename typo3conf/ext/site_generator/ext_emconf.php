<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "site_generator".
 *
 * Auto generated 31-03-2020 08:33
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Site generator / tree model duplicator',
  'description' => 'Site generator wizard used to generate mini-website or duplicate tree model, it will automatically create associated BE/FE groups, create directories with associated files mount, add domain name, update Typoscript configuration (folders/pages ID and TCEMAIN.clearCacheCmd), update slugs.',
  'category' => 'services',
  'author' => 'Florian Rival',
  'author_email' => 'florian.typo3@oktopuce.fr',
  'state' => 'stable',
  'uploadfolder' => false,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '1.1.1',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '9.5.0-10.9.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  'clearcacheonload' => false,
  'author_company' => NULL,
);

