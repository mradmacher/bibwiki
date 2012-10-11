<?php class SpecialBibWikiDelete extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiDelete' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );

    $pub_id = $wgRequest -> getText( $this -> toParamName( $this -> idField ) );
    if( $pub_id != '' ) {
      $obj = $this -> findById( $pub_id );
    } else {
      $obj = array();
    }

    $wgOut -> addHtml( $this -> linkTo( 'Index', $this -> indexURL ) );
    if( $wgRequest -> wasPosted() ) {
      $this -> removeById( $pub_id );
      $wgOut -> addWikiText( "Publication successfuly deleted." );
    } else {
      $wgOut -> addWikiText( "This publication will be deleted. Are you sure?" );
      $wgOut -> addHtml( $this -> getDestroyForm( $obj ) );
      $wgOut -> addHtml( $this -> getShowHtml( $obj ) );
    }

  }

}
?>


