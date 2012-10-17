<?php class SpecialBibWikiNew extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiNew' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;
    parent::execute( $par );

    $obj = array();

    $wgOut -> addHtml( $this -> linkTo( 'Index', $this -> indexPath() ) );
    if( $wgRequest -> wasPosted() ) {
      $obj = $this -> parseFields( $wgRequest );
      $key = $this -> genBibkey( $obj );
      $obj[ $this -> bibkeyField ] = $key;
      if( $this -> isUnique( $key ) ) {
        $this -> save( $obj );
        $wgOut -> addWikiText( 'Publication successfuly saved.' );
      } else {
        $wgOut -> addWikiText( 'Publication already exists.' );
      }
    } else {
      $pub_type = $wgRequest -> getText( 'pub_entry_type' );
      if( $pub_type != '' ) {
        $wgOut -> addHtml( $this -> linkTo( 'New', $this -> newPath() ) );
        $obj[ $this -> typeField ] = $pub_type;
        $wgOut -> addHtml( $this -> getNewHtml( $obj, $pub_type ) );
      } else {
        $html = '';
        $html .= '<dl>';
        foreach( $this -> entryTypes as $type ) {
          $html .= '<dt>' . $this -> linkTo( $type, $this -> newPath( array( $this -> typeField => $type ) ) ) . '</dt>';
          $html .= '<dd><small>' . $this -> entryTypeDescs[ $type ] . '</small></dd>';
        }
        $html .= '</dl>';
        $wgOut -> addHtml( $html );
      }
    }

  }

}
?>


