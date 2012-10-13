<?php class SpecialBibWikiIndex extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiIndex' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );

    $criteria = array();
    $order = array();
    foreach( $this -> searcheableFields as $bibField ) {
      $param = $wgRequest -> getText( $this -> toParamName( $bibField ) );
      $paramOrder = $wgRequest -> getText( $this -> toParamSortName( $bibField ) );
      if( $param != '' ) {
        $criteria[$bibField] = $param;
      }
      if( $paramOrder == '1' ) {
        $order[$bibField] = 1;
      } elseif( $paramOrder == '-1' ) {
        $order[$bibField] = -1;
      }
    }
    $printable = false;
    if( $wgRequest -> getText( 'printable' ) == 'yes' ) {
      $printable = true;
    }

    if( $printable ) {
      $cursor = $this -> find( $criteria ) -> sort( $order );
      $wgOut -> addHtml( $this -> getPrintableIndexHtml( $cursor ) );
    } else {
      $wgOut -> addHtml( $this -> linkTo( 'Printable', $this -> indexURL, $criteria, $order, array( 'printable' => 'yes' ) ) );
      $wgOut -> addHtml( $this -> linkTo( 'New', $this -> newURL ) );
      $wgOut -> addHtml( $this -> linkTo( 'Import', $this -> importURL ) );

      $wgOut -> addHtml( $this -> getSearchForm( $criteria, $order ) );
      $cursor = $this -> find( $criteria ) -> sort( $order );
      $wgOut -> addHtml( $this -> getIndexHtml( $cursor, $criteria, $order ) );
    }
  }

}
?>
