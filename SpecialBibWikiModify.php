<?php class SpecialBibWikiModify extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiModify' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    $pub_id = $wgRequest -> getText( 'pub_id' );
    $obj = $this -> findById( $pub_id );

    $this -> setHeaders();
    $wgOut -> addHtml( $this -> linkToIndex() );
    $wgOut -> addHtml( $this -> linkToShow( $obj[ $this -> idField ] ) );

    if( $wgRequest -> wasPosted() ) {
      $obj = $this -> parseFields( $wgRequest );
      $this -> save( $obj );
      $wgOut -> addWikiText( 'Publication successfuly saved.' );
    } else {
      $wgOut -> addHtml( $this -> getModifyHtml( $obj ) );
    }

  }

}
?>



