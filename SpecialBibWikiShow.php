<?php class SpecialBibWikiShow extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiShow' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );
  
    $pub_id = $wgRequest -> getText( $this -> toParamName( $this -> idField ) );
    if( $pub_id != '' ) {
      $obj = $this -> findById( $pub_id );
      $wgOut -> addHtml( $this -> linkTo( 'Index', $this -> indexURL ) );
      $wgOut -> addHtml( $this -> linkToId( 'Modify', $this -> modifyURL, $obj[ $this -> idField ] ) );
      $wgOut -> addHtml( $this -> linkToId( 'Delete', $this -> deleteURL, $obj[ $this -> idField ] ) );
      $wgOut -> addHtml( $this -> getShowHtml( $obj ) );
    }
  }

}
?>
