<?php class SpecialBibWikiIndex extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiIndex' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );

    $wgOut -> addHtml( $this -> linkTo( 'Import', $this -> importURL ) );
    $wgOut -> addHtml( $this -> linkTo( 'New', $this -> newURL ) );

    $criteria = array();
    foreach( $this -> searcheableFields as $bibField ) {
      $param = $wgRequest -> getText( $this -> toParamName( $bibField ) );
      if( $param != '' ) {
        $criteria[$bibField] = $param;
      }
    }
    $wgOut -> addHtml( $this -> getSearchForm( $criteria ) );
    $cursor = $this -> find( $criteria );
    $wgOut -> addHtml( $this -> getIndexHtml( $cursor ) );
  }

}
?>
