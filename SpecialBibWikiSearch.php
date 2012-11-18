<?php class SpecialBibWikiSearch extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiSearch' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );

    $wgOut -> addWikiText( $this -> linkToMainCategory() );
    $wgOut -> addWikiText( $this -> linkToCreate() . ' ' . $this -> linkToImport() );
    $criteria = array();
    foreach( $this -> searcheableFields as $field ) {
      $value = $wgRequest -> getText( $this -> toParamName( $field ) );
      if( $value != '' ) {
        $criteria[$field] = $value;
      }
    }

    if( $this -> isPrintable() ) {
      $wgOut -> setPageTitle( '' );
    } else {
      $wgOut -> addHtml( $this -> getSearchForm( $criteria ) );

      $search = '{{#ask: ' . $this -> linkToMainCategory();
      foreach( $criteria as $field => $value ) {
        $search .= '[[' . $this -> toPropertyName( $field ) . '::~*' . $value . '*]]';
      }
      foreach( $this -> searcheableFields as $field ) {
        $search .= '| ?' . $this -> toPropertyName( $field ) . ' = ' . $this -> fieldNames[$field];
      }
      $search .= '}}';
      $wgOut -> addWikiText( $search );
    }
  }

}
?>
