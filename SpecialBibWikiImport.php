<?php class SpecialBibWikiImport extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiImport' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut;

    $this -> setHeaders();
    $this -> linkToIndex();
    if( $wgRequest -> wasPosted() ) {
      $file = $_FILES['pub_file']['tmp_name'];
      if( is_uploaded_file( $file ) ) {
        $wgOut -> addWikiText( 'Successfuly uploaded' );
        $result = array();
        exec( 'bib2x -f ' . $file . ' -t import.template', $result );
        foreach( $result as $line ) {
          if( $line != '' ) {
            $pub = json_decode( $line, true ); 
            $type = str_replace( '@', '', $pub['entry_type'] );
            $pub[ $this -> typeField ] = $type;
            array_push( $publications, $pub );
          }
        }
        $this -> import( $publications );
        $wgOut -> addWikiText( 'Successfuly imported' );
      }
    } else {
      $html = '';
      $html .= '<form action="' . $this -> bibWikiImportURL . '" method="post" enctype="multipart/form-data">';
      $html .= '<label for="pub_file">File to import</label><br />';
      $html .= '<input name="pub_file" type="file"/><br />' ;
      $html .= '<input type="submit" value="Import" />'; 
      $html .= '</form>';
      $wgOut -> addHtml( $html );
    }
  }

}
