<?php class SpecialBibWikiCreate extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiCreate' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );

    $obj = array();

    $wgOut -> addWikiText( $this -> linkToMainCategory() );
    if( $wgRequest -> wasPosted() ) {
      $obj = $this -> parseParams( $wgRequest );
      $id = $this -> genID( $obj );
      $obj[self::ID] = $id;
      if( $this -> publicationExists( $id ) ) {
        $wgOut -> addWikiText( 'Publication can not be saved. Publication with similar data already exists.' );
      } else {
        $this -> savePublication( $obj );
        $wgOut -> addWikiText( 'Publication successfully saved.' );
      }
      $wgOut -> addWikiText( $this -> linkToSearch() . ' ' . $this -> linkToCreate() . ' ' . $this -> linkToShow( $obj[self::ID] ) );
    } else {
      $wgOut -> addWikiText( $this -> linkToSearch() . ' ' . $this -> linkToCreate() );
      if( $par != '' ) {
        $obj[self::TYPE] = $par;
        $wgOut -> addHtml( $this -> getNewHtml( $obj, $par ) );
      } else {
        foreach( $this -> entryTypes as $type ) {
          $wgOut -> addWikiText( ';' . $this -> linkToCreate( $type ) );
          $wgOut -> addWikiText( ':' . $this -> entryTypeDescs[$type] );
        }
      }
    }

  }

}
?>


