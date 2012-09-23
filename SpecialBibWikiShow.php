<?php class SpecialBibWikiShow extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiShow' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    $this -> setHeaders();
  
    $pub_id = $wgRequest -> getText( 'pub_id' );
    if( $pub_id != '' ) {
      $obj = $this -> findById( $pub_id );
      $wgOut -> addHtml( $this -> linkToIndex() );
      $wgOut -> addHtml( $this -> linkToModify( $obj[ $this -> idField ] ) );
      $wgOut -> addHtml( $this -> linkToDelete( $obj[ $this -> idField ] ) );
      $wgOut -> addHtml( $this -> getShowHtml( $obj ) );
    }
  }

}
?>
