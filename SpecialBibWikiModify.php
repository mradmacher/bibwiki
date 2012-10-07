<?php class SpecialBibWikiModify extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiModify' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );

    $pub_id = $wgRequest -> getText( 'pub_id' );
    $obj = $this -> findById( $pub_id );

    $wgOut -> addHtml( $this -> linkToIndex() );
    $wgOut -> addHtml( $this -> linkToShow( $obj[ $this -> idField ] ) );

    if( $wgRequest -> wasPosted() ) {
      $obj = $this -> parseFields( $wgRequest );
      $key = $this -> genBibkey( $obj );
      $obj[ $this -> bibkeyField ] = $key;
      if( $this -> isUnique( $key, $obj[ $this -> idField ] ) ) {
        $this -> save( $obj );
        $wgOut -> addWikiText( 'Publication successfuly saved.' );
      } else {
        $wgOut -> addWikiText( 'Publication not saved! Entry with similar data already exists.' );
      }
    } else {
      $wgOut -> addHtml( $this -> getModifyHtml( $obj ) );
    }

  }

}
?>



