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
        $wgOut -> addHtml( $this -> linkToBlank( 'Printable', $this -> printableShowPath( $pub_id ) ) );
        if( strpos( $_SERVER['HTTP_REFERER'], $this -> indexPath() ) ) {
          $wgOut -> addHtml( $this -> linkTo( 'Index', $_SERVER['HTTP_REFERER'] ) );
        } else {
          $wgOut -> addHtml( $this -> linkTo( 'Index', $this -> indexPath() ) );
        }
        $wgOut -> addHtml( $this -> linkTo( 'Modify', $this -> modifyPath( $obj[ $this -> idField ] ) ) );
        $wgOut -> addHtml( $this -> linkTo( 'Delete', $this -> deletePath( $obj[ $this -> idField ] ) ) );
      }
      $wgOut -> addHtml( $this -> getShowHtml( $obj ) );
    }
  }

}
?>
