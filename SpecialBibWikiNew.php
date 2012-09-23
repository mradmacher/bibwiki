<?php class SpecialBibWikiNew extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiNew' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    $obj = array();

    $this -> setHeaders();
    $wgOut -> addHtml( $this -> linkToIndex() );
    if( $wgRequest -> wasPosted() ) {
      $obj = $this -> parseFields( $wgRequest );
      $this -> save( $obj );
      $wgOut -> addWikiText( 'Publication successfuly saved.' );
    } else {
      $pub_type = $wgRequest -> getText( 'pub_entry_type' );
      if( $pub_type != '' ) {
        $wgOut -> addHtml( $this -> linkToNew() );
        $obj[ $this -> typeField ] = $pub_type;
        $wgOut -> addHtml( $this -> getNewHtml( $obj, $pub_type ) );
      } else {
        $html = '';
        $html .= '<dl>';
        foreach( $this -> bibEntryTypes as $type ) {
          $html .= '<dt>' . $this -> linkToNewType( $type, $type ) . '</dt>';
          $html .= '<dd><small>' . $this -> bibEntryTypeDescs[ $type ] . '</small></dd>';
        }
        $html .= '</dl>';
        $wgOut -> addHtml( $html );
      }
    }

  }

}
?>


