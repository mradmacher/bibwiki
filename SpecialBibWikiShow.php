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
      if( $this -> isPrintable() ) {
        $wgOut -> setPageTitle( '' );
      } else {
        $wgOut -> addHtml( $this -> linkToIdBlank( 'Printable', $this -> showURL, $pub_id, array( 'printable' => 'yes' ) ) );
        if( strpos( $_SERVER['HTTP_REFERER'], $this -> indexURL ) ) {
          $wgOut -> addHtml( $this -> linkTo( 'Index', $_SERVER['HTTP_REFERER'] ) );
        } else {
          $wgOut -> addHtml( $this -> linkTo( 'Index', $this -> indexURL ) );
        }
        $wgOut -> addHtml( $this -> linkToId( 'Modify', $this -> modifyURL, $obj[ $this -> idField ] ) );
        $wgOut -> addHtml( $this -> linkToId( 'Delete', $this -> deleteURL, $obj[ $this -> idField ] ) );
      }
      $wgOut -> addHtml( $this -> getShowHtml( $obj ) );
    }
  }

}
?>
