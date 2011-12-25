<?php
/**
 * @file
 * API documentation for Internationalization module
 * 
 * Most i18n hooks can be placed on each module.i18n.inc file but in this case
 * such file must be listed in the module.info file.
 */


/**
 * Provide information about object types handled by i18n system.
 * 
 * @see i18n_object_info()
 * 
 * Other features like translation sets (i18n_translation) or string translation (i18n_string)
 * rely on the information provided by this hook for automating string translation
 */
function hook_node_i18n_object_info() {
  // Information for node type object, see i18n_node_i18n_object_info()
  $info['node_type'] = array(
    // Generic object properties, title, etc..
    'title' => t('Node type'),
    // Field to be used as key to index different node types
    'key' => 'type',
    // Mapping object fields and menu place holders
    'placeholders' => array(
    	'%node_type' => 'type',
    ),
    // Path for automatically generated translation tabs. Note placeholders above are used here.
    'edit path' => 'admin/structure/types/manage/%node_type',
    'translate tab' => 'admin/structure/types/manage/%node_type/translate',
    // We can easily list all these objects because they should be limited and manageable
    // Only in this case we provide a 'list callback'.
    'list callback' => 'node_type_get_types',
    // Metadata for string translation
    // In this case we are defining fields and keys for string translation's string names 
    // String ids are of the form: [textgroup]:[type]:[key]:[property]
    // Thus in this case we'll have string names like
    // - node:type:story:name
    // - node:type:story:description
    'string translation' => array(
      'textgroup' => 'node',
      'type' => 'type',
      'properties' => array(
        'name' => t('Name'),
        'title_label' => t('Title label'),
        'description' => t('Description'),
        'help' => t('Help text'),
      ),
      'translate path' => 'admin/structure/types/manage/%node_type/translate/%i18n_language',
    )
  );
  // Example information for taxonomy term object, see i18n_taxonomy_i18n_object_info().
  $info['taxonomy_term'] = array(
    'title' => t('Taxonomy term'),
    'class' => 'i18n_taxonomy_term',
    'entity' => 'taxonomy_term',
    'key' => 'tid',
    'placeholders' => array(
      '%taxonomy_term' => 'tid',
    ),
    // Auto generate edit path
    'edit path' => 'taxonomy/term/%taxonomy_term/edit',
    // Auto-generate translate tab
    'translate tab' => 'taxonomy/term/%taxonomy_term/translate',
    'translation set' => array(
      'class' => 'i18n_taxonomy_translation_set',
      'table' => 'taxonomy_term_data',
      'field' => 'i18n_tsid',
      'parent' => 'taxonomy_vocabulary',
      'placeholder' => '%i18n_taxonomy_translation_set',
      'list path' => 'admin/structure/taxonomy/%taxonomy_vocabulary_machine_name/list/sets',
      'edit path' => 'admin/structure/taxonomy/%taxonomy_vocabulary_machine_name/list/sets/edit/%i18n_taxonomy_translation_set',
      'delete path' => 'admin/structure/taxonomy/%taxonomy_vocabulary_machine_name/list/sets/delete/%i18n_taxonomy_translation_set',
      'page callback' => 'i18n_taxonomy_term_translation_page',
    ),
    'string translation' => array(
      'textgroup' => 'taxonomy',
      'type' => 'term',
      'properties' => array(
        'name' => t('Name'),
        'description' => array(
          'title' => t('Description'),
          'format' => 'format',
        ),
      ),
    )
  );
  return $info;
}

/**
 * Alter i18n object information provided by modules with the previous hook
 * 
 * @see i18n_object_info()
 */
function hook_i18n_string_info_alter(&$info) {
  
}