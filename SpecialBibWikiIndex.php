<?php class SpecialBibWikiIndex extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiIndex' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );

    $wgOut -> addHtml( $this -> linkToImport() );
    $wgOut -> addHtml( $this -> linkToNew() );
    $wgOut -> addHtml( $this -> getSearchForm() );

    $criteria = array();
    foreach( $this -> bibSearcheableFields as $bibField ) {
      $param = $wgRequest -> getText( 'pub_' . $bibField );
      if( $param != '' ) {
        $criteria[$bibField] = $param;
      }
    }
    $cursor = $this -> find( $criteria );
    $wgOut -> addHtml( $this -> getIndexHtml( $cursor ) );
  }

}
?>
