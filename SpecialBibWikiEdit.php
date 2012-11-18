<?php class SpecialBibWikiEdit extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiEdit' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut, $wgUser;
    parent::execute( $par );

    $wgOut -> addWikiText( $this -> linkToMainCategory() );

    if( $wgRequest -> wasPosted() ) {
      $obj = $this -> parseParams( $wgRequest );
      $wgOut -> addWikiText( $this -> linkToSearch() . ' ' .
        $this -> linkToCreate() . ' ' . $this -> linkToShow( $obj[self::ID] ) );
      //$newid = $this -> genID( $obj );
      //if( $obj[self::ID] != $newid ) {
      //  $wgOut -> addWikiText( 'Publication can not be saved.' );
      //} else {
        $this -> savePage( $this -> genTitle( $obj ), $this -> genTemplate( $obj ) );
        $wgOut -> addWikiText( 'Publication successfully saved.' );
      //}
    } else {
      $obj = $this -> fetchPage( $par );
      $wgOut -> addWikiText( $this -> linkToSearch() . ' ' .
        $this -> linkToCreate() . ' ' . $this -> linkToShow( $obj[self::ID] ) );
      $wgOut -> addHtml( $this -> getModifyHtml( $obj ) );
    }

  }

}
?>

