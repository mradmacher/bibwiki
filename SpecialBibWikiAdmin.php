<?php class SpecialBibWikiAdmin extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiAdmin' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut, $wgUser;
    parent::execute( $par );

    $wgOut -> addWikiText( $this -> linkToMainCategory() );
    $wgOut -> addHtml ( '<form action="" method="post"><input type="submit" value="Install Properties and Templates" /></form>' );
  
    if( $wgRequest -> wasPosted() ) {
      $title = 'Category:' . self::MAIN_CATEGORY_NAME;
      $text = $this -> linkToSearch() . ' ' . $this -> linkToImport() . ' ' . $this -> linkToCreate();
      $this -> savePage( $title, $text );

      /*
      foreach( $this -> entryTypes as $type ) {
        $title = 'Category:' . $this -> toTypeCategoryName( $type );
        $text = $this -> linkToMainCategory() .
          "\n" . $this -> entryTypeDescs[$type]; 
        $text = $this -> entryTypeDescs[$type]; 
        $this -> savePage( $title, $text );
      }
      */

      $title = 'Property:' . $this -> toPropertyName( self::TYPE );
      //$text = $this -> linkToMainCategory();
      $text = '';
      foreach( $this -> entryTypes as $type ) {
        $text .= "\n;[[Allows value::" . $type . '|' . $this -> entryTypeNames[$type] . ']]' .
          ":" . $this -> entryTypeDescs[$type]; 
      }
      $text .= "\n\nThe type of this attribute is [[Has type::string]].";
      $this -> savePage( $title, $text );

      foreach( $this -> fields as $field ) {
        $title = 'Property:' . $this -> toPropertyName( $field );
        //$text = $this -> linkToMainCategory() .
        $text =  "\n" . $this -> fieldDescs[$field] . '.'.
          "\n\nThe type of this attribute is [[Has type::" . $this -> fieldTypes[$field] . "]].";
        $this -> savePage( $title, $text );
      }

      $title = 'Template:' . self::TEMPLATE_NAME;
      $text = $this -> linkToMainCategory();
      //$text .= $this -> linkToTypeCategory( '{{{' . self::TYPE . '}}}' );
      /*
      $text = "{{#switch:{{{" . self::TYPE . "}}}";
      foreach( $this -> entryTypes as $type ) {
        $text .= '|' . $type . '=' . $this -> linkToTypeCategory( $type );
      }
      $text .= "}}\n\n";
      */
      $text .= $this -> linkToSearch() . ' ' .
        $this -> linkToImport() . ' ' .
        $this -> linkToCreate() . ' ' .
        $this -> linkToEdit( '{{{' . self::ID . '}}}' );

      $text .= "\n\n'''{{#switch:{{{" . self::TYPE . "}}}";
      foreach( $this -> entryTypes as $type ) {
        $text .= '|' . $type . '=' . $this -> entryTypeNames[$type];
      }
      $text .= "}}'''";

      $text .= "\n\n[[File:{{{" .  self::ID . "}}}.pdf | Upload File]]\n\n";

      foreach( $this -> fields as $field ) {
        $text .= '{{#if: {{{' . $field . '|}}} | ;'. $this -> fieldNames[$field] .
          ' :[[' . $this -> toPropertyName( $field ) . '::{{{' . $field . '}}}]] | }}';
      }
      $this -> savePage( $title, $text );

    }

  }

}
?>

