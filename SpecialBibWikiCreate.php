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
      $this -> savePage( $this -> genTitle( $obj ), $this -> genTemplate( $obj ) );
      $wgOut -> addWikiText( $this -> linkToSearch() . ' ' . $this -> linkToCreate() . ' ' . $this -> linkToShow( $this -> genID( $obj ) ) );
      $wgOut -> addWikiText( 'Publication successfully saved.' );
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


