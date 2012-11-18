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
      $newid = $this -> genID( $obj );
      $canBeSaved = true;
      if( $obj[self::ID] != $newid ) {
        if( $this -> publicationExists( $newid ) ) {
          $wgOut -> addWikiText( 'Publication can not be saved. Publication with similar data already exists.' );
          $canBeSaved = false;
        } else {
          $this -> changePublicationID( $obj[self::ID], $newid );
          $this -> changePublicationFileID( $obj[self::ID], $newid );
          $obj[self::ID] = $newid;
        }
      } 
      if( $canBeSaved ) {
        $this -> savePublication( $obj );
        $wgOut -> addWikiText( 'Publication successfully saved.' );
      }
      $wgOut -> addWikiText( $this -> linkToSearch() . ' ' .
        $this -> linkToCreate() . ' ' . $this -> linkToShow( $obj[self::ID] ) );
    } else {
      $obj = $this -> fetchPublication( $par );

      $wgOut -> addWikiText( $this -> linkToSearch() . ' ' .
        $this -> linkToCreate() . ' ' . $this -> linkToShow( $obj[self::ID] ) );
      $wgOut -> addHtml( $this -> getModifyHtml( $obj ) );
    }

  }

}
?>

